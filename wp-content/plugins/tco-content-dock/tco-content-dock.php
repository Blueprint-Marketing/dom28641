<?php

/*

Plugin Name: Content Dock
Plugin URI: http://theme.co/
Description: An incredibly simple and effective tool that allows you to place content or marketing offers in front of your users in an elegant, non-intrusive manner.
Version: 2.0.3
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-content-dock

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

define( 'TCO_CONTENT_DOCK_VERSION', '2.0.3' );
define( 'TCO_CONTENT_DOCK_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_CONTENT_DOCK_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_content_dock_options = array();



// Setup Menu
// =============================================================================

function tco_content_dock_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_content_dock_menu() {
  add_options_page( __( 'Content Dock', '__tco__' ), __( 'Content Dock', '__tco__' ), 'manage_options', 'tco-extensions-content-dock', 'tco_content_dock_options_page' );
}

function x_tco_content_dock_menu() {
  add_submenu_page( 'x-addons-home', __( 'Content Dock', '__x__' ), __( 'Content Dock', '__x__' ), 'manage_options', 'tco-extensions-content-dock', 'tco_content_dock_options_page' );
}

$theme = wp_get_theme(); // gets the current theme
$is_pro_theme = ( 'Pro' == $theme->name || 'Pro' == $theme->parent_theme );
$is_x_theme = function_exists( 'CS' );
add_action( 'admin_menu', ( $is_pro_theme || $is_x_theme ) ? 'x_tco_content_dock_menu' : 'tco_content_dock_menu', 100 );



// Initialize
// =============================================================================

function tco_content_dock_init() {

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

  require( 'functions/widgets.php' );
  require( 'functions/output.php' );

}

add_action( 'init', 'tco_content_dock_init' );

//
// Activate hook.
//

function tco_content_dock_activate () {
  $x_plugin_basename = 'x-content-dock/x-content-dock.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_content_dock');
    $x_data = get_option('x_content_dock');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = array();
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_content_dock', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_content_dock_activate' );
