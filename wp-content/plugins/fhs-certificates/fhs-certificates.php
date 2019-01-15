<?php
/*
Plugin Name: FHS Certificates
Description: All Certificates related functionality.
Version: 1.0
Author: BuddyBoss
Author URI: http://www.buddyboss.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

class FHS_Certificates{
	var $plugin_url;
	var $plugin_dir;
	var $plugin_prefix;
	var $plugin_version;
	var $domain;
	var $c; //contain the classes

	function __construct() {
		$this->plugin_version = '1.0';
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_url     = plugin_dir_url( __FILE__ );
		$this->plugin_prefix  = 'fhs_certificates';
		$this->domain         = 'fhs_certificates';
		$this->db_version     = '0.1';
		$this->c              = new stdClass();
		//register all hooks.
		$this->hooks();
		$this->load_classes();
	}

	function hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_assets' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/*
	* load all core style and js files.
	*/
	function enqueue_assets() {}

	/*
	* load all core style and js files for backend.
	*/
	function admin_enqueue_assets() {}

	/*
	* Load the plugin language
	*/
	function load_textdomain() {
		load_plugin_textdomain( $this->domain, false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
	}

	private function get_class_file_name( $class_name ) {
		return 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';
	}

	function load_classes() {

		// include all metaboxes
		$include_files = array(
			'include/functions.php'
		);

		foreach( $include_files as $include_file ){
			$path =  $this->plugin_dir . $include_file;
			if ( file_exists( $path ) ) {
				include $path;
			}
		}

		//inclue all classes
		spl_autoload_register( function ( $class_name ) {
			$bbclasspath = array(
				'include/' . $this->get_class_file_name( $class_name ),
			);

			foreach ( $bbclasspath as $path ) {
				$path =  $this->plugin_dir . $path;
				if ( file_exists( $path ) ) {
					include $path;
					break;
				}
			}
		} );

		$this->c->fhs_certificates_manager = new FHS_Certificates_Manager();

	}

}

/*
 * Easy to call function.
 **/
function fhs_certificates() {
	global $fhs_certificates;
	return $fhs_certificates;
}

function fhs_certificates_init(){
	global $fhs_certificates;
	//load the main class
	$fhs_certificates = new FHS_Certificates();
}
add_action( 'plugins_loaded', 'fhs_certificates_init', 10 );


register_activation_hook( __FILE__, 'fhs_certificates_on_plugin_activate' );
function fhs_certificates_on_plugin_activate(){
    global $wpdb;
        
    $table_name1 = $wpdb->prefix . 'fhs_certificates';

    $sql1 = "CREATE TABLE " . $table_name1 . " (
        id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        course_id bigint(20) NOT NULL,
        user_id bigint(20) NOT NULL,
        date_added int(11) NOT NULL,
        date_expiring int(11) NOT NULL,
        status varchar(100) NULL DEFAULT 'active',
        KEY course_id (course_id),
        KEY user_id (user_id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );
}