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
              <label for="tco_under_construction_enable">
                <strong><?php _e( 'Enable Under Construction', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_under_construction_enable" id="tco_under_construction_enable" value="1" <?php echo ( isset( $tco_under_construction_enable ) && checked( $tco_under_construction_enable, '1', false ) ) ? checked( $tco_under_construction_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <!--
    CUSTOM PAGE SETTINGS
    -->

    <div id="meta-box-custom-settings" class="postbox" style="display: <?php echo ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Custom Under Construction Page Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select if you want a custom page or not.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_under_construction_use_custom">
                <strong><?php _e( 'Use a custom Under Construction Page', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to choose a custom page instead of configure options on this plugin.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_under_construction_use_custom" id="tco_under_construction_use_custom" value="1" <?php echo ( isset( $tco_under_construction_use_custom ) && checked( $tco_under_construction_use_custom, '1', false ) ) ? checked( $tco_under_construction_use_custom, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

          <tr id="tco_under_construction_custom_row">
            <th>
              <label for="tco_under_construction_custom">
                <strong><?php _e( 'Custom Under Construction Page', '__tco__' ); ?></strong>
                <span><?php _e( 'Select the page to be used in place of your site\'s standard under construction page.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <select name="tco_under_construction_custom" id="tco_under_construction_custom">
                <?php
                foreach ( $tco_under_construction_list_entries_master as $key => $value ) {
                  if ( isset( $tco_under_construction_custom ) && selected( $tco_under_construction_custom, $key, false ) ) {
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


    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_under_construction_heading">
                <strong><?php _e( 'Heading', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter your desired heading.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_heading" id="tco_under_construction_heading" type="text" value="<?php echo ( isset( $tco_under_construction_heading ) ) ? stripslashes( $tco_under_construction_heading ) : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_subheading">
                <strong><?php _e( 'Subheading', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter your desired subheading.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_subheading" id="tco_under_construction_subheading" type="text" value="<?php echo ( isset( $tco_under_construction_subheading ) ) ? stripslashes( $tco_under_construction_subheading ) : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_extra_text">
                <strong><?php _e( 'Extra Text', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter extra text to render below subheading. HTML not allowed, lines breaks will be preserved, rendered under &lt;p&gt; tag. Shortcodes allowed here, so you can add a form if you want.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><textarea name="tco_under_construction_extra_text" id="tco_under_construction_extra_text" class="large-text"><?php echo ( isset( $tco_under_construction_extra_text ) ) ? stripslashes( $tco_under_construction_extra_text ) : ''; ?></textarea></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_date">
                <strong><?php _e( 'Completed By', '__tco__' ); ?></strong>
                <span><?php _e( 'Set the date when maintenance is expected to be complete.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <input name="tco_under_construction_date_display" id="tco_under_construction_date_display" type="text" value="" class="large-text">
              <input name="tco_under_construction_date" id="tco_under_construction_date" type="text" value="<?php echo ( isset( $tco_under_construction_date ) ) ? $tco_under_construction_date : ''; ?>">
            </td>
          </tr>
          <script type="text/javascript">
            jQuery(document).ready(function($){
              $('#tco_under_construction_date_display').datepicker({
                altFormat: 'yy/mm/dd',
                altField: '#tco_under_construction_date'
              });
              $('#tco_under_construction_date_display').change(function() {
                if ($(this).val() == '') {
                  $('#tco_under_construction_date').val('');
                }
              })
              if ($('#tco_under_construction_date').val() != '') {
                $('#tco_under_construction_date_display').val((new Date($("#tco_under_construction_date").val())).toLocaleDateString('<?php echo get_bloginfo("language") ?>'));
              }
            });
          </script>

          <tr>
            <th>
              <label for="tco_under_construction_background_image">
                <strong><?php _e( 'Background Image', '__tco__' ); ?></strong>
                <span><?php _e( 'Optionally set a background image.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <input type="text" class="file large-text" name="tco_under_construction_background_image" id="tco_under_construction_background_image" value="<?php echo ( isset( $tco_under_construction_background_image ) ) ? $tco_under_construction_background_image : ''; ?>">
              <input type="button" id="tco_under_construction_background_image_image_upload_btn" data-id="tco_under_construction_background_image" class="button-secondary tco-upload-btn-uc" value="Upload Image">
              <div class="tco-meta-box-img-thumb-wrap" id="tco_under_construction_background_image_thumb">
                  <?php if ( isset( $tco_under_construction_background_image ) && ! empty( $tco_under_construction_background_image ) ) : ?>
                     <div class="tco-uploader-image"><img src="<?php echo $tco_under_construction_background_image ?>" alt="" /></div>
                  <?php endif ?>
              </div>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_logo_image">
                <strong><?php _e( 'Logo Image', '__tco__' ); ?></strong>
                <span><?php _e( 'Optionally set a logo image.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <input type="text" class="file large-text" name="tco_under_construction_logo_image" id="tco_under_construction_logo_image" value="<?php echo ( isset( $tco_under_construction_logo_image ) ) ? $tco_under_construction_logo_image : ''; ?>">
              <input type="button" id="tco_under_construction_logo_image_image_upload_btn" data-id="tco_under_construction_logo_image" class="button-secondary tco-upload-btn-uc" value="Upload Image">
              <div class="tco-meta-box-img-thumb-wrap" id="tco_under_construction_logo_image_thumb">
                  <?php if ( isset( $tco_under_construction_logo_image ) && ! empty( $tco_under_construction_logo_image ) ) : ?>
                     <div class="tco-uploader-image"><img src="<?php echo $tco_under_construction_logo_image ?>" alt="" /></div>
                  <?php endif ?>
              </div>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_background_color">
                <strong><?php _e( 'Background', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_background_color" id="tco_under_construction_background_color" type="text" value="<?php echo ( isset( $tco_under_construction_background_color ) ) ? $tco_under_construction_background_color : '#34495e'; ?>" class="wp-color-picker" data-default-color="#34495e"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_heading_color">
                <strong><?php _e( 'Headings', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_heading_color" id="tco_under_construction_heading_color" type="text" value="<?php echo ( isset( $tco_under_construction_heading_color ) ) ? $tco_under_construction_heading_color : '#ffffff'; ?>" class="wp-color-picker" data-default-color="#ffffff"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_subheading_color">
                <strong><?php _e( 'Subheading', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_subheading_color" id="tco_under_construction_subheading_color" type="text" value="<?php echo ( isset( $tco_under_construction_subheading_color ) ) ? $tco_under_construction_subheading_color : '#ffffff'; ?>" class="wp-color-picker" data-default-color="#ffffff"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_date_color">
                <strong><?php _e( 'Completed By', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_date_color" id="tco_under_construction_date_color" type="text" value="<?php echo ( isset( $tco_under_construction_date_color ) ) ? $tco_under_construction_date_color : '#ffffff'; ?>" class="wp-color-picker" data-default-color="#ffffff"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_under_construction_social_color">
                <strong><?php _e( 'Social Profile Links', '__tco__' ); ?></strong>
                <span><?php _e( 'Select your color.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_social_color" id="tco_under_construction_social_color" type="text" value="<?php echo ( isset( $tco_under_construction_social_color ) ) ? $tco_under_construction_social_color : '#ffffff'; ?>" class="wp-color-picker" data-default-color="#ffffff"></td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    BY PASS SETTINGS
    -->

    <div id="meta-box-bypass-settings" class="postbox" style="display: <?php echo ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'By Pass Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Define a password so not logged in users can by pass Under Construction using cookies.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_under_construction_bypass_password">
                <strong><?php _e( 'By Pass Password', '__tco__' ); ?></strong>
                <span><?php _e( 'A password to access the website normally. A key icon will appear on bottom right corner of the page.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_bypass_password" id="tco_under_construction_bypass_password" type="text" value="<?php echo ( isset( $tco_under_construction_bypass_password ) ) ? $tco_under_construction_bypass_password : ''; ?>"  class="large-text"></td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    WHITE LIST SETTINGS
    -->

    <div id="meta-box-whitelist-settings" class="postbox" style="display: <?php echo ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'White List Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Define some hosts to bypass Under Construction settings.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_under_construction_whitelist">
                <strong><?php _e( 'White List', '__tco__' ); ?></strong>
                <span><?php _e( 'Any access from IPs on this list (space separated) will ignore Under Construction settings and access the website normally.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_under_construction_whitelist" id="tco_under_construction_whitelist" type="text" value="<?php echo ( isset( $tco_under_construction_whitelist ) ) ? $tco_under_construction_whitelist : ''; ?>" placeholder="127.0.0.1 192.168.1.100"  class="large-text"></td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SOCIAL MEDIA SETTINGS
    -->

    <div id="meta-box-social-settings" class="postbox" style="display: <?php echo ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Social media settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Fill your social media URLs bellow.', '__tco__' ); ?></p>
        <table class="form-table">

          <?php
          foreach ( $social_medias as $key => $sc ) :
            $key = "tco_under_construction_{$key}";
            $sc_value = isset($$key) ? $$key : '';
          ?>
          <tr>
            <th>
              <label for="tco_under_construction_<?php echo $key ?>">
                <strong><?php echo sprintf( __( '%s Profile', '__tco__' ), $sc['title'] ); ?></strong>
                <span><?php echo sprintf( __( 'Enter the URL to your %s profile', '__tco__' ), $sc['title'] ); ?></span>
              </label>
            </th>
            <td><input name="<?php echo $key ?>" id="<?php echo $key ?>" type="text" value="<?php echo ( isset( $sc_value ) ) ? $sc_value : ''; ?>" class="large-text"></td>
          </tr>
        <?php endforeach; ?>

        </table>
      </div>
    </div>

  </div>
</div>
