<?php

/**
 * Description of ajax
 *
 * @author Alexander
 */
class Ajax extends Admin_Controller
{
    public $result_type;


    public function __construct()
    {
        parent::__construct();

        $this->config->set_item('compress_output', FALSE);        
    }

    public function generate_unique_key_for_customer()
    {
        $key = $this->auth->generate_unique_key_for_user();
        echo $key;
    }
}

