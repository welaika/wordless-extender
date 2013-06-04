<?php   
  /* 
  Plugin Name: Wordless Extender
  Plugin URI: 
  Description: Wordless Extender is a starting point for every WordPress web developer. Give a list of plugin we usually install on every installation, or we need to remember to install!
  
  Author: Edoardo Tenani, Filippo Gangi Dino, Welaika
  Version: 0.2.0
  Author URI: http://www.welaika.com
  */  

define("wle_SITE_URL", get_bloginfo('url'));

include_once ABSPATH . 'wp-admin/includes/plugin.php';

global $plugin_dir, $plugin_url;
$plugin_dir = dirname(__FILE__) ."/";
$plugin_dirname = basename($plugin_dir);
$plugin_url = plugins_url($plugin_dirname);

require_once $plugin_dir . 'admin.php';
require_once $plugin_dir . 'functions.php';

# A list of plugin to be displayed and checked for installation
/*
  Example item:
  + if name is equal to plugin slug, put only the plugin name:
    'Wordless' 
  + if plugin slug is different from name, create an array:
    array(
      'Name' => 'InfiniteWP Client',
      'Slug' => 'iwp-client'
    )

    Please note: array keys are KEYS SENSITIVE!
*/
$wle_to_be_installed_plugins = array(
  'Wordless',
  'users2Csv',
  'White Label CMS', 
  array('Name' => 'InfiniteWP Client', 'Slug' => 'iwp-client'), 
  'Simple Fields', 
  'Options Framework', 
  'Posts To Posts',
  'Debug Bar',
  'Debug Bar Console',
  'Debug Bar Extender',
  'Formidable Forms',
);
