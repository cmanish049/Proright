<?php

class Auth_user_group extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $module = 'auth_user_group';
        $this->auth->is_authorized($module);
        //$this->load->model(array('auth_user_group_model'));
        $this->load->library('tree');
        
        $this->data['limit'] = 10;
        $this->data['module'] = $this->auth->get_module($module);
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('auth_user_group/index/');
        $this->data['window'] = element('window', $this->uri_assoc);
    }

    public function index()
    {
        $this->data['edit_url'] = admin_url("auth_user_group/edit/window/modal");
        $this->data['page_title'] = $this->data['module']['module_plural_label'];

        $option = array(
            'per_page' => $this->data['limit'],
            'url' => admin_url('auth_user_group/grid/') . query_string(),
            'width' => '100%',
            'col_sort_params' => "'','GROUP_NAME','ACTIVE'",
            'col_widths' => "'100px','45%','45%'",
            'unsortable_cols' => "",
            'id' => 'auth_user_groupGrid',
            'data_type' => 'json'
        );
        $grid_script = js_grid($option);

        $this->template->view_parts('content', 'auth_user_group/index_view', $this->data)
                ->title('auth_user_group')
                ->script($grid_script)
                ->build();
    }

    public function grid()
    {
        $extra = array(
            'limit' => $this->data['limit']
        );
        add_language_param($extra);
        $this->auth_user_group_model->set_extra_from_url($extra);

        $this->data['rows'] = $this->auth_user_group_model->get_rows($extra);
        $json['html'] = $this->template->build('auth_user_group/grid_view', $this->data, TRUE);

        unset($extra['limit'], $extra['offset'], $extra['callback']);
        $json['total'] = $this->auth_user_group_model->get_count($extra);

        echo $this->fastjson->encode($json);
    }

    public function delete()
    {
        $json['error'] = 'no';
        use_try_catch();
        try
        {
            $this->db->trans_start();
            $this->auth_user_group_model->delete($this->id);

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
                'GROUP_NAME' => $this->input->post('group_name', TRUE),
                'ACTIVE' => $this->input->post('active', TRUE),
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();

                add_language_param($db_data); 
                if(empty($this->id))
                {
                    $this->id = $this->auth_user_group_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->auth_user_group_model->update($this->id, $db_data);
                }

                ##############################################################################
                //Kullanıcıları ilişki tablosuna bas
                $users = $this->input->post('user_id', TRUE);
                $this->auth_ug_user_relationship_model->delete_where(array('GROUP_ID' => $this->id));
                if($this->id > 0 && !empty($users))
                {
                    foreach($users as $e)
                    {
                        $this->auth_ug_user_relationship_model->insert(
                                array(
                                    'USER_ID' => $e,
                                    'GROUP_ID' => $this->id
                                )
                        );
                    }
                }
                ##############################################################################
                ##############################################################################
                //Modülleri ilişi tablosuna at
                $modules = $this->input->post('module_id', TRUE);
                $this->auth_ug_module_relationship_model->delete_where(array('GROUP_ID' => $this->id));
                if($this->id > 0 && !empty($modules))
                {
                    foreach($modules as $e)
                    {
                        $this->auth_ug_module_relationship_model->insert(
                                array(
                                    'MODULE_ID' => $e,
                                    'GROUP_ID' => $this->id
                                )
                        );
                    }
                }
                ##############################################################################
                //
                # if there is an error in database processes
                if($this->db->trans_status() === FALSE)
                {
                    throw new Exception(__('Unknown error was occured'));
                }

                #end transaction, has error it will be rollback
                $this->db->trans_complete();

                if($this->data['window'] == 'modal')
                {
                    js_close_modal('auth_user_groupModal');
                }
                elseif(is_ajax())
                {
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

                $this->data['error'] = "File : {$exc->getFile()}<br/>";
                $this->data['error'] .= "Line : {$exc->getLine()}<br/>";
                $this->data['error'] .= "Message : {$exc->getMessage()}<br/>";
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
        $this->data['row'] = $this->auth_user_group_model->get_row_by_id($this->id, array());


        $this->template->view_parts('content', 'auth_user_group/form_view', $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'] . ' ' . __('New/Edit');

        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
        
        $this->data['admins'] = $this->user_model->get_rows(
                array(
                    'select' => 'USER_ID, FULL_NAME, USERNAME, FIRST_NAME, LAST_NAME',
                    'IS_ADMIN' => 'yes',
                    'ACTIVE' => 'yes'
                )
        );

        $this->data['users_id'] = $this->auth_ug_user_relationship_model->get_rows(
                array('select' => 'USER_ID', 'GROUP_ID' => $this->id)
        ); 
        
        $this->data['modules'] = $this->auth_module_model->get_rows(array(
            'order_by' => 'MODULE_NAME ASC',            
            'SHOW_IN_FORM' => 'yes',
            'ACTIVE' => 'yes'
        ));        
        $this->data['modules_id'] = $this->auth_ug_module_relationship_model->get_rows(
                array('GROUP_ID' => $this->id, 'select' => 'MODULE_ID')
        );
        $tree_options = array(
            'base_field' => 'module_id',
            'parent_field' => 'parent_id',
            'base_ul_attrs' => array('class' => 'nav nav-tabs nav-stacked tree-list')
        );
        $func_params = array('checked_values'=>$this->data['modules_id']);
        $this->tree->initialize($tree_options);
        $this->tree->set_template('callback_tree_for_module_list_in_user_group_form',$func_params);
        $this->data['module_tree'] = $this->tree->generate_tree($this->data['modules']);
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'group_name',
                'label' => 'Group Name',
                'rules' => 'trim|max_length[255]|required'
            ),
            array(
                'field' => 'active',
                'label' => 'Active',
                'rules' => 'trim|required'
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
