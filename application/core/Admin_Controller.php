<?php
if(!defined('BASEPATH')) exit('No direct access allowed.');

class Admin_Controller extends MY_Controller
{
    protected $moduller = array();

    function __construct()
    {
        parent::__construct();
        $this->config->set_item('compress_output', FALSE);
		
        $this->load->config('status');
        $this->load->model(array(
            'auth_module_model',
            'auth_user_group_model',
            'auth_ug_module_relationship_model',
            'auth_ug_user_relationship_model'            
        ));
		
        if(!$this->is_logged_in || $this->logged_in_user->is_admin != 'yes')
        {
            //redirect(admin_url('login'));
        }
        
        $this->config->set_user_permissions();                
        $this->config->set_modules();        
        
        $this->uri_assoc = $this->uri->uri_to_assoc(2);
        if(isset($this->uri_assoc['id']))
        {
            $this->id = clean_id($this->uri_assoc['id']);
        }

        $this->data['window'] = element('window', $this->uri_assoc);                
        $this->data['window'] OR $this->data['window'] = $this->input->get('window',TRUE); 
        
        $this->data['limit'] = 20;
        $this->moduller = config_item('modules');

        $js_is_logged_in = 'false';
        if($this->is_logged_in)
        {
            $js_is_logged_in = 'true';
        }

        $this->template->theme(config_item('admin_theme'));
        if(is_ajax())
        {
            $this->template->layout('ajax_layout');
        }
        elseif($this->data['window'] == 'modal')
        {
            $this->template->layout('iframe_layout');
        }
        elseif($this->data['window'] == 'ajax-modal')
        {
            $this->template->layout('ajax_layout');
        }
        else
        {
            $this->template->layout('layout');
        }
        
        

        $this->template
                ->data($this->data)
                ->meta('
                            <script type="text/javascript">
                                var isLoggedIn = ' . $js_is_logged_in . ';  
                                var adminUrl = "' . admin_url() . '/";
                                var siteUrl = "' . site_url() . '";
                                var themeUrl = "' . $this->template->get_theme_url() . '";
                            </script>');
                
        
        if(in_array($this->template->get_layout(), array('layout')))
        {
            //menüyü oluştur
            $menu_items = $this->auth_module_model->get_rows(array(
                'SHOW_IN_MENU' => 'yes',
                'ACTIVE' => 'yes',
                'order_by' => 'SEQUENCE_NUMBER ASC'
            ));
            $tree_options = array(
                'base_field' => 'module_id',
                'parent_field' => 'parent_id',
                'base_ul_attrs' => array('class' => 'sf-menu'),
                'checkbox' => FALSE,
                'use_eval' => FALSE
            );
            $this->load->library('tree');
            $this->tree->initialize($tree_options);
            $this->tree->set_template('callback_tree_for_admin_top_menu');
            $this->data['top_menu'] = $this->tree->generate_tree($menu_items);
        }
    }

}
