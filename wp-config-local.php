<?php

/**
 * The base configuration for WordPress local installation
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Database table prefix
 * * External settings when needed
 *
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wpdb');
define('DB_USER', 'root');
define('DB_PASSWORD', 'temp');
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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('FS_METHOD', 'direct');
