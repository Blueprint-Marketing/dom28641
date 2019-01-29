<?php

// =============================================================================
// FUNCTIONS/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Plugin output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Terms of Use
//   02. Error Handling
//   03. Output
// =============================================================================

// Terms of Use
// =============================================================================

function tco_terms_of_use_output() {

  require( TCO_TERMS_OF_USE_PATH . '/views/site/terms-of-use.php' ); 

}



// Error Handling
// =============================================================================

function tco_terms_of_use_check_fields( $errors, $sanitized_user_login, $user_email ) { 

  if ( ! isset( $_POST['agree'] ) ) {
    $errors->add( 'empty_agree', __( '<strong>ERROR</strong>: You must agree to our terms of use.', '__tco__' ) );
  }

  return $errors;

}

add_action( 'registration_errors', 'tco_terms_of_use_check_fields', 10, 3 );



// Output
// =============================================================================

require( TCO_TERMS_OF_USE_PATH . '/functions/options.php' );

if ( isset( $tco_terms_of_use_enable ) && $tco_terms_of_use_enable == 1 ) {

  add_action( 'register_form', 'tco_terms_of_use_output', 9999 );

}