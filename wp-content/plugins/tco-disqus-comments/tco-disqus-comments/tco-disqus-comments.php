<?php

/*

Plugin Name: Disqus Comments
Plugin URI: http://theme.co/
Description: Take advantage of powerful and unique features by integrating Disqus comments on your website instead of the standard WordPress commenting system.
Version: 2.0.0
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-disqus-comments

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

define( 'TCO_DISQUS_COMMENTS_VERSION', '2.0.0' );
define( 'TCO_DISQUS_COMMENTS_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_DISQUS_COMMENTS_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_disqus_comments_options = array();



// Setup Menu
// =============================================================================

function tco_disqus_comments_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_disqus_comments_menu() {
  add_options_page( __( 'Disqus Comments', '__tco__' ), __( 'Disqus Comments', '__tco__' ), 'manage_options', 'tco-extensions-disqus-comments', 'tco_disqus_comments_options_page' );
}

add_action( 'admin_menu', 'tco_disqus_comments_menu', 100 );



// Initialize
// =============================================================================

function tco_disqus_comments_init() {

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

add_action( 'init', 'tco_disqus_comments_init' );

//
// Activate hook.
//

function tco_disqus_comments_activate () {
  $x_plugin_basename = 'x-disqus-comments/x-disqus-comments.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_disqus_comments');
    $x_data = get_option('x_disqus_comments');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = [];
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_disqus_comments', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_disqus_comments_activate' );
