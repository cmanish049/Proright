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
            'zip_code' => 'ZIP_CODES.zip_code',
            'birth_city_name' => 'BIRTH_CITY.city_name',
            'birth_state_name' => 'BIRTH_STATE.state_name'
        ));
    }

    public function add_to_extra_all_join_callbacks(&$extra)
    {
        $callbacks = array(
            'join_attorney',
            'join_user_types',
            'join_inserter',                    
            'join_cities',
            'join_birth_city',
            'join_countries',
            'join_birth_country',
            'join_passport_country',
            'join_states',
            'join_birth_state',
            'join_zip_codes'
        );
        foreach($callbacks as $e)
        {
            $extra['callback'][] = $e;
        }
    }

    public function callback_join_attorney($extra = array())
    {
        $this->join_select[] = "ATTORNEY.full_name attorney_name";
        $this->db->join("$this->table ATTORNEY", "$this->as.attorney_id=ATTORNEY.user_id", 'LEFT');
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
    
    protected function callback_join_birth_city(&$extra)
    {
        $this->join_select[] = "BIRTH_CITY.CITY_NAME birth_city_name, BIRTH_CITY.CITY_ID birth_city_id";
        $this->db->join("$this->cities BIRTH_CITY", "$this->as.BIRTH_CITY_ID=BIRTH_CITY.CITY_ID", 'LEFT');
    }

    protected function callback_join_states(&$extra)
    {
        $this->join_select[] = "STATES.STATE_NAME, STATES.STATE_ID";
        $this->db->join("$this->states STATES", "$this->as.STATE_ID=STATES.STATE_ID", 'LEFT');
    }
    
    protected function callback_join_birth_state(&$extra)
    {
        $this->join_select[] = "BIRTH_STATE.STATE_NAME birth_state_name, BIRTH_STATE.STATE_ID birth_state_id";
        $this->db->join("$this->states BIRTH_STATE", "$this->as.BIRTH_STATE_ID=BIRTH_STATE.STATE_ID", 'LEFT');
    }

    protected function callback_join_countries(&$extra)
    {        
        $this->join_select[] = "COUNTRIES.COUNTRY_NAME, COUNTRIES.COUNTRY_ID";
        $this->db->join("$this->countries COUNTRIES", "$this->as.COUNTRY_ID=COUNTRIES.COUNTRY_ID", 'LEFT');
    }
    
    protected function callback_join_birth_country(&$extra)
    {        
        $this->join_select[] = "BIRTH_COUNTRY.COUNTRY_NAME birth_country_name, BIRTH_COUNTRY.COUNTRY_ID birth_country_id";
        $this->db->join("$this->countries BIRTH_COUNTRY", "$this->as.BIRTH_COUNTRY_ID=BIRTH_COUNTRY.COUNTRY_ID", 'LEFT');
    }
    
    protected function callback_join_passport_country(&$extra)
    {        
        $this->join_select[] = "PASSPORT_COUNTRY.COUNTRY_NAME passport_country_name, PASSPORT_COUNTRY.COUNTRY_ID passport_country_id";
        $this->db->join("$this->countries PASSPORT_COUNTRY", "$this->as.PASSPORT_COUNTRY_ID=PASSPORT_COUNTRY.COUNTRY_ID", 'LEFT');
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

    public function callback_join_inserter($extra = array())
    {
        $this->join_select[] = "INSERTER.full_name inserter_name";
        $this->db->join("$this->table INSERTER", "$this->as.inserter_id=INSERTER.user_id", 'LEFT');
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

     public function update_where($where = array(), $data = array())
    {
        if(!isset($data['UPDATER_ID']))
        {
            $data['UPDATER_ID'] = $this->auth->get_user_id();
        }
        if(!isset($data['UPDATE_DATE']))
        {
            $data['UPDATE_DATE'] = mysql_now();
        }
        
        return parent::update_where($where, $data);
    }
    
    public function callback_search(&$extra = array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }

        $search_fields = array_map('trim', explode(',', self::column_name('username,full_name')));
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

