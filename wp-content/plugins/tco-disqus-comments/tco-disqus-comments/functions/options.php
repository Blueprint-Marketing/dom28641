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

GLOBAL $tco_disqus_comments_options;

if ( isset( $_POST['tco_disqus_comments_form_submitted'] ) ) {
  if ( sanitize_text_field( $_POST['tco_disqus_comments_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_disqus_comments_exclude_post_types_post = ( isset( $_POST['tco_disqus_comments_exclude_post_types'] ) ) ? $_POST['tco_disqus_comments_exclude_post_types'] : array();
    $tco_disqus_comments_options['tco_disqus_comments_enable']             = ( isset( $_POST['tco_disqus_comments_enable'] ) ) ? sanitize_text_field( $_POST['tco_disqus_comments_enable'] ) : '';
    $tco_disqus_comments_options['tco_disqus_comments_shortname']          = sanitize_text_field( $_POST['tco_disqus_comments_shortname'] );
    $tco_disqus_comments_options['tco_disqus_comments_lazy_load']          = sanitize_text_field( $_POST['tco_disqus_comments_lazy_load'] );
    $tco_disqus_comments_options['tco_disqus_comments_exclude_post_types'] = array_map( 'sanitize_text_field', $tco_disqus_comments_exclude_post_types_post );

    update_option( 'tco_disqus_comments', $tco_disqus_comments_options );

  }
}



// Get Options
// =============================================================================

$tco_disqus_comments_options = apply_filters( 'tco_disqus_comments_options', get_option( 'tco_disqus_comments' ) );

if ( $tco_disqus_comments_options != '' ) {

  $tco_disqus_comments_enable             = $tco_disqus_comments_options['tco_disqus_comments_enable'];
  $tco_disqus_comments_shortname          = $tco_disqus_comments_options['tco_disqus_comments_shortname'];
  $tco_disqus_comments_lazy_load          = isset( $tco_disqus_comments_options['tco_disqus_comments_lazy_load'] ) ? $tco_disqus_comments_options['tco_disqus_comments_lazy_load'] : 'normal';
  $tco_disqus_comments_exclude_post_types = $tco_disqus_comments_options['tco_disqus_comments_exclude_post_types'];

}
