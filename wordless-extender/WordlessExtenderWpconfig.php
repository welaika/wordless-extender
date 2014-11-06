<?php

Class WordlessExtenderWpconfig {

    private $tpl;
    private $content;
    private $path;

    public function __construct()
    {
        $this->set_path();
        $this->set_content();
        $this->set_tpl();
    }

    private function set_path()
    {
        $this->path = ABSPATH . 'wp-config.php';
    }

    private function get_path()
    {
        return $this->path;
    }

    private function set_content()
    {
        $this->content = $this->read($this->get_path());
    }

    private function get_content()
    {
        return $this->content;
    }

    private function set_tpl()
    {
        $this->tpl = $this->read(WordlessExtender::$path . 'resources/wp-config.tpl');
    }

    public function get_tpl()
    {
        return $this->tpl;
    }

    public function read( $what = "" )
    {
        $file = empty($what) ? $this->path : $what;

        if (file_get_contents($file))
            return file_get_contents($file);

        wle_show_message('Impossible to read from ' . $file, true);
        return FALSE;
    }

    public function write( $what, $where = null )
    {
        $file = is_null($where) ? $this->path : $where;

        $retval = file_put_contents($file, $what);

        if ($retval === FALSE ){
            wle_show_message("Impossible to write in {$file}", true);
            return FALSE;
        }
    }

    public function search( $needle )
    {
        if (strstr($needle, 'WLE_')){
            $pattern = '/^#'.$needle.'(.*)#END_'.$needle.'$/ms';
        } else {
            $pattern = '/^#WLE_'.$needle.'(.*)#END_WLE'.$needle.'$/ms';
        }
        preg_match($pattern, $this->get_content(), $matches);

        return (!empty($matches)) ? $matches[0] : FALSE;
    }

    public function search_schema( $needle )
    {
        return strstr( addcslashes($this->get_content(), '$'), addcslashes($needle, '$') );
    }

    public function replace_constant( $name, $newvalue )
    {
        $pattern = "/^(#WLE_{$name}).*(#END_WLE_{$name})$/ms";
        $replacement = "$1\r\n";
        $replacement .= "$newvalue\r\n";
        $replacement .= "$2";

        $newdata = preg_replace($pattern, $replacement, $this->get_content(), 1, $count);

        if (is_null($newdata)){
            wle_show_message("Error updating {$name}", true);
            throw new Exception("The updated wp-config.php would be empty, so I'm giving up", 1);
        }

        return $newdata;
    }

}
