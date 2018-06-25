<?php /* BEGIN KINSTA STAGING ENVIRONMENT */ ?>
<?php if ( !defined('KINSTA_DEV_ENV') ) { define('KINSTA_DEV_ENV', true); /* Kinsta staging - don't remove this line */ } ?>
<?php if ( !defined('JETPACK_STAGING_MODE') ) { define('JETPACK_STAGING_MODE', true); /* Kinsta staging - don't remove this line */ } ?>
<?php /* END KINSTA STAGING ENVIRONMENT */ ?>
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'datawinners' );

/** MySQL database username */
define( 'DB_USER', 'datawinners' );

/** MySQL database password */
define( 'DB_PASSWORD', '3j5cc35Wc4qwB9j' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_unicode_ci');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^&}O_eO,`b!OL-GF>qGLD!{i0Iw_?{<yoa*uN/l|:T*+L@&*Ksu&3fw8(5I$4kJ:' );
define( 'SECURE_AUTH_KEY',  'Z Ym7&;U w 3{a+HAE0T5s&fgchpYr4 yJ@</4Kn?1_MY)(5O=}$}nJr<w`1{6@7' );
define( 'LOGGED_IN_KEY',    'Xzuk6zqv^f1;z3WHmZ)^p[rPJ{KzocIpiqu!Je}uM0yi-3n-M{#y{B&@} $,0u3s' );
define( 'NONCE_KEY',        'TV1{JDR7c:xJm_YSKF=,0tdH]#h|?.9|2AUVM:Z%-Z$W4O@`~m3>_DKZVT|-!d0#' );
define( 'AUTH_SALT',        '[>X~y|XElsBJX|CL|G22V!5]M jwI9-;)#?K@w+/J(f}<b)yK+plkOd]l1D!P(wN' );
define( 'SECURE_AUTH_SALT', 'DN0D/-?&eh|7NXA*?3i3}4ckYeDJ6SbN*Y^x|okYZoq<NRPTn6Z2W!},e=$(knf}' );
define( 'LOGGED_IN_SALT',   '%4Jg-3e{.k/aT)HJ?ifd^))Wgk~=w=%rO#j8O,Ea}j{hf4L<mX^A;#u 2I5MfLxd' );
define( 'NONCE_SALT',       '.J/lH%o,B`l8L624k1a98%d)* (_3*g(83CpB&+r4,:&l$l>tXisu[f&N7)H T%m' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




define('WP_CACHE', true);
define('DISALLOW_FILE_EDIT', false);
define('DISALLOW_FILE_MODS', false);
define('WPLANG', '');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
