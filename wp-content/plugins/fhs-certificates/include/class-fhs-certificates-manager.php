<?php
if( !defined( 'ABSPATH' ) ){
    exit();
}

class FHS_Certificates_Manager {
	function __construct() {
        add_action( 'learndash_course_completed', array( $this, 'on_learndash_course_completed' ) );
        add_action( 'learndash_update_course_access', array( $this, 'force_update_access_time' ), 10, 4 );
        add_filter( 'learndash_post_args', array( $this, 'learndash_post_args' ) );
        
        add_action( 'init', array( $this, 'on_init' ) );
	}
    
    public function on_init(){
        add_shortcode( 'fhs_certificate_validity', array( $this, 'sc_handler__fhs_certificate_validity' ) );
    }
    
    public function learndash_post_args( $args ){
        //add admin settings
        $modified_fields = array();
        
        foreach( $args['sfwd-courses']['fields'] as $field_name => $props ){
            $modified_fields[$field_name] = $props;
            
            if( 'expire_access_days' == $field_name ){
                $modified_fields['advance_renewal_period'] = array(
                    'name' => __( 'Enable re-purchase before expiry (days)', 'learndash' ),
                    'type' => 'number',
                    'min' => '0',
                    'help_text' => __( 'Enter the number of days before the expiry, a user can re-purchase the course.', 'learndash' ),
                    'show_in_rest' => true,
                );

                $modified_fields['renewal_product_url'] = array(
                    'name' => __( 'Url for re-purchase', 'learndash' ),
                    'type' => 'text',
                    'help_text' => __( 'Enter the url user needs to go to re-purhcase the course. This can be a product url or a direct url to add the product to card.', 'learndash' ),
                    'show_in_rest' => true,
                );
            }
        }
        
        $args['sfwd-courses']['fields'] = $modified_fields;
        
        return $args;
    }
    
    public function on_learndash_course_completed( $data ){
        //insert a new certificate details in database.
        /* data is 
        array(
            'user' => $current_user, 
            'course' => get_post( $course_id ), 
            'progress' => $course_progress,
        ) 
        */
        
        global $wpdb;
        
        if( ! $data['user']->ID || ! $data['course']->ID ) {
            return false;
        }
        
        $certificate_id = learndash_get_setting( $data['course']->ID, 'certificate' );
        if ( empty( $certificate_id ) ) {
            return false;
        }
        
        $expire_access = learndash_get_setting( $data['course']->ID, 'expire_access' );
		// The value stored in the post meta for 'expire_access' is 'on' not true/false 1 or 0. The string 'on'.
		if ( empty( $expire_access ) ) {
            return false;
        }
        
        //certificate expires when course access expires.
        $expires = ld_course_access_expires_on( $data['course']->ID, $data['user']->ID );
        
        $wpdb->insert(
            $wpdb->prefix . 'fhs_certificates',
            array(
                'course_id' => $data['course']->ID,
                'user_id'=> $data['user']->ID,
                'date_added' => current_time( 'timestamp' ),
                'date_expiring' => $expires,
            ),
            array(
                '%d', '%d', '%d', '%d'
            )
        );
    }
    
    public function force_update_access_time( $user_id, $course_id, $access_list, $remove ){
        if( empty( $remove ) ){
            $user_course_access_time = time();
            update_user_meta( $user_id, "course_". $course_id ."_access_from", $user_course_access_time );
            
            //also remove all progress for this course
			$delete_course_progress = learndash_get_setting( $course_id, 'expire_access_delete_progress' );
			if ( ! empty( $delete_course_progress ) ) {
                /**
                 * Quiz locks are not getting reset automatically upon calling learndash_delete_course_progress.
                 * So we need to do that ourselves.
                 */
                $this->remove_user_quiz_locks( $course_id, $user_id );
				learndash_delete_course_progress( $course_id, $user_id );
                delete_user_meta( $user_id, 'course_completed_' . $course_id );
			}
        }
    }

