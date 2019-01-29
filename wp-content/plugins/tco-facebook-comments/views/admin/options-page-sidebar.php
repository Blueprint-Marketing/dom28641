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
        <p class="cf"><input id="submit" class="button button-primary" type="submit" name="tco_facebook_comments_submit" value="Update"></p>
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

          <dt class="toggle"><?php _e( 'App ID / App Secret', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'To acquire a Facebook App ID and App Secret, go to the <a href="https://developers.facebook.com/" target="_blank">Facebook Developers</a> portal. Once there, select <b>Apps</b> &gt; <b>Add a New App</b> from the navbar.', '__tco__' ); ?></p>
              <p><?php _e( 'Next, select <b>Website</b> as your platform and follow the quickstart guide. Once you have completed this process, you will be able to acquire your App ID and App Secret from the application <b>Dashboard</b>.', '__tco__' ); ?></p>
            </div>
          </dd>

          <dt class="toggle"><?php _e( 'Support', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'For questions, please visit our <a href="//theme.co/x/member/kb/extension-facebook-comments/" target="_blank">Knowledge Base tutorial</a> for this plugin.', '__tco__' ); ?></p>
            </div>
          </dd>

        </dl>
      </div>
    </div>

  </div>
</div>