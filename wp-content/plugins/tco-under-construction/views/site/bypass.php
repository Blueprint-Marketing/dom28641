<?php

// =============================================================================
// VIEWS/SITE/BYPASS.PHP
// -----------------------------------------------------------------------------
// Plugin bypass feature.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Output
// =============================================================================

// Output
// =============================================================================
?>
<div id="tco-under-construction-bypass">
  <div id="tco-under-construction-bypass-toggle">
  <span class="dashicons dashicons-admin-network"></span>
  </div>
  <div id="tco-under-construction-bypass-form">
    <input type="password" class="" id="tco-under-construction-bypass-password"/>
    <button type="button"><?php _e( 'Login', '__tco__'); ?></button>
  </div>
</div>

<script type="text/javascript">

jQuery(document).ready(function($) {

  $('#tco-under-construction-bypass-toggle').click( function( e ) {
    e.preventDefault();
    $('#tco-under-construction-bypass-form').show();
  });

  $('#tco-under-construction-bypass-form button').click( function ( e ) {
    e.preventDefault();
    var pass = $('#tco-under-construction-bypass-form input' ).val();
    $( this ).prop( 'disabled', true );
    var data = {
      'action': 'tco_under_construction_bypass',
      'tco_under_construction_bypass_password': pass,
      'tco_under_construction_ajax_nonce': '<?php echo wp_create_nonce( 'tco_under_construction_bypass' ) ?>'
    };
    // We can also pass the url value separately from ajaxurl for front end AJAX implementations
    $.post(
      '<?php echo admin_url( 'admin-ajax.php' ); ?>',
      data,
      function( response ) {
        $('#tco-under-construction-bypass-form button').prop( 'disabled', false );
        if ( response == 'error' ) {
          alert( '<?php _e( 'Incorrect Password', '__tco__' ) ?>' );
        } else {
          location.reload(true);
        }
      }
    );

  });

});

</script>
