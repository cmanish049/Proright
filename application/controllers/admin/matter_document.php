<?php

class Matter_document extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'matter_document';
        $this->auth->is_authorized($module);
        $this->load->model(array('matter_document_model', 'status_model', 'matter_doc_type_model','matter_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('matter_document/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("matter_document/edit/window/modal") . query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'matter_document/index_view', $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    public function grid()
    {
        $json['error'] = 'no';
        $json['message'] = '';
        use_try_catch();
        try
        {
            $extra = array(
                'limit' => $this->data['limit'],
                'callback' => array(
                    'join_client',
                    'join_matters',
                    'join_matter_doc_types',
                    'join_doc_status',
                    'join_inserter',
                )
            );
            $this->matter_document_model->set_extra_from_url($extra);

            $json['rows'] = $this->matter_document_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->matter_document_model->get_count($extra);
        }
        catch (AF_exception $exc)
        {
            $json['error'] = 'yes';
            $json['message'] = $exc->getMessage();
        }

        $this->output->_display($this->fastjson->encode($json));
    }

    public function download()
    {
        $doc = $this->matter_document_model->get_row_by_id($this->id);
        if(empty($doc))
        {
            show_404();
        }
        
        $this->load->helper('download');
        $data = file_get_contents($doc->doc_file_path); // Read the file's contents
        $name = $doc->doc_file_name;
        force_download($name, $data);
    }


    public function delete()
    {
        $json['error'] = 'no';
        use_try_catch();
        try
        {
            $this->db->trans_start();
            $this->matter_document_model->delete($this->id);

            # if there is an error in database processes
            if($this->db->trans_status() === FALSE)
            {
                throw new Exception(__('Unknown error was occured'));
            }

            #end transaction, has error it will be rollback
            $this->db->trans_complete();
        }
        catch (Exception $exc)
        {
            $this->db->trans_rollback();

            $json['error'] = 'yes';
            $json['message'] = $exc->getMessage();
        }

        $this->output->_display($this->fastjson->encode($json));
    }

    public function edit()
    {
        $this->load->library('file');
        $this->_set_form_data();

        $json['error'] = 'no';
        if($this->_form_validation() === TRUE)
        {
            $db_data = array(
                'doc_type_id' => $this->input->post('doc_type_id', TRUE),
                'doc_status_id' => $this->input->post('doc_status_id', TRUE),
                'doc_file_path' => $this->input->post('doc_file_path', TRUE),
                'doc_name' => $this->input->post('doc_name', TRUE),
                'doc_file_name' => $this->input->post('doc_file_name', TRUE),
                'matter_id' => $this->input->post('matter_id', TRUE),
                'client_id' => $this->input->post('client_id', TRUE),
                'author' => $this->input->post('author', TRUE),
                'description' => $this->input->post('description', TRUE),
            );
            
            $temp_file_path = $this->input->post('temp_file_path', TRUE);
            use_try_catch();
            try
            {
                if(file_exists($temp_file_path))
                {
                    $new_file_path = 'upload/matter_docs_files';
                    $this->file->create_directories($new_file_path);

                    $db_data['doc_file_name'] = $this->file->new_file_name($db_data['doc_file_name'], $db_data['doc_name']);
                    $new_file_path = $new_file_path . '/' . $db_data['doc_file_name'];

                    if(!file_exists($temp_file_path))
                    {
                        throw new Exception('File did not exist');
                    }

                    if(!copy($temp_file_path, $new_file_path))
                    {
                        throw new Exception('File could not upload');
                    }
                    $db_data['doc_file_path'] = $new_file_path;
                }

                $this->db->trans_start();

                if(empty($this->id))
                {
                    $this->id = $this->matter_document_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->matter_document_model->update($this->id, $db_data);
                }

                # if there is an error in database processes
                if($this->db->trans_status() === FALSE)
                {
                    throw new Exception(__('Unknown error was occured'));
                }

                #end transaction, has error it will be rollback
                $this->db->trans_complete();

                if(is_ajax())
                {
                    $row = $this->matter_document_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->doc_id,
                        'value' => $row->doc_id,
                        'text' => '',
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('matter_documentModal');
                }
                else
                {
                    $this->session->set_flashdata('success', __('process is performed successfully'));
                    redirect(admin_url($this->uri->assoc_to_uri($this->uri_assoc)));
                }
            }
            catch (Exception $exc)
            {
                $this->db->trans_rollback();

                $this->data['error'] = $exc->getMessage();
                if(is_ajax())
                {
                    $json['error'] = 'yes';
                    $json['message'] = $this->data['error'];
                    $json['message_html'] = alert($this->data['error'], 'error');
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }

                //$this->session->set_flashdata('error', $this->data['error']);
                //redirect(admin_url($this->uri->assoc_to_uri($this->uri_assoc)));
            }
        }

        $row = $this->matter_document_model->get_row_by_id($this->id, array(
            'callback' => array(
                'join_client',
                'join_matters',
                'join_matter_doc_types',
                'join_doc_status'
            )
        ));
        $row OR $row = new stdClass();
        
        $matter = $this->matter_model->get_row_by_id($this->input->get('matter_id'));
        if(!empty($matter))
        {
            $row->matter_name = $matter->matter_name;
            $row->matter_id = $matter->matter_id;
        }
        
        $this->data['row'] =& $row;
        if(is_ajax())
        {
            if($_POST)
            {
                $json['error'] = 'yes';
                $json['message'] = form_alert_admin();
                $json['message_html'] = form_alert_admin();
                $this->output->_display($this->fastjson->encode($json));
                return FALSE;
            }
            $this->template->view_parts('content', 'matter_document/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'matter_document/edit_view', $this->data);
        }

        load_jqueryFileUpload();
        $this->template
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['dropdown_doc_type_id'] = $this->matter_doc_type_model->dropdown('doc_type_id', 'doc_type_name', array('is_active' => 1));
        $this->data['dropdown_doc_status_id'] = $this->status_model->dropdown('status_id', 'status_name', array('is_active' => 1, 'status_type' => get_status_type_id('matter_doc_status')));

        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'doc_type_id',
                'label' => __('Doc Type'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'doc_status_id',
                'label' => __('Doc Status'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'doc_file_path',
                'label' => __('Doc Path'),
                'rules' => 'trim|max_length[255]'
            ),
            array(
                'field' => 'doc_name',
                'label' => __('Doc Name'),
                'rules' => 'trim|max_length[255]|required'
            ),
            array(
                'field' => 'matter_id',
                'label' => __('Matter'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'client_id',
                'label' => __('Client'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'author',
                'label' => __('Author'),
                'rules' => 'trim|max_length[255]'
            ),
            array(
                'field' => 'description',
                'label' => __('Description'),
                'rules' => 'trim'
            ),
        );

        $this->validation = array_merge($this->validation, $validation);
        $this->form_validation->set_rules($this->validation);

        if($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }

        return TRUE;
    }

}
