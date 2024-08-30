<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'voucher' );

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
define( 'AUTH_KEY',         'jnnL%bHU(B=ed9tc0XM8D$:iS;d%sKy-I1=$33)8u>@}Eu,p!biaC4z$}QYsQ6Sh' );
define( 'SECURE_AUTH_KEY',  '[Z+s/&*FF3uLLoMNzcQ!29X*cXV$<}jN4&6cBOSIB>t?phm5q8ZH[rGH#-;Jk/aw' );
define( 'LOGGED_IN_KEY',    ')T7fwT<U?TAh`Wp29Qui~AX4APL E6!*pRKa=M6,w> ik%^nk}]@0RXt,0*5q*]T' );
define( 'NONCE_KEY',        '6/Bh)?ArmR*z6.c_P<dlE|h:uovDR%DiO2~Y++Way8T|6F17zH@tnD8s-K rHWgY' );
define( 'AUTH_SALT',        'R.olIFJzR//_e:O{PzDqqy1iV|CM0iXkgSdu3diM6A[8.r`]@3mO&i[c*0v+#2,Q' );
define( 'SECURE_AUTH_SALT', 'pUJWC<1S>kz(56t)ZG@9P9#=aE 4HJ(A>9/i,*nbH*^-:Z> L$T{S{0/UU]CRYJu' );
define( 'LOGGED_IN_SALT',   'b+8D<pqt;I<p7!E9NqOL+pdS%w@y8mR0o[swgV2s c{H^PC_MlcnDfw :BtdUy]5' );
define( 'NONCE_SALT',       'uL@t{GfuL[zL0E*bHn[_fp c@kbB^G>UdfKiYF3oa:i|DtljY!K2!yg4Jwga6^3P' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