    public function remove_user_quiz_locks( $course_id, $user_id ){
        $quizzes = array();
        $usermeta_quizzes = get_user_meta( $user_id, '_sfwd-quizzes', true );
        if ( !is_array( $usermeta_quizzes ) ) $usermeta_quizzes = array();
        if ( !empty( $usermeta_quizzes ) ) {
            foreach( $usermeta_quizzes as $quiz_item ) {
                if ( ( isset( $quiz_item['course'] ) ) && ( intval( $course_id ) == intval( $quiz_item['course'] ) ) ) {
                    if ( isset( $quiz_item['quiz'] ) ) {
                        $quiz_id = intval( $quiz_item['quiz'] ); 

                        //get quiz pro id for this quiz
                        $quiz_data = get_post_meta( $quiz_id, '_sfwd-quiz', true );
                        if( !empty( $quiz_data ) && isset( $quiz_data[ 'sfwd-quiz_quiz_pro' ] ) ){
                            $quiz_pro_id = absint( $quiz_data[ 'sfwd-quiz_quiz_pro' ] );
                            if( $quiz_pro_id ){
                                $quizzes[$quiz_pro_id] = $quiz_pro_id;   
                            }
                        }   
                    }
                }
            }
        }

        if ( !empty( $quizzes ) ) {
            global $wpdb;

            foreach ( $quizzes as $quiz_id ) {
                $sql = $wpdb->prepare(  
                        "DELETE FROM {$wpdb->prefix}wp_pro_quiz_lock WHERE quiz_id = %d AND user_id = %d ",
                        $quiz_id, $user_id
                );
                $wpdb->query( $sql );
            }
        }
    }
    
