<?php

// =============================================================================
// VIEWS/ADMIN/OPTIONS-PAGE.PHP
// -----------------------------------------------------------------------------
// Plugin options page.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Permissions Check
//   02. Require Options
//   03. Options Page Output
// =============================================================================

// Permissions Check
// =============================================================================

if ( ! current_user_can( 'manage_options' ) ) {
  wp_die( 'You do not have sufficient permissions to access this page.' );
}



// Require Options
// =============================================================================

require( TCO_CONTENT_DOCK_PATH . '/functions/options.php' );



// Options Page Output
// =============================================================================

//
// Setup array of all pages and posts.
//

// Pages

$tco_content_dock_list_entries_args   = array( 'posts_per_page' => -1 );
$tco_content_dock_list_entries_merge  = get_pages( $tco_content_dock_list_entries_args );
$tco_content_dock_list_entries_master = array();

foreach ( $tco_content_dock_list_entries_merge as $post ) {
  $tco_content_dock_list_entries_master[$post->ID] = $post->post_title;
}

asort( $tco_content_dock_list_entries_master );


// Posts

$tco_content_dock_list_post_entries_args   = array( 'posts_per_page' => -1 );
$tco_content_dock_list_post_entries_merge  = get_posts( $tco_content_dock_list_entries_args );
$tco_content_dock_list_post_entries_master = array();

foreach ( $tco_content_dock_list_post_entries_merge as $post ) {
  $tco_content_dock_list_post_entries_master[$post->ID] = $post->post_title;
}

asort( $tco_content_dock_list_post_entries_master );


// WooCommerce

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) )  {

  $tco_content_dock_list_woo_products_args   = array( 'posts_per_page' => -1, 'post_type' => 'product' );
  $tco_content_dock_list_woo_products_merge  = get_posts( $tco_content_dock_list_woo_products_args );
  $tco_content_dock_list_woo_products_master = array();

  foreach ( $tco_content_dock_list_woo_products_merge as $post ) {
    $tco_content_dock_list_woo_products_master[$post->ID] = $post->post_title;
  }

  asort( $tco_content_dock_list_woo_products_master );

}



//
// Check if variables are set to prevent notices. Variables are set after the
// first submission of data.
//

$tco_content_dock_entries_include = ( isset( $tco_content_dock_entries_include ) ) ? $tco_content_dock_entries_include : array();

?>

<div class="wrap tco-plugin tco-content-dock">
  <h2><?php _e( 'Content Dock', '__tco__' ); ?></h2>
  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
      <form name="tco_content_dock_form" method="post" action="">
        <input name="tco_content_dock_form_submitted" type="hidden" value="submitted">

        <?php require( 'options-page-main.php' ); ?>
        <?php require( 'options-page-sidebar.php' ); ?>

      </form>
    </div>
    <br class="clear">
  </div>
</div>
