<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Plugin scripts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Site Scripts
//   02. Enqueue Admin Scripts
// =============================================================================

// Enqueue Site Scripts
// =============================================================================

function tco_under_construction_enqueue_site_scripts() {

  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  if ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 ) {

    // Nothing

  }

}

add_action( 'wp_enqueue_scripts', 'tco_under_construction_enqueue_site_scripts' );



// Enqueue Admin Scripts
// =============================================================================

function tco_under_construction_enqueue_admin_scripts( $hook ) {
  $hook_prefixes = array(
    'addons_page_x-extensions-under-construction',
    'theme_page_x-extensions-under-construction',
    'x_page_x-extensions-under-construction',
    'x_page_tco-extensions-under-construction',
    'x-pro_page_x-extensions-under-construction',
    'pro_page_tco-extensions-under-construction',
    'tco-extensions-under-construction',
    'settings_page_tco-extensions-under-construction',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'tco-under-construction-admin-js', TCO_UNDER_CONSTRUCTION_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );
    wp_enqueue_media();

  }

}

add_action( 'admin_enqueue_scripts', 'tco_under_construction_enqueue_admin_scripts' );


// Password callback
// =============================================================================

add_action( 'wp_ajax_tco_under_construction_bypass', 'tco_under_construction_bypass_callback' );
add_action( 'wp_ajax_nopriv_tco_under_construction_bypass', 'tco_under_construction_bypass_callback' );

function tco_under_construction_bypass_callback() {

  check_ajax_referer( 'tco_under_construction_bypass', 'tco_under_construction_ajax_nonce' );

  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  $password = $_POST['tco_under_construction_bypass_password'];

  if ( $password === $tco_under_construction_bypass_password ) {
    setcookie( 'tco_under_construction_bypass', 'true', time() + 1 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    echo 'done';
    wp_die();
  } else {
    echo 'error';
    wp_die();
  }

}
