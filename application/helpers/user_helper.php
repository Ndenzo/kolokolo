<?php
/**
 * CodeIgniter
 *
 * @package	CodeIgniter
 * @author	Kakou Cyr Leonce Anicet
 * @copyright Copyright (c) 2015, Ibems, Inc.
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.ibems.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  USER
| -------------------------------------------------------------------
*/
//informations utilisateur
if (!function_exists('login_exist')) {
    function login_exist($login) {
        $CI = &get_instance();
        $CI->db->select('user_id');
        $rs = $CI->db->get_where('users',array('user_login'=>$login));
        return ($rs->num_rows() > 0);
    }
}
if (!function_exists('email_exist')) {
    function email_exist($email = null) {
        $CI = &get_instance();
        $CI->db->select('user_id');
        $rs = $CI->db->get_where('users',array('user_email'=>$email));
        return ($rs->num_rows() > 0);
    }
}
if (!function_exists('get_user_info')) {
    function get_user_info($key = null) {
        $CI = &get_instance();
        return (is_null($key))?$CI->session->user:@$CI->session->user[$key];
    }
}
if (!function_exists('me')) {
    function me($key = null) {
        $CI = &get_instance();
        return (is_null($key))?$CI->session->me:@$CI->session->me->{$key};
    }
}

if (!function_exists('get_teacher_info')) {
    function get_teacher_info($user_id) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('teachers');
        $rs = $CI->db->where('teachers.user_id',(int)$user_id)->get();
        if($rs->num_rows()>=1) return $rs->row();
        return false;
    }
}

if (!function_exists('get_language_info')) {
    function get_language_info($settings_language_id) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('settings_languages');
        $rs = $CI->db->where('settings_languages.settings_language_id',(int)$settings_language_id)->get();
        if($rs->num_rows()>=1) return $rs->row();
        return false;
    }
}

if (!function_exists('get_customer_info')) {
    function get_customer_info($user_id) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $rs = $CI->db->where('customers.user_id',(int)$user_id)->get();
        if($rs->num_rows()>=1) return $rs->row();
        return false;
    }
}

//check pack_id
if (!function_exists('get_role_id')) {
    function get_role_id($code) {
        $DB = &get_instance()->db;
        $rs = $DB->select('role_id')->from('users_roles')->where('role_code', $code)->get()->row();
        return $rs->role_id;
    }
}
if (!function_exists('is_identified')) {
    function is_identified($user_id) {
        $DB = &get_instance()->db;
        $rs = $DB->select('person_id')->from('users_2_persons')->where('user_id', $user_id)->get();
        if($rs->num_rows()>=1) return true;
        return false;
    }
}
//controler une variable
if (!function_exists('control')) {
    function control($variable) {
        if(!isset($$variable)&& empty($variable)) die('accés refusé');
    }
}


if (!function_exists('is_scheduled')) {
    function is_scheduled($schedule_id, $date) {
        $DB = &get_instance()->db;
        $rs = $DB->select('*')->from('customer_schedules')->where('schedule_id', $schedule_id)->where('customer_schedule_date', date_to_mysql($date, '/'))->get();
        if($rs->num_rows()>=1) return $rs->row();
        return false;
    }
}

//
?>
