<?php

// =============================================================================
// EMAIL-INTEGRATION/FUNCTIONS/ENQUEUE/ADMIN/SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Enqueue admin scripts for the plugin. This file is included within the
// 'admin_enqueue_scripts' action.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Admin Scripts
// =============================================================================

// Enqueue Admin Scripts
// =============================================================================

$screen = get_current_screen();

$hook_prefixes = array(
  'addons_page_tco-extensions-email-forms',
  'theme_page_tco-extensions-email-forms',
  'tco_page_tco-extensions-email-forms',
  'tco-pro_page_tco-extensions-email-forms',
  'tco-extensions-email-forms',
  'settings_page_tco-extensions-email-forms',
);

if ( in_array($screen->id, $hook_prefixes) || get_post_type() === 'email-forms' ) {

  wp_enqueue_script( 'postbox' );
  wp_enqueue_script( 'wp-color-picker' );
  wp_enqueue_script( $plugin_title . '-admin-js', $plugin_url . '/js/admin/main.js', array( 'jquery' ), NULL, true );
  wp_enqueue_media();

}
