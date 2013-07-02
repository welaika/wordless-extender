<?php

/*
  Administration page
 */


// Plugin Manager
function wle_plugin_manager() {
  // include HTML template
  include "plugins.html.php";
}

function wle_constants() {
  // if there's something in POST store it in DB and in wp-config.php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // foreach ($_POST as $name => $property){
    //   if ($name != 'submit') update_option($name, $property);
    // }

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
    
    //
    // QUESTE SONO COSTANTI DENTRO AL FILE
    //
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
    // $result = file_put_contents($config_file, $config_content);
    // Store backup
    // $result = file_put_contents($config_file_backup, $config_content_backup);
    // Rename wp-content folder
    if (isset($orig_constants["WP_CONTENT_URL"])){
      preg_match_all( '/\/(.*)\b/im', $orig_constants["WP_CONTENT_URL"], $old_wpcontent );
      // rename(ABSPATH . $old_wpcontent[1][0], ABSPATH . $_POST["WP_CONTENT_DIR"]);
    } else {
      // rename(ABSPATH .'wp-content', ABSPATH . $_POST["WP_CONTENT_DIR"]);
    }

    // results pop message
    // if ($result != false) wle_show_message('Preferences saved!');
    // else wle_show_message('Error saving new settings in your wp-config file', true);
    
    
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
      // $result = file_put_contents($config_file, $updated_config_content);
      // Store backup
      // $result = file_put_contents($config_file_backup, $config_content_backup);
    }

    // store values in wp db
    foreach ($_POST as $name => $property){
      if (($name != 'submit') && ($name != 'plugins_and_themes') && ($name != 'xmlrpc') && ($name != 'readme')){
        // update_option($name, $property);
      }
    }

    wle_show_message('Security fixes saved!');

  }
  // include HTML template
  include "security.html.php";
}

