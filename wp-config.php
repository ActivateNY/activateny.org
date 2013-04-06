<?php
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
define('DB_NAME', 'db_activatenyc');

/** MySQL database username */
define('DB_USER', 'activatenyc');

/** MySQL database password */
define('DB_PASSWORD', 'enidNYC666');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'h6zA$CCSr|_XJ[0ge#YCF707>T}:FS7%koOXRwA!d=jK7]9s)TJe|BpLp*`%5&L ');
define('SECURE_AUTH_KEY',  '`NvdG|f~ZG9qy,dGI->6a^ooa-2&,u|zR(O?CF|]LUi3tW8av5)g$)H>S=R8u2(G');
define('LOGGED_IN_KEY',    'p Ca$)nxsXX_z::}O?*k_&2;A%+|WI*X`gH]fX)EzwCLGU.u,z)4qkNPbfZ5/5N*');
define('NONCE_KEY',        'o#DMp)RTB&vxxqJ(^`~OQ^A$8zu8Tz>stnxpIv(qT59%4Lb|hQ4NTn/{g^GOa!e4');
define('AUTH_SALT',        'Ak,BSyjkhp1?15q|iZNjXH@+&@7#M_-xv}).66w@O`E|c{$Z]eb?!l|W-|PkBj(K');
define('SECURE_AUTH_SALT', 'J(;9]}I`Y-t{@v8bd5u7Zki:uo3<k)?z(7(5*k!&|fo8^JxL$T]-*J8m^b15]o1~');
define('LOGGED_IN_SALT',   ',F@G]uN_TT@ Fc!V8-bl78@POMe~+?-*wIg8HXZ]H|iE)>`|`j]i4HlcSQIZ=ic]');
define('NONCE_SALT',       'x6Q&1M >u6G9o/uGcZ?PI6*29zm8`F]9Qb)qCN]v*0&={y.GWWx+ysJc:K3gnOjN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
