<?php

/**
 * Humanize
 *
 * Takes multiple words separated by underscores and changes them to spaces
 *
 * @access	public
 * @param	string
 * @return	str
 */
if ( ! function_exists('humanize'))
{
	function humanize($str)
	{
		return mb_convert_case(preg_replace('/[_]+/', ' ', mb_strtolower(trim($str))), MB_CASE_TITLE);
	}
}

function strtolower_chars($str='')
{
    return mb_strtolower($str);
}