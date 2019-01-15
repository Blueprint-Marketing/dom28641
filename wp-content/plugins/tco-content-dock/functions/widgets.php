<?php

// =============================================================================
// FUNCTIONS/WIDGETS.PHP
// -----------------------------------------------------------------------------
// Sets up the default widget areas for the Content Dock.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register Widget Area
// =============================================================================

// Register Widget Area
// =============================================================================

function tco_content_dock_widgets_init() {

  require( TCO_CONTENT_DOCK_PATH . '/functions/options.php' );

  if ( isset( $tco_content_dock_enable ) && $tco_content_dock_enable == 1 ) {

    register_sidebar( array(
      'name'          => __( 'Content Dock', '__tco__' ),
      'id'            => 'tco-content-dock',
      'description'   => __( 'Appears once a user scrolls down the page to a point specified in the plugin settings.', '__tco__' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="h-widget">',
      'after_title'   => '</h4>',
    ) );

  }

}

add_action( 'wp_loaded', 'tco_content_dock_widgets_init' );