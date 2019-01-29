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

function tco_facebook_comments_enqueue_admin_scripts( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-facebook-comments',
    'theme_page_x-extensions-facebook-comments',
    'x_page_x-extensions-facebook-comments',
    'x_page_tco-extensions-facebook-comments',
    'x-pro_page_x-extensions-facebook-comments',
    'pro_page_tco-extensions-facebook-comments',
    'tco-extensions-facebook-comments',
    'settings_page_tco-extensions-facebook-comments',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-facebook-comments-admin-js', TCO_FACEBOOK_COMMENTS_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_facebook_comments_enqueue_admin_scripts' );
