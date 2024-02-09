<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0EQw#Z]&(/wcd~4w8v:Me`F-_)NUOL^W95~LSdbJkn^2,.04I]+Q2_X3]PL(_#g|' );
define( 'SECURE_AUTH_KEY',  'mE;k}xFFbsnR9qrBCj1Csl}xea>9}ve$u<Tt47`^_^U+uvWl>=`4IT h~%k|[=kv' );
define( 'LOGGED_IN_KEY',    '|.70RdA)65W9WkFux=-r@_9Zwf863@swDMJ?rTNa+Jsu[a:JQ<5:bnv=_[y`DfCU' );
define( 'NONCE_KEY',        'Y>yV1<U{3k}DEX0vXz&_xESFXY9(0q}@&&hJ@R,,t-$dS.Bd}/=ua@DW}ntD:lqT' );
define( 'AUTH_SALT',        'ijH2Scyq{RsY?*MIAr#r0-1|E%.=gP.z@-;Lq&jSD>B6/xLC[f!qvQ{l2J3m-]~`' );
define( 'SECURE_AUTH_SALT', '4 e65UI 1xL#]0Nh5LLHw8<:@6IB6#Z5rRBAac,~AN)i_)zFh}p2=#JX~u8=+prb' );
define( 'LOGGED_IN_SALT',   'zB]-o%l8*f>gS_42psNt0sbr f|9,>E$NWQfr28u+xIe%;/v&EJZG3cUu|$0rpQH' );
define( 'NONCE_SALT',       ';uIg|wX<[(..$s2]1-DD$2.L%iXlJX_/IG%$6ZM-!+.zVd3xhEUB|&1uhQBV4Vu%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
