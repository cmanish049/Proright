<?php

class Event extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'event';
        $this->auth->is_authorized($module);
        $this->load->model(array('event_model', 'event_category_model', 'event_priority_model', 'event_subject_model',
            'location_model', 'status_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('event/index/');
        $this->data['limit'] = 10;
    }
    
    public function events()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        
        $start_time = mysql_datetime($start);
        $end_time = mysql_datetime($end);
        
        $rows = $this->event_model->get_rows(array(
            'begin_date >=' => $start_time,
            //'end_date >=' => $end_time,
            'callback' => array(
                'join_event_subjects',
                'join_event_categories'
            )
        ));
        
        $events = array();
        foreach($rows as $e)
        {
            $events[] = array(
                'id' => $e->event_id,
                'event_id' => $e->event_id,
                'title' => $e->subject,
                'start' => $e->begin_date,
                'end' => $e->end_date,
                //'className' => '',
                'editable' => true,
                //'icon_path' => 'upload/event_category/sep11.png',
                'category_name' => $e->category_name,
                'color' => $e->category_color,
                'textColor' => 'white'
                //'backgroundColor' => 'yellow',
                //'borderColor' => 'green'
            );
        }
        
        $this->output->_display($this->fastjson->encode($events));
    }


    public function calendar()
    {
        $this->data['page_title'] = _('Calendar');
        load_jqueryCalendar();
        $this->template->view_parts('content', 'event/calendar_view', $this->data)
                ->title('Events')
                ->build();
    }


    public function index()
    {
        $this->data['edit_url'] = admin_url("event/edit/window/modal") . query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->data['dropdown_categories'] = $this->event_category_model->dropdown('category_id','category_name');
        $this->data['dropdown_priorities'] = $this->event_priority_model->dropdown('priority_id','priority_name');
        $this->data['dropdown_event_status'] = $this->status_model->dropdown('status_id','status_name',array('status_type'=>  get_status_type_id('event_status')));
        
        $this->template->view_parts('content', 'event/index_view', $this->data)
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
                    'join_event_categories',
                    'join_event_subjects',
                    'join_locations',
                    'join_event_priorities',
                    'join_event_status',
                    'join_matters',
                    'join_client',
                    'join_inserter'
                )
            );
            $this->event_model->set_extra_from_url($extra);

            $json['rows'] = $this->event_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->event_model->get_count($extra);
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
        $json['id'] = $this->id;
        use_try_catch();
        try
        {
            $this->db->trans_start();
            $this->event_model->delete($this->id);

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
                'category_id' => $this->input->post('category_id', TRUE),
                'is_all_day' => $this->input->post('is_all_day', TRUE),
                'begin_date' => $this->input->post('begin_date', TRUE),
                'end_date' => $this->input->post('end_date', TRUE),
                'subject_id' => $this->input->post('subject_id', TRUE),
                'description' => $this->input->post('description', TRUE),
                'event_location_id' => $this->input->post('event_location_id', TRUE),
                'priority_id' => $this->input->post('priority_id', TRUE),
                'event_status_id' => $this->input->post('event_status_id', TRUE),
                'matter_id' => $this->input->post('matter_id', TRUE),
                'client_id' => $this->input->post('client_id', TRUE),
                'is_private' => $this->input->post('is_private', TRUE),
            );           
            
            use_try_catch();
            try
            {
                $begin_date = $db_data['begin_date'];
                $begin_time = $this->input->post('begin_time', TRUE);
                $end_date = $db_data['end_date'];
                $end_time = $this->input->post('end_time', TRUE);
                $db_data['begin_date'] = $begin_date . ' ' . $begin_time;
                $db_data['end_date'] = $end_date . ' ' . $end_time;
                
                $this->db->trans_start();

                if(empty($this->id))
                {
                    $this->id = $this->event_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->event_model->update($this->id, $db_data);
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
                    $row = $this->event_model->get_row_by_id($this->id,array(
                        'callback' => array('join_event_subjects','join_event_categories')
                    ));
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->event_id,
                        'value' => $row->event_id,
                        'text' => $row->subject
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('eventModal');
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

        $row = $this->event_model->get_row_by_id($this->id, array(
            'callback' => array(
                'join_matters',
                'join_client'   
            )         
        ));
        $this->data['row'] =& $row;        
        $row OR $row = new stdClass();
        
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        if($start)
        {
            $row->begin_date = mysql_datetime($start);
        }
        if($end)
        {
            $row->end_date = mysql_datetime($end);
        }
        
        if(!empty($row))
        {
            $time = strtotime($row->begin_date);
            $row->begin_time = date('H:i', $time);
            
            $time = strtotime($row->end_date);
            $row->end_time = date('H:i', $time);            
        }
        
        
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
            $this->template->view_parts('content', 'event/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'event/edit_view', $this->data);
        }

        $this->template
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->data['dropdown_category_id'] = $this->event_category_model->dropdown('category_id', 'category_name', array('is_active' => 1));
        $this->data['dropdown_subject_id'] = $this->event_subject_model->dropdown('subject_id', 'subject', array('is_active' => 1));
        $this->data['dropdown_event_location_id'] = $this->location_model->dropdown('location_id', 'location_name', array('is_active' => 1));
        $this->data['dropdown_priority_id'] = $this->event_priority_model->dropdown('priority_id', 'priority_name', array('is_active' => 1));
        $this->data['dropdown_event_status_id'] = $this->status_model->dropdown('status_id', 'status_name', array(
            'is_active' => 1,
            'status_type' => get_status_type_id('event_status')
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
                'field' => 'category_id',
                'label' => __('Category'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'is_all_day',
                'label' => __('Is All Day'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'begin_date',
                'label' => __('Begin Date'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'end_date',
                'label' => __('End Date'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'subject_id',
                'label' => __('Subject'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'description',
                'label' => __('Description'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'event_location_id',
                'label' => __('Event Location'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'priority_id',
                'label' => __('Priority'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'event_status_id',
                'label' => __('Event Status'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'matter_id',
                'label' => __('Matter'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'client_id',
                'label' => __('Client'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'is_private',
                'label' => __('Private'),
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
