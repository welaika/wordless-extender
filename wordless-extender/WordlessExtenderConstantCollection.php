<?php

Class WordlessExtenderConstantCollection {

    public static function get_list()
    {
        $list = array();

        $list['WP_SITEURL'] = array( 'type' => null, 'description' => '' );
        $list['AUTH_KEY'] = array( 'type' => null, 'description' => '' );
        $list['SECURE_AUTH_KEY'] = array( 'type' => null, 'description' => '' );
        $list['LOGGED_IN_KEY'] = array( 'type' => null, 'description' => '' );
        $list['NONCE_KEY'] = array( 'type' => null, 'description' => '' );
        $list['AUTH_SALT'] = array( 'type' => null, 'description' => '' );
        $list['SECURE_AUTH_SALT'] = array( 'type' => null, 'description' => '' );
        $list['LOGGED_IN_SALT'] = array( 'type' => null, 'description' => '' );
        $list['NONCE_SALT'] = array( 'type' => null, 'description' => '' );
        $list['WP_DEBUG'] = array( 'type' => 'bool', 'description' => '' );
        $list['DISALLOW_FILE_EDIT'] = array( 'type' => 'bool', 'description' => '' );
        $list['WPLANG'] = array( 'type' => 'text', 'description' => 'Set in the format <code>it_IT</code>' );
        $list['EMPTY_TRASH_DAYS'] = array( 'type' => 'text', 'description' => 'Use an integer to set the maximum trashed contents retention in <strong>days</strong>' );
        $list['DISABLE_WP_CRON'] = array( 'type' => 'bool', 'description' => '' );
        $list['WP_ALLOW_REPAIR'] = array( 'type' => 'bool', 'description' => '' );

        return $list;
    }

}
