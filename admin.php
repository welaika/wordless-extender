<?php

/*
  Administration page
 */

function wle_is_wordless_menu_present(){
  if (is_plugin_active('wordless/wordless.php')){
    $wordless_data = get_plugin_data(WP_PLUGIN_DIR . '/wordless/wordless.php');
    $wordless_version = (float) $wordless_data['Version'];

    return $wordless_version > 0.3 ? true : false;

  }
}

function wle_admin_actions() {  
  global $plugin_dir, $plugin_url;
  
  // check if Wordless is already active
  if (is_plugin_active('wordless/wordless.php') && wle_is_wordless_menu_present()){

    $wordless_data = get_plugin_data(WP_PLUGIN_DIR . '/wordless/wordless.php')
    $wordless_version = (float) $wordless_data['Version'];
    var_dump($wordless_version);

    // add submenu voice for plugin manager
    add_submenu_page( 
      'wordless', 
      'Plugin Manager',
      'Plugin Manager', 
      'install_plugins', 
      'plugin_manager', 
      'wle_plugin_manager' 
    );

    // add submenu voice for constant config
    add_submenu_page( 
      'wordless', 
      'Config Constants',
      'Config Constants', 
      'install_plugins', 
      'config_constants', 
      'wle_constants' 
    );

    // add submenu voice for security fixes
    add_submenu_page( 
      'wordless', 
      'Security Fixes',
      'Security Fixes', 
      'install_plugins', 
      'security_fixes', 
      'wle_security' 
    );

  } else {

    // add submenu voice for plugin manager
    add_menu_page( 
      'Wordless',
      'Wordless',
      'install_plugins',
      'wordless-extender',
      'wle_plugin_manager',
      $plugin_url . '/images/welaika.16x16.png',
      59
    ); 

    // add submenu voice for constant config
    add_submenu_page( 
      'wordless-extender', 
      'Config Constants',
      'Config Constants', 
      'install_plugins', 
      'config_constants', 
      'wle_constants' 
    );

    // add submenu voice for security fixes
    add_submenu_page( 
      'wordless-extender', 
      'Security Fixes',
      'Security Fixes', 
      'install_plugins', 
      'security_fixes', 
      'wle_security' 
    );

    // rename the first menu voice
    global $submenu;
    $submenu['wordless-extender'][0][0] = 'Plugin Manager';
  }  

}  


// Plugin Manager
function wle_plugin_manager() {
  global $plugin_dir, $plugin_url;

  require_once $plugin_dir . 'functions.admin.php';

  # add thickbox
  wp_enqueue_script('thickbox', null, array('jquery'));
  wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', null, '1.0');
  wp_enqueue_style('wp-admin.css', '/' . WPINC . '/css/wp-admin.css', null, '1.0');

  # get plugin which we'd like to install ( 'interesting' plugins )
  global $wle_to_be_installed_plugins;
  # for each plugin create an array of name => slug
  _we_preprocess_to_be_installed($wle_to_be_installed_plugins);
  // echo "<pre>", var_dump($wle_to_be_installed_plugins)< "</pre>";
  
  # get all installed plugin
  $plugins = get_plugins();
  // echo "<pre>", var_dump($plugins)< "</pre>";
  
  # add Slug and Path to plugin array items
  _we_preprocess_current_plugins($plugins);
  // echo "<pre>", var_dump($plugins), "</pre>";

  $wle_to_be_installed_plugins = _we_merge($wle_to_be_installed_plugins, $plugins);
  // echo "<pre>", var_dump($wle_to_be_installed_plugins)< "</pre>";

  $plugin_data = array();
  foreach ($wle_to_be_installed_plugins as $value) {
    $plug = array(
      'status' => 'Not installed',
      'name' => 'Unknown',
      'version' => 'Unknown',
      'install' => NULL,
      'activate' => NULL,
      'deactivate' => NULL,
      'delete' => NULL,
      'details' => NULL,
    );

    # the current status of the plugin: Active, Not active, Not installed
    $plug['status'] = 
      (in_array($value['Slug'], array_map(function($i) { return $i['Slug']; }, $plugins)))
      ? ((is_plugin_active($value['Path']))
        ? 'Active'
        : 'Not active')
      : 'Not installed';

    # plugin readable name
    $plug['name'] = $value['Name'];

    # version ( if installed )
    if ($plug['status'] != 'Not installed') {
      $plug['version'] = $value['Version'];
    }

    $plugin_url_common = '&plugin_status=all&paged=1&s';

    # build link for installation    
    $plug['install'] = wle_SITE_URL . '/wp-admin/' . wp_nonce_url(
        'update.php?action=install-plugin&amp;plugin=' . $value['Slug'], 
        'install-plugin_' . $value['Slug']);

    if ($plug['status'] != 'Not installed') {
      $plug ['upgrade'] = wle_SITE_URL . '/wp-admin/' . wp_nonce_url(
        'update.php?action=upgrade-plugin&plugin=' . $value['Slug'], 
        'upgrade-plugin_' . $value['Slug'] );

      $plug['activate'] = wle_SITE_URL . '/wp-admin/' .  wp_nonce_url(
        'plugins.php?action=activate&plugin=' . $value['Path'] . $plugin_url_common, 
        'activate-plugin_' . $value['Path']);

      $plug['deactivate'] = wle_SITE_URL . '/wp-admin/' .  wp_nonce_url(
        'plugins.php?action=deactivate&plugin=' . $value['Path'] . $plugin_url_common, 
        'deactivate-plugin_' . $value['Path']);

      $plug['delete'] = wle_SITE_URL . '/wp-admin/' .  wp_nonce_url(
        'plugins.php?action=delete-selected&amp;checked[]=' . $value['Path'] . $plugin_url_common,
        'bulk-plugins');
    }
    
    if ($plug['status'] == 'Not installed'){
      $plug ['upgrade'] = '';
    }

    $plug['details'] = wle_SITE_URL . '/wp-admin/' .  'plugin-install.php?tab=plugin-information&amp;plugin=' . $value['Slug'] . '&amb;TB_iframe=true&amb;width=600&amb;height=550';

    // echo "<pre>", var_dump($plug), "</pre>";
    $plugin_data[] = $plug;
  }
  // echo "<pre>", var_dump($plugin_data), "</pre>";

  // include HTML template
  include "plugins.html.php";
}

