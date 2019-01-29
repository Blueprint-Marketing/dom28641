<?php

// =============================================================================
// VIEWS/SITE/CONTENT-DOCK.PHP
// -----------------------------------------------------------------------------
// Plugin site output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Require Options
//   02. Output
// =============================================================================

// Require Options
// =============================================================================

require( TCO_CONTENT_DOCK_PATH . '/functions/options.php' );

GLOBAL $post;

// Output
// =============================================================================

$display = false;

// Active for all pages

if ( ( is_page() || is_home() ) && isset( $tco_content_dock_all_pages_active ) && $tco_content_dock_all_pages_active ) {
  $display = true;
}

// Page is on the list

if ( is_page() && in_array( $post->ID, $tco_content_dock_entries_include ) ) {
  $display = true;
}

// Active for all posts

if ( is_single() && isset( $tco_content_dock_all_posts_active ) && $tco_content_dock_all_posts_active && $post->post_type !== 'product' ) {
  $display = true;
}

// Post is on the list

if ( is_single() && in_array( $post->ID, $tco_content_dock_posts_include ) ) {
  $display = true;
}

// Active for all WooCommerce products

if ( $post->post_type == 'product' && isset( $tco_content_dock_all_woo_products_active ) && $tco_content_dock_all_woo_products_active ) {
  $display = true;
}

// WooCommerce product is on the list

if ( is_single() && in_array( $post->ID, $tco_content_dock_woo_products_include ) ) {
  $display = true;
}

// If tco_content_dock_do_not_show cookie is set, ignore content-dock

if( isset( $_COOKIE['tco_content_dock_do_not_show'] ) ) {
  $display = false;
}

// If Under construction is enable, do not display

$tco_under_construction_options = apply_filters( 'tco_under_construction_options', get_option( 'tco_under_construction' ) );
if (isset( $tco_content_dock_options['tco_under_construction_enable'] ) && $tco_content_dock_options['tco_under_construction_enable']) {
  $display = false;
}

// Render conditionally

if ( $display ) :

?>

  <div class="tco-content-dock <?php echo $tco_content_dock_position ?> tco-content-dock-off" style="width: <?php echo $tco_content_dock_width; ?>px; <?php echo $tco_content_dock_position ?>: <?php echo -$tco_content_dock_width - 50; ?>px;">
    <?php if ( isset( $tco_content_dock_image_override_enable ) && $tco_content_dock_image_override_enable ) : ?>
      <a href="<?php echo $tco_content_dock_image_override_url ?>"><img src="<?php echo $tco_content_dock_image_override_image ?>" alt="tco-content-dock-image" /></a>
    <?php else : ?>
      <?php dynamic_sidebar( 'content-dock' ); ?>
    <?php endif; ?>

    <a href="#" class="tco-close-content-dock">
      <span data-content="&#x2716;"></span>
      <span class="visually-hidden">Close the Content Dock</span>
    </a>
    <?php if ( isset( $tco_content_dock_cookie_timeout ) && $tco_content_dock_cookie_timeout > 0 ) : ?>
      <input type="checkbox" id="tco_content_dock_do_not_show" value="1" /> <?php _e( 'Do not show again', '__e__' ); ?>
    <?php endif; ?>
  </div>

  <script id="tco-content-dock-js">

    jQuery(document).ready(function($) {

      $.fn.scrollBottom = function() {
        return $(document).height() - this.scrollTop() - this.height();
      };
      var executed             = false;
      var windowObj            = $(window);
      var body                 = $('body');
      var bodyOffsetBottom     = windowObj.scrollBottom();
      var bodyHeightAdjustment = body.height() - bodyOffsetBottom;
      var bodyHeightAdjusted   = body.height() - bodyHeightAdjustment;
      var contentDock          = $('.tco-content-dock');

      function sizingUpdate() {
        var bodyOffsetTop = windowObj.scrollTop();
        if ( bodyOffsetTop > ( bodyHeightAdjusted * <?php echo $tco_content_dock_display / 100; ?> ) ) {
          if ( ! executed ) {
            executed = true;
            contentDock.toggleClass('tco-content-dock-off').toggleClass('tco-content-dock-on').css('<?php echo $tco_content_dock_position ?>', '20px');
          }
        }
        $('.tco-close-content-dock').click( function( e ) {
          e.preventDefault();
          contentDock.toggleClass('tco-content-dock-off').toggleClass('tco-content-dock-on').css('<?php echo $tco_content_dock_position ?>', '<?php echo -$tco_content_dock_width - 100; ?>px');
        });

        <?php if ( isset( $tco_content_dock_cookie_timeout ) && $tco_content_dock_cookie_timeout > 0 ) : ?>
        $('#tco_content_dock_do_not_show').change( function( e ) {
          e.preventDefault();
          contentDock.toggleClass('tco-content-dock-off').toggleClass('tco-content-dock-on').css('<?php echo $tco_content_dock_position ?>', '<?php echo -$tco_content_dock_width - 100; ?>px');
          var data = {
          		'action': 'tco_content_dock_do_not_show',
          		'tco_content_dock_do_not_show': 1
        	};
        	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
        	$.post(
            '<?php echo admin_url( 'admin-ajax.php' ); ?>',
            data,
            function( response ) {
        		// done silently
        	});
        });
        <?php endif; ?>

      }

      <?php if ( isset( $tco_content_dock_trigger_timeout ) && $tco_content_dock_trigger_timeout > 0 ) : ?>
        window.setTimeout( function() {
          if ( ! executed ) {
            executed = true;
            contentDock.toggleClass('tco-content-dock-off').toggleClass('tco-content-dock-on').css('<?php echo $tco_content_dock_position ?>', '20px');
          }
        }, <?php echo (int) $tco_content_dock_trigger_timeout * 1000; ?>);
      <?php endif; ?>

      windowObj.bind('scroll', sizingUpdate).resize(sizingUpdate);
      sizingUpdate();

    });

  </script>

<?php endif;
