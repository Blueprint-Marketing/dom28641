<?php
/**
* Extends LicenseChecker
*/
class Pm_PluginMill_Licensing extends Am_LicenseChecker
{
	protected $request_vars = array (  0 => 'domain');

	/**
	 * Verify license
	 */
	public function verifyPluginLicense() {
		$valid = null;
		$message = null;
		if( !$this->checkLicenseKey()) {
			$valid = 0;
			$message = $this->getMessage();
		} else {
			$valid = 1;
			$message = $this->getMessage();
		}

		return array(
			'valid' => $valid,
			'message' => $message
			);
	}

	/**
	 * Activate Key
	 */
	public function activatePluginLicense( $options ) {
		$activation_cache = ($options['activation_cache']) ? $options['activation_cache'] : '' ;
		$prev_activation_cache = $activation_cache;

		$ret = empty( $activation_cache ) ? $this->activate( $activation_cache ) : $this->checkActivation( $activation_cache ) ;
		if( $prev_activation_cache != $activation_cache )
			$activation_cache = $activation_cache;

		if( !$ret ) {
			$activation_message = $this->getMessage();
			$activation_code = $this->getCode();
		} else {
			$activation_message = $this->getMessage();
			$activation_code = $this->getCode();
		}

		return array(
			'activation_message' => $activation_message,
			'activation_code' => $activation_code,
			'activation_cache' => $activation_cache
			);
	}

	/**
	 * Deactivate Key
	 */
	public function deactivatePluginLicense( $activation_cache ) {
		$deactivate = $this->deactivate( $activation_cache );
		if( $deactivate === false ){
			return $this->getMessage();
		} else {
			// Remove key and activation data
			$newoptions = array( 'support' => array() );

			// Update option with new options
			update_option( '_pm_pluginmill_shared', $newoptions );

			// Return message
			return $this->getMessage().'. Successfully de-activated.';
		}
	}

	public function getRootUrl() {
		return get_site_url();
	}
}