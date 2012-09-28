<?php

/**
 * Description of login
 *
 * @author Alexander
 */
class login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->template->theme('admin-bootstrap');
    }

    public function index()
    {
        if($this->_form_validation())
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');
            $user = $this->auth->login($email, $password, $remember_me, 'email', array('is_admin' => 'yes'));            

            if(!empty($user))
            {
                redirect(admin_url('dashboard/index'));
            }
        }

        $this->template->build('login_view');
    }

    public function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $this->validation = array(
            array(
                'field' => 'email',
                'label' => __('Email'),
                'rules' => 'trim|required|max_length[100]|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => __('Password'),
                'rules' => 'trim|required|min_length[6]|max_length[20]'
            )
        );

        $this->form_validation->set_rules($this->validation);
        if($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }

        return TRUE;
    }

}

