<?php

function set_language($language_code='tr')
{
    if(!$language_code)
    {
        return FALSE;
    }

    $CI =&get_instance();
    $language = config_item('languages',  $language_code);
    if(!array_key_exists($language_code, config_item('languages')) || empty($language))
    {
        show_error(__('Dil bulunamadı.'));
        return FALSE;
    }

    $CI->config->set_item('language',$language_code);
    $CI->config->set_item('language_id',element('language_id', $language));
    $CI->config->set_item('language_name',element('language_name', $language));
    $CI->config->set_item('setlocale_code',element('setlocale_code', $language));


}

function setlocale_for_gettext()
{
    //putenv('LC_ALL=' . config_item('setlocale_code'));
    //setlocale(LC_ALL, config_item('setlocale_code'));
    // Çevirilerin bulunduğu yeri belirtelim
	$locale = config_item('setlocale_code');
	//putenv("LANG=$locale");
	if ($locale != "tr_TR")
	{
		setlocale(LC_ALL, $locale);
	}
	else // workaround to make turkish work with FoOlSlide
	{
		setlocale(LC_COLLATE, $locale);
		setlocale(LC_MONETARY, $locale);
		setlocale(LC_NUMERIC, $locale);
		setlocale(LC_TIME, $locale);
		//setlocale(LC_MESSAGES, $locale);
		setlocale(LC_CTYPE, "sk_SK.utf8");
	}

    $domain = 'alexander';
    bindtextdomain($domain, 'application-alexander/language/gettext');
    // Uygulama adını belirtelim
    textdomain($domain);
    bind_textdomain_codeset($domain, 'UTF-8');
    // Böylece çevirilerin aranacağı yer
    // ./locale/tr_TR/LC_MESSAGES/myPHPApp.mo olarak belirlendi.
    // Bir ileti basalım
}

function __()
{
    // fonksiyona gönderilen parametreleri esnek bir yöntem ile alıyoruz
   $params = func_get_args();
   // ilk parametre çevrilecek metin olduğu için
   // _ fonksiyonu ile çevrilmiş hali ile değiştiriyoruz
   $params[0] = _($params[0]);
   // daha sonra printf fonksiyonunu manuel şekilde çağırıyoruz
   return call_user_func_array('sprintf', $params);
}

function _e()
{
    // fonksiyona gönderilen parametreleri esnek bir yöntem ile alıyoruz
   $params = func_get_args();
   // ilk parametre çevrilecek metin olduğu için
   // _ fonksiyonu ile çevrilmiş hali ile değiştiriyoruz
   $params[0] = _($params[0]);
   // daha sonra printf fonksiyonunu manuel şekilde çağırıyoruz
   call_user_func_array('printf', $params);
}