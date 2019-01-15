<?php
/**
 * Helper and Utility Functions
 */

if ( ! function_exists( 'FHS_Quiz_get_status' ) ) {
	function FHS_Quiz_get_status( $quiz_id ) {
		if ( ! is_user_logged_in() ) {
			return false;
		}
		$user_id = get_current_user_id();
		
		$usermeta = get_user_meta( $user_id, '_sfwd-quizzes', true );
		$usermeta = maybe_unserialize( $usermeta );
		
		$taken_quiz = array_column( $usermeta, 'quiz' );
		$key        = array_search( $quiz_id, $taken_quiz );
		if ( $key !== false && $usermeta[ $key ]['a_pass'] ) {
			return true;
		}
		
		return false;
	}
}

if ( !function_exists( 'FHS_Quiz_Retake_Course_UI' ) ) {
	function FHS_Quiz_Retake_Course_UI( $course_id, $user_id ){
		$course_status = learndash_course_status( $course_id, $user_ID );
		if( $course_status == __( 'Completed', 'learndash' ) ){
			return false;//course is completed, our job is done.
		}

		$show_ui = $has_quizzes = false;
		
		//get all quizzes for this course
		$quizzes = learndash_get_course_quiz_list( $course_id );

		if( !empty( $quizzes ) ){
			$has_quizzes = true;

			$usermeta = get_user_meta( $user_id, '_sfwd-quizzes', true );
			$usermeta = maybe_unserialize( $usermeta );

			//check if user has failed in all quizzes
			$has_failed_all = true;
			foreach( $quizzes as $quiz ){
				$quiz_id = $quiz['post']->ID;
				
				$quiz_taken = false;
				$quiz_passed = false;
				foreach( $usermeta as $umeta ){
					if( $umeta['quiz'] == $quiz_id ){
						$quiz_taken = true;
						$quiz_passed = $umeta['a_pass'];
						break;
					}
				}

				if( !$quiz_taken ){
					$has_failed_all = false;
					break;
				} else if( $quiz_passed ) {
					$has_failed_all = false;
					break;
				}
			}

			if( $has_failed_all ){
				$show_ui = true;
			}
		}

		if( $show_ui ){
			if( function_exists( 'fhs_certificates' ) ){
				$payment_buttons = fhs_certificates()->c->fhs_certificates_manager->learndash_payment_buttons( $course_id );
			} else {
				$payment_buttons = learndash_payment_buttons( $course_id );
			}
			
			echo "<div id='notice_quizz_failed_renew_course' style='background: #fbfbcd; padding: 6px 10px 1px;'><p>Exhausted all exam attempts? You can retake this course.</p><p>{$payment_buttons}</p></div>";
		}
	}
}

add_action( 'woocommerce_thankyou', 'fhs_auto_complete_paid_order', 20, 1 );
function fhs_auto_complete_paid_order( $order_id ) {
    if ( ! $order_id )
        return;

    // Get an instance of the WC_Product object
    $order = wc_get_order( $order_id );

    // No updated status for orders delivered with Bank wire, Cash on delivery and Cheque payment methods.
    if ( in_array( $order->get_payment_method(), array( 'bacs', 'cod', 'cheque' ) ) ) {
        return;
    // Updated status to "completed" for paid Orders with all others payment methods
    } else {
        $order->update_status( 'completed' );
    }
}