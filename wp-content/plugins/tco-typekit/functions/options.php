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

GLOBAL $tco_typekit_options;

if ( isset( $_POST['tco_typekit_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_typekit_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    require_once( TCO_TYPEKIT_PATH . '/functions/request.php' );

    $tco_typekit_options['tco_typekit_enable']  = ( isset( $_POST['tco_typekit_enable'] ) ) ? strip_tags( $_POST['tco_typekit_enable'] ) : '';
    $tco_typekit_options['tco_typekit_kit_id']  = strip_tags( $_POST['tco_typekit_kit_id'] );
    $tco_typekit_options['tco_typekit_request'] = tco_typekit_request( $tco_typekit_options['tco_typekit_kit_id'] );

    update_option( 'tco_typekit', $tco_typekit_options );

  }
}



// Get Options
// =============================================================================

$tco_typekit_options = apply_filters( 'tco_typekit_options', get_option( 'tco_typekit' ) );

if ( $tco_typekit_options != '' ) {

  $tco_typekit_enable  = $tco_typekit_options['tco_typekit_enable'];
  $tco_typekit_kit_id  = $tco_typekit_options['tco_typekit_kit_id'];
  $tco_typekit_request = $tco_typekit_options['tco_typekit_request'];

}
