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
if (!function_exists('get_livraison_zone')) {
    function get_livraison_zone($tarif_id) {
        $DB = &get_instance()->db;
        return $DB->get_where('livraison_tarif', array("CONCAT(tarif_id,'|',montant)" => $tarif_id))->row();
    }
}
function get_auto_puissance_fiscale($puissance_fiscale_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('auto_puissance_fiscale', array('puissance_fiscale_id' => $puissance_fiscale_id))->row();
}
function get_auto_duree($duree_valeur)
{
    $CI = &get_instance();
    return $CI->db->get_where('auto_duree', array('duree_id' => $duree_valeur))->row();
}
function get_auto_marque($fabriquants_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('auto_fabriquants', array('fabriquant_id' => $fabriquants_id))->row();
}
function get_auto_model($model_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('auto_modeles', array('modele_id' => $model_id))->row();
}
function get_carburant($carburant_id)
{
    $CI = &get_instance();
    return $CI->db->get_where('carburants', array('carburant_id' => $carburant_id))->row();
}
/*
 * TARIF
 * */

/*
 * ATTESTATION
 * */
function get_last_attestation($point_de_vente_id)
{
    $CI = &get_instance();
    $CI->db->select('souche_id,numero');
    $CI->db->from('attestations_souches');
    $CI->db->join('attestations','attestations.attestation_id = attestations_souches.attestation_id','left');
    $CI->db->where('attestations_souches.flag',0);
    $CI->db->where('attestations.point_vente_id',$point_de_vente_id);
    $CI->db->order_by('souche_id','ASC');
    $CI->db->limit(1);
    $rs = $CI->db->get();
    if($rs->num_rows()>=1)
    {
        return ($rs->row());
    }
    return (false);
}
function locked_attestation($souche_id)
{
    $CI = &get_instance();
    $CI->db->where('souche_id',$souche_id);
    $rs = $CI->db->update('attestations_souches',array('flag'=>1));
    return ($rs);
}
function get_attestation_for($contrat_id)
{
    $CI = &get_instance();
    $CI->db->select('souche_id,numero');
    $CI->db->from('attestations_souches');
    $CI->db->where('flag',1);
    $CI->db->where('contrat_id',$contrat_id);
    $rs = $CI->db->get();
    if($rs->num_rows()>=1)
    {
      return $rs->row();
    }
    return (false);
}
