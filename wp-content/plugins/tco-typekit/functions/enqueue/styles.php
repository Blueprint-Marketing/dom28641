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

function tco_typekit_output_site_styles() {

  require( TCO_TYPEKIT_PATH . '/functions/options.php' );

  if ( isset( $tco_typekit_enable ) && $tco_typekit_enable == 1 ) :

  ?><style id="tco-typekit-generated-css" type="text/css">

    /*
    // Hide text while Typekit is loading.
    */

    .wf-loading a,
    .wf-loading p,
    .wf-loading ul,
    .wf-loading ol,
    .wf-loading dl,
    .wf-loading h1,
    .wf-loading h2,
    .wf-loading h3,
    .wf-loading h4,
    .wf-loading h5,
    .wf-loading h6,
    .wf-loading em,
    .wf-loading pre,
    .wf-loading cite,
    .wf-loading span,
    .wf-loading table,
    .wf-loading strong,
    .wf-loading blockquote {
      visibility: hidden !important;
    }
</style>
  <?php

  endif;

}

add_action( 'wp_head', 'tco_typekit_output_site_styles', 9997, 0 );



// Enqueue Admin Styles
// =============================================================================

function tco_typekit_enqueue_admin_styles( $hook ) {

  $hook_prefixes = array(
    'addons_page_x-extensions-typekit',
    'theme_page_x-extensions-typekit',
    'tco_page_x-extensions-typekit',
    'x-pro_page_x-extensions-typekit',
    'tco-extensions-typekit',
    'settings_page_tco-extensions-typekit',
  );

  if ( in_array($hook, $hook_prefixes) ) {

    wp_enqueue_style( 'postbox' );
    wp_enqueue_style( 'tco-typekit-admin-css', TCO_TYPEKIT_URL . '/css/admin/style.css', NULL, NULL, 'all' );

  }

}

add_action( 'admin_enqueue_scripts', 'tco_typekit_enqueue_admin_styles' );
