<?php

// =============================================================================
// FUNCTIONS/NOTICES.PHP
// -----------------------------------------------------------------------------
// Plugin notices.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Notices
// =============================================================================

// Notices
// =============================================================================

function tco_disqus_comments_admin_notices() { ?>

  <?php if ( isset( $_POST['tco_disqus_comments_form_submitted'] ) ) : ?>
    <?php if ( strip_tags( $_POST['tco_disqus_comments_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) : ?>

      <div class="updated">
        <p><?php _e( '<strong>Huzzah!</strong> All settings have been successfully saved.', '__tco__' ); ?></p>
      </div>

    <?php endif; ?>
  <?php endif; ?>

  <?php if ( is_plugin_active( 'tco-facebook-comments/tco-facebook-comments.php' ) ) : ?>
    <?php if ( isset( $_GET['page'] ) && $_GET['page'] == 'tco-extensions-disqus-comments' ) : ?>

      <div class="error">
        <p><?php _e( 'You have <strong>Facebook Comments</strong> installed and activated on your website. Please ensure that only one comment Extension is active at a time by managing your <a href="' . admin_url( 'plugins.php' ) . '">plugins</a>.', '__tco__' ); ?></p>
      </div>

    <?php endif; ?>
  <?php endif; ?>

<?php }

add_action( 'admin_notices', 'tco_disqus_comments_admin_notices' );