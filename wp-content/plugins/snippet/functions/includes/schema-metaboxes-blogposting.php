<?php

// =============================================================================
// FUNCTIONS/INCLUDES/SCHEMA-METABOXES-BLOGPOSTING.PHP
// -----------------------------------------------------------------------------
// List of metaboxes (attributes) of BlogPosting
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Array of values
// =============================================================================

// Array of values
// =============================================================================

return array (
  array (
    'id' => '_snippet_blogposting_type',
    'name' => '@type',
    'label' => __( 'Type', '__tco__' ),
    'description' => __( 'Type of schema', '__tco__' ),
    'schema_type' => '',
    'type' => 'type',
  ),
  array (
    'id' => '_snippet_blogposting_headline',
    'name' => 'headline',
    'label' => __( 'Headline', '__tco__' ),
    'description' => __( 'Headline of the article.', '__tco__' ),
    'schema_type' => 'Text',
    'type' => 'text',
    'default_value' => array( 'post', 'post_title' ),
  ),
  array (
    'id' => '_snippet_blogposting_alternative_headline',
    'name' => 'alternativeHeadline',
    'label' => __( 'Alternative Headline', '__tco__' ),
    'description' => __( 'A secondary title of the CreativeWork.', '__tco__' ),
    'schema_type' => 'Text',
    'type' => 'text',
  ),
  array (
    'id' => '_snippet_blogposting_description',
    'name' => 'description',
    'label' => __( 'Description', '__tco__' ),
    'description' => __( 'A description (excerpt).', '__tco__' ),
    'schema_type' => 'Text',
    'type' => 'textarea',
    // 'default_value' => array( 'post_method', 'get_the_excerpt' ),
  ),
  array (
    'id' => '_snippet_blogposting_image',
    'name' => 'image',
    'label' => __( 'Image', '__tco__' ),
    'description' => __( 'An image of the item. This can be a URL or a fully described ImageObject.', '__tco__' ),
    'schema_type' => 'ImageObject',
    'type' => 'media',
    'default_value' => array( 'post_method', 'get_the_post_thumbnail_url' ),
  ),
  array (
    'id' => '_snippet_blogpostindate-published',
    'name' => 'datePublished',
    'label' => __( 'Date Published', '__tco__' ),
    'description' => __( 'Date of first broadcast/publication.', '__tco__' ),
    'schema_type' => 'Date',
    'type' => 'date-published',
    'hide' => true,
  ),
  array (
    'id' => '_snippet_blogposting_date_modified',
    'name' => 'dateModified',
    'label' => __( 'Date Modified', '__tco__' ),
    'description' => __( 'The date of the last modify.', '__tco__' ),
    'schema_type' => 'Date',
    'type' => 'date-modified',
    'hide' => true,
  ),
  array (
    'id' => '_snippet_blogposting_author',
    'name' => 'author',
    'label' => __( 'Author', '__tco__' ),
    'description' => __( 'The author of this content. Default to author of the post if already saved.', '__tco__' ),
    'schema_type' => 'Person',
    'type' => 'text',
    'default_value' => array( 'author', 'display_name' ),
  ),
  array (
    'id' => '_snippet_blogposting_publisher',
    'name' => 'publisher',
    'label' => __( 'Publisher', '__tco__' ),
    'description' => __( 'The publisher of the creative work.', '__tco__' ),
    'schema_type' => 'Organization',
    'type' => 'text',
    'default_value' => array( 'snippet', 'organization_name')
  ),
  array (
    'id' => '_snippet_blogposting_publisher_logo',
    'name' => 'logo',
    'label' => __( 'Publisher Logo', '__tco__' ),
    'description' => __( 'The publisher\'s logo.', '__tco__' ),
    'schema_type' => 'ImageObject',
    'type' => 'media',
    'default_value' => array( 'snippet', 'organization_logo' ),
  ),
  array (
    'id' => '_snippet_blogposting_main_entity_of_page',
    'name' => 'mainEntityOfPage',
    'label' => __( 'Main Entity Of Page', '__tco__' ),
    'description' => __( 'Indicates a page (or other CreativeWork) for which this thing is the main entity being described.', '__tco__' ),
    'schema_type' => 'Text',
    'type' => 'text',
  ),
);
