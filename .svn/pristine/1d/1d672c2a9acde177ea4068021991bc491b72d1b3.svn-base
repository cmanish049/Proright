<?php

class Matter_linked_client extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'matter_linked_client';
        $this->auth->is_authorized($module);
        $this->load->model(array('matter_linked_client_model','matter_linked_client_type_model','matter_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('matter_linked_client/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("matter_linked_client/edit/window/modal").  query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'matter_linked_client/index_view', $this->data)
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
                    'join_matters',
                    'join_client',
                    'join_matter_linked_client_types',
                    'join_inserter'
                )
            );
            $this->matter_linked_client_model->set_extra_from_url($extra);
            $json['rows'] = $this->matter_linked_client_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->matter_linked_client_model->get_count($extra);
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
            $this->matter_linked_client_model->delete($this->id);

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
                'linked_type_id' => $this->input->post('linked_type_id', TRUE),
                'matter_id' => $this->input->post('matter_id', TRUE),
                'client_id' => $this->input->post('client_id', TRUE),
                'description' => $this->input->post('description', TRUE)
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();

                if(empty($this->id))
                {
                    $this->id = $this->matter_linked_client_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->matter_linked_client_model->update($this->id, $db_data);
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
                    $row = $this->matter_linked_client_model->get_row_by_id($this->id,array('callback' => array()));
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->linked_id,
                        'value' => $row->linked_id,
                        'text' => '',
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('matter_linked_clientModal');
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

        $row = $this->matter_linked_client_model->get_row_by_id($this->id, array(
            'callback' => array(
                    'join_matters',
                    'join_client',
                    'join_matter_linked_client_types',
                    'join_inserter'
                )
        ));        

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
        
        $this->data['row'] =& $row;
        if(is_ajax())
        {
            if($_POST)
            {
                $json['error'] = 'yes';
                $json['message'] = form_alert_admin();
                $this->output->_display($this->fastjson->encode($json));
                return FALSE;
            }
            $this->template->view_parts('content', 'matter_linked_client/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'matter_linked_client/edit_view', $this->data);
        }

        $this->template
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['dropdown_link_type_id'] = $this
                ->matter_linked_client_type_model
                ->dropdown('linked_type_id','linked_type_name',array('is_active' => 1));
        
        
        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'linked_type_id',
                'label' => __('Linked Type Id'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'matter_id',
                'label' => __('Matter Id'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'client_id',
                'label' => __('Client Id'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'description',
                'label' => __('Description'),
                'rules' => 'trim'
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
