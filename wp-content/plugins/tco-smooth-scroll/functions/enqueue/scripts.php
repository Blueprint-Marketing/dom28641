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

function tco_smooth_scroll_enqueue_site_scripts() {

  require( TCO_SMOOTH_SCROLL_PATH . '/functions/options.php' );

  if ( isset( $tco_smooth_scroll_enable ) && $tco_smooth_scroll_enable == 1 ) {

    wp_enqueue_script( 'tco-smooth-scroll-site-js', TCO_SMOOTH_SCROLL_URL . '/js/site/nicescroll.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'wp_enqueue_scripts', 'tco_smooth_scroll_enqueue_site_scripts' );



// Enqueue Admin Scripts
// =============================================================================

function tco_smooth_scroll_enqueue_admin_scripts( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-smooth-scroll',
    'theme_page_x-extensions-smooth-scroll',
    'x_page_x-extensions-smooth-scroll',
    'x_page_tco-extensions-smooth-scroll',
    'x-pro_page_x-extensions-smooth-scroll',
    'pro_page_tco-extensions-smooth-scroll',
    'tco-extensions-smooth-scroll',
    'settings_page_tco-extensions-smooth-scroll',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-smooth-scroll-admin-js', TCO_SMOOTH_SCROLL_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_smooth_scroll_enqueue_admin_scripts' );
