<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Plugin scripts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Admin Scripts
//   02. Do not show callback
// =============================================================================

// Enqueue Admin Scripts
// =============================================================================

function tco_content_dock_enqueue_admin_scripts( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-content-dock',
    'theme_page_x-extensions-content-dock',
    'x_page_x-extensions-content-dock',
    'x-pro_page_x-extensions-content-dock',
    'tco-extensions-content-dock',
    'settings_page_tco-extensions-content-dock',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'tco-content-dock-admin-js', TCO_CONTENT_DOCK_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );
    wp_enqueue_media();

  }

}

add_action( 'admin_enqueue_scripts', 'tco_content_dock_enqueue_admin_scripts' );

// Do not show callback
// =============================================================================

add_action( 'wp_ajax_tco_content_dock_do_not_show', 'tco_content_dock_do_not_show_callback' );
add_action( 'wp_ajax_nopriv_tco_content_dock_do_not_show', 'tco_content_dock_do_not_show_callback' );

function tco_content_dock_do_not_show_callback() {

  require( TCO_CONTENT_DOCK_PATH . '/views/site/content-dock.php' );

  $do_not_show = intval( $_POST['tco_content_dock_do_not_show'] );
  if ( $do_not_show ) {
    $secs = $tco_content_dock_cookie_timeout * DAY_IN_SECONDS;
    $seconds = time() + ( $tco_content_dock_cookie_timeout * DAY_IN_SECONDS );
    setcookie( 'tco_content_dock_do_not_show', 'true', $seconds, COOKIEPATH, COOKIE_DOMAIN );
    echo 'done ' . $seconds . ' ' . $secs;
    wp_die();
  } else {
    echo 'error';
    wp_die();
  }

}
