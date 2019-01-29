<?php

/*

Plugin Name: Under Construction
Plugin URI: http://theme.co/
Description: Got a little work that needs to be done under the hood? The Under Construction plugin is the easiest maintenance plugin you'll ever setup and the last one you'll ever need.
Version: 2.0.3
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-under-construction

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

define( 'TCO_UNDER_CONSTRUCTION_VERSION', '2.0.3' );
define( 'TCO_UNDER_CONSTRUCTION_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_UNDER_CONSTRUCTION_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_under_construction_options = array();



// Setup Menu
// =============================================================================

function tco_under_construction_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_under_construction_menu() {
  add_options_page( __( 'Under Construction', '__tco__' ), __( 'Under Construction', '__tco__' ), 'manage_options', 'tco-extensions-under-construction', 'tco_under_construction_options_page' );
}

function x_tco_under_construction_menu() {
  add_submenu_page( 'x-addons-home', __( 'Under Construction', '__tco__' ), __( 'Under Construction', '__tco__' ), 'manage_options', 'tco-extensions-under-construction', 'tco_under_construction_options_page' );
}

$theme = wp_get_theme(); // gets the current theme
$is_pro_theme = ( 'Pro' == $theme->name || 'Pro' == $theme->parent_theme );
$is_x_theme = function_exists( 'CS' );
add_action( 'admin_menu', ( $is_pro_theme || $is_x_theme ) ? 'x_tco_under_construction_menu' : 'tco_under_construction_menu', 100 );



// Initialize
// =============================================================================

function tco_under_construction_init() {

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

add_action( 'init', 'tco_under_construction_init' );


//
// Activate hook.
//

function tco_under_construction_activate () {
  $x_plugin_basename = 'x-under-construction/x-under-construction.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_under_construction');
    $x_data = get_option('x_under_construction');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = array();
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_under_construction', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_under_construction_activate' );
