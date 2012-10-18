<?php

class  extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $module = '';
        $this->auth->is_authorized($module);
        $this->load->model(array('_model'));
        
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('/index/');        
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', '/index_view', $this->data)
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
            $this->_model->set_extra_from_url($extra);        

            $json['rows'] = $this->_model->get_rows($extra);

            unset($extra['limit'],$extra['offset']);
            $json['total'] = $this->_model->get_count($extra);
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
            $this->_model->delete($this->id);
            
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
        $this->_set_form_data();

        $json['error'] = 'no';
        if($this->_form_validation() === TRUE)
        {
            $db_data = array(
                'matter_type_id' => $this->input->post('matter_type_id', TRUE),
'matter_name' => $this->input->post('matter_name', TRUE),
'case_number' => $this->input->post('case_number', TRUE),
'court_case_number' => $this->input->post('court_case_number', TRUE),
'attorney_id' => $this->input->post('attorney_id', TRUE),
'court_id' => $this->input->post('court_id', TRUE),
'description' => $this->input->post('description', TRUE),
'open_date' => $this->input->post('open_date', TRUE),
'close_date' => $this->input->post('close_date', TRUE),
'is_closed' => $this->input->post('is_closed', TRUE),
'inserter_id' => $this->input->post('inserter_id', TRUE),
'insert_date' => $this->input->post('insert_date', TRUE),
'updater_id' => $this->input->post('updater_id', TRUE),
'update_date' => $this->input->post('update_date', TRUE),

            );
            
            use_try_catch();
            try 
            {       
                $this->db->trans_start();
                                
                if(empty($this->id))
                {
                    $this->id = $this->_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->_model->update($this->id, $db_data);
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
                    js_close_modal('Modal');
                }
                elseif(is_ajax())
                {
                    $row = $this->_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->MATTER_ID,
                        'value' => $row->MATTER_ID,
                        'text' => '',
                    );
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
        }
        
        $this->data['row'] = $this->_model->get_row_by_id($this->id, array());
        
        if(is_ajax())
        {
            if($_POST)
            {
                $json['error'] = 'yes';
                $json['message'] = form_alert_admin();
                $this->output->_display($this->fastjson->encode($json));
                return FALSE;
            }
            $this->template->view_parts('content', '/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', '/edit_view', $this->data);
        }                        
        
        $this->template
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
            'field' => 'matter_type_id',
            'label' => __('Matter Type Id'),
            'rules' => 'trim|numeric|required'
        ),
array(
            'field' => 'matter_name',
            'label' => __('Matter Name'),
            'rules' => 'trim|max_length[255]'
        ),
array(
            'field' => 'case_number',
            'label' => __('Case Number'),
            'rules' => 'trim|max_length[50]|required'
        ),
array(
            'field' => 'court_case_number',
            'label' => __('Court Case Number'),
            'rules' => 'trim|max_length[50]'
        ),
array(
            'field' => 'attorney_id',
            'label' => __('Attorney Id'),
            'rules' => 'trim|numeric'
        ),
array(
            'field' => 'court_id',
            'label' => __('Court Id'),
            'rules' => 'trim|numeric'
        ),
array(
            'field' => 'description',
            'label' => __('Description'),
            'rules' => 'trim'
        ),
array(
            'field' => 'open_date',
            'label' => __('Open Date'),
            'rules' => 'trim'
        ),
array(
            'field' => 'close_date',
            'label' => __('Close Date'),
            'rules' => 'trim'
        ),
array(
            'field' => 'is_closed',
            'label' => __('Is Closed'),
            'rules' => 'trim|numeric'
        ),
array(
            'field' => 'inserter_id',
            'label' => __('Inserter Id'),
            'rules' => 'trim|numeric'
        ),
array(
            'field' => 'insert_date',
            'label' => __('Insert Date'),
            'rules' => 'trim'
        ),
array(
            'field' => 'updater_id',
            'label' => __('Updater Id'),
            'rules' => 'trim|numeric'
        ),
array(
            'field' => 'update_date',
            'label' => __('Update Date'),
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
