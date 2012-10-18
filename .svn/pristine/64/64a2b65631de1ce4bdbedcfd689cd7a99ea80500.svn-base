<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Matter_note_model extends MY_Model
{
    private $matter_note_types;
    private $matters;
    private $users;

    public function __construct()
    {
        parent::__construct('matter_notes', 'note_id');

        $this->matter_note_types = self::table_name('MATTER_NOTE_TYPES');
        $this->matters = self::table_name('MATTERS');
        $this->users = self::table_name('USERS');

        parent::add_extra_search_fields(array(
            'matter_name' => 'MATTERS.matter_name',
            'client_name' => 'CLIENT.full_name',
            'inserter_name' => 'INSERTER.full_name'
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

    public function callback_join_matter_note_types($extra = array())
    {
        $this->join_select[] = "MATTER_NOTE_TYPES.*";
        $this->db->join("$this->matter_note_types MATTER_NOTE_TYPES", "$this->as.note_type_id=MATTER_NOTE_TYPES.note_type_id", 'LEFT');
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
   
    public function callback_join_operator($extra = array())
    {
        $this->join_select[] = "OPERATOR.full_name operator_name";
        $this->db->join("$this->users OPERATOR", "$this->as.operator_id=OPERATOR.user_id", 'LEFT');
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

        $search_fields = array_map('trim', explode(',', self::column_name('matter_note')));
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
