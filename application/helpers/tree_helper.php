<?php

function callback_tree_for_menu_duzenle($e)
{
    if(!isset($e))
    {
        return '';
    }

    $menu_adi = $e->menu_adi;
    $menu_tipi = $e->menu_tipi;
    $menu_url = $e->menu_url;
    $menu_baslik = $e->menu_baslik;
    if($menu_tipi=='kategori')
    {
        $menu_adi = $e->kategori_adi;

    }
    if($menu_tipi=='sayfa')
    {
        $menu_adi = $e->baslik;
    }

    $html = "<a href='#' class='droppable'
                data-menu-adi='$menu_adi'
                data-menu-tipi='$menu_tipi'
                data-menu-url='$menu_url'
                data-menu-baslik='$menu_baslik'
                >$menu_adi</a>";
    return $html;
}

function callback_tree_for_admin_top_menu($e)
{
    if(!isset($e))
    {
        return '';
    }

    $url = admin_url($e->module_url);
    if(!$e->module_url || $e->module_url=='#')
    {
        $url = '#';
    }
    $html = "<a href='$url' title='' >$e->module_plural_label</a>";
    return $html;
}

function callback_tree_for_modul_sira_no($e)
{
    if(!isset($e))
    {
        return '';
    }

    $url = '#';
    $html = "<a href='$url' title='' ><span class='ui-icon ui-icon-arrowthick-2-n-s pull-left'></span>$e->modul_adi</a>";
    return $html;
}

function callback_tree_for_module_list_in_user_group_form($e,$params=array())
{
    if(!isset($e))
    {
        return '';
    }
    extract($params);
    $checked = in_array($e->module_id, $checked_values);

    return '<label class="checkbox">'. form_checkbox(array('name' => 'module_id[]'), $e->module_id, $checked) .$e->module_name.'</label>';
}