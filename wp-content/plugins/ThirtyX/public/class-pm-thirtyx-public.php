<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.techbasedmarketing.com
 * @since      9.1.0.0
 *
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/public
 * @author     Lynette Chandler <lynette@pluginmill.com>
 */
class Pm_ThirtyX_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    9.1.0.0
	 * @access   private
	 * @var      string    $plugin_slug    The ID of this plugin.
	 */
	private $plugin_slug;

	/**
	 * The version of this plugin.
	 *
	 * @since    9.1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    9.1.0.0
	 * @param      string    $plugin_slug       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_slug, $version ) {

		$this->plugin_slug = $plugin_slug;
		$this->version = $version;
		$this->load_dependencies();

	}

	/*
	 * Load dependent files
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ).'public/class-pm-thirtyx-pages.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    9.1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pm_ThirtyX_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pm_ThirtyX_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/pm-thirtyx-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    9.1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pm_ThirtyX_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pm_ThirtyX_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/pm-thirtyx-public.js', array( 'jquery' ), $this->version, false );

	}

	/*
	 * Load pages
	 */
	private function public_pages() {
		$options = new Pm_ThirtyX_Options( array() );
		$options = ( $options->load() ) ? $options->load() : array() ;
		$public_page = new Pm_Thirtyx_Pages( $options, $this->plugin_slug, $this->version );

		$public_page->run();
	}

	public function run() {
		$this->public_pages();
	}

}
