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
define('DB_NAME', 'nucleus_WPFRAME');

/** MySQL database username */
define('DB_USER', 'nucleus_WPFRAM3');

/** MySQL database password */
define('DB_PASSWORD', 'S61U{cV@9n@R');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

# Disables all core updates:
define( 'WP_AUTO_UPDATE_CORE', false );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^U{|_zW]u$lV0F.C@0RZogooz*|^cppRjr9JDCI<@is=jYqIHoQ$ u7=g0?C&YSj');
define('SECURE_AUTH_KEY',  'f|61)F-^2lC H&>HZciqWUnjR!x|JC{Pc{lPZQ!Z~pcL:x##,(&6GQ$lyqAltU|l');
define('LOGGED_IN_KEY',    'ZLOA}XRSo%]yP{p|oBbsw0uY:VF6C%HVw V)tyWE_`>-_e=6jM  HeulZ5,$`{G4');
define('NONCE_KEY',        'wQRo{)dKk2ent+gS(EGcd7~c](y$`5D%Ey7|}8C3:5yr04gst#l[uaG~EzJhT-o/');
define('AUTH_SALT',        'S..?(%RdPL}V,QZoHEn|i?|) pznDLjL1Y3L/;0!9+zOygA9H;r[=~?c6p+h&cHq');
define('SECURE_AUTH_SALT', '`M5q5w<b_12?Y(%4((xyB:cVsVW?nFpO[[@ M^~)fN34~*fU{1^U+1J5P.P_$,Ak');
define('LOGGED_IN_SALT',   '[b|P/cr|_MWbvPxVA?Dc/w_Uj4SO`po]9GNT!D$b)ak/eN-DplK}h=H&pj.i>gJa');
define('NONCE_SALT',       '%2fO_TB>w;I[U99BHW-?6mRuMfPP+!+t[{4L5M$Ag^S:)~C}BDsvPAV/|a+$V~*9');

/**#@-*/

/**	
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'msh_wp_';

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

/** Set Mainstreethost default theme **/
define( 'WP_DEFAULT_THEME', 'bones' );

/*
 * Gravity Forms License, Public and Private Key 
 * This will automaticly add the License, Public and Private to any new site.
*/

define("GF_LICENSE_KEY", "057a2645229bbdf53dfa94e0b4a2822e");
define("GF_RECAPTCHA_PUBLIC_KEY", "6Lc-itwSAAAAAJOiglKuG6A8HYc5y2LrmHiq6NuH");
define("GF_RECAPTCHA_PRIVATE_KEY", "6Lc-itwSAAAAAGynkhE6zJDUod5XFnRRQFEXrFAb");

/** Define WordPress.com API Key */
define('WPCOM_API_KEY','aab4c0c73777');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');