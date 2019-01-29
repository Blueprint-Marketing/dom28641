// =============================================================================
// JS/ADMIN/MAIN.JS
// -----------------------------------------------------------------------------
// Plugin admin scripts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Metabox Toggle
//   02. Media Uploader
// =============================================================================


// Metabox Toggle
// =============================================================================

jQuery(document).ready(function($) {

  function tco_snippet_metabox_toggle() {
    var schema = $('#_snippet_post_type_schema').val();
    $('.metabox-schema').hide();
    $('.metabox-schema-' + schema).show();
  }

  $('#_snippet_post_type_schema').change(function() {
    tco_snippet_metabox_toggle();
  });

  tco_snippet_metabox_toggle();
});


// Media Uploader
// =============================================================================

jQuery(document).ready(function($) {
  $('.tco-upload-btn').click( function( e ) {
      var self = $(this);
      e.preventDefault();
      var media = wp.media({
        title: 'Upload Image',
        multiple: false
      }).open()
      .on('select', function( e ) {
          var uploaded_image = media.state().get( 'selection' ).first().toJSON();
          var image = {
            url: uploaded_image.url,
            height: uploaded_image.height,
            width: uploaded_image.width
          }
          console.log(image, JSON.stringify(image));

          $('#' + self.data('id') ).val( JSON.stringify(image) );
          $('#' + self.data('id') + '_thumb' ).html('<div class="tco-uploader-image"><img src="' + image.url + '" alt="" /></div>');
      });
  });
});


// Grab post info to schema fields
// =============================================================================

jQuery(document).ready(function($) {
  $('#title').keyup( function( e ) {
    $('#_snippet_event_name').val($(this).val());
    $('#_snippet_newsarticle_headline').val($(this).val());
    $('#_snippet_blogposting_headline').val($(this).val());
    $('#_snippet_article_headline').val($(this).val());
  });
});
