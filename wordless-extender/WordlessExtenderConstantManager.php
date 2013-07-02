<?php

Class WordlessExtenderConstantManager{

  private $template, $constants;
  public $initialized;

  public function __construct()
  {
    $this->set_template('resources/wp-config.tpl');
    $this->constants = array();
    $this->constants_istances = array();
    $this->init_db();
    $this->initialized = $this->check_init();

    if (!$this->initialized){
      wle_show_message("Warnign: database is not initialized yet! Use the init button at the bottom of the page to do it", true);

    }

  }

  private function set_template($tplpath)
  {
    $this->template = WordlessExtender::$path . '/' . $tplpath;
  }

  private function check_init()
  {
    return (get_option('WLE_INIT')) ? true : false;
  }

  public function print_init_buttons()
  {
    if ($this->check_init()){
      echo '<div class="init_buttons">
              <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <input class="button-primary" name="WLE_init" value="RESET" type="submit" name="reset">
              </form>
            </div>';
    } else {
      echo '<div class="init_buttons">
              <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <input class="button-primary" name="WLE_init" value="INIT" type="submit">
              </form>
            </div>';
    }
  }

  public function init_db()
  {
    if (!isset($_POST['WLE_init']) || empty($_POST['WLE_init']))
      return;
    
    WordlessExtenderDB::save('WLE_init', 'OK');
    
  }

  public function init_constant( $name ){
    $c = 'WLE_' . $name;
    return new $c($name);
  }

}

Class WordlessConstant{
  private $presence_in_wpconfig, $db_name, $value, $new_value;
  private $presence_in_db, $to_be_updated, $init_value;
  public $name, $description;

  protected function __construct( $constant_name )
  {
    $this->set_name( $constant_name );
    $this->set_description();
    $this->set_db_name( $constant_name );
    $this->set_init_value();
    $this->set_old_value();
    $this->set_new_value();
    $this->set_to_be_updated();

    if ($this->to_be_updated)
      $this->update_value($this->new_value);
  }

  private function set_name( $constant_name ){
    $this->name = $constant_name;
  }

  private function set_db_name( $constant_name )
  {
    $this->db_name = 'WLE_' . $constant_name;
  }

  private function set_presence_in_db(){
    $this->presence_in_db = (WordlessExtenderDB::take($this->db_name)) ? TRUE : FALSE;
  }

  private function set_old_value()
  {
    if ($this->presence_in_db){
      $this->value = WordlessExtenderDB::take($this->db_name);
    } else {
      $this->value = 'Undefined';
    }
  }

  private function set_new_value()
  {
    if (isset($_POST[$this->db_name]) && !empty($_POST[$this->db_name])){
      $this->new_value = $_POST[$this->db_name];
    } else {
      $this->new_value = $this->value;
    }
  }

  public function get_value()
  {
   return $this->value;
  }

  private function update_value($value)
  {
    if (!$this->$to_be_updated){
      wle_show_message("Internal Error: called update_value method but $this->db_name isn't to be updated", true);
      return;
    }
    if (WordlessExtenderDB::save($this->db_name))
      $this->set_old_value();
    
  }

  private function set_to_be_updated()
  {
    $this->to_be_updated = ($this->value == $this->new_value) ? FALSE : TRUE;
  }

  private function update_wpc()
  {

  }

  private function init()
  {
    $this->update_value($this->init_value);
  }
}

Class WLE_WP_SITEURL extends WordlessConstant{
  
  function __construct( $constant_name )
  {
    parent::__construct( $constant_name );
  }

  function set_init_value()
  {
    $this->init_value = $_SERVER['SERVER_NAME'];
  }

  function set_description()
  {
    $this->description = 'define the WP_SITEURL';
  }

}