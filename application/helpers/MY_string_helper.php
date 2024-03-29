<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function exceptions_error_handler($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

function use_try_catch()
{
    set_error_handler('exceptions_error_handler');
}

function parse_json($array=array())
{
    $CI =& get_instance();
    return $CI->fastjson->encode($array);
}

function esc_title($title)
{
    return encode_html(strip_tags($title));
}

function str_to_upper($str)
{
    return  mb_strtoupper($str);
}

function decode_html($html='')
{
    return html_entity_decode($html, ENT_QUOTES, 'UTF-8');
}

function encode_html_by_dom($string='',$selector='pre,code')
{
    $CI = & get_instance();

    $CI->load->library('simple_html_dom');
    $dom = $CI->simple_html_dom;
    $dom->load($string);

    $pars = $dom->find($selector);
    $_arr = array();
    foreach($pars as $e)
    {
        $html = decode_html($e->innertext);
        $esc = encode_html($html);
        $e->innertext = $esc;
        if($e->tag=='code')
        {
            $e->tag = 'pre';
        }
    }
    return $dom->outertext;
}

function remove_empty_paragraph($string='')
{
    $CI = & get_instance();

    $CI->load->library('simple_html_dom');
    $dom = $CI->simple_html_dom;
    $dom->load($string);

    $pars = $dom->find('p');
    $_arr = array();
    foreach($pars as $e)
    {
        $innertext = trim($e->innertext);
        if($innertext=='' || $innertext=='&nbsp;')
        {
            $e->outertext = '';
        }
    }
    return $dom->outertext;
}

/**
 * Türkçe karakterleri temizler
 *
 * @param String
 * @return String
 */
if(!function_exists('clean_turkish_characters'))
{

    function clean_turkish_characters($str)
    {
        $_trSpec = array(
            'c' => 'ç',
            'g' => 'ğ',
            'i' => 'ı',
            'o' => 'ö',
            's' => 'ş',
            'u' => 'ü',
            'C' => 'Ç',
            'G' => 'Ğ',
            'I' => 'İ',
            'O' => 'Ö',
            'S' => 'Ş',
            'U' => 'Ü'
        );

        $enChars = array_keys($_trSpec);
        $trChars = array_values($_trSpec);

        return str_replace($trChars, $enChars, $str);
    }

}

function clean_id($id)
{
    if(!is_array($id))
    {
        $id = intval($id);
    }
    else
    {
        foreach($id as $index => $deger)
        {
            $id[$index] = intval($deger);
            if(is_null($id[$index]) || !$id[$index])
            {
                unset($id[$index]);
            }
        }
    }

    return $id ? $id : '0';
}

function br_to_n($string)
{
    return preg_replace('#<br\s*/?>#', "\n", $string);
}

function nl2br_pre($string)
{
    if(!strpos($string, "<pre"))
    {
        return nl2br($string);
    }

    $strArr = explode("\n", $string);
    $output = "";
    $preFound = false;

    foreach($strArr as $line)
    {
        if(strpos($line, 'pre class="sh') || strpos($line, "<pre>") || strpos($line, "code"))
        {
            $preFound = false;
        }
        elseif(strpos($line, "</pre>") | strpos($line, "</code>"))
        {
            $preFound = false;
            $output .= $line . "\n";
            continue;
        }

        if($preFound)
        {
            $output .= $line . "\n";
        }
        else
        {
            $output .= $line . "<br />";
        }
    }
    return $output;
}

function encode_pre_code_html_by_regex($content='')
{
    if(!$content) return $content;

    $esc_pre = preg_replace_callback(
            '#(<pre.*?>)(.*?)(</pre>)#imsu', create_function(
                    '$i', 'return $i[1].encode_html($i[2]).$i[3];'
            ), $content
    );

    return preg_replace_callback(
                    '#(<code.*?>)(.*?)(</code>)#imsu', create_function(
                            '$i', 'return $i[1].encode_html($i[2]).$i[3];'
                    ), $esc_pre
    );
}

if(!function_exists('encode_html'))
{

    function encode_html($html, $char_set = 'UTF-8')
    {
        if(empty($html))
        {
            return '';
        }

        $html = (string) $html;
        $html = htmlspecialchars($html, ENT_QUOTES, $char_set);

        return $html;
    }

}

function strip_html_tags($text)
{
    $text = preg_replace(
            array(
        // Remove invisible content
        '@<head[^>]*?>.*?</head>@siu',
        '@<style[^>]*?>.*?</style>@siu',
        '@<script[^>]*?.*?</script>@siu',
        '@<object[^>]*?.*?</object>@siu',
        '@<embed[^>]*?.*?</embed>@siu',
        '@<applet[^>]*?.*?</applet>@siu',
        '@<noframes[^>]*?.*?</noframes>@siu',
        '@<noscript[^>]*?.*?</noscript>@siu',
        '@<noembed[^>]*?.*?</noembed>@siu',
        // Add line breaks before and after blocks
        '@</?((address)|(blockquote)|(center)|(del))@iu',
        '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
        '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
        '@</?((table)|(th)|(td)|(caption))@iu',
        '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
        '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
        '@</?((frameset)|(frame)|(iframe))@iu',
            ), array(
        ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
        "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
        "\n\$0", "\n\$0",
            ), $text);
    return strip_tags($text);
}