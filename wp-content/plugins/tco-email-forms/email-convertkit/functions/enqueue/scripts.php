<?php

// =============================================================================
// EMAIL-CONVERTKIT/FUNCTIONS/ENQUEUE/SCRIPTS.PHP
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

function tco_email_convertkit_enqueue_admin_scripts( $hook ) {

  if (
    ($hook == 'addons_page_tco-extensions-email-forms' || $hook == 'email-forms' || $hook == 'theme_page_tco-extensions-email-forms' || $hook == 'tco-pro_page_tco-extensions-email-forms')
    && ( isset( $_GET['tab'] ) && $_GET['tab'] == 'convertkit' )
  ) {

    // wp_enqueue_script( 'tco-email-convertkit-admin-js', TCO_EMAIL_CONVERTKIT_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_email_convertkit_enqueue_admin_scripts' );
