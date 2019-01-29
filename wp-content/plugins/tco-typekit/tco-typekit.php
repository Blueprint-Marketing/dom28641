<?php

/*

Plugin Name: Typekit
Plugin URI: http://theme.co/
Description: Create beautiful designs by incorporating Typekit fonts into your website. Our custom Extension makes this premium service easy to setup and use.
Version: 2.0.3
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-typekit

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

define( 'TCO_TYPEKIT_VERSION', '2.0.3' );
define( 'TCO_TYPEKIT_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_TYPEKIT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$TCO_TYPEKIT_options = array();



// Setup Menu
// =============================================================================

function tco_typekit_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_typekit_menu() {
  add_options_page( __( 'Typekit', '__tco__' ), __( 'Typekit', '__tco__' ), 'manage_options', 'tco-extensions-typekit', 'tco_typekit_options_page' );
}

function x_tco_typekit_menu() {
  add_submenu_page( 'x-addons-home', __( 'Typekit', '__tco__' ), __( 'Typekit', '__tco__' ), 'manage_options', 'tco-extensions-typekit', 'tco_typekit_options_page' );
}

$theme = wp_get_theme(); // gets the current theme
$is_pro_theme = ( 'Pro' == $theme->name || 'Pro' == $theme->parent_theme );
$is_x_theme = function_exists( 'CS' );
add_action( 'admin_menu', ( $is_pro_theme || $is_x_theme ) ? 'x_tco_typekit_menu' : 'tco_typekit_menu', 100 );



// Initialize
// =============================================================================

function tco_typekit_init() {

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

add_action( 'init', 'tco_typekit_init' );

//
// Activate hook.
//

function tco_typekit_activate () {
  $x_plugin_basename = 'x-typekit/x-typekit.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_typekit');
    $x_data = get_option('x_typekit');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = array();
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_typekit', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_typekit_activate' );
