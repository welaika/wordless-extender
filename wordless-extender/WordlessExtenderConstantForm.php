<?php

class WordlessExtenderConstantForm
{
    private function explode_options( $options )
    {
        $retval = '';

        if (!is_array($options))
            throw new Exception('Expected $options to be an array', 1);
        foreach ($options as $key => $value) {
            $retval .= "{$key}=\"{$value}\" ";
        }

        return $retval;
    }

    private function input( $options )
    {
        $label = ( isset($options['label']) ) ? $options['label'] : '';
        $checked = ( isset($options['checked'] ) && $options['checked'] == $options['value']) ? 'checked' : '';
        $value = ( isset($options['value']) ) ? $options['value'] : '';

        return "<input {$checked} type=\"{$options['type']}\" name=\"{$options['name']}\" value=\"{$value}\" > {$label}";
    }

    private function html_tag( $options )
    {
        $html_options = '';
        foreach ($options['attrs'] as $key => $value){
            $html_options .= "{$key}=\"{$value}\" ";
        }

        if ( $options['self_closing'] ){
            $close = " />";
        } else{
            $close = ">{$options['text']}</{$options['tag']}>";
        }

        return "<{$options['tag']} {$html_options} {$close} ";
    }

    private function td( $content )
    {
        echo '<td>' . $content . '</td>';
    }

    private function tr_open()
    {
        echo '<tr>';
    }

    private function tr_close()
    {
        echo '</tr>';
    }

    private function parse_input_type( $name, $inputType, $constantObj )
    {
        $ret = array();

        if ( is_null($inputType) || $inputType == 'text' ){
            $ret[] = array(
                "type" => 'text',
                "name" => $name,
                "value" => $constantObj->get_value(),
                'label' => ''
            );
        } elseif ( $inputType == 'number' ) {
            $ret[] = array(
                "type" => 'number',
                "name" => $name,
                "value" => (int)$constantObj->get_value(),
                'label' => ''
            );
        } elseif ( $inputType == 'bool' ) {
            $ret[] = array(
                "type" => 'radio',
                "name" => $name,
                "value" => 'true',
                'label' => 'true'
            );
            $ret[] = array(
                "type" => 'radio',
                "name" => $name,
                "value" => 'false',
                'label' => 'false'
            );

            foreach ($ret as &$array) {
                $array['checked'] = $constantObj->get_value();
            }
        } else {
            wle_show_message("Unsupported type of input for the constant {$name}", true);
            return false;
        }

        return $ret;
    }

    public function print_row( $name, $args = array( 'type' => null, 'description' => '', 'extra_controls' => array() ))
    {

        if ( !is_array($args) ){
            $args = array( 'type' => null, 'description' => '', 'extra_controls' => array() );
        }

        $inputtype = $args['type'];
        $description = $args['description'];
        if ( isset( $args['extra_controls'] ) )
            $extra_controls = $args['extra_controls'];

        $html = '';
        $cmanager = WordlessExtenderConstantManager::get_instance();

        $constantObj = $cmanager->init_constant($name);
        if (!empty($description))
            $constantObj->set_description($description);

        $inputs = $this->parse_input_type( $name, $inputtype, $constantObj );

        $this->tr_open();
        $this->td($constantObj->get_name());
        $this->td($constantObj->get_description());

        foreach ($inputs as $input) {
            $html .= $this->input( $input );
        }
            $this->td( $html );

        if (empty( $extra_controls ) ){

            $this->td('');

        }else{

            $this->td( $this->html_tag( $extra_controls ) );
        }
        $this->tr_close();
    }

}
