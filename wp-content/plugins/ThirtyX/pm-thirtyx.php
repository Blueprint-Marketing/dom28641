<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.techbasedmarketing.com
 * @since             9.1.0.9
 * @package           Pm_ThirtyX
 *
 * @wordpress-plugin
 * Plugin Name:       ThirtyX
 * Plugin URI:        http://www.30xStrategy.com
 * Description:       Created To Implement The 30Strategy
 * Version:           9.1.0.9
 * Author:            Created For Armand Morin By Lynette Chandler
 * Author URI:        http://www.techbasedmarketing.com
 * Text Domain:       pm-thirtyx
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Constants
define( 'PM_THIRTYX_PLUGIN_NAME', 'PM ThirtyX' );
define( 'PM_THIRTYX_AW_APP_ID', '436dc91e' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pm-thirtyx-activator.php
 */
function activate_pm_thirtyx() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pm-thirtyx-activator.php';
	$activator = new Pm_ThirtyX_Activator();
	$activator->activate();
	//rewrite_flush();
}
function rewrite_flush() {
	$activator = new Pm_ThirtyX_Activator();
	$activator->register_pt();
	$addOption = add_option( 'pm_thirtyx_opts', '', '', 'yes' );
	flush_rewrite_rules();
	error_log(print_r($addOption, true) );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pm-thirtyx-deactivator.php
 */
function deactivate_pm_thirtyx() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pm-thirtyx-deactivator.php';
	Pm_ThirtyX_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pm_thirtyx' );
register_deactivation_hook( __FILE__, 'deactivate_pm_thirtyx' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pm-thirtyx.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    9.1.0.0
 */
function run_pm_thirtyx() {

	$plugin = new Pm_ThirtyX();
	$plugin->run();

}
run_pm_thirtyx();

/**
 * Update class
 */
function pm_thirtyx_filter_update_checks($queryArgs) {
    $pm_thirtyx_opts = get_option('pm_thirtyx_opts');
    if ( !empty($pm_thirtyx_opts['keys']['support']) ) {
        $queryArgs['license_key'] = $pm_thirtyx_opts['keys']['support'];
    }
    return $queryArgs;
}
$pm_thirtyx_update_check = PucFactory::buildUpdateChecker('http://drop.pluginmill.com/wp-update-server/?action=get_metadata&slug=pm-thirtyx', __FILE__, 'pm-thirtyx');
$pm_thirtyx_update_check->addQueryArgFilter('pm_thirtyx_filter_update_checks');