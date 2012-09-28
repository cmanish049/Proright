<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

//---------------------------------------------------
if(!function_exists('is_image'))
{

    function is_image($path)
    {
        if(preg_match("/(.)+\\.(jp(e){0,1}g$|gif$|png$)/i", $path))
        {
            return TRUE;
        }
        return FALSE;
    }

}

/**
 * $master_dim===false olunca istediğim boyutlarda gelsin demek oluyor.
 * 
 * @param type $original_image
 * @param type $width
 * @param type $height
 * @param type $adaptive_resize
 * @param type $master_dim
 * @param type $protect_original_sizes
 * @return strıng 
 */
function thumbnail($original_image = '', $width = '', $height = '', $adaptive_resize = TRUE, $master_dim = 'width',$protect_original_sizes=FALSE)
{
    $CI = & get_instance();
    $CI->load->helper('string');
    $CI->load->library('thumb/PhpThumbFactory');

    $source_image = $original_image;

    if(!file_exists($source_image))
    {
        if(file_exists(config_item('default_thumb')))
        {
            return thumbnail(config_item('default_thumb'), $width, $height);
        }
        else
        {
            return '';
        }
    }

    #------------------------------------------------------------------------------------------
    # Thumb resmin yolunu belirle
    #------------------------------------------------------------------------------------------
    $path_info = pathinfo($source_image);    
    $image_ext = $path_info['extension'];
    $dir_name = $path_info['dirname'];
    $image_name = isset($path_info['filename']) ? $path_info['filename'] : basename($source_image, ".$image_ext");;        

    $image_process = ($adaptive_resize) ? 'crop' : 'resize';
    $_master_dim_string = substr((($master_dim) ? 'true' : $master_dim), 0, 1);
    $_protect_original_sizes_string = substr((($protect_original_sizes) ? 'true' : 'false'), 0, 1);
    $thumb_path = trim_slashes($dir_name) . "/{$image_name}_{$image_process}_{$_master_dim_string}_{$_protect_original_sizes_string}_{$width}x{$height}.{$image_ext}";

    if(file_exists($thumb_path))
    {
        return base_url() . trim_slashes($thumb_path);
    }

    $options = array
        (
        'resizeUp' => ($protect_original_sizes === TRUE) ? FALSE : TRUE,
        'jpegQuality' => 100,
        'correctPermissions' => FALSE,
        'preserveAlpha' => TRUE, //png resimler için alfa olsun mu?
        'alphaMaskColor' => array(255, 255, 255),
        'preserveTransparency' => TRUE, //gif resimler için şeffağlığı koru
        'transparencyMaskColor' => array(0, 0, 0)
    );
    $thumb = PhpThumbFactory::create($source_image, $options);

    if($adaptive_resize)
    {
        $thumb->adaptiveResize($width, $height);
    }
    else
    {
        if($master_dim === FALSE)
        {
            $thumb->resize($width, $height);
        }
        else if($master_dim=='width')
        {
            $thumb->resize($width,0);
        }
        else if($master_dim=='height')
        {
            $thumb->resize(0,$height);
        }
    }
    $thumb->save($thumb_path);

    return base_url() . trim_slashes($thumb_path);
}
