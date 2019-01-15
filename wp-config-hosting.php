<?php


/*******************************************************************************************/
/*******************************************************************************************/
/*                                                                                         */
/*               DO NOT CHANGE THIS FILE, YOUR CHANGES WILL NOT BE SAVED                   */
/*                                                                                         */
/*******************************************************************************************/
/*******************************************************************************************/


/**
 *      =======================   MANAGED HOSTING WP-CONFIG FILE   =======================
 *
 *          This file has configurations that are managed automatically by your
 *              hosting account, any changes you make to this file WILL NOT BE SAVED.
 *
 *          If you feel you need to make changes to the seetings in this file please
 *              contact an agent in the support department.
 * 
 *          @package Pagely v4.0.1
 *      ==================================================================================
 */



/** Wordpress Cacheing Setting **/
if ( !defined('WP_CACHE') )
	define('WP_CACHE', true);


/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME',     'db_dom28641');

/** MySQL database username */
define('DB_USER',     'db_dom28641');

/** MySQL database password */
define('DB_PASSWORD', '7RxJGErMNerpf6UXndP6y7qF+YO/6FsZpJMChwxh');

/** MySQL hostname */
define('DB_HOST', 'vps-virginia-aurora-7-cluster.cluster-czvuylgsbq58.us-east-1.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Define method for plugin/theme upload or update **/
if ( !defined('FS_METHOD') )
	define('FS_METHOD','direct');



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

if ( !defined('AUTH_KEY') )
	define('AUTH_KEY',         'S7[o!7lr?Ed3SrvekKUx18jng?VDIlpxir99d1x2');
        
if ( !defined('SECURE_AUTH_KEY') )
	define('SECURE_AUTH_KEY',  '9OfbgRWc5HJn9dNRT[x9Ob35gHyhXrbq!Vh04OWf');
        
if ( !defined('LOGGED_IN_KEY') )
	define('LOGGED_IN_KEY',    ']jVfZP9FMU89323L4mEXw[SUiSqx48sbUezOIsRN');
        
if ( !defined('NONCE_KEY') )
	define('NONCE_KEY',        'jCoLRtnUkmW0ZJ9V2VAX9l#FxWjVPPqm1[Hskjxk');
        
if ( !defined('AUTH_SALT') )
	define('AUTH_SALT',        'Sat?vVrPdJ3FEISBMAm!WkE]rUibgy#d$Q2t6#!9');
        
if ( !defined('SECURE_AUTH_SALT') )
	define('SECURE_AUTH_SALT', 'W56MR4gAbi@MZXtG8fcRUTWB[W@RdpDqIPj1pD18');
        
if ( !defined('LOGGED_IN_SALT') )
	define('LOGGED_IN_SALT',   '[YKLML]I3e?YdsW7]@l9DKM2bczcX1@!V8JoTT@A');
        
if ( !defined('NONCE_SALT') )
	define('NONCE_SALT',       'nycFEP?nnhPMTk[G1zG1lvsu9Ing[iMXOAEK[$vu');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
if ( !defined('WPLANG') )
   define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if ( !defined('WP_DEBUG') )
    define('WP_DEBUG', false);


/** Turn off Post revisions to keep DB size down **/
if ( !defined('WP_POST_REVISIONS') )
	define('WP_POST_REVISIONS', false);


    
    /** Maske sure multisite is off **/
    if ( defined('MULTISITE') AND MULTISITE ){
        die('You do not have a multisite enabled account, please contact support.');
    }
    


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


