<?php
/**
* Aweber API Connection
*/
class Pmill_Aweber_Api
{
	private $parameters;
	
	function __construct( $parameters = array() )
	{
		foreach ($parameters as $key => $value) {
			$this->$key = $value;
		}
		$this->aweber_api_base = 'https://api.aweber.com/1.0';
		$this->load_dependencies();
	}

private function load_dependencies() {
	// Include Aweber Library
	require_once plugin_dir_path( dirname( __FILE__ ) ). 'vendor/aweber_api/aweber_api.php';
}

public function authorization_link() {
	?>
	<a href="https://auth.aweber.com/1.0/oauth/authorize_app/<?php echo wp_strip_all_tags( $this->email_services['aw']['app_id'] ); ?>" target="_new"><?php _e('Click to get authorization code', 'pm-thirtyx'); ?></a>
	<?php
}

public function authorization_fields() { ?>
	<p>Step 1: <?php $this->authorization_link(); ?></p>
	<p>Step 2: Enter authorization code in this field</p>
	<input type="text" id="aweber_auth_code" class="large-text" name="<?php echo $this->email_services['aw']['opt_name']; ?>[aw][aweber_auth_code]">
	<div id="AWCreds"></div>
	<input id="aw_consumerKey" class="pm_thirtyx_hidden" type="text" name="<?php echo $this->email_services['aw']['opt_name']; ?>[aw][aw_consumerKey]">
	<input id="aw_consumerSecret" class="pm_thirtyx_hidden" type="text" name="<?php echo $this->email_services['aw']['opt_name']; ?>[aw][aw_consumerSecret]">
	<input id="aw_accessKey" class="pm_thirtyx_hidden" type="text" name="<?php echo $this->email_services['aw']['opt_name']; ?>[aw][aw_accessKey]">
	<input id="aw_accessSecret" class="pm_thirtyx_hidden" type="text" name="<?php echo $this->email_services['aw']['opt_name']; ?>[aw][aw_accessSecret]">
<?php
}

// Connect to Aweber to get credentials
public function connect_get_keys() {
	$auth_code = stripslashes( $_POST['aw_code'] );
	
	try {
	$credentials = AWeberAPI::getDataFromAweberID($auth_code);

	$returned_keys = array(
		'aw_consumerKey' => $credentials['0'],
		'aw_consumerSecret' => $credentials['1'],
		'aw_accessKey' => $credentials['2'],
		'aw_accessSecret' => $credentials['3']
		);
	echo json_encode( $returned_keys );
	die();
	} catch(AWeberAPIException $exc) {
		return <<<HTML
		<h3>AWeberAPIException:</h3>
		<li> Type: {$exc->type}</li>
		<li> Msg : {$exc->message}</li>
		<li> Docs: {$exc->documentation_url}</li>
HTML;
	die();
	}
}

// Get Aweber Lists
public function get_lists_in_account() {

	$aweber = new AWeberAPI( $this->email_services['aw']['aw_consumerKey'], $this->email_services['aw']['aw_consumerSecret'] );

	try {
	    $account = $aweber->getAccount( $this->email_services['aw']['aw_accessKey'], $this->email_services['aw']['aw_accessSecret'] );
	    $lists = $account->lists->data['entries'];

	    return($lists);

	} catch(AWeberAPIException $exc) {

		return <<<HTML
		<h3>AWeberAPIException:</h3>
		<li> Type: {$exc->type}</li>
		<li> Msg : {$exc->message}</li>
		<li> Docs: {$exc->documentation_url}</li>
HTML;
	}
}

// Subscribe User
public function add_subscriber( $name, $email, $gateID, $ip_address ) {
	$aweber = new AWeberAPI( $this->email_services['aw']['aw_consumerKey'], $this->email_services['aw']['aw_consumerSecret'] );

	try {
		$account = $aweber->getAccount( $this->email_services['aw']['aw_accessKey'], $this->email_services['aw']['aw_accessSecret'] );
		$list_id = $this->add[$gateID]['aweber_list'];
		$account_id = $account->data['id'];
		$list_url = $this->aweber_api_base."/accounts/{$account_id}/lists/{$list_id}";
		$list = $account->loadFromUrl( $list_url );
		$message = $this->add[$gateID]['thanks_msg'];
		$already_subbed = $this->add[$gateID]['already_sub_msg'];
		$ad_tracking = $this->add[$gateID]['aweber_adtrack'];
		$tags = explode(',', $this->add[$gateID]['aweber_tags']);

		// Subscriber parameters
		$params = array(
			'email' => $email,
			'ip_address' => $ip_address,
			'ad_tracking' => $ad_tracking,
			'name' => $name,
			'tags' => $tags
			);
		$subscribers = $list->subscribers;
		//return $subscribers; exit();
		$new_subscriber = $subscribers->create( $params );

		return $message;

	} catch(AWeberAPIException $exc) {
		if( $exc->message == 'email: Subscriber already subscribed.' ) {
			// Echo already subscribed message
			return $already_subbed;
		} else {
			return __( "Something went wrong. Please notify site admin. ".$exc->message, 'pm-thirtyx' );
		}
	}
}

public function run() {
	add_action( 'wp_ajax_pmill_aw_connect', array( $this, 'connect_get_keys' ) );
}
}