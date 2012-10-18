<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * 
 * @param type $array
 * @param type $value_field
 * @param type $text_field
 * @return type
 */
function parse_kendoui_dropdown_array($array=array(),$value_field='', $text_field='')
{
    unset($array['']);
    $options = array();
    foreach($array as $key => $e)
    {
        $row = array();
        
        /**
         * eğer $value_field ve $text_field boş gönderilmişse veritabanından veriler dropdown fonksiyonu ile çekilmiştir
         * indeksi ($key) ve değeri ($e) olacaktır.
         */
        if($value_field && $value_field)
        {
            $row['value'] = $e[$value_field];
            $row['text'] = $e[$text_field];
        }
        else{
            $row['value'] = $key;
            $row['text'] = $e;
        }
        
        $options[] = $row;
    }

    return $options;
}


/**
 * dizinin veya objenin indexlerini küçük harfe çevirir
 * @param type $object
 * @return \stdClass
 */
function object_change_key_case($object)
{
    if(is_object($object))
    {
        $_object = new stdClass();
        foreach($object as $key => $e)
        {
            $_key = strtolower($key);
            $_object->$_key = $e;
        }
        return $_object;
    }
    
    if(!is_array($object))
    {
        return $object;
    }

    #else is array
    $rows = array();
    foreach($object as $obj)
    {
        if(is_array($obj))
        {
            $_array = array();
            foreach($obj as $key => $e)
            {
                $_key = strtolower($key);
                $_array[$_key] = $e;
            }
            $rows[] = $_array;
        }
        else
        {
            $_object = new stdClass();
            foreach($obj as $key => $e)
            {
                $_key = strtolower($key);
                $_object->$_key = $e;
            }
            $rows[] = $_object;
        }
    }

    return $rows;
}

if(!function_exists('object_element'))
{

    function object_element($index, &$nesne, $default = '')
    {
        if(!isset($nesne))
        {
            return $default;
        }

        if(!is_object($nesne))
        {
            return $default;
        }

        $nesne = (object) $nesne;

        if(isset($nesne->$index))
        {
            return $nesne->$index;
        }

        return $default;
    }

}

if(!function_exists('cift_boyuttan_tek_boyutlu_dizi'))
{

    function cift_boyuttan_tek_boyutlu_dizi($value_field = '', $cift_boyutlu = array(), $index_field = '')
    {
        $yeni_dizi = array();

        if(empty($cift_boyutlu))
        {
            return $yeni_dizi;
        }

        if(is_object($cift_boyutlu))
        {
            $cift_boyutlu = (array) $cift_boyutlu;
        }

        $d = '';
        $i = '';
        foreach($cift_boyutlu as $key => $array)
        {
            if(is_object($array) && isset($array->{$value_field}))
            {
                $i = isset($array->{$index_field}) ? $array->{$index_field} : '';
                $d = $array->{$value_field};
            }
            elseif(isset($array[$value_field]))
            {
                $i = isset($array[$index_field]) ? $array[$index_field] : '';
                $d = $array[$value_field];
            }

            if($index_field)
            {
                $yeni_dizi[$i] = $d;
            }
            else
            {
                $yeni_dizi[] = $d;
            }
        }

        return $yeni_dizi;
    }

}
function is_it_return_array($current_value = '', $possible_values = array(), $if_it_is_return_set_str = ' class="active"', $if_it_isnot_return_set_str = '')
{
    return elements($possible_values, array($current_value => $if_it_is_return_set_str), $if_it_isnot_return_set_str);
}