<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Absence_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     public function insert_absence($args = array())
     {
          $data = IBEMS_Model::sanitize_for('evaluation_absences');
          $data['evaluation_absence_added_by'] = $this->__user_id;
          $data['evaluation_absence_added'] = time();
          $data['evaluation_absence_modified'] = time();
          $data['evaluation_absence_locked'] = 0;
          return ($this->db->insert('evaluation_absences',$data));
     }

     public function insert_retard($args = array())
     {
          $data = IBEMS_Model::sanitize_for('evaluation_retards');
          $data['evaluation_retard_added_by'] = $this->__user_id;
          $data['evaluation_retard_added'] = time();
          $data['evaluation_retard_modified'] = time();
          $data['evaluation_retard_locked'] = 0;
          return ($this->db->insert('evaluation_retards',$data));
     }

     public function update_absence($args = array())
     {
          $id = $this->input->post('evaluation_absence_id');
          $data = IBEMS_Model::sanitize_for('evaluation_absences');
          $this->db->where('evaluation_absence_id', $id);
          return($this->db->update('evaluation_absences',$data));
     }

     public function update_retard($args = array())
     {
          $id = $this->input->post('evaluation_retard_id');
          $data = IBEMS_Model::sanitize_for('evaluation_retards');
          $this->db->where('evaluation_retard_id', $id);
          return($this->db->update('evaluation_retards',$data));
     }

     public function delete_absence($args = array())
     {
          $id = $this->input->post('evaluation_absence_id');
          $this->db->where('evaluation_absence_id', $id);
          return($this->db->delete('evaluation_absences'));
     }

     public function delete_retard($args = array())
     {
          $id = $this->input->post('evaluation_retard_id');
          $this->db->where('evaluation_retard_id', $id);
          return($this->db->delete('evaluation_retards'));
     }

     public function get_one_absence($id)
     {
          $this->db->select('*');
          $this->db->from('evaluation_absences');
          $this->db->where('evaluation_absence_id', $id);
          return ($this->db->get()->row());
     }

     public function get_one_retard($id)
     {
          $this->db->select('*');
          $this->db->from('evaluation_retards');
          $this->db->where('evaluation_retard_id', $id);
          return ($this->db->get()->row());
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('settings_cycles');
          $query = $this->db->get();
          $cycles = $query->result();
          foreach ($cycles as $cycle) {
               $this->db->select('*');
               $this->db->from('evaluation_trimestres');
               $this->db->where('settings_cycle_id', $cycle->settings_cycle_id);
               $this->db->where('settings_scolarite_id',  $_SESSION['dashboard']['settings_scolarite_id']);
               $query = $this->db->get();
               $cycle->trimestres = @$query->result();
               foreach($cycle->trimestres as $trimestre) {
                    $this->db->select('*');
                    $this->db->from('evaluation_modeles');
                    $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
                    $this->db->where('evaluation_trimestre_id', $trimestre->evaluation_trimestre_id);
                    $query = $this->db->get();
                    $trimestre->evaluations = @$query->result();
                    foreach($trimestre->evaluations as $evaluation) {
                         $this->db->select('*');
                         $this->db->from('evaluation_modele_niveaux');
                         $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = evaluation_modele_niveaux.settings_niveau_id');
                         $this->db->where('evaluation_modele_id', $evaluation->evaluation_modele_id);
                         $query = $this->db->get();
                         $evaluation->niveaux = @$query->result();
                         foreach($evaluation->niveaux as $niveau) {
                              $this->db->select('*');
                              $this->db->from('classes');
                              $this->db->where('settings_niveau_id', $niveau->settings_niveau_id);
                              $query = $this->db->get();
                              $niveau->classe = @$query->result();
                         }
                    }
               }
          }
          return $cycles;
     }

     public function get_grid($type, $settings_niveau_id, $evaluation_modele_niveau_id){
          $this->db->select('*');
          $this->db->from('classes');
          $this->db->where('settings_niveau_id', $settings_niveau_id);
          $query = $this->db->get();
          $classes = $query->result();
          foreach($classes as $classe) {
               $this->db->select('*');
               $this->db->from('eleves_scolarites');
               $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
               $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
               $this->db->where('eleves_scolarites.classe_id', $classe->classe_id);
               $this->db->where('eleves_scolarites.settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
               $this->db->where('eleves.eleve_flag_id', 1);
               $this->db->order_by("personne_nom");
               $this->db->order_by("personne_prenoms");
               $query = $this->db->get();
               $classe->eleves = @$query->result();

               foreach ($classe->eleves  as $eleve) {
                    $this->db->select('*');
                    if($type == "abs"){
                         $this->db->from('evaluation_absences');
                    }
                    else {
                         $this->db->from('evaluation_retards');
                    }
                    $this->db->where('eleves_scolarite_id', $eleve->eleves_scolarite_id);
                    $query = $this->db->get();
                    $eleve->absences = @$query->result();
                    $nombre = 0;
                    if($type == "abs"){
                         foreach ($eleve->absences as $absence) {
                              $start_date = strtotime($absence->evaluation_absence_debut);
                              $end_date = strtotime($absence->evaluation_absence_fin);
                              $nombre += ($end_date - $start_date)/60/60/24;
                         }
                         $eleve->nombre_absence = $nombre." jours";
                    }
                    else {
                         foreach ($eleve->absences as $absence) {
                              $nombre += ($absence->evaluation_retard_fin - $absence->evaluation_retard_debut);
                         }
                         $eleve->nombre_absence = $nombre." heures";
                    }


               }
          }
          return $classes;
     }

     public function get_modele_niveau($evaluation_modele_niveau_id)
     {
          $this->db->select('*');
          $this->db->from('evaluation_modele_niveaux');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = evaluation_modele_niveaux.settings_niveau_id');
          $this->db->join('evaluation_modeles', 'evaluation_modeles.evaluation_modele_id = evaluation_modele_niveaux.evaluation_modele_id');
          $this->db->join('evaluation_trimestres', 'evaluation_trimestres.evaluation_trimestre_id = evaluation_modeles.evaluation_trimestre_id');

          $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
          return ($this->db->get()->row());
     }

}
