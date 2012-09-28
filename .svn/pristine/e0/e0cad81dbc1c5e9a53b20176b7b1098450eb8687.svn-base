<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Kullanıcı Sınıfı
 */
class Auth
{
    public $CI;
 
    /**
     * Parolayı şifrelerken kullanılacak string
     * 
     * @var String
     */
    public $encryption_key = 'LK76TQib61ujOzqe3PNLS0uOMt8czKAwit8EYj7nNl3rM78Z4CLDI7eA250EYiT';

    /**
     * Eğer işlem başarılı olursa gösterilecek mesajları tutan değişken
     * 
     * @var Array
     */
    public $messages = array();

    /**
     * Eğer işlem başarısız olursa hataları tutacak olan değişken
     * 
     * @var Array
     */
    public $errors = array();

    function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('user_model');
    }
    
    public function get_module($module_code='')
    {
        //config_item('modules', $module_code);
        $modules = config_item('modules');
        if(!isset($modules[$module_code]))
        {
            return FALSE;
        }
        
        return $modules[$module_code];
    }


    public function module_exist($module_code='', $show_error=false)
    {
        $module = $this->get_module($module_code);
        if($show_error===FALSE)
        {
            return !empty($module);
        }
        
        if(empty($module))
        {
            show_404(__('Module is not exist'));
        }
                
    }

    public function is_authorized($module_code='',$show_error_page=TRUE)
    {
        $is_authorization_active = config_item('is_authorization_active');
        
        $module = $this->get_module($module_code);

        if(!$is_authorization_active)
        {
            return TRUE;
        }
        
        if(empty($module) && $show_error_page===TRUE)
        {
            show_404(__('Module is not exist'));
        }
		
		
        if(!in_array($module_code, config_item('user_permissions')))
        {
			if($show_error_page===TRUE)
			{
				show_error(__('You have no permission'));
			}
            else
			{
				return false;
			}
        }				
        
		return TRUE;
    }

    public function get_user_permissions($extra=array())
    {
        $permissions = $this->CI->auth_module_model->get_user_permissions($this->get_user_id());        
        return $permissions;
    }

    public function user_exist($field, $field_value)
    {
        if(!$field || !$field_value)
        {
            return FALSE;
        }

        $extra = array(
            $field => $field_value,
        );
        $adet = $this->CI->user_model->get_count($extra);

        if($adet > 0)
        {
            return TRUE;
        }

        return FALSE;
    }

    function login($email_or_username, $password, $remember_me='no', $by='email', $extra = array())
    {
        if(!$email_or_username || !$password) return FALSE;

        $password = $this->encrypt_password($password);

        $where = array('parola' => $password);
        if($by == 'email')
        {
            $where['email'] = $email_or_username;
        }
        else
        {
            $where['username'] = $email_or_username;
        }
        $where = array_merge($where, $extra);
        $user = $this->CI->user_model->get_row_where($where);

        if(empty($user))
        {
            return FALSE;
        }
        
        $this->CI->user_model->update($user->user_id, array('last_login' => mysql_now()));
        $this->CI->session->set_userdata('user_id', $user->user_id);

        if($remember_me == 'yes')
        {
            $this->CI->load->library('encrypt');
            $user_id = $this->CI->encrypt->encode($user->user_id);

            $this->CI->load->helper('cookie');
            $cookie_array = array(
                'name' => 'autologin',
                'value' => serialize(array('user_id' => $user_id)),
                'expire' => 60 * 60 * 24 * 31 * 2,
            );
            set_cookie($cookie_array);
        }

        return $user;
    }

    public function logout()
    {
        $this->CI->load->helper('cookie');
        delete_cookie('autologin');
        $this->CI->session->unset_userdata('user_id');
        $this->CI->session->sess_destroy();
    }

    public function autologin()
    {
        if($this->is_logged_in())
        {
            return FALSE;
        }

        $this->CI->load->library('encrypt');
        $this->CI->load->helper('cookie');

        $cookie = get_cookie('autologin', TRUE);        
        if(empty($cookie))
        {
            return FALSE;
        }
        
        $data = unserialize($cookie);
        if(!isset($data['user_id']))
        {
            return FALSE;
        }
        
        $kullanici = $this->CI->user_model->get_row_by_id(
                $this->CI->encrypt->decode($data['user_id']), array('kullanici_tipi' => $kullanici_tipi)
        );

        if(empty($kullanici))
        {
            return FALSE;
        }

        $this->CI->session->set_userdata('user_id', $kullanici->user_id);
        set_cookie(array(
            'name' => 'autologin',
            'value' => $cookie,
            'expire' => 60 * 60 * 24 * 31 * 2,
        ));
    }

    function current_user()
    {
        $user_id = $this->get_user_id();

        $extra = array(
            'select' => 'user_id,username,email, first_name, last_name, is_admin,full_name',
            'active' => 'yes'
        );

        $kullanici = $this->CI->user_model->get_row_by_id($user_id, $extra);
        return $kullanici;
    }

    public function is_logged_in()
    {
        $is_logged_in = FALSE;
        $user_id = $this->get_user_id();
        if($user_id > 0)
        {
            $is_logged_in = TRUE;
        }

        return $is_logged_in;
    }
 
    public function get_user_id()
    {
        return $this->CI->session->userdata('user_id');
    }

    public function generate_key($str='')
    {
        return sha1(mt_rand(10000, 99999) . time() . $str);
    }

    /**
     *
     * @param String $password
     * @return String
     */
    function encrypt_password($password)
    {
        return sha1(md5(sha1($this->encryption_key . $password . $this->encryption_key)));
    }

    /**
     * Parametre olarak gelen stringi class'ın $mesajlar değişkenine ekler
     * Yine parametre olarak gelen string'i redirect yapıldığında gösterilmek
     * üzere hafızaya alır
     *
     * @param String $mesaj
     */
    function add_message($mesaj)
    {
        $this->messages[] = $mesaj;
    }

    /**
     * Parametre olarak gelen stringi class'ın hatalar değişkenine ekler
     * Yine parametre olarak gelen string'i redirect yapıldığında gösterilmek
     * üzere hafızaya alır
     *
     * @param String $mesaj
     */
    function add_error($error)
    {
        $this->errors[] = $error;
    }

}

