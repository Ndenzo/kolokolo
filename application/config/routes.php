<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['about'] = 'site/about';
$route['pricing'] = 'site/pricing';
$route['blog'] = 'site/blogs';
$route['marketplace'] = 'site/market';
$route['sms'] = 'site/sms';
$route['ivr'] = 'site/ivr';
$route['airtime'] = 'site/airtime';
$route['transfer'] = 'site/transfer';
$route['collection'] = 'site/collection';
$route['lang'] = 'site/change_lang';
$route['blog_detail/(:num)'] = 'site/blog_detail';

$route['404_override'] = 'help';
$route['translate_uri_dashes'] = FALSE;
