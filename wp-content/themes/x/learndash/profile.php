<?php
/**
 * Displays a user's profile.
 *
 * Available Variables:
 *
 * $user_id 		: Current User ID
 * $current_user 	: (object) Currently logged in user object
 * $user_courses 	: Array of course ID's of the current user
 * $quiz_attempts 	: Array of quiz attempts of the current user
 * $shortcode_atts 	: Array of values passed to shortcode
 *
 * @since 2.1.0
 *
 * @package LearnDash\User
 */
?>
<?php
	global $learndash_assets_loaded;
	if ( !isset( $learndash_assets_loaded['scripts']['learndash_template_script_js'] ) ) {
		$filepath = SFWD_LMS::get_template( 'learndash_template_script.js', null, null, true );
		if ( !empty( $filepath ) ) {
			wp_enqueue_script( 'learndash_template_script_js', learndash_template_url_from_path( $filepath ), array( 'jquery' ), LEARNDASH_SCRIPT_VERSION_TOKEN, true );
			$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;

			$data = array();
			$data['ajaxurl'] = admin_url('admin-ajax.php');
			$data = array( 'json' => json_encode( $data ) );
			wp_localize_script( 'learndash_template_script_js', 'sfwd_data', $data );
		}
	}
	LD_QuizPro::showModalWindow();
