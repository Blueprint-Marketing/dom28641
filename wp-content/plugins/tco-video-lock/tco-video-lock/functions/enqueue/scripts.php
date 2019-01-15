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
// =============================================================================

// Enqueue Admin Scripts
// =============================================================================

function tco_video_lock_enqueue_admin_scripts( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-video-lock',
    'theme_page_x-extensions-video-lock',
    'x_page_x-extensions-video-lock',
    'x-pro_page_x-extensions-video-lock',
    'tco-extensions-video-lock',
    'settings_page_tco-extensions-video-lock',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-video-lock-admin-js', TCO_VIDEO_LOCK_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_video_lock_enqueue_admin_scripts' );
