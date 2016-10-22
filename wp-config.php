<?php
// Check if a local development file is defined and include it.
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	include( dirname( __FILE__ ) . '/local-config.php' );
}

//====================================================================
// Fill in all the needed constants below
//====================================================================

// Database
defined( 'DB_NAME' )     or define( 'DB_NAME', '%%' );
defined( 'DB_USER' )     or define( 'DB_USER', '%%' );
defined( 'DB_PASSWORD' ) or define( 'DB_PASSWORD', '%%' );
defined( 'DB_HOST' )     or define( 'DB_HOST', 'localhost' );
// ftp
defined( 'FTP_USER' ) or define( 'FTP_USER', '%%' );
defined( 'FTP_PASS' ) or define( 'FTP_PASS', '%%' );
defined( 'FTP_HOST' ) or define( 'FTP_HOST', '%%' );
defined( 'FTP_SSL' )  or define( 'FTP_SSL', false );
// Url
defined( 'WP_HOME' )  or define( 'WP_HOME', 'http://example.com' ); // no trailing slash

$table_prefix = 'rndm_'; // please change with 2-5 random letters/digits

// https://api.wordpress.org/secret-key/1.1/salt

define('AUTH_KEY',         'S/8M7{1mV{-.{zC_Asm1]ydn8cb%@iW3#LdJVfxC=q[9y!k9$}OIr1aebS 2c`/+');
define('SECURE_AUTH_KEY',  'cB /y%MS/+E8a<H7q{1O:j,LN00Z_{eUIvmuI+DZNMm3n;f|_6f,-+-VO!DbeXT5');
define('LOGGED_IN_KEY',    '%|0+Q0fQ3W:yx=o[uEu~NvWbn-6TfMjQ}`&SG-CDSU pB}n&%r|ZbSe0weXz=uz6');
define('NONCE_KEY',        '-C|yz3My(AwN.o61IJis_Wt+5s-|b@n@4I(k}z>8$iKBe+o$U/+MG4yBU!@<3e2A');
define('AUTH_SALT',        'cJ>ubL>}nc=+0Ooka9#Ot|d}4Qvz0)J8|4<NYy2Lgy,Ge>Q1oPwGL?#A,R7|/JS`');
define('SECURE_AUTH_SALT', '6Fd(2=-z6^]3FsMoORD6d=WXPlM=,X~x]/s<]=7NZO+|Di|4!|R`wfc6(-0n 3~@');
define('LOGGED_IN_SALT',   '%G6ONi$z7Wtl<|2k0|*bUDug8n1wIEr3f6~3r-zndk?,Ssz}^4F|X7}{|V10Bl1B');
define('NONCE_SALT',       '<-$7(jv1F}) KAq+C2S./7qD|cXB3-K43o~:|B?VA9,/0]_1!xN-TiT>-*Rys:TE');

// Multisite
defined( 'WP_ALLOW_MULTISITE' )   or define( 'WP_ALLOW_MULTISITE', false );
/* // Unquote for multisites
defined( 'MULTISITE' )            or define( 'MULTISITE', true );
defined( 'SUBDOMAIN_INSTALL' )    or define( 'SUBDOMAIN_INSTALL', false );
defined( 'DOMAIN_CURRENT_SITE' )  or define( 'DOMAIN_CURRENT_SITE', 'example.com' ); // no `http://` see local-config.php
defined( 'PATH_CURRENT_SITE' )    or define( 'PATH_CURRENT_SITE', '/' );
defined( 'SITE_ID_CURRENT_SITE' ) or define( 'SITE_ID_CURRENT_SITE', 1 );
defined( 'BLOG_ID_CURRENT_SITE' ) or define( 'BLOG_ID_CURRENT_SITE', 1 );
/**/

//====================================================================
// That's all, stop editing! Happy blogging.
//====================================================================
// Minor tweaks
defined( 'AUTOSAVE_INTERVAL' )  or define( 'AUTOSAVE_INTERVAL', 300 ); // autosave every 300 seconds
defined( 'WP_POST_REVISIONS' )  or define( 'WP_POST_REVISIONS', 10 ); // 10 post revisions
defined( 'DISALLOW_FILE_EDIT' ) or define( 'DISALLOW_FILE_EDIT', true ); // don't allow to edit files in the wp-admin

// URL and dirs
defined( 'WP_SITEURL' )     or define( 'WP_SITEURL', WP_HOME . '/wp' );
defined( 'WP_CONTENT_DIR' ) or define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
defined( 'WP_CONTENT_URL' ) or define( 'WP_CONTENT_URL', WP_HOME . '/content' );
defined( 'PLUGINDIR' )      or define( 'PLUGINDIR', 'content/plugins' ); // Relative to ABSPATH. For back compat.
defined( 'MUPLUGINDIR' )    or define( 'MUPLUGINDIR', 'content/mu-plugins' ); // Relative to ABSPATH. For back compat.
defined( 'UPLOADS' )        or define( 'UPLOADS', 'content/uploads' ); 

// Debug turned off on production
defined( 'WP_DEBUG' ) or define( 'WP_DEBUG', false );

// log errors when it's not a development server
if ( ! defined( 'WP_DEVELOPMENT' ) || WP_DEVELOPMENT !== true || ! defined( 'WP_DEVELOPMENT' ) || WP_DEBUG_DISPLAY === false ) {
	defined( 'WP_DEBUG_LOG' )     or define( 'WP_DEBUG_LOG', true );
	defined( 'WP_DEBUG_DISPLAY' ) or define( 'WP_DEBUG_DISPLAY', false );
	@ini_set( 'display_errors', 0 );
	@ini_set( 'log_errors', 1 );
	@ini_set( 'error_log', WP_CONTENT_DIR . '/debug.log' );
}

// DB
defined( 'DB_CHARSET' ) or define( 'DB_CHARSET', 'utf8' );
defined( 'DB_COLLATE' ) or define( 'DB_COLLATE', '' );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	defined( 'ABSPATH' ) or define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
