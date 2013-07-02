<?php   
  /* 
  Plugin Name: Wordless Extender
  Plugin URI: https://github.com/welaika/wordless-extender
  Description: Wordless Extender is a starting point for every WordPress web developer. Give a list of plugin we usually install on every installation, or we need to remember to install!
  Author: Welaika
  Version: 0.3
  Author URI: http://www.welaika.com
  */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

function __autoload($classname) {
  $filename = plugin_dir_path( __FILE__ ) ."wordless-extender/". $classname .".php";
  if (is_readable($filename))
    include_once($filename);
}

new WordlessExtender(plugin_dir_path( __FILE__ ));

require_once WordlessExtender::$path . 'admin.php';
require_once WordlessExtender::$path . 'functions.php';



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
