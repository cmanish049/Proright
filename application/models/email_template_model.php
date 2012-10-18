<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Email_template_model extends MY_Model
{ 
    
    
    public function __construct()
    {
        parent::__construct('email_templates', 'email_template_id');
        
        
        parent::add_extra_search_fields(array(
            
        ));
        
    }       
    
    
    
    public function callback_search(&$extra=array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }
        
        $search_fields = array_map('trim', explode(',', self::column_name('email_template_name,email_template_subject')));
        if(empty($search_fields))
        {
            return;
        }
        $count = count($search_fields);
        $sql = '(';
        foreach($search_fields as $key => $e)
        {
            $sql .= "$e LIKE '%".$this->db->escape_like_str($q)."%' ";
            if($count!=($key+1))
            {
                $sql .= 'OR ';
            }
        }
        $sql .= ')';

        $this->db->where($sql);        
    }
    
}
