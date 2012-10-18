<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Matter_model extends MY_Model
{
    private $matter_types;
    private $users;
    private $courts;

    public function __construct()
    {
        parent::__construct('matters', 'matter_id');

        $this->matter_types = self::table_name('MATTER_TYPES');
        $this->users = self::table_name('USERS');
        $this->courts = self::table_name('COURTS');

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

    public function callback_join_matter_types($extra = array())
    {
        $this->join_select[] = "MATTER_TYPES.*";
        $this->db->join("$this->matter_types MATTER_TYPES", "$this->as.matter_type_id=MATTER_TYPES.matter_type_id", 'LEFT');
    }

    public function callback_join_attorney($extra = array())
    {
        $this->join_select[] = "ATTORNEY.full_name attorney_name";
        $this->db->join("$this->users ATTORNEY", "$this->as.attorney_id=ATTORNEY.user_id", 'LEFT');
    }

    public function callback_join_inserter($extra = array())
    {
        $this->join_select[] = "INSERTER.full_name inserter_name";
        $this->db->join("$this->users INSERTER", "$this->as.inserter_id=INSERTER.user_id", 'LEFT');
    }

    public function callback_join_courts($extra = array())
    {
        $this->join_select[] = "COURTS.*";
        $this->db->join("$this->courts COURTS", "$this->as.court_id=COURTS.court_id", 'LEFT');
    }

    public function callback_search(&$extra = array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }

        $search_fields = array_map('trim', explode(',', self::column_name('matter_name,case_number,court_case_number')));
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
