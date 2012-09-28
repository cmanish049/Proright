<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class State_model extends MY_Model
{     
    private $countries; 
    
    public function __construct()
    {
        parent::__construct('states', 'state_id');
        
        $this->countries = self::column_name('countries');
    }   
    
    public function callback_join_countries($extra=array())
    {
        $this->join_select[] = "COUNTRIES.*";
        $this->db->join($this->countries . " COUNTRIES","$this->as.COUNTRY_ID=COUNTRIES.COUNTRY_ID", 'LEFT');
    }
    
    public function callback_search(&$extra=array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }
        
        $search_fields = array_map('trim', explode(',', 'state_name'));
        if(empty($search_fields))
        {
            return;
        }
        $count = count($search_fields);
        $sql = '(';
        foreach($search_fields as $key => $e)
        {
            $e = parent::column_name($e);
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
