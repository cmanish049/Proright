<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function js_close_modal($modal_name = 'dialog')
{
    $script = '';
    if($_POST)
    {
        $script = "if(window.parent.dialogs['$modal_name'] != undefined) { 
            window.parent.dialogs['$modal_name'].close();
            window.parent.dialogs['$modal_name'].destroy();
        }";
    }
    echo "<script type='text/javascript'>$script</script>";
    exit;
}

function js_init_tinymce($config = array())
{
    $CI = & get_instance();
    $tema = $CI->template->get_theme();
    $tema_url = trim_slashes(base_url(config_item('themes_folder') . "/$tema"));

    $_config = array(
        'selector' => 'textarea.js-editor',
        'onchange_callback' => '',
        //'plugins' => ',lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave',
        'plugins' => 'myplugin,autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template',
        //'plugins' => ',lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave',
        //'plugins' => 'autolink,pagebreak,style,advlink,preview,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras',
        'theme_advanced_buttons1' => 'myplugin,save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect',
        'theme_advanced_buttons2' => 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
        'theme_advanced_buttons3' => 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen',
        'theme_advanced_buttons4' => 'insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft'
    );

    $_config = array_merge($_config, $config);

    $script = "
    $(function(){
        $('{$_config['selector']}').tinymce({
            script_url :  '{$tema_url}/js/tiny_mce/tiny_mce.js',
            document_base_url : '" . base_url() . "',
            //content_css : false,
            theme : 'advanced',
            plugins : '{$_config['plugins']}',
            height : '300',
            width:'92%',
			//language : 'tr',
            theme_advanced_buttons1 : '{$_config['theme_advanced_buttons1']}',
            theme_advanced_buttons2 :'{$_config['theme_advanced_buttons2']}',
            theme_advanced_buttons3 :'{$_config['theme_advanced_buttons3']}',
            theme_advanced_buttons4 :'{$_config['theme_advanced_buttons4']}',
            theme_advanced_toolbar_location : 'top',
            theme_advanced_toolbar_align : 'left',
            theme_advanced_statusbar_location : 'bottom',
            theme_advanced_resizing : true,
            paste_auto_cleanup_on_paste : true,
            paste_remove_styles: false,
            paste_remove_styles_if_webkit: false,
            paste_strip_class_attributes: true,
            remove_script_host : false,
            relative_urls : true,
            //encoding : 'xml',
            //apply_source_formatting : false,
            entity_encoding: 'raw',
            //entities : '160,nbsp,38,amp,34,quot,162,cent,8364,euro,163,pound,165,yen,169,copy,174,reg,8482,trade,8240,permil,60,lt,62,gt,8804,le,8805,ge,176,deg,8722,minus',
            onchange_callback : '{$_config['onchange_callback']}',
            paste_retain_style_properties : 'margin, padding, width, height, font-size, font-weight, font-family, color, text-align, ul, ol, li, text-decoration, border, background, float, display'
        });
    });
    ";

    $CI->template->script($script);
}

function js_bind_alert_closing_window()
{
    $script = '$(function(){bindAlertClosingWindow();});';
    return $script;
}

function js_unbind_alert_closing_window($selector, $event = 'submit')
{
    $script = "$(function(){unbindAlertClosingWindow('$selector','$event');});";
    return $script;
}

function js_autosave($selector, $target = '')
{
    $script = '$(function(){setTimeout("autosave(' . "'$selector','$target')\", 20000);});";

    return $script;
}

function html_autocomplete_cleaner_button($selector = '', $target = '')
{
    $html = '<a href="#" class="clean-autocomplete" onclick="clean_autocomplete(' . "'$selector','$target'" . '); return false;"><i class="icon-remove"></i></a>';
    return $html;
}

function kendouiDataItemTemplateString($item_name='')
{
    return "#= isnull($item_name, '') #";
}

function kendouiDataItemDateTemplateString($item_name='')
{
    return "#= kendo.toString(isnull($item_name, ''),'yyyy-MM-dd hh:mm:ss') #";
}

function kendouiDataItemDateTimeTemplateString($item_name='')
{
    return "#= isnull($item_name, '') #";
}

function kendouiDataItemBooleanImageTemplateString($item_name='', $container_css_class='center-inner')
{
    return '<div class="'.$container_css_class.'"> # if('.$item_name.'=="1"){# <i class="icon-grid-cell-ok"></i> #}else{#  #}#</div>';
}

function kendoui_yes_no_grid_filter_items()
{
    return "jQuery.parseJSON('" . parse_json(parse_kendoui_dropdown_array(array('1' => __('Yes'), '0'=>__('No')))) ."')";
}