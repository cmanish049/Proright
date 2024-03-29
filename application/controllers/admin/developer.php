<?php

/**
 * Description of developer
 *
 * @author Alexander
 */
class Developer extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);

        $this->load->helper('file');
    }

    public function index()
    {      
        $this->data['page_title'] = __('Developer Tools');
        
        //$this->data['functions'] = get_class_methods($this);
        $this->data['functions'] = array(
            'db_tables' => 'Update config->db_tables.php',
            'db_backup' => 'Backup database',
            'netbeans_autocomplete' => 'Update autocomplete file for netbeans'
            
        );
        
        $this->template->view_parts('content', 'developer/index_view', $this->data)
                ->title('Developer')
                ->build();
    }

    public function set_all_tables_engine($engine='')
    {
        $engine OR $engine = 'MyISAM';
        $tables = $this->db->list_tables();
        
        foreach($tables as $e)
        {
            $sql = "ALTER TABLE $e  ENGINE=$engine";
            $this->db->query($sql);
        }
        
    }

    public function db_tables()
    {
        use_try_catch();
        try
        {
            
            $tables = $this->db->list_tables();

            $output = "<?php if(!defined('BASEPATH')) exit('No direct script access allowed');\n\n";
            $output .= '$config[\'db_tables\'] = array(' . "\n";

            $count = count($tables);
            foreach($tables as $key => $e)
            {
                $fields = $this->db->list_fields($e);

                $output .= "\t'$e' => array(\n";
                $output .= "\t\t'" . implode("',\n\t\t'", $fields) . "'\n";
                $output .= "\t),";
                if($count != ($key + 1))
                {
                    $output .= "\n";
                }
            }
            $output = substr_replace($output, '', -1, 1);
            $output .= "\n);";

            write_file(APPPATH . 'config/db_tables.php', $output);
            
            $this->session->set_flashdata('success', __('config->db_tables.php updated successfully'));
        }
        catch (Exception $exc)
        {
            $this->session->set_flashdata('error', $exc->getMessage());
        }
            
        redirect(admin_url('developer/index'));
    }

    public function delete_all_thumbnails()
    {
        $this->load->model('dosya_model');
        $dosyalar = $this->dosya_model->get_rows();

        foreach($dosyalar as $d)
        {
            $dosya_yolu = $d->dosya_yolu;
            $path_info = pathinfo($dosya_yolu);
            $dosya_adi = $path_info['filename'];
            $resim_uzantisi = $path_info['extension'];
            $yukleme_dizini = $path_info['dirname'];

            $_arr_crop = glob("$yukleme_dizini/{$dosya_adi}_crop*.$resim_uzantisi");
            $_arr_resize = glob("$yukleme_dizini/{$dosya_adi}_resi*.$resim_uzantisi");

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
    }

    public function db_backup()
    {
        $this->load->dbutil();
        $dosya_adi = date('d') . '-' . date('m') . '-' . date('Y') . '.sql';

        $prefs = array(
            //'tables' => array('table1', 'table2'), // Array of tables to backup.
            'ignore' => array(), // List of tables to omit from the backup
            'format' => 'txt', // gzip, zip, txt
            //'filename' => 'yedek/sql/' . $dosya_adi, // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"     // Newline character used in backup file
        );
        $backup = & $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file('yedek/sql/' . $dosya_adi, $backup);
        $this->load->helper('download');
        force_download($dosya_adi, $backup);
    }

    public function db_optimize()
    {
        $this->load->dbutil();
        $result = $this->dbutil->optimize_database();

        if($result !== FALSE)
        {
            pre($result);
        }
    }

    public function wikipedia_meslekleri_cek()
    {
        header('Content-type: text/html; charset=utf-8');
        $this->load->database();
        $this->load->library('simple_html_dom');
        $dom = $this->simple_html_dom;
        $a = urldecode("http://tr.wikipedia.org/wiki/Meslek_listesi");
        $b = $this->_curl_ile_veri_cek($a);
        $dom->load($b);

        foreach($dom->find('.multicol') as $e1)
        {
            foreach($e1->find('li a') as $e2)
            {
                $meslek_adi = $e2->plaintext;
                $sql = "SELECT satir_id FROM base_table WHERE satir_degeri='$meslek_adi' ";
                $query = $this->db->query($sql);
                if($query->num_rows() > 0)
                {
                    continue;
                }

                $sql = "INSERT INTO base_table(tablo_id, satir_degeri) VALUES('2','$meslek_adi')";
                $this->db->query($sql);
            }
        }
    }

    public function wikipedia_okullari_cek()
    {
        header('Content-type: text/html; charset=utf-8');
        $this->load->database();
        $this->load->library('simple_html_dom');
        $dom = $this->simple_html_dom;
        $a = urldecode("http://tr.wikipedia.org/wiki/T%C3%BCrkiye'deki_%C3%BCniversiteler_listesi");

        $b = $this->_curl_ile_veri_cek($a);
        $dom->load($b);
        foreach($dom->find('.sortable tr') as $e1)
        {
            $e2 = $e1->find('td', 1);

            if(empty($e2))
            {
                continue;
            }

            $okul = $e2->plaintext;

            $e2 = $e1->find('td', 3);

            if(empty($e2))
            {
                continue;
            }

            $sehir = $e2->plaintext;
            $sehir_seo = turkce_karakter_temizle($sehir);

            $sql = "SELECT sehir_id FROM sehirler 
                    WHERE sehir_adi='$sehir' OR sehir_adi='$sehir_seo' LIMIT 1
            ";
            $query = $this->db->query($sql);
            if($query->num_rows() < 1)
            {
                continue;
            }
            $sehir_id = $query->row()->sehir_id;

            $sql = "SELECT okul_id FROM okullar WHERE okul_adi='$okul' ";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0)
            {
                continue;
            }

            $sql = "INSERT INTO okullar(sehir_id, okul_adi) VALUES('$sehir_id','$okul')";
            $this->db->query($sql);
        }
    }

    public function _curl_ile_veri_cek($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
        $str = curl_exec($ch);
        curl_close($ch);

        return $str;
    }

    public function netbeans_autocomplete()
    {
        $sys_lib = BASEPATH . '/libraries';
        $app_lib = APPPATH . '/libraries';
        $app_model = APPPATH . '/models';

        ob_start();
        echo "&lt;?php<br><br>";
        echo "/**<br/>";
        echo '* @property CI_DB_active_record $db<br/>';
        echo '* @property CI_DB_forge $dbforge<br/>';

        if($handle = opendir($sys_lib))
        {
            /* This is the correct way to loop over the directory. */
            while(false !== ($file = readdir($handle)))
            {
                if($file[0] == '.') continue;
                $files = explode('.', $file);
                $file = $files[0];
                $file2 = $file;
                if($file == 'index') continue;
                if($file == 'Loader') $file2 = 'load';
                echo "* @property CI_" . $file . " $" . strtolower($file2) . "<br/>";
            }
            closedir($handle);
        }
        if($handle = opendir($app_lib))
        {
            /* This is the correct way to loop over the directory. */
            while(false !== ($file = readdir($handle)))
            {
                if($file[0] == '.') continue;
                $files = explode('.', $file);
                $file = $files[0];
                $file_parts = explode('_', $file);
                $first_part = $file_parts[0];
                if($first_part == 'index' || $first_part == 'MY') continue;
                if(count($file_parts) > 1)
                {
                    $last_part = $file_parts[1];
                    echo "* @property " . ucfirst($first_part) . "_" . ucfirst($last_part) . " $" . strtolower($first_part) . "_" . strtolower($last_part) . "<br/>";
                }
                else
                {
                    echo "* @property " . ucfirst($first_part) . " $" . strtolower($first_part) . "<br/>";
                }
            }
            closedir($handle);
        }
        if($handle = opendir($app_model))
        {
            /* This is the correct way to loop over the directory. */
            while(false !== ($file = readdir($handle)))
            {
                if($file[0] == '.') continue;
                $files = explode('.', $file);
                $file = $files[0];
                if($file == 'index') continue;
                $file_parts = explode('_', $file);
                $first_part = $file_parts[0];
                $last_part = $file_parts[1];
                echo "* @property " . ucfirst($first_part) . "_" . ucfirst($last_part) . " $" . strtolower($first_part) . "_" . strtolower($last_part) . "<br/>";
            }
            closedir($handle);
        }
        echo "*/<br><br>";
        echo "class CI_Controller {};<br><br>class CI_Model {};<br><br>";
        echo "?>";
        $output = ob_get_contents();
        ob_end_clean();


        //autocomplete_all
        write_file('autocomplete_all.php', str_replace(array('<br/>', '<br>'), "\n", decode_html($output)));
        //write_file('ci_autocomplete.php', str_replace(array('<br/>', '<br>'), "\n", decode_html($output)));
        
        $this->session->set_flashdata('success', __('autocomplete file for netbeans is updated'));
        redirect(admin_url('developer/index'));
    }

}

