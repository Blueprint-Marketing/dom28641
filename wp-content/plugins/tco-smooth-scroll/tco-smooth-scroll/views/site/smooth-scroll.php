<?php

// =============================================================================
// VIEWS/SITE/SMOOTH-SCROLL.PHP
// -----------------------------------------------------------------------------
// Plugin site output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Output
// =============================================================================

// Require Options
// =============================================================================

require( TCO_SMOOTH_SCROLL_PATH . '/functions/options.php' );



// Output
// =============================================================================

?>

<script id="tco-smooth-scroll">

  jQuery(document).ready(function($) { 

    $('html').addClass('tco-smooth-scroll').niceScroll({
      touchbehavior      : false,
      grabcursorenabled  : false,
      preservenativescrolling : true,
      // zindex             : 99999,
      // cursoropacitymin   : 0,
      // cursoropacitymax   : 1,
      // cursorwidth        : 10,
      // cursorcolor        : '#444',
      // cursorborder       : '0',
      // cursorborderradius : '0',
      // hidecursordelay    : 250,
      scrollspeed        : <?php echo $tco_smooth_scroll_speed; ?>,
      mousescrollstep    : <?php echo $tco_smooth_scroll_step; ?>,
    });

  });

</script>