<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Email_sinifi
 *
 * @author Alexander
 */
class AF_email
{
    private $CI;
    public $sender = '';

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->sender = config_item('email');

        $this->CI->load->library('email');
        $this->CI->email->from($this->sender, config_item('project_title'));
        $this->CI->email->set_mailtype('html');
    }

    public function send_by_database_template($to='',$mail_kodu='', $data = array())
    {
        $template = $this->CI->option_model->get_option($mail_kodu);

        if(!$template)
        {
            show_error(__('Email template has not found'));
        }
        foreach($data as $key=> $e)
        {
            $template = str_replace('@'.$key, $e, $template);
        }
        
        $this->CI->email->to($to);
        $this->CI->email->subject(config_item('project_title'));
        $this->CI->email->message($template);
        $this->CI->email->set_alt_message('');
        $this->CI->email->send();
    }

    public function send_forgot_password($to = '')
    {
        $user = $this->CI->user_model->get_row_where(
                array(
                    'email' => $to
                ));
        if(empty($user) || empty($user->new_password_key))
        {
            return FALSE;
        }

        $data = unserialize($user->new_password_key);
        $key = $data['key'];

        $message_html = $this->CI->template
                ->theme(config_item('theme'))
                ->build('email/forgot_password', array('key' => $key, 'user' => $user), TRUE);

        $this->CI->email->to($to);
        $this->CI->email->subject(config_item('project_name') . ' : ' . __('Forgot Password'));
        $this->CI->email->message($message_html);
        $this->CI->email->set_alt_message('');
        return $this->CI->email->send();
    }

    public function send_password_renewed($to = '', $parola = '')
    {
        $message_html = $this->CI->template->theme(config_item('theme'))
                ->build('email/password_renewed', array('password' => $parola), TRUE
        );

        $this->CI->email->to($to);
        $this->CI->email->subject(config_item('project_name') . ' : ' . __('Yoru password has been renewed'));
        $this->CI->email->message($message_html);
        return $this->CI->email->send();
    }


}