<?php

class Matter_doc_type extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $module = 'matter_doc_type';
        $this->auth->is_authorized($module);
        $this->load->model(array('matter_doc_type_model'));
        
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('matter_doc_type/index/');        
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("matter_doc_type/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'matter_doc_type/index_view', $this->data)
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
                'limit' => $this->data['limit']
            );
            add_language_param($extra);
            $this->matter_doc_type_model->set_extra_from_url($extra);        

            $json['rows'] = $this->matter_doc_type_model->get_rows($extra);

            unset($extra['limit'],$extra['offset']);
            $json['total'] = $this->matter_doc_type_model->get_count($extra);
        }
        catch (AF_exception $exc) 
        {
            $json['error'] = 'yes';
            $json['message'] = $exc->errorMessage();
        }      
        
        $this->output->_display($this->fastjson->encode($json));
    }

    public function delete()
    {
        $json['error'] = 'no';
        use_try_catch();
        try 
        {
            $this->db->trans_start();
            $this->matter_doc_type_model->delete($this->id);
            
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
    
    /*
    private function _upload_image($id='', $image_name='')
    {
        $image_id = 0;
        if(!$id || !array_key_exists('image', $_FILES) || $_FILES['image']['error'] == '4')
        {
            return $image_id;
        }
        
        $this->file->init(array(
            'upload_dir_name' => 'matter_doc_type',
            'overwrite' => FALSE
        ));

        if($this->file->upload_file('image', $image_name))
        {
            $db_data = array('file_title' => $image_name);
            $image_id = $this->file->insert($db_data);
            $this->matter_doc_type_model->update($id, array('image_id' => $image_id));
        }
        else
        {
            throw new Exception(implode('<br/>', $this->file->errors));
        }
        
        $this->file->clear();
        return $image_id;
    }
    */
    
    public function edit()
    {
        $this->_set_form_data();

        $json['error'] = 'no';
        if($this->_form_validation() === TRUE)
        {
            $db_data = array(
                'doc_type_name' => $this->input->post('doc_type_name', TRUE),
'is_active' => $this->input->post('is_active', TRUE),

            );
            
            use_try_catch();
            try 
            {       
                $this->db->trans_start();
                
                add_language_param($db_data); 
                if(empty($this->id))
                {
                    $this->id = $this->matter_doc_type_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->matter_doc_type_model->update($this->id, $db_data);
                }
                       
                # if there is an error in database processes
                if($this->db->trans_status() === FALSE)
                {
                    throw new Exception(__('Unknown error was occured'));
                }

                #end transaction, has error it will be rollback
                $this->db->trans_complete();   
                
                if($this->data['window'] == 'modal')
                {
                    js_close_modal('matter_doc_typeModal');
                }
                elseif(is_ajax())
                {
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
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
                
                $this->data['error'] = $exc->errorMessage();
                if(is_ajax())
                {
                    $json['error'] = 'yes';
                    $json['message'] = $this->data['error'];
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }

                $this->session->set_flashdata('error', $this->data['error']);
                redirect(admin_url($this->uri->assoc_to_uri($this->uri_assoc)));
            }            
            
            if (is_ajax()) 
            {
                $this->output->_display($this->fastjson->encode($json));
                exit;
            }
        }
        $this->data['row'] = $this->matter_doc_type_model->get_row_by_id($this->id, array());

        
        $this->template->view_parts('content', 'matter_doc_type/form_view', $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
            'field' => 'doc_type_name',
            'label' => __('Doc Type Name'),
            'rules' => 'trim|max_length[255]|required'
        ),
array(
            'field' => 'is_active',
            'label' => __('Is Active'),
            'rules' => 'trim|numeric|required'
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
