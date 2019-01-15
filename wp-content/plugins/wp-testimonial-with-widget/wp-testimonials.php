<?php
/**
 * Plugin Name: WP Testimonials with rotator widget
 * Plugin URI: https://www.wponlinesupport.com/plugins/
 * Text Domain: wp-testimonial-with-widget
 * Domain Path: /languages/
 * Description: Easy to add and display client's testimonial on your website with rotator widget. Also work with Gutenberg shortcode block.
 * Author: WP OnlineSupport
 * Version: 2.3.1
 * Author URI: http://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */

if( !defined( 'WTWP_VERSION' ) ) {
	define( 'WTWP_VERSION', '2.3.1' ); // Version of plugin
}
if( !defined( 'WTWP_DIR' ) ) {
	define( 'WTWP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WTWP_URL' ) ) {
	define( 'WTWP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WTWP_POST_TYPE' ) ) {
	define( 'WTWP_POST_TYPE', 'testimonial' ); // Plugin post type
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Testimonials with rotator widget
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wtwp_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Testimonials with rotator widget
 * @since 1.0.0
 */
function wtwp_install() {
	// To deactivate the free version of plugin
	if( is_plugin_active('wp-testimonial-with-widget-pro/wp-testimonials.php') ){
		add_action( 'update_option_active_plugins', 'wtwp_deactivate_version' );
	}
}

/**
 * Function to deactivate the free version plugin
 * 
 * @package WP Testimonials with rotator widget
 * @since 1.0.0
 */
function wtwp_deactivate_version(){
	deactivate_plugins( 'wp-testimonial-with-widget-pro/wp-testimonials.php', true );
}

// Action to add admin notice
add_action( 'admin_notices', 'wtwp_admin_notice');

/**
 * Admin notice
 * 
 * @package WP Testimonials with rotator widget
 * @since 1.0.0
 */
function wtwp_admin_notice() {
	
	global $pagenow;

	$dir = ABSPATH . 'wp-content/plugins/wp-testimonial-with-widget-pro/wp-testimonials.php';
	$notice_link        = add_query_arg( array('message' => 'wtwp-plugin-notice'), admin_url('plugins.php') );
	$notice_transient   = get_transient( 'wtwp_install_notice' );

	if( $notice_transient == false && $pagenow == 'plugins.php' && file_exists( $dir ) && current_user_can( 'install_plugins' ) ) {
		   echo '<div class="updated notice" style="position:relative;">
					<p>
						<strong>'.sprintf( __('Thank you for activating %s', 'wp-testimonial-with-widget'), 'WP Testimonials with rotator widget').'</strong>.<br/>
						'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-testimonial-with-widget'), '<strong>(<em>WP Testimonials with rotator widget PRO</em>)</strong>' ).'
					</p>
					<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
				</div>';
	}
}

add_action('plugins_loaded', 'wp_testimonialsandw_load_textdomain');
function wp_testimonialsandw_load_textdomain() {
	load_plugin_textdomain( 'wp-testimonial-with-widget', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

/**
 * Function to get plugin image sizes array
 * 
 * @package WP Testimonials with rotator widget
 * @since 2.2.4
 */
function wtwp_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

//Script file
require_once( WTWP_DIR . '/includes/class-wptww-script.php' );

// Function file file
require_once( WTWP_DIR . '/includes/testimonials-functions.php' );

// Post Type file
require_once( WTWP_DIR . '/includes/wptww-post-types.php' );

// Admin class file
require_once( WTWP_DIR . '/includes/admin/class-wptww-admin.php' );

// Widget file file
require_once( WTWP_DIR . '/includes/widget/wp-widget-testimonials.php' );

// Templates files file file
require_once( WTWP_DIR . '/includes/shortcodes/wp-testimonials-template.php' );
require_once( WTWP_DIR . '/includes/shortcodes/wp-testimonial-slider-template.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( WTWP_DIR . '/includes/admin/wptww-how-it-work.php' );
}

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl24_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'            => 24,
							'file'          => plugin_basename( __FILE__ ),
							'name'          => 'WP Testimonials with rotator widget',
							'slug'          => 'wp-testimonials-with-rotator-widget',
							'type'          => 'plugin',
							'menu'          => 'edit.php?post_type=testimonial',
							'text_domain'   => 'wp-testimonial-with-widget',
							'offers'		=> array(
													'trial_premium' => array(
														1 => array(
																'image'	=> 'http://analytics.wponlinesupport.com/?anylc_img=24',
																'link'	=> 'https://www.wponlinesupport.com/pricing/?utm_source=OptIn&utm_medium=Banner&utm_campaign=OptInBanner#fndtn-lifetime-combo',
																'desc'	=> 'Or start using the plugin from admin menu',
															),
													),
												),
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl24_load();
/* Plugin Wpos Analytics Data Ends */