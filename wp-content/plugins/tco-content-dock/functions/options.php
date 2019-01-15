<?php

// =============================================================================
// FUNCTIONS/OPTIONS.PHP
// -----------------------------------------------------------------------------
// Plugin options.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Options
//   02. Get Options
// =============================================================================

// Set Options
// =============================================================================

//
// Set $_POST variables to options array and update option.
//

GLOBAL $tco_content_dock_options;

if ( isset( $_POST['tco_content_dock_form_submitted'] ) ) {
  if ( sanitize_text_field( $_POST['tco_content_dock_form_submitted'] ) == 'submitted' && current_user_can( 'manage_options' ) ) {

    //
    // Set "Include" setting to an empty array if no value is set to avoid
    // array_map() notice if second parameter isn't an array.
    //

    $tco_content_dock_entries_include_post      = ( isset( $_POST['tco_content_dock_entries_include'] ) ) ? $_POST['tco_content_dock_entries_include'] : array();
    $tco_content_dock_posts_include_post        = ( isset( $_POST['tco_content_dock_posts_include'] ) ) ? $_POST['tco_content_dock_posts_include'] : array();
    $tco_content_dock_woo_products_include_post = ( isset( $_POST['tco_content_dock_woo_products_include'] ) ) ? $_POST['tco_content_dock_woo_products_include'] : array();

    $tco_content_dock_options['tco_content_dock_enable']                   = ( isset( $_POST['tco_content_dock_enable'] ) ) ? sanitize_text_field( $_POST['tco_content_dock_enable'] ) : '';
    $tco_content_dock_options['tco_content_dock_position']                 = sanitize_text_field( $_POST['tco_content_dock_position'] );
    $tco_content_dock_options['tco_content_dock_width']                    = sanitize_text_field( $_POST['tco_content_dock_width'] );
    $tco_content_dock_options['tco_content_dock_display']                  = sanitize_text_field( $_POST['tco_content_dock_display'] );
    $tco_content_dock_options['tco_content_dock_all_pages_active']         = ( isset( $_POST['tco_content_dock_all_pages_active'] ) ) ? sanitize_text_field( $_POST['tco_content_dock_all_pages_active'] ) : '';
    $tco_content_dock_options['tco_content_dock_entries_include']          = array_map( 'sanitize_text_field', $tco_content_dock_entries_include_post );
    $tco_content_dock_options['tco_content_dock_all_posts_active']         = ( isset( $_POST['tco_content_dock_all_posts_active'] ) ) ? sanitize_text_field( $_POST['tco_content_dock_all_posts_active'] ) : '';
    $tco_content_dock_options['tco_content_dock_posts_include']            = array_map( 'sanitize_text_field', $tco_content_dock_posts_include_post );
    $tco_content_dock_options['tco_content_dock_all_woo_products_active']  = ( isset( $_POST['tco_content_dock_all_woo_products_active'] ) ) ? sanitize_text_field( $_POST['tco_content_dock_all_woo_products_active'] ) : '';
    $tco_content_dock_options['tco_content_dock_woo_products_include']     = array_map( 'sanitize_text_field', $tco_content_dock_woo_products_include_post );
    $tco_content_dock_options['tco_content_dock_text_color']               = sanitize_text_field( $_POST['tco_content_dock_text_color'] );
    $tco_content_dock_options['tco_content_dock_headings_color']           = sanitize_text_field( $_POST['tco_content_dock_headings_color'] );
    $tco_content_dock_options['tco_content_dock_link_color']               = sanitize_text_field( $_POST['tco_content_dock_link_color'] );
    $tco_content_dock_options['tco_content_dock_link_hover_color']         = sanitize_text_field( $_POST['tco_content_dock_link_hover_color'] );
    $tco_content_dock_options['tco_content_dock_close_button_color']       = sanitize_text_field( $_POST['tco_content_dock_close_button_color'] );
    $tco_content_dock_options['tco_content_dock_close_button_hover_color'] = sanitize_text_field( $_POST['tco_content_dock_close_button_hover_color'] );
    $tco_content_dock_options['tco_content_dock_border_color']             = sanitize_text_field( $_POST['tco_content_dock_border_color'] );
    $tco_content_dock_options['tco_content_dock_background_color']         = sanitize_text_field( $_POST['tco_content_dock_background_color'] );
    $tco_content_dock_options['tco_content_dock_box_shadow']               = ( isset( $_POST['tco_content_dock_box_shadow'] ) ) ? sanitize_text_field( $_POST['tco_content_dock_box_shadow'] ) : '';
    $tco_content_dock_options['tco_content_dock_trigger_timeout']          = sanitize_text_field( $_POST['tco_content_dock_trigger_timeout'] );
    $tco_content_dock_options['tco_content_dock_cookie_timeout']           = sanitize_text_field( $_POST['tco_content_dock_cookie_timeout'] );
    $tco_content_dock_options['tco_content_dock_image_override_enable']    = ( isset( $_POST['tco_content_dock_image_override_enable'] ) ) ? sanitize_text_field( $_POST['tco_content_dock_image_override_enable'] ) : '';
    $tco_content_dock_options['tco_content_dock_image_override_image']     = sanitize_text_field( $_POST['tco_content_dock_image_override_image'] );
    $tco_content_dock_options['tco_content_dock_image_override_url']       = sanitize_text_field( $_POST['tco_content_dock_image_override_url'] );

    update_option( 'tco_content_dock', $tco_content_dock_options );

  }

}



