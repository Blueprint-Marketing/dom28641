<?php
/**
* Plugin Name: Connects - ConvertKit Addon
* Plugin URI: 
* Description: Use this plugin to integrate ConvertKit with Connects.
* Version: 2.2.0
* Author: Brainstorm Force
* Author URI: https://www.brainstormforce.com/
* License: http://themeforest.net/licenses
*/

if(!class_exists('Smile_Mailer_Convertkit')){

	class Smile_Mailer_Convertkit{
	
		//Class variables
		private $slug;
		private $setting;
		
		/*
		 * Function Name: __construct
		 * Function Description: Constructor
		 */
		
		function __construct(){
			add_action( 'wp_ajax_get_convertkit_data', array($this,'get_convertkit_data' ));
			add_action( 'wp_ajax_update_convertkit_authentication', array($this,'update_convertkit_authentication' ));
			add_action( 'admin_init', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_ajax_disconnect_convertkit', array($this,'disconnect_convertkit' ));
			add_action( 'wp_ajax_convertkit_add_subscriber', array($this,'convertkit_add_subscriber' ));
			add_action( 'wp_ajax_nopriv_convertkit_add_subscriber', array($this,'convertkit_add_subscriber' ));
			$this->setting  = array(
				'name' => 'ConvertKit',
				'parameters' => array(),
				'where_to_find_url' => 'https://cloudup.com/cAZGvEtMLlR',
				'logo_url' => plugins_url('images/logo.png', __FILE__)
			);
			$this->slug = 'convertkit';

			$this->api_url = 'https://api.convertkit.com/v3/';
		}
		
		
		/*
		 * Function Name: enqueue_scripts
		 * Function Description: Add custon scripts
		 */
		
		function enqueue_scripts() {
			if( function_exists( 'cp_register_addon' ) ) {
				cp_register_addon( $this->slug, $this->setting );
			}
			wp_register_script( $this->slug.'-script', plugins_url('js/'.$this->slug.'-script.js', __FILE__), array('jquery'), '1.1', true );
			wp_enqueue_script( $this->slug.'-script' );
			add_action( 'admin_head', array( $this, 'hook_css' ) );
		}


		/*
		 * Function Name: hook_css
		 * Function Description: Adds background style script for mailer logo.
		 */


		function hook_css() {
			if( isset( $this->setting['logo_url'] ) ) {
				if( $this->setting['logo_url'] != '' ) {
					$style = '<style>table.bsf-connect-optins td.column-provider.'.$this->slug.'::after {background-image: url("'.$this->setting['logo_url'].'");}.bend-heading-section.bsf-connect-list-header .bend-head-logo.'.$this->slug.'::before {background-image: url("'.$this->setting['logo_url'].'");}</style>';
					echo $style;
				}
			}
			
		}
		
		
		/*
		 * Function Name: get_convertkit_data
		 * Function Description: Get convertkit input fields
		 */
		 
		function get_convertkit_data() {

			if ( ! current_user_can( 'access_cp' ) ) {
                die(-1);
            }

			$isKeyChanged = false;

			$connected = false;
			ob_start();

			$convertkit_api = get_option($this->slug.'_api_key');

            if( $convertkit_api != '' ) {

            	$res = wp_remote_get( $this->api_url . 'forms?api_key=' . $convertkit_api );
				if( $res['response']['code'] == 200 ) {
					$formstyle = 'style="display:none;"';
				} else {
					$formstyle = '';
					$isKeyChanged = true;
				}
            } else {
            	$formstyle = '';
            }
            ?>
			<div class="bsf-cnlist-form-row" <?php echo $formstyle; ?>>
				<label for="cp-list-name" ><?php _e( $this->setting['name'] . " API Key", "smile" ); ?></label>
            	<input type="text" autocomplete="off" id="<?php echo $this->slug; ?>_api_key" name="<?php echo $this->slug; ?>_api_key" value="<?php echo esc_attr( $convertkit_api ); ?>"/>
	        </div>

            <div class="bsf-cnlist-form-row <?php echo $this->slug; ?>-list">
	            <?php
	            if( $convertkit_api != '' && !$isKeyChanged ) {
		            $convertkit_lists = $this->get_convertkit_lists( $convertkit_api );

					if( !empty( $convertkit_lists ) ){
						$connected = true;
					?>
					<label for="<?php echo $this->slug; ?>-list"><?php echo __( "Select List", "smile" ); ?></label>
					<select id="<?php echo $this->slug; ?>-list" class="bsf-cnlist-select" name="<?php echo $this->slug; ?>-list">
					<?php
						foreach($convertkit_lists as $id => $name) {
					?>
						<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
					<?php
						}
					?>
					</select>
					<?php
					} else {
					?>
						<label for="<?php echo $this->slug; ?>-list"><?php echo __( "You need at least one list added in " . $this->setting['name'] . " before proceeding.", "smile" ); ?></label>
					<?php
					}
				}
	            ?>
            </div>

            <div class="bsf-cnlist-form-row">
            	<?php if( $convertkit_api == "" ) { ?>
	            	<button id="auth-<?php echo $this->slug; ?>" class="button button-secondary auth-button" disabled><?php _e( "Authenticate " . $this->setting['name'], "smile" ); ?></button><span class="spinner" style="float: none;"></span>
	            <?php } else {
	            		if( $isKeyChanged ) {
	            ?>
	            	<div id="update-<?php echo $this->slug; ?>" class="update-mailer" data-mailerslug="<?php echo $this->setting['name']; ?>" data-mailer="<?php echo $this->slug; ?>"><span><?php _e( "Your credentials seems to be changed.</br>Use different '" . $this->setting['name'] . "' credentials?", "smile" ); ?></span></div><span class="spinner" style="float: none;"></span>
	            <?php
	            		} else {
	            ?>
	            	<div id="disconnect-<?php echo $this->slug; ?>" class="button button-secondary" data-mailerslug="<?php echo $this->setting['name']; ?>" data-mailer="<?php echo $this->slug; ?>"><span><?php _e( "Use different '" . $this->setting['name'] . "' account?", "smile" ); ?></span></div><span class="spinner" style="float: none;"></span>
	            <?php
	            		}
	            ?>
	            <?php } ?>
	        </div>

            <?php
            $content = ob_get_clean();

            $result['data'] = $content;
            $result['helplink'] = $this->setting['where_to_find_url'];
            $result['isconnected'] = $connected;
            echo json_encode($result);
            exit();
        }
		
		
		/*
		 * Function Name: update_convertkit_authentication
		 * Function Description: Update convertkit values to ConvertPlug
		 */
		
		function update_convertkit_authentication() {

			if ( ! current_user_can( 'access_cp' ) ) {
                die(-1);
            }

			$post = $_POST;
			
			$data = array();
			$convertkit_api = sanitize_text_field( $post['convertkit_api_key'] );

			if( $convertkit_api == "" ) {
				print_r(json_encode(array(
					'status' => "error",
					'message' => __( "Please provide valid API Key for your " . $this->setting['name'] . " account.", "smile" )
				)));
				exit();
			}
			ob_start();

			$res = wp_remote_get( $this->api_url . 'forms?api_key=' . $convertkit_api );
			if( !is_wp_error($res) && $res['response']['code'] == 200 ) {
				$campaigns = json_decode( wp_remote_retrieve_body( $res ) );

				if( $campaigns == '' ) {
					 print_r(json_encode(array(
	                    'status' => "error",
	                    'message' => __( "You have zero lists in your " . $this->setting['name'] . " account. You must have at least one list before integration." , "smile" )
	                )));
	                exit();
				}

				if( $campaigns != '' ) {
					$query = '';
				?>
				<label for="<?php echo $this->slug; ?>-list">Select List</label>
				<select id="<?php echo $this->slug; ?>-list" class="bsf-cnlist-select" name="<?php echo $this->slug; ?>-list">
				<?php
					foreach ($campaigns->forms as $key => $cm) {
						$query .= $cm->id.'|'.$cm->name.',';
						$convertkit_lists[$cm->id] = $cm->name;
				?>
					<option value="<?php echo $cm->id; ?>"><?php echo $cm->name; ?></option>
				<?php
					}
				?>
				</select>
				<input type="hidden" id="mailer-all-lists" value="<?php echo $query; ?>"/>
				<input type="hidden" id="mailer-list-action" value="update_<?php echo $this->slug; ?>_list"/>
				<input type="hidden" id="mailer-list-api" value="<?php echo $convertkit_api; ?>"/>
				<div class="bsf-cnlist-form-row">
					<div id="disconnect-<?php echo $this->slug; ?>" class="" data-mailerslug="<?php echo $this->setting['name']; ?>" data-mailer="<?php echo $this->slug; ?>">
						<span>
							<?php _e( "Use different '" . $this->setting['name'] . "' account?", "smile" ); ?>
						</span>
					</div>
					<span class="spinner" style="float: none;"></span>
				</div>
				<?php
				} else {
				?>
					<label for="<?php echo $this->slug; ?>-list"><?php echo __( "You need at least one list added in " . $this->setting['name'] . " before proceeding.", "smile" ); ?></label>
				<?php
				}
			} else {
				print_r(json_encode(array(
					'status' => "error",
					'message' => "Something went wrong!"
				)));
				exit();
			}
			
			$html = ob_get_clean();

			update_option( $this->slug.'_api_key', $convertkit_api );
			update_option( $this->slug.'_lists', $convertkit_lists );

			print_r(json_encode(array(
				'status' => "success",
				'message' => $html
			)));

			exit();
		}


		/*
		 * Function Name: convertkit_add_subscriber
		 * Function Description: Add subscriber
		 */
		
		function convertkit_add_subscriber() {
			$ret = true;
			$email_status = false;

			$style_id = isset( $_POST['style_id'] ) ? esc_attr( $_POST['style_id'] ) : '';
           	
           	if( $style_id !=='' ){
                check_ajax_referer( 'cp-submit-form-'.$style_id );
            }

            $contact = array_map( 'sanitize_text_field', wp_unslash( $_POST['param'] ) );

          	$contact['source'] = ( isset( $_POST['source'] ) ) ? esc_attr( $_POST['source'] ) : '';

            $msg = isset( $_POST['message'] ) ? $_POST['message'] : __( 'Thanks for subscribing. Please check your mail and confirm the subscription.', 'smile' );

            if ( is_user_logged_in() && current_user_can( 'access_cp' ) ) {
                $default_error_msg = __( 'THERE APPEARS TO BE AN ERROR WITH THE CONFIGURATION.', 'smile' );
            } else {
                $default_error_msg = __( 'THERE WAS AN ISSUE WITH YOUR REQUEST. Administrator has been notified already!', 'smile' );
            }

			$convertkit_api_key = get_option( 'convertkit_api_key' );
			$convertkit_list_id = isset( $_POST['list_id'] ) ? esc_attr( $_POST['list_id'] ) : '';
				
			$email = sanitize_email( $contact['email'] );
			//	Check Email in MX records
			if( isset( $email ) ) {
                $email_status = ( !( isset( $_POST['only_conversion'] ) ? true : false ) ) ? apply_filters('cp_valid_mx_email', $email ) : false;
            }

			if( $email_status ) {
				if( function_exists( "cp_add_subscriber_contact" ) ){
					$option = isset( $_POST['option'] ) ? $_POST['option'] : '';
					$isuserupdated = cp_add_subscriber_contact( $option , $contact );
				}

				if ( !$isuserupdated ) {  // if user is updated dont count as a conversion
					// update conversions 
					smile_update_conversions($style_id);
				}
				if( isset( $email ) ) {
					$status = 'success';
					$errorMsg =  '';
					$ch = curl_init( $this->api_url . 'forms/' . $convertkit_list_id . '/subscribe?api_key=' . $convertkit_api_key );

					$custom_fields = array();
                    unset( $contact['source'] );
                    unset( $contact['user_id'] );
                    unset( $contact['date'] );

                    $default_fields = array(
                    	'email',
                    	'first_name',
                    	'name',
                    	'tags',
                    	'forms'
                    );

                    if( is_array($contact) && !empty($contact) ) {
	                    foreach( $contact as $key => $p ) {
	                        if( !in_array( $key, $default_fields ) ) {
	                            $custom_fields[$key] = $p;
	                        }
	                    }
	                }

					$post_fields = http_build_query( 
						array( 
							'email' => $email, 
							'name' => isset( $contact['name'] ) ? esc_attr( $contact['name'] ) : '',
							'fields' => $custom_fields 
						) 
					);

					curl_setopt( $ch, CURLOPT_POST, 2 );
					curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_fields );
					curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

					$response = curl_exec($ch);
					$http_response_error = curl_error($ch);

					if( $http_response_error != '' )  {
						if( isset( $_POST['source'] ) ) {
			        		return false;
			        	} else {
			        		//var_dump($http_response_error);
			        		if(strpos($http_response_error, '404')){
			        			$errorMsg =  __('ListId is not present', 'smile' );
			        		}else{
			        			$errorMsg = $http_response_error;
			        		}

			        		if ( is_user_logged_in() && current_user_can( 'access_cp' ) ) {
				                $detailed_msg = $errorMsg;
				            } else {
				                $detailed_msg = '';
				            }
				            if( $detailed_msg !== '' & $detailed_msg !== null ) {
				                $page_url = isset( $_POST['cp-page-url'] ) ? esc_url( $_POST['cp-page-url'] ) : '';

				                // notify error message to admin
				                if( function_exists('cp_notify_error_to_admin') ) {
				                    $result   = cp_notify_error_to_admin($page_url);
				                }
				            }
			        		
			        		print_r(json_encode(array(
								'action' => ( isset( $_POST['message'] ) ) ? 'message' : 'redirect',
								'email_status' => $email_status,
								'status' => 'error',
								'message' => $default_error_msg,
								'detailed_msg' => $detailed_msg,
								'url' => ( isset( $_POST['message'] ) ) ? 'none' : esc_url( $_POST['redirect'] ),
							)));
							exit();
			        	}
							
					}
				}
				
			} else {
				if( isset( $_POST['only_conversion'] ) ? true : false ){
					// update conversions 
					$status = 'success';
					smile_update_conversions( $style_id );
					$ret = true;
				} else if( isset( $email ) ) {
                    $msg = ( isset( $_POST['msg_wrong_email'] ) && $_POST['msg_wrong_email'] !== '' ) ? $_POST['msg_wrong_email'] : __( 'Please enter correct email address.', 'smile' );
                    $status = 'error';
                    $ret = false;
                } else if( !isset( $email ) ) {
                    //$msg = __( 'Something went wrong. Please try again.', 'smile' );
                    $msg  = $default_error_msg;
                    $errorMsg = __( 'Email field is mandatory to set in form.', 'smile' );
                    $status = 'error';
                }
			}

			if ( is_user_logged_in() && current_user_can( 'access_cp' ) ) {
                $detailed_msg = $errorMsg;
            } else {
                $detailed_msg = '';
            }

            if( $detailed_msg !== '' & $detailed_msg !== null ) {
                $page_url = isset( $_POST['cp-page-url'] ) ? esc_url( $_POST['cp-page-url'] ) : '';

                // notify error message to admin
                if( function_exists('cp_notify_error_to_admin') ) {
                    $result   = cp_notify_error_to_admin($page_url);
                }
            }

			if( isset( $_POST['source'] ) ) {
        		return $ret;
        	} else {
        		print_r(json_encode(array(
					'action' => ( isset( $_POST['message'] ) ) ? 'message' : 'redirect',
					'email_status' => $email_status,
					'status' => $status,
					'message' => $msg,
					'detailed_msg' => $detailed_msg,
					'url' => ( isset( $_POST['message'] ) ) ? 'none' : esc_url( $_POST['redirect'] ),
				)));
				exit();
        	}
		}
		
		
		/*
		 * Function Name: disconnect_convertkit
		 * Function Description: Disconnect current ConvertKit from wp instance
		 */
		
		function disconnect_convertkit() {

			if ( ! current_user_can( 'access_cp' ) ) {
                die(-1);
            }

			delete_option( 'convertkit_api_key' );
			delete_option( 'convertkit_username' );
			delete_option( 'convertkit_password' );
						
			$smile_lists = get_option('smile_lists');			
			if( !empty( $smile_lists ) ){ 
				foreach( $smile_lists as $key => $list ) {
					$provider = $list['list-provider'];
					if( strtolower( $provider ) == strtolower( $this->slug ) ){
						$smile_lists[$key]['list-provider'] = "Convert Plug";
						$contacts_option = "cp_" . $this->slug . "_" . preg_replace( '#[ _]+#', '_', strtolower( $list['list-name'] ) );
                        $contact_list = get_option( $contacts_option );
                        $deleted = delete_option( $contacts_option );
                        $status = update_option( "cp_connects_" . preg_replace( '#[ _]+#', '_', strtolower( $list['list-name'] ) ), $contact_list );
					}
				}
				update_option( 'smile_lists', $smile_lists );
			}			
			
			print_r(json_encode(array(
                'message' => "disconnected",
			)));
			exit();
		}


		/*
		 * Function Name: get_convertkit_lists
		 * Function Description: Get ConvertKit Mailer Campaign list
		 */

		function get_convertkit_lists( $convertkit_api = '' ) {
			if( $convertkit_api != '' ) {

				$res = wp_remote_get( $this->api_url . 'forms?api_key=' . $convertkit_api );
	        	if( $res['response']['code'] == 200 ) {
					$campaigns = json_decode( wp_remote_retrieve_body( $res ) );
					$lists = array();
					foreach($campaigns->forms as $offset => $cm) {
						$lists[$cm->id] = $cm->name;
					}
					return $lists;
				} else {
					return array();
				}
			} else {
				return array();
			}
		}
	}
	new Smile_Mailer_Convertkit;	
}
?>