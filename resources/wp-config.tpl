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

#WLE_DB
define('DB_NAME', 'wordless');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
#END_WLE_DB

#WLE_SALT
define('AUTH_KEY', '*9/30n>%wWSf%qJq*r4K4GjBSd`^c_iBDX:Gf&~V,2x%(xXI){=q.S/O[2S|Zd5#');
define('SECURE_AUTH_KEY',  'i{EO|T?oLsJJ<~nsonLj-#NN%>`]dBT~NDqmn4-hFzf^AaLHEK0Id]]>/.(m,D1}');
define('LOGGED_IN_KEY', '[j/5O }5$gF^ioNPe>qdc-a4XZ`(6OLIhoUf>F6Y7F14n1@W:bLfcIj@gr)p!aUn');
define('NONCE_KEY', 'V<Pkd8P`k&(Mi=VK$8A$kag4( .T-&#W1WUeXE]:<Mjm]DBY+o}.~rBFbcjn[@2O');
define('AUTH_SALT', 'Fu+|]O1ErlLw)^#PHq>7/I@i#e0%L~Trl+.pg-fJ~hpJzY^Kq;VYsT5UB$!o`?9P');
define('SECURE_AUTH_SALT', 'x,>B|>l2#ZC9qQ/zT;Ly<H(6)SV[e,)8Vjpj^R5.IFw~h!tE4|VKg3_`~Hy032zo');
define('LOGGED_IN_SALT', '4KU[O*.9cjCZkU+bO@)iL%3q?*:Pvdp= h~~]E`BPe^R n<c!yB#joV;G[(R*S2C');
define('NONCE_SALT', 'ZnE3Qz?)HG`S>yZPr@ nB]8nDmVzg;K 1II|*={Fe+|G<|UplAzn,jCs[1d0{OZ');
#END_WLE_SALT

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

#WLE_LANG
define('WPLANG', '');
#END_WLE_LANG

#WLE_DEBUG
define('WP_DEBUG', true);
#END_WLE_DEBUG

#WLE_DISALLOW_FILE_EDIT
#END_WLE_DISALLOW_FILE_EDIT

#WLE_EMPTY_TRASH_DAYS

#WLE_WP_ALLOW_REPAIR

#WLE_WP_POST_REVISIONS
#END_WLE_WP_POST_REVISIONS

#WLE_DISABLE_WP_CRON
#END_WLE_DISABLE_WP_CRON

#WLE_WP_CONTENT_DIR
        // 'WP_CONTENT_URL',
        // 'UPLOADS',
        // 'WP_PLUGIN_URL',
        // 'WP_PLUGIN_DIR',
#END_WLE_WP_CONTENT_DIR

#WLE_WP_SITEURL
#END_WLE_WP_SITEURL

#WLE_KEYS
        // 'AUTH_KEY',
        // 'SECURE_AUTH_KEY',
        // 'LOGGED_IN_KEY',
        // 'NONCE_KEY',
        // 'AUTH_SALT',
        // 'SECURE_AUTH_SALT',
        // 'LOGGED_IN_SALT',
        // 'NONCE_SALT',
#END_WLE_KEYS

#WLE_WP_LANG
#END_WLE_WP_LANG

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

#WLE_FS_METHOD
#END_WLE_FS_METHOD

#WLE_WP_CONTENT_DIR
#END_WLE_WP_CONTENT_DIR

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
