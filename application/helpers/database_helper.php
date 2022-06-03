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

/* NEW */

if (!function_exists('get_from')) {
    function get_from($table, $column, $identifier, $identifier_value) {
        $request = &get_instance()->db;
        $request->select($column);
        $request->from($table);
        $request->where($identifier, $identifier_value);
        $rs = $request->get();
        return $rs->row()->{$column};
    }
}


if (!function_exists('refresh_stock')) {
    function refresh_stock($produit_id, $quantite) {
        $request = &get_instance()->db;
        $data = array();
        $data["modified"] = time();
        $data["produit_quantite"] = (int) get_from("produits", "produit_quantite", "produit_id", $produit_id) - $quantite;
        $request->where("produit_id", $produit_id);
        return $request->update('produits',$data);
    }
}

if(!function_exists('get_likes')) {
     function get_likes($produit_id){
          $request = &get_instance()->db;
          $request->select('*');
          $request->from('likes');
          $request->where('produit_id', $produit_id);
          $result = $request->get();
          if(empty($result->num_rows())){
               return 0;
          }
          return $result->num_rows();
     }
}

if(!function_exists('get_comments')) {
     function get_comments($produit_id){
          $request = &get_instance()->db;
          $request->select('*');
          $request->from('comments');
          $request->where('produit_id', $produit_id);
          $result = $request->get();
          if(empty($result->num_rows())){
               return 0;
          }
          return $result->num_rows();
     }
}

if(!function_exists('get_all_comments')) {
     function get_all_comments($produit_id){
          $request = &get_instance()->db;
          $request->select('*');
          $request->from('comments');
          $request->join('users', 'users.user_id = comments.owner');
          $request->where('produit_id', $produit_id);
          $result = $request->get();
          return $result->result();
     }
}

if(!function_exists('change_flag')) {
     function change_flag($table, $column, $flag, $where){
          $request = &get_instance()->db;
          $data = array();
          $data['modified'] = time();
          $data[$column] = $flag;
          if(!is_null($where))
          {
               $request->where($where);
          }
          return($request->update($table, $data));
     }
}

/* CONFIG */

//protection par mot de passe
if (!function_exists('config')) {
    function config($key = null,$value = null) {
        $CI = &get_instance();
        $data = array();
        if(is_null($value))
        {
            $rs = @$CI->db->get('config')->result_array();
            foreach($rs as $k=>$v)
            {
                $data[$v['meta_key']] = $v['meta_value'];
            }
            return is_null($key) ? @$data : @$data[$key];
        }else{
            $data['meta_key'] = $key;
            $data['meta_value'] = $value;
            $rs = @$CI->db->replace('config',$data);
        }
    }
}

if (!function_exists('sim_meta')) {
    function sim_meta($key = null,$value = null) {
        $CI = &get_instance();
        $data = array();
        if(is_null($value))
        {
            $rs = @$CI->db->get('sim_metas')->result_array();
            foreach($rs as $k=>$v)
            {
                $data[$v['sim_meta_code']] = $v['sim_meta_value'];
            }
            return is_null($key) ? @$data : @$data[$key];
        }else{
            $data['sim_meta_code'] = $key;
            $data['sim_meta_value'] = $value;
            $rs = @$CI->db->replace('sim_metas',$data);
        }
    }
}

if (!function_exists('handle_db_error')) {
    function handle_db_error($error)
    {
        $str='<ul>';
        foreach ($error as $k=>$v)
        {
            $str.='<li>'.$v['code'].':'.$v['message'].'</li>';
        }
        $str.='</ul>';
        return $str;
    }
}
//check pack_id
if (!function_exists('is_pack')) {
    function is_pack($pack_id) {
        $DB = &get_instance()->db;
        $rs = $DB->select('*')->from('packs')->where('pack_id', $pack_id)->get();
        return ($rs->num_rows()>0);
    }
}
//
//get auto packs options
if (!function_exists('get_pack_auto_options')) {
    function get_pack_auto_options($pack_id) {
        $DB = &get_instance()->db;
        $DB->select('*');
        $DB->from('settings_pack_options');
        $DB->join('settings_type_packs','settings_type_packs.type_pack_id = settings_pack_options.type_pack_id','left');
        if($pack_id != null){
          $DB->join('packs_options','packs_options.option_id = settings_pack_options.option_id','left');
          $DB->where('pack_id', $pack_id);
        }else{
          $DB->where('type_pack_code', strtoupper('auto'));
        }
        return $DB->get()->result();
    }
}
function get_option_tarif($pack_id, $option_id)
{
    $DB = &get_instance()->db;
    $DB->select('*');
    $DB->from('tarifs_garanties');
    $DB->join('packs','packs.pack_id = tarifs_garanties.pack_id','left');
    $DB->join('auto_duree','auto_duree.duree_valeur = tarifs_garanties.duree','left');
    $DB->join('auto_puissance_fiscale','auto_puissance_fiscale.puissance_fiscale_id = tarifs_garanties.puissance_fiscale_id','left');
    $DB->where('packs.pack_id',$pack_id);
    $DB->where('tarifs_garanties.option_id',$option_id);
    return ($DB->get()->result());
}
//get auto packs options
if (!function_exists('get_pack_moto_options')) {
    function get_pack_moto_options($pack_id) {
        $DB = &get_instance()->db;
        $DB->select('*');
        $DB->from('settings_pack_options');
        $DB->join('settings_type_packs','settings_type_packs.type_pack_id = settings_pack_options.type_pack_id','left');
        if($pack_id != null){
          $DB->join('packs_options','packs_options.option_id = settings_pack_options.option_id','left');
          $DB->where('pack_id', $pack_id);
        }else{
          $DB->where('type_pack_code', strtoupper('moto'));
        }
        return $DB->get()->result();
    }
}

