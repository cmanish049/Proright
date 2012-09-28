<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pre($dizi=array())
{
    $args = func_get_args();
    
    echo '<pre>';
    foreach($args as $arg)
    {
        print_r($arg);
    }
    echo '</pre>';
}

