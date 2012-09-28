<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sample_model extends MY_Model
{ 
    private $files = 'FILES';
    
    public function __construct()
    {
        parent::__construct('SAMPLE', 'COUNTRY_ID');
    }   
    
    protected function callback_join_image(&$extra)
    {
        $this->db->select("$this->files.FILE_NAME,$this->files.FILE_PATH, $this->files.ALTTEXT, $this->files.FILE_TITLE,$this->files.FILE_TYPE");
        $this->db->join($this->files, "$this->as.IMAGE_ID=$this->files.FILE_ID", 'LEFT');
    }
    
    public function callback_search(&$extra=array())
    {
        $q = trim(element('q', $extra));
        if(!$q)
        {
            return;
        }
        
        $search_fields = array_map('trim', explode(',', 'country_name'));
        if(empty($search_fields))
        {
            return;
        }
        $count = count($search_fields);
        $sql = '(';
        foreach($search_fields as $key => $e)
        {
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
