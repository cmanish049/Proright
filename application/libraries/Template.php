<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Alexander
 */
class Template
{
    private $CI;
    public $theme = '';
    public $layout = '';
    private $_data = array();
    private $_view_parts = array();
    public $title = array();
    private $_meta = array();
    private $_js = array();
    private $_css = array();
    private $_style = '';
    private $_script = '';
    private $_module = '';
    private $_controller = '';
    private $_method = '';
    private $_themes_folder;
	private $_breadcrumbs = array();

    const MVC_TYPE = 'MVC';

    public function __construct()
    {
        $this->_themes_folder = config_item('themes_folder');
        
        $this->CI = & get_instance();

        if(method_exists($this->CI->router, 'fetch_module'))
        {
            $this->_module = $this->CI->router->fetch_module();
        }

        // What controllers or methods are in use
        $this->_controller = $this->CI->router->fetch_class();
        $this->_method = $this->CI->router->fetch_method();
    }
    
    public function clean_data()
    {        
        /*$this->_data['css'] = '';
        $this->_data['js'] = '';
        $this->_data['script'] = '';
        $this->_data['style'] = '';*/
    }

    public function get_theme_url()
    {
        return base_url() . $this->_themes_folder . '/' . $this->theme;
    }
    public function get_theme_path()
    {
        return $this->_themes_folder . '/' . $this->theme;
    }
    
    /**
     * tema yükle
     *
     * $data
     * -------------------------
     * title
     * meta
     * css | $this->_data değişkenine kendi fonksiyonunda eklendi
     * js  | $this->_data değişkenine kendi fonksiyonunda eklendi
     * view_parts
     *
     * @param <type> $view
     * @param <type> $data
     * @param <type> $return
     */
    public function build($view = '', $data = array(), $return = FALSE)
    {
        $_data = $this->_data;
        is_array($data) OR $data = (array) $data;
        $_data = array_merge($this->_data, $data);
        unset($data);
        $this->clean_data();
        
        $_data['theme_path'] = $this->_themes_folder . '/' . $this->theme;
        $_data['theme_url'] = base_url() . $this->_themes_folder . '/' . $this->theme;
        $_data['theme'] = $this->theme;
        $_data['css'] = implode(' ', (array) $this->_css);
        $_data['js'] = implode(' ', (array) $this->_js);
        $_data['script'] = '';
        $_data['style'] = '';

        if($this->_script)
        {
            $_data['script'] = '<script type="text/javascript">' . $this->_script . '</script>';
        }
        if($this->_style)
        {
            $_data['style'] = '<style type="text/css">' . $this->_style . '</style>';
        }
        $_data['meta'] = $this->_meta();
        $_data['title'] = $this->_title();
        
        foreach($this->_view_parts as $e)
        {
            $view_data = array_merge($_data, (array) $e['data']);
            $_data[$e['view_adi']] = $this->CI->load->view($this->_get_view_path($e['view']), $view_data, TRUE);
        }

        if($view)
        {
            $_view = $this->_get_view_path($view);
        }
        else
        {
            $_view = $this->_layout_path();
        }

        if($return)
        {;
            return $this->CI->load->view($_view, $_data, $return);
        }

        $this->CI->load->view($_view, $_data, $return);
    }

    private function _get_view_path($view)
    {
        if(self::MVC_TYPE == 'MVC')
        {
            return $this->theme . '/' . trim($view, '/');
        }

        $theme_paths = array(
            APPPATH . 'modules/' . $this->_module . '/views/' . $view,
            APPPATH . 'views/' . $this->theme . '/' . $view
        );

        $views = array(
            $view,
            $this->theme . '/' . $view
        );

        foreach($theme_paths as $key => $e)
        {
            if(file_exists($e . self::_ext($e)))
            {
                return $views[$key];
            }
        }
    }

