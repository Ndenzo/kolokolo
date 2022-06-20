<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Evaluation_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }

     public function insert_trimestre($args = array())
     {
          $data = IBEMS_Model::sanitize_for('evaluation_trimestres');
          return ($this->db->insert('evaluation_trimestres',$data));
     }

     public function insert_modele($args = array())
     {
          $settings_niveaux = $this->input->post('settings_niveau_cycle_id');
          $data = IBEMS_Model::sanitize_for('evaluation_modeles');
          $query = $this->db->insert('evaluation_modeles', $data);
          $evaluation_modele_id = $this->db->insert_id();

          foreach ($settings_niveaux as $key => $settings_niveau_id) {
               $data['evaluation_modele_id'] = $evaluation_modele_id;
               $data['settings_niveau_id'] = $settings_niveau_id;
               $data = IBEMS_Model::sanitize_for('evaluation_modele_niveaux', $data);
               $query = $this->db->insert('evaluation_modele_niveaux', $data);
          }

          return ($query);
     }

     public function insert_module_niveau($args = array())
     {
          $settings_activites = $this->input->post('settings_activite_id');
          $data = IBEMS_Model::sanitize_for('evaluation_module_niveaux');
          $query = $this->db->insert('evaluation_module_niveaux', $data);
          $evaluation_module_niveau_id = $this->db->insert_id();

          foreach ($settings_activites as $key => $settings_activite_id) {
               $data['evaluation_module_niveau_id'] = $evaluation_module_niveau_id;
               $data['settings_activite_id'] = $settings_activite_id;
               $data = IBEMS_Model::sanitize_for('evaluation_activite_modules', $data);
               $query = $this->db->insert('evaluation_activite_modules', $data);
          }

          return ($query);
     }

     public function insert_module($args = array())
     {
          $data = IBEMS_Model::sanitize_for('evaluation_modules');
          return ($this->db->insert('evaluation_modules',$data));
     }

     public function insert_config($args = array())
     {
          $config = id_getter('evaluation_note_config_id', 'evaluation_note_configs', 'evaluation_note_config_id', $this->input->post('evaluation_note_config_id'));

          if($config == null){
               $data = IBEMS_Model::sanitize_for('evaluation_note_configs');
               return($this->db->insert('evaluation_note_configs', $data));
          }else{
               $data = array();
               $data['evaluation_note_config_max'] = $this->input->post('evaluation_note_config_max');
               $data['evaluation_note_config_coef'] = $this->input->post('evaluation_note_config_coef');
               $data['evaluation_note_config_cont'] = $this->input->post('evaluation_note_config_cont');
               $this->db->where('evaluation_note_config_id', $this->input->post('evaluation_note_config_id'));
               return($this->db->update('evaluation_note_configs', $data));
          }
     }

     public function insert_dispense($args = array())
     {
          $data = IBEMS_Model::sanitize_for('evaluation_dispenses');
          return ($this->db->insert('evaluation_dispenses',$data));
     }

     public function insert_evaluation($data)
     {
          $this->db->select('*');
          $this->db->from('evaluations');
          $this->db->where('evaluation_modele_niveau_id', $data['evaluation_modele_niveau_id']);
          $this->db->where('eleves_scolarite_id', $data['eleves_scolarite_id']);
          $query = $this->db->get();
          $num = $query->num_rows();
          if($num >= 1){
               $evaluation = $query->row();
               $data = IBEMS_Model::sanitize_for('evaluations', $data);
               $this->db->where('evaluation_id', $evaluation->evaluation_id);
               return ($this->db->update('evaluations',$data));
          }else{
               $data = IBEMS_Model::sanitize_for('evaluations', $data);
               return ($this->db->insert('evaluations',$data));
          }
     }

     public function update($args = array())
     {
          $id = $this->input->post('evaluation_id');
          $data = IBEMS_Model::sanitize_for('evaluations');
          $this->db->where('evaluation_id', $id);
          return($this->db->update('evaluations',$data));
     }

     public function update_modele($args = array())
     {
          $id = $this->input->post('evaluation_modele_id');
          $data = IBEMS_Model::sanitize_for('evaluation_modeles');
          $this->db->where('evaluation_modele_id', $id);
          return($this->db->update('evaluation_modeles',$data));
     }

     public function update_module($args = array())
     {
          $id = $this->input->post('evaluation_module_id');
          $data = IBEMS_Model::sanitize_for('evaluation_modules');
          $this->db->where('evaluation_module_id', $id);
          $this->db->update('evaluation_modules', $data);
     }

     public function delete($args = array())
     {
          $id = $this->input->post('evaluation_module_id');
          $this->db->where('evaluation_module_id', $id);
          return($this->db->delete('evaluation_modules'));
     }

     public function delete_module_niveau($args = array())
     {
          $id = $this->input->post('evaluation_module_niveau_id');
          $this->db->where('evaluation_module_niveau_id', $id);
          return($this->db->delete('evaluation_module_niveaux'));
     }

     public function delete_modele($args = array())
     {
          $id = $this->input->post('evaluation_modele_id');
          $this->db->where('evaluation_modele_id', $id);
          return($this->db->delete('evaluation_modeles'));
     }

     public function delete_dispense($evaluation_dispense_id)
     {
          $this->db->where('evaluation_dispense_id', $evaluation_dispense_id);
          return($this->db->delete('evaluation_dispenses'));
     }

     public function delete_detail($args = array())
     {
          $id = $this->input->post('evaluation_detail_id');
          $this->db->where('evaluation_detail_id', $id);
          return($this->db->delete('evaluation_details'));
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('evaluations');
          $this->db->where('evaluation_id', $id);
          return ($this->db->get()->row());
     }

     public function get_one_modele($id)
     {
          $this->db->select('*');
          $this->db->from('evaluation_modeles');
          $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
          $this->db->join('evaluation_trimestres', 'evaluation_trimestres.evaluation_trimestre_id = evaluation_modeles.evaluation_trimestre_id');
          $this->db->where('evaluation_modele_id', $id);
          return ($this->db->get()->row());
     }

     public function get_one_module($id)
     {
          $this->db->select('*');
          $this->db->from('evaluation_modules');
          $this->db->where('evaluation_module_id', $id);
          return ($this->db->get()->row());
     }

     public function get_details()
     {
          $this->db->select('*');
          $this->db->from('evaluation_details');
          $this->db->group_by('evaluation_detail_name');
          return ($this->db->get()->result());
     }

     public function get_modele_niveau($evaluation_modele_niveau_id)
     {
          $this->db->select('*');
          $this->db->from('evaluation_modele_niveaux');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = evaluation_modele_niveaux.settings_niveau_id');
          $this->db->join('settings_cycles', 'settings_cycles.settings_cycle_id = settings_niveaux.settings_cycle_id');
          $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
          return ($this->db->get()->row());
     }

     public function get_modeles()
     {
          $this->db->select('*');
          $this->db->from('evaluation_modeles');
          $query = $this->db->get();
          $modeles = $query->result();
          foreach ($modeles as $modele) {
               $this->db->select('settings_niveau_name');
               $this->db->from('evaluation_modele_niveaux');
               $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = evaluation_modele_niveaux.settings_niveau_id');
               $this->db->where('evaluation_modele_id', $modele->evaluation_modele_id);
               $query = $this->db->get();
               $modele->niveaux = $query->result();
          }
          return ($modeles);
     }

     public function get_dispenses($evaluation_modele_id)
     {
          $dispenses = array();
          $this->db->select('eleves_scolarite_id');
          $this->db->from('evaluation_dispenses');
          $this->db->where('evaluation_modele_id', $evaluation_modele_id);
          $query = $this->db->get();
          $evaluation_dispenses = $query->result();
          foreach ($evaluation_dispenses as $evaluation_dispense) {
               array_push($dispenses, $evaluation_dispense->eleves_scolarite_id);
          }
          return ($dispenses);
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
               $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
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

                         $this->db->select('*');
                         $this->db->from('evaluation_dispenses');
                         $this->db->join('eleves_scolarites', 'eleves_scolarites.eleves_scolarite_id = evaluation_dispenses.eleves_scolarite_id');
                         $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
                         $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
                         $this->db->join('classes', 'classes.classe_id = eleves_scolarites.classe_id');
                         $this->db->where('evaluation_modele_id', $evaluation->evaluation_modele_id);
                         $query = $this->db->get();
                         $evaluation->dispenses = @$query->result();
                    }
               }
          }

          return $cycles;
     }

     public function get_modules($settings_niveau_id){
          $this->db->select('*');
          $this->db->from('evaluation_module_niveaux');
          $this->db->join('evaluation_modules', 'evaluation_modules.evaluation_module_id = evaluation_module_niveaux.evaluation_module_id');
          $this->db->where('settings_niveau_id', $settings_niveau_id);
          $query = $this->db->get();
          $modules = @$query->result();
          foreach($modules as $module) {
               $this->db->select('*');
               $this->db->from('evaluation_activite_modules');
               $this->db->join('settings_activites', 'settings_activites.settings_activite_id = evaluation_activite_modules.settings_activite_id');
               $this->db->where('evaluation_module_niveau_id', $module->evaluation_module_niveau_id);
               $query = $this->db->get();
               $module->activites = @$query->result();
               foreach($module->activites as $activite) {
                    $this->db->select('*');
                    $this->db->from('evaluation_note_configs');
                    $this->db->where('evaluation_activite_module_id', $activite->evaluation_activite_module_id);
                    $query = $this->db->get();
                    $activite->config = @$query->row();
               }
          }
          return($modules);
     }

     public function get_grid($settings_niveau_id, $evaluation_modele_niveau_id){
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
               $this->db->order_by("personne_nom");
               $this->db->order_by("personne_prenoms");
               $query = $this->db->get();
               $classe->eleves = @$query->result();

               foreach ($classe->eleves  as $eleve) {
                    $this->db->select('*');
                    $this->db->from('evaluation_notes');
                    $this->db->where('eleves_scolarite_id', $eleve->eleves_scolarite_id);
                    $query = $this->db->get();
                    $eleve->note = @$query->result();
               }
          }
          return $classes;
     }

     public function get_bulletin($classe_id, $evaluation_modele_niveau_id){

          $this->db->select('*');
          $this->db->from('evaluation_modele_niveaux');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = evaluation_modele_niveaux.settings_niveau_id');
          $this->db->join('settings_cycles', 'settings_cycles.settings_cycle_id = settings_niveaux.settings_cycle_id');
          $this->db->join('evaluation_modeles', 'evaluation_modeles.evaluation_modele_id = evaluation_modele_niveaux.evaluation_modele_id');
          $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
          $this->db->join('evaluation_trimestres', 'evaluation_trimestres.evaluation_trimestre_id = evaluation_modeles.evaluation_trimestre_id');
          $this->db->join('settings_scolarites', 'settings_scolarites.settings_scolarite_id = evaluation_trimestres.settings_scolarite_id');
          $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
          $query = $this->db->get();
          $config = @$query->row();

          $this->db->select('*');
          $this->db->from('evaluation_modules');
          $this->db->join('evaluation_module_niveaux', 'evaluation_module_niveaux.evaluation_module_id = evaluation_modules.evaluation_module_id');
          $this->db->join('evaluation_modele_niveaux', 'evaluation_modele_niveaux.settings_niveau_id = evaluation_module_niveaux.settings_niveau_id');
          $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
          $query = $this->db->get();
          $config->modules = @$query->result();

          foreach ($config->modules  as $module) {
               $this->db->select('*');
               $this->db->from('evaluation_activite_modules');
               $this->db->join('settings_activites', 'settings_activites.settings_activite_id = evaluation_activite_modules.settings_activite_id');
               $this->db->join('evaluation_note_configs', 'evaluation_note_configs.evaluation_activite_module_id = evaluation_activite_modules.evaluation_activite_module_id');
               $this->db->where('evaluation_module_niveau_id', $module->evaluation_module_niveau_id);
               if($config->settings_evaluation_code == "con"){
                    $this->db->where('evaluation_note_configs.evaluation_note_config_cont', 1);
               }
               $query = $this->db->get();
               $module->activites = @$query->result();
          }

          $to_ignore = self::get_dispenses($config->evaluation_modele_id);
          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->join('settings_scolarites', 'settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
          $this->db->join('classes', 'classes.classe_id = eleves_scolarites.classe_id');
          $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->where('eleves_scolarites.classe_id', $classe_id);
          $this->db->where('eleves_scolarites.settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          if(count($to_ignore)>0)
          $this->db->where_not_in('eleves_scolarites.eleves_scolarite_id', $to_ignore);
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
          $query = $this->db->get();
          $config->eleves = @$query->result();

          foreach ($config->eleves  as $eleve) {
               $this->db->select('*');
               $this->db->from('evaluation_notes');
               $this->db->join('evaluation_note_configs', 'evaluation_note_configs.evaluation_note_config_id = evaluation_notes.evaluation_note_config_id');
               $this->db->join('evaluation_activite_modules', 'evaluation_activite_modules.evaluation_activite_module_id = evaluation_note_configs.evaluation_activite_module_id');
               $this->db->join('evaluation_module_niveaux', 'evaluation_module_niveaux.evaluation_module_niveau_id = evaluation_activite_modules.evaluation_module_niveau_id');
               $this->db->join('evaluation_modules', 'evaluation_modules.evaluation_module_id = evaluation_module_niveaux.evaluation_module_id');
               $this->db->where('eleves_scolarite_id', $eleve->eleves_scolarite_id);
               $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
               $query = $this->db->get();
               $eleve->notes = @$query->result();
          }

          return $config;
     }

     public function get_annuelle($classe_id){

          $config = new stdClass();

          $this->db->select('*');
          $this->db->from('evaluation_trimestres');
          $this->db->join('settings_cycles', 'settings_cycles.settings_cycle_id = evaluation_trimestres.settings_cycle_id');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_cycle_id = settings_cycles.settings_cycle_id');
          $this->db->join('classes', 'classes.settings_niveau_id = settings_niveaux.settings_niveau_id');
          $this->db->where('evaluation_trimestres.settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->where('classes.classe_id', $classe_id);
          $this->db->order_by("evaluation_trimestre_id");
          $query = $this->db->get();
          $config->trimestres = @$query->result();

          foreach ($config->trimestres as $trimestre) {
               $this->db->select('*');
               $this->db->from('evaluation_modeles');
               $this->db->join('evaluation_modele_niveaux', 'evaluation_modele_niveaux.evaluation_modele_id = evaluation_modeles.evaluation_modele_id');
               $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
               $this->db->where('evaluation_modele_niveaux.settings_niveau_id', $trimestre->settings_niveau_id);
               $this->db->where('evaluation_modeles.evaluation_trimestre_id', $trimestre->evaluation_trimestre_id);
               $this->db->where('settings_evaluations.settings_evaluation_code', 'com');
               $this->db->order_by("evaluation_modeles.evaluation_modele_id");
               $this->db->order_by("evaluation_modele_niveau_id");
               $query = $this->db->get();
               $trimestre->evaluation_modeles = @$query->result();
          }

          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->join('settings_scolarites', 'settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
          $this->db->join('classes', 'classes.classe_id = eleves_scolarites.classe_id');
          $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->where('eleves_scolarites.classe_id', $classe_id);
          $this->db->where('eleves_scolarites.settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
          $query = $this->db->get();
          $config->eleves = @$query->result();

          foreach ($config->eleves  as $eleve) {
               $this->db->select('*');
               $this->db->from('evaluations');
               $this->db->where('eleves_scolarite_id', $eleve->eleves_scolarite_id);
               $this->db->order_by("evaluation_modele_niveau_id", 'desc');
               $query = $this->db->get();
               $eleve->evaluations = @$query->result();
          }

          return $config;
     }

     public function get_all_notation(){
          $this->db->select('*');
          $this->db->from('settings_cycles');
          $query = $this->db->get();
          $cycles = $query->result();
          foreach ($cycles as $cycle) {
               $this->db->select('*');
               $this->db->from('settings_niveaux');
               $this->db->where('settings_cycle_id', $cycle->settings_cycle_id);
               $this->db->order_by('settings_niveau_code');
               $query = $this->db->get();
               $cycle->niveaux = @$query->result();
               foreach($cycle->niveaux as $niveau) {
                    $this->db->select('*');
                    $this->db->from('evaluation_module_niveaux');
                    $this->db->join('evaluation_modules', 'evaluation_modules.evaluation_module_id = evaluation_module_niveaux.evaluation_module_id');
                    $this->db->where('settings_niveau_id', $niveau->settings_niveau_id);
                    $query = $this->db->get();
                    $niveau->modules = @$query->result();
                    foreach($niveau->modules as $module) {
                         $this->db->select('*');
                         $this->db->from('evaluation_activite_modules');
                         $this->db->join('settings_activites', 'settings_activites.settings_activite_id = evaluation_activite_modules.settings_activite_id');
                         $this->db->where('evaluation_module_niveau_id', $module->evaluation_module_niveau_id);
                         $query = $this->db->get();
                         $module->activites = @$query->result();
                         foreach($module->activites as $activite) {
                              $this->db->select('*');
                              $this->db->from('evaluation_note_configs');
                              $this->db->where('evaluation_activite_module_id', $activite->evaluation_activite_module_id);
                              $query = $this->db->get();
                              $activite->config = @$query->row();
                         }
                    }
               }
          }
          return $cycles;
     }

     public function get_all_modules(){
          $this->db->select('*');
          $this->db->from('evaluation_modules');
          $this->db->order_by('evaluation_module_name');
          $query = $this->db->get();
          $modules = $query->result();

          return $modules;
     }

     public function search_denomination($code){
          $this->db->select('*');
          $this->db->from('evaluations');
          $this->db->where('evaluation_code', $code);
          $query = $this->db->get();
          $evaluations = $query->result();
          foreach ($evaluations as $evaluation) {
               $this->db->select('*');
               $this->db->from('evaluation_details');
               $this->db->where('evaluation_id', $evaluation->evaluation_id);
               $this->db->group_by('evaluation_detail_name');
               $query = $this->db->get();
               $evaluation->details = $query->result();
               $evaluation->value = 0;
               foreach ($evaluation->details as $details) {
                    $evaluation->value += $details->evaluation_detail_value;
               }
          }
          return $evaluations;
     }

}
