<?php

Class WordlessExtenderFilesystem{

    public static function delete( $path )
    {
      if (is_dir($path)) {

        if (substr($path, strlen($path) - 1, 1) != '/') {
            $path .= '/';
        }

        $objects = glob($path . '*', GLOB_MARK);
        foreach ($objects as $object) {
            if (is_dir($object)) {
                self::rrmdir($object);
            } else {
                unlink($object);
            }
        }
        rmdir($path);

      } elseif ( file_exists( $path ) ) {

        unlink($path);

      } else {

        return false;

      }
    }

    public static function backup_file( $file )
    {
        file_put_contents( $file.'.'.time().'.orig', file_get_contents($file) );
    }

    public static function update_file( $file, $new_content )
    {
        file_put_contents( $file, $new_content );
    }

    public static function read_file( $file )
    {
        if (file_exists($file))
            return file_get_contents( $file );
        else
            return false;
    }

    public static function backup_and_update_file( $file, $new_content )
    {
        self::backup_file($file);
        self::update_file($file, $new_content);
    }

    private static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                    }
            }
            reset($objects);
            rmdir($dir);
        }
    }

}
