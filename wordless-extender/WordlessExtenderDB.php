<?php

Class WordlessExtenderDB {

    public static function save( $name, $value = null )
    {
        if ( !is_null($value) ) {
            update_option( self::translate_name( $name ), $value );
        } elseif ( isset( $_POST[$name] ) ){
            update_option( self::translate_name( $name ), $_POST[$name] );
        } else {
            return false;
        }
    }

    public static function take( $name )
    {
        $taken = get_option( self::translate_name( $name ) );

        if ( false === $taken )
            return false;
        elseif ( '' === $taken )
            return '';
        else
            return $taken;
    }

    public static function clear( $name )
    {
        delete_option( self::translate_name( $name ) );
    }

    private static function translate_name( $name )
    {
        if ( !empty($name) )
            return 'WLE_' . $name;

        return false;
    }

}
