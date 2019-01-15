<?php

/*

Plugin Name: Terms of Use
Plugin URI: http://theme.co/
Description: This plugin will allow you to add a simple terms of use that visitors must agree to before completing user registration.
Version: 2.0.0
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
Themeco Plugin: tco-terms-of-use

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

define( 'TCO_TERMS_OF_USE_VERSION', '2.0.0' );
define( 'TCO_TERMS_OF_USE_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_TERMS_OF_USE_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


//
// Global variables.
//

$tco_terms_of_use_options = array();



// Setup Menu
// =============================================================================

function tco_terms_of_use_options_page() {
  require( 'views/admin/options-page.php' );
}

function tco_terms_of_use_menu() {
  add_options_page( __( 'Terms of Use', '__tco__' ), __( 'Terms of Use', '__tco__' ), 'manage_options', 'tco-extensions-terms-of-use', 'tco_terms_of_use_options_page' );
}

add_action( 'admin_menu', 'tco_terms_of_use_menu', 100 );



// Initialize
// =============================================================================

function tco_terms_of_use_init() {

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

add_action( 'init', 'tco_terms_of_use_init' );
//
// Activate hook.
//

function tco_terms_of_use_activate () {
  $x_plugin_basename = 'x-terms-of-use/x-terms-of-use.php';

  if ( is_plugin_active( $x_plugin_basename ) ) {
    $tco_data = get_option('tco_terms_of_use');
    $x_data = get_option('x_terms_of_use');
    if (empty($tco_data) && !empty($x_data)) {
      $tco_data = [];
      foreach($x_data as $key => $value) {
        $key = str_replace('x_', 'tco_', $key);
        $tco_data[ $key ] = $value;
      }
      update_option( 'tco_terms_of_use', $tco_data );
    }
    deactivate_plugins( $x_plugin_basename );
  }
}

register_activation_hook( __FILE__, 'tco_terms_of_use_activate' );
