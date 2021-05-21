<?php
/**
 * CodeIgniter
 *
 * @package CodeIgniter
 * @author  Kakou Cyr Leonce Anicet
 * @copyright Copyright (c) 2015, Ibems, Inc.
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    http://www.ibems.com
 * @since   Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**/
//check pack_id
if (!function_exists('is_pack')) {
    function is_pack($pack_id) {
        $DB = &get_instance()->db;
        $rs = $DB->select('*')->from('packs')->where('pack_id', $pack_id)->get();
        return ($rs->num_rows()>0);
    }
}
//
//get moto packs options
if (!function_exists('get_pack_moto_options')) {
    function get_pack_moto_options($pack_id) {
        $DB = &get_instance()->db;
        $DB->select('*');
        $DB->from('settings_pack_options');
        $DB->join('packs_options','packs_options.option_id = settings_pack_options.option_id','left');
        $DB->where('pack_id', $pack_id);
        return $DB->get()->result();
    }
}
/*function get_option_tarif($pack_id, $option_id)
{
    $DB = &get_instance()->db;
    $DB->select('*');
    $DB->from('tarifs_garanties');
    $DB->join('packs','packs.pack_id = tarifs_garanties.pack_id','left');
    $DB->join('moto_duree','moto_duree.duree_valeur = tarifs_garanties.duree','left');
    $DB->join('moto_puissance_fiscale','moto_puissance_fiscale.puissance_fiscale_id = tarifs_garanties.puissance_fiscale_id','left');
    $DB->where('packs.pack_id',$pack_id);
    $DB->where('tarifs_garanties.option_id',$option_id);
    return ($DB->get()->result());
}*/
//get moto packs options
if (!function_exists('get_pack_moto_options')) {
    function get_pack_moto_options($pack_id) {
        $DB = &get_instance()->db;
        $DB->select('*');
        $DB->from('settings_pack_options');
        $DB->join('packs_options','packs_options.option_id = settings_pack_options.option_id','left');
        $DB->where('pack_id', $pack_id);
        return $DB->get()->result();
    }
}
//
//protection par mot de passe
if (!function_exists('get_instance_metas')) {
    function get_instance_metas($user_id) {
        $CI = &get_instance();
        $rs = @$CI->db->get('instance_meta')->result_array();
        foreach($rs as $k=>$v){
            $data[$v['meta_key']] = $v['meta_value'];
        }
        return (@$data);
    }
}
//protection par mot de passe
if (!function_exists('get_instance_meta')) {
    function get_instance_meta($key) {
        $CI = &get_instance();
        $qry = @$CI->db->get_where('instance_meta',array('meta_key'=>$key))->row()->meta_value;
        if(is_json($qry))
        {
            $qry = json_decode($qry,true);
        }
        return ($qry);
    }
}
//protection par mot de passe
if (!function_exists('set_instance_meta')) {
    function set_instance_meta($meta_key, $meta_value)
    {
        $data = array(
            'meta_key' => $meta_key,
            'meta_value' => $meta_value
        );
        return $this->db->replace('instance_meta', $data);
    }
}

function get_moto_puissance_fiscale($puissance_fiscale_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('moto_puissance_fiscale', array('puissance_fiscale_id' => $puissance_fiscale_id))->row();
}
function get_moto_duree($duree_valeur)
{
    $CI = &get_instance();
    return $CI->db->get_where('moto_duree', array('duree_id' => $duree_valeur))->row();
}
function get_moto_marque($fabriquants_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('moto_fabriquants', array('fabriquant_id' => $fabriquants_id))->row();
}
function get_moto_model($model_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('moto_modeles', array('modele_id' => $model_id))->row();
}