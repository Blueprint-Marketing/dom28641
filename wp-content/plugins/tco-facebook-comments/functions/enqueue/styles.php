<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/STYLES.PHP
// -----------------------------------------------------------------------------
// Plugin styles.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Admin Styles
// =============================================================================

// Enqueue Admin Styles
// =============================================================================

function tco_facebook_comments_enqueue_admin_styles( $hook ) {

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

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-facebook-comments-admin-css', TCO_FACEBOOK_COMMENTS_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_facebook_comments_enqueue_admin_styles' );
