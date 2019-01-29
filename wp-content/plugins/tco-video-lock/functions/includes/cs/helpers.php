<?php 

if (! function_exists('cs_generate_data_attributes')) {
  function cs_generate_data_attributes( $element, $params = array() ) {

  	$data = 'data-x-element="' . $element . '"';

  	if ( ! empty( $params ) ) {
  		$params_json = htmlspecialchars( wp_json_encode( $params ), ENT_QUOTES, 'UTF-8' );
  		$data .= ' data-x-params="' . $params_json . '"';
  	}

  	return $data;
  }
}
