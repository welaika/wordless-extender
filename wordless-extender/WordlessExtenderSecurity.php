<?php

  Class WordlessExtenderSecurity{

    private $updatables;


    public function __construct()
    {
        $this->set_updatables();

        if ( WordlessExtenderDB::take('REMOVE_META_INFOS') === 'true' )
            $this->remove_meta_infos();
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

//   if ($_SERVER['REQUEST_METHOD'] == "POST") {

//     // if htaccess form value change you can modify the file
//     if ($_POST['htaccess_fix'] != get_option('htaccess_fix')){
//       $htaccess_file = ABSPATH.'.htaccess';
//       $htaccess_file_backup = ABSPATH.'.htaccess_backup';
//       $htaccess_content = file_get_contents($htaccess_file);
//       $new_htaccess_file = plugin_dir_path(__FILE__) .'resources/htaccess';
//       $new_htaccess_content = file_get_contents($new_htaccess_file);

//       $pattern = '/#\sBEGIN\swordless-extender.*#\sEND\swordless-extender/s';
//       $updated_htaccess_content = preg_replace($pattern, ' ', $htaccess_content);

//       // if is true append additional code
//       if ($_POST['htaccess_fix'] == 'true') $updated_htaccess_content = $new_htaccess_content ."\n". $updated_htaccess_content;

//       // save new file and the backup
//       file_put_contents($htaccess_file, $updated_htaccess_content);
//       file_put_contents($htaccess_file_backup, $htaccess_content);
//     }

//     // remove default plugins and themes
//     if (isset($_POST['plugins_and_themes'])){
//       foreach ($_POST['plugins_and_themes'] as $value) {
//       }
//         deleteDirAndFile($value);
//     }

//     // empty xmlrpc.php
//     if (isset($_POST['xmlrpc'])){
//       unlink(ABSPATH .'xmlrpc.php');
//     }

//     // empty readme.html
//     if (isset($_POST['readme'])){
//       file_put_contents($_POST['readme'], '');
//     }

//     // store values in wp db
//     foreach ($_POST as $name => $property){
//       if (($name != 'submit') && ($name != 'plugins_and_themes') && ($name != 'xmlrpc') && ($name != 'readme')){
//         // update_option($name, $property);
//       }
//     }

//     wle_show_message('Security fixes saved!');

//     /*
//      * Remove Wordpress meta info from header and feeds
//      */
//     if (get_option('rmmetas') == 'true'){
//       //Remove generator name and version from your Website pages and from the RSS feed.
//       add_filter('the_generator', create_function('', 'return "";'));
//       //Display the XHTML generator that is generated on the wp_head hook, WP version
//       remove_action( 'wp_head', 'wp_generator' );
//       //Remove the link to the Windows Live Writer manifest file.
//       remove_action('wp_head', 'wlwmanifest_link');
//       //Remove EditURI
//       remove_action('wp_head', 'rsd_link');
//       //Remove index link.
//       remove_action('wp_head', 'index_rel_link');
//       //Remove previous link.
//       remove_action('wp_head', 'parent_post_rel_link', 10, 0);
//       //Remove start link.
//       remove_action('wp_head', 'start_post_rel_link', 10, 0);
//       //Remove relational links (previous and next) for the posts adjacent to the current post.
//       remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
//       //Remove shortlink if it is defined.
//       remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
//     }

//     /**
//      * Remove scripts version (js & css)
//      */
//     if (get_option('rmscriptver') == 'true'){
//       add_filter( 'style_loader_src', 'remove_ver_scripts', 102, 4 );
//       add_filter( 'script_loader_src', 'remove_ver_scripts', 102, 4 );
//     }


//         // remove Folders (recursive) and Files
//     function deleteDirAndFile($dirPath){
//       if (is_dir($dirPath)) {
//         if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
//             $dirPath .= '/';
//         }
//         $files = glob($dirPath . '*', GLOB_MARK);
//         foreach ($files as $file) {
//             if (is_dir($file)) {
//                 deleteDir($file);
//             } else {
//                 unlink($file);
//             }
//         }
//         rmdir($dirPath);
//       } else {
//         unlink($dirPath);
//       }
//     }

//     /**
//      * Remove scripts version (js & css)
//      */
//     function remove_ver_scripts($src){
//       if ( strpos( $src, 'ver=' ) )
//         $src = remove_query_arg( 'ver', $src );
//       return $src;
//     }


//   }
