<?php

class Auth_module extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $module = 'auth_module';
        $this->auth->is_authorized($module);
        $this->load->model(array('auth_module_model'));
        
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('auth_module/index/');        
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("auth_module/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'auth_module/index_view', $this->data)
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
            $this->auth_module_model->set_extra_from_url($extra);        

            $json['rows'] = $this->auth_module_model->get_rows($extra);

            unset($extra['limit'],$extra['offset'],$extra['callback']);
            $json['total'] = $this->auth_module_model->get_count($extra);
        }
        catch (AF_exception $exc) 
        {
            $json['error'] = 'yes';
            $json['message'] = $exc->getMessage();
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
            $this->auth_module_model->delete($this->id);
            
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
            $json['error'] = $exc->getMessage();
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
            'upload_dir_name' => 'auth_module',
            'overwrite' => FALSE
        ));

        if($this->file->upload_file('image', $image_name))
        {
            $db_data = array('file_title' => $image_name);
            $image_id = $this->file->insert($db_data);
            $this->auth_module_model->update($id, array('image_id' => $image_id));
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
                'MODULE_CODE' => $this->input->post('module_code', TRUE),
'MODULE_NAME' => $this->input->post('module_name', TRUE),
'MODULE_SINGLE_LABEL' => $this->input->post('module_single_label', TRUE),
'MODULE_PLURAL_LABEL' => $this->input->post('module_plural_label', TRUE),
'PARENT_ID' => $this->input->post('parent_id', TRUE),
'MODULE_URL' => $this->input->post('module_url', TRUE),
'ACTIVE' => $this->input->post('active', TRUE),
'SHOW_IN_MENU' => $this->input->post('show_in_menu', TRUE),
'SHOW_IN_FORM' => $this->input->post('show_in_form', TRUE),
'SEQUENCE_NUMBER' => $this->input->post('sequence_number', TRUE),

            );
            
            use_try_catch();
            try 
            {       
                $this->db->trans_start();
                
                add_language_param($db_data); 
                if(empty($this->id))
                {
                    $this->id = $this->auth_module_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->auth_module_model->update($this->id, $db_data);
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
                    js_close_modal('auth_moduleModal');
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
                
                $this->data['error'] = $exc->getMessage();
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
        $this->data['row'] = $this->auth_module_model->get_row_by_id($this->id, array());

        
        $this->template->view_parts('content', 'auth_module/form_view', $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['dropdown_parent_id'] = $this->auth_module_model->dropdown('module_id','module_name');
        
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
            'field' => 'module_code',
            'label' => 'Module Code',
            'rules' => 'trim|max_length[50]|required'
        ),
array(
            'field' => 'module_name',
            'label' => 'Module Name',
            'rules' => 'trim|max_length[255]|required'
        ),
array(
            'field' => 'module_single_label',
            'label' => 'Module Single Label',
            'rules' => 'trim|max_length[255]|required'
        ),
array(
            'field' => 'module_plural_label',
            'label' => 'Module Plural Label',
            'rules' => 'trim|max_length[255]'
        ),
array(
            'field' => 'parent_id',
            'label' => 'Parent Id',
            'rules' => 'trim|numeric'
        ),
array(
            'field' => 'module_url',
            'label' => 'Module Url',
            'rules' => 'trim|max_length[255]'
        ),
array(
            'field' => 'active',
            'label' => 'Active',
            'rules' => 'trim|required'
        ),
array(
            'field' => 'show_in_menu',
            'label' => 'Show In Menu',
            'rules' => 'trim|required'
        ),
array(
            'field' => 'show_in_form',
            'label' => 'Show In Form',
            'rules' => 'trim|required'
        ),
array(
            'field' => 'sequence_number',
            'label' => 'Sequence Number',
            'rules' => 'trim|numeric'
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
