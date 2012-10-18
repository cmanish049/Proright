<?php

class Event_subject extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $module = 'event_subject';
        $this->auth->is_authorized($module);
        $this->load->model(array('event_subject_model'));
        
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('event_subject/index/');        
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("event_subject/edit/window/modal") . query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'event_subject/index_view', $this->data)
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
            $this->event_subject_model->set_extra_from_url($extra);        

            $json['rows'] = $this->event_subject_model->get_rows($extra);

            unset($extra['limit'],$extra['offset']);
            $json['total'] = $this->event_subject_model->get_count($extra);
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
            $this->event_subject_model->delete($this->id);
            
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
                'subject' => $this->input->post('subject', TRUE),
                'is_active' => $this->input->post('is_active', TRUE)
            );
            
            use_try_catch();
            try 
            {       
                $this->db->trans_start();
                                
                if(empty($this->id))
                {
                    $this->id = $this->event_subject_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->event_subject_model->update($this->id, $db_data);
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
                    $row = $this->event_subject_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->subject_id,
                        'value' => $row->subject_id,
                        'text' => $row->subject,
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('event_subjectModal');
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
        
        $this->data['row'] = $this->event_subject_model->get_row_by_id($this->id, array());
        
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
            $this->template->view_parts('content', 'event_subject/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'event_subject/edit_view', $this->data);
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
            'field' => 'subject',
            'label' => __('Subject'),
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
