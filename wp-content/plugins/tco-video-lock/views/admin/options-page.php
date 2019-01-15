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

require( TCO_VIDEO_LOCK_PATH . '/functions/options.php' );



// Options Page Output
// =============================================================================

//
// Setup array of all pages and posts.
//

$tco_video_lock_list_entries_args   = array( 'posts_per_page' => -1 );
$tco_video_lock_list_entries_merge  = array_merge( get_pages( $tco_video_lock_list_entries_args ), get_posts( $tco_video_lock_list_entries_args ) );
$tco_video_lock_list_entries_master = array();

foreach ( $tco_video_lock_list_entries_merge as $post ) {
  $tco_video_lock_list_entries_master[$post->ID] = $post->post_title;
}

asort( $tco_video_lock_list_entries_master );


//
// Check if variables are set to prevent notices. Variables are set after the
// first submission of data.
//

$tco_video_lock_entries_include = ( isset( $tco_video_lock_entries_include ) ) ? $tco_video_lock_entries_include : array();

?>

<div class="wrap tco-plugin tco-video-lock">
  <h2><?php _e( 'Video Lock', '__tco__' ); ?></h2>
  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
      <form name="tco_video_lock_form" method="post" action="">
        <input name="tco_video_lock_form_submitted" type="hidden" value="submitted">

        <?php require( 'options-page-main.php' ); ?>
        <?php require( 'options-page-sidebar.php' ); ?>

      </form>
    </div>
    <br class="clear">
  </div>
</div>