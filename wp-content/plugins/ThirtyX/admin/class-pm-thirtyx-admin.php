<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.techbasedmarketing.com
 * @since      9.1.0.0
 *
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/admin
 * @author     Lynette Chandler <lynette@pluginmill.com>
 */
class Pm_ThirtyX_Admin {

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
	 * @param      string    $plugin_slug       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_slug, $version ) {

		$this->plugin_slug = $plugin_slug;
		$this->version = $version;
		$this->load_dependencies();

	}

	/**
	 * Load dependent files
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ).'includes/class-pm-thirtyx-options.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ).'admin/class-admin-page.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pm-thirtyx-metabox.php';
		if( !class_exists('Pmill_Aweber_Api') ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-aweber-api.php';
		}
		if( !class_exists('Pmill_Mailchimp_Api') ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mailchimp-api.php';
		}
		if( !class_exists('Am_LicenseChecker') ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ). 'vendor/Am/LicenseChecker.php';
		}
		if( !class_exists('Pm_PluginMill_Licensing') ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ). 'includes/class-pluginmill-licensing.php';
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    9.1.0.0
	 */
	public function enqueue_styles( $hook_suffix ) {

		$cpt = 'thirtyx';
		if( in_array( $hook_suffix, array('post.php', '.post-new.php', 'edit.php', 'thirtyx_page_30x_options') ) ) {
			$screen = get_current_screen();
			if( is_object( $screen ) && $cpt == $screen->post_type ) {
				wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/pm-thirtyx-admin.css', array(), $this->version, 'all' );
				wp_enqueue_style( 'wp-color-picker' );
			}
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    9.1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		$cpt = 'thirtyx';
		if( in_array( $hook_suffix, array('post.php', 'post-new.php', 'edit.php', 'thirtyx_page_30x_options') ) ) {
			$screen = get_current_screen();
			if( is_object( $screen ) && $cpt == $screen->post_type ) {
		  		wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/pm-thirtyx-admin.css', array(), $this->version, 'all' );
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/pm-thirtyx-admin.js', array( 'jquery' ), $this->version, false );
				wp_enqueue_script( 'arcode', plugin_dir_url( __FILE__ ) . 'js/arcode.js', array( 'jquery', $this->plugin_slug ), $this->version, false );
				wp_enqueue_media();
		  		wp_enqueue_script( 'wp-color-picker' );
			}
		}

	}

	/*
	 * Admin page
	 */
	private function admin_page() {
		$options = new Pm_ThirtyX_Options( array() );
		$options = ( $options->load() ) ? $options->load() : array() ;
		$admin_page = new Pm_ThirtyX_AdminPage( $options, $this->plugin_slug, $this->version );

		$admin_page->run();
	}

	/*
	 * Metabox
	 */
	private function metabox() {
		$options = new Pm_ThirtyX_Options( array() );
		$options = ( $options->load() ) ? $options->load() : array() ;
		$metabox = new Pm_ThirtyX_Metabox( $options, $this->plugin_slug, $this->version );
		$metabox->run();
	}

	/*
	 * Run the class
	 */
	public function run() {
		$this->admin_page();
		$this->metabox();	
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts') );
	}

}