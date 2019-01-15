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
              <label for="tco_typekit_enable">
                <strong><?php _e( 'Enable Typekit', '__tco__' ); ?></strong>
                <span><?php _e( 'Select to enable the plugin and display options below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td>
              <fieldset>
                <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                <input type="checkbox" class="checkbox" name="tco_typekit_enable" id="tco_typekit_enable" value="1" <?php echo ( isset( $tco_typekit_enable ) && checked( $tco_typekit_enable, '1', false ) ) ? checked( $tco_typekit_enable, '1', false ) : ''; ?>>
              </fieldset>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!--
    SETTINGS
    -->

    <div id="meta-box-settings" class="postbox" style="display: <?php echo ( isset( $tco_typekit_enable ) && $tco_typekit_enable == 1 ) ? 'block' : 'none'; ?>;">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Settings', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Select your plugin settings below.', '__tco__' ); ?></p>
        <table class="form-table">

          <tr>
            <th>
              <label for="tco_typekit_kit_id">
                <strong><?php _e( 'Kit ID', '__tco__' ); ?></strong>
                <span><?php _e( 'Enter in the ID for your kit here. Only published data is accessible, so make sure that any changes you make to your kit are updated. Once published, your Typekit fonts will show up in the Customizer. If the ID you\'ve entered is invalid, you will not see any kit information below.', '__tco__' ); ?></span>
              </label>
            </th>
            <td><input name="tco_typekit_kit_id" id="tco_typekit_kit_id" type="text" value="<?php echo ( isset( $tco_typekit_kit_id ) ) ? $tco_typekit_kit_id : ''; ?>" class="large-text"></td>
          </tr>

          <?php if ( ! empty( $tco_typekit_request ) ) : ?>

            <tr>
              <th>
                <label for="tco_typekit_kit_information">
                  <strong><?php _e( 'Kit Information', '__tco__' ); ?></strong>
                  <span><?php _e( 'Only published information is displayed here, so make sure that you have published your kit on Typekit\'s website. If you alter your kit, remember to refresh this form (or save the plugin settings again) so that your updated information will be available.', '__tco__' ); ?></span>
                </label>
              </th>
              <td>
                <table class="info-table">
                  <tr>
                    <th><?php _e( 'Fonts', '__tco__' ); ?></th>
                    <th><?php _e( 'Weights', '__tco__' ); ?></th>
                  </tr>

                  <?php

                  foreach ( $tco_typekit_request as $font ) :

                    echo '<tr>';
                      echo '<td>' . $font['family'] . '</td>';
                      echo '<td>';

                      foreach ( $font['weights'] as $weight ) :

                        echo str_replace( 'italic', ' Italic', $weight );

                        if ( $weight != end( $font['weights'] ) ) {
                          echo ', ';
                        }

                      endforeach;

                      echo '</td>';
                    echo '</tr>';

                  endforeach;

                  ?>

                </table>
                <br>
                <button id="refresh" class="button"><?php _e( 'Refresh', '__tco__' ); ?></button>
              </td>
            </tr>

          <?php endif; ?>

        </table>
      </div>
    </div>

  </div>
</div>