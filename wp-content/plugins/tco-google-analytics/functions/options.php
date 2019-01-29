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

GLOBAL $tco_google_analytics_options;

if ( isset( $_POST['tco_google_analytics_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_google_analytics_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_google_analytics_options['tco_google_analytics_enable']   = ( isset( $_POST['tco_google_analytics_enable'] ) ) ? strip_tags( $_POST['tco_google_analytics_enable'] ) : '';
    $tco_google_analytics_options['tco_google_analytics_position'] = strip_tags( $_POST['tco_google_analytics_position'] );
    $tco_google_analytics_options['tco_google_analytics_code']     = stripslashes( wp_kses( $_POST['tco_google_analytics_code'], array( 'script' => array( 'async' => array(), 'src' => array() ) ) ) );

    update_option( 'tco_google_analytics', $tco_google_analytics_options );

  }
}



// Get Options
// =============================================================================

$tco_google_analytics_options = apply_filters( 'tco_google_analytics_options', get_option( 'tco_google_analytics' ) );

if ( $tco_google_analytics_options != '' ) {

  $tco_google_analytics_enable   = $tco_google_analytics_options['tco_google_analytics_enable'];
  $tco_google_analytics_position = $tco_google_analytics_options['tco_google_analytics_position'];
  $tco_google_analytics_code     = $tco_google_analytics_options['tco_google_analytics_code'];

}
