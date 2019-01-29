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

function tco_terms_of_use_enqueue_admin_scripts( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-terms-of-use',
    'theme_page_x-extensions-terms-of-use',
    'x_page_x-extensions-terms-of-use',
    'x_page_tco-extensions-terms-of-use',
    'x-pro_page_x-extensions-terms-of-use',
    'pro_page_tco-extensions-terms-of-use',
    'tco-extensions-terms-of-use',
    'settings_page_tco-extensions-terms-of-use',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-terms-of-use-admin-js', TCO_TERMS_OF_USE_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_terms_of_use_enqueue_admin_scripts' );
