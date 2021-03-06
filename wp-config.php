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
define('DB_NAME', 'u109200527_etaza');

/** MySQL database username */
define('DB_USER', 'u109200527_azahu');

/** MySQL database password */
define('DB_PASSWORD', 'ejuseHypeM');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'bcr9ElMUMKbVSqkQoaMIcKHHAzeY9PY8ZEK9PkyN63beVVEf0qIOCPuU9b9WqkPP');
define('SECURE_AUTH_KEY',  'JFFlz3W7sXjCohxCfPaagnVAmfNOHsZ1FlcyjSD7Q4m9BKaRy2KPbX2Spavk34Sa');
define('LOGGED_IN_KEY',    'VSYMCyOWSK7TbcPF4TqJ12SIa0jFrn16FGU9wosLQNsBPPz7HHjEjTRh62FZjCIT');
define('NONCE_KEY',        'wCwryRHSMoLs5E4Mw8kMPPWEhRgm1NjRiMlFR1QQJZBH7znaJwzIyLUPk6f0Zqlj');
define('AUTH_SALT',        'Nu5TmBVdeMMCkQWPh78JLx0kIySmKUkfpAWgaEG1dQRfpgPYvz4BhlcZcSvMp0VJ');
define('SECURE_AUTH_SALT', '2r85prBp9H6xh0q5AMAo8y5o8Sxb5EMLyWitxwOAJs4h5fta1sgo5sL4eG0b9V8W');
define('LOGGED_IN_SALT',   'u5aJWoN1EAoekuMPbjF9WvHtPVHYESqOVRLmA62jhOulxor1ey1dyv0gLanCA5UV');
define('NONCE_SALT',       'YKMqLtIU73Oix5BauQVKIaIRpCCNCDeQ8N3WdbEl9ZhBj0MBy4IonMaqFfJevkRD');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ouds_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
