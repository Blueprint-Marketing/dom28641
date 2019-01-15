<?php

// =============================================================================
// VIEWS/ADMIN/METABOX-CONTACT-REQUIRED.PHP
// -----------------------------------------------------------------------------
// Required contact settings.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Metabox
// =============================================================================

// Metabox
// =============================================================================


?>

<p>
  <?php _e( 'This information is mandatory to properly generate the schema for the contact of your organization.', '__tco__' ); ?>
</p>

<input type="hidden" class="large-text" id="<?php echo $plugin_slug . '_contact_id'; ?>" />

<table class="form-table">

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_contact_type'; ?>">
        <strong><?php _e( 'Type', '__tco__' ); ?></strong>
        <span><?php _e( 'What kind of contact is this.', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <select class="select" id="<?php echo $plugin_slug . '_contact_type'; ?>">
        <?php if ( empty( $contact_type_list ) ) : ?>
          <option><?php _e( 'No Lists Found', '__tco__' ); ?></option>
        <?php else :
          $contact_type = isset($contact_type) ? $contact_type : '';
          ?>
          <option value="" <?php echo ( '' == $contact_type ) ? 'selected' : ''; ?>><?php echo _e( '-- Select a type --', '__tco__' ); ?></option>
          <?php foreach ( $contact_type_list as $value ) : ?>
            <option value="<?php echo $value; ?>">
              <?php echo _e( $value, '__tco__' ); ?>
            </option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </td>
  </tr>

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_contact_telephone'; ?>">
        <strong><?php _e( 'Telephone', '__tco__' ); ?></strong>
        <span><?php _e( 'Your telephone number. Please use international format (+1 xx ...) when needed.', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <input type="text" class="large-text" id="<?php echo $plugin_slug . '_contact_telephone'; ?>" />
    </td>
  </tr>

</table>
