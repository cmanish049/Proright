<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_DB_mysql_driver
 *
 * DB extension class to give various parsing
 * methods.  Generally speaking, these are
 * standard methods for converting a DB query
 * into an array/result.
 *
 * @author Simon Emms <simon@simonemms.com>
 */
class MY_DB_mysql_driver extends CI_DB_mysql_driver
{
    final public function __construct($params)
    {
        parent::__construct($params);
        log_message('debug', 'Extended DB driver class instantiated!');
    }

    // --------------------------------------------------------------------
    /**
     * Join
     *
     * Generates the JOIN portion of the query
     *
     * @param	string
     * @param	string	the join condition
     * @param	string	the type of join
     * @return	object
     */
    public function join($table, $cond, $type = '', $escape_cond = TRUE)
    {
        if($type != '')
        {
            $type = strtoupper(trim($type));

            if(!in_array($type, array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER')))
            {
                $type = '';
            }
            else
            {
                $type .= ' ';
            }
        }

        // Extract any aliases that might exist.  We use this information
        // in the _protect_identifiers to know whether to add a table prefix
        $this->_track_aliases($table);

        if($escape_cond)
        {
            // Strip apart the condition and protect the identifiers
            if(preg_match('/([\w\.]+)([\W\s]+)(.+)/', $cond, $match))
            {
                $match[1] = $this->_protect_identifiers($match[1]);
                $match[3] = $this->_protect_identifiers($match[3]);

                $cond = $match[1] . $match[2] . $match[3];
            }
        }

        // Assemble the JOIN statement
        $join = $type . 'JOIN ' . $this->_protect_identifiers($table, TRUE, NULL, FALSE) . ' ON ' . $cond;

        $this->ar_join[] = $join;
        if($this->ar_caching === TRUE)
        {
            $this->ar_cache_join[] = $join;
            $this->ar_cache_exists[] = 'join';
        }

        return $this;
    }

}