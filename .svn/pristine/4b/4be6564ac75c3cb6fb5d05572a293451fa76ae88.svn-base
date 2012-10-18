<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of akademisyen_model
 *
 * @author Alexander
 */
class User_model extends MY_Model
{
    private $countries = 'COUNTRIES';
    private $cities = 'CITIES';
    private $states = 'STATES';
    private $auth_user_groups = 'AUTH_USER_GROUPS';
    private $auth_ug_user_relationship = 'AUTH_UG_USER_RELATIONSHIP';
    private $user_types;
    private $zip_codes;

    public function __construct()
    {
        parent::__construct('USERS', 'USER_ID');

        $this->countries = parent::table_name($this->countries);
        $this->cities = parent::table_name($this->cities);
        $this->states = parent::table_name($this->states);
        $this->auth_user_groups = parent::table_name($this->auth_user_groups);
        $this->auth_ug_user_relationship = parent::table_name($this->auth_ug_user_relationship);
        $this->user_types = parent::table_name('user_types');
        $this->zip_codes = parent::table_name('zip_codes');
        
        parent::add_extra_search_fields(array(
            'city_name' => 'CITIES.city_name',
            'zip_code' => 'ZIP_CODES.zip_code'
        ));
    }

    public function add_to_extra_all_join_callbacks(&$extra)
    {
        $callbacks = array(
            'join_cities',
            'join_countries',
            'join_states',
            'join_user_types',
            'join_zip_codes'
        );
        foreach($callbacks as $e)
        {
            $extra['callback'][] = $e;
        }
    }

    protected function callback_join_user_types(&$extra)
    {
        $this->join_select[] = "USER_TYPES.USER_TYPE_ID, USER_TYPES.USER_TYPE_NAME";
        $this->db->join("$this->user_types USER_TYPES", "$this->as.USER_TYPE_ID=USER_TYPES.USER_TYPE_ID", 'LEFT');
    }
    
    protected function callback_join_cities(&$extra)
    {
        $this->join_select[] = "CITIES.CITY_NAME, CITIES.CITY_ID";
        $this->db->join("$this->cities CITIES", "$this->as.CITY_ID=CITIES.CITY_ID", 'LEFT');
    }

    protected function callback_join_states(&$extra)
    {
        $this->join_select[] = "STATES.STATE_NAME, STATES.STATE_ID";
        $this->db->join("$this->states STATES", "$this->as.STATE_ID=STATES.STATE_ID", 'LEFT');
    }

    protected function callback_join_countries(&$extra)
    {        
        $this->join_select[] = "COUNTRIES.COUNTRY_NAME, COUNTRIES.COUNTRY_ID";
        $this->db->join("$this->countries COUNTRIES", "$this->as.COUNTRY_ID=COUNTRIES.COUNTRY_ID", 'LEFT');
    }
    
    protected function callback_join_zip_codes(&$extra)
    {        
        $this->join_select[] = "ZIP_CODES.ZIP_CODE, ZIP_CODES.ZIP_CODE_ID";
        $this->db->join("$this->zip_codes ZIP_CODES", "$this->as.ZIP_CODE_ID=ZIP_CODES.ZIP_CODE_ID", 'LEFT');
    }

    protected function callback_join_auth_user_groups(&$extra)
    {
        $this->join_select = "$this->auth_user_groups.GROUP_NAME,$this->auth_user_groups.GROUP_ID";
        $this->db->join($this->auth_ug_user_relationship, "$this->as.USER_ID=$this->auth_ug_user_relationship.USER_ID", 'LEFT');
        $this->db->join($this->auth_user_groups, "$this->auth_ug_user_relationship.GROUP_ID=$this->auth_user_groups.GROUP_ID", 'LEFT');
    }

    public function insert($data = array())
    {
        if(!isset($data['INSERTER_ID']))
        {
            $data['INSERTER_ID'] = $this->auth->get_user_id();
        }
        if(!isset($data['INSERT_DATE']))
        {
            $data['INSERT_DATE'] = mysql_now();
        }

        return parent::insert($data);
    }

    public function update($id, $data = array(), $extra = array())
    {
        if(!isset($data['UPDATER_ID']))
        {
            $data['UPDATER_ID'] = $this->auth->get_user_id();
        }
        if(!isset($data['UPDATE_DATE']))
        {
            $data['UPDATE_DATE'] = mysql_now();
        }

        return parent::update($id, $data, $extra);
    }

    public function make_seo_string($seo, $id = '')
    {
        if(!$seo)
        {
            return '';
        }
        $id = clean_id($id);

        $where = array('USERNAME' => seo_url($seo), 'USERNAME !=' => $id);
        $_seo = seo_url($seo);
        $i = 0;
        while($this->get_count($where) > 0)
        {
            $i++;
            $where['USERNAME'] = $_seo . '-' . $i;
        }

        return $where['USERNAME'];
    }

}

