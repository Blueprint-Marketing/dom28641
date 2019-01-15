<?php
/**
* Runs and executes public 30X pages
*/
class Pm_Thirtyx_Pages
{
	
	private $options;
	private $plugin_slug;
	private $plugin_version;

	public function __construct( Pm_ThirtyX_Options $options, $plugin_slug, $plugin_version ) {
		$this->options = $options;
		$this->shared_options = get_option( '_pm_pluginmill_shared' );
		$this->plugin_slug = $plugin_slug;
		$this->plugin_version = $plugin_version;
	}

	public function singleTemplate( $single ) {
		global $post;
		$terms = get_the_terms( $post->ID, 'pg_type' );

		if( $post->post_type == 'thirtyx' ) {
			if( $terms[0]->name === 'opt' ) {
				if( file_exists( plugin_dir_path( __FILE__ ) . 'thirtyx-page-template-optin.php' ) ) {
					return plugin_dir_path( __FILE__ ) . 'thirtyx-page-template-optin.php';
				}
			} else {
				if( file_exists( plugin_dir_path( __FILE__ ) . 'thirtyx-page-template-billboard.php' ) ) {
					return plugin_dir_path( __FILE__ ) . 'thirtyx-page-template-billboard.php';
				}
			}
		} 

		return $single;
	}

	public function dequeue_style() {
		wp_dequeue_style( 'style' );
	}

	public function run() {
		add_filter( 'template_include', array( $this, 'singleTemplate' ), 99 );
		add_action( 'wp_print_scripts', array( $this, 'dequeue_style' ), 100 );
	}

}