<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cashin_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('encaissements');
          $data['encaissement_added_by'] = $this->__user_id;
          $data['encaissement_added'] = time();
          $data['encaissement_modified'] = time();
          $data['encaissement_locked'] = 0;
          $verif = $this->db->insert('encaissements',$data);

          $this->db->select('sum(encaissement_value) as somme_encaissement');
          $this->db->from('encaissements');
          $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
          $this->db->where('factures.facture_id', $data['facture_id']);
          $query = $this->db->get();
          $encaissement = $query->row();

          $this->db->select('facture_remise, sum(tarification_detail_value) as somme_facturation');
          $this->db->from('factures_scolarites_details');
          $this->db->join('factures_scolarites', 'factures_scolarites.factures_scolarite_id = factures_scolarites_details.factures_scolarite_id');
          $this->db->join('factures', 'factures.facture_id = factures_scolarites.facture_id');
          $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
          $this->db->where('factures_scolarites.facture_id', $data['facture_id']);
          $query = $this->db->get();
          $facturation = $query->row();

          if($encaissement->somme_encaissement >= ($facturation->somme_facturation - $facturation->facture_remise)){
               $datax['facture_flag_id'] = id_getter('facture_flag_id', 'facture_flags', 'facture_flag_code', 'reg');
               $this->db->where('facture_id', $data['facture_id']);
               return($this->db->update('factures', $datax));
          }

          return ($verif);
     }

     public function delete($args = array())
     {
          $id = $this->input->post('encaissement_id');
          $data['encaissement_locked'] = 1;
          $this->db->where('encaissement_id', $id);
          $query = $this->db->update('encaissements', $data);
          return($query);
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('encaissements');
          $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
          $this->db->join('settings_mode_paiements', 'settings_mode_paiements.settings_mode_paiement_id = encaissements.settings_mode_paiement_id');
          $this->db->where('encaissement_locked !=', 1);
          $this->db->order_by('encaissements.encaissement_id', 'desc');
          $this->db->limit(1000);

          $query = $this->db->get();
          return $query->result();
     }
}
