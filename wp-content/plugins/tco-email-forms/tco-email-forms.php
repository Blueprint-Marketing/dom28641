<?php

/*

Plugin Name: Email Forms
Plugin URI: http://theme.co/
Description: Creating custom opt-in forms has never been this easy...or fun! Carefully craft every detail of your forms using this plugin and subscribe users to a provider email list.
Version: 2.0.0
Author: Themeco
Author URI: http://theme.co/
Text Domain: __tco__
X Plugin: email-forms

*/

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Constants
//   02. Initialize
// =============================================================================

// Define Constants
// =============================================================================

define( 'EMAIL_FORMS_VERSION', '2.0.0' );
define( 'EMAIL_FORMS_ROOT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


// Initialize
// =============================================================================

//
// Framework. Only loaded once across all email form plugins.
//

if ( ! defined( 'TCO_EMAIL_INTEGRATION_IS_LOADED' ) ) {
  require( EMAIL_FORMS_ROOT_PATH . '/email-integration/setup.php' );
}


//
// Providers.
//

require( EMAIL_FORMS_ROOT_PATH . '/email-mailchimp/setup.php' );
require( EMAIL_FORMS_ROOT_PATH . '/email-convertkit/setup.php' );
require( EMAIL_FORMS_ROOT_PATH . '/email-getresponse/setup.php' );


//
// Textdomain.
//

function email_forms_textdomain() {
  load_plugin_textdomain( '__tco__', false, EMAIL_FORMS_ROOT_PATH . '/lang/' );
}

add_action( 'plugins_loaded', 'email_forms_textdomain' );