//get auto packs options
if (!function_exists('get_pack_objetco_options')) {
    function get_pack_objetco_options($pack_id) {
        $DB = &get_instance()->db;
        $DB->select('*');
        $DB->from('settings_pack_options');
        if($pack_id != null){
          $DB->join('packs_options','packs_options.option_id = settings_pack_options.option_id','left');
          $DB->where('pack_id', $pack_id);
        }else{
          $DB->where('type_pack_id', 3);
        }
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
    function set_instance_meta($meta_key, $meta_value) {
        $data = array(
            'meta_key' =>$meta_key,
            'meta_value' =>$meta_value
        );
        return $this->db->replace('instance_meta', $data);
    }
}
/***/
if(!function_exists('mysql_to_date')){
    function mysql_to_date($date, $glue = '-')
    {
        $d = explode($glue, $date);
        $val = (int)$date;
         $glue = '/';
        if(count($d)<2||$val==0) return '';
        return($d[2].$glue.$d[1].$glue.$d[0]);
    }
}
if(!function_exists('date_to_mysql')){
    function date_to_mysql($date, $glue = '-')
    {
        $d = explode($glue, $date);
        $glue = '-';
        if(count($d)<2) return '';
        return($d[2].$glue.$d[1].$glue.$d[0]);
    }
}
/* ATTESTATIONS */
function get_attestation($flag = '')
{
    $CI = &get_instance();
    $CI->db->select('*');
    $CI->db->from('attestations_souches');
    $CI->db->join('attestations_souches_flag','attestations_souches_flag.flag = attestations_souches.flag','left');
    if(!empty($flag))
    {
        $CI->db->where('attestations_souches.flag',$flag);
    }
    $rs = $CI->db->get();
    return $rs->result();
}
/**/
function create_user($data)
{
    $CI = &get_instance();
    $data = IBEMS_Model::sanitize_for('users',$data);
    $data['user_password']='';
    $data['user_registered'] = time();
    $data['added_by'] = get_user_info('user_id');
    $data['modified'] = time();
    $CI->db->insert('users',$data);
    return $CI->db->insert_id();
}
function salt($length = 12, $rounds = 5000, $private = 'TEK@sunnyv75')
{
    $salt = substr(uniqid(bin2hex(openssl_random_pseudo_bytes(16)).'-'.$private,true),0,$length);
    return sprintf('$6$rounds=%d$%s$', $rounds, $salt);
}
/*
SETTINGS
*/
function get_genre($code)
{
    $CI = &get_instance();
    return $CI->db->get_where('settings_genre', array('genre_code' => $code))->row();
}

/*
 *
 * */
if (!function_exists('check_personne')) {
    function check_personne($personne_id){
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('personnes');
        $CI->db->where('personne_id',$personne_id);
        $qry = $CI->db->get();
        return ($qry->num_rows()>0);
    }
}
if (!function_exists('numero_facture')) {
    function numero_facture($prefix='',$suffix='',$pad=5){
        $CI = &get_instance();
        $CI->db->select_max('FC_NO');
        $CI->db->from('factures');
        $qry = $CI->db->get();
        if($qry->num_rows()>0)
        {
            return $prefix.str_pad($qry->row()->FC_NO + 1, $pad, '0', STR_PAD_LEFT).$suffix;
        }else{
            die('error');
        }
    }
}
if (!function_exists('numero_contrat')) {
    function numero_contrat($prefix='',$suffix='',$pad=7){
        $CI = &get_instance();
        $CI->db->select_max('contrat_id');
        $CI->db->from('auto_contrats');
        $qry = $CI->db->get();
        if($qry->num_rows()>0)
        {
            return $prefix.str_pad($qry->row()->contrat_id + 1, $pad, '0', STR_PAD_LEFT).$suffix;
        }else{
            die('error');
        }
    }
}
if (!function_exists('get_attestation')) {
    function get_attestation($args){
        $CI = &get_instance();
        $CI->db->select_max('souche_id,numero');
        $CI->db->from('attestations_souches');
        $CI->db->where('flag',0);
        $qry = $CI->db->get();
        if($qry->num_rows()>0)
        {
            return $qry->numero;
        }else{
            return false;
        }
    }
}
/*
---------------------------------------------------------------------------------------------------------------------
TABLEAU DE BORD
---------------------------------------------------------------------------------------------------------------------
*/
if (!function_exists('get_vendeur_ventes')) {
    function get_vendeur_ventes($vendeur_id){
        $CI = &get_instance();
        //vente auto
        $CI->db->select('COUNT(CT_NO)');
        $CI->db->from('contrat_auto');
        $CI->db->where('CT_VENDEUR_ID',$vendeur_id);
        $qry = $CI->db->get();
        if($qry->num_rows()>0)
        {
            return $qry->numero;
        }else{
            return false;
        }
    }
}
if (!function_exists('get_wallet_amount')) {
    function get_wallet_amount($vendeur_id){
        $CI = &get_instance();
        $CI->db->select('sum(police_dist) as wallet_amount');
        $CI->db->from('commission_distributeur');
        $CI->db->join('vendeurs', 'vendeurs.vendeur_id = commission_distributeur.vendeur_id');
        $CI->db->where('vendeurs.vendeur_id', $vendeur_id);
        $rs = $CI->db->get();
        if($rs->row()->wallet_amount == null){
            return 0;
        }
        return ($rs->row()->wallet_amount);
    }
}
