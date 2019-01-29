<?php

// =============================================================================
// VIEWS/SITE/CONTENT-DOCK.PHP
// -----------------------------------------------------------------------------
// Plugin site output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Require Options
//   02. Output
// =============================================================================

// Require Options
// =============================================================================

require( TCO_VIDEO_LOCK_PATH . '/functions/options.php' );



// Output
// =============================================================================

if ( is_page( $tco_video_lock_entries_include ) || is_single( $tco_video_lock_entries_include ) ) :

  //
  // Enqueue library.
  //

  wp_enqueue_script( 'mediaelement' );

  $prefix = function_exists('CS') ? 'x' : 'tco';

  //
  // Heading output.
  //

  if ( ( $tco_video_lock_heading_enable == 1 ) ) {
    $heading_output = '<h1 style="color: ' . $tco_video_lock_heading_color . ';">' . $tco_video_lock_heading . '</h1>';
  } else {
    $heading_output = '';
  }


  //
  // Subheading output.
  //

  if ( ( $tco_video_lock_subheading_enable == 1 ) ) {
    $subheading_output = '<p style="color: ' . $tco_video_lock_subheading_color . ';">' . $tco_video_lock_subheading . '</p>';
  } else {
    $subheading_output = '';
  }


  //
  // Text output.
  //

  if ( $heading_output != '' || $subheading_output != '' ) {
    $text_output = '<div class="<?php echo $prefix ?>-video-lock-text">' . $heading_output . $subheading_output . '</div>';
  } else {
    $text_output = '';
  }


  //
  // Video output.
  //

  if ( $tco_video_lock_source == 'self-hosted' ) {
    $autoplay       = ( $tco_video_lock_video_autoplay_enable  == 1 ) ? 'true' : 'false';
    $controls       = ( $tco_video_lock_video_controls_disable == 1 ) ? 'true' : 'false';
    $video          = do_shortcode( '[x_video_player m4v="' . $tco_video_lock_video . '" poster="' . $tco_video_lock_video_poster . '" hide_controls="' . $controls . '" autoplay="' . $autoplay . '" preload="metadata" loop="false" muted="false" no_container="true"]' );
    $video_output   = str_replace( array( "'", '</script>' ), array( '"', '<\/script>' ), $video );
  } elseif ( $tco_video_lock_source == 'third-party' ) {
    $video_output = do_shortcode( '[x_video_embed no_container="true"]' . $tco_video_lock_embed . '[/x_video_embed]' );
  }


  //
  // Button output.
  //

  if ( strpos( $tco_video_lock_button_style, 'marketing' ) !== false ) {
    $button = do_shortcode( '[button class="' . $tco_video_lock_button_style . '" href="' . $tco_video_lock_button_link . '" size="large" circle="true"]' . $tco_video_lock_button_text . '[/button]' );
  } else {
    $button = do_shortcode( '[button href="' . $tco_video_lock_button_link . '" size="large"]' . $tco_video_lock_button_text . '[/button]' );
  }

  $button_output = str_replace( "'", '"', $button );


  //
  // Close output.
  //

  if ( ( $tco_video_lock_close_enable == 1 ) ) {
    $close_output = '<a href="#" class="'.$prefix.'-video-lock-close"><i class="'.$prefix.'-icon-close" data-'.$prefix.'-icon="&#xf00d;"></i></a>';
  } else {
    $close_output = '';
  }


  //
  // Miscellaneous.
  //

  $tco_video_lock_delay          = $tco_video_lock_delay * 1000;
  $tco_video_lock_button_delay   = $tco_video_lock_button_delay * 1000;
  $tco_video_lock_button_display = ( $tco_video_lock_button_delay == 0 ) ? 'block' : 'none';

    ?>

  <script id="<?php echo $prefix ?>-video-lock-js">

    jQuery(document).ready(function($) {

      var videoLockOutput = '<div class="<?php echo $prefix ?>-video-lock-overlay">' +
                              '<?php echo $close_output; ?>' +
                              '<div class="<?php echo $prefix ?>-video-lock-wrap-outer">' +
                                '<div class="<?php echo $prefix ?>-video-lock-wrap-inner">' +
                                  '<div class="<?php echo $prefix ?>-video-lock" style="max-width: <?php echo $tco_video_lock_width . "px"; ?>;">' +
                                    '<?php echo $text_output; ?>' +
                                    '<?php echo $video_output; ?>' +
                                    '<div class="<?php echo $prefix ?>-video-lock-btn-wrap" style="display: <?php echo $tco_video_lock_button_display; ?>;">' +
                                      '<div class="<?php echo $prefix ?>-video-lock-btn-wrap-inner">' +
                                        '<?php echo $button_output; ?>' +
                                      '</div>' +
                                    '</div>' +
                                  '</div>' +
                                '</div>' +
                              '</div>' +
                            '</div>';

      setTimeout( function() {

        $('html, body').css({ 'overflow' : 'hidden' });
        $('.site').append( videoLockOutput );

        <?php if ( $tco_video_lock_button_delay != 0 ) { ?>

          setTimeout( function() {
            $('.<?php echo $prefix ?>-video-lock-btn-wrap').slideDown();
          }, <?php echo $tco_video_lock_button_delay; ?> );

        <?php } ?>

        <?php if ( $close_output != '' ) { ?>

          $('.<?php echo $prefix ?>-video-lock-close').click(function(e) {
            e.preventDefault();
            $('html, body').css('overflow',  '');
            $('.<?php echo $prefix ?>-video-lock-overlay').remove();
          });

        <?php } ?>

      }, <?php echo $tco_video_lock_delay; ?> );

    });

  </script>

<?php endif;
