<?php

// =============================================================================
// EMAIL-INTEGRATION/FUNCTIONS/ENQUEUE/ADMIN/STYLES.PHP
// -----------------------------------------------------------------------------
// Enqueue admin styles for the plugin. This file is included within the
// 'admin_enqueue_scripts' action.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Admin Styles
// =============================================================================

// Enqueue Admin Styles
// =============================================================================

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

  wp_enqueue_style( 'postbox' );
  wp_enqueue_script( 'wp-color-picker' );
  wp_enqueue_style( $plugin_title . '-admin-css', $plugin_url . '/css/admin/style.css', NULL, NULL, 'all' );

}
