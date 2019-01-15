<?php
/**
 * Admin Class
 *
 * Handles the admin functionality of plugin
 *
 * @package WP Testimonials with rotator widget
 * @since 2.2.8
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wtwp_Admin {
	
	function __construct() {
		
		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'wtwp_register_menu'), 12 );
		
		// Init Processes
		add_action( 'admin_init', array($this, 'wtwp_admin_init_process') );
	}

	/**
	 * Function to add menu
	 * 
	 * @package WP Testimonials with rotator widget
	 * @since 2.2.8
	 */
	function wtwp_register_menu() {

		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WTWP_POST_TYPE, __('Upgrade to PRO - WP Testimonials with rotator widget', 'wp-testimonial-with-widget'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'wp-testimonial-with-widget').'</span>', 'manage_options', 'wtwp-premium', array($this, 'wtwp_premium_page') );
		
		// Register plugin hire us page
		add_submenu_page( 'edit.php?post_type='.WTWP_POST_TYPE, __('Hire Us', 'wp-testimonial-with-widget'), '<span style="color:#2ECC71">'.__('Hire Us', 'wp-testimonial-with-widget').'</span>', 'manage_options', 'wtwp-hireus', array($this, 'wtwp_hireus_page') );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Testimonials with rotator widget
	 * @since 2.2.8
	 */
	function wtwp_premium_page() {
		include_once( WTWP_DIR . '/includes/admin/settings/premium.php' );		
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Testimonials with rotator widget
	 * @since 2.2.8
	 */
	function wtwp_hireus_page() {		
		include_once( WTWP_DIR . '/includes/admin/settings/hire-us.php' );
	}

	/**
	 * Function to notification transient
	 * 
	 * @package WP Testimonials with rotator widget
	 * @since 2.2.8
	 */
	function wtwp_admin_init_process() {
		// If plugin notice is dismissed
	    if( isset($_GET['message']) && $_GET['message'] == 'wtwp-plugin-notice' ) {
	    	set_transient( 'wtwp_install_notice', true, 604800 );
	    }
	}
}

$wtwp_Admin = new Wtwp_Admin();