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
global $memcached_servers;
$memcached_servers = array('default' => array('127.0.0.1:11211'));
global $memcached_blog_id;
$memcached_blog_id = $_SERVER['SERVER_NAME'];
define('FS_METHOD','direct');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ejbrecruit_db');

/** MySQL database username */
define('DB_USER', 'ejbrecruit_XtQ');

/** MySQL database password */
define('DB_PASSWORD', 'BWeGdKKC');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('DISABLE_WP_CRON', true);

define('WP_MEMORY_LIMIT', '128M');

define('WP_HOME','http://www.searchitrecruitment.com');
define('WP_SITEURL','http://www.searchitrecruitment.com');

/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY',         '&YQVyqQ=rp3ye y)yMUVa*dxukrRFx(C.~@lkRF2V>-z1E}2q7*Oon`jl!E#Z5^x');
define('SECURE_AUTH_KEY',  '`abgO@F|i @Zb&:k-|,&jgd7-!0_6Qp`:B4Oix|uEfmLp;C_j&-R}s]/:P(?@tz5');
define('LOGGED_IN_KEY',    '|:RpgnVrN-MP|$mV7[.fLgoph5hku>r`?]rowL2=?F`RRd(fiF)]@4b8Cn^1+<(c');
define('NONCE_KEY',        '2Y/UzrRw!)g!dbaBCi+H[#+698+r*Mg&P0{@:<[Vd9L31]r`5u8 <3mCKa6:sQ]>');
define('AUTH_SALT',        '/?v[5=5liS$/SXe9]k>yPc2UC_5:_`FDEuyCp`gwv(L(I}mR|gSUWA Hq {JM D|');
define('SECURE_AUTH_SALT', 'cQa-ppZi{%)ONza+LrBYz?})5Kk@X4@`[7$a`Zg3ls.<io6/F}#A>T]A~xgG576J');
define('LOGGED_IN_SALT',   'NFcZQ+74#*aWwv^Wj]Bc3Kn#{jY=[-B|-o;fR&u;3b|fNpQ>wX?i-jxwxDJ0YvaD');
define('NONCE_SALT',       'wO(8M V|B>rP|4MEzoo.bNIna0.-|:V+VpR26iT.a29]u>>!X@osc*e^(]:T#4;G');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
// $table_prefix  = '54c_';
$table_prefix  = 'wH9_';


/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/
// define('WPLANG', '');

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

