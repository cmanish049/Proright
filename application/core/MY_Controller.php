<?php
if(!defined('BASEPATH')) exit('No direct access allowed.');

class MY_Controller extends CI_Controller
{
    protected $id = '0';
    protected $validation = array();
    public $user;
    public $data = array();
    protected $uri_assoc = array();
    public $is_logged_in = FALSE;
    public $is_multiple_language_active = FALSE;

    function __construct()
    {
        parent::__construct();
        require_once APPPATH . '/core/AF_exception.php';
        //$this->load->library();
        //$this->load->helper();
        //$this->load->model());

        /*if($_POST)
        {
            $_POST = $this->security->xss_clean($_POST);
        }*/
        		
        date_default_timezone_set('Europe/Istanbul');

        $this->auth->autologin();
        $this->logged_in_user = $this->auth->current_user();
        if(!empty ($this->logged_in_user))
        {
            $this->is_logged_in = TRUE;
        }
        
        ##################################DEBUG#############################################
        $controller = $this->router->class;        
        $method = $this->router->method;
        
        if($this->logged_in_user && !is_ajax() && $controller != 'admin_ajax')
        {
            //$this->output->enable_profiler(TRUE);
        }
        
        if((isset($this->uri_assoc['window']) && $this->uri_assoc['window'] == 'modal') || is_ajax())
        {
            $this->output->enable_profiler(FALSE);
        }
        ####################################################################################

        ################################### LANGUAGE OPTIONS ###############################
        //$this->config->set_languages();
        /*if($this->is_multiple_language_active)
        {
            set_language($this->lang->lang());
        }*/

        ################################### LANGUAGE OPTIONS ###############################

        $this->data['controller'] = $controller;
        $this->data['method'] = $method;
        $this->data['warning'] = '';
        $this->data['success'] = '';
        $this->data['error'] = '';
        $this->template->data('is_logged_in', $this->is_logged_in);
        $this->template->data('logged_in_user', $this->logged_in_user);

    }

}

require_once APPPATH . 'core/Public_Controller.php';
require_once APPPATH . 'core/Admin_Controller.php';