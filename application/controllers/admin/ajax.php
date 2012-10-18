<?php

/**
 * Description of ajax
 *
 * @author Alexander
 */
class Ajax extends Admin_Controller
{
    public $result_type;

    public function __construct()
    {
        parent::__construct();

        $this->config->set_item('compress_output', FALSE);
    }

    public function generate_unique_key_for_customer()
    {
        $key = $this->auth->generate_unique_key_for_user();
        echo $key;
    }

    public function remove_tempfile()
    {
        $this->output->_display($this->fastjson->encode($_POST));
    }

    public function upload_tempfile()
    {
        $this->load->library('file');
        $json['error'] = 'no';
        $json['success'] = TRUE;

        $this->file->init(array(
            'upload_dir_name' => 'temp',
            'overwrite' => FALSE
        ));

        try
        {
            $file_name = $this->input->post('file_name');
            if(!$this->file->upload_file('file', $file_name))
            {
                throw new Exception(implode('<br/>', $this->file->errors));
            }
            $json['file_data'] = $this->file->data;
        }
        catch (Exception $exc)
        {
            $json['error'] = 'yes';
            $json['message'] = $exc->getMessage();
        }
        $this->file->clear();

        $this->output->_display($this->fastjson->encode($json));
    }

}

