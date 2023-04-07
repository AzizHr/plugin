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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plugin' );

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
define( 'AUTH_KEY',         '9MC4S9V~Ent-H_XW;};3&}ybXSQOHD9eFArjXp;Wzc(mkGk[6[k#*QypeM9Fwf]S' );
define( 'SECURE_AUTH_KEY',  '3$#45cl!/@`$wM5eYeD37P{Ji-z_MJ>hBh) ^TAp@lW}u=f__2+Mh/l{[Sx+Syzx' );
define( 'LOGGED_IN_KEY',    'NKD+>K4n@qVw9i#A0rsw,zH#f*5iEVvUw}y66[Fu%>q)~9x(/,,fj=w3Wl8fUArI' );
define( 'NONCE_KEY',        '2EMmtRDo_,fou#L$Ii0+B/~oY:+$*FfBXm4E=3By#Az>UW0HIi5W;xHE.Nh)d=gW' );
define( 'AUTH_SALT',        '>c;[QSoj;S.Y7p8E%v2 8LNEV4SKHzJosq{z?:Kf5nr8%EFSyLOQ>v6^OeoM%@?=' );
define( 'SECURE_AUTH_SALT', 'StPzQZ:o&EY2&I,enZ!}WF[guDG8. k#m/0)=-/*]fjPzj NM{}-HF0KRUX-u8QC' );
define( 'LOGGED_IN_SALT',   '#d2(&s?)(U]I>GCn;vp~dq:~h3-yB8yIWfOMR XL,wBcf4-axkWw63^w8H+[p1>s' );
define( 'NONCE_SALT',       'CWcUO9UmC!HScPe#fjL]Gpnf73~wI[Fr48UbdKxr>y5j-DrX`bsb3}*y<I@6^yJm' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
