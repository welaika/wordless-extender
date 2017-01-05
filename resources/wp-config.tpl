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

#WLE_DB_NAME
define('DB_NAME', 'wordless');
#END_WLE_DB_NAME
#WLE_DB_USER
define('DB_USER', 'user');
#END_WLE_DB_USER
#WLE_DB_PASSWORD
define('DB_PASSWORD', 'password');
#END_WLE_DB_PASSWORD
#WLE_DB_HOST
define('DB_HOST', 'localhost');
#END_WLE_DB_HOST
#WLE_DB_CHARSET
define('DB_CHARSET', 'utf8');
#END_WLE_DB_CHARSET
#WLE_DB_COLLATE
define('DB_COLLATE', '');
#END_WLE_DB_COLLATE

#WLE_AUTH_KEY
define('AUTH_KEY', '');
#END_WLE_AUTH_KEY
#WLE_SECURE_AUTH_KEY
define('SECURE_AUTH_KEY', '');
#END_WLE_SECURE_AUTH_KEY
#WLE_LOGGED_IN_KEY
define('LOGGED_IN_KEY', '');
#END_WLE_LOGGED_IN_KEY
#WLE_NONCE_KEY
define('NONCE_KEY', '');
#END_WLE_NONCE_KEY
#WLE_AUTH_SALT
define('AUTH_SALT', '');
#END_WLE_AUTH_SALT
#WLE_SECURE_AUTH_SALT
define('SECURE_AUTH_SALT', '');
#END_WLE_SECURE_AUTH_SALT
#WLE_LOGGED_IN_SALT
define('LOGGED_IN_SALT', '');
#END_WLE_LOGGED_IN_SALT
#WLE_NONCE_SALT
define('NONCE_SALT', '');
#END_WLE_NONCE_SALT

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

#WLE_WP_DEBUG
define('WP_DEBUG', false);
#END_WLE_WP_DEBUG

#WLE_CONCATENATE_SCRIPTS
#END_WLE_CONCATENATE_SCRIPTS

#WLE_DISALLOW_FILE_EDIT
#END_WLE_DISALLOW_FILE_EDIT

#WLE_EMPTY_TRASH_DAYS
#END_WLE_EMPTY_TRASH_DAYS

#WLE_WP_ALLOW_REPAIR
#END_WLE_WP_ALLOW_REPAIR

#WLE_WP_POST_REVISIONS
#END_WLE_WP_POST_REVISIONS

#WLE_DISABLE_WP_CRON
#END_WLE_DISABLE_WP_CRON

#WLE_WPLANG
#END_WLE_WPLANG

#WLE_FS_METHOD
#END_WLE_FS_METHOD

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
