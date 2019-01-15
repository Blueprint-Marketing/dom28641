<?php

add_filter( 'the_content', function( $content = '' ) {
	if ( ( is_admin() ) && ( isset( $_REQUEST['post'] ) ) && ( !empty( $_REQUEST['post'] ) ) && ( isset( $_REQUEST['action'] ) ) && ( $_REQUEST['action'] == 'edit' ) ) {
		return $content;
	}
	
	if ( !empty( $content ) ) {
		$content = learndash_convert_block_markers_shortcode( $content, 'ld-user-course-points', 'student', true );
	}
	
	return $content;
	
}, 5 ); // BEFORE do_shortcode() and do_blocks().
