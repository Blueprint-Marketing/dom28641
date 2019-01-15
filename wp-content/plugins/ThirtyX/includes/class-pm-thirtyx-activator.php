<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.techbasedmarketing.com
 * @since      9.1.0.0
 *
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      9.1.0.0
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/includes
 * @author     Lynette Chandler <lynette@pluginmill.com>
 */
class Pm_ThirtyX_Activator {

	public function register_pt () {
		$args = array(
			'public' => true,
			'label' => '30X Pages',
			'rewrite' => array('slug' => 'x'),
			'register_meta_box_cb' => array($this, 'ThirtyxAddMetabox'),
			'supports' => array( 'title' )
		);
		register_post_type( 'thirtyx', $args );
	}

	public function rewrite_flush() {
		$this->register_pt();
		$addOption = add_option( 'pm_thirtyx_opts', '', '', 'yes' );
		flush_rewrite_rules();
	}

	public function activate() {
		add_action( 'init', array($this, 'register_pt') );
		$this->rewrite_flush();
	}

}
