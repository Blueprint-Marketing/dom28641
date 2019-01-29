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

function tco_disqus_comments_enqueue_admin_scripts( $hook ) {

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

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-disqus-comments-admin-js', TCO_DISQUS_COMMENTS_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_disqus_comments_enqueue_admin_scripts' );
