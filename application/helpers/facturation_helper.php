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
if (!function_exists('retrouver_poste_facturation')) {
    function retrouver_poste_facturation($service, $journal) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('facturation_poste');
        $CI->db->where('service',strtoupper($service));
        $CI->db->where('journal',strtoupper($journal));
        $qry = $CI->db->get();
        if($qry->num_rows())
        {
            return $qry->row();
        }
        return '';
    }
}
if (!function_exists('numero_facture')) {
    function numero_facture($prefix='',$suffix='',$pad=5){
        $CI = &get_instance();
        $CI->db->select_max('FC_NO');
        $CI->db->from('facturation_facture');
        $qry = $CI->db->get();
        if($qry->num_rows()>0)
        {
            return $prefix.str_pad($qry->row()->FC_NO + 1, $pad, '0', STR_PAD_LEFT).$suffix;
        }else{
            die('error');
        }
    }
}
if (!function_exists('numero_reglement')) {
    function numero_reglement($prefix='',$suffix='',$pad=5){
        $CI = &get_instance();
        $CI->db->select_max('RG_NO');
        $CI->db->from('facturation_reglement');
        $qry = $CI->db->get();
        if($qry->num_rows()>0)
        {
            return $prefix.str_pad($qry->row()->RG_NO + 1, $pad, '0', STR_PAD_LEFT).$suffix;
        }else{
            die('error');
        }
    }
}
if (!function_exists('intitule')) {
    function intitule($subject,$replace = array()){
        $search = array('{SERVICE}','{REFERENCE}');
        return str_replace($search,$replace,$subject);
    }
}