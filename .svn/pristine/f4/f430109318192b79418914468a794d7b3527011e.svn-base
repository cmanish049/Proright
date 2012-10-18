<?php

function replace_dinamic_string($text,$data,$prefix='[',$suffix=']')
{
    if(is_object($data))
    {
        $data = (array)$data;
    }
    
    foreach($data as $key => $e)
    {
        $search = $prefix.$key.$suffix;
        $text = str_replace($search, $e, $text);
    }
    
    return $text;
}