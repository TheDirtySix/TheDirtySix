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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\xampp\htdocs\TheDirtySix\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'HF:|G8}45}PI{W5!9d]$7^!.?a6.<_$up8t7^r!Ioo,k-[:R8/sg817VbdM]}osm');
define('SECURE_AUTH_KEY',  ':W.0+2ga>5u90oo8fRp+SwG4J/2Gf;48OU(zj{J71%^101agSz197I#ezCVPumY)');
define('LOGGED_IN_KEY',    '*Eg]A15CC_DD+OUD<WMT2n8C1q,;NO@s..rrQx4/g5v1T>FGK.}Me5>%:^8HrH0i');
define('NONCE_KEY',        'x|J<wb&MgaO!]/eI-c:{*(!!WGg<+?4j>N6jY=7^[iN:a3B;%u,Ub1s84JT,xX9k');
define('AUTH_SALT',        '9fE808L[r{?BZpuBUj:6)mA+7;$1Q+lZ01v19&{}$+zAb5#6<7y6.0RW2tYfe-^f');
define('SECURE_AUTH_SALT', ':W.0+2ga>5u90oo8fRp+SwG4J/2Gf;48OU(zj{J71%^101agSz197I#ezCVPumY)');
define('LOGGED_IN_SALT',   '7<q(:o/Mkcj,a/|kxEd]!RgTT20}04?DPfjIDb:YocOz3NUA.8z2nPi&S,%pS436');
define('NONCE_SALT',       '(=Pk[J)kVvTZ)c]!)xz4+R_DHY3]ps56cVr828tXD+kl}j:*Qs=B-6^qsFpR9uY-');

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
define('WP_DEBUG_DISPLAY', false);

define('WP_HOME', 'http://localhost/thedirtysix');
define('WP_SITEURL', 'http://localhost/thedirtysix');
define('WP_CONTENT_URL', '/wp-content');
define('DOMAIN_CURRENT_SITE', "http://localhost/thedirtysix");

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