    private function _ext($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION) ? '' : '.php';
    }

    public function view($view,$data=array(),$return=FALSE)
    {
        if(!is_array($data))
        {
            $data = array();
        }  
        
        $_data = array_merge($this->_data, $data);
        $output = $this->CI->load->view($this->_get_view_path($view),$_data,$return);
        
        if($return)
        {
            return $output;
        }
        
        echo $output;
    }

    public function view_parts($view_name, $view = array(), $data = array())
    {
        $this->_view_parts[] = array(
            'view_adi' => $view_name,
            'view' => $view,
            'data' => $data
        );
        return $this;
    }

    public function theme($theme = '')
    {
        $this->theme = $theme;
        return $this;
    }

    public function get_theme()
    {
        return $this->theme;
    }
    
    public function get_layout()
    {
        return $this->layout;
    }

    public function data($index = '', $data = '')
    {
        if(is_array($index))
        {
            foreach($index as $key => $value)
            {
                $this->_data[$key] = $value;
            }
        }
        else
        {
            $this->_data[$index] = $data;
        }
        return $this;
    }

    public function layout($layout = '')
    {
        $this->layout = $layout;
        return $this;
    }

	public function get_breadcrumbs()
	{
		return $this->_breadcrumbs;
	}

	public function add_breadcrumb($url, $text, $prepend=FALSE)
	{
		$breadcrumb = array(
			'url' => $url,
			'text' => $text
		);
		
		if($prepend===TRUE)
		{
			array_unshift($this->_breadcrumbs, $breadcrumb);
		}
		else
		{
			$this->_breadcrumbs[] = $breadcrumb;
		}
		
		return $this;
	}
	
    public function prepend_meta($meta = '')
    {
        array_unshift($this->_meta, $meta);
        return $this;
    }
	
    public function meta($meta = '')
    {
        $this->_meta[] = $meta;
        return $this;
    }

    public function css($css, $media = 'all', $is_minify = FALSE)
    {        
        if(is_array($css))
        {
            foreach($css as $e)
            {
                
                $this->_css[] = $this->_css($e, $media, $is_minify);
            }
        }
        else
        {            
            $this->_css[] = $this->_css($css, $media, $is_minify);
        }
        
        return $this;
    }
    
    public function _css($css, $media = 'all', $is_minify = FALSE)
    {        
        $attr = array(
            'href' => $this->_themes_folder . '/' . $this->theme . '/' . $css,
            'rel' => 'stylesheet',
            'type' => 'text/css',
            'media' => $media
        );
        if($is_minify)
        {
            $attr['href'] = 'min/f='.$this->_themes_folder . '/' . $this->theme . '/' . $css;
        }
        
        return link_tag($attr);
    }

    public function style($style = '')
    {
        $this->_style .= "\n" . $style . "\n";
        return $this;
    }

    public function js($js, $is_minify = FALSE)
    {
        if(is_array($js))
        {
            foreach($js as $e)
            {
                $this->_js[] = $this->_js($e,$is_minify);
            }
        }
        else
        {
            $this->_js[] = $this->_js($js,$is_minify);
        }
        return $this;
    }

    public function _js($js, $is_minify = FALSE)
    {
        if($is_minify)
        {
            $path = "min/f=".$this->_themes_folder . "/$this->theme/$js";
        }
        else
        {
            $path = $this->_themes_folder . "/$this->theme/$js";
        }
        return '<script type="text/javascript" src="' . base_url() . $path . '"></script>';
    }

    public function script($script = '')
    {
        $this->_script .= "\n" . $script . "\n";

        return $this;
    }

    public function title($title = '', $add_head = TRUE)
    {
        if($add_head)
        {
            array_unshift($this->title, strip_tags($title));
        }
        else
        {
            $this->title[] = strip_tags($title);
        }

        return $this;
    }

    public function description($description = '')
    {
        if(is_array($description))
        {
            $description = implode(', ', $description);
        }
        $this->_meta_ekle('description', $description);

        return $this;
    }

    public function keyword($keywords)
    {
        if(is_array($keywords))
        {
            $keywords = implode(', ', $keywords);
        }
        $this->_meta_ekle('keywords', $keywords);

        return $this;
    }

    private function _meta_ekle($name, $content)
    {
        $content = htmlspecialchars(strip_tags(character_limiter($content, '259')));

        $this->_meta[$name] = '<meta name="' . $name . '" content="' . $content . '" />';
    }

    private function _title()
    {
        if(!empty($this->title))
        {
            $this->title($this->CI->config->item('website_title_add'), FALSE);
            $title = implode($this->CI->config->item('title_indicator'), $this->title);
        }
        else
        {
            $title = $this->CI->config->item('site_adi');
        }

        return $title;
    }

    private function _meta()
    {
        if(!isset($this->_meta['description']))
        {
            $this->_meta_ekle('description', $this->CI->config->item('site_descriptions'));
        }
        else if(!$this->_meta['description'])
        {
            $this->_meta_ekle('description', $this->CI->config->item('site_descriptions'));
        }

        if(!isset($this->_meta['keywords']))
        {
            $this->_meta_ekle('keywords', $this->CI->config->item('site_keywords'));
        }
        else if(!$this->_meta['keywords'])
        {
            $this->_meta_ekle('keywords', $this->CI->config->item('site_keywords'));
        }

        $this->_meta_ekle('google-site-verification', $this->CI->config->item('google_site_verification'));

        return implode("\n\t\t", $this->_meta);
    }

    private function _layout_path()
    {
        if($this->layout)
        {
            $layout_path = $this->theme . '/layouts/' . $this->layout;
        }
        else
        {
            $layout_path = $this->theme;
        }

        return $layout_path;
    }

    public function __get($name = NULL)
    {
        return $this->{$name};
    }

}
