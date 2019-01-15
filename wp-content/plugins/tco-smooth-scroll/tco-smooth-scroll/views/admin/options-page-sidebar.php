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
        <p class="cf"><input id="submit" class="button button-primary" type="submit" name="tco_smooth_scroll_submit" value="Update"></p>
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

          <dt class="toggle"><?php _e( 'Step &amp; Scroll Speed', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'Alter these settings to suit your needs by making incremental adjustments, then saving and viewing their changes on the frontend of your website.', '__tco__' ); ?></p>
            </div>
          </dd>

          <dt class="toggle"><?php _e( 'Support', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'For questions, please visit our <a href="//theme.co/x/member/kb/extension-smooth-scroll/" target="_blank">Knowledge Base tutorial</a> for this plugin.', '__tco__' ); ?></p>
            </div>
          </dd>

        </dl>
      </div>
    </div>

  </div>
</div>