    public function print_certificates_list( $course_id, $user_id ){
        $certificate_id = learndash_get_setting( $course_id, 'certificate' );
        if ( empty( $certificate_id ) ) {
            return false;
        }
        
        global $wpdb;
        $entries = $wpdb->get_results( $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}fhs_certificates WHERE course_id = %d AND user_id = %d ORDER BY id ASC",
            $course_id, $user_id
        ) );
            
        if( !empty( $entries ) && !is_wp_error( $entries ) ) {
            if( count( $entries ) > 1 ){
                echo "<h3>Certificates</h3>";
            } else {
                echo "<h3>Certificate</h3>";
            }
            
            echo "<table class='table certificates_list'>";
            echo "<thead><tr><th></th><th>Title</th><th>Validity</th><th></th></tr></thead>";
            echo "<tbody>";
            
            $certificate_title = get_the_title( $certificate_id );
            $date_format = get_option( 'date_format' );
            
            $counter = 1;
            foreach( $entries as $key => $entry ){
                echo "<tr id='entry-{$entry->id}'>";
                echo "<th>#{$counter}</th>";
                echo "<th>$certificate_title</th>";
                
                
                echo "<th>". sprintf( "%s - %s", date( $date_format, $entry->date_added ), date( $date_format, $entry->date_expiring ) ) ."</th>";
                
                $link = add_query_arg( array( 'cr' => $entry->course_id ,'ci' => $entry->id ),learndash_get_course_certificate_link( $course_id, $user_id ) );
                echo "<th><a href='{$link}' target='_blank'>Print Certificate</a></th>";
                echo "</tr>";
                
                $counter++;
            }
            
            echo "</tbody>";
            echo "</table>";
        }
        
        $course_access_expires_on_ts = ld_course_access_expires_on( $course_id, $user_id );
        $remaining = $course_access_expires_on_ts - current_time( 'timestamp' );
        $limit_days = learndash_get_setting( $course_id, 'advance_renewal_period' );
        if( $remaining > 0 && $limit_days ){
            $course_access_expires_in_days = ceil( $remaining / DAY_IN_SECONDS );
            if( $course_access_expires_in_days <= $limit_days ){
                $payment_buttons = $this->learndash_payment_buttons( $course_id );
                if( !empty( $entries ) && !is_wp_error( $entries ) ) {
                    echo "<div id='notice_cert_renew_advance' style='background: #fbfbcd; padding: 6px 10px 1px;'><p>Your certificate is expiring in {$course_access_expires_in_days} day(s). You can renew your access to the course in advance to be able to renew your certificate.</p><p>{$payment_buttons}</p></div>";
                } else {
                    echo "<div id='notice_cert_renew_advance' style='background: #fbfbcd; padding: 6px 10px 1px;'><p>Your access to the course is expiring in {$course_access_expires_in_days} day(s). You can renew your access to the course in advance to be able to have continued access.</p><p>{$payment_buttons}</p></div>";
                }
            }
        }
    }
    
    public function sc_handler__fhs_certificate_validity( $atts ){
        $atts = shortcode_atts( array(
            'type' => 'end',
        ), $atts, 'fhs_certificate_validity' );

        global $post, $wpdb;
        
        $course_id = isset( $_GET['cr'] ) && !empty( $_GET['cr'] ) ? absint( $_GET['cr'] ) : false;
        $entry_id = isset( $_GET['ci'] ) && !empty( $_GET['ci'] ) ? absint( $_GET['ci'] ) : false;
        
        if( empty( $course_id ) || empty( $entry_id ) ){
            return '';
        }
        
        $entry = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}fhs_certificates WHERE id = %d", $entry_id ) );
        if( empty( $entry ) || is_wp_error( $entry ) ){
            return '';
        }
        
        if( $entry->user_id != get_current_user_id() || $entry->course_id != $course_id ){
            return '';
        }
        
        $timestamp = $atts['type'] == 'end' ? $entry->date_expiring : $entry->date_added;
        
        return date( get_option( 'date_format' ), $timestamp );
    }
    
    public function learndash_payment_buttons( $course ){
        if ( is_numeric( $course ) ) {
            $course_id = $course;
            $course = get_post( $course_id );
        } else if ( ! empty( $course->ID ) ) {
            $course_id = $course->ID;
        } else {
            return '';
        }

        $renewal_product_url = learndash_get_setting( $course_id, 'renewal_product_url' );
        if( !empty( $renewal_product_url ) ){
            return "<a class='btn-join btn btn-default' href='". esc_attr( $renewal_product_url ) ."'>Take this course</a>";
        }

        return "";
    }

    public function learndash_payment_buttons_old( $course ) {

        if ( is_numeric( $course ) ) {
            $course_id = $course;
            $course = get_post( $course_id );
        } else if ( ! empty( $course->ID ) ) {
            $course_id = $course->ID;
        } else {
            return '';
        }

        $user_id = get_current_user_id();

        if ( $course->post_type != 'sfwd-courses' ) {
            return '';
        }
        
        $meta = get_post_meta( $course_id, '_sfwd-courses', true );
        $course_price_type = @$meta['sfwd-courses_course_price_type'];
        $course_price = @$meta['sfwd-courses_course_price'];
        $course_no_of_cycles = @$meta['sfwd-courses_course_no_of_cycles'];
        $course_price = @$meta['sfwd-courses_course_price'];
        $custom_button_url = @$meta['sfwd-courses_custom_button_url'];

        // format the Course price to be proper XXX.YY no leading dollar signs or other values. 
        if (( $course_price_type == 'paynow' ) || ( $course_price_type == 'subscribe' )) {
            if ( $course_price != '' ) {
                $course_price = preg_replace( "/[^0-9.]/", '', $course_price );
                $course_price = number_format( floatval( $course_price ), 2, '.', '' );
            }
        }

        //$courses_options = learndash_get_option( 'sfwd-courses' );

        //if ( ! empty( $courses_options ) ) {
        //	extract( $courses_options );
        //}

        $paypal_settings = LearnDash_Settings_Section::get_section_settings_all( 'LearnDash_Settings_Section_PayPal' );
        if ( ! empty( $paypal_settings ) ) {
            $paypal_settings['paypal_sandbox'] = $paypal_settings['paypal_sandbox'] == 'yes' ? 1 : 0;
        }

        $button_text = LearnDash_Custom_Label::get_label( 'button_take_this_course' );

        if ( ! empty( $course_price_type ) && $course_price_type == 'closed' ) {

            if ( empty( $custom_button_url) ) {
                $custom_button = '';
            } else {
                if ( ! strpos( $custom_button_url, '://' ) ) {
                    $custom_button_url = 'http://'.$custom_button_url;
                }

                $custom_button = '<a class="btn-join" href="'.$custom_button_url.'" id="btn-join">'. $button_text .'</a>';
            }

            $payment_params = array(
                'custom_button_url' => $custom_button_url,
                'post' => $course
            );

            /**
             * Filter a closed course payment button
             * 
             * @since 2.1.0
             * 
             * @param  string  $custom_button       
             */
            return 	apply_filters( 'learndash_payment_closed_button', $custom_button, $payment_params );

        } else if ( ! empty( $course_price ) ) {
            include_once( LEARNDASH_LMS_PLUGIN_DIR . 'includes/vendor/paypal/enhanced-paypal-shortcodes.php' );

            $paypal_button = '';

            if ( ! empty( $paypal_settings['paypal_email'] ) ) {

                $post_title = str_replace(array('[', ']'), array('', ''), $course->post_title);

                if ( empty( $course_price_type ) || $course_price_type == 'paynow' ) {
                    $shortcode_content = do_shortcode( '[paypal type="paynow" amount="'. $course_price .'" sandbox="'. $paypal_settings['paypal_sandbox'] .'" email="'. $paypal_settings['paypal_email'] .'" itemno="'. $course->ID .'" name="'. $post_title .'" noshipping="1" nonote="1" qty="1" currencycode="'. $paypal_settings['paypal_currency'] .'" rm="2" notifyurl="'. $paypal_settings['paypal_notifyurl'] .'" returnurl="'. $paypal_settings['paypal_returnurl'] .'" cancelurl="'. $paypal_settings['paypal_cancelurl'] .'" imagewidth="100px" pagestyle="paypal" lc="'. $paypal_settings['paypal_country'] .'" cbt="'. __( 'Complete Your Purchase', 'learndash' ) . '" custom="'. $user_id. '"]' );
                    if (!empty( $shortcode_content ) ) {
                        $paypal_button = wptexturize( '<div class="learndash_checkout_button learndash_paypal_button">'. $shortcode_content .'</div>');
                    }

                } else if ( $course_price_type == 'subscribe' ) {
                    $course_price_billing_p3 = get_post_meta( $course_id, 'course_price_billing_p3',  true );
                    $course_price_billing_t3 = get_post_meta( $course_id, 'course_price_billing_t3',  true );
                    $srt = intval( $course_no_of_cycles );

                    $shortcode_content = do_shortcode( '[paypal type="subscribe" a3="'. $course_price .'" p3="'. $course_price_billing_p3 .'" t3="'. $course_price_billing_t3 .'" sandbox="'. $paypal_settings['paypal_sandbox'] .'" email="'. $paypal_settings['paypal_email'] .'" itemno="'. $course->ID .'" name="'. $post_title .'" noshipping="1" nonote="1" qty="1" currencycode="'. $paypal_settings['paypal_currency'] .'" rm="2" notifyurl="'. $paypal_settings['paypal_notifyurl'] .'" cancelurl="'. $paypal_settings['paypal_cancelurl'] .'" returnurl="'. $paypal_settings['paypal_returnurl'] .'" imagewidth="100px" pagestyle="paypal" lc="'. $paypal_settings['paypal_country'] .'" cbt="'. __( 'Complete Your Purchase', 'learndash' ) .'" custom="'. $user_id .'" srt="'. $srt .'"]' );

                    if (!empty( $shortcode_content ) ) {
                        $paypal_button = wptexturize( '<div class="learndash_checkout_button learndash_paypal_button">'. $shortcode_content .'</div>' );
                    }
                }
            }

            $payment_params = array(
                'price' => $course_price,
                'post' => $course,
            );

            /**
             * Filter PayPal payment button
             * 
             * @since 2.1.0
             * 
             * @param  string  $paypal_button
             */
            $payment_buttons = apply_filters( 'learndash_payment_button', $paypal_button, $payment_params );

            if ( ! empty( $payment_buttons ) ) {

                if ( ( !empty( $paypal_button ) ) && ( $payment_buttons != $paypal_button ) ) {

                    $button = 	'';
                    $button .= 	'<div id="learndash_checkout_buttons_course_'. $course->ID .'" class="learndash_checkout_buttons">';
                    $button .= 		'<input id="btn-join-'. $course->ID .'" class="btn-join btn-join-'. $course->ID .' button learndash_checkout_button" data-jq-dropdown="#jq-dropdown-'. $course->ID .'" type="button" value="'. $button_text .'" />';
                    $button .= 	'</div>';

                    global $dropdown_button;
                    $dropdown_button .= 	'<div id="jq-dropdown-'. $course->ID .'" class="jq-dropdown jq-dropdown-tip checkout-dropdown-button">';
                    $dropdown_button .= 		'<ul class="jq-dropdown-menu">';
                    $dropdown_button .= 		'<li>';
                    $dropdown_button .= 			str_replace($button_text, __('Use Paypal', 'learndash'), $payment_buttons);
                    $dropdown_button .= 		'</li>';
                    $dropdown_button .= 		'</ul>';
                    $dropdown_button .= 	'</div>';

                    return apply_filters( 'learndash_dropdown_payment_button', $button );

                } else {
                    return	'<div id="learndash_checkout_buttons_course_'. $course->ID .'" class="learndash_checkout_buttons">'. $payment_buttons .'</div>';
                }
            }
        } else {
            $join_button = '<div class="learndash_join_button"><form method="post">
                                <input type="hidden" value="'. $course->ID .'" name="course_id" />
                                <input type="hidden" name="course_join" value="'. wp_create_nonce( 'course_join_'. get_current_user_id() .'_'. $course->ID ) .'" />
                                <input type="submit" value="'.$button_text.'" class="btn-join" id="btn-join" />
                            </form></div>';

            $payment_params = array( 
                'price' => '0', 
                'post' => $course, 
                'course_price_type' => $course_price_type 
            );

            /**
             * Filter Join payment button
             * 
             * @since 2.1.0
             * 
             * @param  string  $join_button
             */
            $payment_buttons = apply_filters( 'learndash_payment_button', $join_button, $payment_params );
            return $payment_buttons;
        }

    }
}