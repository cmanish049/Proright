<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');


/* * ************************************************************** 
  $this->data = (
  [file_name]    => mypic.jpg
  [file_type]    => image/jpeg
  [file_path]    => /path/to/your/upload/
  [full_path]    => /path/to/your/upload/jpg.jpg
  [raw_name]     => mypic
  [orig_name]    => mypic.jpg
  [client_name]  => mypic.jpg
  [file_ext]     => .jpg
  [file_size]    => 22.2
  [is_image]     => 1
  [image_width]  => 800
  [image_height] => 600
  [image_type]   => jpeg
  [image_size_str] => width="800" height="200"
  )
 * ****************************************************************** */

/**
 * Description of dosya
 *
 * @author Alexander
 */
class File
{
    private $CI;
    public $upload_base_dir = 'upload';
    public $upload_dir_name = 'yazi-thumb';
    public $upload_dir = '';
    public $create_date_dir = TRUE;
    public $allowed_types = 'gif|jpg|png|jpeg';
    public $file_path = '';
    public $file_url = '';
    public $overwrite = false;
    public $data = array();
    public $max_size = '3000';
    public $max_width = '3000';
    public $max_height = '3000';
    public $db_data = array(
        'yazi_id' => 0,
        'galeri_id' => 0,
        'file_name' => '',
        'file_title' => '',
        'file_explanation' => '',
        'file_path',
        'alttext' => '',
        'file_type' => '',
        'ekleme_tarihi' => '',
        'mime_type' => '',
        'dosya_directory' => '',
        'file_seo' => ''
    );
    public $errors = array();

    public function __construct($options = array())
    {
        $this->CI = &get_instance();

        if(count($options) > 0)
        {
            $this->init($options);
        }
    }

    public function clear()
    {
        $this->create_date_dir = TRUE;
        $this->file_path = '';
        $this->file_url = '';
        $this->overwrite = FALSE;
        $this->data = array();
        $this->db_data = array(
            'file_name' => '',
            'file_title' => '',
            'file_explanation' => '',
            'file_path',
            'alttext' => '',
            'file_type' => '',
            'ekleme_tarihi' => '',
            'mime_type' => '',
            'dosya_path' => '',
            'file_seo' => ''
        );
        $this->allowed_types = 'gif|jpg|png|jpeg';
    }

    public function insert($data = array())
    {
        $this->CI->load->model('dosya_model');

        $db_data['file_title'] = (isset($data['file_title'])) ? $data['file_title'] : element('file_name', $this->data, '');
        $db_data['alttext'] = $db_data['file_title'];
        $db_data['insert_date'] = mysql_now();
        $db_data['creator_id'] = ($this->CI->auth->get_user_id()>0)?$this->CI->auth->get_user_id():0;

        if(!empty($this->data))
        {
            $db_data['file_path'] = $this->file_path;
            $db_data['file_name'] = $this->data['file_name'];
            $db_data['alttext'] = $this->data['raw_name'];
            $db_data['file_path'] = $this->upload_dir;
            $db_data['file_seo'] = $this->CI->dosya_model->ayarla_seo($this->data['raw_name']);
            $db_data['mime_type'] = $this->data['file_type'];
            $db_data['file_type'] = ($this->data['is_image']) ? 'resim' : '';
            
            $meta_data = array(
                'ext' => $this->data['file_ext'],
                'size' => round($this->data['file_size'], 3),
                'is_image' => $this->data['is_image'],
                'height' => $this->data['image_height'],
                'width' => $this->data['image_width'],
                'type' => $this->data['image_type'],
                'size_str' => $this->data['image_size_str']
            );
            $db_data['meta_data'] = serialize($meta_data);
        }
        return $this->CI->dosya_model->insert($db_data);
    }

    function upload_file($_name = 'resim', $new_name = '')
    {
        $i = FALSE;
        if(is_array($_name))
        {
            $i = $_name['i'];
            $name = $_name['name'];
            if(!array_key_exists($name, $_FILES))
            {
                $this->add_error(__("$name index has not been found"));
                return false;
            }
            
            if($_FILES[$name]['error'][$i] == '4' || count($_FILES[$name]['tmp_name']) < 1)
            {
                return false;
            }
        }
        else
        {
            $name = $_name;            
            if(!array_key_exists($name, $_FILES))
            {
                $this->add_error(__("$name index has not been found"));
                return false;
            }
            
            if($_FILES[$name]['error'] == '4' || count($_FILES[$name]['tmp_name']) < 1)
            {
                return false;
            }
        }

        $tmp_name = ($i === FALSE) ? $_FILES[$name]['name'] : $_FILES[$name]['name'][$i];
        $array = explode(".", $tmp_name);
        $file_ext = end($array);
        if(!empty($new_name))
        {
            $file_name = seo_url($new_name);
            $config['file_name'] = $file_name . '.' . $file_ext;
            $config['file_name'] = seo_url(character_limiter($config['file_name'], 80));
        }

        $this->upload_dir_name = $this->_upload_path();
        $config['upload_path'] = $this->upload_dir_name;
        $config['allowed_types'] = $this->allowed_types;
        $config['overwrite'] = $this->overwrite;
        $config['max_size'] = $this->max_size;
        $config['max_width'] = $this->max_width;
        $config['max_height'] = $this->max_height;

        $this->CI->load->library('upload');
        $this->CI->upload->initialize($config);

        $bool = false;
        if($i === FALSE)
        {
            $bool = $this->CI->upload->do_upload($name);
        }
        else
        {
            $bool = $this->CI->upload->multi_upload($name, $i);
        }

        if($bool)
        {
            $this->data = $this->CI->upload->data();

            $this->file_path = trim_slashes($this->upload_dir_name) . '/' . trim_slashes($this->data['file_name']);
            $this->file_url = base_url() . trim_slashes($this->file_path);
        }
        else
        {
            $this->add_error($this->CI->upload->display_errors('', ''));
            return FALSE;
        }

        return TRUE;
    }

