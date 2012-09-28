<?php
if(!defined('BASEPATH')) exit('No direct access allowed.');

/**
 * Description of MY_Config
 *
 * @author Alexander
 */
class MY_Config extends CI_Config
{
    public function __construct()
    {
        parent::__construct();
    }

    public function set_options()
    {
        $CI = &get_instance();
        $extra = array(
            'AUTOLOAD' => 'yes'
        );
        add_language_param($extra);
        $options = $CI->option_model->get_rows($extra);

        $config_options = array();
        foreach($options as $e)
        {
            $config_options[$e->option_name] = $e->option_value;
        }
        
        $theme = element('theme', $config_options);
        $app_theme_directory = trim_slashes(APPPATH) . '/views/' . $theme;
        $theme_directory = config_item('themes_folder') . '/' . $theme;
        if(!$theme || !is_dir($app_theme_directory) || !is_dir($theme_directory))
        {
            unset($config_options['theme']);
        }
        
        foreach($config_options as $key => $e)
        {            
            $this->set_item($key, $e);
        }

        $this->set_item('website_title_add', ' - ' . config_item('project_name'));
    }

    public function set_theme_options()
    {
        $CI = &get_instance();
    }

    public function set_languages()
    {
        $CI = &get_instance();

        $_languages = $CI->language_model->get_rows(array(
            'ACTIVE' => 'yes'
                ));

        $languages = array();
        foreach($_languages as $e)
        {
            $languages[$e->language] = (array) $e;
        }

        $this->set_item('languages', $languages);
    }

    public function set_user_permissions()
    {
        $CI = & get_instance();

        $user_premissions = $CI->auth->get_user_permissions();
        $this->set_item('user_permissions', $user_premissions);
    }

    public function set_modules()
    {
        $CI = & get_instance();

        $modules = $CI->auth_module_model->get_rows(array(
            'ACTIVE' => 'yes'
        ));
        if(empty($modules))
        {
            return;
        }

        $array = array();
        foreach($modules as $e)
        {
            $array[$e->module_code] = array(
                'module_code' => $e->module_code,
                'module_name' => $e->module_name,
                'module_single_label' => $e->module_single_label,
                'module_plural_label' => $e->module_plural_label
            );
        }

        $this->set_item('modules', $array);
    }

    function site_url($uri = '')
    {
        if(is_array($uri))
        {
            $uri = implode('/', $uri);
        }

        if(function_exists('get_instance'))
        {
            if(class_exists('CI_Controller'))
            {
                $uri = get_instance()->lang->localized($uri);
            }
        }

        if($uri == '')
        {
            return $this->slash_item('base_url') . $this->item('index_page');
        }

        if($this->item('enable_query_strings') == FALSE)
        {
            if(is_array($uri))
            {
                $uri = implode('/', $uri);
            }

            $index = $this->item('index_page') == '' ? '' : $this->slash_item('index_page');
            $suffix = ($this->item('url_suffix') == FALSE) ? '' : $this->item('url_suffix');
            return $this->slash_item('base_url') . $index . trim($uri, '/') . $suffix;
        }
        else
        {
            if(is_array($uri))
            {
                $i = 0;
                $str = '';
                foreach($uri as $key => $val)
                {
                    $prefix = ($i == 0) ? '' : '&';
                    $str .= $prefix . $key . '=' . $val;
                    $i++;
                }

                $uri = $str;
            }

            return $this->slash_item('base_url') . $this->item('index_page') . '?' . $uri;
        }
    }

}

