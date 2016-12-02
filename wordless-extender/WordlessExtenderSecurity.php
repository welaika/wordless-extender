<?php

  Class WordlessExtenderSecurity{

    public static $xmlrpc_path, $readme_path, $htaccess_path, $htaccess_tpl_path, $license_path;

    public static $current_htaccess, $htaccess_pattern;

    public function __construct()
    {
        $this->set_paths();
        $this->set_htaccess_contents();

        if ( WordlessExtenderDB::take('REMOVE_META_INFOS') === 'true' )
            $this->remove_meta_infos();

        if ( is_array( $target = WordlessExtenderDB::take('REMOVE_DEFAULT_THEMES_AND_PLUGINS') ) )
            $this->remove_default_themes_and_plugins( $target );

        if ( WordlessExtenderDB::take('REMOVE_XMLRPC') === 'true' )
            $this->remove_xmlrpc();

        if ( WordlessExtenderDB::take('REMOVE_README') === 'true' )
            $this->remove_readme();

        if (( WordlessExtenderDB::take('HARDEN_HTACCESS') === 'true' ) && $this->wle_htaccess_check())
            $this->harden_htaccess();

        if ( WordlessExtenderDB::take('REMOVE_LICENSE') === 'true' )
            $this->remove_license();
    }

    private function set_paths()
    {
        self::$xmlrpc_path = ABSPATH . 'xmlrpc.php';
        self::$readme_path = ABSPATH . 'readme.html';
        self::$license_path = ABSPATH . 'license.txt';
        self::$htaccess_path = ABSPATH . '.htaccess';
        self::$htaccess_tpl_path = WordlessExtender::$path . 'resources/htaccess.tpl';
    }

    private function set_htaccess_contents()
    {
        self::$current_htaccess = WordlessExtenderFilesystem::read_file( self::$htaccess_path );
        self::$htaccess_pattern = '/#\sBEGIN\swordless-extender.*#\sEND\swordless-extender/s';
    }

    private function wle_htaccess_check()
    {
        preg_match(self::$htaccess_pattern, self::$current_htaccess, $matches);
        if ( count($matches) > 0 ) {
            return false;
        }
        return true;
    }

    private function harden_htaccess()
    {
        $new_content = WordlessExtenderFilesystem::read_file( self::$htaccess_tpl_path );
        $new_content .= preg_replace( self::$htaccess_pattern, ' ', self::$current_htaccess );

        WordlessExtenderFilesystem::backup_and_update_file( self::$htaccess_path, $new_content );
    }

    private function remove_default_themes_and_plugins( $targets )
    {
        foreach ( $targets as $target ) {
            WordlessExtenderFilesystem::delete( $target );
        }
        WordlessExtenderDB::clear('REMOVE_DEFAULT_THEMES_AND_PLUGINS');
    }

    private function remove_xmlrpc()
    {
        WordlessExtenderFilesystem::delete( self::$xmlrpc_path );
        WordlessExtenderDB::clear('REMOVE_XMLRPC');
    }

    private function remove_readme()
    {
        WordlessExtenderFilesystem::delete( self::$readme_path );
        WordlessExtenderDB::clear('REMOVE_README');
    }

    private function remove_license()
    {
        WordlessExtenderFilesystem::delete( self::$license_path );
        WordlessExtenderDB::clear('REMOVE_LICENSE');
    }

    private function remove_meta_infos()
    {

        // Remove generator name and version from your Website pages and from the RSS feed.
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
        // Remove scripts' version
        add_filter( 'style_loader_src', array($this, 'remove_ver_scripts'), 102, 4 );
        add_filter( 'script_loader_src', array($this, 'remove_ver_scripts'), 102, 4 );

    }

    public function remove_ver_scripts($src)
    {
        if ( strpos( $src, 'ver=' ) )
            $src = remove_query_arg( 'ver', $src );

        return $src;
    }

    private static function updatables()
    {
        return array( 'REMOVE_META_INFOS', 'REMOVE_DEFAULT_THEMES_AND_PLUGINS', 'REMOVE_README', 'REMOVE_XMLRPC', 'HARDEN_HTACCESS', 'REMOVE_LICENSE' );
    }

    public static function update_securities()
    {
        foreach (self::updatables() as $field) {
            if (isset($_POST[$field]) && ( $_POST[$field] != WordlessExtenderDB::take($field) ) ) {
                WordlessExtenderDB::save( $field, $_POST[$field] );
            }
        }

        $clean_url = preg_replace('/&message=[0-9]{0,2}/', '', $_SERVER['HTTP_REFERER']);
        wp_redirect( $clean_url .'&message=1' );
    }

  }
