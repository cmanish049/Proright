<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends MY_Model
{
    private $event_categories;
    private $event_subjects;
    private $locations;
    private $event_priorities;
    private $status;
    private $matters;
    private $users;    

    public function __construct()
    {
        parent::__construct('events', 'event_id');

        $this->event_categories = self::table_name('EVENT_CATEGORIES');
        $this->event_subjects = self::table_name('EVENT_SUBJECTS');
        $this->locations = self::table_name('LOCATIONS');
        $this->event_priorities = self::table_name('EVENT_PRIORITIES');
        $this->status = self::table_name('STATUS');
        $this->matters = self::table_name('MATTERS');        
        $this->users = self::table_name('USERS');

        parent::add_extra_search_fields(array(
            'subject' => 'EVENT_SUBJECTS.subject',
            'location_name' => 'LOCATIONS.location_name',
            'matter_name' => 'MATTERS.matter_name',
            'client_name' => 'CLIENT.client_name',
            'inserter_name' => 'INSERTER.inserter_name'
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
    
    public function callback_join_event_categories($extra = array())
    {
        $this->join_select[] = "EVENT_CATEGORIES.*";
        $this->db->join("$this->event_categories EVENT_CATEGORIES", "$this->as.category_id=EVENT_CATEGORIES.category_id", 'LEFT');
    }

    public function callback_join_event_subjects($extra = array())
    {
        $this->join_select[] = "EVENT_SUBJECTS.*";
        $this->db->join("$this->event_subjects EVENT_SUBJECTS", "$this->as.SUBJECT_ID=EVENT_SUBJECTS.SUBJECT_ID", 'LEFT');
    }

    public function callback_join_locations($extra = array())
    {
        $this->join_select[] = "LOCATIONS.*";
        $this->db->join("$this->locations LOCATIONS", "$this->as.EVENT_LOCATION_ID=LOCATIONS.LOCATION_ID", 'LEFT');
    }

    public function callback_join_event_priorities($extra = array())
    {
        $this->join_select[] = "EVENT_PRIORITIES.*";
        $this->db->join("$this->event_priorities EVENT_PRIORITIES", "$this->as.PRIORITY_ID=EVENT_PRIORITIES.PRIORITY_ID", 'LEFT');
    }

    public function callback_join_event_status($extra = array())
    {
        $this->join_select[] = "EVENT_STATUS.status_name event_status_name";
        $this->db->join("$this->status EVENT_STATUS", "$this->as.EVENT_STATUS_ID=EVENT_STATUS.STATUS_ID", 'LEFT');
    }

    public function callback_join_matters($extra = array())
    {
        $this->join_select[] = "MATTERS.matter_name";
        $this->db->join("$this->matters MATTERS", "$this->as.matter_id=MATTERS.matter_id", 'LEFT');
    }

    public function callback_join_client($extra = array())
    {
        $this->join_select[] = "CLIENT.full_name client_name";
        $this->db->join("$this->users CLIENT", "$this->as.client_id=CLIENT.user_id", 'LEFT');
    }

    public function callback_join_inserter($extra = array())
    {
        $this->join_select[] = "INSERTER.full_name inserter_name";
        $this->db->join("$this->users INSERTER", "$this->as.inserter_id=INSERTER.user_id", 'LEFT');
    }

    public function callback_search(&$extra = array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }

        $search_fields = array_map('trim', explode(',', self::column_name('subject,matter_name,client_name')));
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
