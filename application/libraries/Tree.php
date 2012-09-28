<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of tree
 *
 * @author Alexander
 */

/**
 * base_field
 * parent_field
 */
class Tree
{
    private $use_eval = FALSE;
    private $datas = array();
    private $base_field = '';
    private $parent_field = '';
    private $base_ul_attrs = array('class' => 'tree-list');
    private $child_ul_attrs = array('class' => 'child-list');
    
    private $parent_template_callback;
    private $parent_template_callback_parameters;
    private $child_template_callback;
    private $child_template_callback_parameters;

    public function __construct($config = array())
    {
        $this->initialize($config);
        
        $CI =& get_instance();
        $CI->load->helper('tree');
        
    }

    public function initialize($config = array())
    {        
        foreach($config as $key => $value)
        {
            if(isset($this->$key))
            {
                $this->$key = $value;
            }
        }

        $this->parent_template_callback = '$e->{$this->base_field}';
        $this->child_template_callback = '$e->{$this->base_field}';
    }

    public function clear()
    {
        $this->base_ul_attrs = array('class' => 'tree-list');
        $this->child_ul_attrs = array('class' => 'child-list');

        $this->datas = array();
        $this->base_field = '';
        $this->parent_field = '';

        $this->parent_template_callback = '';
        $this->child_template_callback = '';
    }

    public function generate_tree($datas = array())
    {
        if(!empty($datas))
        {
            $this->datas = $datas;
        }

        if(empty($this->datas))
        {
            return '';
        }

        $first_levels = $this->get_first_levels();

        if(empty($first_levels))
        {
            return '';
        }

        $output = '<ul' . $this->_get_attrs_string($this->base_ul_attrs) . '>' . "\n";
        foreach($first_levels as $e)
        {
            if(!is_object($e))
            {
                $e = (object) $e;
            }
            if($this->use_eval)
            {
                eval("\$html = \"$this->parent_template_callback\";");
            }
            else
            {
                $function = $this->parent_template_callback;
                $html = $function($e, $this->parent_template_callback_parameters);
            }
                                    
            $output .="<li id='$this->base_field-".$this->_element($this->base_field, $e)."'>" . $html;
            $output .= $this->_generate_childs($this->get_childs($this->_element($this->base_field, $e)));
            $output .= '</li>' . "\n";
        }
        $output .= "</ul>\n";
        
        $this->clear();
        return $output;
    }

    private function _generate_childs($childs = array())
    {
        if(empty($childs))
        {
            return '';
        }

        $output = "\n<ul" . $this->_get_attrs_string($this->child_ul_attrs) . '>' . "\n";
        foreach($childs as $e)
        {
            if(!is_object($e))
            {
                $e = (object) $e;
            }
            
            if($this->use_eval)
            {
                eval("\$html = \"$this->child_template_callback\";");
            }
            else
            {
                $function = $this->child_template_callback;
                $html = $function($e,  $this->child_template_callback_parameters);
            }

            $output .= "<li id='$this->base_field-".$this->_element($this->base_field, $e)."'>" . $html;

            $child_childs = $this->get_childs($this->_element($this->base_field, $e));
            if(!empty($child_childs))
            {
                $output .= $this->_generate_childs($child_childs);
            }

            $output .= "</li>\n";
        }
        $output .= '</ul>' . "\n";

        return $output;
    }

    public function &get_first_levels()
    {
        $first_levels = array();

        if(!$this->base_field || !$this->parent_field)
        {
            return $first_levels;
        }

        foreach($this->datas as $i => $d)
        {
            $parent_value = $this->_element($this->parent_field, $d);
            if(!$this->is_first_level($parent_value))
            {
                continue;
            }                      
            $first_levels[] = $this->datas[$i];            
        }

        return $first_levels;
    }
    
    public function is_first_level($parent_value='')
    {
        $i = 0;        
        foreach($this->datas as $e)
        {
            if($parent_value == $this->_element($this->base_field, $e))
            {
                $i++;
                break;
            }
        }
        
        return $i==0;
    }

    public function &get_childs($base_field_value = '')
    {
        $childs = array();
        if(empty($this->datas))
        {
            return $childs;
        }

        foreach($this->datas as $i => $d)
        {
            $parent_value = $this->_element($this->parent_field, $d);

            if($base_field_value == $parent_value)
            {
                $childs[] = $d;
                //kullanılan elemanı kaldırki for döngüsünde boşa yer etmesin çünkü artık bir gereği kalmıyor
                //fakat first_levelleri bulurken unset yapmıyoruz çünkü first levelmi kontrolünde lazım gerekiyor
                unset($this->data[$i]);
            }
        }

        return $childs;
    }

    private function _element($key = '', $object = NULL)
    {
        $value = '';
        if(is_array($object) && isset($object[$key]))
        {
            $value = $object[$key];
        }
        else if(is_object($object) && isset($object->{$key}))
        {
            $value = $object->{$key};
        }

        return $value;
    }

    public function set_template($template = '',$func_params=array())
    {
        $this->set_parent_template($template,$func_params);
        $this->set_child_template($template,$func_params);
        return $this;
    }

    public function set_parent_template($template = '',$func_params=array())
    {
        $this->parent_template_callback = $template;
        $this->parent_template_callback_parameters = $func_params;
        return $this;
    }

    public function set_child_template($template = '',$func_params=array())
    {
        $this->child_template_callback = $template;
        $this->child_template_callback_parameters = $func_params;
        return $this;
    }

    public function use_eval($bool = TRUE)
    {
        $this->use_eval = $bool;
        return $this;
    }

    private function _get_attrs_string($attrs = array())
    {
        $_attrs = array();
        foreach($attrs as $key => $value)
        {
            $_attrs[] = $key . '="' . $value . '"';
        }

        return ' ' . implode(' ', $_attrs);
    }

}
