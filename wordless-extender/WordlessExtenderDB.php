<?php

Class WordlessExtenderDB {

  public function __construct()
  {

  }

  public static function save($constant_db_name, $value = NULL)
  {
    if (!$_POST[$constant_db_name]){
      wle_show_message("Database incoherence: $constant_db_name is not set in the DB. Is this plugin initialized? I'll abort", true);
      return false;
    }
    if ($value) {
      update_option( $constant_db_name, mysql_escape_string($value) );
    } else {
      update_option( $constant_db_name, mysql_escape_string($_POST[$constant_db_name]) );
    }
  }

  public static function take($constant_db_name)
  {
    if (get_option($constant_db_name)){
      $retval = get_option($constant_db_name);
    } else {
      $retval = FALSE;
    }
    return $retval;
  }

}