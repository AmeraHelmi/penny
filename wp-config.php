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
define('DB_NAME', 'penny');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'x2<a<5++*|FrYk`u}4tg^RUyCs}8<K/?qEs}4+j*qo.D+AndVxrlfC&y13#)H2-0');
define('SECURE_AUTH_KEY',  '[HVvz&ypV[<TDm+ x=A0m4J?_eqbLjF32k/,3d&c7DS(18BI<.r:4Nu2iU4n?7<0');
define('LOGGED_IN_KEY',    '&0})_tc<[uSmvrRDUT{`qW`v>v+~p,D(*|H- ($%KQ|~~;ZZ;3^ 3T?=QJqNVw,)');
define('NONCE_KEY',        '<?/o]^B|4l[)[Zvkgl=6+^o+q)p-7e/Oqp^7]$.4Cb+Cz>n{LJmh~C/Dk^.^UZH!');
define('AUTH_SALT',        '<|N1b;~Trv16Kd* .(zN`+>4+y>Yn@Mq>)]5 YI*|T#}yh>TxWrn+?N2@pVbD9Tj');
define('SECURE_AUTH_SALT', '*kqYBXj`: m9{Vi+KHM.6qFsg2PsMC38halG{gYk>YGMc|:@<-Sfmop`uwpq,M%l');
define('LOGGED_IN_SALT',   'taruYY+|^q.}cY.%ccFN<caA 1Fs? ^^C%)=)0sf]$HH^p-y1/y|nsEp49 bBL#`');
define('NONCE_SALT',       'yt2n1i|u8Gch~zn_HS9pGE+_rA-U!g#bVDrp1FM{Q|dHOEzJJO^,Ta5z-}Gf>iL#');

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

define('FS_METHOD', 'direct');
define('DISABLE_WP_CRON', true);
