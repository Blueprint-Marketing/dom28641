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

$screen = get_current_screen();

wp_enqueue_script( $plugin_title . '-jquery-timepicker-js', $plugin_url . '/js/jquery-timepicker/jquery.timepicker.js', array( 'jquery' ), NULL, true );


$hook_prefixes = array(
  'addons_page_x-extensions-snippet',
  'theme_page_x-extensions-snippet',
  'x_page_x-extensions-snippet',
  'x-pro_page_x-extensions-snippet',
  'tco-extensions-snippet',
  'settings_page_tco-extensions-snippet',
);

if ( in_array($screen->id, $hook_prefixes) ) {

  wp_enqueue_script( 'postbox' );
  wp_enqueue_script( $plugin_title . '-admin-js', $plugin_url . '/js/admin/main.js', array( 'jquery' ), NULL, true );
  wp_enqueue_media();

} else {

  wp_enqueue_script( $plugin_title . '-metaboxes-js', $plugin_url . '/js/admin/main-metaboxes.js', array( 'jquery' ), NULL, true );
  wp_enqueue_media();

}
