<?php

include_once ABSPATH . 'wp-admin/includes/plugin.php';

Class WordlessExtender {


    public static $site_url, $path, $dirname, $url, $to_be_installed_plugins = array(), $repository_url;

    public function __construct($path)
    {
        $wlCheck = new WordlessCheck;
        $wleMenu = new WordlessExtenderMenu($wlCheck->is_wordless_menu_present());
        add_action('admin_menu', array($wleMenu, 'create_menus'), 10);

        $this->set_site_url();
        $this->set_path($path);
        $this->set_dirname($path);
        $this->set_url();
        $this->set_to_be_installed_plugins();
        $this->set_admin_actions();
        $this->set_repository_url();
    }

    private function set_repository_url()
    {
        self::$repository_url = 'https://github.com/welaika/wordless-extender/';
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

    private function set_admin_actions()
    {
        $constant_manager = WordlessExtenderConstantManager::get_instance();
        add_action('admin_action_update_constants', array( $constant_manager, 'update_constants' ) );
        add_action('admin_action_update_securities', array( 'WordlessExtenderSecurity', 'update_securities' ) );

    }

    private function set_to_be_installed_plugins()
    {
        $pluginlist = array(
            'Wordless',
            'Users to Csv',
            array('Name' => 'InfiniteWP - Client', 'Slug' => 'iwp-client'),
            'Advanced Custom Fields',
            array('Name' => 'Advanced Custom Fields: Date and Time Picker', 'Slug' => 'acf-field-date-time-picker'),
            'Debug Bar',
            'Debug Bar Console',
            'Debug Bar Extender',
            'Formidable',
            'Limit Login Attempts',
            'Regenerate Thumbnails'
            );
        self::$to_be_installed_plugins = $pluginlist;
    }

    public static function get_message($code = 0)
    {
        $messages = array(0 => false, 1 => 'Successfully updated', 2 => 'Already done!');
        return $messages[$code];
    }
}

