<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of yetki_profil_model
 *
 * @author Alexander
 */
class Auth_user_group_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct('auth_user_groups', 'group_id');
    }

    public function delete($id, $extra = array())
    {
        $affected_rows = parent::delete($id, $extra);
        
        if($affected_rows<1)
        {
            return $affected_rows;
        }
        
        $this->auth_ug_module_relationship_model->delete_where(array('GROUP_ID'=>$id));
        $this->auth_ug_user_relationship_model->delete_where(array('GROUP_ID'=>$id));
    }
}

