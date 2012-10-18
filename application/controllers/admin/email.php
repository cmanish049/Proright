<?php

class Email extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'email';
        $this->auth->is_authorized($module);
        $this->load->model(array('email_model','email_sending_model','email_template_model','matter_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('email/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("email/edit/window/modal") . query_string();;
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'email/index_view', $this->data)
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
            $this->email_model->set_extra_from_url($extra);

            $json['rows'] = $this->email_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->email_model->get_count($extra);
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
            $this->email_model->delete($this->id);

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
            $this->load->library('email');
            $this->load->helper('email');
                
            $db_data = array(
                'matter_id' => $this->input->post('matter_id', TRUE),
                //'receiver_id' => $this->input->post('receiver_id', TRUE),
                //'email_to' => $this->input->post('email_to', TRUE),
                'email_subject' => $this->input->post('email_subject', TRUE),
                'email_body' => $this->input->post('email_body', TRUE),
                //'is_successful' => $this->input->post('is_successful', TRUE),
                'email_template_id' => $this->input->post('email_template_id', TRUE),
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();
                                                             
                if(empty($this->id))
                {
                    $this->id = $this->email_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->email_model->update($this->id, $db_data);
                }                                                                                
                
                $_POST['receiver_id'] = explode(',', $this->input->post('receiver_id'));   
                #$receiver_id is an array
                $receiver_id = $this->input->post('receiver_id');                
                $receivers = $this->user_model->get_rows(array(
                    'user_id__in' => $receiver_id
                )); 
                
                if (empty($receivers))
                {
                    throw new Exception(__('Please add receivers'));
                }
                
                $matter = $this->matter_model->get_row_by_id($db_data['matter_id']);
                foreach($receivers as $e)
                {
                    $this->email->clear();
                    
                    $body_datas = array_merge((array)$e, (array)$matter);
                    $email_body = replace_dinamic_string($db_data['email_body'], $body_datas);
                                        
                    $this->email->from(config_item('email'), config_item('project_name'));
                    $this->email->to($e->email); 
                    //$this->email->cc('another@another-example.com'); 
                    //$this->email->bcc('them@their-example.com');                     
                    $this->email->subject($db_data['email_subject']);
                    $this->email->message($email_body);	
                    $is_successful = TRUE;
                    try
                    {
                        $is_successful = $this->email->send();
                    }
                    catch (Exception $exc)
                    {
                        $is_successful = FALSE;
                    }

                    #insert to database
                    $db_data = array(
                        'email_id' => $this->id,
                        'receiver_id' => $e->user_id,
                        'email_to' => $e->email,
                        'is_successful' => $is_successful===TRUE?1:0
                    );
                    $this->email_sending_model->insert($db_data);
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
                    $row = $this->email_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->email_id,
                        'value' => $row->email_id,
                        'text' => '',
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('emailModal');
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

        $row = $this->email_model->get_row_by_id($this->id, array());

        if (empty($row))
        {
            $row = new stdClass();
        }
        
        $matter = $this->matter_model->get_row_by_id($this->input->get('matter_id'));
        if(!empty($matter))
        {
            $row->matter_name = $matter->matter_name;
            $row->matter_id = $matter->matter_id;
        }
        
        $this->data['row'] = &$row;
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
            $this->template->view_parts('content', 'email/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'email/edit_view', $this->data);
        }

        $this->template
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];
        
        $this->data['email_templates'] = $this->email_template_model->get_rows(array('is_active' => 1,'order_by' => 'email_template_name ASC'));
        $this->data['dropdown_email_template_id'] = cift_boyuttan_tek_boyutlu_dizi('email_template_name', $this->data['email_templates'], 'email_template_id');        
        
        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'matter_id',
                'label' => __('Matter'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'receiver_id',
                'label' => __('Receiver'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'email_subject',
                'label' => __('Email Subject'),
                'rules' => 'trim|max_length[255]'
            ),
            array(
                'field' => 'email_body',
                'label' => __('Email Body'),
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'email_template_id',
                'label' => __('Email Template'),
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