    private function _upload_path()
    {
        $ftp_username = config_item('ftp_username');
        
        $year = date('Y');
        $month = date('m');

        $upload_directory = $this->upload_base_dir . '/' . trim_slashes($this->upload_dir_name);
        $upload_real_path = FCPATH . $upload_directory;
        #------------------------------------------------------------------------------------------
        # Eğer dizinler yoksa oluştur
        #------------------------------------------------------------------------------------------
        $_a = trim($this->upload_dir_name, '/');
        $_arr = explode('/', $_a);
        $_d = $this->upload_base_dir;
        foreach($_arr as $d)
        {
            $_d .= "/$d";
            if(!is_dir(FCPATH . $_d))
            {
                mkdir(FCPATH . $_d, 0777);
                $this->create_index_html($_d);
            }
        }
        //shell_exec("chown -R $ftp_user_name $upload_path");
        chmod($upload_real_path, 0777);

        if(!$this->create_date_dir)
        {
            $this->upload_dir = $upload_directory;
            return trim_slashes($this->upload_dir);
        }

        #------------------------------------------------------------------------------------------
        # Yüklenecek yıl klasörünü oluştur
        #------------------------------------------------------------------------------------------
        $upload_year_directory = trim_slashes($upload_directory) . '/' . $year;
        $upload_year_real_path = FCPATH . $upload_year_directory;
        if(!is_dir($upload_year_real_path))
        {
            mkdir($upload_year_real_path, 0777);

            $index_file = $upload_year_real_path . "/index.html";
            if(!is_file($index_file))
            {
                $this->CI->load->helper('file');
                write_file($index_file, '<p>Directory access forbidden</p>');
            }
        }
        //shell_exec("chown -R $ftp_user_name $yukleme_yil_gercek_yolu");
        chmod($upload_year_real_path, 0777);
        #------------------------------------------------------------------------------------------
        # yüklenecek ay klasörünün yolunu berirle
        # bu aynı zamanda dosyamızın yükleneceği yoldur
        #------------------------------------------------------------------------------------------
        $upload_modth_directory = $upload_year_directory . '/' . $month;
        $upload_month_real_path = FCPATH . $upload_modth_directory;
        if(!is_dir($upload_month_real_path))
        {
            mkdir($upload_month_real_path, 0777);

            $index_file = $upload_month_real_path . "/index.html";
            if(!is_file($index_file))
            {
                $this->CI->load->helper('file');
                write_file($index_file, '<p>Directory access forbidden</p>');
            }
        }

        //shell_exec("chown -R $ftp_user_name $yukleme_ay_gercek_yolu");
        chmod($upload_month_real_path, 0777);

        $this->upload_dir = $upload_modth_directory;
        return trim_slashes($this->upload_dir);
    }

    public function delete_temp_files($file_path='')
    {
        if(!empty($file_path))
        {
            $this->delete_file($file_path);
        }
        else
        {
            $this->delete_files('temp');
        }
    }
    
    /**
     * Bir yolun içerisindeki tüm dosyaları siler
     * @param type $path 
     */
    public function delete_files($path = '')
    {
        $this->CI->load->helper('file');
        delete_files($this->upload_base_dir . '/' . trim_slashes($path));
    }

    /**
     * bir dosyayı siler. 
     * $delete_thumbs true ise thumb dosyalarını da siler
     * 
     * @param type $file_path
     * @param type $delete_thumbs
     * @return boolean 
     */
    public function delete_file($file_path = '', $delete_thumbs = TRUE)
    {
        if(empty($file_path) || !file_exists($file_path))
        {
            return FALSE;
        }

        unlink($file_path);
        if($delete_thumbs === TRUE)
        {
            $this->delete_thumbnails($file_path);
        }
    }

    /**
     * Bir resmin thumb resimlerini siler
     * 
     * @param type $base_file
     * @return boolean 
     */
    public function delete_thumbnails($base_file = '')
    {
        if(is_object($base_file))
        {
            if(isset($base_file->file_path))
            {
                $file_path = $base_file->file_path;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            $file_path = $base_file;
        }

        if(empty($file_path))
        {
            return FALSE;
        }

        $path_info = pathinfo($file_path);
        $file_name = $path_info['filename'];
        $file_ext = $path_info['extension'];
        $upload_path = $path_info['dirname'];

        $_arr_crop = glob("$upload_path/{$file_name}_crop*.$file_ext");
        $_arr_resize = glob("$upload_path/{$file_name}_resi*.$file_ext");

        if($_arr_crop)
        {
            foreach($_arr_crop as $d)
            {
                unlink($d);
            }
        }
        if($_arr_resize)
        {
            foreach($_arr_resize as $d)
            {
                unlink($d);
            }
        }
    }

    public function create_index_html($path = '')
    {
        $index_file = rtrim($path, '/') . "/index.html";
        if(!is_file($index_file))
        {
            $this->CI->load->helper('file');
            write_file($index_file, '<p>Directory access forbidden</p>');
        }
    }

    public function add_error($error = '')
    {
        $this->errors[] = $error;
    }

    /**
     * GElen dizideki bilgileri kontrol ederek
     * classın değişkenlerine eşitler
     *
     * @param <Array> $options
     */
    function init($options = array())
    {
        foreach($options as $key => $e)
        {
            if(isset($this->$key))
            {
                $this->$key = $e;
            }
        }
    }

}
