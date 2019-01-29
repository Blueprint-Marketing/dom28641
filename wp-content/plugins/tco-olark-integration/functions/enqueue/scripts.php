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

function tco_olark_integration_enqueue_admin_scripts( $hook ) {

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

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-olark-integration-admin-js', TCO_OLARK_INTEGRATION_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_olark_integration_enqueue_admin_scripts' );
