<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['show_biographie'] = 'site/biographie';
$route['show_blog'] = 'site/blogs';
$route['show_blog/(:num)'] = 'site/blog';
$route['show_evenement'] = 'site/evenement';
$route['show_media'] = 'site/media';
$route['show_contact'] = 'site/contact';
$route['download/(:any)'] = 'site/download';

//$route['admin'] = 'admin';
$route['404_override'] = 'help';
$route['translate_uri_dashes'] = FALSE;
