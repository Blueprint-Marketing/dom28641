<?php

// =============================================================================
// FUNCTIONS/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Plugin output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Custom 404
//   02. Output
// =============================================================================

// Custom 404
// =============================================================================

function tco_custom_404_output() {

  require( TCO_CUSTOM_404_PATH . '/views/site/custom-404.php' );

}



// Output
// =============================================================================

require( TCO_CUSTOM_404_PATH . '/functions/options.php' );

if ( isset( $tco_custom_404_enable ) && $tco_custom_404_enable == 1 ) {

  tco_custom_404_output();

}
