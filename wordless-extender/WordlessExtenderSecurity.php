<?php

  Class WordlessExtenderSecurity{

    public static $xmlrpc_path, $readme_path, $htaccess_path, $htaccess_tpl_path, $license_path;

    public function __construct()
    {
        $this->set_paths();

        if ( WordlessExtenderDB::take('REMOVE_META_INFOS') === 'true' )
            $this->remove_meta_infos();
    private function set_paths()
    {
        self::$xmlrpc_path = ABSPATH . 'xmlrpc.php';
        self::$readme_path = ABSPATH . 'readme.html';
        self::$license_path = ABSPATH . 'license.txt';
        self::$htaccess_path = ABSPATH . '.htaccess';
        self::$htaccess_tpl_path = WordlessExtender::$path . 'resources/htaccess.tpl';
    }

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

    private function set_updatables()
    {
        $this->updatables = array( 'REMOVE_META_INFOS' );
    }

    public function update_securities()
    {
        foreach ($this->updatables as $field) {
            if (isset($_POST[$field]) && ( $_POST[$field] != WordlessExtenderDB::take($field) ) ) {
                WordlessExtenderDB::save( $field, $_POST[$field] );
            }
        }

        $clean_url = preg_replace('/&message=[0-9]{0,2}/', '', $_SERVER['HTTP_REFERER']);
        wp_redirect( $clean_url .'&message=1' );
    }

  }
