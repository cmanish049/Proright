<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Zip_code_model extends MY_Model
{
    private $countries;
    private $states;
    private $cities;

    public function __construct()
    {
        parent::__construct('zip_codes', 'zip_code_id');

        $this->countries = self::table_name('COUNTRIES');
        $this->states = self::table_name('STATES');
        $this->cities = self::table_name('CITIES');

        parent::add_extra_search_fields(array(
            'state_name' => 'STATES.state_name',
            'city_name' => 'CITIES.city_name'
        ));
    }

    public function callback_join_countries($extra = array())
    {
        $this->join_select[] = "COUNTRIES.*";
        $this->db->join("$this->countries COUNTRIES", "$this->as.COUNTRY_ID=COUNTRIES.COUNTRY_ID", 'LEFT');
    }

    public function callback_join_states($extra = array())
    {
        $this->join_select[] = "STATES.*";
        $this->db->join("$this->states STATES", "$this->as.STATE_ID=STATES.STATE_ID", 'LEFT');
    }

    public function callback_join_cities($extra = array())
    {
        $this->join_select[] = "CITIES.*";
        $this->db->join("$this->cities CITIES", "$this->as.CITY_ID=CITIES.CITY_ID", 'LEFT');
    }

    public function callback_search(&$extra = array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }

        $search_fields = array_map('trim', explode(',', self::column_name('zip_code, area_code')));
        if(empty($search_fields))
        {
            return;
        }
        $count = count($search_fields);
        $sql = '(';
        foreach($search_fields as $key => $e)
        {
            $sql .= "$e LIKE '%" . $this->db->escape_like_str($q) . "%' ";
            if($count != ($key + 1))
            {
                $sql .= 'OR ';
            }
        }
        $sql .= ')';

        $this->db->where($sql);
    }

}
