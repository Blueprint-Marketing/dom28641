<?php

class FHS_Quiz_Public {


	function __construct() {

		$this->hooks();

	}

	function hooks() {
		
		add_action( 'learndash_settings_fields', array ( $this, 'quiz_custom_setting' ), 10, 2 );
		
		if ( is_user_logged_in() ){
			add_filter( 'pre_get_posts', array ( $this, 'quiz_filter' ), 10 );
			add_action( 'learndash_quiz_completed', array ( $this, 'quiz_completed' ), 10 );
		}
	}
	
	public function quiz_custom_setting( $fields, $key ){
		if ( 'settings_admin_user' == $key ) {
			$setting = get_option( 'learndash_settings_admin_user' );
			$fields['course_quiz_attempt'] = array(
				'name'         => 'course_quiz_attempt',
				'label'         => __( 'Course Quiz Attempt', 'learndash' ),
				'type'         => 'number',
				'value'        => isset( $setting['course_quiz_attempt'] ) ? $setting['course_quiz_attempt'] : 1,
				'help_text'    => __( 'Enter the number of Attempt allow to a user for course quiz.', 'learndash' ),
			);
		}
		return $fields;
	}
	
	public function quiz_filter( $query ){
		$query_vars = $query->query_vars;
		if ( ! is_admin() &&  $query_vars['post_type'] == 'sfwd-quiz' && ! empty( $query_vars["post__in"] ) ) {
			$visiable_quiz = $this->get_visiable_quizid( $query_vars["post__in"] );
			$query->set( 'post__in', $visiable_quiz );
		}
		return $query;
	}
	
	private function get_visiable_quizid( $quiz_ids ){
		
		$allow_attemp = LearnDash_Settings_Section::get_section_setting('LearnDash_Settings_Section_General_Admin_User', 'course_quiz_attempt' );
		
		$show_quiz = $passed_quiz = array( -1 );
		$user_id	= 	get_current_user_id();
		
		$usermeta = get_user_meta( $user_id, '_sfwd-quizzes', true );
		$usermeta = maybe_unserialize( $usermeta );
		
		//Check user attempt or quiz already pass
		$user_attemp = 0;
		$pass = false;
		foreach ( $quiz_ids as $quiz_id ) {
			foreach ( $usermeta as $quizdata ) {
				if ( $quiz_id == $quizdata['quiz'] ){
					if ( 1 == $quizdata['a_pass'] ) {
						$pass = true;
						$passed_quiz[] = $quiz_id;
					}
					$show_quiz[] = $quiz_id;
					$user_attemp++;
				}
			}
		}
		
		if ( $user_attemp >= $allow_attemp || $pass ){
			return ( $pass ) ? $passed_quiz  : $show_quiz;
		}
		
		$show_quiz = array( -1 );
		//Get next quiz for student
		$taken_quiz = array_column( $usermeta, 'quiz' );
		foreach ( $quiz_ids as $quiz_id ){
			if ( ! in_array( $quiz_id, $taken_quiz ) ){
				$show_quiz[] = $quiz_id;
				break;
			}
		}
		return $show_quiz;
	}
	
	public function quiz_completed( $quizdata ){
		if ( ! is_user_logged_in() ){
			return;
		}
		$current_user = wp_get_current_user();
		$user_id	= $current_user->ID;
		
		if ( 1 == $quizdata['pass'] ) {
			if ( ! empty( $quizdata['course'] ) && empty( $quizdata['lesson'] ) && empty( $quizdata['topic'] ) ) {
				$course_id = $quizdata['course']->ID;
				$usermeta = get_user_meta( $user_id, '_sfwd-quizzes', true );
				$usermeta = maybe_unserialize( $usermeta );
				
				remove_filter( 'pre_get_posts', array ( $this, 'quiz_filter' ), 10 );
				$course_quiz_list = learndash_get_course_quiz_list( $course_id, $user_id );
				add_filter( 'pre_get_posts', array ( $this, 'quiz_filter' ), 10 );
				
				$taken_quiz = array_column( $usermeta, 'quiz' );
				
				foreach ( $course_quiz_list as $quiz ){
					$quiz_id = $quiz['post']->ID;
					$key = array_search( $quiz_id, $taken_quiz );
					if ( $key !== false ){
						$usermeta[$key]['a_pass'] =  $usermeta[$key]['pass'];
						$usermeta[$key]['pass'] =  1;
					} else {
						$quiz_meta = get_post_meta( $quiz_id, '_sfwd-quiz', true);
						$quizdata = array(
							'quiz' 					=> 	$quiz_id,
							'score' 				=> 	0,
							'count' 				=> 	0,
							'pass' 					=> 	true,
							'a_pass' 				=> 	false,
							'rank' 					=> 	'-',
							'time' 					=> 	time(),
							'pro_quizid' 			=> 	$quiz_meta['sfwd-quiz_quiz_pro'],
							'course'				=>	$course_id,
							'points' 				=> 	0,
							'total_points' 			=> 	0,
							'percentage' 			=> 	0,
							'timespent' 			=> 	0,
							'has_graded'   			=> 	false,
							'statistic_ref_id' 		=> 	0,
							'm_edit_by'				=>	get_current_user_id(),	// Manual Edit By ID
							'm_edit_time'			=>	time()			// Manual Edit timestamp
						);
						learndash_update_user_activity(
							array(
								'course_id'				=>	$course_id,
								'user_id'				=>	$user_id,
								'post_id'				=>	$quiz_id,
								'activity_type'			=>	'quiz',
								'activity_action'		=>	'update',
								'activity_status'		=>	false,
								'activity_started'		=>	$quizdata['time'],
								'activity_completed' 	=>	$quizdata['time'],
								'activity_meta'			=>	$quizdata
							)
						);
						$usermeta[] = $quizdata;
					}
				}
				update_user_meta( $user_id, '_sfwd-quizzes', $usermeta );
				learndash_process_mark_complete( $user_id, $course_id);
			}
		}
	}
	
}