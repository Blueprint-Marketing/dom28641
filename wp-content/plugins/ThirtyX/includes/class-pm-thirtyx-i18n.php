<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.techbasedmarketing.com
 * @since      9.1.0.0
 *
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      9.1.0.0
 * @package    Pm_ThirtyX
 * @subpackage Pm_ThirtyX/includes
 * @author     Lynette Chandler <lynette@pluginmill.com>
 */
class Pm_ThirtyX_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    9.1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pm-thirtyx',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
