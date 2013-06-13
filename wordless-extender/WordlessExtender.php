<?php

include_once ABSPATH . 'wp-admin/includes/plugin.php';

Class WordlessExtender{


  public static $site_url;
  public static $dir;
  public static $dirname;
  public static $url;
  public static $to_be_installed_plugins;
  
  public function __construct()
  {
    $this->set_site_url();
    $this->set_dir();
    $this->set_dirname();
    $this->set_url();
    $this->set_to_be_installed_plugins();
  }

  private function set_site_url()
  {
    self::$site_url = get_bloginfo('url');
  }

  public function get_site_url()
  {
    return self::$site_url;
  }

  private function set_dir()
  {
    self::$dir = dirname(__FILE__) ."/../";
  }

  public function get_dir()
  {
    return self::$dir;
  }

  private function set_dirname()
  {
    self::$dirname = basename(self::$dir);
  }

  public function get_dirname()
  {
    return self::$dirname;
  }

  private function set_url()
  {
    self::$url = plugins_url(self::$dirname);
  }

  public function get_url()
  {
    return self::$url;
  }

  private function set_to_be_installed_plugins()
  {
    $pluginlist = array(
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
      'Limit Login Attempts'
    );
    $to_be_installed_plugins = $pluginlist;
  }

}

