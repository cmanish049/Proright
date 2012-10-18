<?php

class Email_template extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'email_template';
        $this->auth->is_authorized($module);
        $this->load->model(array('email_template_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('email_template/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("email_template/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'email_template/index_view', $this->data)
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
            $this->email_template_model->set_extra_from_url($extra);

            $json['rows'] = $this->email_template_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->email_template_model->get_count($extra);
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
            $this->email_template_model->delete($this->id);

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
                'email_template_name' => $this->input->post('email_template_name', TRUE),
                'email_template_subject' => $this->input->post('email_template_subject', TRUE),
                'email_template_body' => $this->input->post('email_template_body', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();

                //$db_data['email_template_body'] = decode_html($db_data['email_template_body']);
                if(empty($this->id))
                {
                    $this->id = $this->email_template_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->email_template_model->update($this->id, $db_data);
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
                    js_close_modal('email_templateModal');
                }
                elseif(is_ajax())
                {
                    $row = $this->email_template_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->email_template_id,
                        'value' => $row->email_template_id,
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
        }

        $this->data['row'] = $this->email_template_model->get_row_by_id($this->id, array());

        if(is_ajax())
        {
            if($_POST)
            {
                $json['error'] = 'yes';
                $json['message'] = form_alert_admin();
                $this->output->_display($this->fastjson->encode($json));
                return FALSE;
            }
            $this->template->view_parts('content', 'email_template/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'email_template/edit_view', $this->data);
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
                'field' => 'email_template_name',
                'label' => __('Email Template Name'),
                'rules' => 'trim|max_length[255]|required'
            ),
            array(
                'field' => 'email_template_subject',
                'label' => __('Email Template Subject'),
                'rules' => 'trim|max_length[255]'
            ),
            array(
                'field' => 'email_template_body',
                'label' => __('Email Template Body'),
                'rules' => 'trim|required'
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
