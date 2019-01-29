<?php

// Row
// =============================================================================

if ( ! function_exists( 'tco_shortcode_row' ) ) {
  function tco_shortcode_row( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'id'                 => '',
      'class'              => '',
      'style'              => '',
      'inner_container'    => '',
      'marginless_columns' => '',
      'bg_color'           => ''
    ), $atts, 'tco_row' ) );

    $class              = ( $class              != ''     ) ? 'tco-container ' . esc_attr( $class ) : 'tco-container';
    $inner_container    = ( $inner_container    == 'true' ) ? ' max width' : '';
    $marginless_columns = ( $marginless_columns == 'true' ) ? ' marginless-columns' : '';
    $bg_color           = ( $bg_color           != ''     ) ? ' background-color:' . $bg_color . ';' : '';

    $atts = tco_cs_atts( array(
      'id'    => $id,
      'class' => trim( $class . $inner_container . $marginless_columns ),
      'style' => $style . $bg_color
    ) );

    $output = "<div {$atts} >" . do_shortcode( $content ) . '</div>';

    return $output;
  }

  add_shortcode( 'tco_row', 'tco_shortcode_row' );
}
