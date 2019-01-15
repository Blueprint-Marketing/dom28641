<?php

// =============================================================================
// FUNCTIONS/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Plugin output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Video Lock
//   01. Output
// =============================================================================

// Video Lock
// =============================================================================

function tco_video_lock_output() {

  require( TCO_VIDEO_LOCK_PATH . '/views/site/video-lock.php' );

}



// Output
// =============================================================================

require_once( TCO_VIDEO_LOCK_PATH . '/functions/includes/cs/helpers.php' );
require_once( TCO_VIDEO_LOCK_PATH . '/functions/includes/cs/video-embed.php' );
require_once( TCO_VIDEO_LOCK_PATH . '/functions/includes/cs/video-player.php' );
require( TCO_VIDEO_LOCK_PATH . '/functions/options.php' );

if ( isset( $tco_video_lock_enable ) && $tco_video_lock_enable == 1 ) {

  add_action( 'wp_footer', 'tco_video_lock_output' );

}