function wle_constants() {
  // if there's something in POST store it in DB and in wp-config.php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    foreach ($_POST as $name => $property){
      if ($name != 'submit') update_option($name, $property);
    }

    // array of not strings constant definitions
    $not_strings = array('DISALLOW_FILE_EDIT', 'EMPTY_TRASH_DAYS', 'WP_ALLOW_REPAIR', 'WP_POST_REVISIONS', 'DISABLE_WP_CRON', 'WP_CONTENT_DIR', 'WP_CONTENT_URL', 'UPLOADS', 'WP_PLUGIN_URL', 'WP_PLUGIN_DIR');

    // Open wp-config
    $config_file = ABSPATH.'wp-config.php';
    $config_content = file_get_contents($config_file);
    // create backup
    $config_file_backup = ABSPATH.'wp-config-backup.php';
    $config_content_backup = $config_content;

    // search constants already stored in wp-config.php
    preg_match_all( '/\bdefine\b\s*\(\s*[\\\'"][^\\\'"]+[\\\'"]\s*,\s[^;]*;/im', $config_content, $matches );


    $constants = array('WP_SITEURL', 'AUTH_KEY', 'SECURE_AUTH_KEY', 'LOGGED_IN_KEY', 'NONCE_KEY', 'AUTH_SALT', 'SECURE_AUTH_SALT', 'LOGGED_IN_SALT', 'NONCE_SALT', 'WP_LANG', 'DISALLOW_FILE_EDIT', 'EMPTY_TRASH_DAYS', 'WP_ALLOW_REPAIR', 'WP_POST_REVISIONS', 'DISABLE_WP_CRON', 'FS_METHOD', 'WP_CONTENT_DIR');
    foreach ($constants as $constant){
      $get_constants[$constant] = get_option($constant);
    }

    // wplang fix
    $get_constants['WPLANG'] = $get_constants['WP_LANG'];
    unset($get_constants['WP_LANG']);

    if (isset($get_constants['WP_CONTENT_DIR'])){
      $get_constants['WP_CONTENT_URL'] = "WP_SITEURL .'/". $get_constants['WP_CONTENT_DIR'] ."'";
      $get_constants['UPLOADS'] = "'". $get_constants['WP_CONTENT_DIR'] ."/uploads'";
      $get_constants['WP_CONTENT_DIR'] = "ABSPATH .'/". $get_constants['WP_CONTENT_DIR'] ."'";
      $get_constants['WP_PLUGIN_URL'] = "WP_CONTENT_URL .'/plugins'";
      $get_constants['WP_PLUGIN_DIR'] = "WP_CONTENT_DIR .'/plugins'";
    }
    
    
    foreach ($matches[0] as &$match){
      $match = "start>>>" . $match . "<<<end";
      $match = str_replace('start>>>define(', '', $match);
      $match = str_replace(');<<<end', '', $match);
      $match = trim($match);
      $orig_constant = explode(',', $match);
      foreach ($orig_constant as &$value) {
        $value = trim($value);
        if($value[0] == "'") $value = substr($value, 1, -1);
      }
      $orig_constants[$orig_constant[0]] = $orig_constant[1];
    }

    // replace existing Constants in wp-config
    $existing_values = array_intersect_key($get_constants, $orig_constants);
    foreach ($existing_values as $key => $value) {
      $pattern = '/\bdefine\b\s*\(\s*[\\\'"]\b'. $key .'\b[\\\'"]\s*,\s[^;]*;/i';
      if (in_array($key, $not_strings)) $replacement = "define('". $key ."', ". $value ." );";
      else $replacement = "define('". $key ."', '". $value ."' );";
      $config_content = preg_replace($pattern, $replacement, $config_content);
    }
    /* 
     * add to the bottom the new constants
     */

    // remove already replaced constants from array
    foreach ($get_constants as $key => $value) {
      foreach ($existing_values as $key_compare => $value_compare) {
        if ($key_compare == $key) unset($get_constants[$key]);
      }
    }
    
    // create new constants strings
    foreach ($get_constants as $key => $value) {
      if (in_array($key, $not_strings)) $new_constants[] = "define('". $key ."', ". $value ." );";
      else $new_constants[] = "define('". $key ."', '". $value ."' );";
    }

    if (isset($new_constants)){
      // merge new constants
      $new_constants = implode("\n", $new_constants);
      
      // append new constants before require_once(ABSPATH . 'wp-settings.php')
      $config_content = str_replace("require_once(ABSPATH . 'wp-settings.php');", $new_constants ."\nrequire_once(ABSPATH . 'wp-settings.php');", $config_content);
    }

    // Update wp-config.php
    $result = file_put_contents($config_file, $config_content);
    // Store backup
    $result = file_put_contents($config_file_backup, $config_content_backup);
    // Rename wp-content folder
    if (isset($orig_constants["WP_CONTENT_URL"])){
      preg_match_all( '/\/(.*)\b/im', $orig_constants["WP_CONTENT_URL"], $old_wpcontent );
      rename(ABSPATH . $old_wpcontent[1][0], ABSPATH . $_POST["WP_CONTENT_DIR"]);
    } else {
      rename(ABSPATH .'wp-content', ABSPATH . $_POST["WP_CONTENT_DIR"]);
    }

    // results pop message
    if ($result != false) wle_show_message('Preferences saved!');
    else wle_show_message('Error saving new settings in your wp-config file', true);
    
    
  }
  // include HTML template
  include "constants.html.php";
}

