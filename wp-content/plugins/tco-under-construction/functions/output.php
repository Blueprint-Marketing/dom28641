<?php

// =============================================================================
// FUNCTIONS/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Plugin output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Under Construction
//   02. Output
// =============================================================================

// Under Construction
// =============================================================================

function tco_under_construction_output( $original_template ) {

  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  if ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 && ! is_user_logged_in() ) {

    if( isset( $_COOKIE['tco_under_construction_bypass'] ) ) {
      return $original_template;
    }

    if ( isset( $tco_under_construction_whitelist ) && !empty( $tco_under_construction_whitelist ) ) {

      $allowed_ips = explode(' ', $tco_under_construction_whitelist);

      if ( in_array( $_SERVER['REMOTE_ADDR'], $allowed_ips) ) {

        return $original_template;

      }

    }

    status_header( 503 );

    if ( isset( $tco_under_construction_use_custom ) && $tco_under_construction_use_custom == 1 ) {
      return tco_under_construction_custom_output( $tco_under_construction_use_custom );
    } else {
      return TCO_UNDER_CONSTRUCTION_PATH . '/views/site/under-construction.php';
    }

  } else {

    return $original_template;

  }

}

function tco_under_construction_bypass_output () {

    require TCO_UNDER_CONSTRUCTION_PATH . '/views/site/bypass.php';

}


// Under Construction Custom Page
// =============================================================================

function tco_under_construction_custom_output( $original_template ) {

  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  $custom_post = get_post( (int) $tco_under_construction_custom );

  if ( ! is_a( $custom_post, 'WP_Post' ) ) {
    return $original_template;
  }

  GLOBAL $wp_query;
  GLOBAL $post;

  $post = $custom_post;

  $wp_query->posts             = array( $post );
  $wp_query->queried_object_id = $post->ID;
  $wp_query->queried_object    = $post;
  $wp_query->post_count        = 1;
  $wp_query->found_posts       = 1;
  $wp_query->max_num_pages     = 0;
  $wp_query->is_404            = false;
  $wp_query->is_page           = true;
  $wp_query->is_singular	     = true;

  if ( isset( $tco_under_construction_bypass_password ) && !empty ( $tco_under_construction_bypass_password ) ) {
    add_action( 'wp_footer', 'tco_under_construction_bypass_output' );
  }

  return get_page_template();
}



// Output
// =============================================================================

add_filter( 'template_include', 'tco_under_construction_output' );
