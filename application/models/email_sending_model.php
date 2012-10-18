<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Email_sending_model extends MY_Model
{
    private $matters;
    private $users;
    private $email_templates;

    public function __construct()
    {
        parent::__construct('email_sendings', 'email_id');

        $this->matters = self::table_name('MATTERS');
        $this->users = self::table_name('USERS');
        $this->email_templates = self::table_name('EMAIL_TEMPLATES');

        parent::add_extra_search_fields(array(
            'matter_name' => 'MATTERS.matter_name',
            'receiver_name' => 'RECEIVER.full_name',
            'inserter_name' => 'INSERTER.full_name'
        ));
    }

    public function callback_join_matters($extra = array())
    {
        $this->join_select[] = "MATTERS.matter_name";
        $this->db->join("$this->matters MATTERS", "$this->as.matter_id=MATTERS.matter_id", 'LEFT');
    }

    public function callback_join_receiver($extra = array())
    {
        $this->join_select[] = "RECEIVER.full_name receiver_name";
        $this->db->join("$this->users RECEIVER", "$this->as.receiver_id=RECEIVER.user_id", 'LEFT');
    }

    public function callback_join_email_templates($extra = array())
    {
        $this->join_select[] = "EMAIL_TEMPLATES.*";
        $this->db->join("$this->email_templates EMAIL_TEMPLATES", "$this->as.email_template_id=EMAIL_TEMPLATES.email_template_id", 'LEFT');
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

        $search_fields = array_map('trim', explode(',', self::column_name('email_to,email_subject,email_body')));
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
