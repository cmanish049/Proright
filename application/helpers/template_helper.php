<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Javascript dosyalarını sayfaya yükler
 *
 * @param <type> $dosya
 */
function js($js, $is_minify = FALSE)
{
    $CI = & get_instance();

    $cikti = '';
    if(is_array($js))
    {
        foreach($js as $e)
        {
            $cikti .= $CI->template->_js('js/' . $e, $is_minify);
        }
    }
    else
    {
        $cikti = $CI->template->_js('js/' . $js, $is_minify);
    }

    return $cikti;
}

function css($css, $media = 'all', $is_minify = FALSE)
{
    $CI = & get_instance();

    $cikti = '';
    if(is_array($css))
    {
        foreach($css as $e)
        {
            $cikti .= $CI->template->_css('css/' . $e, $media, $is_minify);
        }
    }
    else
    {
        $cikti = $CI->template->_css('css/' . $css, $media, $is_minify);
    }
    return $cikti;
}

function load_fancybox($is_minify = FALSE)
{
    $CI = & get_instance();

    $CI->template->css('css/fancybox.css', $is_minify);
    $CI->template->js('js/fancybox.js', $is_minify);
}

function load_validation()
{
    $CI = & get_instance();

    $CI->template->css('css/validationEngine.jquery.css');
    $CI->template->js('js/languages/jquery.validationEngine-tr.js');
    $CI->template->js('js/jquery.validationEngine.js');
}

function load_jquery_ui()
{
    $CI = & get_instance();

    $CI->template->css('css/jquery-ui-1.8.15.custom.css');
    $CI->template->js('js/jquery-ui-1.8.15.custom.min.js');
}

function load_jquery_ui_timepicker()
{
    $CI = & get_instance();

    $CI->template->css('css/jquery-ui-timepicker.css');
    $CI->template->js('js/jquery-ui-timepicker.js');
}

function load_tinymce()
{
    $CI = & get_instance();
    $CI->template->js('js/tiny_mce/jquery.tinymce.js');
}

function load_sh_nedit()
{
    $CI = & get_instance();
    $CI->template->js('js/sh_main.min.js');
    $CI->template->script("sh_highlightDocument('" . config_item('themes_folder') . "/" . config_item('theme') . "/js/sh_lang/', '.min.js');");
}

function load_autocomplete()
{
    $CI = & get_instance();
    $CI->template->css('css/jquery.autocomplete.css');
    $CI->template->js('js/jquery.autocomplete.min.js');
}

function load_jquery_ingrid()
{
    $CI = & get_instance();

    $CI->template->css('css/ingrid.css');
    $CI->template->js('js/jquery.ingrid.js');
}

function load_superfish()
{
    $CI = & get_instance();

    $CI->template->css('css/superfish.css');
    $CI->template->js('js/superfish.js');
}

function load_colorPicker()
{
    $CI = & get_instance();    
    
    $CI->template->css('css/jquery.miniColors.css');
    $CI->template->js('js/jquery.miniColors.js');
}

function load_jqueryFileUpload()
{
    $CI = & get_instance();    
    
    $CI->template->css('css/jquery.fileupload.css');
    $CI->template->js('js/jquery.fileupload.js');
}
function load_jqueryCalendar()
{
    $CI = & get_instance();    
    
    $CI->template->css('css/fullcalendar.css');
    $CI->template->js('js/fullcalendar.js');
}

if(!function_exists('flash_data_alert_admin'))
{

    function flash_data_alert_admin()
    {
        $mesaj = '';

        $CI = & get_instance();
        if($CI->session->flashdata('warning'))
        {
            $mesaj .= alert_admin($CI->session->flashdata('warning'), 'warning');
        }

        if($CI->session->flashdata('success'))
        {
            $mesaj .= alert_admin($CI->session->flashdata('success'), 'success');
        }

        if($CI->session->flashdata('error'))
        {
            $mesaj .= alert_admin($CI->session->flashdata('error'), 'error');
        }

        return $mesaj;
    }

}

if(!function_exists('flash_data_alert'))
{

    function flash_data_alert()
    {
        $mesaj = '';

        $CI = & get_instance();
        if($CI->session->flashdata('warning'))
        {
            $mesaj .= alert($CI->session->flashdata('warning'), 'warning');
        }

        if($CI->session->flashdata('success'))
        {
            $mesaj .= alert($CI->session->flashdata('success'), 'success');
        }

        if($CI->session->flashdata('error'))
        {
            $mesaj .= alert($CI->session->flashdata('error'), 'error');
        }

        return $mesaj;
    }

}

if(!function_exists('form_alert_admin'))
{

    function form_alert_admin()
    {
        $CI = & get_instance();
        $CI = & get_instance();
        $theme = $CI->template->get_theme();

        if($theme == 'admin-bootstrap')
        {
            return validation_errors('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">×</a>', '</div>');
        }

        return validation_errors('<div class="message error"><span class="ico-error">', '</span></div>');
    }

}

if(!function_exists('form_alert'))
{

    function form_alert()
    {
        return validation_errors('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">×</a>', '</div>');
    }

}

function alert_admin($message, $warning_type = 'warning')
{
    if(!$message) return '';
    $CI = & get_instance();
    $theme = $CI->template->get_theme();

    if($theme == 'admin-bootstrap')
    {
        if($warning_type == 'warning')
        {
            $output = '<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
        }
        elseif($warning_type == 'success')
        {
            $output = '<div class="alert alert-success fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
        }
        elseif($warning_type == 'error')
        {
            $output = '<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
        }
        else
        {
            $output = '<div class="alert alert-info fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
        }
    }
    else
    {
        if($warning_type == 'warning')
        {
            $output = '<div class="message warning"><span class="ico-warning">' . $message . '</span></div>';
        }
        elseif($warning_type == 'success')
        {
            $output = '<div class="message success"><span class="ico-success">' . $message . '</span></div>';
        }
        elseif($warning_type == 'error')
        {
            $output = '<div class="message error"><span class="ico-error">' . $message . '</span></div>';
        }
    }

    return $output;
}

function alert($message = '', $warning_type = 'warning')
{
    if(!$message) return '';

    if($warning_type == 'warning')
    {
        $output = '<div class="alert fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
    }
    elseif($warning_type == 'success')
    {
        $output = '<div class="alert alert-success fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
    }
    elseif($warning_type == 'error')
    {
        $output = '<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
    }
    else
    {
        $output = '<div class="alert alert-info fade in"><a class="close" data-dismiss="alert">×</a>' . $message . '</div>';
    }
    return $output;
}

