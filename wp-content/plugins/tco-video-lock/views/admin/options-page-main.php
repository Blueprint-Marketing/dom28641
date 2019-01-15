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
              <label for="tco_video_lock_enable">
                <strong><?php _e( 'Enable Video Lock', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_video_lock_enable" id="tco_video_lock_enable" value="1" <?php echo ( isset( $tco_video_lock_enable ) && checked( $tco_video_lock_enable, '1', false ) ) ? checked( $tco_video_lock_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_video_lock_enable ) && $tco_video_lock_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_video_lock_delay">
                <strong><?php _e( 'Delay (s)', '__tco__' ); ?></strong>
                <span><?php _e( 'Amount of time to pass (in seconds) before Video Lock should appear on the screen.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_delay" id="tco_video_lock_delay" type="number" step="1" min="0" value="<?php echo ( isset( $tco_video_lock_delay ) ) ? $tco_video_lock_delay : '10'; ?>" class="small-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_width">
                <strong><?php _e( 'Width (px)', '__tco__' ); ?></strong>
                <span><?php _e( 'Valid inputs are between 450 and 850 in increments of 10.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_width" id="tco_video_lock_width" type="number" step="10" min="450" max="850" value="<?php echo ( isset( $tco_video_lock_width ) ) ? $tco_video_lock_width : '750'; ?>" class="small-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_heading_enable">
                <strong><?php _e( 'Enable Heading', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the Video Lock heading.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_video_lock_heading_enable" id="tco_video_lock_heading_enable" value="1" <?php echo ( isset( $tco_video_lock_heading_enable ) && checked( $tco_video_lock_heading_enable, '1', false ) ) ? checked( $tco_video_lock_heading_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_heading">
                <strong><?php _e( 'Heading', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in your desired heading.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_heading" id="tco_video_lock_heading" type="text" value="<?php echo ( isset( $tco_video_lock_heading ) ) ? $tco_video_lock_heading : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_heading_color">
                <strong><?php _e( 'Heading Color', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your heading color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_heading_color" id="tco_video_lock_heading_color" type="text" value="<?php echo ( isset( $tco_video_lock_heading_color ) ) ? $tco_video_lock_heading_color : '#272727'; ?>" class="wp-color-picker" data-default-color="#272727"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_subheading_enable">
                <strong><?php _e( 'Enable Subheading', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the Video Lock subheading.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_video_lock_subheading_enable" id="tco_video_lock_subheading_enable" value="1" <?php echo ( isset( $tco_video_lock_subheading_enable ) && checked( $tco_video_lock_subheading_enable, '1', false ) ) ? checked( $tco_video_lock_subheading_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_subheading">
                <strong><?php _e( 'Subheading', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in your desired subheading.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_subheading" id="tco_video_lock_subheading" type="text" value="<?php echo ( isset( $tco_video_lock_subheading ) ) ? $tco_video_lock_subheading : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_subheading_color">
                <strong><?php _e( 'Subheading Color', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your subheading color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_subheading_color" id="tco_video_lock_subheading_color" type="text" value="<?php echo ( isset( $tco_video_lock_subheading_color ) ) ? $tco_video_lock_subheading_color : '#999999'; ?>" class="wp-color-picker" data-default-color="#999999"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_source">
                <strong><?php _e( 'Source', '__tco__' ); ?></strong>
                <span><?php _e( 'You may either self-host your video embed from a third party service.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                <label class="radio-label"><input type="radio" class="radio" name="tco_video_lock_source" value="self-hosted" <?php echo ( isset( $tco_video_lock_source ) && checked( $tco_video_lock_source, 'self-hosted', false ) ) ? checked( $tco_video_lock_source, 'self-hosted', false ) : 'checked="checked"'; ?>> <span><?php _e( 'Self-hosted', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_video_lock_source" value="third-party" <?php echo ( isset( $tco_video_lock_source ) && checked( $tco_video_lock_source, 'third-party', false ) ) ? checked( $tco_video_lock_source, 'third-party', false ) : ''; ?>> <span><?php _e( 'Third Party', '__tco__' ); ?></span></label>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_video">
                <strong><?php _e( 'Video', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in the URL to your self-hosted video in mp4 format.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_video" id="tco_video_lock_video" type="text" value="<?php echo ( isset( $tco_video_lock_video ) ) ? $tco_video_lock_video : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_video_poster">
                <strong><?php _e( 'Video Poster', '__tco__' ); ?></strong>
                <span><?php _e( 'Select a poster image to be used as an initial image if autoplay is disabled.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_video_poster" id="tco_video_lock_video_poster" type="text" value="<?php echo ( isset( $tco_video_lock_video_poster ) ) ? $tco_video_lock_video_poster : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_video_autoplay_enable">
                <strong><?php _e( 'Enable Video Autoplay', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable video autoplay.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_video_lock_video_autoplay_enable" id="tco_video_lock_video_autoplay_enable" value="1" <?php echo ( isset( $tco_video_lock_video_autoplay_enable ) && checked( $tco_video_lock_video_autoplay_enable, '1', false ) ) ? checked( $tco_video_lock_video_autoplay_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_video_controls_disable">
                <strong><?php _e( 'Disable Video Controls', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to disable video controls.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_video_lock_video_controls_disable" id="tco_video_lock_video_controls_disable" value="1" <?php echo ( isset( $tco_video_lock_video_controls_disable ) && checked( $tco_video_lock_video_controls_disable, '1', false ) ) ? checked( $tco_video_lock_video_controls_disable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_embed">
                <strong><?php _e( 'Embed Code', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in the embed code from your video provider. Only iframes are allowed in this input.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><textarea name="tco_video_lock_embed" id="tco_video_lock_embed" class="code"><?php echo ( isset( $tco_video_lock_embed ) ) ? esc_textarea( $tco_video_lock_embed ) : ''; ?></textarea>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_button_text">
                <strong><?php _e( 'Button Text', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in the text for your button.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_button_text" id="tco_video_lock_button_text" type="text" value="<?php echo ( isset( $tco_video_lock_button_text ) ) ? $tco_video_lock_button_text : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_button_link">
                <strong><?php _e( 'Button Link', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in the URL for where you would like your button to go.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_button_link" id="tco_video_lock_button_link" type="text" value="<?php echo ( isset( $tco_video_lock_button_link ) ) ? $tco_video_lock_button_link : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_button_style">
                <strong><?php _e( 'Button Style', '__tco__' ); ?></strong>
                <span><?php _e( 'Choose between your global button style or three pre-made marketing buttons.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                <label class="radio-label"><input type="radio" class="radio" name="tco_video_lock_button_style" value="global" <?php echo ( isset( $tco_video_lock_button_style ) && checked( $tco_video_lock_button_style, 'global', false ) ) ? checked( $tco_video_lock_button_style, 'global', false ) : 'checked="checked"'; ?>> <span><?php _e( 'Global', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_video_lock_button_style" value="marketing-red" <?php echo ( isset( $tco_video_lock_button_style ) && checked( $tco_video_lock_button_style, 'marketing-red', false ) ) ? checked( $tco_video_lock_button_style, 'marketing-red', false ) : ''; ?>> <span><?php _e( 'Marketing &ndash; Red', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_video_lock_button_style" value="marketing-yellow" <?php echo ( isset( $tco_video_lock_button_style ) && checked( $tco_video_lock_button_style, 'marketing-yellow', false ) ) ? checked( $tco_video_lock_button_style, 'marketing-yellow', false ) : ''; ?>> <span><?php _e( 'Marketing &ndash; Yellow', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_video_lock_button_style" value="marketing-green" <?php echo ( isset( $tco_video_lock_button_style ) && checked( $tco_video_lock_button_style, 'marketing-green', false ) ) ? checked( $tco_video_lock_button_style, 'marketing-green', false ) : ''; ?>> <span><?php _e( 'Marketing &ndash; Green', '__tco__' ); ?></span></label>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_button_delay">
                <strong><?php _e( 'Button Delay (s)', '__tco__' ); ?></strong>
                <span><?php _e( 'Amount of time to pass (in seconds) after Video Lock appears before the button should appear.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_video_lock_button_delay" id="tco_video_lock_button_delay" type="number" step="1" min="0" value="<?php echo ( isset( $tco_video_lock_button_delay ) ) ? $tco_video_lock_button_delay : '5'; ?>" class="small-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_close_enable">
                <strong><?php _e( 'Enable Close Button', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the Video Lock close button, allowing users to dismiss the plugin once it appears.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_video_lock_close_enable" id="tco_video_lock_close_enable" value="1" <?php echo ( isset( $tco_video_lock_close_enable ) && checked( $tco_video_lock_close_enable, '1', false ) ) ? checked( $tco_video_lock_close_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_video_lock_entries_include">
                <strong><?php _e( 'Include', '__tco__' ); ?></strong>
                <span><?php _e( 'Select the pages or posts that you want Video Lock to appear on.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <select name="tco_video_lock_entries_include[]" id="tco_video_lock_entries_include" multiple="multiple">
                <?php
                foreach ( $tco_video_lock_list_entries_master as $key => $value ) {
                  if ( in_array( $key, $tco_video_lock_entries_include ) ) {
                    $selected = ' selected="selected"';
                  } else {
                    $selected = '';
                  }
                  echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
                }
                ?>
              </select>
            </td>
          </tr>

        </table>
      </div>
    </div>

  </div>
</div>