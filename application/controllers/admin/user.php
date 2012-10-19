<?php

class User extends Admin_Controller
{
    private $view_dir;
    
    public function __construct()
    {
        parent::__construct();

        $module = $this->input->get('module');                
        $this->auth->is_authorized($module);
        $this->load->model(array('user_model','user_type_model','country_model','state_model'));

        $this->view_dir = $module;
        $this->data['module'] = $this->auth->get_module($module);                
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        $this->data['index_url'] = admin_url('user/index/');
        $this->data['limit'] = 10;
    }

    public function index()
    {        
        $this->data['edit_url'] = admin_url("user/edit/window/modal") . query_string();
        $this->data['page_title'] = $this->data['module']['module_plural_label'];
        
        $this->data['dropdown_user_types'] = $this->user_type_model->dropdown('user_type_id','user_type_name',array('is_actives' => 1));
        $this->data['dropdown_genders'] = config_item('genders');
        $this->data['dropdown_countries'] = $this->country_model->dropdown('country_id','country_name',array());
        $this->data['dropdown_states'] = $this->state_model->dropdown('state_id','state_name',array());
        
        $this->template->view_parts('content', "$this->view_dir/index_view", $this->data)
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
            );            
            add_language_param($extra);
            $this->user_model->add_to_extra_all_join_callbacks($extra);
            $this->user_model->set_extra_from_url($extra);
            $json['rows'] = $this->user_model->get_rows($extra);
//pre($this->db->last_query());
            unset($extra['limit'], $extra['offset']);
            $json['total'] = $this->user_model->get_count($extra);
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
            $this->user_model->delete($this->id);

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
                'user_type_id' => $this->input->post('user_type_id', TRUE),
                'unique_key' => $this->input->post('unique_key', TRUE),
                'is_admin' => $this->input->post('is_admin', TRUE),
                'admin_type_id' => $this->input->post('admin_type_id', TRUE),
                'username' => $this->input->post('username', TRUE),
                'name_prefix' => $this->input->post('name_prefix', TRUE),
                'first_name' => $this->input->post('first_name', TRUE),
                'middle_name' => $this->input->post('middle_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'maiden_name' => $this->input->post('maiden_name', TRUE),
                //'full_name' => $this->input->post('full_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'website' => $this->input->post('website', TRUE),
                'company_id' => $this->input->post('company_id', TRUE),
                'home_phone' => $this->input->post('home_phone', TRUE),
                'work_phone' => $this->input->post('work_phone', TRUE),
                'day_phone' => $this->input->post('day_phone', TRUE),
                'evening_phone' => $this->input->post('evening_phone', TRUE),
                'mobile' => $this->input->post('mobile', TRUE),
                'fax' => $this->input->post('fax', TRUE),
                'address' => $this->input->post('address', TRUE),
                'gender' => $this->input->post('gender', TRUE),
                'country_id' => $this->input->post('country_id', TRUE),
                'state_id' => $this->input->post('state_id', TRUE),
                'city_id' => $this->input->post('city_id', TRUE),
                'zip_code_id' => $this->input->post('zip_code_id', TRUE),
                'attorney_id' => $this->input->post('attorney_id', TRUE),
                'date_of_record' => $this->input->post('date_of_record', TRUE),
                'referred_by' => $this->input->post('referred_by', TRUE),
                'is_active' => $this->input->post('is_active', TRUE),
                'height' => $this->input->post('height', TRUE),
                'weight' => $this->input->post('weight', TRUE),
                'hair_color' => $this->input->post('hair_color', TRUE),
                'eye_color' => $this->input->post('eye_color', TRUE),
                'date_of_birth' => $this->input->post('date_of_birth', TRUE),
                'birth_country_id' => $this->input->post('birth_country_id', TRUE),
                'birth_state_id' => $this->input->post('birth_state_id', TRUE),
                'birth_city_id' => $this->input->post('birth_city_id', TRUE),
                'nationality' => $this->input->post('nationality', TRUE),
                'race' => $this->input->post('race', TRUE),
                'ssn' => $this->input->post('ssn', TRUE),
                'passport' => $this->input->post('passport', TRUE),
                'passport_country_id' => $this->input->post('passport_country_id', TRUE),
                'date_passport_expires' => $this->input->post('date_passport_expires', TRUE),
                'marital_status_id' => $this->input->post('marital_status_id', TRUE),
                'previous_marriages_count' => $this->input->post('previous_marriages_count', TRUE),
                'date_married' => $this->input->post('date_married', TRUE),
                'place_married' => $this->input->post('place_married', TRUE),
            );

