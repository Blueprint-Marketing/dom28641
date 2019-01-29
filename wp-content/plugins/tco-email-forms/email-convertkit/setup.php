<?php

// =============================================================================
// EMAIL-CONVERTKIT/SETUP.PHP
// -----------------------------------------------------------------------------
// Email provider framework.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants
//   02. Enqueue Scripts
//   03. Load Provider
//   04. Register Provider
// =============================================================================

// Define Constants
// =============================================================================

define( 'TCO_EMAIL_CONVERTKIT_URL', plugins_url( '', __FILE__ ) );
define( 'TCO_EMAIL_CONVERTKIT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );



// Enqueue Scripts
// =============================================================================

require_once( TCO_EMAIL_CONVERTKIT_PATH . '/functions/enqueue/scripts.php' );



// Load Provider
// =============================================================================

require_once( TCO_EMAIL_CONVERTKIT_PATH . '/functions/provider.php' );



// Register Provider
// =============================================================================

if ( defined( 'TCO_EMAIL_INTEGRATION_IS_LOADED' ) ) {
  GLOBAL $email_forms;
  $email_forms->register_provider( 'ConvertKit', __FILE__ );
}
