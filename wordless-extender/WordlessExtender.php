<?php

include_once ABSPATH . 'wp-admin/includes/plugin.php';

Class WordlessExtender{


  public static $site_url;
  public static $path;
  public static $dirname;
  public static $url;
  public static $to_be_installed_plugins = array();
  
  public function __construct($path)
  {
    $this->set_site_url();
    $this->set_path($path);
    $this->set_dirname($path);
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

  private function set_path($path)
  {
    self::$path = $path;
  }

  public function get_path()
  {
    return self::$path;
  }

  private function set_dirname($path)
  {
    self::$dirname = basename(self::$path);
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
    self::$to_be_installed_plugins = $pluginlist;
  }

}

