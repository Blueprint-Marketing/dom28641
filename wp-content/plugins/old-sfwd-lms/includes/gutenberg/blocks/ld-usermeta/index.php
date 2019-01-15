<?php

add_filter( 'the_content', function( $content = '' ) {
	if ( ( is_admin() ) && ( isset( $_REQUEST['post'] ) ) && ( !empty( $_REQUEST['post'] ) ) && ( isset( $_REQUEST['action'] ) ) && ( $_REQUEST['action'] == 'edit' ) ) {
		//error_log('ABORT');
		return $content;
	}
	
	if ( !empty( $content ) ) {
		$content = learndash_convert_block_markers_shortcode( $content, 'learndash/ld-usermeta', 'usermeta', true );
	}
	
	return $content;
	
}, 5 ); // BEFORE do_shortcode() and do_blocks().
