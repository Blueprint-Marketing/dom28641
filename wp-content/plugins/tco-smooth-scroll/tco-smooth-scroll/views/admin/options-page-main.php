<?php

// =============================================================================
// VIEWS/ADMIN/OPTIONS-PAGE-MAIN.PHP
// -----------------------------------------------------------------------------
// Plugin options page main content.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Main Content
// =============================================================================

// Main Content
// =============================================================================

?>

<div id="post-body-content">
  <div class="meta-box-sortables ui-sortable">

    <!--
    ENABLE
    -->

    <div id="meta-box-enable" class="postbox">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Enable', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select the checkbox below to enable the plugin.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_smooth_scroll_enable">
                <strong><?php _e( 'Enable Smooth Scroll', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_smooth_scroll_enable" id="tco_smooth_scroll_enable" value="1" <?php echo ( isset( $tco_smooth_scroll_enable ) && checked( $tco_smooth_scroll_enable, '1', false ) ) ? checked( $tco_smooth_scroll_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_smooth_scroll_enable ) && $tco_smooth_scroll_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_smooth_scroll_step">
                <strong><?php _e( 'Step', '__tco__' ); ?></strong>
                <span><?php _e( 'The speed of the scrolling effect with a mouse wheel.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <input name="tco_smooth_scroll_step" id="tco_smooth_scroll_step" type="number" step="1" min="0" value="<?php echo ( isset( $tco_smooth_scroll_step ) ) ? $tco_smooth_scroll_step : 50; ?>" class="small-text">
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_smooth_scroll_speed">
                <strong><?php _e( 'Scroll Speed', '__tco__' ); ?></strong>
                <span><?php _e( 'The speed of the scrolling effect.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <input name="tco_smooth_scroll_speed" id="tco_smooth_scroll_speed" type="number" step="1" min="0" value="<?php echo ( isset( $tco_smooth_scroll_speed ) ) ? $tco_smooth_scroll_speed : 100; ?>" class="small-text">
            </td>
          </tr>

        </table>
      </div>
    </div>

  </div>
</div>