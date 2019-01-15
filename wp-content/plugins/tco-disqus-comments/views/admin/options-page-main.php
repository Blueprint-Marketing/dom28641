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
              <label for="tco_disqus_comments_enable">
                <strong><?php _e( 'Enable Disqus Comments', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_disqus_comments_enable" id="tco_disqus_comments_enable" value="1" <?php echo ( isset( $tco_disqus_comments_enable ) && checked( $tco_disqus_comments_enable, '1', false ) ) ? checked( $tco_disqus_comments_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_disqus_comments_enable ) && $tco_disqus_comments_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_disqus_comments_shortname">
                <strong><?php _e( 'Shortname', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in the shortname for your website. This is generated in your Disqus account. If your website name in Disqus is setup as "My Site," this can be found under Admin &gt; Settings &gt; My Site &gt; General &gt; Site Identity.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_disqus_comments_shortname" id="tco_disqus_comments_shortname" type="text" value="<?php echo ( isset( $tco_disqus_comments_shortname ) ) ? $tco_disqus_comments_shortname : ''; ?>" class="large-text"></td>
          </tr>

          <tr>
            <th>
              <label for="tco_disqus_comments_lazy_load">
                <strong><?php _e( 'Lazy Loading', '__tco__' ); ?></strong>
                <span><?php _e( 'Configure lazy loading for better performance.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <select name="tco_disqus_comments_lazy_load" id="tco_disqus_comments_lazy_load" class="large-text">
                <?php
                $lazy_load_options = array(
                  'normal'          => __( 'Normal (disabled lazy loading)', '__tco__'),
                  'on-scroll'       => __( 'On Scroll', '__tco__'),
                  'on-scroll-start' => __( 'On Scroll Start', '__tco__'),
                );
                foreach ( $lazy_load_options as $value => $label ) : ?>
                  <option value="<?php echo $value ?>" <?php echo isset($tco_disqus_comments_lazy_load) ? selected($tco_disqus_comments_lazy_load, $value) : ''; ?>><?php echo $label ?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>

          <tr>
            <th>
              <label for="tco_disqus_comments_exclude_post_types">
                <strong><?php _e( 'Exclude post types', '__tco__' ); ?></strong>
                <span><?php _e( 'Select the post types you do not want Disqus to appear on.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <select name="tco_disqus_comments_exclude_post_types[]" id="tco_disqus_comments_exclude_post_types" multiple="multiple">
                <?php
                foreach ( $tco_disqus_comments_post_types_list as $key => $value ) {
                  if ( isset($tco_disqus_comments_exclude_post_types) && is_array($tco_disqus_comments_exclude_post_types) && in_array( $key, $tco_disqus_comments_exclude_post_types ) ) {
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
