<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
function time_since($time, $show_ago_string=TRUE ,$now = '')
{
    $now = time();

    if(!is_numeric($now))
    {
        $now = time();
    }

    $now_day = date("j", $now);
    $now_month = date("n", $now);
    $now_year = date("Y", $now);

    $time_day = date("j", $time);
    $time_month = date("n", $time);
    $time_year = date("Y", $time);
    $time_since = "";

    switch (TRUE)
    {
        case ($time == 0):
            $time_since = __('Never');
            break;
        case ($now - $time < 60):
            // RETURNS SECONDS
            $seconds = $now - $time;
            // Append "s" if plural
            $time_since = $seconds > 1 ? __("%s seconds", $seconds) : __("%s second", $seconds);
            break;
        case ($now - $time < 45 * 60): // twitter considers > 45 mins as about an hour, change to 60 for general purpose
            // RETURNS MINUTES
            $minutes = round(($now - $time) / 60);
            $time_since = $minutes > 1 ? __("%s minutes", $minutes) : __("%s minute", $minutes);
            break;
        case ($now - $time < 86400):
            // RETURNS HOURS
            $hours = round(($now - $time) / 3600);
            $time_since = $hours > 1 ? __("about %s hours", $hours) : __("about %s hour", $hours);
            break;
        case ($now - $time < 1209600):
            // RETURNS DAYS
            $days = round(($now - $time) / 86400);
            $time_since = __("%s days", $days);
            break;
        case (mktime(0, 0, 0, $now_month - 1, $now_day, $now_year) < mktime(0, 0, 0, $time_month, $time_day, $time_year)):
            // RETURNS WEEKS
            $weeks = round(($now - $time) / 604800);
            $time_since = __("%s weeks", $weeks);
            break;
        case (mktime(0, 0, 0, $now_month, $now_day, $now_year - 1) < mktime(0, 0, 0, $time_month, $time_day, $time_year)):
            // RETURNS MONTHS
            if($now_year == $time_year)
            {
                $subtract = 0;
            }
            else
            {
                $subtract = 12;
            }
            $months = round($now_month - $time_month + $subtract);
            $time_since = __("%s months", $months);
            break;
        default:
            // RETURNS YEARS
            if($now_month < $time_month)
            {
                $subtract = 1;
            }
            elseif($now_month == $time_month)
            {
                if($now_day < $time_day)
                {
                    $subtract = 1;
                }
                else
                {
                    $subtract = 0;
                }
            }
            else
            {
                $subtract = 0;
            }
            $years = $now_year - $time_year - $subtract;
            $time_since = __("%s years", $years);
            break;
    }
    
    if(!$show_ago_string)
    {
        return $time_since;
    }

    return __("%s ago", $time_since);
}

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
function get_date_string($date = '', $format = 'j F Y, l H:i', $use_timespan = FALSE)
{
    if($use_timespan === TRUE)
    {
        return time_since(strtotime($date));
        //return timespan(strtotime($date));
    }

    if(!$date || $date == '' || $date == '0000-00-00 00:00' || $date == '0000-00-00 00:00:00')
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

    $months = array('January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December');
    $months_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $days_short = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');

    $months_tr = array(__('January'), __('February'), __('March'), __('April'), __('May'), __('June'), 
        __('July'), __('August'), __('September'), __('October'), __('November'), __('December'));
    $months_tr_short = array(__('Jan'), __('Feb'), __('Mar'), __('Apr'), __('May'), __('Jun'), 
        __('Jul'), __('Aug'), __('Sep'), __('Oct'), __('Nov'), __('Dec'));

    $days_tr = array(__('Monday'), __('Tuesday'), __('Wednesday'), __('Thursday'), __('Friday'), __('Saturday'), __('Sunday'));
    $days_tr_short = array(__('Mon'), __('Tue'), __('Wed'), __('Thu'), __('Fri'), __('Sat'), __('Sun'));
    
    /*$months_tr = array(__('Ocak'), __('Şubat'), __('Mart'), __('Nisan'), __('Mayıs'), __('Haziran'), __('Temmuz'), __('Ağustos'), __('Eylül'), __('Ekim'), __('Kasım'), __('Aralık'));
    $months_tr_short = array(__('Oca'), __('Şub'), __('Mar'), __('Nis'), __('May'), __('Haz'), __('Tem'), __('Ağu'), __('Eyl'), __('Eki'), __('Kas'), __('Ara'));

    $days_tr = array(__('Pazartesi'), __('Salı'), __('Çarşamba'), __('Perşembe'), __('Cuma'), __('Cumartesi'), __('Pazar'));
    $days_tr_short = array(__('Pt'), __('Sa'), __('Ça'), __('Pe'), __('Cu'), __('Ct'), __('Pa'));*/

    if(strpos($format, 'M') !== FALSE) //Ayın kısaltılmış adı
    {
        $date_str = str_replace($months_short, $months_tr_short, $date_str);
    }
    if(strpos($format, 'D') !== FALSE) //Günün kısaltılmış
    {
        $date_str = str_replace($days_short, $days_tr_short, $date_str);
    }
    if(strpos($format, 'F') !== FALSE) //Ayın tam adı
    {
        $date_str = str_replace($months, $months_tr, $date_str);
    }
    if(strpos($format, 'l') !== FALSE) //Günün tam adı
    {
        $date_str = str_replace($days, $days_tr, $date_str);
    }

    return $date_str;
}

function mysql_now()
{
    return date("Y-m-d H:i:s");
}

function mysql_datetime($timestamp = '')
{
    if(!$timestamp)
    {
        return $timestamp;
    }
    return date("Y-m-d H:i:s", $timestamp);
}

function get_time_from_datetime($datetime = '', $format = 'H:i')
{
    if(!$datetime || $datetime == '0000-00-00 00:00' || $datetime == '0000-00-00 00:00:00')
    {
        return '';
    }

    return date($format, strtotime($datetime));
}

function get_date_from_datetime($datetime = '', $format = 'Y-m-d')
{
    if(!$datetime || $datetime == '0000-00-00 00:00' || $datetime == '0000-00-00 00:00:00')
    {
        return '';
    }

    return date($format, strtotime($datetime));
}