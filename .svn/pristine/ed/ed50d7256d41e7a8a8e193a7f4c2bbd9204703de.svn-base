<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('prepare_for_xml'))
{

    function prepare_for_xml($str = '')
    {
        $str = decode_html($str);
        $str = xml_convert($str);
        $str = ascii_to_entities($str);
        
        return $str;
    }

}