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

  if (
    ($hook == 'addons_page_tco-extensions-email-forms' || $hook == 'email-forms' || $hook == 'theme_page_tco-extensions-email-forms' || $hook == 'tco-pro_page_tco-extensions-email-forms')
    && ( isset( $_GET['tab'] ) && $_GET['tab'] == 'getresponse' )
  ) {

    // wp_enqueue_script( 'tco-email-getresponse-admin-js', TCO_EMAIL_GETRESPONSE_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_email_getresponse_enqueue_admin_scripts' );
