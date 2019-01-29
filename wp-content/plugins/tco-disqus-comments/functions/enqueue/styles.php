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

function tco_disqus_comments_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-disqus-comments',
    'theme_page_x-extensions-disqus-comments',
    'x_page_x-extensions-disqus-comments',
    'x_page_tco-extensions-disqus-comments',
    'x-pro_page_x-extensions-disqus-comments',
    'pro_page_tco-extensions-disqus-comments',
    'tco-extensions-disqus-comments',
    'settings_page_tco-extensions-disqus-comments',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-disqus-comments-admin-css', TCO_DISQUS_COMMENTS_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_disqus_comments_enqueue_admin_styles' );
