<?php

Class WordlessExtenderMenu{

    private $has_wordless_menu, $constants_menu = array();

    // private $plugins_submenu = array(
    //     'parent_slug' => 'wordless',
    //     'page_title' => 'Plugin Manager',
    //     'menu_title' => 'Plugin Manager',
    //     'capability' => 'install_plugins',
    //     'menu_slug' => 'plugin_manager',
    //     'function' => 'wle_plugin_manager'
    //     );

    private $constants_submenu = array(
        'parent_slug' => 'wordless',
        'page_title' => 'Config Constants',
        'menu_title' => 'Config Constants',
        'capability' => 'install_plugins',
        'menu_slug' => 'config_constants',
        'function' => 'wle_constants'
        );

    private $fixes_submenu = array(
        'parent_slug' => 'wordless',
        'page_title' => 'Security Fixes',
        'menu_title' => 'Security Fixes',
        'capability' => 'install_plugins',
        'menu_slug' => 'security_fixes',
        'function' => 'wle_security'
        );

    public function __construct($wordless_menu_presence)
    {
        $this->constants_menu = array(
        'page_title' => 'Wordless Extender',
        'menu_title' => 'Wordless Extender',
        'capability' => 'install_plugins',
        'menu_slug' => 'wordless',
        'function' => 'wle_constants',
        'icon_url' => WordlessExtender::$path,
        'position' => 59
        );

        $this->has_wordless_menu = $wordless_menu_presence;
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
        $this->create_menu($this->constants_menu);
        // $this->create_submenu($this->constants_submenu);
        $this->create_submenu($this->fixes_submenu);
    }

}
