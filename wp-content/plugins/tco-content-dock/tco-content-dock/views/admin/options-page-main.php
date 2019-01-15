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
              <label for="tco_content_dock_enable">
                <strong><?php _e( 'Enable Content Dock', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_content_dock_enable" id="tco_content_dock_enable" value="1" <?php echo ( isset( $tco_content_dock_enable ) && checked( $tco_content_dock_enable, '1', false ) ) ? checked( $tco_content_dock_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_content_dock_enable ) && $tco_content_dock_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_content_dock_position">
                <strong><?php _e( 'Position', '__tco__' ); ?></strong>
                <span><?php _e( 'Which side of the screen you want the Content Dock to appear.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                <label class="radio-label"><input type="radio" class="radio" name="tco_content_dock_position" value="left" <?php echo ( isset( $tco_content_dock_position ) && checked( $tco_content_dock_position, 'left', false ) ) ? checked( $tco_content_dock_position, 'left', false ) : 'checked="checked"'; ?>> <span><?php _e( 'Left', '__tco__' ); ?></span></label><br>
                <label class="radio-label"><input type="radio" class="radio" name="tco_content_dock_position" value="right" <?php echo ( isset( $tco_content_dock_position ) && checked( $tco_content_dock_position, 'right', false ) ) ? checked( $tco_content_dock_position, 'right', false ) : ''; ?>> <span><?php _e( 'Right', '__tco__' ); ?></span></label>
              </fieldset>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_width">
                <strong><?php _e( 'Width (px)', '__tco__' ); ?></strong>
                <span><?php _e( 'Valid inputs are between 250 and 450 in increments of 10.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_width" id="tco_content_dock_width" type="number" step="10" min="250" max="450" value="<?php echo ( isset( $tco_content_dock_width ) ) ? $tco_content_dock_width : 350; ?>" class="small-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_display">
                <strong><?php _e( 'Display (%)', '__tco__' ); ?></strong>
                <span><?php _e( 'Valid inputs are between 5 and 95 in increments of 5.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_display" id="tco_content_dock_display" type="number" step="5" min="5" max="95" value="<?php echo ( isset( $tco_content_dock_display ) ) ? $tco_content_dock_display : 50; ?>" class="small-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_trigger_timeout">
                <strong><?php _e( 'Auto trigger timeout (%)', '__tco__' ); ?></strong>
                <span><?php _e( 'Display content dock after "n" seconds if user doesn\'t reach the bottom of the page. "0" means disable this feature.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_trigger_timeout" id="tco_content_dock_trigger_timeout" type="number" step="1" min="0" max="120" value="<?php echo ( isset( $tco_content_dock_trigger_timeout ) ) ? $tco_content_dock_trigger_timeout : 0; ?>" class="small-text"> seconds</td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_cookie_timeout">
                <strong><?php _e( '"Do not show again" cookie timeout (%)', '__tco__' ); ?></strong>
                <span><?php _e( 'How many days content dock will not appear for the user if he checks "Do not show again" checkbox. "0" means disable this feature.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_cookie_timeout" id="tco_content_dock_cookie_timeout" type="number" step="1" min="0" max="360" value="<?php echo ( isset( $tco_content_dock_cookie_timeout ) ) ? $tco_content_dock_cookie_timeout : 0; ?>" class="small-text"> days</td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_all_pages_active">
                <strong><?php _e( 'Active for all pages', '__tco__' ); ?></strong>
                <span><?php _e( 'Activate for all pages (including created on the future) without to add one by one to the list below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_content_dock_all_pages_active" id="tco_content_dock_all_pages_active" value="1" <?php echo ( isset( $tco_content_dock_all_pages_active ) && checked( $tco_content_dock_all_pages_active, '1', false ) ) ? checked( $tco_content_dock_all_pages_active, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr id="tco_content_dock_entries_include_row" style="display:none">
            <th>
              <label for="tco_content_dock_entries_include">
                <strong><?php _e( 'Include Pages', '__tco__' ); ?></strong>
                <span><?php _e( 'Select the pages or posts that you want the Content Dock to appear on.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <select name="tco_content_dock_entries_include[]" id="tco_content_dock_entries_include" multiple="multiple">
                <?php
                foreach ( $tco_content_dock_list_entries_master as $key => $value ) {
                  if ( in_array( $key, $tco_content_dock_entries_include ) ) {
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

          <tr>
            <th>
              <label for="tco_content_dock_all_posts_active">
                <strong><?php _e( 'Active for all posts', '__tco__' ); ?></strong>
                <span><?php _e( 'Activate for all posts (including created on the future) without to add one by one to the list below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_content_dock_all_posts_active" id="tco_content_dock_all_posts_active" value="1" <?php echo ( isset( $tco_content_dock_all_posts_active ) && checked( $tco_content_dock_all_posts_active, '1', false ) ) ? checked( $tco_content_dock_all_posts_active, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr id="tco_content_dock_posts_include_row" style="display:none">
            <th>
              <label for="tco_content_dock_posts_include">
                <strong><?php _e( 'Include Posts', '__tco__' ); ?></strong>
                <span><?php _e( 'Select the posts that you want the Content Dock to appear on.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <select name="tco_content_dock_posts_include[]" id="tco_content_dock_posts_include" multiple="multiple">
                <?php
                foreach ( $tco_content_dock_list_post_entries_master as $key => $value ) {
                  if ( in_array( $key, $tco_content_dock_posts_include ) ) {
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

          <?php if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) : ?>

            <tr>
              <th>
                <label for="tco_content_dock_all_woo_products_active">
                  <strong><?php _e( 'Active for all products', '__tco__' ); ?></strong>
                  <span><?php _e( 'Activate for all products (including created on the future) without to add one by one to the list below.', '__tco__' ); ?></span>
                </label>
              </th>
              <td>
                <fieldset>
                  <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                  <input type="checkbox" class="checkbox" name="tco_content_dock_all_woo_products_active" id="tco_content_dock_all_woo_products_active" value="1" <?php echo ( isset( $tco_content_dock_all_woo_products_active ) && checked( $tco_content_dock_all_woo_products_active, '1', false ) ) ? checked( $tco_content_dock_all_woo_products_active, '1', false ) : ''; ?>>
                </fieldset>
              </td>
            </tr>

            <tr id="tco_content_dock_woo_products_include_row" style="display:none">
              <th>
                <label for="tco_content_dock_woo_products_include">
                  <strong><?php _e( 'Include WooCommerce Products', '__tco__' ); ?></strong>
                  <span><?php _e( 'Select the products that you want the Content Dock to appear on.', '__tco__' ); ?></span>
                </label>
              </th>
              <td>
                <select name="tco_content_dock_woo_products_include[]" id="tco_content_dock_woo_products_include" multiple="multiple">
                  <?php
                  foreach ( $tco_content_dock_list_woo_products_master as $key => $value ) {
                    if ( in_array( $key, $tco_content_dock_woo_products_include ) ) {
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

          <?php endif; ?>

          <tr>
            <th>
              <label for="tco_content_dock_image_override_enable">
                <strong><?php _e( 'Use an override image and URL', '__tco__' ); ?></strong>
                <span><?php _e( 'If enabled an image will override content dock with URL as link.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_content_dock_image_override_enable" id="tco_content_dock_image_override_enable" value="1" <?php echo ( isset( $tco_content_dock_image_override_enable ) && checked( $tco_content_dock_image_override_enable, '1', false ) ) ? checked( $tco_content_dock_image_override_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr class="tco_content_dock_image_override_image_row" style="display:none">
            <th>
              <label for="tco_content_dock_image_override_image">
                <strong><?php _e( 'Override image', '__tco__' ); ?></strong>
                <span><?php _e( 'Image to override content dock.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <input type="text" class="file large-text" name="tco_content_dock_image_override_image" id="tco_content_dock_image_override_image" value="<?php echo ( isset( $tco_content_dock_image_override_image ) ) ? $tco_content_dock_image_override_image : ''; ?>">
              <input type="button" id="_tco_content_dock_image_override_image_image_upload_btn" data-id="tco_content_dock_image_override_image" class="button-secondary tco-upload-btn-cd" value="Upload Image">
              <div class="tco-meta-box-img-thumb-wrap" id="_tco_content_dock_image_override_image_thumb">
                  <?php if ( isset( $tco_content_dock_image_override_image ) && ! empty( $tco_content_dock_image_override_image ) ) : ?>
                     <div class="tco-uploader-image"><img src="<?php echo $tco_content_dock_image_override_image ?>" alt="" /></div>
                  <?php endif ?>
              </div>
            </td>
          </tr>

          <tr class="tco_content_dock_image_override_image_row" style="display:none">
            <th>
              <label for="tco_content_dock_image_override_url">
                <strong><?php _e( 'Override URL', '__tco__' ); ?></strong>
                <span><?php _e( 'URL for the link to override content dock.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_image_override_url" id="tco_content_dock_image_override_url" type="text" value="<?php echo ( isset( $tco_content_dock_image_override_url ) ) ? $tco_content_dock_image_override_url : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_text_color">
                <strong><?php _e( 'Text', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_text_color" id="tco_content_dock_text_color" type="text" value="<?php echo ( isset( $tco_content_dock_text_color ) ) ? $tco_content_dock_text_color : '#b5b5b5'; ?>" class="wp-color-picker" data-default-color="#b5b5b5"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_headings_color">
                <strong><?php _e( 'Headings', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_headings_color" id="tco_content_dock_headings_color" type="text" value="<?php echo ( isset( $tco_content_dock_headings_color ) ) ? $tco_content_dock_headings_color : '#272727'; ?>" class="wp-color-picker" data-default-color="#272727"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_link_color">
                <strong><?php _e( 'Link', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_link_color" id="tco_content_dock_link_color" type="text" value="<?php echo ( isset( $tco_content_dock_link_color ) ) ? $tco_content_dock_link_color : '#428bca'; ?>" class="wp-color-picker" data-default-color="#428bca"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_link_hover_color">
                <strong><?php _e( 'Link Hover', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_link_hover_color" id="tco_content_dock_link_hover_color" type="text" value="<?php echo ( isset( $tco_content_dock_link_hover_color ) ) ? $tco_content_dock_link_hover_color : '#2a6496'; ?>" class="wp-color-picker" data-default-color="#2a6496"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_close_button_color">
                <strong><?php _e( 'Close Button', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_close_button_color" id="tco_content_dock_close_button_color" type="text" value="<?php echo ( isset( $tco_content_dock_close_button_color ) ) ? $tco_content_dock_close_button_color : '#d9d9d9'; ?>" class="wp-color-picker" data-default-color="#d9d9d9"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_close_button_hover_color">
                <strong><?php _e( 'Close Button Hover', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_close_button_hover_color" id="tco_content_dock_close_button_hover_color" type="text" value="<?php echo ( isset( $tco_content_dock_close_button_hover_color ) ) ? $tco_content_dock_close_button_hover_color : '#428bca'; ?>" class="wp-color-picker" data-default-color="#428bca"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_border_color">
                <strong><?php _e( 'Border', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_border_color" id="tco_content_dock_border_color" type="text" value="<?php echo ( isset( $tco_content_dock_border_color ) ) ? $tco_content_dock_border_color : '#e5e5e5'; ?>" class="wp-color-picker" data-default-color="#e5e5e5"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_background_color">
                <strong><?php _e( 'Background', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_content_dock_background_color" id="tco_content_dock_background_color" type="text" value="<?php echo ( isset( $tco_content_dock_background_color ) ) ? $tco_content_dock_background_color : '#ffffff'; ?>" class="wp-color-picker" data-default-color="#ffffff"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_content_dock_box_shadow">
                <strong><?php _e( 'Box Shadow', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable a shadow around the Content Dock.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_content_dock_box_shadow" id="tco_content_dock_box_shadow" value="1" <?php echo ( isset( $tco_content_dock_box_shadow ) && checked( $tco_content_dock_box_shadow, '1', false ) ) ? checked( $tco_content_dock_box_shadow, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

  </div>
</div>
