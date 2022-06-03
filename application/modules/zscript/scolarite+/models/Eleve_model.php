<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eleve_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     public function insert_reduction(){
          $data = IBEMS_Model::sanitize_for('eleves_reductions');
          $data['eleves_reduction_added_by'] = $this->__user_id;
          $data['eleves_reduction_added'] = time();
          return ($this->db->insert('eleves_reductions',$data));
     }

     public function delete_reduction($args = array())
     {
          $id = $this->input->post('eleves_reduction_id');
          $this->db->where('eleves_reduction_id', $id);
          return($this->db->delete('eleves_reductions'));
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->join('eleve_flags', 'eleve_flags.eleve_flag_id = eleves.eleve_flag_id');
          $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $query = $this->db->get();
          $eleves = $query->result();
          foreach ($eleves as $eleve) {
               $eleve->nom_complet = $eleve->prenoms." ".$eleve->nom;

               $this->db->select('prenoms as prenoms_tuteur, nom as nom_tuteur');
               $this->db->from('tuteurs');
               $this->db->join('personnes', 'personnes.personne_id = tuteurs.personne_id');
               $this->db->join('tuteur_eleves', 'tuteur_eleves.tuteur_id = tuteurs.tuteur_id');
               $this->db->where('tuteur_eleves.eleve_id', $eleve->eleve_id);
               $query = $this->db->get();
               $eleve->prenoms_tuteur = $query->row()->prenoms_tuteur;
               $eleve->nom_tuteur = $query->row()->nom_tuteur;

               $this->db->select('*');
               $this->db->from('eleves_reductions');
               $this->db->where('eleves_scolarite_id', $eleve->eleves_scolarite_id);
               $query = $this->db->get();
               $eleve->reduction = $query->row();
          }
          return $eleves;
     }

     public function cards_get_all(){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->order_by("classe_id");
          $this->db->order_by("nom");
          $this->db->order_by("prenoms");
          $query = $this->db->get();
          $eleves = $query->result();

          foreach ($eleves as $eleve) {
               $this->db->select('*');
               $this->db->from('classes');
               $this->db->where('classe_id', $eleve->classe_id);
               $query = $this->db->get();
               $eleve->classe_name = @$query->row()->classe_name;
          }

          return $eleves;
     }

     public function cards_get_classes($classe_id){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->where('classe_id', $classe_id);
          $this->db->order_by("classe_id");
          $this->db->order_by("nom");
          $this->db->order_by("prenoms");
          $query = $this->db->get();
          $eleves = $query->result();

          foreach ($eleves as $eleve) {
               $this->db->select('*');
               $this->db->from('classes');
               $this->db->where('classe_id', $eleve->classe_id);
               $query = $this->db->get();
               $eleve->classe_name = @$query->row()->classe_name;
          }

          return $eleves;
     }

     public function get_one($id){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->where('eleves.eleve_id',$id);
          return ($this->db->get()->row());
     }


}
