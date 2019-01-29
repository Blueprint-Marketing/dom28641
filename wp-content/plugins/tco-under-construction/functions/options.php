<?php

// =============================================================================
// FUNCTIONS/OPTIONS.PHP
// -----------------------------------------------------------------------------
// Plugin options.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Options
//   02. Get Options
// =============================================================================

// Set Options
// =============================================================================

//
// Set $_POST variables to options array and update option.
//

GLOBAL $tco_under_construction_options;

$social_medias = array(
  'facebook'    => array('title' => 'Facebook', 'tco-icon' => '&#xf082;'),
  'twitter'     => array('title' => 'Twitter', 'tco-icon' => '&#xf081;'),
  'google_plus' => array('title' => 'Google Plus', 'tco-icon' => '&#xf0d4;'),
  'linkedin'    => array('title' => 'Likedin', 'tco-icon' => '&#xf08c;'),
  'xing'        => array('title' => 'XING', 'tco-icon' => '&#xf169;'),
  'foursquare'  => array('title' => 'Foursquare', 'tco-icon' => '&#xf180;'),
  'youtube'     => array('title' => 'Youtube', 'tco-icon' => '&#xf166;'),
  'vimeo'       => array('title' => 'Vimeo', 'tco-icon' => '&#xf194;'),
  'instagram'   => array('title' => 'Instagram', 'tco-icon' => '&#xf16d;'),
  'pinterest'   => array('title' => 'Pinterest', 'tco-icon' => '&#xf0d3;'),
  'dribbble'    => array('title' => 'Dribbble', 'tco-icon' => '&#xf17d;'),
  'flickr'      => array('title' => 'Flickr', 'tco-icon' => '&#xf16e;'),
  'github'      => array('title' => 'Github', 'tco-icon' => '&#xf092;'),
  'behance'     => array('title' => 'Behance', 'tco-icon' => '&#xf1b5;'),
  'tumblr'      => array('title' => 'Tumblr', 'tco-icon' => '&#xf174;'),
  'whatsapp'    => array('title' => 'Whatsapp', 'tco-icon' => '&#xf232;'),
  'soundcloud'  => array('title' => 'SoundCloud', 'tco-icon' => '&#xf1be;'),
  'rss'         => array('title' => 'RSS', 'tco-icon' => '&#xf143;'),
);

if ( isset( $_POST['tco_under_construction_form_submitted'] ) ) {
  if ( sanitize_text_field( $_POST['tco_under_construction_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_under_construction_options['tco_under_construction_enable']           = ( isset( $_POST['tco_under_construction_enable'] ) ) ? sanitize_text_field( $_POST['tco_under_construction_enable'] ) : '';
    $tco_under_construction_options['tco_under_construction_use_custom']       = ( isset( $_POST['tco_under_construction_use_custom'] ) ) ? sanitize_text_field( $_POST['tco_under_construction_use_custom'] ) : '';
    $tco_under_construction_options['tco_under_construction_custom']           = sanitize_text_field( $_POST['tco_under_construction_custom'] );
    $tco_under_construction_options['tco_under_construction_heading']          = sanitize_text_field( $_POST['tco_under_construction_heading'] );
    $tco_under_construction_options['tco_under_construction_subheading']       = sanitize_text_field( $_POST['tco_under_construction_subheading'] );
    $tco_under_construction_options['tco_under_construction_extra_text']       = strip_tags( $_POST['tco_under_construction_extra_text'] );
    $tco_under_construction_options['tco_under_construction_date']             = sanitize_text_field( $_POST['tco_under_construction_date'] );
    $tco_under_construction_options['tco_under_construction_background_image'] = sanitize_text_field( $_POST['tco_under_construction_background_image'] );
    $tco_under_construction_options['tco_under_construction_logo_image']       = sanitize_text_field( $_POST['tco_under_construction_logo_image'] );
    $tco_under_construction_options['tco_under_construction_background_color'] = sanitize_text_field( $_POST['tco_under_construction_background_color'] );
    $tco_under_construction_options['tco_under_construction_heading_color']    = sanitize_text_field( $_POST['tco_under_construction_heading_color'] );
    $tco_under_construction_options['tco_under_construction_subheading_color'] = sanitize_text_field( $_POST['tco_under_construction_subheading_color'] );
    $tco_under_construction_options['tco_under_construction_date_color']       = sanitize_text_field( $_POST['tco_under_construction_date_color'] );
    $tco_under_construction_options['tco_under_construction_social_color']     = sanitize_text_field( $_POST['tco_under_construction_social_color'] );
    $tco_under_construction_options['tco_under_construction_whitelist']        = sanitize_text_field( $_POST['tco_under_construction_whitelist'] );
    $tco_under_construction_options['tco_under_construction_bypass_password']  = sanitize_text_field( $_POST['tco_under_construction_bypass_password'] );

    foreach ( $social_medias as $key => $sc ) {
      $key = "tco_under_construction_{$key}";
      $tco_under_construction_options[ $key ] = sanitize_text_field( $_POST[ $key ] );
    }

    update_option( 'tco_under_construction', $tco_under_construction_options );

  }
}



// Get Options
// =============================================================================

$tco_under_construction_options = apply_filters( 'tco_under_construction_options', get_option( 'tco_under_construction' ) );

if ( $tco_under_construction_options != '' ) {

  $tco_under_construction_enable           = $tco_under_construction_options['tco_under_construction_enable'];
  $tco_under_construction_use_custom       = $tco_under_construction_options['tco_under_construction_use_custom'];
  $tco_under_construction_custom           = $tco_under_construction_options['tco_under_construction_custom'];
  $tco_under_construction_heading          = $tco_under_construction_options['tco_under_construction_heading'];
  $tco_under_construction_subheading       = $tco_under_construction_options['tco_under_construction_subheading'];
  $tco_under_construction_extra_text       = $tco_under_construction_options['tco_under_construction_extra_text'];
  $tco_under_construction_date             = $tco_under_construction_options['tco_under_construction_date'];
  $tco_under_construction_background_image = $tco_under_construction_options['tco_under_construction_background_image'];
  $tco_under_construction_logo_image       = $tco_under_construction_options['tco_under_construction_logo_image'];
  $tco_under_construction_background_color = $tco_under_construction_options['tco_under_construction_background_color'];
  $tco_under_construction_heading_color    = $tco_under_construction_options['tco_under_construction_heading_color'];
  $tco_under_construction_subheading_color = $tco_under_construction_options['tco_under_construction_subheading_color'];
  $tco_under_construction_date_color       = $tco_under_construction_options['tco_under_construction_date_color'];
  $tco_under_construction_social_color     = $tco_under_construction_options['tco_under_construction_social_color'];
  $tco_under_construction_whitelist        = $tco_under_construction_options['tco_under_construction_whitelist'];
  $tco_under_construction_bypass_password  = $tco_under_construction_options['tco_under_construction_bypass_password'];

  foreach ( $social_medias as $key => $sc ) {
    $key = "tco_under_construction_{$key}";
    $$key = $tco_under_construction_options[ $key ];
  }

}
