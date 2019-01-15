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

require( TCO_TERMS_OF_USE_PATH . '/functions/options.php' );



// Options Page Output
// =============================================================================

//
// Setup array of all pages.
//

$tco_terms_of_use_list_entries_args   = array( 'posts_per_page' => -1 );
$tco_terms_of_use_list_entries        = get_pages( $tco_terms_of_use_list_entries_args );
$tco_terms_of_use_list_entries_master = array();

foreach ( $tco_terms_of_use_list_entries as $post ) {
  $tco_terms_of_use_list_entries_master[$post->ID] = $post->post_title;
}

asort( $tco_terms_of_use_list_entries_master );

?>

<div class="wrap tco-plugin tco-terms-of-use">
  <h2><?php _e( 'Terms of Use', '__tco__' ); ?></h2>
  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
      <form name="tco_terms_of_use_form" method="post" action="">
        <input name="tco_terms_of_use_form_submitted" type="hidden" value="submitted">

        <?php require( 'options-page-main.php' ); ?>
        <?php require( 'options-page-sidebar.php' ); ?>

      </form>
    </div>
    <br class="clear">
  </div>
</div>