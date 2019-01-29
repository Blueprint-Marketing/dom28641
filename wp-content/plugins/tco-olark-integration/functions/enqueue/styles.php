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

function tco_olark_integration_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-olark-integration',
    'theme_page_x-extensions-olark-integration',
    'x_page_x-extensions-olark-integration',
    'x_page_tco-extensions-olark-integration',
    'x-pro_page_x-extensions-olark-integration',
    'pro_page_tco-extensions-olark-integration',
    'tco-extensions-olark-integration',
    'settings_page_tco-extensions-olark-integration',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-olark-integration-admin-css', TCO_OLARK_INTEGRATION_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_olark_integration_enqueue_admin_styles' );
