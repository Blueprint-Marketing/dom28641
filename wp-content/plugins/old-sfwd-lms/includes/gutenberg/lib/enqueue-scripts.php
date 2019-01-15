<?php

/**
 * Enqueue block editor only JavaScript and CSS
 */
function learndash_editor_scripts()
{
    // Make paths variables so we don't write em twice ;)
    $blockPath = '../assets/js/editor.blocks.js';
    $editorStylePath = '../assets/css/blocks.editor.css';

    // Enqueue the bundled block JS file
    wp_enqueue_script(
        'ldlms-blocks-js',
        plugins_url( $blockPath, __FILE__ ),
        [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components' ],
        filemtime( plugin_dir_path(__FILE__) . $blockPath )
    );

	/**
	 * @TODO: This needs to move to an external JS library since it will be used globally
	 */
	$ldlms = array(
		'settings' => array()
	);
	$ldlms_settings['settings']['custom_labels'] = get_option( 'learndash_settings_custom_labels' );
	foreach( $ldlms_settings['settings']['custom_labels'] as $key => $val ) {
		if ( empty( $val ) ) {
			$ldlms_settings['settings']['custom_labels'][$key] = LearnDash_Custom_Label::get_label( $key );
		}
	}
	wp_localize_script( 'ldlms-blocks-js', 'ldlms_settings', $ldlms_settings );


    // Enqueue optional editor only styles
    wp_enqueue_style(
        'ldlms-blocks-editor-css',
        plugins_url( $editorStylePath, __FILE__),
        [ 'wp-blocks' ],
        filemtime( plugin_dir_path( __FILE__ ) . $editorStylePath )
    );

}
// Hook scripts function into block editor hook
add_action( 'enqueue_block_editor_assets', 'learndash_editor_scripts' );


/**
 * Enqueue front end and editor JavaScript and CSS
 */
function learndash_scripts() {
    // Make paths variables so we don't write em twice ;)
    $blockPath = '../assets/js/frontend.blocks.js';
    $stylePath = '../assets/css/blocks.style.css';

    if( !is_admin() ) {
        // Enqueue the bundled block JS file
        wp_enqueue_script(
            'ldlms-blocks-frontend',
            plugins_url( $blockPath, __FILE__ ),
            [],
            filemtime( plugin_dir_path(__FILE__) . $blockPath )
        );
    }

    // Enqueue frontend and editor block styles
    wp_enqueue_style(
        'learndash-blocks',
        plugins_url($stylePath, __FILE__),
        [ 'wp-blocks' ],
        filemtime(plugin_dir_path(__FILE__) . $stylePath )
    );
}

// Hook scripts function into block editor hook
add_action('enqueue_block_assets', 'learndash_scripts');

/**
 * Utility function to parse the WP Block content looking for specific token patterns. 
 * 
 * @param content string full page/post content to be searched
 * @param token string This is the block token pattern to search for. Ex: learndash/ld-user-meta, learndash/ld-visitor
 * @param self_closing bool true if not an innerblock  
 *
 * @since 2.6
 */
function learndash_convert_block_markers_shortcode( $content = '', $block_token = '', $shortcode_token = '', $self_closing = false ) {
	
	if ( ( !empty( $content ) ) && ( !empty( $block_token ) ) && ( !empty( $shortcode_token ) ) ) {
		if ( $self_closing === true ) {
			preg_match_all('#<!--\s+wp:'. $block_token .'(.*?) /-->#is', $content, $ar );
			if ( ( isset( $ar[0] ) ) && ( is_array( $ar[0] ) ) && ( !empty( $ar[0] ) ) ) {
				foreach( $ar[1] as $pattern_key => $pattern_atts_json ) {
					$replacement_text = '';
					if ( !empty( $pattern_atts_json ) ) {

						$pattern_atts_array = json_decode( $pattern_atts_json );
						if ( ( is_array( $pattern_atts_array ) ) && ( !empty( $pattern_atts_array ) ) ) {
							//error_log('pattern_atts_array<pre>'. print_r($pattern_atts_array, true) .'</pre>');
			
							$shortcode_atts = '';
							foreach( $pattern_atts_array as $shortcode_key => $shortcode_value ) {
								if ( !empty( $shortcode_value ) ) {
									if ( !empty( $shortcode_atts ) ) $shortcode_atts .= ' ';

									$shortcode_atts .= $shortcode_key .'="'. $shortcode_value .'"';
								}
							}
							if ( !empty( $shortcode_atts ) ) {
								$replacement_text = '['. $shortcode_token .' '. $shortcode_atts .']';
							}
						}
					}
				
					// If we have built a replacement text then replace it in the main $content
					if ( !empty( $replacement_text ) ) {
						$content = str_replace( $ar[0][$pattern_key], $replacement_text, $content );
					}
				}
			}
		} else {
			preg_match_all('#<!--\s+wp:'. $block_token .'(.*?)-->(.*?)<!--\s+/wp:'. $block_token .'\s+-->#is', $content, $ar );
			if ( ( isset( $ar[0] ) ) && ( is_array( $ar[0] ) ) && ( !empty( $ar[0] ) ) ) {
				foreach( $ar[1] as $pattern_key => $pattern_atts_json ) {
					$replacement_text = '';
					if ( ( isset( $ar[2][$pattern_key] ) ) && ( !empty( $ar[2][$pattern_key] ) ) && ( !empty( $pattern_atts_json ) ) ) {
						$pattern_atts_array = json_decode( $pattern_atts_json );
						if ( ( is_array( $pattern_atts_array ) ) && ( !empty( $pattern_atts_array ) ) ) {
							$shortcode_atts = '';
							foreach( $pattern_atts_array as $shortcode_key => $shortcode_value ) {
								if ( !empty( $shortcode_value ) ) {
									if ( !empty( $shortcode_atts ) ) $shortcode_atts .= ' ';
									$shortcode_atts .= $shortcode_key .'="'. $shortcode_value .'"';
								}
							}
							if ( !empty( $shortcode_atts ) ) {
								$replacement_text = '['. $shortcode_token .' '. $shortcode_atts .']'. $ar[2][$pattern_key] . '[/'. $shortcode_token .']';
							}
						}
					}
				
					// If we have built a replacement text then replace it in the main $content
					if ( !empty( $replacement_text ) ) {
						$content = str_replace( $ar[0][$pattern_key], $replacement_text, $content );
					}
				}
			}
		}
	}
	
	return $content;
}