function wle_security() {

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // if htaccess form value change you can modify the file
    if ($_POST['htaccess_fix'] != get_option('htaccess_fix')){
      $htaccess_file = ABSPATH.'.htaccess';
      $htaccess_file_backup = ABSPATH.'.htaccess_backup';
      $htaccess_content = file_get_contents($htaccess_file);
      $new_htaccess_file = plugin_dir_path(__FILE__) .'resources/htaccess';
      $new_htaccess_content = file_get_contents($new_htaccess_file);

      $pattern = '/#\sBEGIN\swordless-extender.*#\sEND\swordless-extender/s';
      $updated_htaccess_content = preg_replace($pattern, ' ', $htaccess_content);

      // if is true append additional code
      if ($_POST['htaccess_fix'] == 'true') $updated_htaccess_content = $new_htaccess_content ."\n". $updated_htaccess_content;

      // save new file and the backup
      file_put_contents($htaccess_file, $updated_htaccess_content);
      file_put_contents($htaccess_file_backup, $htaccess_content);
    } 

    // remove default plugins and themes
    if (isset($_POST['plugins_and_themes'])){
      foreach ($_POST['plugins_and_themes'] as $value) {
        deleteDirAndFile($value);
      }
    }

    // empty xmlrpc.php
    if (isset($_POST['xmlrpc'])){
      unlink(ABSPATH .'xmlrpc.php');
    }

    // empty readme.html
    if (isset($_POST['readme'])){
      file_put_contents($_POST['readme'], '');
    }

    // set WP_DEBUG
    if (isset($_POST['debug'])){
      // Open wp-config
      $config_file = ABSPATH.'wp-config.php';
      $config_content = file_get_contents($config_file);
      // create backup
      $config_file_backup = ABSPATH.'wp-config-backup.php';
      $config_content_backup = $config_content;

      // switch by selection
      switch ($_POST['debug']){
        case 'false':
          $replacement = "// BEGIN wordless-debug\n@ini_set('log_errors','Off');\n@ini_set('display_errors','Off');\n@ini_set('error_reporting', 0 );\ndefine('WP_DEBUG', false);\ndefine('WP_DEBUG_DISPLAY', false);\n// END wordless-debug";
        break;
        case 'true':
          $replacement = "// BEGIN wordless-debug\ndefine('WP_DEBUG', true);\n// END wordless-debug";
        break;
        case 'all':
          $replacement = "// BEGIN wordless-debug\n@ini_set('log_errors','On');\n@ini_set('error_log', dirname(__FILE__) .'/error.log');\n@ini_set('display_errors','On');\n@ini_set('error_reporting', E_ALL );\ndefine('WP_DEBUG', true);\ndefine('WP_DEBUG_DISPLAY', true);\n// END wordless-debug";
        break;
        case 'custom':
          $debug_debug = '$_GET["debug"]';
          $replacement = "// BEGIN wordless-debug\nif ( isset($debug_debug) && ($debug_debug == 'debug') ){\n@ini_set('log_errors','On');\n@ini_set('error_log', dirname(__FILE__) .'/error.log');\n@ini_set('display_errors','On');\n@ini_set('error_reporting', E_ALL );\ndefine('WP_DEBUG', true);\ndefine('WP_DEBUG_DISPLAY', true);\n} else {\n@ini_set('log_errors','Off');\n@ini_set('display_errors','Off');\n@ini_set('error_reporting', 0 );\ndefine('WP_DEBUG', false);\ndefine('WP_DEBUG_DISPLAY', false);\n}\n// END wordless-debug";
        break;
        default:
          $replacement = "// BEGIN wordless-debug\n// END wordless-debug";
        break;
      }
      // replace old wordless debug definition
      $pattern = '/\/\/\sBEGIN\swordless-debug.*\/\/\sEND\swordless-debug/s';
      $updated_config_content = preg_replace($pattern, $replacement, $config_content);
      // if no match replace WP_DEBUG constant definition with wordless definition
      if ($config_content == $updated_config_content){
        $pattern = '/\bdefine\b\s*\(\s*[\\\'"]\bWP_DEBUG\b[\\\'"]\s*,\s[^;]*;/i';
        $updated_config_content = preg_replace($pattern, $replacement, $config_content);
      }

      // Update wp-config.php
      $result = file_put_contents($config_file, $updated_config_content);
      // Store backup
      $result = file_put_contents($config_file_backup, $config_content_backup);
    }

    // store values in wp db
    foreach ($_POST as $name => $property){
      if (($name != 'submit') && ($name != 'plugins_and_themes') && ($name != 'xmlrpc') && ($name != 'readme')){
        update_option($name, $property);
      }
    }

    wle_show_message('Security fixes saved!');

  }
  // include HTML template
  include "security.html.php";
}

