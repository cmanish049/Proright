<?php

class Matter_note extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'matter_note';
        $this->auth->is_authorized($module);
        $this->load->model(array('matter_note_model','matter_note_type_model','matter_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('matter_note/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("matter_note/edit/window/modal") . query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'matter_note/index_view', $this->data)
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
                    'join_matter_note_types',
                    'join_inserter'
                )
            );
            $this->matter_note_model->set_extra_from_url($extra);

            $json['rows'] = $this->matter_note_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->matter_note_model->get_count($extra);
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
            $this->matter_note_model->delete($this->id);

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
                'note_type_id' => $this->input->post('note_type_id', TRUE),
                'note_date' => $this->input->post('note_date', TRUE),
                'description' => $this->input->post('description', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'minute' => $this->input->post('minute', TRUE),
                'matter_id' => $this->input->post('matter_id', TRUE),
                'client_id' => $this->input->post('client_id', TRUE),
                'operator_id' => $this->input->post('operator_id', TRUE),
                'is_private' => $this->input->post('is_private', TRUE)
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();

                if(empty($this->id))
                {
                    $this->id = $this->matter_note_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->matter_note_model->update($this->id, $db_data);
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
                    $row = $this->matter_note_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->note_id,
                        'value' => $row->note_id,
                        'text' => $row->description,
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('matter_noteModal');
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

        $row = $this->matter_note_model->get_row_by_id($this->id, array(
            'callback' => array(
                'join_matters',
                'join_client',
                'join_matter_note_types',
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
            $this->template->view_parts('content', 'matter_note/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'matter_note/edit_view', $this->data);
        }

        $this->template
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['dropdown_note_type_id'] = $this
                ->matter_note_type_model
                ->dropdown('note_type_id','note_type_name',array('is_active' => 1));
        
        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'note_type_id',
                'label' => __('Note Type Id'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'note_date',
                'label' => __('Note Date'),
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'description',
                'label' => __('Description'),
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'phone',
                'label' => __('Phone'),
                'rules' => 'trim|max_length[30]'
            ),
            array(
                'field' => 'minute',
                'label' => __('Minute'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'matter_id',
                'label' => __('Matter Id'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'client_id',
                'label' => __('Client Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'operator_id',
                'label' => __('Operator Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'is_private',
                'label' => __('Is Private'),
                'rules' => 'trim|numeric|required'
            )
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
