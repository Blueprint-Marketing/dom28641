<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/META/SETUP.PHP
// -----------------------------------------------------------------------------
// Sets up custom meta boxes utilized throughout the theme in various areas.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Add Entry Meta
//   02. Create Entry Meta
//   03. Save Entry Meta
//   04. Include Entry and Taxonomy Meta Box Setup
// =============================================================================



// Add Entry Meta
// =============================================================================

function tco_add_meta_box( $meta_box ) {

  if ( ! is_array( $meta_box ) )
    return false;

  $callback = create_function( '$post,$meta_box', 'tco_create_meta_box( $post, $meta_box["args"] );' );

  add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );

}



// Create Entry Meta
// =============================================================================

function tco_create_meta_box( $post, $meta_box ) {

  if ( ! is_array( $meta_box ) )
    return false;

  if ( isset( $meta_box['description'] ) && $meta_box['description'] != '' )
    echo '<p>' . $meta_box['description'] . '</p>';

  wp_nonce_field( basename( __FILE__ ), 'tco_meta_box_nonce' );

  echo '<table class="form-table tco-form-table">';

  foreach( $meta_box['fields'] as $field ) {

    $meta = ( $post->post_status == 'auto-draft' ) ? $field['std'] : get_post_meta( $post->ID, $field['id'], true );

    echo '<tr><th><label for="' . $field['id'] . '"><strong>' . $field['name'] . '</strong>
        <span>' . $field['desc'] . '</span></label></th>';

    switch( $field['type'] ) {
      case 'text':
        echo '<td><input type="text" name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . $meta . '" size="30" /></td>';
        break;

      case 'textarea' :
        echo '<td><textarea name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '" rows="8" cols="5">' . $meta . '</textarea></td>';
        break;

      case 'select' :
        echo '<td><select name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
        foreach( $field['options'] as $option ) {
          echo'<option';
          if ( $meta ) {
            if ( $meta == $option ) echo ' selected="selected"';
          } else {
            if ( $field['std'] == $option ) echo ' selected="selected"';
          }
          echo'>' . $option . '</option>';
        }
        echo '</select></td>';
        break;

      case 'radio' :
        echo '<td>';
        foreach( $field['options'] as $option ) {
          echo '<label class="radio-label"><input type="radio" name="tco_meta[' . $field['id'] . ']" value="' . $option . '" class="radio"';
          if ( $meta ) {
            if ( $meta == $option ) echo ' checked="yes"';
          } else {
            if ( $field['std'] == $option ) echo ' checked="yes"';
          }
          echo ' /> ' . $option . '</label> ';
        }
        echo '</td>';
        break;

      case 'checkbox' :
        echo '<td>';
        $val = '';
        if ( $meta ) {
          if ( $meta == 'on' )
            $val = ' checked="yes"';
        } else {
          if( $field['std'] == 'on' )
            $val = ' checked="yes"';
        }
        echo '<input type="hidden" name="tco_meta[' . $field['id'] . ']" value="off" />
              <input type="checkbox" id="' . $field['id'] . '" name="tco_meta[' . $field['id'] . ']" value="on"' . $val . ' /> ';
        echo '</td>';
        break;

      case 'color':
        echo '<td><input type="text" name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '" class="wp-color-picker" value="' . $meta . '" data-default-color="' . $field['std'] . '" size="30" /></td>';
        break;

      case 'file':
        echo '<td><input type="text" name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . $meta . '" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
        break;

      case 'images':
        echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="tco_images_upload" value="' . $field['std'] .'" /></td>';
        break;

      case 'uploader' :
        GLOBAL $post;
        $output = '';
        if ( $meta != '' ) {
          $thumb = explode( ',', $meta );
          foreach ( $thumb as $thumb_image ) {
            $output .= '<div class="tco-uploader-image"><img src="' . $thumb_image . '" alt="" /></div>';
          }
        }
        echo '<td>'
             . '<input type="text" name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . $meta . '" class="file" />'
             . '<input data-id="' . get_the_ID() . '"  type="button" class="button" name="' . $field['id'] . '_button" id="' . $field['id'] . '_upload" value="Select Background Image(s)" />'
             . '<div class="tco-meta-box-img-thumb-wrap">' . $output . '</div>'
           . '</td>';
        ?>

        <script>

          jQuery(document).ready(function($) {

            //
            // 1. If media frame exists, open it.
            // 2. Set wp.media post ID so the uploader grabs the ID we want when initialized.
            // 3. Create media frame.
            // 4. When image selected, run callback.
            // 5. Restore main post ID.
            // 6. Restore main ID when media button is pressed.
            //

            var tco_uploader;
            var wp_media_post_id = wp.media.model.settings.post.id;

            $('#<?php echo $field["id"] ?>_upload').on('click', function(e) {

              e.preventDefault();

              var tco_button       = $(this);
              var set_to_post_id = tco_button.data('id');

              if ( tco_uploader ) {
                tco_uploader.uploader.uploader.param('post_id', set_to_post_id);
                tco_uploader.open(); // 1
                return;
              } else {
                wp.media.model.settings.post.id = set_to_post_id; // 2
              }

              tco_uploader = wp.media.frames.tco_uploader = wp.media({ // 3
                title    : 'Insert Media',
                button   : { text : 'Select' },
                multiple : true
              });

              tco_uploader.on('select', function() { // 4

                var selection = tco_uploader.state().get('selection');
                var files     = [];

                selection.map( function( attachment ) {
                  attachment = attachment.toJSON();
                  files.push(attachment.url);
                  tco_button.prev().val(files);
                });

                tco_button.next().html('');

                for ( var i = 0; i < files.length; i++ ) {
                  var ext = files[i].substr(files[i].lastIndexOf('.') + 1, files[i].length);
                  tco_button.next().append('<div class="row-image"><img src="' + files[i] + '" alt="" /></div>');
                }

                wp.media.model.settings.post.id = wp_media_post_id; // 5

              });

              tco_uploader.open();

            });

            jQuery('a.add_media').on('click', function() {
              wp.media.model.settings.post.id = wp_media_post_id; // 6
            });

          });

        </script>

        <?php
        break;

      case 'select-portfolio-parent' :
        $pages = get_pages( array(
          'meta_key'    => '_wp_page_template',
          'meta_value'  => 'template-layout-portfolio.php',
          'sort_order'  => 'ASC',
          'sort_column' => 'ID'
        ) );
        echo '<td><select name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
        echo '<option value="Default">Default</option>';
        foreach ( $pages as $page ) {
          echo '<option value="' . $page->ID . '"';
          if ( $meta ) {
            if ( $meta == $page->ID ) echo ' selected="selected"';
          } else {
            if ( $field['std'] == $page->ID ) echo ' selected="selected"';
          }
          echo'>' . $page->post_title . '</option>';
        }
        echo '</select></td>';
        break;

      case 'select-portfolio-category' :
        $categories = get_terms( 'portfolio-category' );
        $meta       = ( $meta == '' ) ? array( 0 => 'All Categories' ) : $meta;
        echo '<td><select name="tco_meta[' . $field['id'] . '][]" id="' . $field['id'] . '" multiple="multiple">';
        echo '<option value="All Categories" ' . selected( $meta[0], 'All Categories', true ) . '>All Categories</option>';
        foreach ( $categories as $category ) {
          echo '<option value="' . $category->term_id . '"';
          if ( in_array( $category->term_id, $meta ) ) echo ' selected="selected"';
          echo'>' . $category->name . '</option>';
        }
        echo '</select></td>';
        break;

      case 'radio-portfolio-layout' :
        echo '<td>';
        foreach( $field['options'] as $key => $option ) {
          echo '<label class="radio-label"><input type="radio" name="tco_meta[' . $field['id'] . ']" value="' . $key . '" class="radio"';
          if ( $meta ) {
            if ( $meta == $key ) echo ' checked="yes"';
          } else {
            if ( $field['std'] == $key ) echo ' checked="yes"';
          }
          echo ' /> ' . $option . '</label> ';
        }
        echo '</td>';
        break;

      case 'menus' :
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        echo '<td><select name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
        echo '<option>Deactivated</option>';
        foreach ( $menus as $menu ) {
          echo '<option';
          if ( $meta ) {
            if ( $meta == $menu->name ) echo ' selected="selected"';
          } else {
            if ( $field['std'] == $menu->name ) echo ' selected="selected"';
          }
          echo'>' . $menu->name . '</option>';
        }
        echo '</select></td>';
        break;

      case 'sliders' :
        $sliders = apply_filters( 'tco_sliders_meta', array() );
        echo '<td><select name="tco_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
        echo '<option value="Deactivated">Deactivated</option>';
        foreach ( $sliders as $key => $value ) {
          echo '<option value="' . $key . '"';
          if ( $meta ) {
            if ( $meta == $key || $meta == $value['slug'] ) echo ' selected="selected"';
          }
          echo '>' . $value['source'] . ': ' . $value['name'] . '</option>';
        }
        echo '</select></td>';
        break;

      default :
        do_action( 'tco_add_meta_box_field_type', $field['type'] );
        break;

    }
    echo '</tr>';
  }
  echo '</table>';
}



// Save Entry Meta
// =============================================================================

function tco_save_meta_box( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

  if ( ! isset( $_POST['tco_meta'] ) || ! isset( $_POST['tco_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['tco_meta_box_nonce'], basename( __FILE__ ) ) )
    return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
  }

  foreach( $_POST['tco_meta'] as $key => $val ) {
    if ( is_array( $val ) ) {
      update_post_meta( $post_id, $key, $val );
    } else {
      update_post_meta( $post_id, $key, stripslashes( htmlspecialchars( $val ) ) );
    }
  }

}

add_action( 'save_post', 'tco_save_meta_box' );
