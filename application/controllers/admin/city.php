<?php

class City extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'city';
        $this->auth->is_authorized($module);
        $this->load->model(array('city_model','country_model','state_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('city/index/');        
        $this->data['limit'] = 10;
    }

	public function export_to_file()
	{
		$this->load->library('excel');
        
        $rows = $this->city_model->get_rows(array(            
            'callback' => array('join_countries','join_states')
            )
        );        
        $titles = array(
            'city_name' => __('City Name'),
            'country_name' => __('Country Name'),
            'state_name' => __('State Name')            
        );
        $this->excel->export($titles, $rows);       
	}
	
    public function index()
    {		
        $this->data['edit_url'] = admin_url("city/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->data['dropdown_countries'] = $this->country_model->dropdown('country_id','country_name',
                array(
                    'order_by' => 'country_name ASC'
                )
        );
        
        $this->data['dropdown_states'] = $this->state_model->dropdown('state_id','state_name',
                array(
                    'order_by' => 'state_name ASC'
                )
        );        
        
        $this->template->view_parts('content', 'city/index_view', $this->data)
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
                'callback' => array('join_countries','join_states')
            );
            add_language_param($extra);
            $this->city_model->set_extra_from_url($extra);

            $json['rows'] = $this->city_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->city_model->get_count($extra);            
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
            $this->city_model->delete($this->id);

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
                'city_name' => $this->input->post('city_name', TRUE),
                'country_id' => $this->input->post('country_id', TRUE),
                'state_id' => $this->input->post('state_id', TRUE),
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();

                add_language_param($db_data);
                if(empty($this->id))
                {
                    $this->id = $this->city_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->city_model->update($this->id, $db_data);
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
                    js_close_modal('cityModal');
                }
                elseif(is_ajax())
                {
                    $row = $this->city_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->city_id,
                        'value' => $row->city_id,
                        'text' => $row->city_name,
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

            if(is_ajax())
            {
                $this->output->_display($this->fastjson->encode($json));
                exit;
            }
        }        
        
        $this->data['row'] = $this->city_model->get_row_by_id($this->id, array());

        if(is_ajax())
        {
            if($_POST)
            {
                $json['error'] = 'yes';
                $json['message'] = form_alert_admin();
                $this->output->_display($this->fastjson->encode($json));
                return FALSE;
            }
            $this->template->view_parts('content', 'city/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'city/edit_view', $this->data);
        }     
        
        $this->template
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];
        
        $this->data['dropdown_country_id'] = $this->country_model->dropdown('COUNTRY_ID', 'COUNTRY_NAME',array(
            'order_by' => array('country_name ASC')
        ));
        $this->data['dropdown_state_id'] = $this->state_model->dropdown('STATE_ID', 'STATE_NAME',array(
            'order_by' => array('state_name ASC')
        ));

        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'city_name',
                'label' => __('City Name'),
                'rules' => 'trim|max_length[255]|required'
            ),
            array(
                'field' => 'country_id',
                'label' => __('Country'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'state_id',
                'label' => __('State'),
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