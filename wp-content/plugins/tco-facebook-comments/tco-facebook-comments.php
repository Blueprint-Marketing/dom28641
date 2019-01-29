<?php

/*

Plugin Name: Facebook Comments
Plugin URI: http://theme.co/
Description: Take advantage of powerful and unique features by integrating Facebook comments on your website instead of the standard WordPress commenting system.
Version: 2.0.3
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
X Plugin: tco-facebook-comments

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

define( 'TCO_FACEBOOK_COMMENTS_VERSION', '2.0.3' );
define( 'TCO_FACEBOOK_COMMENTS_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_FACEBOOK_COMMENTS_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_facebook_comments_options = array();



// Setup Menu
// =============================================================================

function tco_facebook_comments_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_facebook_comments_menu() {
  add_options_page( __( 'Facebook Comments', '__tco__' ), __( 'Facebook Comments', '__tco__' ), 'manage_options', 'tco-extensions-facebook-comments', 'tco_facebook_comments_options_page' );
}

function x_tco_facebook_comments_menu() {
  add_submenu_page( 'x-addons-home', __( 'Facebook Comments', '__tco__' ), __( 'Facebook Comments', '__tco__' ), 'manage_options', 'tco-extensions-facebook-comments', 'tco_facebook_comments_options_page' );
}

$theme = wp_get_theme(); // gets the current theme
$is_pro_theme = ( 'Pro' == $theme->name || 'Pro' == $theme->parent_theme );
$is_x_theme = function_exists( 'CS' );
add_action( 'admin_menu', ( $is_pro_theme || $is_x_theme ) ? 'x_tco_facebook_comments_menu' : 'tco_facebook_comments_menu', 100 );



// Initialize
// =============================================================================

function tco_facebook_comments_init() {

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

add_action( 'init', 'tco_facebook_comments_init' );

//
// Activate hook.
//

function tco_facebook_comments_activate () {
  $x_plugin_basename = 'x-facebook-comments/x-facebook-comments.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_facebook_comments');
    $x_data = get_option('x_facebook_comments');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = array();
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_facebook_comments', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_facebook_comments_activate' );