// Get Options
// =============================================================================

$tco_content_dock_options = apply_filters( 'tco_content_dock_options', get_option( 'tco_content_dock' ) );
if ( $tco_content_dock_options == '' || is_null( $tco_content_dock_options ) ) {
  $tco_content_dock_options = array();
}

$tco_content_dock_enable                   = isset( $tco_content_dock_options['tco_content_dock_enable'] ) ? $tco_content_dock_options['tco_content_dock_enable'] : '';
$tco_content_dock_position                 = isset( $tco_content_dock_options['tco_content_dock_position'] ) ? $tco_content_dock_options['tco_content_dock_position'] : '';
$tco_content_dock_width                    = isset( $tco_content_dock_options['tco_content_dock_width'] ) ? $tco_content_dock_options['tco_content_dock_width'] : '';
$tco_content_dock_display                  = isset( $tco_content_dock_options['tco_content_dock_display'] ) ? $tco_content_dock_options['tco_content_dock_display'] : '';
$tco_content_dock_all_pages_active         = isset( $tco_content_dock_options['tco_content_dock_all_pages_active'] ) ? $tco_content_dock_options['tco_content_dock_all_pages_active'] : '';
$tco_content_dock_entries_include          = isset( $tco_content_dock_options['tco_content_dock_entries_include'] ) ? $tco_content_dock_options['tco_content_dock_entries_include'] : array();
$tco_content_dock_all_posts_active         = isset( $tco_content_dock_options['tco_content_dock_all_posts_active'] ) ? $tco_content_dock_options['tco_content_dock_all_posts_active'] : '';
$tco_content_dock_posts_include            = isset( $tco_content_dock_options['tco_content_dock_posts_include'] ) ? $tco_content_dock_options['tco_content_dock_posts_include'] : array();
$tco_content_dock_all_woo_products_active  = isset( $tco_content_dock_options['tco_content_dock_all_woo_products_active'] ) ? $tco_content_dock_options['tco_content_dock_all_woo_products_active'] : '';
$tco_content_dock_woo_products_include     = isset( $tco_content_dock_options['tco_content_dock_woo_products_include'] ) ? $tco_content_dock_options['tco_content_dock_woo_products_include'] : array();
$tco_content_dock_text_color               = isset( $tco_content_dock_options['tco_content_dock_text_color'] ) ? $tco_content_dock_options['tco_content_dock_text_color'] : '';
$tco_content_dock_headings_color           = isset( $tco_content_dock_options['tco_content_dock_headings_color'] ) ? $tco_content_dock_options['tco_content_dock_headings_color'] : '';
$tco_content_dock_link_color               = isset( $tco_content_dock_options['tco_content_dock_link_color'] ) ? $tco_content_dock_options['tco_content_dock_link_color'] : '';
$tco_content_dock_link_hover_color         = isset( $tco_content_dock_options['tco_content_dock_link_hover_color'] ) ? $tco_content_dock_options['tco_content_dock_link_hover_color'] : '';
$tco_content_dock_close_button_color       = isset( $tco_content_dock_options['tco_content_dock_close_button_color'] ) ? $tco_content_dock_options['tco_content_dock_close_button_color'] : '';
$tco_content_dock_close_button_hover_color = isset( $tco_content_dock_options['tco_content_dock_close_button_hover_color'] ) ? $tco_content_dock_options['tco_content_dock_close_button_hover_color'] : '';
$tco_content_dock_border_color             = isset( $tco_content_dock_options['tco_content_dock_border_color'] ) ? $tco_content_dock_options['tco_content_dock_border_color'] : '';
$tco_content_dock_background_color         = isset( $tco_content_dock_options['tco_content_dock_background_color'] ) ? $tco_content_dock_options['tco_content_dock_background_color'] : '';
$tco_content_dock_box_shadow               = isset( $tco_content_dock_options['tco_content_dock_box_shadow'] ) ? $tco_content_dock_options['tco_content_dock_box_shadow'] : '';
$tco_content_dock_trigger_timeout          = isset( $tco_content_dock_options['tco_content_dock_trigger_timeout'] ) ? $tco_content_dock_options['tco_content_dock_trigger_timeout'] : '';
$tco_content_dock_cookie_timeout           = isset( $tco_content_dock_options['tco_content_dock_cookie_timeout'] ) ? $tco_content_dock_options['tco_content_dock_cookie_timeout'] : '';
$tco_content_dock_image_override_enable    = isset( $tco_content_dock_options['tco_content_dock_image_override_enable'] ) ? $tco_content_dock_options['tco_content_dock_image_override_enable'] : '';
$tco_content_dock_image_override_image     = isset( $tco_content_dock_options['tco_content_dock_image_override_image'] ) ? $tco_content_dock_options['tco_content_dock_image_override_image'] : '';
$tco_content_dock_image_override_url       = isset( $tco_content_dock_options['tco_content_dock_image_override_url'] ) ? $tco_content_dock_options['tco_content_dock_image_override_url'] : '';
