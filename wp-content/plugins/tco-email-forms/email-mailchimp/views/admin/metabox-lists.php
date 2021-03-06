<?php

// =============================================================================
// EMAIL-INTEGRATION/VIEWS/ADMIN/METABOX-LISTS.PHP
// -----------------------------------------------------------------------------
// Provider email lists.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Metabox
// =============================================================================

// Metabox
// =============================================================================

?>

<p><?php _e( 'Below are the email lists available from your account.', '__tco__' ); ?></p>

<table class="form-table">

  <tr>
    <th>
      <label for="<?php echo $plugin_slug . '_mc_list_cache'; ?>">
        <strong><?php _e( 'Email Lists', '__tco__' ); ?></strong>
        <span><?php _e( 'If you have added a new email list to your account or a custom field to some list, click the "Refresh" button to see it listed here.', '__tco__' ); ?></span>
      </label>
    </th>
    <td>
      <select multiple disabled>
        <?php if ( empty( $mc_list_cache ) ) : ?>
          <option><?php _e( 'No lists found', '__tco__' ); ?></option>
        <?php else : ?>
          <?php foreach ( $mc_list_cache as $item ) : ?>
            <option><?php echo $item['name']; ?></option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <br>
      <br>
      <a href="<?php echo $mc_list_refresh_url; ?>" class="button"><?php _e( 'Refresh', '__tco__' ); ?></a>
    </td>
  </tr>

</table>
