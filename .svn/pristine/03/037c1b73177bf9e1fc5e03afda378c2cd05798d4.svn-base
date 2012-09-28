<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * m = 03
 * l = cuma
 * M = Mar
 * 
 * $format = 'j M Y, D H:i';//
 * 
 * @param type $date
 * @param strıng $format
 * @return strıng 
 */
function get_date_string($date = '', $format='j F Y, l H:i')
{
    if(!$date || $date == '' || $date=='0000-00-00 00:00' || $date=='0000-00-00 00:00:00')
    {
        return '';
    }
    else
    {
        $date = strtotime($date);
    }

    /*
      date_default_timezone_set('Europe/Istanbul');
      @setlocale(LC_ALL, 'turkish');
      $tarih_str = strftime('%d %B %Y, %A %H:%M', strtotime($tarih));
     */
    $date_str = date($format, $date);

    if(config_item('is_multiple_language_active') && config_item('language')=='en')
    {
        return $date_str;
    }
    
    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $months_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    
    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $days_short = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    
    $months_tr = array(__('Ocak'), __('Şubat'), __('Mart'), __('Nisan'), __('Mayıs'), __('Haziran'), __('Temmuz'), __('Ağustos'), __('Eylül'), __('Ekim'), __('Kasım'), __('Aralık'));
    $months_tr_short = array(__('Oca'), __('Şub'), __('Mar'), __('Nis'), __('May'), __('Haz'), __('Tem'), __('Ağu'), __('Eyl'), __('Eki'), __('Kas'), __('Ara'));
    
    $days_tr = array(__('Pazartesi'), __('Salı'), __('Çarşamba'), __('Perşembe'), __('Cuma'), __('Cumartesi'), __('Pazar'));
    $days_tr_short = array(__('Pt'), __('Sa'), __('Ça'), __('Pe'), __('Cu'), __('Ct'), __('Pa'));

    if(strpos($format, 'M')!==FALSE) //Ayın kısaltılmış adı
    {
        $date_str = str_replace($months_short, $months_tr_short, $date_str);
    }
    if(strpos($format, 'D')!==FALSE) //Günün kısaltılmış
    {
        $date_str = str_replace($days_short, $days_tr_short, $date_str);
    }
    if(strpos($format, 'F')!==FALSE) //Ayın tam adı
    {
        $date_str = str_replace($months, $months_tr, $date_str);
    }
    if(strpos($format, 'l')!==FALSE) //Günün tam adı
    {
        $date_str = str_replace($days, $days_tr, $date_str);
    }

    return $date_str;
}

function mysql_now()
{
    return date("Y-m-d H:i:s");
}

function mysql_datetime($timestamp='')
{
    if(!$timestamp)
    {
        return $timestamp;
    }
    return date("Y-m-d H:i:s", $timestamp);
}

function get_time_from_datetime($datetime='', $format='H:i')
{
    if(!$datetime || $datetime=='0000-00-00 00:00' || $datetime=='0000-00-00 00:00:00')
    {
        return '';
    }
    
    return date($format, strtotime($datetime));
}

function get_date_from_datetime($datetime='', $format='Y-m-d')
{
    if(!$datetime || $datetime=='0000-00-00 00:00' || $datetime=='0000-00-00 00:00:00')
    {
        return '';
    }
    
    return date($format, strtotime($datetime));
}