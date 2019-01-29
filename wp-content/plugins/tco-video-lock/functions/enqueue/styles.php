<?php

// =============================================================================
// FUNCTIONS/ENQUEUE/STYLES.PHP
// -----------------------------------------------------------------------------
// Plugin styles.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Output Site Styles
//   02. Enqueue Admin Styles
// =============================================================================

// Output Site Styles
// =============================================================================

function tco_video_lock_output_site_styles() {

  require( TCO_VIDEO_LOCK_PATH . '/functions/options.php' );

  if ( isset( $tco_video_lock_enable ) && $tco_video_lock_enable == 1 ) :

    $included = $tco_video_lock_entries_include;

    if ( is_page( $included ) || is_single( $included ) ) :

      $admin_bar_is_showing = is_admin_bar_showing();
      $prefix = function_exists('CS') ? 'x' : 'tco';
      ?><style id="tco-tco-video-lock-generated-css" type="text/css">

      /*
      // Base styles.
      */

      .<?php echo $prefix ?>-video-lock-overlay {
        position: fixed;
        top: <?php echo ( $admin_bar_is_showing ) ? '32px' : '0' ; ?>;
        left: 0;
        right: 0;
        bottom: 0;
        overflow-x: hidden;
        overflow-y: auto;
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 9999;
      }

      .<?php echo $prefix ?>-video-lock-wrap-outer {
        display: table;
        width: 100%;
        height: 100%;
      }

      .<?php echo $prefix ?>-video-lock-wrap-inner {
        display: table-cell;
        vertical-align: middle;
        padding: 25px;
      }

      .<?php echo $prefix ?>-video-lock {
        display: block;
        overflow: auto;
        margin: 0 auto;
        padding: 0 25px;
        text-align: center;
        background-color: #fff;
        box-shadow: 0 0.085em 1.25em 0 rgba(0, 0, 0, 0.85);
      }

      .<?php echo $prefix ?>-video-lock h1 {
        margin: 0;
        font-size: 32px;
        line-height: 1;
      }

      .<?php echo $prefix ?>-video-lock p {
        margin: 0;
        font-size: 18px;
        line-height: 1.5;
      }

      .<?php echo $prefix ?>-video-lock h1 + p {
        margin-top: 10px;
      }

      .<?php echo $prefix ?>-video-lock .<?php echo $prefix ?>-video {
        margin: 0 -25px;
      }


      /*
      // Containers.
      */

      .<?php echo $prefix ?>-video-lock-text,
      .<?php echo $prefix ?>-video-lock-btn-wrap-inner {
        padding: 25px 0;
      }


      /*
      // Close.
      */

      .<?php echo $prefix ?>-video-lock-close {
        display: block;
        position: absolute;
        top: 3px;
        left: 3px;
        width: 18px;
        height: 18px;
        font-size: 18px;
        line-height: 1;
        text-align: center;
        color: rgba(255, 255, 255, 0.1);
      }

      .<?php echo $prefix ?>-video-lock-close:hover {
        color: rgba(255, 255, 255, 0.35);
      }


      /*
      // Button styles.
      */

      <?php if ( strpos( $tco_video_lock_button_style, 'marketing' ) !== false ) : ?>

        .<?php echo $prefix ?>-video-lock .<?php echo $prefix ?>-btn {
          margin: 0 0 0.25em;
          padding: 0.575em 1.125em 0.675em;
          font-size: 18px;
          line-height: 1.3;
          text-transform: uppercase;
          background-repeat: repeat-x;
          border-radius: 5px;
          z-index: 10;
        }

        .<?php echo $prefix ?>-video-lock .<?php echo $prefix ?>-btn-circle-wrap {
          margin: 0;
        }

      <?php endif; ?>

      <?php if ( $tco_video_lock_button_style == 'marketing-red' ) : ?>

        .<?php echo $prefix ?>-video-lock .<?php echo $prefix ?>-btn {
          border: 1px solid #ac1100;
          text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
          color: #fff;
          background-color: #ff2a13;
          background-image: -webkit-linear-gradient(top, #ff2a13, #d6200a);
          background-image: linear-gradient(top, #ff2a13, #d6200a);
          box-shadow: 0 0.25em 0 0 #a71000, 0 4px 9px rgba(0, 0, 0, 0.75);
        }

      <?php elseif ( $tco_video_lock_button_style == 'marketing-yellow' ) : ?>

        .<?php echo $prefix ?>-video-lock .<?php echo $prefix ?>-btn {
          border: 1px solid #f1c600;
          text-shadow: 0 1px 1px rgba(255, 255, 255, 0.775);
          color: #1e2756;
          background-color: #f9ff00;
          background-image: -webkit-linear-gradient(top, #f9ff00, #ffcb00);
          background-image: linear-gradient(top, #f9ff00, #ffcb00);
          box-shadow: 0 0.25em 0 0 #d7b100, 0 4px 9px rgba(0, 0, 0, 0.75);
        }

      <?php elseif ( $tco_video_lock_button_style == 'marketing-green' ) : ?>

        .<?php echo $prefix ?>-video-lock .<?php echo $prefix ?>-btn {
          border: 1px solid #177b41;
          text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
          color: #fff;
          background-color: #2ecc71;
          background-image: -webkit-linear-gradient(top, #2ecc71, #27ae60);
          background-image: linear-gradient(top, #2ecc71, #27ae60);
          box-shadow: 0 0.25em 0 0 #1a894a, 0 4px 9px rgba(0, 0, 0, 0.75);
        }

      <?php endif; ?>


      /*
      // Responsive.
      */

      <?php if ( $admin_bar_is_showing ) : ?>

        @media (matco-width: 782px) {
          .<?php echo $prefix ?>-video-lock-overlay {
            top: 46px;
          }
        }

        @media (matco-width: 600px) {
          .<?php echo $prefix ?>-video-lock-overlay {
            top: 0;
          }
        }

      <?php endif; ?>
    </style>
    <?php endif;

  endif;

}

add_action( 'wp_head', 'tco_video_lock_output_site_styles' );



// Enqueue Admin Styles
// =============================================================================

function tco_video_lock_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-video-lock',
    'theme_page_x-extensions-video-lock',
    'x_page_x-extensions-video-lock',
    'x_page_tco-extensions-video-lock',
    'x_page_tco-extensions-video-lock',
    'x-pro_page_x-extensions-video-lock',
    'pro_page_tco-extensions-video-lock',
    'tco-extensions-video-lock',
    'settings_page_tco-extensions-video-lock',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-video-lock-admin-css', TCO_VIDEO_LOCK_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_video_lock_enqueue_admin_styles' );
