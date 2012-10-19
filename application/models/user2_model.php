<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User2_model extends MY_Model
{ 
    
    
    public function __construct()
    {
        parent::__construct('users', 'user_id');
        
        
        parent::add_extra_search_fields(array(
            
        ));
        
    }       
    
    public function insert($data = array())
    {
        if(!isset($data['inserter_id']))
        {
            $data['inserter_id'] = $this->auth->get_user_id();
        }
        if(!isset($data['insert_date']))
        {
            $data['insert_date'] = mysql_now();
        }
        
        return parent::insert($data);
    }
    
    public function update($id, $data = array())
    {
        if(!isset($data['updater_id']))
        {
            $data['updater_id'] = $this->auth->get_user_id();
        }
        if(!isset($data['update_date']))
        {
            $data['update_date'] = mysql_now();
        }
        
        return parent::update($id, $data);
    }
    
    public function update_where($where = array(), $data = array())
    {
        if(!isset($data['updater_id']))
        {
            $data['updater_id'] = $this->auth->get_user_id();
        }
        if(!isset($data['update_date']))
        {
            $data['update_date'] = mysql_now();
        }
        
        return parent::update_where($where, $data);
    }
    
    
    
    public function callback_search(&$extra=array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }
        
        $search_fields = array_map('trim', explode(',', self::column_name('')));
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
