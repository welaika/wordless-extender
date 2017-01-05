<?php

Class WordlessExtenderConstantCollection {

    public static function get_list()
    {
        $list = array();

        $list['AUTH_KEY'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('AUTH_KEY') );
        $list['SECURE_AUTH_KEY'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('SECURE_AUTH_KEY') );
        $list['LOGGED_IN_KEY'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('LOGGED_IN_KEY') );
        $list['NONCE_KEY'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('NONCE_KEY') );
        $list['AUTH_SALT'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('AUTH_SALT') );
        $list['SECURE_AUTH_SALT'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('SECURE_AUTH_SALT') );
        $list['LOGGED_IN_SALT'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('LOGGED_IN_SALT') );
        $list['NONCE_SALT'] = array( 'type' => null, 'description' => '', 'extra_controls' => self::salt_attributes('NONCE_SALT') );
        $list['WP_DEBUG'] = array( 'type' => 'bool', 'description' => '' );
        $list['DISALLOW_FILE_EDIT'] = array( 'type' => 'bool', 'description' => '' );
        $list['CONCATENATE_SCRIPTS'] = array( 'type' => 'bool', 'description' => '' );
        $list['WPLANG'] = array( 'type' => 'text', 'description' => 'Set in the format <code>it_IT</code>' );
        $list['EMPTY_TRASH_DAYS'] = array( 'type' => 'number', 'description' => 'Use an integer to set the maximum trashed contents retention in <strong>days</strong>' );
        $list['WP_POST_REVISIONS'] = array( 'type' => 'number', 'description' => 'Use an integer to set the maximum kept revisions per post' );
        $list['DISABLE_WP_CRON'] = array( 'type' => 'bool', 'description' => '' );
        $list['WP_ALLOW_REPAIR'] = array( 'type' => 'bool', 'description' => '' );
        $list['FS_METHOD'] = array( 'type' => 'text', 'description' => 'It forces the filesystem method. It should only be "direct", "ssh2", "ftpext", or "ftpsockets". For details <a href="http://codex.wordpress.org/Editing_wp-config.php#WordPress_Upgrade_Constants" target="_blank">view codex</a>' );

        return $list;
    }


    // Generate custom array for key constant fields passing $key
    private static function salt_attributes($key){
        return array("tag" => "div", "text" => 'Generate Key', "attrs" => array("data-target" => $key, "class" => "button keygen_js"), "self_closing" => false );
    }

}
