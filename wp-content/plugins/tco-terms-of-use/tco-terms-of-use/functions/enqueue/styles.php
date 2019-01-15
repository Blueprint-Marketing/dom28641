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

function tco_terms_of_use_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-terms-of-use',
    'theme_page_x-extensions-terms-of-use',
    'x_page_x-extensions-terms-of-use',
    'x-pro_page_x-extensions-terms-of-use',
    'tco-extensions-terms-of-use',
    'settings_page_tco-extensions-terms-of-use',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-terms-of-use-admin-css', TCO_TERMS_OF_USE_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_terms_of_use_enqueue_admin_styles' );
