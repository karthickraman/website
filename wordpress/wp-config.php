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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'NiuUv*W;n<VP@xjtViU+bna6Eyp<)*OhyP<o+_l@,)Idc~**3KAH{#3hR5CH%[kE' );
define( 'SECURE_AUTH_KEY',  'yd34%K*1,iJw,`Fyf0x-,}oSu+|g!GRS;)n}`|;d]v~r9G.Zn9?{YFg>q3b<]Lzs' );
define( 'LOGGED_IN_KEY',    'e5kLus/iJ`VFE!S;74A?z3+`_($r_p 4B,7jHp <sO! 4]2/kGu-$UVJSlu?PG5m' );
define( 'NONCE_KEY',        '[3Mm)k&Mx}QMweq7jY1!anAJuY-@|rdCJzb(rp!6YGpK0-#+:.MD{bulXDnlz6&Z' );
define( 'AUTH_SALT',        'MU$k/:+.6f{^%cBY6zl{n#TuQh([U>O3K:pX!J<n8a(|SkNNwh`*ZIqEF>8G$nY[' );
define( 'SECURE_AUTH_SALT', 'F7u8jPxzM.]H{f285 g3hPNV=_>@QbK ?w7FFRBPqACYU(vQzYj~:To]A!Z%9FS<' );
define( 'LOGGED_IN_SALT',   '<mB)!O3/([O?_x(PY.:,_,:*&Q8tc`.`G_8t0PA~uxMPJ][63f??a<;}]=m S.V7' );
define( 'NONCE_SALT',       '{6?A;JjH/msS&+dm[]2&l6v#KcW.B2#%e7}arq zbDap*_5RZMnf]Z,_JQhcu(<`' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
