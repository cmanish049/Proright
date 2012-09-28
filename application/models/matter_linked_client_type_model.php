<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Matter_linked_client_type_model extends MY_Model
{ 
    
    
    public function __construct()
    {
        parent::__construct('matter_linked_client_types', 'linked_type_id');
        
        
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
        
        $search_fields = array_map('trim', explode(',', self::column_name('linked_type_name')));
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
