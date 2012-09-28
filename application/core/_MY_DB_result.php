<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_DB_result
 *
 * @author Alexander
 */
class MY_DB_result extends CI_DB_result
{
    /**
	 * Query result.  "object" version.
	 *
	 * @access	public
	 * @return	object
	 */
	public function result_object()
	{
		if (count($this->result_object) > 0)
		{
			return $this->result_object;
		}

		// In the event that query caching is on the result_id variable
		// will return FALSE since there isn't a valid SQL resource so
		// we'll simply return an empty array.
		if ($this->result_id === FALSE OR $this->num_rows() == 0)
		{
			return array();
		}

		$this->_data_seek(0);
		while ($row = $this->_fetch_object())
		{
			$this->result_object[] = $row;
		}
        
        $result = array();
        foreach ($this->result_object as $value) {
            $row = new stdClass();
            
            foreach($value as $key => $e)
            {
                $key = strtolower($key);
                $row->$key = $e;
            }
            $result[] = $row;            
        }
        $this->result_object = $result;

		return $this->result_object;
	}

}
