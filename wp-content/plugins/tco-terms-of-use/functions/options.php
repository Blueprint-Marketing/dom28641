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

GLOBAL $tco_terms_of_use_options;

if ( isset( $_POST['tco_terms_of_use_form_submitted'] ) ) {
  if ( strip_tags( $_POST['tco_terms_of_use_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    $tco_terms_of_use_options['tco_terms_of_use_enable']        = ( isset( $_POST['tco_terms_of_use_enable'] ) ) ? strip_tags( $_POST['tco_terms_of_use_enable'] ) : '';
    $tco_terms_of_use_options['tco_terms_of_use_entry_include'] = strip_tags( $_POST['tco_terms_of_use_entry_include'] );

    update_option( 'tco_terms_of_use', $tco_terms_of_use_options );

  }
}



// Get Options
// =============================================================================

$tco_terms_of_use_options = apply_filters( 'tco_terms_of_use_options', get_option( 'tco_terms_of_use' ) );

if ( $tco_terms_of_use_options != '' ) {

  $tco_terms_of_use_enable        = $tco_terms_of_use_options['tco_terms_of_use_enable'];
  $tco_terms_of_use_entry_include = $tco_terms_of_use_options['tco_terms_of_use_entry_include'];

}