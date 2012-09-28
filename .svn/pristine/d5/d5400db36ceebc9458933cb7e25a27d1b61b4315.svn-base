<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MY_Input
 *
 * @author Alexander
 */
class MY_Input Extends CI_Input
{
    public function __construct()
    {
        if(PHP_EOL == "\r\n")
        {
            $this->_standardize_newlines = FALSE;
            log_message('debug', 'Windows server: standardize newlines disabled.');
        }
        parent::__construct();
    }

}
