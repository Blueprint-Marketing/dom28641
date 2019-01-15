<?php
class Pm_ThirtyX_Metabox {
	private $plugin_slug;
	private $version;

	public function __construct( $plugin_slug, $version ) {
		$this->plugin_slug = $plugin_slug;
		$this->version = $version;
		//$this->load_dependencies();
	}

	/*
	 * Add Metabox
	 */
	public function add_metabox( $post ) {
		add_meta_box(
			'pm_thirtyx_pages',
			__( 'Boilerplate', 'pm-thirtyx' ),
			array( $this, 'render_metabox' ),
			$post->post_type,
			'normal',
			'default',
			array( 'one' => $post->post_type )
		);
	}

	/*
	 * Render Metabox
	 */
	public function render_metabox( $post, $args ) {
		echo "<pre>".print_r($args['args'], true)."</pre>";
	}

	/*
	 * Runs the class
	 */
	public function run() {
		add_action( 'add_meta_boxes_post', array( $this, 'add_metabox' ) );
		add_action( 'add_meta_boxes_page', array( $this, 'add_metabox' ) );
	}
}