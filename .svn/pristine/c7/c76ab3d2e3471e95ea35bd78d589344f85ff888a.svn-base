<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_URI
 *
 * @author Alexander
 */
class MY_URI extends CI_URI
{    
    public function __construct()
    {
        parent::__construct();
    }
    
    function uri_to_assoc($n = 2, $default = array())
	{
		return parent::$this->_uri_to_assoc($n, $default, 'segment');
	}
}
