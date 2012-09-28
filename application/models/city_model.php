<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class City_model extends MY_Model
{ 
    private $countries = 'countries';
    private $states = 'states';    
    
    
    public function __construct()
    {
        parent::__construct('cities', 'city_id');
        
        parent::add_extra_search_fields(array(
            'country_name' => 'COUNTRIES.country_name'
        ));
    }
    
    public function callback_join_countries($extra=array())
    {
        $this->join_select[] = "COUNTRIES.*";
        $this->db->join(self::column_name($this->countries) . " COUNTRIES","$this->as.COUNTRY_ID=COUNTRIES.COUNTRY_ID", 'LEFT');
    }
    
    public function callback_join_states($extra=array())
    {
        $this->join_select[] = "STATES.*";
        $this->db->join(self::column_name($this->states) . " STATES","$this->as.STATE_ID=STATES.STATE_ID", 'LEFT');
    }

    public function callback_search(&$extra=array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }
        
        $search_fields = array_map('trim', explode(',', 'city_name'));
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
