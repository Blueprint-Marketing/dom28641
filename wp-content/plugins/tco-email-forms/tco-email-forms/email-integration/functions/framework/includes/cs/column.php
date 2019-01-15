<?php

// Column
// =============================================================================
if ( ! function_exists( 'tco_shortcode_column' ) ) {

  function tco_shortcode_column( $atts, $content = null ) {
    extract( shortcode_atts( array(
      'id'                    => '',
      'class'                 => '',
      'style'                 => '',
      'type'                  => '',
      'last'                  => '',
      'fade'                  => '',
      'fade_animation'        => '',
      'fade_animation_offset' => '',
      'fade_duration'         => '',
      'bg_color'              => ''
    ), $atts, 'tco_column' ) );

    $id                    = ( $id                    != ''     ) ? 'id="' . esc_attr( $id ) . '"' : '';
    $class                 = ( $class                 != ''     ) ? 'tco-column tco-sm ' . esc_attr( $class ) : 'tco-column tco-sm';
    $style                 = ( $style                 != ''     ) ? $style : '';
    $type                  = ( $type                  != ''     ) ? $type : ' tco-1-2';
    $last                  = ( $last                  == 'true' ) ? ' last' : '';
    $fade_animation        = ( $fade_animation        != ''     ) ? $fade_animation : 'in';
    $fade_animation_offset = ( $fade_animation_offset != ''     ) ? $fade_animation_offset : '45px';
    $fade_duration         = ( $fade_duration         != ''     ) ? $fade_duration : '750';
    $bg_color              = ( $bg_color              != ''     ) ? ' background-color:' . $bg_color . ';' : '';

    switch ( $type ) {
      case '1/1'   :
      case 'whole' :
        $type = ' tco-1-1';
        break;
      case '1/2'      :
      case 'one-half' :
        $type = ' tco-1-2';
        break;
      case '1/3'       :
      case 'one-third' :
        $type = ' tco-1-3';
        break;
      case '2/3'        :
      case 'two-thirds' :
        $type = ' tco-2-3';
        break;
      case '1/4'        :
      case 'one-fourth' :
        $type = ' tco-1-4';
        break;
      case '3/4'           :
      case 'three-fourths' :
        $type = ' tco-3-4';
        break;
      case '1/5'       :
      case 'one-fifth' :
        $type = ' tco-1-5';
        break;
      case '2/5'        :
      case 'two-fifths' :
        $type = ' tco-2-5';
        break;
      case '3/5'          :
      case 'three-fifths' :
        $type = ' tco-3-5';
        break;
      case '4/5'         :
      case 'four-fifths' :
        $type = ' tco-4-5';
        break;
      case '1/6'       :
      case 'one-sixth' :
        $type = ' tco-1-6';
        break;
      case '5/6'       :
      case 'five-sixths' :
        $type = ' tco-5-6';
        break;
      default:
        $type = ' tco-1-1';
        break;
    }

    if ( $fade == 'true' ) {
      $fade = ' data-fade="true"';
      $data = cs_generate_data_attributes( 'column', array( 'fade' => true ) );
      switch ( $fade_animation ) {
        case 'in' :
          $fade_animation_offset = '';
          break;
        case 'in-from-top' :
          $fade_animation_offset = ' transform: translate(0, -' . $fade_animation_offset . '); ';
          break;
        case 'in-from-left' :
          $fade_animation_offset = ' transform: translate(-' . $fade_animation_offset . ', 0); ';
          break;
        case 'in-from-right' :
          $fade_animation_offset = ' transform: translate(' . $fade_animation_offset . ', 0); ';
          break;
        case 'in-from-bottom' :
          $fade_animation_offset = ' transform: translate(0, ' . $fade_animation_offset . '); ';
          break;
      }
      $fade_animation_style = 'opacity: 0;' . $fade_animation_offset . 'transition-duration: ' . $fade_duration . 'ms;';
    } else {
      $data                 = '';
      $fade                 = '';
      $fade_animation_style = '';
    }

    $output = "<div {$id} class=\"{$class}{$type}{$last}\" style=\"{$style}{$fade_animation_style}{$bg_color}\" {$data}{$fade}>" . do_shortcode( $content ) . "</div>";

    return $output;
  }

  add_shortcode( 'tco_column', 'tco_shortcode_column' );
}
