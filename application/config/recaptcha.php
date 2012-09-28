<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
The reCaptcha server keys and API locations

Obtain your own keys from:
http://www.recaptcha.net
*/
$config['recaptcha'] = array(
  'public'=>'6LcZjNMSAAAAACVrErCWBEsQs_pwKK2ETBc5P4h3',
  'private'=>'6LcZjNMSAAAAANZlqYVIqfoomgcyl3POcAvak7Rz',
  'RECAPTCHA_API_SERVER' =>'http://www.google.com/recaptcha/api',
  'RECAPTCHA_API_SECURE_SERVER'=>'https://www.google.com/recaptcha/api',
  'RECAPTCHA_VERIFY_SERVER' =>'www.google.com',
  'RECAPTCHA_SIGNUP_URL' => 'https://www.google.com/recaptcha/admin/create',
  'theme' => 'clean'
);
