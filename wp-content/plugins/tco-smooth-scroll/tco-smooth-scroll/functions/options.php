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

GLOBAL $tco_smooth_scroll_options;

if ( isset( $_POST['tco_smooth_scroll_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_smooth_scroll_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_smooth_scroll_options['tco_smooth_scroll_enable'] = ( isset( $_POST['tco_smooth_scroll_enable'] ) ) ? strip_tags( $_POST['tco_smooth_scroll_enable'] ) : '';
    $tco_smooth_scroll_options['tco_smooth_scroll_step']   = strip_tags( $_POST['tco_smooth_scroll_step'] );
    $tco_smooth_scroll_options['tco_smooth_scroll_speed']  = strip_tags( $_POST['tco_smooth_scroll_speed'] );

    update_option( 'tco_smooth_scroll', $tco_smooth_scroll_options );

  }
}



// Get Options
// =============================================================================

$tco_smooth_scroll_options = apply_filters( 'tco_smooth_scroll_options', get_option( 'tco_smooth_scroll' ) );

if ( $tco_smooth_scroll_options != '' ) {

  $tco_smooth_scroll_enable = $tco_smooth_scroll_options['tco_smooth_scroll_enable'];
  $tco_smooth_scroll_step   = $tco_smooth_scroll_options['tco_smooth_scroll_step'];
  $tco_smooth_scroll_speed  = $tco_smooth_scroll_options['tco_smooth_scroll_speed'];

}
