<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function character_limiter($str, $n = 500, $show_word=FALSE, $end_char = '&#8230;')
	{
		if (strlen($str) < $n)
		{
			return $str;
		}

		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n)
		{
			return $str;
		}

        /*if(!$show_word)
        {
            return trim(substr(trim($str), 0, $n)).$end_char;
        }*/

		$out = "";
        $array = explode(' ', trim($str));
		foreach ($array as $val)
		{
            $next_length = strlen($out.$val);
            if($next_length>=$n)
            {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
            }

			$out .= $val.' ';
		}
	}