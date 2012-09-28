<?php

/**
 * Description of ajax
 *
 * @author Alexander
 */
class Ajax_search extends Admin_Controller
{
    public $result_type;


    public function __construct()
    {
        parent::__construct();

        $this->config->set_item('compress_output', FALSE);
        $this->result_type = $this->input->get('result_type',TRUE);
    }

    public function _get_array_for_autocomplete($array = array(), $value_field = '', $text_field = '')
    {        
        $array_for_autocomplete = array();
        foreach($array as $key => $e)
        {            
            if(is_object($e))
            {
                $array_for_autocomplete[] = array(
                    'id' => $e->{$value_field}, 
                    //'value' => $e->{$text_field}, 
                    'text' => $e->{$text_field}
                );
            }
            else
            {
                $array_for_autocomplete[] = array(
                    'id' => $e[$value_field], 
                    //'value' => $e[$text_field], 
                    'text' => $e[$text_field]
                );
            }
        }
        
        return $array_for_autocomplete;
    }


    private function _get_json_for_autocomplete($array = array(), $value_field = '', $text_field = '')
    {
        return $this->fastjson->encode($this->_get_array_for_autocomplete($array, $value_field, $text_field));
    }

    private function _get_options_string_from_array($rows, $value_field, $text_field)
    {        
        $output = '';
        foreach($rows as $e)
        {
            $output .= '<option value="' . $e->{$value_field} . '">' . $e->{$text_field} . '</option>';
        }
        
        return $output;
    }

    function cities()
    {
        $this->load->model('city_model');
        
        $extra = array(
            'country_id' => $this->input->get('id'),
            'select' => 'city_id value, city_name text',
            'order_by' => 'city_name',
            'order' => 'ASC'
        );
        
        $json['rows'] = $this->city_model->get_rows($extra);
        $this->city_model->set_extra_from_url($extra);
        //array_unshift($json, array('value' => '', 'text' => ''));

        if($this->result_type=='option_html')
        {
            $json['html'] = $this->_get_options_string_from_array($json['rows'], 'value', 'text');
        }
        elseif($this->result_type=='array')
        {
            $json['options'] = $this->_get_array_for_autocomplete($json['rows'], 'value', 'text');      
        }
        
          
        $this->output->_display($this->fastjson->encode($json));        
    }

}

