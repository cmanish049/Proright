<?php

class Event_category extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'event_category';
        $this->auth->is_authorized($module);
        $this->load->model(array('event_category_model'));

        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('event_category/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {        
        $this->data['edit_url'] = admin_url("event_category/edit/window/modal") . query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $this->template->view_parts('content', 'event_category/index_view', $this->data)
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
            $this->event_category_model->set_extra_from_url($extra);

            $json['rows'] = $this->event_category_model->get_rows($extra);

            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->event_category_model->get_count($extra);
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
            $this->event_category_model->delete($this->id);

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
        $this->load->library('file');
        $this->_set_form_data();

        $json['error'] = 'no';
        if($this->_form_validation() === TRUE)
        {
            $db_data = array(
                'category_name' => $this->input->post('category_name', TRUE),
                'category_color' => $this->input->post('category_color', TRUE),
                'icon_path' => $this->input->post('icon_path', TRUE),
            );

            use_try_catch();
            try
            {
                $temp_file_path = $this->input->post('temp_file_path', TRUE);
                if($temp_file_path)
                {
                    $new_file_path = 'upload/event_category/';
                    $this->file->create_directories($new_file_path);//if directories is not exist create them
                    $new_file_path .= basename($temp_file_path);                                        

                    if(!file_exists($temp_file_path))
                    {
                        throw new Exception('File did not exist');
                    }

                    if(!copy($temp_file_path, $new_file_path))
                    {
                        throw new Exception('File could not upload');
                    }
                    $db_data['icon_path'] = $new_file_path;
                }
                    
                $this->db->trans_start();

                if(empty($this->id))
                {
                    $this->id = $this->event_category_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->event_category_model->update($this->id, $db_data);
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
                    $row = $this->event_category_model->get_row_by_id($this->id);
                    $json['row'] = $row;
                    $json['item'] = array(
                        'id' => $row->category_id,
                        'value' => $row->category_id,
                        'text' => $row->category_name,
                    );
                    $this->output->_display($this->fastjson->encode($json));
                    exit;
                }
                elseif($this->data['window'] == 'modal')
                {
                    js_close_modal('event_categoryModal');
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

        $this->data['row'] = $this->event_category_model->get_row_by_id($this->id, array());

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
            $this->template->view_parts('content', 'event_category/form_view', $this->data);
        }
        else
        {
            $this->template->view_parts('content', 'event_category/edit_view', $this->data);
        }

        load_jqueryFileUpload();
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
                'field' => 'category_name',
                'label' => __('Category Name'),
                'rules' => 'trim|max_length[100]|required'
            ),
            array(
                'field' => 'category_color',
                'label' => __('Category Color'),
                'rules' => 'trim|max_length[10]'
            ),
            array(
                'field' => 'icon_path',
                'label' => __('Icon Path'),
                'rules' => 'trim|max_length[255]'
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
