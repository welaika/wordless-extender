<?php

class WordlessExtenderPluginManager {

    private $plugin_list, $plugin_istances;

    public function __construct( $args )
    {
        $plugin_istances = array();
        (array)$this->plugin_list = $args;
    }

    public function get_plugin_list()
    {
        return $this->plugin_list;
    }

    public function get_all_installed_plugins()
    {
        return get_plugins();
    }

    public function initialize_plugins()
    {
        foreach ($this->plugin_list as $plugin) {
            $this->plugin_istances[] = new WlePlugin($plugin);
        }
    }

    public function get_plugin_istances()
    {
        return $this->plugin_istances;
    }
}

class WlePlugin extends WordlessExtenderPluginManager{

    private $is_installed, $is_active, $data, $urls, $status;

    public function __construct( $plugin )
    {
        if (is_array($plugin)) {
            $name = $plugin['Name'];
            $slug = $plugin['Slug'];
        } else {
            $name = $plugin;
            $slug = NULL;
        }
        $this->set_is_installed($name);
        $this->set_data($name, $slug);
        $this->set_is_active($name);
        $this->set_status();
        $this->set_urls();
    }

    private function set_is_installed($plugin)
    {
        foreach ($this->get_all_installed_plugins() as $p){
            if ($plugin == $p['Name']){
                $this->is_installed = true;
                return;
            }
        }
        $this->is_installed = false;
    }

    private function set_data($plugin, $slug)
    {
        if (!$slug) {
            $slug = sanitize_title( $plugin, $fallback_title = '', $context = 'save' );
        }

        if (!$this->is_installed){
            $this->data = array(
              'Name' => $plugin,
              'Slug' => $slug,
              'Version' => NULL,
              'Path' => NULL
              );
            return;
        }

        foreach ($this->get_all_installed_plugins() as $key => $value){
            if ($plugin == $value['Name']){
                $this->data = get_plugin_data( WP_PLUGIN_DIR.'/'.$key, $markup = false, $translate = true );
                $this->data['Slug'] = $slug;
                $this->data['Path'] = $key;
                return;
            }
        }
    }

    private function set_is_active($plugin)
    {
        if (!$this->is_installed){
            $return = false;
        }
        foreach ($this->get_all_installed_plugins() as $key => $value){
            if ($plugin != $value['Name'])
                continue;
            $return = (is_plugin_active( $key )) ? true : false;
        }
        $this->is_active = $return;
    }

    private function set_status()
    {
        if ( $this->is_installed() && $this->is_active() ){

            $this->status = 'Active';

        } elseif ( $this->is_installed() && !$this->is_active() ){

            $this->status = 'Inactive';

        } elseif ( !$this->is_installed() ) {

            $this->status = 'Not installed';

        } else {

            $this->status = 'Unknown';

        }

    }

    public function get_status(){

        return $this->status;

    }

    public function is_installed()
    {
        return $this->is_installed;
    }


    public function is_active()
    {
        return $this->is_active;
    }

    public function get_data($arg){
        if (!$this->data[$arg])
            return 'Unknown type of data requested';
        return $this->data[$arg];
    }

    private function set_urls()
    {
        include_once( ABSPATH . WPINC . '/pluggable.php');
        $this->set_install_url();
        $this->set_update_url();
        $this->set_activate_url();
        $this->set_deactivate_url();
        $this->set_delete_url();
        $this->set_details_url();
    }

    private function set_install_url()
    {
        $this->urls['install'] = get_bloginfo( 'url' ) . '/wp-admin/' . wp_nonce_url(
            'update.php?action=install-plugin&plugin=' . $this->data['Slug'],
            'install-plugin_' . $this->data['Slug']
            );
    }

    private function set_update_url()
    {
        $this->urls['update'] = get_bloginfo( 'url' ) . '/wp-admin/' . wp_nonce_url(
            'update.php?action=upgrade-plugin&plugin=' . $this->data['Slug'],
            'upgrade-plugin_' . $this->data['Slug'] );
    }

    private function set_activate_url()
    {
        $this->urls['activate'] = get_bloginfo( 'url' ) . '/wp-admin/' .  wp_nonce_url(
            'plugins.php?action=activate&plugin=' . $this->data['Path'] . '&plugin_status=all&paged=1&s',
            'activate-plugin_' . $this->data['Path']);
    }

    private function set_deactivate_url()
    {
        $this->urls['deactivate'] = get_bloginfo( 'url' ) . '/wp-admin/' .  wp_nonce_url(
            'plugins.php?action=deactivate&plugin=' . $this->data['Path'] . '&plugin_status=all&paged=1&s',
            'deactivate-plugin_' . $this->data['Path']);
    }

    private function set_delete_url()
    {
        $this->urls['delete'] = get_bloginfo( 'url' ) . '/wp-admin/' .  wp_nonce_url(
            'plugins.php?action=delete-selected&checked[]=' . $this->data['Path'] . '&plugin_status=all&paged=1&s',
            'bulk-plugins');
    }

    private function set_details_url()
    {
        $this->urls['details'] = get_bloginfo( 'url' ) . '/wp-admin/' .  'plugin-install.php?tab=plugin-information&plugin=' . $this->data['Slug'] . '&TB_iframe=true';
    }

    public function get_urls($arg)
    {
        if (!$this->urls[$arg])
            return 'Unknown type of url requested';
        return $this->urls[$arg];
    }

}
