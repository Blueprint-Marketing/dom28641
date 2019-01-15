<?php
// https://carlalexander.ca/single-responsibility-principle-wordpress/
class Pm_ThirtyX_Options
{
	protected $options;

	/**
	 * Constructor
	 */
	public function __construct( array $options = array() ) {
		$this->options = $options;
	}

	/**
	 * Load plugin options
	 */
	public static function load() {
		$options = get_option('pm_thirtyx_opts', array());
		$options = ( $options ) ? $options : array();
		return new self($options);
	}

	public static function load_other($name, $default = NULL) {
		$options = get_option($name, array());
		return new self($options);
	}

	/**
	 * Gets the option for given name
	 */
	public function get( $name, $default = NULL ) {
		if( !$this->has( $name ) ) {
			return $default;
		}

		return $this->options[$name];
	}

	/**
	 * Check if options exists or not
	 */
	public function has( $name ) {
		return isset( $this->options[$name] );
	}

	/**
	 * Sets option
	 */
	public function set( $name, $value ) {
		$this->options[$name] = $value;
	}
}