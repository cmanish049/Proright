<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of yetki_modul_model
 *
 * @author Alexander
 */
class Auth_module_model extends MY_Model
{
    private $auth_ug_user_relationship = 'AUTH_UG_USER_RELATIONSHIP';
    private $auth_ug_module_relationship = 'AUTH_UG_MODULE_RELATIONSHIP';

    public function __construct()
    {
        parent::__construct('AUTH_MODULES', 'MODULE_ID');
    }
    
    protected function join_user_id(&$extra)
    {
        $user_id = $this->db->escape(clean_id(element('USER_ID', $extra)));
        $this->db->join($this->auth_ug_module_relationship, "$this->as.MODULE_ID=$this->auth_ug_module_relationship.GROUP_ID", 'INNER');
        $this->db->join($this->auth_ug_user_relationship, "$this->auth_ug_module_relationship.GROUP_ID=$this->auth_ug_user_relationship.GROUP_ID AND $this->auth_ug_user_relationship.USER_ID='$user_id'", 'INNER');
    }

    public function get_user_permissions($user_id='', $extra = array())
    {
        $user_id = clean_id($user_id);
        
        $_extra = array('select' => 'MODULE_CODE');
        $_extra = array_merge($_extra, $extra);
        
        $this->db->join("$this->auth_ug_module_relationship", "$this->as.MODULE_ID=$this->auth_ug_module_relationship.MODULE_ID", 'INNER');
        $this->db->join("$this->auth_ug_user_relationship", "$this->auth_ug_module_relationship.GROUP_ID=$this->auth_ug_user_relationship.GROUP_ID AND $this->auth_ug_user_relationship.USER_ID=".$this->db->escape($user_id), 'INNER');
        
        return parent::get_rows($_extra);
    }

}

