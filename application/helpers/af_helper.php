<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function get_status_type_id($status_type_code)
{
    $status_types = config_item('status_types');
    
    if(!isset($status_types[$status_type_code]))
    {
        show_error(__('Status type could not found'));
    }
    
    return $status_types[$status_type_code];
}