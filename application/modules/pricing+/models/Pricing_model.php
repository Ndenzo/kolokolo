<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pricing_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('tarifications');
          return ($this->db->insert('tarifications',$data));
     }

     public function insert_modeles($args = array())
     {
          $data = IBEMS_Model::sanitize_for('tarification_modeles');
          $data['settings_scolarite_id'] = $_SESSION['dashboard']['settings_scolarite_id'];
          $this->db->insert('tarification_modeles', $data);
          $datax['tarification_modele_id'] = $this->db->insert_id();
          $niveaux = $this->input->post('settings_niveau_id');
          $verif = false;
          foreach ($niveaux as $niveau) {
               $datax['settings_niveau_id'] = $niveau;
               $verif = $this->db->insert('tarification_modele_niveaux',$datax);
          }
          return ($verif);
     }

     public function insert_details($args = array())
     {
          $data = IBEMS_Model::sanitize_for('tarification_details');
          return ($this->db->insert('tarification_details',$data));
     }

     public function update($args = array())
     {
          $id = $this->input->post('tarification_id');
          $data = IBEMS_Model::sanitize_for('tarifications');
          $this->db->where('tarification_id', $id);
          return($this->db->update('tarifications',$data));
     }

     public function update_modeles($args = array())
     {
          $id = $this->input->post('tarification_modele_id');
          $data = IBEMS_Model::sanitize_for('tarification_modeles');
          $this->db->where('tarification_modele_id', $id);
          return($this->db->update('tarification_modeles',$data));
     }

     public function delete($args = array())
     {
          $id = $this->input->post('tarification_id');
          $this->db->where('tarification_id', $id);
          return($this->db->delete('tarifications'));
     }

     public function delete_modeles($args = array())
     {
          $id = $this->input->post('tarification_modele_id');
          $this->db->where('tarification_modele_id', $id);
          return($this->db->delete('tarification_modeles'));
     }

     public function delete_detail($args = array())
     {
          $id = $this->input->post('tarification_detail_id');
          $this->db->where('tarification_detail_id', $id);
          return($this->db->delete('tarification_details'));
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('tarifications');
          $this->db->where('tarification_id', $id);
          return ($this->db->get()->row());
     }

     public function get_one_modele($id)
     {
          $this->db->select('*');
          $this->db->from('tarification_modeles');
          $this->db->where('tarification_modele_id', $id);
          return ($this->db->get()->row());
     }

     public function get_details()
     {
          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->group_by('tarification_detail_name');
          return ($this->db->get()->result());
     }

     public function get_modeles()
     {
          $this->db->select('*');
          $this->db->from('tarification_modeles');
          $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $query = $this->db->get();
          $modeles = $query->result();
          foreach ($modeles as $modele) {
               $this->db->select('settings_niveau_name');
               $this->db->from('tarification_modele_niveaux');
               $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = tarification_modele_niveaux.settings_niveau_id');
               $this->db->where('tarification_modele_id', $modele->tarification_modele_id);
               $query = $this->db->get();
               $modele->niveaux = $query->result();
          }
          return ($modeles);
     }

     public function get_all($modele_id){
          $this->db->select('*');
          $this->db->from('tarifications');
          $query = $this->db->get();
          $tarifications = $query->result();
          foreach ($tarifications as $tarification) {
               $this->db->select('*');
               $this->db->from('tarification_details');
               $this->db->where('tarification_id', $tarification->tarification_id);
               $this->db->where('tarification_modele_id', $modele_id);
               $query = $this->db->get();
               $tarification->details = $query->result();
               $tarification->value = 0;
               foreach ($tarification->details as $details) {
                    $tarification->value += $details->tarification_detail_value;
               }
          }
          return $tarifications;
     }

     public function get_all_denomination(){
          $this->db->select('*');
          $this->db->from('tarifications');
          $query = $this->db->get();
          $tarifications = $query->result();
          foreach ($tarifications as $tarification) {
               $this->db->select('*');
               $this->db->from('tarification_details');
               $this->db->where('tarification_id', $tarification->tarification_id);
               $this->db->group_by('tarification_detail_name');
               $query = $this->db->get();
               $tarification->details = $query->result();
               $tarification->value = 0;
               foreach ($tarification->details as $details) {
                    $tarification->value += $details->tarification_detail_value;
               }
          }
          return $tarifications;
     }

     public function search_denomination($code){
          $this->db->select('*');
          $this->db->from('tarifications');
          $this->db->where('tarification_code', $code);
          $query = $this->db->get();
          $tarifications = $query->result();
          foreach ($tarifications as $tarification) {
               $this->db->select('*');
               $this->db->from('tarification_details');
               $this->db->where('tarification_id', $tarification->tarification_id);
               $this->db->group_by('tarification_detail_name');
               $query = $this->db->get();
               $tarification->details = $query->result();
               $tarification->value = 0;
               foreach ($tarification->details as $details) {
                    $tarification->value += $details->tarification_detail_value;
               }
          }
          return $tarifications;
     }

}
