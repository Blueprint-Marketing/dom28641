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

GLOBAL $tco_facebook_comments_options;

if ( isset( $_POST['tco_facebook_comments_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_facebook_comments_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_facebook_comments_options['tco_facebook_comments_enable']       = ( isset( $_POST['tco_facebook_comments_enable'] ) ) ? strip_tags( $_POST['tco_facebook_comments_enable'] ) : '';
    $tco_facebook_comments_options['tco_facebook_comments_app_id']       = strip_tags( $_POST['tco_facebook_comments_app_id'] );
    $tco_facebook_comments_options['tco_facebook_comments_app_secret']   = strip_tags( $_POST['tco_facebook_comments_app_secret'] );
    $tco_facebook_comments_options['tco_facebook_comments_number_posts'] = strip_tags( $_POST['tco_facebook_comments_number_posts'] );
    $tco_facebook_comments_options['tco_facebook_comments_order_by']     = strip_tags( $_POST['tco_facebook_comments_order_by'] );
    $tco_facebook_comments_options['tco_facebook_comments_color_scheme'] = strip_tags( $_POST['tco_facebook_comments_color_scheme'] );

    update_option( 'tco_facebook_comments', $tco_facebook_comments_options );

  }

}



// Get Options
// =============================================================================

$tco_facebook_comments_options = apply_filters( 'tco_facebook_comments_options', get_option( 'tco_facebook_comments' ) );

if ( $tco_facebook_comments_options != '' ) {

  $tco_facebook_comments_enable       = $tco_facebook_comments_options['tco_facebook_comments_enable'];
  $tco_facebook_comments_app_id       = $tco_facebook_comments_options['tco_facebook_comments_app_id'];
  $tco_facebook_comments_app_secret   = $tco_facebook_comments_options['tco_facebook_comments_app_secret'];
  $tco_facebook_comments_number_posts = $tco_facebook_comments_options['tco_facebook_comments_number_posts'];
  $tco_facebook_comments_order_by     = $tco_facebook_comments_options['tco_facebook_comments_order_by'];
  $tco_facebook_comments_color_scheme = $tco_facebook_comments_options['tco_facebook_comments_color_scheme'];

}