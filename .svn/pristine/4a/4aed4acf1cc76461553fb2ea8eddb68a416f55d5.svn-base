<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function is_ajax()
{
    $CI=&get_instance();
    
    return $CI->input->is_ajax_request();
}

function query_string($add = '', $remove = '', $include_current = TRUE, $include_question_mark=TRUE)
{
	$_ci =& get_instance();
	
	// set initial query string
	$query_string = array();
	if ($include_current && $_ci->input->get() !== FALSE)
	{
		$query_string = $_ci->input->get();
	}
	
	// add to query string
	if ($add != '')
	{
		// convert to array
		if (is_string($add))
		{
			$add = array($add);
		}
		$query_string = array_merge($query_string, $add);
	}
	
	// remove from query string
	if ($remove != '')
	{
		// convert to array
		if (is_string($remove))
		{
			$remove = array($remove);
		}
		
		// remove from query_string
		foreach ($remove as $rm)
		{
			$key = array_search($rm, $query_string);
			if ($key !== FALSE)
			{
				unset($query_string[$key]);
			}
		}
	}
	
	// return result
	$return = '';
	if (count($query_string) > 0)
	{
		if($include_question_mark)
		{$return='?';}
		$return .= http_build_query($query_string);
	}
	return $return;
}


// --------------------------------------------------------------------------

/**
 * uri_query_string function.
 *
 * returns uri_string with query_string on the end.
 * 
 * @param mixed $add (default: '')
 * @param mixed $remove (default: '')
 * @param bool $include_current (default: TRUE) Whether to include the 
 * current page's query string or start fresh.
 * @return string
 */
function uri_query_string($add = '', $remove = '', $include_current = TRUE)
{
	$_ci =& get_instance();
	return $_ci->uri->uri_string() . query_string($add, $remove, $include_current);
}

if(!function_exists('site_url'))
{
    function site_url($uri = '')
    {
        $CI = & get_instance();
        return $CI->config->site_url($uri);
    }

}

if(!function_exists('seo_url'))
{

    function seo_url($str)
    {
        if(!function_exists('clean_turkish_characters')) $this->load->helper('string');

        $str = character_limiter($str, 80, '');
        return url_title(clean_turkish_characters($str), 'dash', TRUE);
    }

}

if(!function_exists('admin_url'))
{

    function admin_url($url_string = '')
    {
        if(!$url_string)
        {
            return site_url(config_item('admin_directory'));
        }

        return site_url(config_item('admin_directory') . '/' . $url_string);
    }

}



/**
 * options
 *  -base_url
 *  -total_rows
 *  -per_page
 *  -uri_segment
 *  -num_links
 *  -page_query_string
 *  -use_page_numbers
 *  -display_pages
 *  -query_string_segment
 *  -uri_string
 *
 * @param type $options
 * @return type
 */
function create_pagination($total_rows, $per_page, $uri_string = '', $num_links = 5, $options = array())
{
	$total_rows = clean_id($total_rows);
	$per_page = clean_id($per_page);

	$options['total_rows'] = $total_rows;
	$options['per_page'] = $per_page;
	$options['num_links'] = $num_links;

	$CI = & get_instance();
	$start = clean_id($CI->input->get('start', TRUE));

	if($start > 0)
	{
		$page = ceil($start / $per_page) + 1;
		$CI->template->title($page . '. ' . __('string_page'), FALSE);
	}

	//$uri_string = $CI->uri->assoc_to_uri($uri_assoc);
	$uri = site_url($uri_string);

	$query_string = query_string('', array('start'));
	$options['base_url'] = $uri . (($query_string == '') ? '?' : $query_string);

	$config = array(
			'num_links' => $num_links,
			'page_query_string' => TRUE,
			'use_page_numbers' => FALSE,
			'display_pages' => TRUE,
			'query_string_segment' => 'start'
	);
	$config['full_tag_open'] = '<ul>';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = __('string_first_page');
	$config['first_link'] = '«';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['last_link'] = __('string_last_page');
	$config['last_link'] = '»';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['next_link'] = __('string_next_page');
	$config['next_link'] = '→';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['prev_link'] = __('string_previous_page');
	$config['prev_link'] = '←';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config = array_merge($config, $options);

	$CI->load->library('pagination');
	$CI->pagination->initialize($config);
	unset($config);

	return $CI->pagination->create_links();
}
