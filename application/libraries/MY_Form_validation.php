<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    public $CI;

    function __construct()
    {
        parent::__construct();

        $this->CI = & get_instance();
    }

    // --------------------------------------------------------------------

    /**
     * Valid Date 
     *
     */
    function valid_datetime($str)
    {
        $pattern = "/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/";
        return (preg_match($pattern, $str) === 0) ? FALSE : TRUE;
    }

    /**
     * Valid Url
     *
     */
    function valid_url($str)
    {
        return (filter_var($str, FILTER_VALIDATE_URL)) ? TRUE : FALSE;
    }

    function valid_recapthca($str)
    {
        if($this->CI->recaptcha->check_answer($this->CI->input->ip_address(), $this->CI->input->post('recaptcha_challenge_field'), $str))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function valid_capthca($str)
    {
        if(strtolower($str) != strtolower($this->session->userdata('captcha_word')))
        {
            $this->form_validation->set_message('valid_capthca', 'Girdiğiniz CAPTCHA yanlıştır. Lütfen tekrar deneyiniz.');
            return FALSE;
        }
    }

}

