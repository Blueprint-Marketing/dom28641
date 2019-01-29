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

GLOBAL $tco_olark_integration_options;

if ( isset( $_POST['tco_olark_integration_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_olark_integration_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_olark_integration_options['tco_olark_integration_enable']  = ( isset( $_POST['tco_olark_integration_enable'] ) ) ? strip_tags( $_POST['tco_olark_integration_enable'] ) : '';
    $tco_olark_integration_options['tco_olark_integration_site_id'] = strip_tags( $_POST['tco_olark_integration_site_id'] );

    update_option( 'tco_olark_integration', $tco_olark_integration_options );

  }
}



// Get Options
// =============================================================================

$tco_olark_integration_options = apply_filters( 'tco_olark_integration_options', get_option( 'tco_olark_integration' ) );

if ( $tco_olark_integration_options != '' ) {

  $tco_olark_integration_enable  = $tco_olark_integration_options['tco_olark_integration_enable'];
  $tco_olark_integration_site_id = $tco_olark_integration_options['tco_olark_integration_site_id'];

}