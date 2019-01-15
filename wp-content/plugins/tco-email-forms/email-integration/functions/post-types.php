<?php

// =============================================================================
// EMAIL-INTEGRATION/FUNCTIONS/POST-TYPES.PHP
// -----------------------------------------------------------------------------
// Register the 'email-forms' post type for this plugin. Included from the
// 'init' hook.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Email Forms Post Type
// =============================================================================

// Email Forms Post Type
// =============================================================================

register_post_type( 'email-forms', array(
  'labels' => array(
    'name'               => _x( 'Email Integration', 'post type general name', '__tco__' ),
    'singular_name'      => _x( 'Form', 'post type singular name', '__tco__' ),
    'menu_name'          => _x( 'Email Integration', 'admin menu', '__tco__' ),
    'name_admin_bar'     => _x( 'Email Forms', 'add new on admin bar', '__tco__' ),
    'add_new'            => _x( 'Add New', 'form', '__tco__' ),
    'add_new_item'       => __( 'Add New Email Form', '__tco__' ),
    'new_item'           => __( 'New Email Form', '__tco__' ),
    'edit_item'          => __( 'Edit Email Form', '__tco__' ),
    'view_item'          => __( 'View Email Form', '__tco__' ),
    'all_items'          => __( 'Email Integration', '__tco__' ),
    'search_items'       => __( 'Search Email Forms', '__tco__' ),
    'parent_item_colon'  => __( 'Parent Email Forms:', '__tco__' ),
    'not_found'          => __( 'No email forms found.', '__tco__' ),
    'not_found_in_trash' => __( 'No email forms found in Trash.', '__tco__' )
  ),
  'public'             => false,
  'publicly_queryable' => false,
  'show_ui'            => true,
  'show_in_menu'       => false, // Manually set later for control over positioning.
  'query_var'          => true,
  'rewrite'            => false,
  'capability_type'    => 'page',
  'has_archive'        => false,
  'hierarchical'       => false,
  'menu_position'      => 100,
  'supports'           => array( 'title' )
) );
