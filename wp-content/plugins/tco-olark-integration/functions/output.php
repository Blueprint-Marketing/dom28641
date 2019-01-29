<?php

// =============================================================================
// FUNCTIONS/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Plugin output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Olark Integration
//   02. Output
// =============================================================================

// Olark Integration
// =============================================================================

function tco_olark_integration_output() {

  require( TCO_OLARK_INTEGRATION_PATH . '/views/site/olark-integration.php' );

}



// Output
// =============================================================================

require( TCO_OLARK_INTEGRATION_PATH . '/functions/options.php' );

if ( isset( $tco_olark_integration_enable ) && $tco_olark_integration_enable == 1 ) {

  add_action( 'wp_footer', 'tco_olark_integration_output' );

}