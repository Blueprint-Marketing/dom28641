<?php

// =============================================================================
// VIEWS/ADMIN/METABOX-ORGANIZATION-REQUIRED.PHP
// -----------------------------------------------------------------------------
// Required Organization settings.
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
  <?php _e( 'The below fields are required to properly generate the Schema markup for your Organization. Including. Address, Contact and Social Links. ', '__tco__' ); ?>
</p>

<table class="form-table">

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_organization_type'; ?>">
        <strong><?php _e( 'Type', '__tco__' ); ?></strong><?php echo $organization_type ?>
        <span><?php _e( 'Type of organization. You can select a generic type or a more refined one. ', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <select class="select" name="<?php echo $plugin_slug; ?>[organization_type]" id="<?php echo $plugin_slug . '_organization_type'; ?>">
        <?php if ( empty( $org_tree ) ) : ?>
          <option><?php _e( 'No Lists Found', '__tco__' ); ?></option>
        <?php else : ?>
          <option value="" <?php echo ( '' == $organization_type ) ? 'selected' : ''; ?>><?php _e( '-- Select a type --', '__tco__' ); ?></option>
          <option value="<?php echo $org_tree['name']; ?>" <?php echo ( $org_tree['name'] == $organization_type ) ? 'selected' : ''; ?> class="organization_type_option" data-description="<?php echo $org_tree['description']; ?>"><?php _e( $org_tree['name'], '__tco__' ); ?> (<?php _e( 'generic', '__tco__' ); ?>)</option>
          <option disabled="disabled">---</option>
          <?php foreach ( $org_tree['children'] as $org ) : ?>
            <?php if (isset($org['children'])) : ?>
              <optgroup label="<?php _e( $org['label'], '__tco__' ); ?>">
              <option value="<?php echo $org['name'] ?>" <?php echo ( $org['name'] == $organization_type ) ? 'selected' : ''; ?> class="organization_type_option" data-description="<?php echo $org['description']; ?>"><?php _e( $org['label'], '__tco__' ); ?> (<?php _e( 'generic', '__tco__' ); ?>)</option>
              <?php foreach ($org['children'] as $org2) : ?>
                <?php if (isset($org2['children'])) : ?>
                  <option value="<?php echo $org2['name']; ?>" class="organization_type_option" data-description="<?php echo $org2['description']; ?>" <?php echo ( $org2['name'] == $organization_type ) ? 'selected' : ''; ?> ><?php _e( $org2['label'], '__tco__' ); ?> (generic)</option>
                  <?php foreach ($org2['children'] as $org3) : ?>
                    <option value="<?php echo $org3['name'] ?>" <?php echo ( $org3['name'] == $organization_type ) ? 'selected' : ''; ?> data-description="<?php echo $org3['description']; ?>"><?php _e( $org2['label'], '__tco__' ); ?> => <?php _e( $org3['label'], '__tco__' ); ?></option>
                  <?php endforeach; ?>
                  <?php continue; ?>
                <?php endif; ?>
                <option value="<?php echo $org2['name'] ?>" <?php echo ( $org2['name'] == $organization_type ) ? 'selected' : ''; ?>><?php _e( $org2['name'], '__tco__' ); ?></option>
              <?php endforeach; ?>
              </optgroup>
              <?php continue; ?>
            <?php endif; ?>
            <option value="<?php echo $org['name'] ?>" <?php echo ( $org['name'] == $organization_type ) ? 'selected' : ''; ?>><?php _e( $label, '__tco__' ); ?></option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <span id="organization_type_description" class="tco-span-help"></span>

    </td>
  </tr>

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_organization_name'; ?>">
        <strong><?php _e( 'Name / Business Name', '__tco__' ); ?></strong>
        <span><?php _e( 'The name of your organization that you’d use on Business Cards etc. ', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <input type="text" class="large-text" name="<?php echo $plugin_slug; ?>[organization_name]"
      id="<?php echo $plugin_slug . '_organization_name'; ?>"
      value="<?php echo esc_attr( $organization_name ); ?>">
    </td>
  </tr>

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_organization_url'; ?>">
        <strong><?php _e( 'Website URL', '__tco__' ); ?></strong>
        <span><?php _e( 'URL of your organization\'s website. This can be different from your current domain, but must be a valid website URL. Defaults to WordPress site URL set in "Settings -> General Settings."', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <input type="url" class="large-text" name="<?php echo $plugin_slug; ?>[organization_url]"
      id="<?php echo $plugin_slug . '_organization_url'; ?>"
      value="<?php echo esc_attr( $organization_url ); ?>">
    </td>
  </tr>

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_organization_image'; ?>">
        <strong><?php _e( 'Image', '__tco__' ); ?></strong>
        <span><?php _e( 'URL for the image of your organization. For some types is mandatory, for some it\'s not.', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <input type="text" class="large-text" name="<?php echo $plugin_slug; ?>[organization_image]"
      id="<?php echo $plugin_slug . '_organization_image'; ?>"
      value="<?php echo esc_attr( $organization_image ); ?>">
    </td>
  </tr>


</table>
