<?php

function yes_no_dropdown_items($add_empty_item = TRUE)
{
    $items = array(
        '' => '',
        '1' => __('Yes'),
        '0' => __('No')
    );
    
    if($add_empty_item===FALSE)
    {
        unset($items['']);
    }
    return $items;
    
}

function set_value($field = '', $default = '')
{
    if (!isset($_POST[$field]))
    {
        return $default;
    }

    if (FALSE === ($OBJ = & _get_validation_object()))
    {
        return form_prep($_POST[$field], $field);
    }

    return form_prep($OBJ->set_value($field, $_POST[$field]), $field);
}

function is_input_checked($name='', $value='')
{
    $CI =& get_instance();
    
    $checked = TRUE;
    
    if(!isset($_POST[$name]))
    {
        $checked = FALSE;
    }
    
    if($value!='' && $CI->input->post($name)!=$value)
    {
        $checked = FALSE;
    }
    
    return $checked;
}