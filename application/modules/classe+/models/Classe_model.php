<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classe_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     // Classes ---------------------------------------------------------------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('classes');
          return ($this->db->insert('classes',$data));
     }

     public function update($args = array())
     {
          $id = $this->input->post('classe_id');
          $data = IBEMS_Model::sanitize_for('classes');
          $this->db->where('classe_id', $id);
          return($this->db->update('classes',$data));
     }

     public function move($args = array())
     {
          $data['classe_id'] = $this->input->post('classe_id');
          $eleves_scolarite_id = $this->input->post('eleves_scolarite_id');

          $this->db->where('eleves_scolarite_id', $eleves_scolarite_id);
          return($this->db->update('eleves_scolarites', $data));
     }

     public function delete($args = array())
     {
          $id = $this->input->post('classe_id');
          $this->db->where('classe_id', $id);
          return($this->db->delete('classes'));
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('classes');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = classes.settings_niveau_id');
          $this->db->where('classe_id',$id);
          return ($this->db->get()->row());
     }

     public function get_scolarite_one($id)
     {
          $this->db->select('eleves_scolarite_id, personne_prenoms, personne_nom, classe_id');
          $this->db->from('eleves_scolarites');
          $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->where("eleves_scolarites.eleves_scolarite_id", $id);
          $query = $this->db->get();
          $eleve = $query->row();
          $eleve->{"personne_full_name_".$eleve->classe_id} = $eleve->personne_prenoms." ".$eleve->personne_nom;
          $eleve->{"eleves_scolarite_id_".$eleve->classe_id} = $eleve->eleves_scolarite_id;
          return ($eleve);
     }

     public function get_all($args = array())
     {
          $result = array();
          $this->db->select('*');
          $this->db->from('settings_cycles');
          $query = $this->db->get();
          $cycles = $query->result();
          foreach ($cycles as $cycle) {
               $this->db->select('*');
               $this->db->from('settings_niveaux');
               $this->db->where('settings_cycle_id', $cycle->settings_cycle_id);
               $this->db->order_by("settings_niveau_code", "desc");
               $query = $this->db->get();
               $niveaux = $query->result();
               $cycle->niveaux = array();
               foreach ($niveaux as $niveau) {
                    $ignore = self::get_nb_splited($niveau->settings_niveau_id);
                    $this->db->select('*');
                    $this->db->from('eleves');
                    $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
                    $this->db->where("eleves_scolarites.settings_niveau_id", $niveau->settings_niveau_id);
                    $this->db->where("eleves_scolarites.settings_scolarite_id", $_SESSION['dashboard']['settings_scolarite_id']);
                    if($ignore != null)
                    $this->db->where_not_in("eleves.eleve_id", $ignore);
                    $query = $this->db->get();

                    $niveau->nb_eleves = $query->num_rows();

                    $this->db->select('*');
                    $this->db->from('eleves');
                    $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
                    $this->db->where("eleves_scolarites.settings_niveau_id", $niveau->settings_niveau_id);
                    $this->db->where("eleves_scolarites.settings_scolarite_id", $_SESSION['dashboard']['settings_scolarite_id']);
                    $query = $this->db->get();

                    $niveau->n_eleves = $query->num_rows();

                    $this->db->select('*');
                    $this->db->from('classes');
                    $this->db->where('settings_niveau_id', $niveau->settings_niveau_id);
                    $query = $this->db->get();
                    $classes = $query->result();
                    $niveau->classes = array();
                    foreach ($classes as $classe) {
                         $this->db->select('*');
                         $this->db->from('eleves_scolarites');
                         $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
                         $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
                         $this->db->where("eleves_scolarites.settings_scolarite_id", $_SESSION['dashboard']['settings_scolarite_id']);
                         $this->db->where('classe_id', $classe->classe_id);
                         $this->db->order_by("personne_nom");
                         $this->db->order_by("personne_prenoms");
                         $query = $this->db->get();
                         $classe->eleves = $query->result();
                         array_push($niveau->classes, $classe);
                    }
                    array_push($cycle->niveaux, $niveau);
               }
               array_push($result, $cycle);
          }
          return ($result);
     }

     public function get_classes($settings_niveau_id)
     {
          $result = array();

          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->where("settings_niveau_id", $settings_niveau_id);
          $this->db->where('eleves.eleve_flag_id', 1);
          $query = $this->db->get();
          $niveau->nb_eleves = $query->result();

          $this->db->select('*');
          $this->db->from('classes');
          $this->db->where('settings_niveau_id', $niveau->settings_niveau_id);
          $query = $this->db->get();
          $classes = $query->result();
          $niveau->classes = array();
          foreach ($classes as $classe) {
               array_push($niveau->classes, $classe);
          }

          return ($result);
     }

     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('classes');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     // Days ---------------------------------------------------------------------------------------------------------------

     public function insert_matiere($args = array())
     {
          $this->db->trans_start();

          $data = array();
          $data['classe_id'] = $this->input->post('classe_id');
          $settings_matiere_ids = $this->input->post('settings_matiere_id');
          foreach ($settings_matiere_ids as $key => $settings_matiere_id) {
               $data['settings_matiere_id'] = $settings_matiere_id;
               $this->db->insert('classes_matieres',$data);
          }
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               var_dump($this->db->trans_status());
               return false;
          }
          return true;
     }

     // public function insert_matiere($args = array())
     // {
     //      $data = IBEMS_Model::sanitize_for('classes_matieres');
     //      return ($this->db->insert('classes_matieres',$data));
     // }

     public function get_classe_matieres($classe_id){
          $this->db->select('*');
          $this->db->from('classes_matieres');
          $this->db->join('settings_matieres', 'settings_matieres.settings_matiere_id = classes_matieres.settings_matiere_id');
          $this->db->where("classe_id", $classe_id);
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }

     // Days ---------------------------------------------------------------------------------------------------------------

     public function insert_cours($args = array())
     {
          $data = IBEMS_Model::sanitize_for('cours_classes');
          return ($this->db->insert('cours_classes',$data));
     }

     public function update_cours($args = array())
     {
          $id = $this->input->post('cours_classe_id');
          $data = IBEMS_Model::sanitize_for('cours_classes');
          $this->db->where('cours_classe_id', $id);
          return($this->db->update('cours_classes',$data));
     }

     public function delete_cours($args = array())
     {
          $id = $this->input->post('cours_classe_id');
          $this->db->where('cours_classe_id', $id);
          return($this->db->delete('cours_classes'));
     }

     public function get_cours($classe_id){
          $this->db->select('*');
          $this->db->from('cours_classes');
          $this->db->join('classes_matieres', 'classes_matieres.classes_matiere_id = cours_classes.classes_matiere_id');
          $this->db->join('settings_matieres', 'settings_matieres.settings_matiere_id = classes_matieres.settings_matiere_id');
          $this->db->join('settings_matiere_types', 'settings_matiere_types.settings_matiere_type_id = settings_matieres.settings_matiere_type_id');
          $this->db->join('settings_jours', 'settings_jours.settings_jour_id = cours_classes.settings_jour_id');
          $this->db->where('classe_id', $classe_id);
          $this->db->order_by('settings_jours.settings_jour_code', "asc");
          $this->db->order_by('cours_classes.cours_classe_heure_deb', "asc");
          $this->db->order_by('cours_classes.cours_classe_heure_fin', "asc");
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }

     public function get_cours_one($cours_classe_id){
          $this->db->select('*');
          $this->db->from('cours_classes');
          $this->db->join('classes_matieres', 'classes_matieres.classes_matiere_id = cours_classes.classes_matiere_id');
          $this->db->join('settings_matieres', 'settings_matieres.settings_matiere_id = classes_matieres.settings_matiere_id');
          $this->db->join('settings_jours', 'settings_jours.settings_jour_id = cours_classes.settings_jour_id');
          $this->db->where('cours_classes.cours_classe_id', $cours_classe_id);
          $query = $this->db->get();
          $result = $query->row();
          return ($result);
     }

     // Days ---------------------------------------------------------------------------------------------------------------

     public function insert_horaire($args = array())
     {
          $data = IBEMS_Model::sanitize_for('classes_horaires');
          $data['classes_horaire_added_by'] = $this->__user_id;
          $data['classes_horaire_added'] = time();
          $data['classes_horaire_modified'] = time();
          $data['classes_horaire_locked'] = 0;
          return ($this->db->insert('classes_horaires',$data));
     }

     public function delete_horaire($args = array())
     {
          $id = $this->input->post('classes_horaire_id');
          $this->db->where('classes_horaire_id', $id);
          return($this->db->delete('classes_horaires'));
     }

     public function get_horaires($classe_id)
     {
          $result = array();
          $this->db->select('*');
          $this->db->from('classes_horaires');
          $this->db->where('classes_horaires.classe_id', $classe_id);
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }

     // Days ---------------------------------------------------------------------------------------------------------------

     public function insert_days($args = array())
     {
          $this->db->trans_start();

          $jour_ids = $this->input->post('jour_id');

          $settings_jours = self::get_jours($this->input->post('classe_id'));

          if(is_array($jour_ids)) {
               foreach ($jour_ids as $jour_id) {
                    $this->db->select('*');
                    $this->db->from('classes_jours');
                    $this->db->where('classe_id', $this->input->post('classe_id'));
                    $this->db->where('settings_jour_id', $jour_id);
                    $classes_jour = @$this->db->get()->row();
                    if ($classes_jour == null) {
                         $data = IBEMS_Model::sanitize_for('classes_jours');
                         $data['settings_jour_id'] = $jour_id;
                         $data['classes_jour_added_by'] = $this->__user_id;
                         $data['classes_jour_added'] = time();
                         $data['classes_jour_modified'] = time();
                         $data['classes_jour_locked'] = 0;
                         $this->db->insert('classes_jours', $data);
                    }
               }

               foreach ($settings_jours as $key => $settings_jour) {
                    $this->db->select('*');
                    $this->db->from('classes_jours');
                    $this->db->where('classe_id', $this->input->post('classe_id'));
                    $this->db->where('settings_jour_id', $settings_jour->settings_jour_id);
                    $classes_jour = @$this->db->get()->row();
                    if(!in_array(@$classes_jour->settings_jour_id, $jour_ids)){
                         $this->db->where('classe_id', $this->input->post('classe_id'));
                         $this->db->where('settings_jour_id', $settings_jour->settings_jour_id);
                         $this->db->delete('classes_jours');
                    }
               }
          }else{
               $this->db->where('classe_id', $this->input->post('classe_id'));
               $this->db->delete('classes_jours');
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               var_dump($this->db->trans_status());
               return false;
          }

          return true;
     }

     public function get_jours($classe_id)
     {
          $result = array();
          $this->db->select('*');
          $this->db->from('classes_jours');
          $this->db->join('settings_jours', 'settings_jours.settings_jour_id = classes_jours.settings_jour_id');
          $this->db->where('classes_jours.classe_id', $classe_id);
          $query = $this->db->get();
          $result = @$query->result();
          return ($result);
     }

     public function get_opendays($classe_id)
     {
          $result = array();
          $this->db->select('*');
          $this->db->from('classes_jours');
          $this->db->join('settings_jours', 'settings_jours.settings_jour_id = classes_jours.settings_jour_id');
          $this->db->where('classes_jours.classe_id', $classe_id);
          $query = $this->db->get();
          $opendays = $query->result();
          foreach ($opendays as $openday) {
               array_push($result, $openday->settings_jour_id);
          }
          return ($result);
     }

     public function get_settings_jours($classe_id)
     {
          $this->db->select('*');
          $this->db->from('settings_jours');
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }

     // Spliters ---------------------------------------------------------------------------------------------------------------

     public function get_nb_splited($niveau_id){
          $result = array();
          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->join('eleves','eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->where('eleves_scolarites.settings_niveau_id', $niveau_id);
          $this->db->where('classe_id !=', null);
          $query = $this->db->get();
          $eleves = $query->result();
          foreach ($eleves as $eleve) {
               array_push($result, $eleve->eleve_id);
          }
          return $result;
     }

     public function classe_spliter($settings_niveau_id){
          $this->db->trans_start();

          $ignore = self::get_nb_splited($settings_niveau_id);
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->where("settings_niveau_id", $settings_niveau_id);
          if($ignore != null)
          $this->db->where_not_in("eleve_id", $ignore);
          $query = $this->db->get();
          $eleves = $query->result();

          for($i=0; $i<count($eleves); $i++){
               $this->db->select('*');
               $this->db->from('classes');
               $this->db->where('settings_niveau_id', $settings_niveau_id);
               $query = $this->db->get();
               $classes = $query->result();
               $nb_eleves = array();
               $min_id = $classes[0]->classe_id;
               $min = null;
               foreach ($classes as $classe) {
                    $this->db->select('*');
                    $this->db->from('eleves_scolarites');
                    $this->db->where('classe_id', $classe->classe_id);
                    $query = $this->db->get();
                    $nb = (int)$query->num_rows();
                    if($min == null){
                         $min = $nb;
                    }
                    else{
                         if($min > $nb){
                              $min = $nb;
                              $min_id = $classe->classe_id;
                         }
                    }
               }
               $data["classe_id"] = $min_id;
               $this->db->where('eleve_id', $eleves[$i]->eleve_id);
               $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
               $this->db->update('eleves_scolarites', $data);
          }
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;

     }

     public function cards_get_all(){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->where('settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->order_by("classe_id");
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
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
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
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


     // Members ---------------------------------------------------------------------------------------------------------------

     public function get_eleves_classe($classe_id){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->where("eleves_scolarites.settings_scolarite_id", $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->where("classe_id", $classe_id);
          $this->db->where('eleves.eleve_flag_id', 1);
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }

     public function get_eleves_classe_by_name($classe_id){
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->where("eleves_scolarites.settings_scolarite_id", $_SESSION['dashboard']['settings_scolarite_id']);
          $this->db->where("classe_id", $classe_id);
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
          $this->db->where('eleves.eleve_flag_id', 1);
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }

     public function get_enseignant_classe($classe_id){
          $this->db->select('*');
          $this->db->from('enseignants');
          $this->db->join('employes', 'employes.employe_id = enseignants.employe_id');
          $this->db->join('personnes', 'personnes.personne_id = employes.personne_id');
          $this->db->join('cours_classes', 'cours_classes.enseignant_id = enseignants.enseignant_id');
          $this->db->join('classes_matieres', 'classes_matieres.classes_matiere_id = cours_classes.classes_matiere_id');
          $this->db->where("classes_matieres.classe_id", $classe_id);
          $this->db->group_by('enseignants.enseignant_id');
          $query = $this->db->get();
          $result = $query->result();
          return ($result);
     }
}
