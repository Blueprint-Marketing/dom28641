<?php

// =============================================================================
// EMAIL-GETRESPONSE/FUNCTIONS/ENQUEUE/SCRIPTS.PHP
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

function tco_email_getresponse_enqueue_admin_scripts( $hook ) {

  $screen = get_current_screen();

  $hook_prefixes = array(
    'addons_page_tco-extensions-email-forms',
    'theme_page_tco-extensions-email-forms',
    'tco_page_tco-extensions-email-forms',
    'x_page_tco-extensions-email-forms',
    'tco-pro_page_tco-extensions-email-forms',
    'pro_page_tco-extensions-email-forms',
    'tco-extensions-email-forms',
    'settings_page_tco-extensions-email-forms',
  );

  if ( in_array($screen->id, $hook_prefixes) || get_post_type() === 'email-forms' ) {

    // wp_enqueue_script( 'tco-email-getresponse-admin-js', TCO_EMAIL_GETRESPONSE_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_email_getresponse_enqueue_admin_scripts' );
