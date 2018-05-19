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

if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {

	/**
	 * Settings for local environment loaded if available from wp-config-local.php
	 */

	include dirname(__FILE__) . '/wp-config-local.php';

} else {

	/**
	 * Settings for non-local environments, used when wp-config-local.php not available
	 */

	/** MySQL settings - You can get this info from your web host */

	/** The name of the database for WordPress */
	define('DB_NAME', 'wpdb');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'temp');

	/** MySQL hostname */
	define('DB_HOST', 'wpdb');

	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each
	 * a unique prefix. Only numbers, letters, and underscores please!
	 */
	$table_prefix = 'zx4yjn4r_';

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

	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/** Disable the Plugin and Theme Editor */
	define('DISALLOW_FILE_EDIT', true);
}

/**
 * Configuration for all available environments
 */

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '4cvATpgDhZGykXetTnQUKbAq9vIEcjt7k+Nx10qP');
define('SECURE_AUTH_KEY', 'yCTv3wMAIJfScdrFO4A/BGJMPYDcaiZot1oMj1Lw');
define('LOGGED_IN_KEY', 'Auid2jKdCNMtuMSgrMMbRWVQHFStVJmZNwPX/Me5');
define('NONCE_KEY', '2G3D+U4WdITZ6ndLDrjFtA0e6aKfNOu/fDzzrorl');
define('AUTH_SALT', 'tKcBoRRcJydZagcDY1SD1iRggMlDbZzRA7pNedJ4');
define('SECURE_AUTH_SALT', 'RuQYTroDwkFmTf+LANvgbpayFBkTTYwqzqbqNa07');
define('LOGGED_IN_SALT', '4ooKfMPic1wmDQsf77Jda5MIbbwdhqCTPCXMQoLb');
define('NONCE_SALT', 'yGtih1/gVHjR34CkknL81M1I8sLDwVVgZRYI3TWO');

/**#@-*/

/* That's all, stop editing! Happy blogging. */

/** Hide PHP errors */
if (!WP_DEBUG) {
	ini_set('display_errors', 0);
}

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
