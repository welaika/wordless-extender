<?php

Class WordlessExtenderConstantManager{

    public $initialized;
    private $wpconfig, $inconstistent_constants = array();

    private static $instance;

    public static function get_instance()
    {
        if(self::$instance == null){
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->wpconfig = new WordlessExtenderWpconfig;
        $this->initialized = $this->check_init();

        if (!$this->initialized){
            $this->init();
        }

    }

    public function print_inconsistences(){
        if ( !empty($this->inconstistent_constants) )
            wle_show_message("WARNING: " . join( ', ', $this->inconstistent_constants) . " is/are probably being modified by hand in wp-config.php. This is a risky situation. Check plugin's and file's value and correct them", 1);
    }

    private function check_init()
    {
        return (get_option('WLE_INIT') && $this->wpconfig->search('WLE_DB_NAME')) ? true : false;
    }

    public function print_init_buttons()
    {
        if ($this->check_init()){
            return;
        } else {
          echo '<div class="init_buttons">
                  <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <input class="button-primary" name="WLE_INIT" value="Initialize" type="submit">
                  </form>
                </div>';
        }
    }

    private function init_db()
    {
        if (!isset($_POST['WLE_INIT']) || empty($_POST['WLE_INIT']))
            return;

        WordlessExtenderDB::save('INIT', 'OK');

    }

    private function init_wpconfig()
    {
        $tpl_content = $this->wpconfig->get_tpl();
        $orig = $this->wpconfig->read();

        $constants_to_migrate_into_new_wpconfig = [
            'DB_PASSWORD' => DB_PASSWORD,
            'DB_USER' => DB_USER,
            'DB_NAME' => DB_NAME,
            'DB_HOST' => DB_HOST
        ];

        if ($tpl_content){
            $this->wpconfig->write($orig, ABSPATH . 'wp-config.php.orig');
            $this->wpconfig->write($tpl_content);
        }

        foreach ($constants_to_migrate_into_new_wpconfig as $c_name => $c_value ) {
            $c = new WordlessConstant( $c_name, array( 'new_value' => $c_value ) );
        }
     }

    private function init()
    {
        if (!isset($_POST['WLE_INIT']) || empty($_POST['WLE_INIT']))
          return;

        $this->init_wpconfig();
        $this->init_db();
    }

    public function init_constant( $name )
    {
        $sub_class = 'WLE_' . $name;
        if (class_exists($sub_class))
          $constant = new $sub_class($name);
        else
          $constant = new WordlessConstant($name);


        if ( !$constant->is_consistent() )
            $this->inconstistent_constants[] = $constant->name;

        return $constant;
    }

    public function update_constants()
    {
        $constants_collection = WordlessExtenderConstantCollection::get_list();

        foreach ($constants_collection as $name => $args) {
            new WordlessConstant( $name );
        }

        $clean_url = preg_replace('/&message=[0-9]{0,2}/', '', $_SERVER['HTTP_REFERER']);
        wp_redirect( $clean_url .'&message=1' );
    }

}

Class WordlessConstant{
    public $description;
    public $name;
    private $value;
    private $new_value;
    private $presence_in_db;
    private $presence_in_wpconfig;
    private $to_be_updated;
    private $wpconfig;

    public function __construct( $constant_name, $options = array( 'new_value' => null ) )
    {
        $this->wpconfig = new WordlessExtenderWpconfig;

        $this->set_name( $constant_name );
        $this->set_presence_in_db();
        $this->set_old_value();
        $this->set_new_value( $options['new_value'] );
        $this->set_presence_in_wpconfig();
        $this->set_to_be_updated();

        if ($this->to_be_updated){
            $this->update_value($this->new_value);
            $this->update_wpc();
        }
    }

    private function set_name( $constant_name )
    {
        $this->name = $constant_name;
    }

    public function get_name()
    {
        return $this->name;
    }

    private function set_presence_in_db()
    {
        $this->presence_in_db = ( WordlessExtenderDB::take($this->name) === false ) ? false : true;
    }

    private function set_presence_in_wpconfig()
    {
        if ( $this->wpconfig->search_schema($this->get_schema()) ){
            $this->presence_in_wpconfig = true;
        } else {
            $this->presence_in_wpconfig = false;
        }

    }

    private function set_old_value()
    {
        $this->value = WordlessExtenderDB::take($this->name);
    }

    private function set_new_value( $new_value )
    {
        if ( !empty( $new_value ) && !is_null($new_value) )
            $v = $new_value;
        elseif ( isset( $_POST[$this->name] ) && !empty( $_POST[$this->name] ) && !is_null($_POST[$this->name]) )
            $v = $_POST[$this->name];
        else
            $v = '';

        if ( $v )
            $this->new_value = $v;
        else
            $this->new_value = $this->value;

    }

    public function is_consistent()
    {
        if ($this->presence_in_wpconfig === $this->presence_in_db)
            return true;

        return false;
    }

    private function set_to_be_updated()
    {
        if ( !$this->presence_in_db ){
            $this->to_be_updated = true;
            return;
        }

        $this->to_be_updated = ($this->value === $this->new_value) ? false : true;
    }

    public function get_value()
    {
        return $this->value;
    }

    /**
     * The schema defining the constant. It has just a return
     * that instruct the class about how your constant has to be defined.
     * The standard form is e.g.:
     *
     * return "define('{$this->name}', {$this->get_casted_value()});";
     *
     * Where {$this->name} is mandatory as the constant name definition.
     *
     * @see WordlessConstant::get_casted_value()
     *
     * @return mixed The entire definition code for the constant
     */
    public function get_schema()
    {
        return "define('{$this->name}', {$this->get_casted_value()});";
    }

    /**
     * Get the description in the backend on the line of the constant.
     *
     * @return string The description paragraph
     */
    public function get_description()
    {
        if ( isset($this->description) )
            return $this->description;

        return "Defines the {$this->name}";
    }

    public function set_description( $description )
    {
        $this->description = $description;
    }

    private function update_value($value)
    {
        WordlessExtenderDB::save($this->name, $value);
        $this->set_old_value();
    }

    private function update_wpc()
    {
        $new_wpconfig = $this->wpconfig->replace_constant( $this->name, $this->get_schema());
        $this->wpconfig->write( $new_wpconfig );
    }

    protected function get_casted_value()
    {
        $value = $this->new_value;
        switch ($value) {
            case 'true':
            case 'TRUE':
                return 'true';
                break;

            case 'false':
            case 'FALSE':
                return 'false';
                break;

            case null:
            case '':
                return "''";
                break;

            case is_numeric($value):
                return (int) $value;
                break;

            default:
                return "'{$value}'";
                break;
        }

    }

}
