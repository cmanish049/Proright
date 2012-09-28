<?php
if(!defined('BASEPATH')) exit('No direct access allowed.');

class Public_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array());

        set_language(config_item('language'));
        setlocale_for_gettext();
        $this->config->set_site_ayarlari();
        
        if($this->is_logged_in && $this->logged_in_user->kullanici_tipi != 'kullanici' && $this->logged_in_user->kullanici_tipi != 'admin')
        {
            $this->is_logged_in = FALSE;
            $this->template->data('is_logged_in', $this->is_logged_in);
        }

        if($this->is_multiple_language_active)
        {
            $this->uri_assoc = $this->uri->uri_to_assoc(2);
        }
        else
        {
            $this->uri_assoc = $this->uri->uri_to_assoc(1);
        }

        if(isset($this->uri_assoc['id']))
        {
            $this->id = clean_id($this->uri_assoc['id']);
        }

        $page_assoc = $this->uri->uri_to_assoc(-1);
        if(isset($page_assoc['basla']))
        {
            $this->uri_assoc['basla'] = clean_id($page_assoc['basla']);
        }

        $js_is_logged_in = 'false';
        if($this->is_logged_in)
        {
            $js_is_logged_in = 'true';
        }

		$this->load->model(array(
            'yazi_model', 'kategori_model', 'yorum_model',
            'kullanici_yazi_iliski_model',
            'dosya_model', 'yazi_ozellik_model', 'yazi_oy_istatistik_model', 'yazi_oy_model'
        ));
        $this->load->model('yazi_kategori_iliskileri_model', 'y_k_i_model');
		
        $this->template->data('language', config_item('language'))
                       ->data('language_name', config_item('language_name'))
                       ->data('language_id', config_item('language_id'));

        $this->template->meta('
                            <script type="text/javascript">
                                var isLoggedIn = '.$js_is_logged_in.';
                            </script>');

        $this->template
                ->theme(config_item('theme'))
                ->meta('
                            <script type="text/javascript">
                                var siteUrl = "' . site_url() . '";
                                var language = "' . config_item('language') . '";
                            </script>')
                ->layout(config_item('layout'));
    }

}
