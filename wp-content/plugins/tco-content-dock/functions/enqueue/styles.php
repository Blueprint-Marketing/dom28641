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

function tco_content_dock_output_site_styles() {

  require( TCO_CONTENT_DOCK_PATH . '/functions/options.php' );

  $display = false;

  // Active for all pages

  if ( is_page() && isset( $tco_content_dock_all_pages_active ) && $tco_content_dock_all_pages_active ) {
    $display = true;
  }

  // Page is on the list

  if ( is_page( $tco_content_dock_entries_include ) ) {
    $display = true;
  }

  // Active for all posts

  if ( is_single() && isset( $tco_content_dock_all_posts_active ) && $tco_content_dock_all_posts_active ) {
    $display = true;
  }

  // Post is on the list

  if ( is_single( $tco_content_dock_posts_include ) ) {
    $display = true;
  }

  // Active for all WooCommerce products

  if ( is_single() && isset( $tco_content_dock_woo_products_include ) && $tco_content_dock_woo_products_include ) {
    $display = true;
  }

  // WooCommerce product is on the list

  if ( is_single( $tco_content_dock_woo_products_include ) ) {
    $display = true;
  }

  // If x_content_dock_do_not_show cookie is set, ignore content-dock
  if( isset( $_COOKIE['tco_content_dock_do_not_show'] ) ) {
    $display = false;
  }

  // Render conditionally

  if ( $display ) :

    ?><style id="tco-content-dock-generated-css" type="text/css">

      /*
      // Base styles.
      */
      .visually-hidden {
        overflow: hidden;
        position: absolute;
        width: 1px;
        height: 1px;
        margin: -1px;
        border: 0;
        padding: 0;
        clip: rect(0 0 0 0);
      }

      .visually-hidden.focusable:active,
      .visually-hidden.focusable:focus {
        clip: auto;
        height: auto;
        margin: 0;
        overflow: visible;
        position: static;
        width: auto;
      }

      .tco-content-dock {
        position: fixed;
        bottom: 0;
        border: 1px solid <?php echo $tco_content_dock_border_color; ?>;
        border-bottom: 0;
        padding: 30px;
        background-color: <?php echo $tco_content_dock_background_color; ?>;
        z-index: 1050;
        -webkit-transition: all 0.5s ease;
                transition: all 0.5s ease;
        -webkit-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
        <?php if ( $tco_content_dock_box_shadow == 1 ) { ?>
          box-shadow: 0 0.085em 0.5em 0 rgba(0, 0, 0, 0.165);
        <?php } ?>
      }


      /*
      // Headings.
      */

      .tco-content-dock h1,
      .tco-content-dock h2,
      .tco-content-dock h3,
      .tco-content-dock h4,
      .tco-content-dock h5,
      .tco-content-dock h6 {
        color: <?php echo $tco_content_dock_headings_color; ?> !important;
      }


      /*
      // Links.
      */

      .tco-content-dock a:not(.tco-btn):not(.tco-recent-posts a) {
        color: <?php echo $tco_content_dock_link_color; ?> !important;
      }

      .tco-content-dock a:not(.tco-btn):not(.tco-recent-posts a):hover {
        color: <?php echo $tco_content_dock_link_hover_color; ?> !important;
      }


      /*
      // Widget styles.
      */

      .tco-content-dock .widget {
        text-shadow: none;
        color: <?php echo $tco_content_dock_text_color; ?> !important;
      }

      .tco-content-dock .widget:before {
        display: none;
      }

      .tco-content-dock .h-widget {
        margin: 0 0 0.5em;
        font-size: 1.65em;
        line-height: 1.2;
      }


      /*
      // Close.
      */

      .tco-close-content-dock {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 12px;
        line-height: 1;
        text-decoration: none;
      }

      .tco-close-content-dock span {
        color: <?php echo $tco_content_dock_close_button_color; ?> !important;
        -webkit-transition: color 0.3s ease;
                transition: color 0.3s ease;
      }

      .tco-close-content-dock:hover span {
        color: <?php echo $tco_content_dock_close_button_hover_color; ?> !important;
      }


      /*
      // Responsive.
      */

      @media (matco-width: 767px) {
        .tco-content-dock {
          display: none;
        }
      }

</style>
  <?php endif;

}

add_action( 'wp_head', 'tco_content_dock_output_site_styles', 9996, 0 );



// Enqueue Admin Styles
// =============================================================================

function tco_content_dock_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-content-dock',
    'theme_page_x-extensions-content-dock',
    'x_page_x-extensions-content-dock',
    'x-pro_page_x-extensions-content-dock',
    'tco-extensions-content-dock',
    'settings_page_tco-extensions-content-dock',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'tco-content-dock-admin-css', TCO_CONTENT_DOCK_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_content_dock_enqueue_admin_styles' );
