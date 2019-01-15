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

GLOBAL $tco_video_lock_options;

if ( isset( $_POST['tco_video_lock_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_video_lock_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    //
    // Set "Include" settings to an empty array if no value is set to avoid
    // array_map() notice if second parameter isn't an array.
    //

    $tco_video_lock_entries_include_post = ( isset( $_POST['tco_video_lock_entries_include'] ) ) ? $_POST['tco_video_lock_entries_include'] : array();

    $kses_allowed_tags = array(
      'iframe' => array( 'src' => array(), 'width' => array(), 'height' => array(), 'frameborder' => array(), 'webkitallowfullscreen' => array(), 'mozallowfullscreen' => array(), 'allowfullscreen' => array() )
    );

    $tco_video_lock_options['tco_video_lock_enable']                 = ( isset( $_POST['tco_video_lock_enable'] ) ) ? strip_tags( $_POST['tco_video_lock_enable'] ) : '';
    $tco_video_lock_options['tco_video_lock_delay']                  = strip_tags( $_POST['tco_video_lock_delay'] );
    $tco_video_lock_options['tco_video_lock_width']                  = strip_tags( $_POST['tco_video_lock_width'] );
    $tco_video_lock_options['tco_video_lock_heading_enable']         = ( isset( $_POST['tco_video_lock_heading_enable'] ) ) ? strip_tags( $_POST['tco_video_lock_heading_enable'] ) : '';
    $tco_video_lock_options['tco_video_lock_heading']                = strip_tags( $_POST['tco_video_lock_heading'] );
    $tco_video_lock_options['tco_video_lock_heading_color']          = strip_tags( $_POST['tco_video_lock_heading_color'] );
    $tco_video_lock_options['tco_video_lock_subheading_enable']      = ( isset( $_POST['tco_video_lock_subheading_enable'] ) ) ? strip_tags( $_POST['tco_video_lock_subheading_enable'] ) : '';
    $tco_video_lock_options['tco_video_lock_subheading']             = strip_tags( $_POST['tco_video_lock_subheading'] );
    $tco_video_lock_options['tco_video_lock_subheading_color']       = strip_tags( $_POST['tco_video_lock_subheading_color'] );
    $tco_video_lock_options['tco_video_lock_source']                 = strip_tags( $_POST['tco_video_lock_source'] );
    $tco_video_lock_options['tco_video_lock_video']                  = strip_tags( $_POST['tco_video_lock_video'] );
    $tco_video_lock_options['tco_video_lock_video_poster']           = strip_tags( $_POST['tco_video_lock_video_poster'] );
    $tco_video_lock_options['tco_video_lock_video_autoplay_enable']  = ( isset( $_POST['tco_video_lock_video_autoplay_enable'] ) ) ? strip_tags( $_POST['tco_video_lock_video_autoplay_enable'] ) : '';
    $tco_video_lock_options['tco_video_lock_video_controls_disable'] = ( isset( $_POST['tco_video_lock_video_controls_disable'] ) ) ? strip_tags( $_POST['tco_video_lock_video_controls_disable'] ) : '';
    $tco_video_lock_options['tco_video_lock_embed']                  = stripslashes( wp_kses( $_POST['tco_video_lock_embed'], $kses_allowed_tags ) );
    $tco_video_lock_options['tco_video_lock_button_text']            = strip_tags( $_POST['tco_video_lock_button_text'] );
    $tco_video_lock_options['tco_video_lock_button_link']            = strip_tags( $_POST['tco_video_lock_button_link'] );
    $tco_video_lock_options['tco_video_lock_button_style']           = strip_tags( $_POST['tco_video_lock_button_style'] );
    $tco_video_lock_options['tco_video_lock_button_delay']           = strip_tags( $_POST['tco_video_lock_button_delay'] );
    $tco_video_lock_options['tco_video_lock_close_enable']           = ( isset( $_POST['tco_video_lock_close_enable'] ) ) ? strip_tags( $_POST['tco_video_lock_close_enable'] ) : '';
    $tco_video_lock_options['tco_video_lock_entries_include']        = array_map( 'strip_tags', $tco_video_lock_entries_include_post );

    update_option( 'tco_video_lock', $tco_video_lock_options );

  }

}



// Get Options
// =============================================================================

$tco_video_lock_options = apply_filters( 'tco_video_lock_options', get_option( 'tco_video_lock' ) );

if ( $tco_video_lock_options != '' ) {

  $tco_video_lock_enable                 = $tco_video_lock_options['tco_video_lock_enable'];
  $tco_video_lock_delay                  = $tco_video_lock_options['tco_video_lock_delay'];
  $tco_video_lock_width                  = $tco_video_lock_options['tco_video_lock_width'];
  $tco_video_lock_heading_enable         = $tco_video_lock_options['tco_video_lock_heading_enable'];
  $tco_video_lock_heading                = $tco_video_lock_options['tco_video_lock_heading'];
  $tco_video_lock_heading_color          = $tco_video_lock_options['tco_video_lock_heading_color'];
  $tco_video_lock_subheading_enable      = $tco_video_lock_options['tco_video_lock_subheading_enable'];
  $tco_video_lock_subheading             = $tco_video_lock_options['tco_video_lock_subheading'];
  $tco_video_lock_subheading_color       = $tco_video_lock_options['tco_video_lock_subheading_color'];
  $tco_video_lock_source                 = $tco_video_lock_options['tco_video_lock_source'];
  $tco_video_lock_video                  = $tco_video_lock_options['tco_video_lock_video'];
  $tco_video_lock_video_poster           = $tco_video_lock_options['tco_video_lock_video_poster'];
  $tco_video_lock_video_autoplay_enable  = $tco_video_lock_options['tco_video_lock_video_autoplay_enable'];
  $tco_video_lock_video_controls_disable = $tco_video_lock_options['tco_video_lock_video_controls_disable'];
  $tco_video_lock_embed                  = $tco_video_lock_options['tco_video_lock_embed'];
  $tco_video_lock_button_text            = $tco_video_lock_options['tco_video_lock_button_text'];
  $tco_video_lock_button_link            = $tco_video_lock_options['tco_video_lock_button_link'];
  $tco_video_lock_button_style           = $tco_video_lock_options['tco_video_lock_button_style'];
  $tco_video_lock_button_delay           = $tco_video_lock_options['tco_video_lock_button_delay'];
  $tco_video_lock_close_enable           = $tco_video_lock_options['tco_video_lock_close_enable'];
  $tco_video_lock_entries_include        = $tco_video_lock_options['tco_video_lock_entries_include'];

}
