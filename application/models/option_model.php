<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of ayar_model
 *
 * @author Alexander
 */
class Option_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct('options', 'option_id');
    }

    public function get_option($option_name = '', $extra = array())
    {
        if(is_array($option_name))
        {
            $first_option = $option_name[0];
            array_shift($option_name);

            foreach($option_name as $e)
            {
                $join_where = '';
                if(config_item('is_multiple_language_active'))
                {
                    $join_where = " AND $e.LANGUAGE_ID=" .config_item('LANGUAGE_ID');
                }
                
                $this->db->select("$e.OPTION_VALUE $e");
                $this->db->join("$this->table $e", "$e.OPTION_NAME=" . $this->db->escape($e) . $join_where, 'LEFT', FALSE);               
            }

            $_extra = array(
                'OPTION_NAME' => $first_option,
                'select' => FALSE
            );
            add_language_param($_extra);
            $_extra = array_merge($_extra, $extra);

            $this->db->select("$this->as.OPTION_VALUE $first_option");
            return parent::get_row_where($_extra);
        }

        $_extra = array(
            'OPTION_NAME' => $option_name,
            'select' => 'OPTION_VALUE'
        );
        add_language_param($_extra);
        $_extra = array_merge($_extra, $extra);

        return parent::get_row_where($_extra);
    }

    public function insert($data = array())
    {
        $option = parent::get_row_where(array(
                    'OPTION_NAME' => $data['OPTION_NAME']
                ));

        if(!empty($option))
        {
            parent::update($option->option_id, $data);
            return $option->option_id;
        }
        else
        {
            return parent::insert($data);
        }
    }

}