?>
<div id="learndash_profile">

    <div class="expand_collapse">
        <a href="#" onClick='return flip_expand_all("#course_list");'><?php _e( 'Expand All', 'learndash' ); ?></a> | <a href="#" onClick='return flip_collapse_all("#course_list");'><?php _e( 'Collapse All', 'learndash' ); ?></a>
    </div>

	<div class="learndash_profile_heading">
		<span><?php _e( 'Profile', 'learndash' ); ?></span>
	</div>

	<div class="profile_info clear_both">
		<div class="profile_avatar">
			<?php echo get_avatar( $current_user->user_email, 96 ); ?>
			<div class="profile_edit_profile" align="center">
                <a href='<?php echo get_edit_user_link(); ?>'><?php _e( 'Edit profile', 'learndash' ); ?></a>
            </div>
        </div>

		<div class="learndash_profile_details">
			<?php if ( ( ! empty( $current_user->user_lastname) ) || ( ! empty( $current_user->user_firstname ) ) ): ?>
				<div><b><?php _e( 'Name', 'learndash' ); ?>:</b> <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
			<?php endif; ?>
			<div><b><?php _e( 'Username', 'learndash' ); ?>:</b> <?php echo $current_user->user_login; ?></div>
			<div><b><?php _e( 'Email', 'learndash' ); ?>:</b> <?php echo $current_user->user_email; ?></div>
			
			<?php if ( ( isset( $shortcode_atts['course_points_user'] ) ) && ( $shortcode_atts['course_points_user'] == 'yes' ) ) { ?>
				<?php echo do_shortcode('[ld_user_course_points user_id="'. $current_user->ID .'" context="ld_profile"]'); ?>
			<?php } ?>
		</div>
	</div>

	<div class="learndash_profile_heading no_radius clear_both">
		<span class="ld_profile_course"><?php printf( _x( 'Registered %s', 'Registered Courses Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'courses' ) ); ?></span>
		<span class="ld_profile_status"><?php _e( 'Status', 'learndash' ); ?></span>
		<span class="ld_profile_certificate"><?php _e( 'Certificate', 'learndash' ); ?></span>
	</div>

	<div id="course_list">

		<?php if ( ! empty( $user_courses ) ) : ?>

			<?php foreach ( $user_courses as $course_id ) : ?>
				<?php
                    $course = get_post( $course_id);

                    $course_link = get_permalink( $course_id );

                    $progress = learndash_course_progress( array(
                        'user_id'   => $user_id,
                        'course_id' => $course_id,
                        'array'     => true
                    ) );

                    $status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';
				?>
				<div id='course-<?php echo esc_attr( $user_id ) . '-' . esc_attr( $course->ID ); ?>'>
					<div class="list_arrow collapse flippable"  onClick='return flip_expand_collapse("#course-<?php echo esc_attr( $user_id ); ?>", <?php echo esc_attr( $course->ID ); ?>);'></div>


                    <?php
                    /**
                     * @todo Remove h4 container.
                     */
                    ?>
					<h4>
						<div class="learndash-course-link"><a href="<?php echo esc_attr( $course_link ); ?>"><?php echo $course->post_title; ?></a></div>

						<div class="learndash-course-status"><a class="<?php echo esc_attr( $status ); ?>" href="<?php echo esc_attr( $course_link ); ?>"><?php echo $course->post_title; ?></a></div>
						<div class="learndash-course-certificate"><?php
							$certificateLink = learndash_get_course_certificate_link( $course->ID, $user_id );
							if ( !empty( $certificateLink ) ) {
								?><a target="_blank" href="https://foodhandlersolutions.com/certificates/food-handler-certificate/"><div class="certificate_icon_large"></div></a><?php
							} else {
								?><a style="padding: 10px 2%;" href="#">-</a><?php
							}
						?></div>
						<div class="flip" style="clear: both; display:none;">

							<div class="learndash_profile_heading course_overview_heading"><?php printf( _x( '%s Progress Overview', 'Course Progress Overview Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) ); ?></div>

							<div>
								<dd class="course_progress" title='<?php echo sprintf( __( '%s out of %s steps completed', 'learndash' ), $progress['completed'], $progress['total'] ); ?>'>
									<div class="course_progress_blue" style='width: <?php echo esc_attr( $progress['percentage'] ); ?>%;'>
								</dd>

								<div class="right">
									<?php echo sprintf( __( '%s%% Complete', 'learndash' ), $progress['percentage'] ); ?>
								</div>
							</div>

							<?php if ( ! empty( $quiz_attempts[ $course_id ] ) ) : ?>
								<div class="learndash_profile_quizzes clear_both">

									<div class="learndash_profile_quiz_heading">
										<div class="quiz_title"><?php echo LearnDash_Custom_Label::get_label( 'quizzes' ); ?></div>
										<div class="certificate"><?php _e( 'Certificate', 'learndash' ); ?></div>
										<div class="scores"><?php _e( 'Score', 'learndash' ); ?></div>
										<div class="statistics"><?php _e( 'Statistics', 'learndash' ); ?></div>
										<div class="quiz_date"><?php _e( 'Date', 'learndash' ); ?></div>
									</div>

									<?php foreach ( $quiz_attempts[ $course_id ] as $k => $quiz_attempt ) : ?>
										<?php
											$certificateLink = null;
											
											if ( (isset( $quiz_attempt['has_graded'] ) ) && ( true === $quiz_attempt['has_graded'] ) && (true === LD_QuizPro::quiz_attempt_has_ungraded_question( $quiz_attempt )) ) {
												$status = 'pending';
											} else {
												$certificateLink = @$quiz_attempt['certificate']['certificateLink'];
												$status = empty( $quiz_attempt['a_pass'] ) ? 'failed' : 'passed';
											}

										    $quiz_title = ! empty( $quiz_attempt['post']->post_title) ? $quiz_attempt['post']->post_title : @$quiz_attempt['quiz_title'];

										    $quiz_link = ! empty( $quiz_attempt['post']->ID ) ? learndash_get_step_permalink( intval( $quiz_attempt['post']->ID ), $course_id ) : '#';
										?>
										<?php if ( ! empty( $quiz_title ) ) : ?>
											<div class='<?php echo esc_attr( $status ); ?>'>

												<div class="quiz_title">
													<span class='<?php echo esc_attr( $status ); ?>_icon'></span>
													<a href='<?php echo esc_attr( $quiz_link ); ?>'><?php echo esc_attr( $quiz_title ); ?></a>
												</div>

												<div class="certificate">
													<?php if ( ! empty( $certificateLink ) ) : ?>
														<a href='<?php echo esc_attr( $certificateLink ); ?>&time=<?php echo esc_attr( $quiz_attempt['time'] ) ?>' target="_blank">
														<div class="certificate_icon"></div></a>
													<?php else : ?>
														<?php echo '-';	?>
													<?php endif; ?>
												</div>

												<div class="scores">
													<?php if ( (isset( $quiz_attempt['has_graded'] ) ) && (true === $quiz_attempt['has_graded']) && (true === LD_QuizPro::quiz_attempt_has_ungraded_question( $quiz_attempt )) ) : ?>
														<?php echo _x('Pending', 'Pending Certificate Status Label', 'learndash'); ?>
													<?php else : ?>
														<?php echo round( $quiz_attempt['percentage'], 2 ); ?>%
													<?php endif; ?>
												</div>

												<div class="statistics">
												<?php
													if ( ( $user_id == get_current_user_id() ) || ( learndash_is_admin_user() ) || ( learndash_is_group_leader_user() ) ) {
														if ( ( !isset( $quiz_attempt['statistic_ref_id'] ) ) || ( empty( $quiz_attempt['statistic_ref_id'] ) ) ) {
															$quiz_attempt['statistic_ref_id'] = learndash_get_quiz_statistics_ref_for_quiz_attempt( $user_id, $quiz_attempt );
														}

														if ( ( isset( $quiz_attempt['statistic_ref_id'] ) ) && ( !empty( $quiz_attempt['statistic_ref_id'] ) ) ) {
															/**
															 *	 @since 2.3
															 * See snippet on use of this filter https://bitbucket.org/snippets/learndash/5o78q
															 */
															if ( apply_filters( 'show_user_profile_quiz_statistics',
																		get_post_meta( $quiz_attempt['post']->ID, '_viewProfileStatistics', true ), $user_id, $quiz_attempt, basename( __FILE__ ) ) ) {
														
																?><a class="user_statistic" data-statistic_nonce="<?php echo wp_create_nonce( 'statistic_nonce_'. $quiz_attempt['statistic_ref_id'] .'_'. get_current_user_id() . '_'. $user_id ); ?>" data-user_id="<?php echo $user_id ?>" data-quiz_id="<?php echo $quiz_attempt['pro_quizid'] ?>" data-ref_id="<?php echo intval( $quiz_attempt['statistic_ref_id'] ) ?>" href="#"><div class="statistic_icon"></div></a><?php
															}
														}
													}
												?>
												</div>

												<div class="quiz_date"><?php echo learndash_adjust_date_time_display(  $quiz_attempt['time'] ); ?></div>

											</div>
										<?php endif; ?>
									<?php endforeach; ?>

								</div>
							<?php endif; ?>

						</div>
					</h4>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

	</div>
</div>
<?php if ( apply_filters('learndash_course_steps_expand_all', $shortcode_atts['expand_all'], 0, 'profile_shortcode' ) ) { ?>
	<script>
		jQuery(document).ready(function() {
			jQuery("#learndash_profile .list_arrow").trigger('click');
		});
	</script>
<?php } ?>
