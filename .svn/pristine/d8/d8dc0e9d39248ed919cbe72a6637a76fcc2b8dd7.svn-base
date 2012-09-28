<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Security extends CI_Security
{

    public function __construct()
    {        
        parent::__construct();
    }

    /*
     * Remove Evil HTML Attributes (like evenhandlers and style)
     *
     * It removes the evil attribute and either:
     * 	- Everything up until a space
     * 		For example, everything between the pipes:
     * 		<a |style=document.write('hello');alert('world');| class=link>
     * 	- Everything inside the quotes 
     * 		For example, everything between the pipes:
     * 		<a |style="document.write('hello'); alert('world');"| class="link">
     *
     * @param string $str The string to check
     * @param boolean $is_image TRUE if this is an image
     * @return string The string with the evil attributes removed
     */
    protected function _remove_evil_attributes($str, $is_image)
    {
        $CI = &get_instance();
        // All javascript event handlers (e.g. onload, onclick, onmouseover), style, and xmlns
        $evil_attributes = array('on\w*', 'style', 'xmlns');

        if(isset ($_POST['editor']) && $CI->uri->segment(1)=='alexander-admin')
        {
            $evil_attributes = array('on\w*', 'xmlns');
        }
        
        if($is_image === TRUE)
        {
            /*
             * Adobe Photoshop puts XML metadata into JFIF images, 
             * including namespacing, so we have to allow this for images.
             */
            unset($evil_attributes[array_search('xmlns', $evil_attributes)]);
        }

        do
        {
            $str = preg_replace(
                    "#<(/?[^><]+?)([^A-Za-z\-])(" . implode('|', $evil_attributes) . ")(\s*=\s*)([\"][^>]*?[\"]|[\'][^>]*?[\']|[^>]*?)([\s><])([><]*)#i", "<$1$6", $str, -1, $count
            );
        } while($count);

        return $str;
    }

}