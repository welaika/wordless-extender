<?php   
  /* 
  Plugin Name: Wordless Extender
  Plugin URI: https://github.com/welaika/wordless-extender
  Description: Wordless Extender is a starting point for every WordPress web developer. Give a list of plugin we usually install on every installation, or we need to remember to install!
  Author: Welaika
  Version: 0.3
  Author URI: http://www.welaika.com
  */

include_once('wordless-extender/WordlessExtender.php');
include_once('wordless-extender/WordlessCheck.php');
include_once('wordless-extender/WordlessExtenderMenu.php');
//include_once(ABSPATH . 'wp-blog-header.php');

$wle = new WordlessExtender;

require_once $wle->get_dir() . 'admin.php';
require_once $wle->get_dir() . 'functions.php';
//include_once ABSPATH . 'wp-admin/includes/plugin.php';