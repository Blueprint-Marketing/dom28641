<?php

if ( ! function_exists( 'tco_cs_att' ) ) {
	function tco_cs_att( $attribute, $content, $echo = false ) {

		$att = '';

		if ( $content ) {
			$att = $attribute . '="' . esc_attr( $content ) . '" ';
		}

		if ( is_null( $content ) ) {
			$att = $attribute . ' ';
		}

		if ( $echo ) {
			echo $att;
		}

		return $att;

	}
}

if ( ! function_exists( 'tco_cs_atts' ) ) {
	function tco_cs_atts( $atts, $echo = false ) {
		$result = '';
		foreach ( $atts as $att => $content) {
			$result .= tco_cs_att( $att, $content, false ) . ' ';
		}
		if ( $echo ) {
			echo $result;
		}
		return $result;
	}
}
