<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class {model_class_name} extends MY_Model
{ 
    {vars}
    
    public function __construct()
    {
        parent::__construct('{table_name}', '{primary_key}');
        {vars_set_values}
        
        parent::add_extra_search_fields(array(
            {add_search_fields}
        ));
        
    }       
    
    {join_callbacks}
    
    public function callback_search(&$extra=array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }
        
        $search_fields = array_map('trim', explode(',', self::column_name('{search_fields}')));
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
