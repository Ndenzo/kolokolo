<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => DB_HOST,
	'username' => DB_USER_ID,
	'password' => DB_USER_PWD,
	'database' => DB_NAME,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
/*
$db['online'] = array(
    'hostname' => 'localhost',
    'username' => 'aprihkut_sn',
    'password' => 'OzXW9ZI8QzGx',
    'database' => 'aprihkut_sn',
);


if($_SERVER['HTTP_HOST']=='april-suite.ibemscreative.website')
{
    $db['default'] = array_merge($db['default'],$db['online']);
}else{

}
*/
