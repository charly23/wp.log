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
define('DB_NAME', 'my.log');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'MNC3Eg>i |#W)9z 2~,lKXfQ=PriQ9{J;@/MNDq9=[fzlB)t-yo!q6u,8<u/5x`7');
define('SECURE_AUTH_KEY',  'Fd2yXAtX(T6p]*}]&zns7gN[cDSBj26;mgtQT& ]n<5:5mpFw2AqQzK($m3RF@>c');
define('LOGGED_IN_KEY',    '-VrbZ6e}M/#?),p2m4DHyPvMp]PU?x@Y=cT|AK&D?]z4Pp;$1M(/*xIqVj/`ncnM');
define('NONCE_KEY',        '--HZfg^cm7?|Na;p<}x/i7Sx>ZbCCDSZ!B%anLLHYYaYnQ*G*Dc5zJ (thC[)NcD');
define('AUTH_SALT',        '^kQ(GGz8Hev3#nY4Q-DO;Q;ZU1D1F/;c(D=n*P%AC,p}K3Gut2o#8iAnp]DpvlTy');
define('SECURE_AUTH_SALT', '0JI{l7g[Xdf7u]}AX4l-HJ<,CUf4_*eT|bDS7n_~e&fjs #P&vx 9~Ln1Jwd@%QZ');
define('LOGGED_IN_SALT',   'K3`,:.1yxtmUeIQ&~]}lt^7UqcMo</p#JM7GFE:]*,:kbtX%;Mwg)?,w*KjnH?`/');
define('NONCE_SALT',       'Rpx_Yh1fG-Qq6!-=nl$c2,&aI5{gJeK(}=|YU_n{)Tv8ySc_o]p_Bn(bZSS!=kcl');

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
