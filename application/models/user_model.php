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
    private $schools = 'SCHOOLS';
    private $auth_user_groups = 'AUTH_USER_GROUPS';
    private $auth_ug_user_relationship = 'AUTH_UG_USER_RELATIONSHIP';
    private $files = 'FILES';

    public function __construct()
    {
        parent::__construct('USERS', 'USER_ID');
    }   
        
    protected function callback_join_city(&$extra)
    {
        $this->db->select("$this->cities.CITY_NAME,$this->cities.CITY_SEO, $this->cities.CITY_ID");
        $this->db->join($this->cities, "$this->as.CITY_ID=$this->cities.CITY_ID", 'LEFT');
    }
    
    protected function callback_join_country(&$extra)
    {
        $this->db->select("$this->countries.COUNTRY_ADI, $this->countries.COUNTRY_ID");
        $this->db->join($this->countries, "$this->as.COUNTRY_ID=$this->countries.COUNTRY_ID", 'LEFT');
    }
    
    protected function callback_join_job(&$extra)
    {
        
    }

    protected function callback_join_auth_user_groups(&$extra)
    {
        $this->db->select("$this->auth_user_groups.GROUP_NAME,$this->auth_user_groups.GROUP_ID");
        $this->db->join($this->auth_ug_user_relationship, "$this->as.USER_ID=$this->auth_ug_user_relationship.USER_ID", 'LEFT');
        $this->db->join($this->auth_user_groups, "$this->auth_ug_user_relationship.GROUP_ID=$this->auth_user_groups.GROUP_ID", 'LEFT');
    }

    public function callback_join_image(&$extra)
    {
        $this->db->select("$this->files.FILE_NAME,$this->files.FILE_PATH, $this->files.ALTTEXT, $this->files.FILE_TITLE,$this->files.FILE_TYPE");
        $this->db->join($this->files, "$this->as.IMAGE_ID=$this->files.FILE_ID", 'LEFT');
    }

    protected function callback_ara(&$extra)
    {
        if(element('kelime', $extra))
        {
            $sql = "MATCH(adi,soyadi,email,kullanici_adi) AGAINST ('" . $this->db->escape_like_str($extra['kelime']) . "*' IN BOOLEAN MODE)";
            $this->db->where($sql);
        }
    }

    protected function _extra($extra = array())
    {
        parent::_extra($extra);
    }

    public function insert($data = array())
    {
        $data['INSERT_DATE'] = mysql_now();
        return parent::insert($data);
    }

    public function update($id, $data = array(), $extra = array())
    {
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

