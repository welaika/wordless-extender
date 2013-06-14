<?php

Class WordlessExtenderMenu{

  private $has_wordless_menu;

  private $plugins_submenu = array(
      'parent_slug' => 'wordless', 
      'page_title' => 'Plugin Manager',
      'menu_title' => 'Plugin Manager', 
      'capability' => 'install_plugins', 
      'menu_slug' => 'plugin_manager', 
      'function' => 'wle_plugin_manager'
    );

  private $plugins_menu = array(
      'page_title' => 'Wordless',
      'menu_title' => 'Wordless',
      'capability' => 'install_plugins',
      'menu_slug' => 'wordless-extender',
      'function' => 'wle_plugin_manager',
      'icon_url' => '/wp-content/plugins/wordless-extender/images/welaika.16x16.png', //check it
      'position' => 59
    );

  private $constants_submenu = array(
      'parent_slug' => 'wordless-extender', 
      'page_title' => 'Config Constants',
      'menu_title' => 'Config Constants', 
      'capability' => 'install_plugins', 
      'menu_slug' => 'config_constants', 
      'function' => 'wle_constants'
    );

  private $fixes_submenu = array(
      'parent_slug' => 'wordless-extender', 
      'page_title' => 'Security Fixes',
      'menu_title' => 'Security Fixes', 
      'capability' => 'install_plugins', 
      'menu_slug' => 'security_fixes', 
      'function' => 'wle_security'
    );

  public function __construct($wordless_menu_precence)
  {
    $has_wordless_menu = $wordless_menu_precence;
  }

  public function create_menu($value)
  {
    add_menu_page(
      $value['page_title'],
      $value['menu_title'],
      $value['capability'],
      $value['menu_slug'],
      $value['function'],
      $value['icon_url'],
      $value['position']
    );
  }

  public function create_submenu($value)
  {
    add_submenu_page(
      $value['parent_slug'],
      $value['page_title'],
      $value['menu_title'],
      $value['capability'],
      $value['menu_slug'],
      $value['function']
    );
  }

  public function create_menus()
  {
    if ($this->has_wordless_menu){
      $this->create_submenu($this->plugins_submenu);
      $this->create_submenu($this->constants_submenu);
      $this->create_submenu($this->fixes_submenu);
    } else {
      $this->create_menu($this->plugins_menu);
      $this->create_submenu($this->constants_submenu);
      $this->create_submenu($this->fixes_submenu);

      //Don't know what the follow is doing!
      global $submenu;
      $submenu['wordless-extender'][0][0] = 'Plugin Manager';
    }
  }

}