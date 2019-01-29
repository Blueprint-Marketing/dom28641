<?php

/*

Plugin Name: Olark Integration
Plugin URI: http://theme.co/
Description: Sign up for an Olark account and experience the easiest way to boost your sales, help solve issues, and understand your customers with live chat.
Version: 2.0.3
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-olark-integration

*/

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants and Global Variables
//   02. Setup Menu
//   03. Initialize
// =============================================================================

// Define Constants and Global Variables
// =============================================================================

//
// Constants.
//

define( 'TCO_OLARK_INTEGRATION_VERSION', '2.0.3' );
define( 'TCO_OLARK_INTEGRATION_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_OLARK_INTEGRATION_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_olark_integration_options = array();



// Setup Menu
// =============================================================================

function tco_olark_integration_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_olark_integration_menu() {
  add_options_page( __( 'Olark Integration', '__tco__' ), __( 'Olark Integration', '__tco__' ), 'manage_options', 'tco-extensions-olark-integration', 'tco_olark_integration_options_page' );
}

function x_tco_olark_integration_menu() {
  add_submenu_page( 'x-addons-home', __( 'Olark Integration', '__tco__' ), __( 'Olark Integration', '__tco__' ), 'manage_options', 'tco-extensions-olark-integration', 'tco_olark_integration_options_page' );
}

$theme = wp_get_theme(); // gets the current theme
$is_pro_theme = ( 'Pro' == $theme->name || 'Pro' == $theme->parent_theme );
$is_x_theme = function_exists( 'CS' );
add_action( 'admin_menu', ( $is_pro_theme || $is_x_theme ) ? 'x_tco_olark_integration_menu' : 'tco_olark_integration_menu', 100 );



// Initialize
// =============================================================================

function tco_olark_integration_init() {

  //
  // Textdomain.
  //

  load_plugin_textdomain( '__tco__', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );


  //
  // Styles and scripts.
  //

  require( 'functions/enqueue/styles.php' );
  require( 'functions/enqueue/scripts.php' );


  //
  // Notices.
  //

  require( 'functions/notices.php' );


  //
  // Output.
  //

  require( 'functions/output.php' );

}

add_action( 'init', 'tco_olark_integration_init' );

//
// Activate hook.
//

function tco_olark_integration_activate () {
  $x_plugin_basename = 'x-olark-integration/x-olark-integration.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_olark_integration');
    $x_data = get_option('x_olark_integration');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = array();
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_olark_integration', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_olark_integration_activate' );
