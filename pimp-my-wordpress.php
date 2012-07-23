<?php   
  /* 
  Plugin Name: Pimp My WordPress
  Plugin URI: 
  Description: Pimp My WordPress is a starting point for every WordPress we 
    develop. Performs some default security action and optimization and give a 
    list of plugin we usually install on every installation, or we need to 
    remember to install!
  
  Author: Edoardo Tenani <edoardo.tenani@welaika.com>
  Version: 0.1.0
  Author URI: http://www.welaika.com
  */  

define("PMW_SITE_URL", get_bloginfo('siteurl'));

include_once ABSPATH . 'wp-admin/includes/plugin.php';

$plugin_dir = ABSPATH . 'wp-content/plugins/pimp-my-wordpress/';
$plugin_url = plugins_url('pimp-my-wordpress');

require_once $plugin_dir . 'admin.php';
require_once $plugin_dir . 'functions.php';
$list_files = glob($plugin_dir . 'hooks/*.php');
if (is_array($list_files)) {
  foreach ($list_files as $filename) {
    require_once $filename;
  }
}

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
$pmw_to_be_installed_plugins = array(
  'Wordless', 'Better WP Security', 'White Label CMS', 
  array('Name' => 'InfiniteWP Client', 'Slug' => 'iwp-client')
);
