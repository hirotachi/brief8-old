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
define( 'AUTH_KEY',         'Y7^+0m_zfsAY$aD+PqeP5qYqRt :92G])ti nEmS2jgY]8y{*3=}p%R(?13>/]M}' );
define( 'SECURE_AUTH_KEY',  '],hx2)P7ta}$`?,Q@5/7]80U@b6Cw<}:e^k%IOS3<V -*f$o_q-:ST?G+aW9]0]!' );
define( 'LOGGED_IN_KEY',    'Vp]|keNe3p`>V?Ab%]r+xs;]X^?y/U#v1Id)GsJ=Kk|]Jmm dw*S`[V@^@cs[8+i' );
define( 'NONCE_KEY',        '4/%>LF.Hto6PQJhChHtH_hI.KLz*FC|ifwn }>!cc%6VL;x^;fTz&G|rkr[|nvq@' );
define( 'AUTH_SALT',        '5X/QMX`|i9~?I1_tD[c+PZ5/CX!aoB]/@FJ}=17 $Zxy/JTrG$&ypcKMB,G[#K.V' );
define( 'SECURE_AUTH_SALT', 'zMS5L?!%kVScNZ432X5#M,!cfPK&PFW-k2@MXD(PFb(w6=vuc^Hrd`J&Q9HBq^cL' );
define( 'LOGGED_IN_SALT',   't!;Zb7%>Jf>Exc9bJN~sn[H?J4t{yiac4wNk%Gx){~6PPxu+RkBQ,S_!d=![BR!R' );
define( 'NONCE_SALT',       'vR1y]Cr1jih5K9)[*Vm{)~rS-Y[-ZtIq]IEPAT}o`qs[ZX19?0X,~cIs !qYn!}h' );

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