            use_try_catch();
            try
            {
                $this->db->trans_start();
                
                $db_data['full_name'] = $db_data['name_prefix'] . ' '
                    . $db_data['first_name']  . ' '
                    . $db_data['middle_name']  . ' '
                    . $db_data['last_name']  . ' '
                    . $db_data['maiden_name'];
                $db_data['full_name'] = reduce_multiples(trim($db_data['full_name']), ' ');
                
                if(empty($this->id))
                {
                    $this->id = $this->user_model->insert($db_data);
                    $this->uri_assoc['id'] = $this->id;
                }
                else
                {
                    $this->user_model->update($this->id, $db_data);
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
                    js_close_modal('userModal');
                }
                elseif(is_ajax())
                {
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
        $row = $this->user_model->get_row_by_id($this->id, array(
                'callback' => array(                    
                    //'join_cities',
                    //'join_birth_city'                    
                )
        ));
        
        $this->data['row'] =& $row;
        $this->template->view_parts('content', "$this->view_dir/form_view", $this->data)
                ->title($this->data['page_title'])
                ->build();
    }

    private function _set_form_data()
    {
        $this->data['page_title'] = $this->data['module']['module_single_label'];

        $this->load->model(array(
            'user_type_model',
            'country_model',
            'state_model',
            'city_model',
            'zip_code_model',
        ));
        $this->data['dropdown_user_type_id'] = $this->user_type_model->dropdown('user_type_id','user_type_name',array('order_by' => 'user_type_name ASC'));
        $this->data['dropdown_country_id'] = $this->country_model->dropdown('country_id','country_name',array('order_by' => 'country_name ASC'));
        $this->data['dropdown_state_id'] = $this->state_model->dropdown('state_id','state_name',array('order_by' => 'state_name ASC'));
        $this->data['dropdown_city_id'] = $this->city_model->dropdown('city_id','city_name',array('order_by' => 'city_name ASC'));
        $this->data['dropdown_zip_code_id'] = $this->zip_code_model->dropdown('zip_code_id','zip_code',array('order_by' => 'zip_code ASC'));
        $this->data['dropdown_company_id'] =array('' => '');
        $this->data['dropdown_attorney_id'] = $this->user_model->dropdown('user_id', 'full_name', array(
            'is_active' => 1,
            'is_admin' => 1
        ));
        $this->data['dropdown_marital_status_id'] = array(''=>'');
        $this->data['dropdown_admin_type_id'] = add_empty_option_for_select(config_item('admin_types'));
        $this->data['dropdown_gender'] = add_empty_option_for_select(config_item('genders'));            
        
        $this->data['form_action'] = current_url();
        $this->data['redirect'] = current_url();
    }

    private function _form_validation()
    {
        if(!$_POST) return FALSE;

        $this->load->library('form_validation');
        $validation = array(
            array(
                'field' => 'user_type_id',
                'label' => __('User Type Id'),
                'rules' => 'trim|numeric|required'
            ),
            array(
                'field' => 'unique_key',
                'label' => __('Unique Key'),
                'rules' => 'trim,exact_length[32]'
            ),
            array(
                'field' => 'is_admin',
                'label' => __('Is Admin'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'username',
                'label' => __('Username'),
                'rules' => 'trim|max_length[20]'
            ),
            array(
                'field' => 'name_prefix',
                'label' => __('Name Prefix'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'first_name',
                'label' => __('First Name'),
                'rules' => 'trim|max_length[30]|required'
            ),
            array(
                'field' => 'last_name',
                'label' => __('Last Name'),
                'rules' => 'trim|max_length[30]'
            ),
            array(
                'field' => 'full_name',
                'label' => __('Full Name'),
                'rules' => 'trim|max_length[60]'
            ),
            array(
                'field' => 'email',
                'label' => __('Email'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'website',
                'label' => __('Website'),
                'rules' => 'trim|max_length[255]'
            ),
            array(
                'field' => 'company_id',
                'label' => __('Company Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'home_phone',
                'label' => __('Home Phone'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'work_phone',
                'label' => __('Work Phone'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'day_phone',
                'label' => __('Day Phone'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'evening_phone',
                'label' => __('Evening Phone'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'mobile',
                'label' => __('Mobile'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'fax',
                'label' => __('Fax'),
                'rules' => 'trim|max_length[50]'
            ),
            array(
                'field' => 'address',
                'label' => __('Address'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'gender',
                'label' => __('Gender'),
                'rules' => 'trim|max_length[10]'
            ),
            array(
                'field' => 'country_id',
                'label' => __('Country Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'state_id',
                'label' => __('State Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'city_id',
                'label' => __('City Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'zip_code_id',
                'label' => __('Zip Code Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'attorney_id',
                'label' => __('Attorney Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'date_of_record',
                'label' => __('Date Of Record'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'referred_by',
                'label' => __('Referred By'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'is_active',
                'label' => __('Is Active'),
                'rules' => 'trim|numeric'
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
            array(
                'field' => 'height',
                'label' => __('Height'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'weight',
                'label' => __('Weight'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'hair_color',
                'label' => __('Hair Color'),
                'rules' => 'trim|max_length[20]'
            ),
            array(
                'field' => 'eye_color',
                'label' => __('Eye Color'),
                'rules' => 'trim|max_length[20]'
            ),
            array(
                'field' => 'date_of_birth',
                'label' => __('Date Of Birth'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'birth_country_id',
                'label' => __('Birth Country'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'birth_state_id',
                'label' => __('Birth State'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'birth_city_id',
                'label' => __('Birth City'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'nationality',
                'label' => __('Nationality'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'race',
                'label' => __('Race'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'ssn',
                'label' => __('Ssn'),
                'rules' => 'trim|max_length[9]'
            ),
            array(
                'field' => 'passport',
                'label' => __('Passport'),
                'rules' => 'trim|max_length[100]'
            ),
            array(
                'field' => 'passport_country_id',
                'label' => __('Passport Country Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'date_passport_expires',
                'label' => __('Date Passport Expires'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'marital_status_id',
                'label' => __('Marital Status Id'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'previous_marriages_count',
                'label' => __('Previous Marriages Count'),
                'rules' => 'trim|numeric'
            ),
            array(
                'field' => 'date_married',
                'label' => __('Date Married'),
                'rules' => 'trim'
            ),
            array(
                'field' => 'place_married',
                'label' => __('Place Married'),
                'rules' => 'trim|max_length[100]'
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
