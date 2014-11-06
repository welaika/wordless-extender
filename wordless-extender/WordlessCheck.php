<?php

Class WordlessCheck{

    public function __construct()
    {
    }

    private function is_wordless_installed()
    {
        if (is_plugin_active('wordless/wordless.php')) {
            return true;
        } else {
            return false;
        }
    }

    private function wordless_data()
    {
        if ($this->is_wordless_installed()){
            $data = get_plugin_data(WP_PLUGIN_DIR . '/wordless/wordless.php');
            return $data;
        } else {
            return false;
        }
    }

    private function get_wordless_version()
    {
        if ($this->wordless_data()){
            $data = $this->wordless_data();
            $version = (float) $data['Version'];
            return $version;
        }
    }

    public function is_wordless_menu_present()
    {
        return $this->get_wordless_version() > 0.3 ? true : false;
    }
}
