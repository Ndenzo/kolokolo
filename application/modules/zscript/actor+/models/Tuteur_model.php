<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tuteur_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/tuteurs/';
     }
     public function insert($args = array())
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('personnes');
          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('personnes', $data);
          $personne_id = $this->db->insert_id();
          $this->update_picture($personne_id);
          $data = IBEMS_Model::sanitize_for('tuteurs');
          $data['personne_id'] = $personne_id;
          $data['tuteur_added_by'] = $this->__user_id;
          $data['tuteur_added'] = time();
          $data['tuteur_modified'] = time();
          $data['tuteur_locked'] = 0;
          $this->db->insert('tuteurs', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }
     public function update($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('personne_id');
          $data = IBEMS_Model::sanitize_for('personnes');
          $data['modified'] = time();
          $this->db->where('personne_id', $id);
          $this->db->update('personnes',$data);

          $this->update_picture($id);

          $data = IBEMS_Model::sanitize_for('tuteurs');
          $data['tuteur_modified'] = time();
          $this->db->where('personne_id', $id);
          $this->db->update('tuteurs',$data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }
     public function delete($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('personne_id');

          $this->db->where('personne_id', $id);
          $this->db->delete('tuteurs');

          $this->db->where('personne_id', $id);
          $this->db->delete('personnes');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('tuteurs');
          $this->db->join('personnes','personnes.personne_id = tuteurs.personne_id');
          $this->db->join('settings_fonctions','settings_fonctions.settings_fonction_id = tuteurs.settings_fonction_id');
          $this->db->where('tuteurs.personne_id',$id);
          return ($this->db->get()->row());
     }
     public function clean()
     {
          $this->db->select('*');
          $this->db->from('tuteurs');
          $this->db->join('personnes','personnes.personne_id = tuteurs.personne_id');
          $query = $this->db->get();
          $tuteurs = $query->result();
          $to_ignore = array();
          foreach($tuteurs as $tuteur) {
               if(!in_array($tuteur->tuteur_id, $to_ignore)){

                    $this->db->select('*');
                    $this->db->from('tuteurs');
                    $this->db->join('personnes','personnes.personne_id = tuteurs.personne_id');
                    $this->db->where('tuteur_id !=', $tuteur->tuteur_id);
                    $this->db->where('personne_telephone_1', $tuteur->personne_telephone_1);
                    $query = $this->db->get();
                    $duplications = @$query->result();
                    foreach ($duplications as $duplication) {
                         array_push($to_ignore, $duplication->tuteur_id);

                         $this->db->select('*');
                         $this->db->from('tuteur_eleves');
                         $this->db->join('eleves','eleves.eleve_id = tuteur_eleves.eleve_id');
                         $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
                         $this->db->join('tuteurs','tuteurs.tuteur_id = tuteur_eleves.tuteur_id');
                         $this->db->where('tuteurs.tuteur_id', $duplication->tuteur_id);
                         $query = $this->db->get();
                         $eleve = $query->row();

                         $data["tuteur_id"] = $tuteur->tuteur_id;
                         $this->db->where('eleve_id', $eleve->eleve_id);
                         $this->db->update('tuteur_eleves', $data);

                         $this->db->where('tuteur_id', $duplication->tuteur_id);
                         $this->db->delete('tuteurs');

                         $this->db->where('personne_id', $duplication->personne_id);
                         $this->db->delete('personnes');
                    }
               }
          }

          $this->db->select('*');
          $this->db->from('tuteurs');
          $this->db->join('personnes','personnes.personne_id = tuteurs.personne_id');
          $this->db->join('users_2_personnes','users_2_personnes.personne_id = tuteurs.personne_id');
          $this->db->join('users','users.user_id = users_2_personnes.user_id');
          $query = $this->db->get();
          $tuteurs = $query->result();
          foreach($tuteurs as $tuteur){
               $this->db->select('*');
               $this->db->from('users');
               $this->db->where('users.user_login', $tuteur->user_login);
               $this->db->where('users.user_id !=', $tuteur->user_id);
               $others = @$this->db->get()->result();
               if(count($others) != 0){
                    foreach ($others as $other) {
                         $this->db->where('user_id', $other->user_id);
                         $this->db->delete('users');
                    }
               }
          }
     }

     public function get_all($args = array())
     {
          self::clean();

          $this->db->select('*');
          $this->db->from('tuteurs');
          $this->db->join('tuteur_flags','tuteur_flags.tuteur_flag_id = tuteurs.tuteur_flag_id');
          $this->db->join('personnes','personnes.personne_id = tuteurs.personne_id');
          $this->db->join('users_2_personnes','users_2_personnes.personne_id = tuteurs.personne_id');
          $this->db->join('users','users.user_id = users_2_personnes.user_id');
          $tuteurs = $this->db->get()->result();
          foreach ($tuteurs as $tuteur) {
               $this->db->select('*');
               $this->db->from('tuteur_eleves');
               $this->db->join('eleves','eleves.eleve_id = tuteur_eleves.eleve_id');
               $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
               $this->db->join('tuteurs','tuteurs.tuteur_id = tuteur_eleves.tuteur_id');
               $this->db->where('tuteurs.tuteur_id', $tuteur->tuteur_id);
               $query = $this->db->get();
               $tuteur->eleves = $query->result();
          }

          return($tuteurs);
     }
     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('tuteur_id', $id);
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('tuteurs');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function get_eleves(){
          $this->db->select('*');
          $this->db->from('tuteurs');
          $this->db->join('personnes','personnes.personne_id = tuteurs.personne_id');
          $this->db->join('users_2_personnes','users_2_personnes.personne_id = tuteurs.personne_id');
          $this->db->join('users','users.user_id = users_2_personnes.user_id');
          $this->db->where('users.user_id', $this->__user_id);
          $tuteur = $this->db->get()->row();

          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
          $this->db->join('tuteur_eleves','tuteur_eleves.eleve_id = eleves.eleve_id');
          $this->db->join('eleve_flags','eleve_flags.eleve_flag_id = eleves.eleve_flag_id');
          $this->db->where('tuteur_eleves.tuteur_id', $tuteur->tuteur_id);
          $tuteur->eleves = $this->db->get()->result();

          foreach ($tuteur->eleves as $eleve) {
               $this->db->select('*');
               $this->db->from('eleves_scolarites');
               $this->db->join('settings_niveaux','settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
               $this->db->join('settings_scolarites','settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
               $this->db->where('eleves_scolarites.eleve_id', $eleve->eleve_id);
               $this->db->order_by('eleves_scolarites.settings_scolarite_id', "desc");
               $query = $this->db->get();
               $eleve->scolarite = $query->row();

               $this->db->select('*');
               $this->db->from('eleves_scolarites');
               $this->db->join('settings_scolarites','settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
               $this->db->join('settings_niveaux','settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
               $this->db->join('tarification_modeles','tarification_modeles.tarification_modele_id = eleves_scolarites.tarification_modele_id');
               $this->db->where('eleves_scolarites.eleve_id', $eleve->eleve_id);
               $this->db->order_by('settings_scolarites.settings_scolarite_id', 'desc');
               $eleve->eleve_scolarites = $this->db->get()->result();

               foreach ($eleve->eleve_scolarites as $scolarite) {
                    $this->db->select('*');
                    $this->db->from('support_module_niveaux');
                    $this->db->join('evaluation_modules', 'evaluation_modules.evaluation_module_id = support_module_niveaux.evaluation_module_id');
                    $this->db->where('settings_niveau_id', $scolarite->settings_niveau_id);
                    $query = $this->db->get();
                    $modules = @$query->result();
                    foreach($modules as $module) {
                         $this->db->select('*');
                         $this->db->from('supports');
                         $this->db->where('support_module_niveau_id', $module->support_module_niveau_id);
                         $this->db->where('settings_scolarite_id', $scolarite->settings_scolarite_id);
                         $query = $this->db->get();
                         $module->supports = @$query->result();
                    }

                    $eleve->modules = $modules;

                    $this->db->select('*');
                    $this->db->from('factures');
                    $this->db->join('factures_scolarites', 'factures_scolarites.facture_id = factures.facture_id');
                    $this->db->join('facture_flags', 'facture_flags.facture_flag_id = factures.facture_flag_id');
                    $this->db->where('facture_locked', 0);
                    $this->db->where('factures_scolarites.eleves_scolarite_id', $scolarite->eleves_scolarite_id);
                    $this->db->order_by('factures.facture_id', 'desc');
                    $query = $this->db->get();
                    $factures = $query->result();
                    foreach ($factures as $facture) {
                         $this->db->select('sum(tarification_details.tarification_detail_value) as montant, eleve_matricule');
                         $this->db->from('factures_scolarites_details');
                         $this->db->join('factures_scolarites', 'factures_scolarites.factures_scolarite_id = factures_scolarites_details.factures_scolarite_id');
                         $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
                         $this->db->join('eleves_scolarites', 'eleves_scolarites.eleves_scolarite_id = factures_scolarites.eleves_scolarite_id');
                         $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
                         $this->db->where('facture_id', $facture->facture_id);
                         $query = $this->db->get();
                         $facture->montant = (int)$query->row()->montant;
                         $facture->eleve_matricule = $query->row()->eleve_matricule;
                         $this->db->select('sum(encaissements.encaissement_value) as encaissement');
                         $this->db->from('encaissements');
                         $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
                         $this->db->where('factures.facture_id', $facture->facture_id);
                         $query = $this->db->get();
                         $facture->encaissement = (int)$query->row()->encaissement;
                    }

                    $scolarite->factures = $factures;
               }


          }

          return $tuteur;
     }

     public function update_picture($personne_id)
     {
          $path = $this->img_base_path.'personne-'.$personne_id;

          $upload = do_upload('photo',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['photo'] = $path.'/'.$upload['data']['file_name'];
               $args['modified'] = time();

               $this->db->where('personne_id', $personne_id);
               $this->db->update('personnes', $args);
          }
     }

     public function change_status()
     {
          $this->db->trans_start();
          $id = $this->input->post('tuteur_id');

          $data = IBEMS_Model::sanitize_for('tuteurs');
          $this->db->where('tuteur_id', $id);
          $this->db->update('tuteurs', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }
}
