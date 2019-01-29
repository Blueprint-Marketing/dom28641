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

function tco_typekit_enqueue_admin_scripts( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-typekit',
    'theme_page_x-extensions-typekit',
    'tco_page_x-extensions-typekit',
    'x_page_tco-extensions-typekit',
    'x-pro_page_x-extensions-typekit',
    'pro_page_tco-extensions-typekit',
    'tco-extensions-typekit',
    'settings_page_tco-extensions-typekit',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-typekit-admin-js', TCO_TYPEKIT_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_typekit_enqueue_admin_scripts' );
