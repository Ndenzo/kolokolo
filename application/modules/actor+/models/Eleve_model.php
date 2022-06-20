<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class eleve_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/eleves/';
     }
     public function insert($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('personnes');
          $data['personne_added_by'] = $this->__user_id;
          $data['personne_added'] = time();
          $data['personne_modified'] = time();
          $data['personne_locked'] = 0;
          $this->db->insert('personnes', $data);
          $personne_id = $this->db->insert_id();
          $this->update_picture($personne_id);

          $data = IBEMS_Model::sanitize_for('eleves');
          $data['personne_id'] = $personne_id;
          $data['eleve_flag_id'] = id_getter('eleve_flag_id', 'eleve_flags', 'eleve_flag_code', 'ins');
          $data['eleve_date_deb'] = gmdate('Y-m-d');
          $data['eleve_added_by'] = $this->__user_id;
          $data['eleve_added'] = time();
          $data['eleve_modified'] = time();
          $data['eleve_locked'] = 0;
          $this->db->insert('eleves', $data);
          $eleve_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('eleves_scolarites');
          $data['eleve_id'] = $eleve_id;
          $this->db->insert('eleves_scolarites', $data);
          $eleves_scolarite_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('personnes');
          $data['personne_id'] = null;
          $data['personne_prenoms'] = $this->input->post('prenoms_tuteur');
          $data['personne_nom'] = $this->input->post('nom_tuteur');
          $data['personne_added_by'] = $this->__user_id;
          $data['personne_added'] = time();
          $data['personne_modified'] = time();
          $data['personne_locked'] = 0;
          $this->db->insert('personnes', $data);
          $personne_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('users');
          $data['role_id'] = id_getter('role_id', 'users_roles', 'role_code', 'tuteur');
          $data['user_login'] = $this->input->post('personne_telephone_1');
          $data['user_nicename'] = $this->input->post('prenoms_tuteur')." ".$this->input->post('nom_tuteur');
          $data['user_registered'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;

          $tmp = explode("-", $data['user_login']);
          $code = $tmp[count($tmp)-2]."".$tmp[count($tmp)-1];
          $data['hash'] = crypt($code, salt(32));

          $this->db->insert('users', $data);
          $user_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('users_2_personnes');
          $data['user_id'] = $user_id;
          $data['personne_id'] = $personne_id;
          $this->db->insert('users_2_personnes', $data);

          $data = IBEMS_Model::sanitize_for('tuteurs');
          $data['personne_id'] = $personne_id;
          $data['tuteur_added_by'] = $this->__user_id;
          $data['tuteur_added'] = time();
          $data['tuteur_modified'] = time();
          $data['tuteur_locked'] = 0;
          $this->db->insert('tuteurs', $data);
          $tuteur_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('tuteur_eleves');
          $data['tuteur_id'] = $tuteur_id;
          $data['eleve_id'] = $eleve_id;
          $this->db->insert('tuteur_eleves', $data);

          $data = IBEMS_Model::sanitize_for('factures');
          $data['facture_num'] = facture_code_generator();
          $data['facture_flag_id'] = id_getter('facture_flag_id', 'facture_flags', 'facture_flag_code', '!reg');
          $data['facture_added_by'] = $this->__user_id;
          $data['facture_added'] = time();
          $data['facture_modified'] = time();
          $data['facture_locked'] = 0;
          $this->db->insert('factures', $data);
          $facture_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('factures_scolarites');
          $data['facture_id'] = $facture_id;
          $data['eleves_scolarite_id'] = $eleves_scolarite_id;
          $this->db->insert('factures_scolarites', $data);
          $factures_scolarite_id = $this->db->insert_id();

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_modele_id', $this->input->post('tarification_modele_id'));
          $this->db->where('tarification_code', 'ins');
          $query = $this->db->get();
          $details = $query->result();
          foreach ($details as $detail) {
               $data = IBEMS_Model::sanitize_for('factures_scolarites_details');
               $data['factures_scolarite_id'] = $factures_scolarite_id;
               $data['tarification_detail_id'] = $detail->tarification_detail_id;
               $this->db->insert('factures_scolarites_details', $data);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               var_dump($this->db->trans_status());
               return false;
          }
          redirect('billing/billing/showFacture/'.$facture_id);
     }

     public function insert_renew($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('eleves');
          $data['eleve_flag_id'] = id_getter('eleve_flag_id', 'eleve_flags', 'eleve_flag_code', "ins");;;
          $this->db->where('eleve_id',  $this->input->post('eleve_id'));
          $this->db->update('eleves',$data);

          $data = IBEMS_Model::sanitize_for('eleves_scolarites');
          $this->db->insert('eleves_scolarites', $data);
          $eleves_scolarite_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('factures');
          $data['facture_num'] = facture_code_generator();
          $data['facture_flag_id'] = id_getter('facture_flag_id', 'facture_flags', 'facture_flag_code', '!reg');
          $data['facture_added_by'] = $this->__user_id;
          $data['facture_added'] = time();
          $data['facture_modified'] = time();
          $data['facture_locked'] = 0;
          $this->db->insert('factures', $data);
          $facture_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('factures_scolarites');
          $data['facture_id'] = $facture_id;
          $data['eleves_scolarite_id'] = $eleves_scolarite_id;
          $this->db->insert('factures_scolarites', $data);
          $factures_scolarite_id = $this->db->insert_id();

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_modele_id', $this->input->post('tarification_modele_id'));
          $this->db->where('tarification_code', 'ins');
          $query = $this->db->get();
          $details = $query->result();
          foreach ($details as $detail) {
               $data = IBEMS_Model::sanitize_for('factures_scolarites_details');
               $data['factures_scolarite_id'] = $factures_scolarite_id;
               $data['tarification_detail_id'] = $detail->tarification_detail_id;
               $this->db->insert('factures_scolarites_details', $data);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               var_dump($this->db->trans_status());
               return false;
          }
          redirect('billing/billing/showFacture/'.$facture_id);
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

     public function insert_comment(){
          $data = IBEMS_Model::sanitize_for('eleve_scolarite_comments');
          $data['eleve_scolarite_comment_added_by'] = $this->__user_id;
          $data['eleve_scolarite_comment_added'] = time();
          $data['eleve_scolarite_comment_modified'] = time();
          $data['eleve_scolarite_comment_locked'] = 0;
          return ($this->db->insert('eleve_scolarite_comments',$data));
     }

     public function insert_mutation($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('eleves_scolarite_id');
          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->where('eleves_scolarite_id', $id);

          $scolarite = $this->db->get()->row_array();

          $data = IBEMS_Model::sanitize_for('eleves_prev_scolarites', $scolarite);
          $this->db->insert('eleves_prev_scolarites', $data);

          $data = IBEMS_Model::sanitize_for('eleves_scolarites');
          $this->db->where('eleves_scolarite_id', $id);
          $this->db->update('eleves_scolarites', $data);

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

          $id = $this->input->post('tuteur_personne_id');
          $data = IBEMS_Model::sanitize_for('personnes');
          $data['personne_prenoms'] = $this->input->post('prenoms_tuteur');
          $data['personne_nom'] = $this->input->post('nom_tuteur');
          $data['personne_modified'] = time();
          $this->db->where('personne_id', $id);
          $this->db->update('personnes',$data);

          $id = $this->input->post('eleve_personne_id');
          $data = IBEMS_Model::sanitize_for('personnes');
          $data['personne_modified'] = time();
          $this->db->where('personne_id', $id);
          $this->db->update('personnes',$data);

          $this->update_picture($id);

          $data = IBEMS_Model::sanitize_for('eleves');
          $data['eleve_modified'] = time();
          $this->db->where('personne_id', $id);
          $this->db->update('eleves',$data);

          $renseignement_id = id_getter('renseignement_id', 'renseignements', 'eleve_id', $this->input->post('eleve_id'));

          if($renseignement_id != null){
               $data = IBEMS_Model::sanitize_for('renseignements');
               $data['renseignement_modified'] = time();
               $this->db->where('renseignement_id', $renseignement_id);
               $this->db->update('renseignements', $data);
          }else{
               $data = IBEMS_Model::sanitize_for('renseignements');
               $data['renseignement_added_by'] = $this->__user_id;
               $data['renseignement_added'] = time();
               $data['renseignement_modified'] = time();
               $data['renseignement_locked'] = 0;
               $this->db->insert('renseignements', $data);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update_scolarite($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('eleves_scolarites');
          $data["settings_scolarite_id"] = get_current_scolarite()->settings_scolarite_id;
          $this->db->where('eleves_scolarite_id', $this->input->post('eleves_scolarite_id'));
          $this->db->update('eleves_scolarites', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function init_scolarite($args = array())
     {
          $this->db->trans_start();

          $eleves_scolarite_id = $this->input->post('eleves_scolarite_id');

          $data = IBEMS_Model::sanitize_for('eleves_scolarites');
          $data["settings_scolarite_id"] = get_current_scolarite()->settings_scolarite_id;
          $this->db->where('eleves_scolarite_id', $eleves_scolarite_id);
          $this->db->update('eleves_scolarites', $data);

          $this->db->where('eleves_scolarite_id', $eleves_scolarite_id);
          $this->db->delete('factures_scolarites');

          $data = IBEMS_Model::sanitize_for('factures');
          $data['facture_num'] = facture_code_generator();
          $data['facture_flag_id'] = id_getter('facture_flag_id', 'facture_flags', 'facture_flag_code', '!reg');
          $data['facture_added_by'] = $this->__user_id;
          $data['facture_added'] = time();
          $data['facture_modified'] = time();
          $data['facture_locked'] = 0;
          $this->db->insert('factures', $data);
          $facture_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('factures_scolarites');
          $data['facture_id'] = $facture_id;
          $data['eleves_scolarite_id'] = $eleves_scolarite_id;
          $this->db->insert('factures_scolarites', $data);
          $factures_scolarite_id = $this->db->insert_id();

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_modele_id', $this->input->post('tarification_modele_id'));
          $this->db->where('tarification_code', 'ins');
          $query = $this->db->get();
          $details = $query->result();
          foreach ($details as $detail) {
               $data = IBEMS_Model::sanitize_for('factures_scolarites_details');
               $data['factures_scolarite_id'] = $factures_scolarite_id;
               $data['tarification_detail_id'] = $detail->tarification_detail_id;
               $this->db->insert('factures_scolarites_details', $data);
          }

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
          $this->db->delete('eleves');

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
          $renseignement_id = id_getter('renseignement_id', 'renseignements', 'eleve_id', $id);

          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
          $this->db->join('eleve_flags','eleve_flags.eleve_flag_id = eleves.eleve_flag_id');
          if($renseignement_id != null){
               $this->db->join('renseignements','renseignements.eleve_id = eleves.eleve_id');
               $this->db->where('renseignement_id', $renseignement_id);
          }
          $this->db->where('eleves.eleve_id',$id);
          $eleve = $this->db->get()->row();
          $eleve->eleve_personne_id = $eleve->personne_id;

          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->join('settings_niveaux','settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
          $this->db->join('settings_scolarites','settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
          $this->db->where('eleves_scolarites.eleve_id', $eleve->eleve_id);
          $this->db->order_by('eleves_scolarites.settings_scolarite_id', "desc");
          $eleve->scolarite = $this->db->get()->row();

          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->join('settings_niveaux','settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
          $this->db->join('settings_scolarites','settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
          $this->db->where('eleves_scolarites.eleve_id', $eleve->eleve_id);
          $this->db->order_by('eleves_scolarites.settings_scolarite_id', "desc");
          $eleve->scolarites = $this->db->get()->result();

          foreach ($eleve->scolarites as $scolarite) {
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

               $this->db->select('*');
               $this->db->from('eleve_scolarite_comments');
               $this->db->join('users', 'users.user_id = eleve_scolarite_comments.eleve_scolarite_comment_added_by');
               $this->db->join('users_2_personnes', 'users_2_personnes.user_id = users.user_id');
               $this->db->join('personnes', 'personnes.personne_id = users_2_personnes.personne_id');
               $this->db->where('eleve_scolarite_comments.eleves_scolarite_id', $scolarite->eleves_scolarite_id);
               $this->db->order_by('eleve_scolarite_comments.eleve_scolarite_comment_id', "desc");
               $scolarite->comments = $this->db->get()->result();

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


               $this->db->select('*');
               $this->db->from('eleves_reductions');
               $this->db->where('eleves_scolarite_id', $scolarite->eleves_scolarite_id);
               $query = $this->db->get();
               $scolarite->reduction = $query->row();
          }

          $this->db->select('personne_prenoms as prenoms_tuteur, personne_nom as nom_tuteur, tuteurs.personne_id');
          $this->db->from('tuteurs');
          $this->db->join('personnes', 'personnes.personne_id = tuteurs.personne_id');
          $this->db->join('tuteur_eleves', 'tuteur_eleves.tuteur_id = tuteurs.tuteur_id');
          $this->db->where('tuteur_eleves.eleve_id', $eleve->eleve_id);
          $query = $this->db->get();
          $eleve->prenoms_tuteur = $query->row()->prenoms_tuteur;
          $eleve->nom_tuteur = $query->row()->nom_tuteur;
          $eleve->tuteur_personne_id = $query->row()->personne_id;

          return $eleve;
     }

     public function get_one_scolarite($id)
     {
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
          $this->db->join('eleves_scolarites','eleves_scolarites.eleve_id = eleves.eleve_id');
          $this->db->join('settings_niveaux','settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
          $this->db->join('settings_cycles','settings_cycles.settings_cycle_id = settings_niveaux.settings_cycle_id');
          $this->db->join('settings_scolarites','settings_scolarites.settings_scolarite_id = eleves_scolarites.settings_scolarite_id');
          $this->db->join('classes','classes.settings_niveau_id = settings_niveaux.settings_niveau_id');
          $this->db->where('eleves_scolarites.eleve_id', $id);
          $this->db->order_by('eleves_scolarites.settings_scolarite_id', "desc");
          $eleve = $this->db->get()->row();

          return $eleve;
     }

     public function clean(){
          $settings_scolarite_id = get_current_scolarite()->settings_scolarite_id;
          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
          $this->db->join('eleve_flags','eleve_flags.eleve_flag_id = eleves.eleve_flag_id');
          $eleves = $this->db->get()->result();

          foreach ($eleves as $key => $eleve) {
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
               $this->db->where('eleves_scolarites.eleve_id', $eleve->eleve_id);
               $this->db->where('eleves_scolarites.eleves_scolarite_id !=', $eleve->scolarite->eleves_scolarite_id);
               $this->db->where('eleves_scolarites.settings_scolarite_id', $eleve->scolarite->settings_scolarite_id);
               $doublons = @$this->db->get()->result();
               if($doublons != null){
                    foreach ($doublons as $doublon) {
                         $this->db->where('eleves_scolarite_id', $doublon->eleves_scolarite_id);
                         $this->db->delete('eleves_scolarites');
                    }
               }
          }

          foreach ($eleves as $key => $eleve) {
               if($eleve->scolarite->settings_scolarite_id != $settings_scolarite_id){
                    $data = array();
                    $data["eleve_date_fin"] = $eleve->scolarite->settings_scolarite_date_fin;
                    $data["eleve_flag_id"] = id_getter('eleve_flag_id', 'eleve_flags', 'eleve_flag_code', "dep");
                    $this->db->where('eleve_id', $eleve->eleve_id);
                    $this->db->update('eleves', $data);
               }
          }
     }

     public function get_all($args = array())
     {
          self::clean();

          $this->db->select('*');
          $this->db->from('eleves');
          $this->db->join('personnes','personnes.personne_id = eleves.personne_id');
          $this->db->join('eleve_flags','eleve_flags.eleve_flag_id = eleves.eleve_flag_id');
          $this->db->order_by('eleves.eleve_id', "desc");
          $eleves = $this->db->get()->result();

          foreach ($eleves as $key => $eleve) {
               $this->db->select('*');
               $this->db->from('eleves_scolarites');
               $this->db->join('settings_niveaux','settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
               $this->db->join('tarification_modeles','tarification_modeles.tarification_modele_id = eleves_scolarites.tarification_modele_id');
               $this->db->where('eleves_scolarites.eleve_id', $eleve->eleve_id);
               $this->db->order_by('eleves_scolarites.settings_scolarite_id', "desc");
               $eleve->scolarite = $this->db->get()->row();

               $this->db->select('*');
               $this->db->from('eleves_reductions');
               $this->db->where('eleves_scolarite_id', @$eleve->scolarite->eleves_scolarite_id);
               $query = $this->db->get();
               $eleve->scolarite->reduction = $query->row();
          }

          return $eleves;
     }

     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('eleve_id', $id);
          return ($this->db->get()->result());
     }

     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('eleves');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function update_picture($personne_id)
     {
          $path = $this->img_base_path.'personne-'.$personne_id;

          $upload = do_upload('personne_photo',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['personne_photo'] = $path.'/'.$upload['data']['file_name'];
               $args['personne_modified'] = time();

               $this->db->where('personne_id', $personne_id);
               $this->db->update('personnes', $args);
          }
     }

     public function insert_image($personne_id)
     {
          $path = $this->img_base_path.'personne-'.$personne_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'personne-'.$personne_id)){
               mkdir($this->img_base_path.'personne-'.$personne_id, 0777, true);
          }

          // open the output file for writing
          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          // split the string on commas
          // $data[ 0 ] == "data:image/png;base64"
          // $data[ 1 ] == <actual base64 string>
          $data = explode( ',', $base64_string );

          // we could add validation here with ensuring count( $data ) > 1
          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['personne_photo'] = $path;
               $args['personne_modified'] = time();

               $this->db->where('personne_id', $personne_id);
               $this->db->update('personnes', $args);
          }
     }
}
