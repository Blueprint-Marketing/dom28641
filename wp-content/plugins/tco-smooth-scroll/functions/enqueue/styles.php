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

function tco_smooth_scroll_output_site_styles() {

  require( TCO_SMOOTH_SCROLL_PATH . '/functions/options.php' );

  if ( isset( $tco_smooth_scroll_enable ) && $tco_smooth_scroll_enable == 1 ) :
   ?><style id="tco-smooth-scroll-generated-css" type="text/css">

    html.tco-smooth-scroll {
      overflow-x: hidden !important;
      overflow-y: auto !important;
    }

    html.tco-smooth-scroll .nicescroll-rails {
      display: none !important;
    }
</style>

  <?php endif;

}

add_action( 'wp_head', 'tco_smooth_scroll_output_site_styles', 9996, 0 );


// Enqueue Admin Styles
// =============================================================================

function tco_smooth_scroll_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-smooth-scroll',
    'theme_page_x-extensions-smooth-scroll',
    'x_page_x-extensions-smooth-scroll',
    'x_page_tco-extensions-smooth-scroll',
    'x-pro_page_x-extensions-smooth-scroll',
    'pro_page_tco-extensions-smooth-scroll',
    'tco-extensions-smooth-scroll',
    'settings_page_tco-extensions-smooth-scroll',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-smooth-scroll-admin-css', TCO_SMOOTH_SCROLL_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_smooth_scroll_enqueue_admin_styles' );
