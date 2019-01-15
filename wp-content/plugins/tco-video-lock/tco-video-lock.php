<?php

/*

Plugin Name: Video Lock
Plugin URI: http://theme.co/
Description: You've never seen a video marketing tool quite like Video Lock. Place offers and a call to action in front of your users without any fuss.
Version: 2.0.0
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-video-lock

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

define( 'TCO_VIDEO_LOCK_VERSION', '2.0.0' );
define( 'TCO_VIDEO_LOCK_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_VIDEO_LOCK_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_video_lock_options = array();



// Setup Menu
// =============================================================================

function tco_video_lock_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_video_lock_menu() {
  add_options_page( __( 'Video Lock', '__tco__' ), __( 'Video Lock', '__tco__' ), 'manage_options', 'tco-extensions-video-lock', 'tco_video_lock_options_page' );
}

add_action( 'admin_menu', 'tco_video_lock_menu', 100 );



// Initialize
// =============================================================================

function tco_video_lock_init() {

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

add_action( 'init', 'tco_video_lock_init' );

//
// Activate hook.
//

function tco_video_lock_activate () {
  $x_plugin_basename = 'x-video-lock/x-video-lock.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_video_lock');
    $x_data = get_option('x_video_lock');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = [];
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_video_lock', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_video_lock_activate' );
