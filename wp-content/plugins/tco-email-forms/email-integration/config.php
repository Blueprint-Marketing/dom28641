<?php

// =============================================================================
// EMAIL-INTEGRATION/CONFIG.PHP
// -----------------------------------------------------------------------------
// The framework configuration sets up metaboxes, about items, shortcodes, and
// widgets to be used for the core of the plugin.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Configuration
// =============================================================================

// Configuration
// =============================================================================

return array(

  //
  // List Table.
  //

  'email_forms_list_table' => array(
    'name'      => 'email_forms',
    'post_type' => 'email-forms',
    'singular'  => 'email_form',
    'plural'    => 'email_forms',
    'columns'   => array(
      'title'     => __( 'Title', '__tco__' ),
      'shortcode' => __( 'Shortcode', '__tco__' ),
      'date'      => __( 'Date', '__tco__' )
    )
  ),


  //
  // Tabs.
  //

  'admin_tabs' => array(
    'forms' => array(
      'title' => __( 'Email Forms', '__tco__' ),
      'view'  => 'admin/tab-email-forms'
    ),
    'general' => array(
      'title' => __( 'General Settings', '__tco__' ),
      'view'  => 'admin/tab-settings'
    ),
  ),

  'default_tab' => 'forms',


  //
  // Settings metaboxes.
  //

  'settings_metaboxes' => array(
    'general' => array(
      'title' => __( 'Settings', '__tco__' ),
      'view'  => 'admin/metabox-general'
    ),
  ),


  //
  // About items.
  //

  'about_items' => array(
    'general' => array(
      'title'   => __( 'General Settings', '__tco__' ),
      'content' => __( 'This is for integrating your provider with various parts of WordPress.', '__tco__' ),
    ),
    'providers' => array(
      'title'   => __( 'Providers', '__tco__' ),
      'content' => __( 'On the tab navigation, you should see items for any active email providers. You can use multiple providers without needing to change any of the general settings. This allows you to switch if needed without any changes to the frontend of your site. Just edit a form, and reassign the list.', '__tco__' ),
    ),
    'support' => array(
      'title'   => __( 'Support', '__tco__' ),
      'content' => __( 'For questions, please visit our <a href="//theme.co/x/member/kb/extension-email-forms/" target="_blank">Knowledge Base tutorial</a> for this plugin.', '__tco__' ),
    )
  ),


  //
  // Shortcodes (shortname / handling class).
  //

  'shortcodes' => array(
    'tco_subscribe' => 'Tco_Shortcode_Tco_Subscribe',
    'x_subscribe' => 'Tco_Shortcode_Tco_Subscribe',
  ),


  //
  // Widgets.
  //

  'widgets' => array(
    'X_Widget_Tco_Subscribe'
  )
);
