<?php

class State extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $module = 'state';
        $this->auth->is_authorized($module);
        $this->load->model(array('state_model','country_model'));
        
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('state/index/');        
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("state/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->data['dropdown_countries'] = $this->country_model->dropdown('country_id','country_name',
                array(
                    'order_by' => 'country_name ASC'
                )
        );
        
        $this->template->view_parts('content', 'state/index_view', $this->data)
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
                'callback' => array('join_countries')
            );
            add_language_param($extra);
            $this->state_model->set_extra_from_url($extra);        

            $json['rows'] = $this->state_model->get_rows($extra);

            unset($extra['limit'],$extra['offset'],$extra['callback']);
            $json['total'] = $this->state_model->get_count($extra);
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
            $this->state_model->delete($this->id);
            
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
    
    public function edit()
    {
        $this->_set_form_data();

        $json['error'] = 'no';
        if($this->_form_validation() === TRUE)
        {
            $db_data = array(
                'STATE_NAME' => $this->input->post('state_name', TRUE),
'COUNTRY_ID' => $this->input->post('country_id', TRUE),

            );
            
            use_try_catch();
            try 
            {       
                $this->db->trans_start();
                
                add_language_param($db_data); 
                if(empty($this->id))
                {
                    $this->id = $this->state_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->state_model->update($this->id, $db_data);
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
                    js_close_modal('stateModal');
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
        $this->data['row'] = $this->state_model->get_row_by_id($this->id, array());

        
        $this->template->view_parts('content', 'state/form_view', $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['dropdown_country_id'] = $this->country_model->dropdown('country_id', 'country_name');
        
        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
            'field' => 'state_name',
            'label' => 'State Name',
            'rules' => 'trim|max_length[255]|required'
        ),
array(
            'field' => 'country_id',
            'label' => 'Country Id',
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
