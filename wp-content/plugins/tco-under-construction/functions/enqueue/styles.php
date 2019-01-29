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

function tco_under_construction_output_site_styles() {
  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  if ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 && ! is_user_logged_in() ) {

    if ( isset( $tco_under_construction_whitelist ) && !empty( $tco_under_construction_whitelist ) ) {

      $allowed_ips = explode(' ', $tco_under_construction_whitelist);
      if ( in_array( $_SERVER['REMOTE_ADDR'], $allowed_ips) ) {
        return null;
      }
    }

    wp_enqueue_style( 'dashicons' );

    $admin_bar_is_showing = is_admin_bar_showing();


    if (
      ! isset( $_COOKIE['tco_under_construction_bypass'] )
    ) : ?>

    <style id="tco-under-construction-generated-css" type="text/css">

      /*
      // Import font.
      */

      @import url(//fonts.googleapis.com/css?family=Lato:300,700);
    <?php if ( ! function_exists('CS') ) : ?>
      @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
    <?php endif; ?>

      /*
      // Disable browser scroll.
      */

      html,
      body {
        overflow: hidden !important;
        height: 100% !important;
        background: none;
      }


      /*
      // Base styles.
      */

      body {
        background-color: <?php echo $tco_under_construction_background_color; ?>;
        <?php if ( $tco_under_construction_background_image != '' ) : ?>
          background-image: url(<?php echo $tco_under_construction_background_image; ?>);
          background-position: 50% 50%;
          background-repeat: no-repeat;
          -webkit-background-size: cover;
                  background-size: cover;
        <?php endif; ?>
      }

      .tco-under-construction-overlay {
        position: fixed;
        top: <?php echo ( $admin_bar_is_showing ) ? '32px' : '0' ; ?>;
        left: 0;
        right: 0;
        bottom: 0;
        overflow-x: hidden;
        overflow-y: auto;
        z-index: 99999;
      }

      .tco-under-construction-wrap-outer {
        display: table;
        width: 100%;
        height: 100%;
      }

      .tco-under-construction-wrap-inner {
        display: table-cell;
        vertical-align: middle;
        padding: 55px 35px;
      }

      .tco-under-construction {
        display: block;
        overflow: auto;
        margin: 0 auto;
        matco-width: 600px;
        font-family: Lato, "Helvetica Neue", Helvetica, sans-serif;
        text-align: center;
      }


      /*
      // Components.
      */

      .tco-under-construction h1 {
        margin: 0 0 25px;
        font-family: Lato, "Helvetica Neue", Helvetica, sans-serif;
        font-size: 48px;
        font-weight: 300;
        line-height: 1;
        color: <?php echo $tco_under_construction_heading_color; ?>;
      }

      .tco-under-construction h2 {
        margin: 0;
        font-family: Lato, "Helvetica Neue", Helvetica, sans-serif;
        font-size: 24px;
        font-weight: 300;
        line-height: 1.4;
        color: <?php echo $tco_under_construction_subheading_color; ?>;
      }

      .tco-under-construction p {
        margin: 20px 0 0 0;
        font-family: Lato, "Helvetica Neue", Helvetica, sans-serif;
        font-size: 16px;
        font-weight: 300;
        line-height: 1.2;
        color: <?php echo $tco_under_construction_subheading_color; ?>;
      }

      .tco-under-construction input, .tco-under-construction button {
        display: inline-block;
        font-size: 12px;
        padding: 0;
      }

      .tco-under-construction-logo {
        margin: 20px 0;
      }

      .tco-under-construction-countdown {
        margin: 20px 0 20px 0;
        font-size: 18px;
        font-weight: 300;
        line-height: 1;
        color: <?php echo $tco_under_construction_date_color; ?>;
      }

      .tco-under-construction-countdown span {
        margin: 0 3px;
        display: inline-block;
        border: 1px solid;
        padding: 10px 12px;
        line-height: 1;
        border-radius: 4px;
      }

      .tco-under-construction-social {
        margin: 30px 0 0;
      }

      .tco-under-construction-social a {
        padding: 0 6px;
        font-size: 24px;
        line-height: 1;
        color: <?php echo $tco_under_construction_social_color; ?>;
        opacity: 0.25;
        transition: opacity 0.3s ease;
      }

      .tco-under-construction-social a:hover {
        opacity: 1;
      }

      .backstretch {
        display: none;
      }


      /*
      // Responsive.
      */

      <?php if ( $admin_bar_is_showing ) : ?>

        @media (matco-width: 782px) {
          .tco-under-construction-overlay {
            top: 46px;
          }
        }

        @media (matco-width: 600px) {
          .tco-under-construction-overlay {
            top: 0;
          }
        }

      <?php endif; ?>

      @media (matco-width: 768px) {
        .tco-under-construction h1 {
          font-size: 32px;
        }

        .tco-under-construction h2 {
          font-size: 21px;
        }

        .tco-under-construction p {
          font-size: 16px;
        }
      }

      @media (matco-width: 580px) {
        .tco-under-construction-countdown span {
          display: block;
          margin: 10px 0 0;
          width: calc(50% - 5px);
        }

        .tco-under-construction-countdown span:nth-child(odd) {
          float: left;
        }

        .tco-under-construction-countdown span:nth-child(even) {
          float: right;
        }
      }

      [class*="tco-icon-"]{
        display:inline-block;
        font-family:"FontAwesome";
        font-style:normal;
        font-weight:normal;
        text-decoration:inherit;
        text-rendering:auto;
        -webkit-font-smoothing:antialiased;
        -moz-osx-font-smoothing:grayscale;
      }
      [data-tco-icon].left,[class*="tco-icon-"].left{
        margin-right:0.5em
      }
      [data-tco-icon].right,[class*="tco-icon-"].right{
        margin-left:0.5em
      }
      [data-tco-icon]:before,[class*="tco-icon-"]:before{
        content:attr(data-tco-icon);line-height:1
      }

      .tco-icon-facebook-square:before { content: "\f082"; }
      .tco-icon-twitter-square:before { content: "\f081"; }
      .tco-icon-google-plus-square:before { content: "\f0d4"; }
      .tco-icon-linkedin-square:before { content: "\f08c"; }
      .tco-icon-xing-square:before { content: "\f169"; }
      .tco-icon-foursquare:before { content: "\f180"; }
      .tco-icon-youtube-square:before { content: "\f166"; }
      .tco-icon-vimeo-square:before { content: "\f194"; }
      .tco-icon-instagram-square:before { content: "\f16d"; }
      .tco-icon-dribbble-square:before { content: "\f17d"; }
      .tco-icon-flickr-square:before { content: "\f16e"; }
      .tco-icon-github-square:before { content: "\f092"; }
      .tco-icon-behance-square:before { content: "\f1b5"; }
      .tco-icon-tumblr-square:before { content: "\f174"; }
      .tco-icon-whatsapp-square:before { content: "\f232"; }
      .tco-icon-soundcloud-square:before { content: "\f1be"; }
      .tco-icon-rss-square:before { content: "\f143"; }

      <?php if ( isset( $tco_under_construction_bypass_password ) && !empty ( $tco_under_construction_bypass_password ) ) : ?>
        #tco-under-construction-bypass {
          z-index: 10000;
          position: fixed;
          right: 10px;
          bottom: 20px;
          padding: 10px;
          width: 350px;
          height: 30px;
        }

        #tco-under-construction-bypass-toggle {
          float: right;
          padding-left: 10px;
          cursor: pointer;
        }

        #tco-under-construction-bypass-form {
          float: right;
          display: none;
        }

        #tco-under-construction-bypass span {
          font-size: 30px;
          width: 30px;
          height: 30px;
        }

        #tco-under-construction-bypass input {
          font-size: 12px;
          width: 160px;
          height: 30px;
        }

        #tco-under-construction-bypass button {
          margin: -10px 0 0 0;
          width: 80px;
          height: 30px;
        }
      <?php endif; ?>
    </style>

    <?php endif;

  }

}

add_action( 'wp_head', 'tco_under_construction_output_site_styles', 9998, 0 );

// Enqueue Admin Styles
// =============================================================================

function tco_under_construction_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-under-construction',
    'theme_page_x-extensions-under-construction',
    'x_page_x-extensions-under-construction',
    'x_page_tco-extensions-under-construction',
    'x-pro_page_x-extensions-under-construction',
    'pro_page_tco-extensions-under-construction',
    'tco-extensions-under-construction',
    'settings_page_tco-extensions-under-construction',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'jquery-ui-datepicker', TCO_UNDER_CONSTRUCTION_URL . '/css/admin/ui-datepicker.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'tco-under-construction-admin-css', TCO_UNDER_CONSTRUCTION_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_under_construction_enqueue_admin_styles' );
