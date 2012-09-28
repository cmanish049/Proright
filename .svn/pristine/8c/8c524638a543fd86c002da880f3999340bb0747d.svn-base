<?php

class Status extends Admin_Controller
{
    public $status_types = array(
        'matter_document_status' => 1,
        'matter_exhibit_status' => 2,
        'matter_fact_status' => 3
    );
    public $status_type;
    public $status_type_id;

    public function __construct()
    {
        parent::__construct();

        $this->status_types = config_item('status_types');
        $this->status_type = $this->input->get('status_type',TRUE);
        $this->status_type_id = get_status_type_id($this->status_type);

        $module = $this->status_type;
        $this->auth->is_authorized($module);
        $this->load->model(array('status_model'));

        
        $this->data['status_type'] = $this->status_type;
        $this->data['status_type_id'] = $this->status_type_id;
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('status/index') . query_string(array('status_type' => $this->status_type), NULL, FALSE);
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("status/edit/window/modal") . query_string(array('status_type' => $this->status_type), NULL, FALSE);
        $this->data['grid_url'] = admin_url("status/grid") . query_string(array('status_type' => $this->status_type), NULL, FALSE);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'status/index_view', $this->data)
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
                'status_type' => $this->status_type_id
            );
            add_language_param($extra);
            $this->status_model->set_extra_from_url($extra);

            $json['rows'] = $this->status_model->get_rows($extra);
            $json['sql'] = $this->db->last_query();

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->status_model->get_count($extra);
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
            $this->status_model->delete($this->id);

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
                'status_name' => $this->input->post('status_name', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
                'status_type' => $this->status_type_id,
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();

                add_language_param($db_data);
                if(empty($this->id))
                {
                    $this->id = $this->status_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->status_model->update($this->id, $db_data);
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
                    js_close_modal('statusModal');
                }
                elseif(is_ajax())
                {
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('success', __('process is performed successfully'));
                    redirect(
                            admin_url($this->uri->assoc_to_uri($this->uri_assoc))
                            . query_string(array('status_type' => $this->status_type), NULL, FALSE)
                    );
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
                redirect(
                        admin_url($this->uri->assoc_to_uri($this->uri_assoc))
                        . query_string(array('status_type' => $this->status_type), NULL, FALSE)
                );
            }

            if(is_ajax())
            {
                $this->output->_display($this->fastjson->encode($json));
                exit;
            }
        }
        $this->data['row'] = $this->status_model->get_row_by_id($this->id, array());


        $this->template->view_parts('content', 'status/form_view', $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['form_action'] = current_url() . query_string(array('status_type' => $this->status_type), NULL, FALSE);
        $this->data['redirect'] = current_url() . query_string();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'status_name',
                'label' => __('Status Name'),
                'rules' => 'trim|max_length[255]|required'
            ),
            array(
                'field' => 'is_active',
                'label' => __('Is Active'),
                'rules' => 'trim|numeric|required'
            ),
            /*array(
                'field' => 'status_type',
                'label' => __('Status Type'),
                'rules' => 'trim|max_length[30]|required'
            ),*/
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
