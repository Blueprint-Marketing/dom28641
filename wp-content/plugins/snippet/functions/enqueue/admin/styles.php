<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/ADMIN/STYLES.PHP
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

wp_enqueue_style( $plugin_title . '-jquery-timepicker-css', $plugin_url . '/js/jquery-timepicker/jquery.timepicker.css', NULL, NULL, 'all' );

$hook_prefixes = array(
  'addons_page_x-extensions-snippet',
  'theme_page_x-extensions-snippet',
  'x_page_x-extensions-snippet',
  'x-pro_page_x-extensions-snippet',
  'tco-extensions-snippet',
  'settings_page_tco-extensions-snippet',
);

if ( in_array($screen->id, $hook_prefixes) ) {

  wp_enqueue_style( 'postbox' );
  wp_enqueue_style( $plugin_title . '-admin-css', $plugin_url . '/css/admin/style.css', NULL, NULL, 'all' );
  wp_enqueue_style( $plugin_title . '-admin-tco-css', $plugin_url . '/css/admin/tco.css', NULL, NULL, 'all' );

} else {

  $output_list_post_types = get_post_types( array('public' => true), 'object');
  foreach ( $output_list_post_types as $post_type ) {
    if ($screen->id === $post_type->name) {
      wp_enqueue_style( 'postbox' );
      wp_enqueue_style( $plugin_title . '-admin-css', $plugin_url . '/css/admin/style-post-types.css', NULL, NULL, 'all' );
    }
  }

  wp_enqueue_style( $plugin_title . '-metaboxes-css', $plugin_url . '/css/admin/style-metaboxes.css', NULL, NULL, 'all' );

}
