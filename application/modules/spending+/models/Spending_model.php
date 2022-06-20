<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Spending_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     public function insert($args = array())
     {
          $nb = $this->input->post('nb_decaissement');

          $data = IBEMS_Model::sanitize_for('decaissement_bons');
          $data['settings_scolarite_id'] = $_SESSION['dashboard']['settings_scolarite_id'];
          $data['decaissement_bon_flag_id'] = id_getter('decaissement_bon_flag_id', 'decaissement_bon_flags', 'decaissement_bon_flag_code', 'val');
          $data['decaissement_bon_added_by'] = $this->__user_id;
          $data['decaissement_bon_added'] = time();
          $data['decaissement_bon_modified'] = time();
          $data['decaissement_bon_locked'] = 0;
          $verif = $this->db->insert('decaissement_bons', $data);
          $decaissement_bon_id = $this->db->insert_id();

          for($i=0; $i<$nb; $i++) {
               $data = array();
               $data['decaissement_libelle'] = $this->input->post('decaissement_libelle['.$i.']');
               $data['decaissement_value'] = $this->input->post('decaissement_value['.$i.']');
               $data['decaissement_bon_id'] = $decaissement_bon_id;
               $data['decaissement_added_by'] = $this->__user_id;
               $data['decaissement_added'] = time();
               $data['decaissement_modified'] = time();
               $data['decaissement_locked'] = 0;
               $verif = $this->db->insert('decaissements', $data);
          }

          return ($verif);
     }

     public function delete($args = array())
     {
          $id = $this->input->post('decaissement_bon_id');
          $data['decaissement_bons_locked'] = 1;
          $this->db->where('decaissement_bon_id', $id);
          $query = $this->db->update('decaissement_bons', $data);
          return($query);
     }

     public function get_one($decaissement_bon_id){
          $this->db->select('*');
          $this->db->from('decaissement_bons');
          $this->db->join('decaissement_bon_flags', 'decaissement_bon_flags.decaissement_bon_flag_id = decaissement_bons.decaissement_bon_flag_id');
          $this->db->where('decaissement_bon_id', $decaissement_bon_id);
          $query = $this->db->get();
          $decaissement_bon = $query->row();

          $this->db->select('*');
          $this->db->from('decaissements');
          $this->db->where('decaissement_bon_id', $decaissement_bon->decaissement_bon_id);
          $this->db->group_by("decaissement_id");
          $query = $this->db->get();
          $decaissement_bon->decaissements = $query->result();
          $decaissement_bon->montant_decaisser = 0;
          foreach ($decaissement_bon->decaissements as $decaissement) {
               $decaissement_bon->montant_decaisser += $decaissement->decaissement_value;
          }

          return $decaissement_bon;
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('decaissement_bons');
          $this->db->join('decaissement_bon_flags', 'decaissement_bon_flags.decaissement_bon_flag_id = decaissement_bons.decaissement_bon_flag_id');
          $this->db->where('decaissement_bons.decaissement_bon_locked !=', 1);
          $this->db->order_by("decaissement_bons.decaissement_bon_id", "desc");
          $this->db->limit(1000);

          $query = $this->db->get();
          $decaissement_bons = $query->result();
          foreach ($decaissement_bons as $decaissement_bon) {
               $this->db->select('*');
               $this->db->from('decaissements');
               $this->db->where('decaissement_bon_id', $decaissement_bon->decaissement_bon_id);
               $this->db->group_by("decaissement_id");
               $query = $this->db->get();
               $decaissement_bon->decaissements = $query->result();
               $decaissement_bon->montant_decaisser = 0;
               foreach ($decaissement_bon->decaissements as $decaissement) {
                    $decaissement_bon->montant_decaisser += $decaissement->decaissement_value;
               }
          }
          return $decaissement_bons;
     }
}
