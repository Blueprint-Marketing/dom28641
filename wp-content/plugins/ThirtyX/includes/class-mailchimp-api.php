<?php
/**
* MailChimp API Connection Class
*/
class Pmill_Mailchimp_Api
{
	private $parameters;

	function __construct( $parameters = array() )
	{
		foreach ($parameters as $key => $value) {
			$this->$key = $value;
		}
		$this->mc_key = ( isset( $this->email_services['mc']['mc_key'] ) ) ? $this->email_services['mc']['mc_key'] : '' ;
		$this->dc = ( isset( $this->email_services['mc']['mc_key'] ) ) ? explode( '-', $this->mc_key ) : array() ;
		$this->mc_api_base = ( !empty( $this->dc ) ) ? 'https://'.$this->dc[1].'.api.mailchimp.com/3.0/' : '' ;
	}

	public function key_fields() {
		if( !empty( $mc_key ) ) { ?>
			<div id="mc_authorized">
				<span class="dashicons dashicons-yes"></span> <?php _e( 'MailChimp account connected.', 'pm-thirtyx' ); ?> 
				<label><input id="service_deauthorize" type="checkbox" name="<?php echo $this->email_services['mc']['opt_name']; ?>[mc][mc_deauth]" data-service="mc" value="1"> <?php _e( 'Deauthorize', 'pm-thirtyx' ); ?></label>
			</div>
			<?php } ?>
			<div id="mc_unauthorized">
				<p><?php _e( 'Enter your MailChimp API Key', 'pm-thirtyx' ); ?></p>
				<input id="mc_key" class="large-text" type="password" name="<?php echo $this->email_services['mc']['opt_name']; ?>[mc][mc_key]">
			</div>
		<?php
	}

	public function get_lists() {
		$args = array(
		'headers' => array(
			'Authorization' => 'Basic '. base64_encode( 'api:'.$this->mc_key),
			)
		);
		$get = wp_remote_get( $this->mc_api_base.'lists', $args );
		$response = json_decode( wp_remote_retrieve_body( $get ) );
		return $response->lists;
	}

	public function add_subscriber( $name, $email, $gateID, $ip_address ) {
		$list_id = stripslashes( $this->add[$gateID]['mailchimp_list'] );
		$url = $this->mc_api_base.'lists/'.$list_id.'/members';
		$thanks_msg = $this->add[$gateID]['thanks_msg'];
		$already_subbed = $this->add[$gateID]['already_sub_msg'];

		$data = json_encode( array(
			'email_address' => $email,
			'ip_signup' => $ip_address,
			'status' => 'subscribed',
			'merge_fields' => array(
				'FNAME' => $name
				)
			));

		$args = array(
			'headers' => array(
				'Authorization' => 'Basic '. base64_encode( 'api:'.$this->mc_key ),
				'content-type' => 'application/json',
				),
			'body' => $data
			);
		$post = wp_remote_post( $url, $args );

		return $this->return_response( $post, $thanks_msg, $already_subbed );
		
	}

	private function return_response( $post, $thanks_msg, $already_subbed ) {
		if( is_wp_error( $post ) ) {
			$error_message = $post->get_error_message();
			return $error_message;
		} else {
			$response = json_decode( $post['body'] );

			if( $response->status === 'subscribed' ) {
				return $thanks_msg;
			} elseif( $response->status === 401 ) {
				return __("Oops! Error $response->status. $response->title. $response->detail Please report to the site owner.", 'pm-thirtyx' );
			} elseif( $response->status === 400 ) {
				if( $response->title == 'Invalid Resource' ) {
					return __( "Oops! Error $response->status. $response->title. $response->detail", 'pm-thirtyx' );
				} elseif( $response->title == 'Member Exists' ) {
					return $already_subbed;
				}
			}
		}
	}
}