/*
 * Remove Wordpress meta info from header and feeds
 */
if (get_option('rmmetas') == 'true'){
  //Remove generator name and version from your Website pages and from the RSS feed.
  add_filter('the_generator', create_function('', 'return "";'));
  //Display the XHTML generator that is generated on the wp_head hook, WP version
  remove_action( 'wp_head', 'wp_generator' ); 
  //Remove the link to the Windows Live Writer manifest file.
  remove_action('wp_head', 'wlwmanifest_link'); 
  //Remove EditURI
  remove_action('wp_head', 'rsd_link');
  //Remove index link.
  remove_action('wp_head', 'index_rel_link');
  //Remove previous link.
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);      
  //Remove start link.
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  //Remove relational links (previous and next) for the posts adjacent to the current post.
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  //Remove shortlink if it is defined.
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}

/**
 * Remove scripts version (js & css)
 */
if (get_option('rmscriptver') == 'true'){
  add_filter( 'style_loader_src', 'remove_ver_scripts', 102, 4 );
  add_filter( 'script_loader_src', 'remove_ver_scripts', 102, 4 ); 
}

/*
 * Block direct access to wp-login
 */
if (get_option('blocklogin') == 'true'){
  add_action('login_head', 'block');
  add_filter('logout_url', 'add_key_to_url', 101, 2);
  add_filter('lostpassword_url', 'add_key_to_url', 101, 2);  
  add_filter('register', 'add_key_to_url', 101, 2);
}

// hooks
add_action('admin_menu', 'wle_admin_actions', 10);