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
