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
define('DB_NAME', 'sourceinnovations');

/** MySQL database username */
define('DB_USER', 'sourceaccess');

/** MySQL database password */
define('DB_PASSWORD', 'SoUrC3InN0VaT1OnS');

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
define('AUTH_KEY',         'rxkbo8z36flm5wpedgana3jqcubhdcjpetqei6scknsszarodtzqc5ua5bu3wgnq');
define('SECURE_AUTH_KEY',  'opli0quuivswszvx7ssr1hmjdqy3hsgyowe7z22ounb1cpzepxcgzbr0d5hwivpx');
define('LOGGED_IN_KEY',    'j64kjv9vlqaxyr6ewshvcxqbngqweuswbo6xqiaihdactpzvpxrnsbbsfmjannkx');
define('NONCE_KEY',        'ic6w5xp9tuo2yiphzze4f96q3u4heb7in9qncfu2wz5kwpjvisr2uzvshkftbbfn');
define('AUTH_SALT',        'tasy3nhc47eygnqzt4rxbaph9aaesh6ziagtzyt4nzzzsq0trp7ql7gtu8vkkfqv');
define('SECURE_AUTH_SALT', 'pnv9knb1kswpfhtvmlzd4mlemnzyhqism5fairrbszanl46hmymfwdzrmtxcxxqr');
define('LOGGED_IN_SALT',   'n4yngbavhgax0wdfxfs5kpgsvgdjy96ct0fqazuoyetp9o6jexq70ueex2frmpwm');
define('NONCE_SALT',       'm5p9vb56pplhxe4mihrs05s3fo3s2apge7rxuqcarrtpw5sbcjfnilw8zcvfpugp');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'source_';

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

/* Allow WordPress to Update Itself */
define('FS_METHOD','direct');


/* DIsable Auto Update */
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
