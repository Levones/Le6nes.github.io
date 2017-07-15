<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bitnami_wordpress');

/** MySQL database username */
define('DB_USER', 'bn_wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'a0ddc00d44');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '872fb19e664aa5a3344da92539797351d55235a129bb8ac0e42712f04a830fa5');
define('SECURE_AUTH_KEY',  'd4bf1039f11e038b6e6a7abaad902508526ce4cd8b8192817d4786b32805e5f5');
define('LOGGED_IN_KEY',    '6f7dabd81a0e4fc3c4e7511889b4e619881609a77a683fda5bd1eb6ff3dfc7c8');
define('NONCE_KEY',        'b895be42ccdf050e5f0ecdbf3646b85d521f9f8f8ae95d7d595ebcec1d662a39');
define('AUTH_SALT',        '09915076e2f63ee252a640c7ee4f1c49d76d1765b697e431917bef9bb3c0b247');
define('SECURE_AUTH_SALT', '25301dca5f80eee5dfe106b44594f292f88030342a8cb1555afa6d6275b2d165');
define('LOGGED_IN_SALT',   '5c5f77193616ea240affd73ba2cbac2ae9ffadde9105113065ff18481e736247');
define('NONCE_SALT',       '919f8c240870100e62bf3eb977313c20478ff452681c492a634cfe57532c5e8c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', '/opt/lampp/apps/wordpress/tmp');


define('FS_METHOD', 'direct');


//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/?page=apps&name=wordpress&section=how-to-re-enable-the-xml-rpc-pingback-feature

// remove x-pingback HTTP header
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});
// disable pingbacks
add_filter( 'xmlrpc_methods', function( $methods ) {
        unset( $methods['pingback.ping'] );
        return $methods;
});
add_filter( 'auto_update_translation', '__return_false' );
