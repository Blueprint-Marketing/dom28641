<?php

/*

Plugin Name: Smooth Scroll
Plugin URI: http://theme.co/
Description: Enabling smooth scrolling on your website allows you to manage the physics of your scroll bar! This fun effect is great if you happen to have a lot users who utilize a mousewheel.
Version: 2.0.3
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-smooth-scroll

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

define( 'TCO_SMOOTH_SCROLL_VERSION', '2.0.3' );
define( 'TCO_SMOOTH_SCROLL_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_SMOOTH_SCROLL_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_smooth_scroll_options = array();



// Setup Menu
// =============================================================================

function tco_smooth_scroll_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_smooth_scroll_menu() {
  add_options_page( __( 'Smooth Scroll', '__tco__' ), __( 'Smooth Scroll', '__tco__' ), 'manage_options', 'tco-extensions-smooth-scroll', 'tco_smooth_scroll_options_page' );
}

function x_tco_smooth_scroll_menu() {
  add_submenu_page( 'x-addons-home', __( 'Smooth Scroll', '__tco__' ), __( 'Smooth Scroll', '__tco__' ), 'manage_options', 'tco-extensions-smooth-scroll', 'tco_smooth_scroll_options_page' );
}

$theme = wp_get_theme(); // gets the current theme
$is_pro_theme = ( 'Pro' == $theme->name || 'Pro' == $theme->parent_theme );
$is_x_theme = function_exists( 'CS' );
add_action( 'admin_menu', ( $is_pro_theme || $is_x_theme ) ? 'x_tco_smooth_scroll_menu' : 'tco_smooth_scroll_menu', 100 );



// Initialize
// =============================================================================

function tco_smooth_scroll_init() {

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

add_action( 'init', 'tco_smooth_scroll_init' );

//
// Activate hook.
//

function tco_smooth_scroll_activate () {
  $x_plugin_basename = 'x-smooth-scroll/x-smooth-scroll.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_smooth_scroll');
    $x_data = get_option('x_smooth_scroll');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = array();
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_smooth_scroll', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_smooth_scroll_activate' );
