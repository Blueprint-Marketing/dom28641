<?php

// =============================================================================
// EMAIL-MAILCHIMP/FUNCTIONS/ENQUEUE/SCRIPTS.PHP
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

function email_forms_mailchimp_enqueue_admin_scripts( $hook ) {

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

    wp_enqueue_script( 'postbox' );
    wp_enqueue_script( 'tco-email-mailchimp-admin-js', TCO_EMAIL_MAILCHIMP_URL . '/js/admin/main.js', array( 'jquery' ), NULL, true );
    wp_enqueue_media();

  }

}

add_action( 'admin_enqueue_scripts', 'email_forms_mailchimp_enqueue_admin_scripts' );
