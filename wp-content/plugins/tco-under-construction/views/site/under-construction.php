<?php

// =============================================================================
// VIEWS/SITE/UNDER-CONSTRUCTION.PHP
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

require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );



// Output
// =============================================================================

?>

<!DOCTYPE html>
<!--[if IE 9]><html class="no-js ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(''); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>

<body>

  <div class="tco-under-construction-overlay">
    <div class="tco-under-construction-wrap-outer">
      <div class="tco-under-construction-wrap-inner">
        <div class="tco-under-construction">

          <?php if ( isset( $tco_under_construction_bypass_password ) && !empty ( $tco_under_construction_bypass_password ) ) {

            require TCO_UNDER_CONSTRUCTION_PATH . '/views/site/bypass.php';

          } ?>

          <?php if ( ! empty ( $tco_under_construction_logo_image ) ) : ?>
            <div class="tco-under-construction-logo">
              <img class="" src="<?php echo esc_attr( $tco_under_construction_logo_image ) ?>" alt="logo image" />
            </div>
          <?php endif; ?>

          <h1><?php echo stripslashes( $tco_under_construction_heading ); ?></h1>
          <h2><?php echo stripslashes( $tco_under_construction_subheading ); ?></h2>
          <p><?php echo do_shortcode( stripslashes( nl2br( $tco_under_construction_extra_text ) ) ); ?></p>

          <?php if ( $tco_under_construction_date != '' ) : ?>

            <div id="tco-under-construction-countdown" class="tco-under-construction-countdown cf">
              <span class="days">0 Days</span>
              <span class="hours">0 Hours</span>
              <span class="minutes">0 Minutes</span>
              <span class="seconds">0 Seconds</span>
            </div>

            <script type="text/javascript">
              function getTimeRemaining(endtime) {
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor((t / 1000) % 60);
                var minutes = Math.floor((t / 1000 / 60) % 60);
                var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                var days = Math.floor(t / (1000 * 60 * 60 * 24));
                return {
                  'total': t,
                  'days': days,
                  'hours': hours,
                  'minutes': minutes,
                  'seconds': seconds
                };
              }

              function initializeClock(id, endtime) {
                var clock = document.getElementById(id);
                var daysSpan = clock.querySelector('.days');
                var hoursSpan = clock.querySelector('.hours');
                var minutesSpan = clock.querySelector('.minutes');
                var secondsSpan = clock.querySelector('.seconds');

                function updateClock() {
                  var t = getTimeRemaining(endtime);

                  daysSpan.innerHTML = t.days + ' Days';
                  hoursSpan.innerHTML = ('0' + t.hours).slice(-2) + ' Hours';
                  minutesSpan.innerHTML = ('0' + t.minutes).slice(-2) + ' Minutes';
                  secondsSpan.innerHTML = ('0' + t.seconds).slice(-2) + ' Seconds';

                  if (t.total <= 0) {
                    clearInterval(timeinterval);
                  }
                }

                updateClock();
                var timeinterval = setInterval(updateClock, 1000);
              }

              var deadline = new Date('<?php echo $tco_under_construction_date; ?>');
              initializeClock('tco-under-construction-countdown', deadline);

            </script>

          <?php endif; ?>

            <?php
            foreach ( $social_medias as $key => $sc ) {
              $key = "tco_under_construction_{$key}";
              $url = $$key;
              if ( ! empty ( $url ) ) {
                $social = true;
              }
            }
            ?>
            <?php if ( isset($social) && $social ) : ?><div class="tco-under-construction-social"><?php endif; ?>
              <?php foreach ( $social_medias as $key => $sc ) :
                $media = $key;
                $key = "tco_under_construction_{$key}";
                $url = $$key;
                if ( ! empty ( $url ) ) :
              ?>
                <a href="<?php echo $url ?>" class="<?php echo $key ?>" title="<?php echo $sc['title'] ?>" target="_blank"><i class="tco-icon-<?php echo $media; ?>-square" data-tco-icon="<?php echo $sc['tco-icon']; ?>" aria-hidden="true"></i></a>
              <?php
                endif;
              endforeach; ?>
            <?php if ( isset($social) && $social ) : ?></div><?php endif; ?>

        </div>
      </div>
    </div>
  </div>

</body>
</html>
