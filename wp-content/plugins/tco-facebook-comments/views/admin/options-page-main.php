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
              <label for="tco_facebook_comments_enable">
                <strong><?php _e( 'Enable Facebook Comments', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_facebook_comments_enable" id="tco_facebook_comments_enable" value="1" <?php echo ( isset( $tco_facebook_comments_enable ) && checked( $tco_facebook_comments_enable, '1', false ) ) ? checked( $tco_facebook_comments_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_facebook_comments_enable ) && $tco_facebook_comments_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_facebook_comments_app_id">
                <strong><?php _e( 'App ID', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in your Facebook App ID.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_facebook_comments_app_id" id="tco_facebook_comments_app_id" type="text" value="<?php echo ( isset( $tco_facebook_comments_app_id ) ) ? $tco_facebook_comments_app_id : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_facebook_comments_app_secret">
                <strong><?php _e( 'App Secret', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in your Facebook App Secret.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_facebook_comments_app_secret" id="tco_facebook_comments_app_secret" type="text" value="<?php echo ( isset( $tco_facebook_comments_app_secret ) ) ? $tco_facebook_comments_app_secret : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_facebook_comments_number_posts">
                <strong><?php _e( 'Number Posts', '__tco__' ); ?></strong>
                <span><?php _e( 'Select the amount of posts per page to display. Valid inputs are between 5 and 500 in increments of 5.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_facebook_comments_number_posts" id="tco_facebook_comments_number_posts" type="number" step="5" min="5" max="500" value="<?php echo ( isset( $tco_facebook_comments_number_posts ) ) ? $tco_facebook_comments_number_posts : 10; ?>" class="small-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_facebook_comments_order_by">
                <strong><?php _e( 'Post Order', '__tco__' ); ?></strong>
                <span><?php _e( 'Choose the order for your posts. Selecting "Social" will bring what Facebook deems the highest quality comments to the surface.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                <label class="radio-label"><input type="radio" class="radio" name="tco_facebook_comments_order_by" value="time" <?php echo ( isset( $tco_facebook_comments_order_by ) && checked( $tco_facebook_comments_order_by, 'time', false ) ) ? checked( $tco_facebook_comments_order_by, 'time', false ) : 'checked="checked"'; ?>> <span><?php _e( 'Time', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_facebook_comments_order_by" value="reverse_time" <?php echo ( isset( $tco_facebook_comments_order_by ) && checked( $tco_facebook_comments_order_by, 'reverse_time', false ) ) ? checked( $tco_facebook_comments_order_by, 'reverse_time', false ) : ''; ?>> <span><?php _e( 'Reverse Time', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_facebook_comments_order_by" value="social" <?php echo ( isset( $tco_facebook_comments_order_by ) && checked( $tco_facebook_comments_order_by, 'social', false ) ) ? checked( $tco_facebook_comments_order_by, 'social', false ) : ''; ?>> <span><?php _e( 'Social', '__tco__' ); ?></span></label>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_facebook_comments_color_scheme">
                <strong><?php _e( 'Color Scheme', '__tco__' ); ?></strong>
                <span><?php _e( 'Choose which color scheme you would like for your comments.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                <label class="radio-label"><input type="radio" class="radio" name="tco_facebook_comments_color_scheme" value="light" <?php echo ( isset( $tco_facebook_comments_color_scheme ) && checked( $tco_facebook_comments_color_scheme, 'light', false ) ) ? checked( $tco_facebook_comments_color_scheme, 'light', false ) : 'checked="checked"'; ?>> <span><?php _e( 'Light', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_facebook_comments_color_scheme" value="dark" <?php echo ( isset( $tco_facebook_comments_color_scheme ) && checked( $tco_facebook_comments_color_scheme, 'dark', false ) ) ? checked( $tco_facebook_comments_color_scheme, 'dark', false ) : ''; ?>> <span><?php _e( 'Dark', '__tco__' ); ?></span></label>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

  </div>
</div>