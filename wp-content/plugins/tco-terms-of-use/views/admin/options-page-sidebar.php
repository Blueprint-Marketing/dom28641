<?php

// =============================================================================
// VIEWS/ADMIN/OPTIONS-PAGE-SIDEBAR.PHP
// -----------------------------------------------------------------------------
// Plugin options page sidebar.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Sidebar
// =============================================================================

// Sidebar
// =============================================================================

?>

<div id="postbox-container-1" class="postbox-container">
  <div class="meta-box-sortables">

    <!--
    SAVE
    -->

    <div class="postbox">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Save', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Once you are satisfied with your settings, click the button below to save them.', '__tco__' ); ?></p>
        <p class="cf"><input id="submit" class="button button-primary" type="submit" name="tco_terms_of_use_submit" value="Update"></p>
      </div>
    </div>

    <!--
    ABOUT
    -->

    <div class="postbox">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'About', '__tco__' ); ?></span></h3>
      <div class="inside">
        <dl class="accordion">

          <dt class="toggle"><?php _e( 'Terms of Use Page', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'The page selected for this option will be linked out to when a user is signing up on the registration page.', '__tco__' ); ?></p>
            </div>
          </dd>

          <dt class="toggle"><?php _e( 'Support', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'For questions, please visit our <a href="//theme.co/x/member/kb/extension-terms-of-use/" target="_blank">Knowledge Base tutorial</a> for this plugin.', '__tco__' ); ?></p>
            </div>
          </dd>

        </dl>
      </div>
    </div>

  </div>
</div>