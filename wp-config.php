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
define('DB_NAME', 'panasonic');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'casanova1!@');

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
define('AUTH_KEY',         'eJ}GJ1zD4Z]6?q,7?%EYu/BwoT_OY*j!h]>TybsJk:U~s)b5Z/TyQcDWsgwnm3pR');
define('SECURE_AUTH_KEY',  'A~`]lfzTP npu0qwt>AGyp%y>jv`G5U D1m|^_T,Ywgmhh]=j]<}f{px!.`rVODp');
define('LOGGED_IN_KEY',    '&U&.Tdxy$pkVFTVy?]P8P%OdRY5yvt+3 |BUk3beaBJN&BL%NHJlBf27,jn8}c8 ');
define('NONCE_KEY',        '>t~F<$W%6n&XBmmxQ#7RbF%#o:PnC~Xe}icdGVdKjUmZB!1pXL:%w3f`=%Up3uU!');
define('AUTH_SALT',        '-bvXU>qM)xC@s3h7*bQr_I mGgq`RC*, gMC8BgrBqUk.t=Tu) F~b3^5 8~K3g@');
define('SECURE_AUTH_SALT', 'r.ZUz(o}{@}ki+~U]~a@fGLJ<%0Se*SZctZ ,02q*:Uj+Hh 4/,WBJ,o4VyZ, }d');
define('LOGGED_IN_SALT',   '0?2kq~*K!]yT4vRYd*>@M8Kf%J<JK:-ABLUy$4_~ZaSR;ov3bSPK PF/u|~K&l,Z');
define('NONCE_SALT',       '~HQKy1|>|]N&`:5Cvf&Ot!A`2^^678dd^Bg)G.}}JomIW.dtMcHpLCTV1ZfF@+?|');

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

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/* ???????????? ????????? ftp ??????????????? */
define('FS_METHOD', 'direct');

/** Memory Limit */
define('WP_MEMORY_LIMIT', '96M');

define( 'WP_AUTO_UPDATE_CORE', false );

define('DISALLOW_FILE_EDIT', true);