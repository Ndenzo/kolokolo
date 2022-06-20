<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Billing_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     public function insert_individual(){

          $this->db->trans_start();

          $eleve_matricule = (int) $this->input->post('eleve_matricule');
          $settings_scolarite_id = (int) $this->input->get_post('settings_scolarite_id');

          $this->db->select('tarification_modele_id, personne_prenoms, personne_nom, eleves_scolarite_id');
          $this->db->from('eleves_scolarites');
          $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->where('eleves.eleve_matricule', $eleve_matricule);
          $this->db->where('eleves_scolarites.settings_scolarite_id', $settings_scolarite_id);
          $query = $this->db->get();
          $tarification_modele =  $query->row();

          $data = IBEMS_Model::sanitize_for('factures');
          $data['facture_num'] = facture_code_generator();
          $data['facture_remise'] = $this->input->post('reduction_total');
          $data['facture_flag_id'] = id_getter('facture_flag_id', 'facture_flags', 'facture_flag_code', '!reg');
          $data['facture_added_by'] = $this->__user_id;
          $data['facture_added'] = time();
          $data['facture_modified'] = time();
          $data['facture_locked'] = 0;
          $this->db->insert('factures', $data);
          $facture_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('factures_scolarites');
          $data['facture_id'] = $facture_id;
          $data['eleves_scolarite_id'] = $tarification_modele->eleves_scolarite_id;
          $this->db->insert('factures_scolarites', $data);
          $factures_scolarite_id = $this->db->insert_id();

          $this->db->select("tarification_details.tarification_detail_id");
          $this->db->from("tarification_details");
          $this->db->join("factures_scolarites_details", "factures_scolarites_details.tarification_detail_id = tarification_details.tarification_detail_id");
          $this->db->join("factures_scolarites", "factures_scolarites.factures_scolarite_id = factures_scolarites_details.factures_scolarite_id");
          $this->db->join("eleves_scolarites", "eleves_scolarites.eleves_scolarite_id = factures_scolarites.eleves_scolarite_id");
          $this->db->join("eleves", "eleves.eleve_id = eleves_scolarites.eleve_id");
          $this->db->where("eleves.eleve_matricule", $eleve_matricule);
          $this->db->where('eleves_scolarites.settings_scolarite_id', $settings_scolarite_id);
          $query = $this->db->get();
          $tarification_details = $query->result();

          $to_ignore = array();

          foreach ($tarification_details as $tarification_detail) {
               array_push($to_ignore, $tarification_detail->tarification_detail_id);
          }

          $this->db->select("tarification_detail_id, tarification_detail_name, tarification_detail_value");
          $this->db->from("tarification_details");
          $this->db->where("tarification_modele_id", $tarification_modele->tarification_modele_id);
          $this->db->where_not_in("tarification_detail_id", $to_ignore);

          $query = $this->db->get();
          $unchecked_factures = $query->result();

          foreach ($unchecked_factures as $unchecked_facture) {
               if ($this->input->post('detail_checker_'.$unchecked_facture->tarification_detail_id) == "checked") {
                    $data = IBEMS_Model::sanitize_for('factures_scolarites_details');
                    $data['factures_scolarite_id'] = $factures_scolarite_id;
                    $data['tarification_detail_id'] = $unchecked_facture->tarification_detail_id;
                    $this->db->insert('factures_scolarites_details', $data);
               }
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               var_dump($this->db->trans_status());
               return false;
          }
          redirect('billing/billing/showFacture/'.$facture_id);
     }

     public function insert_grouped(){

          $this->db->trans_start();

          $classe_id = (int) $this->input->post('classe_id');
          $tarification_detail_id = (int) $this->input->post('tarification_detail_id');
          $settings_scolarite_id = (int) $this->input->get_post('settings_scolarite_id');

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->where('tarification_detail_id', $tarification_detail_id);
          $query = $this->db->get();
          $tarification_detail_name =  $query->row()->tarification_detail_name;

          $temp = explode(" ", $tarification_detail_name);
          $_SESSION['scolarite']['mois'] = $temp[1];

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->join('tarification_modele_niveaux', 'tarification_modele_niveaux.tarification_modele_id = tarification_details.tarification_modele_id');
          $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_modele_niveaux.tarification_modele_id');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = tarification_modele_niveaux.settings_niveau_id');
          $this->db->join('classes', 'classes.settings_niveau_id = settings_niveaux.settings_niveau_id');
          $this->db->where('classe_id', $classe_id);
          $this->db->where('tarification_detail_name', $tarification_detail_name);
          $this->db->where('tarification_modeles.settings_scolarite_id', $settings_scolarite_id);
          if($classe_id == 1 || $classe_id == 2 || $classe_id == 3){
               $this->db->order_by('tarification_details.tarification_detail_id', "desc");
          }
          $query = $this->db->get();
          $tarification_detail =  $query->row();

          $_SESSION['scolarite']['settings_niveau_name'] = $tarification_detail->settings_niveau_name;

          $this->db->select("eleve_id");
          $this->db->from("eleves_scolarites");
          $this->db->join("factures_scolarites", "factures_scolarites.eleves_scolarite_id = eleves_scolarites.eleves_scolarite_id");
          $this->db->join("factures_scolarites_details", "factures_scolarites_details.factures_scolarite_id = factures_scolarites.factures_scolarite_id");
          $this->db->where("classe_id", $classe_id);
          $this->db->where("tarification_detail_id", $tarification_detail->tarification_detail_id);
          $this->db->where('eleves_scolarites.settings_scolarite_id', $settings_scolarite_id);
          $query = $this->db->get();
          $eleves_scolarites = $query->result();

          $to_ignore = array();

          if(!empty($eleves_scolarites)){
               foreach ($eleves_scolarites as $eleves_scolarite) {
                    array_push($to_ignore, $eleves_scolarite->eleve_id);
               }
          }

          $this->db->select('*');
          $this->db->from('eleves_scolarites');
          $this->db->join("eleves", "eleves.eleve_id = eleves_scolarites.eleve_id");
          $this->db->join("personnes", "personnes.personne_id = eleves.personne_id");
          $this->db->where('classe_id', $classe_id);
          $this->db->where('eleves_scolarites.settings_scolarite_id', $settings_scolarite_id);
          $this->db->where('eleves.eleve_flag_id', 1);
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
          if(!empty($to_ignore)){
               $this->db->where_not_in('eleves.eleve_id', $to_ignore);
          }
          $query = $this->db->get();
          $eleves =  $query->result();

          $facture_ids = array();

          foreach ($eleves as $eleve) {

               $this->db->select('*');
               $this->db->from('eleves_reductions');
               $this->db->where('eleves_scolarite_id', $eleve->eleves_scolarite_id);
               $query = $this->db->get();
               $reduction =  $query->row();

               $data = IBEMS_Model::sanitize_for('factures');
               $data['facture_num'] = facture_code_generator();
               if($reduction != null){
                    $data['facture_remise'] = $reduction->eleves_reduction_value;
               }else{
                    $data['facture_remise'] = 0;
               }
               $data['facture_flag_id'] = id_getter('facture_flag_id', 'facture_flags', 'facture_flag_code', '!reg');
               $data['facture_added_by'] = $this->__user_id;
               $data['facture_added'] = time();
               $data['facture_modified'] = time();
               $data['facture_locked'] = 0;
               $this->db->insert('factures', $data);
               $facture_id = $this->db->insert_id();

               array_push($facture_ids, $facture_id);

               $data = IBEMS_Model::sanitize_for('factures_scolarites');
               $data['facture_id'] = $facture_id;
               $data['eleves_scolarite_id'] = $eleve->eleves_scolarite_id;
               $this->db->insert('factures_scolarites', $data);
               $factures_scolarite_id = $this->db->insert_id();

               $data = IBEMS_Model::sanitize_for('factures_scolarites_details');
               $data['factures_scolarite_id'] = $factures_scolarite_id;
               $data['tarification_detail_id'] = $tarification_detail->tarification_detail_id;
               $this->db->insert('factures_scolarites_details', $data);
          }

          $_SESSION['scolarite']['facture_ids'] = $facture_ids;

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               var_dump($this->db->trans_status());
               return false;
          }
          redirect('billing/billing/showGroupedFacture');
     }

     public function delete($args = array())
     {
          $id = $this->input->post('facture_id');
          $data['facture_locked'] = 1;
          $this->db->where('facture_id', $id);
          $query = $this->db->update('factures', $data);
          return($query);
     }

     public function get_one($facture_id){
          $this->db->select('*');
          $this->db->from('factures');
          $this->db->join('factures_scolarites', 'factures_scolarites.facture_id = factures.facture_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleves_scolarite_id = factures_scolarites.eleves_scolarite_id');
          $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->join('facture_flags', 'facture_flags.facture_flag_id = factures.facture_flag_id');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = eleves_scolarites.settings_niveau_id');
          $this->db->where('factures.facture_id', $facture_id);
          $query = $this->db->get();
          $facture= $query->row();

          $this->db->select('*, sum(tarification_details.tarification_detail_value) as montant');
          $this->db->from('factures_scolarites_details');
          $this->db->join('factures_scolarites', 'factures_scolarites.factures_scolarite_id = factures_scolarites_details.factures_scolarite_id');
          $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('facture_id', $facture_id);
          $query = $this->db->get();
          $facture->details = $query->result();

          return $facture;
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('factures');
          $this->db->join('facture_flags', 'facture_flags.facture_flag_id = factures.facture_flag_id');
          $this->db->where('facture_locked', 0);
          $this->db->order_by('facture_id', 'desc');
          $this->db->limit(100);
          $query = $this->db->get();
          $factures = $query->result();
          foreach ($factures as $facture) {
               $this->db->select('sum(tarification_details.tarification_detail_value) as montant, eleve_matricule');
               $this->db->from('factures_scolarites_details');
               $this->db->join('factures_scolarites', 'factures_scolarites.factures_scolarite_id = factures_scolarites_details.factures_scolarite_id');
               $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
               $this->db->join('eleves_scolarites', 'eleves_scolarites.eleves_scolarite_id = factures_scolarites.eleves_scolarite_id');
               // $this->db->join('classes', 'classes.classe_id = eleves_scolarites.classe_id');
               $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
               $this->db->where('facture_id', $facture->facture_id);
               $query = $this->db->get();
               $facture->montant = (int)$query->row()->montant;
               $facture->eleve_matricule = $query->row()->eleve_matricule;
               // $facture->classe_name = $query->row()->classe_name;
               $this->db->select('sum(encaissements.encaissement_value) as encaissement');
               $this->db->from('encaissements');
               $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
               $this->db->where('factures.facture_id', $facture->facture_id);
               $query = $this->db->get();
               $facture->encaissement = (int)$query->row()->encaissement;
          }
          return $factures;
     }


     public function get_unpaid($classe_id){
          $unpaids = array();

          $this->db->select('*');
          $this->db->from('factures');
          $this->db->join('facture_flags', 'facture_flags.facture_flag_id = factures.facture_flag_id');
          $this->db->join('factures_scolarites', 'factures_scolarites.facture_id = factures.facture_id');
          $this->db->join('eleves_scolarites', 'eleves_scolarites.eleves_scolarite_id = factures_scolarites.eleves_scolarite_id');
          $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
          $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
          $this->db->where('facture_locked', 0);
          $this->db->where('facture_flag_code', '!reg');
          $this->db->order_by("personne_nom");
          $this->db->order_by("personne_prenoms");
          $this->db->order_by('facture_num');
          $query = $this->db->get();
          $factures = $query->result();
          foreach ($factures as $facture) {
               $this->db->select('sum(tarification_details.tarification_detail_value) as montant, eleve_matricule, classe_name, personne_prenoms, personne_nom, classes.classe_id, eleves_scolarites.eleves_scolarite_id');
               $this->db->from('factures_scolarites_details');
               $this->db->join('factures_scolarites', 'factures_scolarites.factures_scolarite_id = factures_scolarites_details.factures_scolarite_id');
               $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
               $this->db->join('eleves_scolarites', 'eleves_scolarites.eleves_scolarite_id = factures_scolarites.eleves_scolarite_id');
               $this->db->join('eleves', 'eleves.eleve_id = eleves_scolarites.eleve_id');
               $this->db->join('personnes', 'personnes.personne_id = eleves.personne_id');
               $this->db->join('classes', 'classes.classe_id = eleves_scolarites.classe_id');
               $this->db->where('facture_id', $facture->facture_id);
               $this->db->where('eleves_scolarites.settings_scolarite_id', $_SESSION['dashboard']['settings_scolarite_id']);
               $query = $this->db->get();

               $facture->montant = (int)$query->row()->montant;
               $facture->eleve_matricule = $query->row()->eleve_matricule;
               $facture->classe_name = $query->row()->classe_name;
               $facture->classe_id = $query->row()->classe_id;

               $facture->personne_prenoms = $query->row()->personne_prenoms;
               $facture->personne_nom = $query->row()->personne_nom;

               $this->db->select('*');
               $this->db->from('eleves_reductions');
               $this->db->where('eleves_scolarite_id', $query->row()->eleves_scolarite_id);
               $query = $this->db->get();
               $reduction = $query->row();

               if($reduction){
                    $facture->montant -= (int)$reduction->eleves_reduction_value;
               }

               $this->db->select('sum(encaissements.encaissement_value) as encaissement');
               $this->db->from('encaissements');
               $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
               $this->db->where('factures.facture_id', $facture->facture_id);
               $query = $this->db->get();
               $facture->encaissement = (int)$query->row()->encaissement;

               if($facture->classe_id == $classe_id){
                    array_push($unpaids, $facture);
               }
          }
          return $unpaids;

     }


          public function get_operations($date_deb, $date_fin){
               $operations = array();
               $operations_enc = array();
               $operations_dec = array();

               $this->db->select('*');
               $this->db->from('encaissements');
               $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
               $this->db->order_by('encaissement_added');
               $query = $this->db->get();
               $encaissements = $query->result();

               foreach ($encaissements as $encaissement) {
                    $operation = array();
                    $operation["added"] = $encaissement->encaissement_added;
                    $operation["date"]= gmdate("Y-m-d H:i", $encaissement->encaissement_added);
                    $operation["piece"]= $encaissement->facture_num;
                    $operation["libelle"]= "Paiement facture ".$encaissement->facture_num;
                    $operation["debit"]= $encaissement->encaissement_value;
                    $operation["credit"]= 0;
                    $operation["solde"] = $operation["debit"]- $operation["credit"];
                    if(($date_deb <= gmdate("Y-m-d", $encaissement->encaissement_added)) && (gmdate("Y-m-d", $encaissement->encaissement_added)<= $date_fin)){
                         array_push($operations_enc, $operation);
                    }
               }

               $this->db->select('*');
               $this->db->from('decaissements');
               $this->db->join('decaissement_bons', 'decaissement_bons.decaissement_bon_id = decaissements.decaissement_bon_id');
               $this->db->order_by('decaissement_added');
               $query = $this->db->get();
               $decaissements = $query->result();

               foreach ($decaissements as $decaissement) {
                    $operation = array();
                    $operation["added"] = $decaissement->decaissement_added;
                    $operation["date"]= gmdate("Y-m-d H:i", $decaissement->decaissement_added);
                    $operation["piece"]= $decaissement->decaissement_bon_num;
                    $operation["libelle"]= $decaissement->decaissement_libelle;
                    $operation["debit"]= 0;
                    $operation["credit"]= $decaissement->decaissement_value;
                    $operation["solde"] = $operation["debit"]- $operation["credit"];
                    if(($date_deb <= gmdate("Y-m-d", $decaissement->decaissement_added)) && (gmdate("Y-m-d", $decaissement->decaissement_added)<= $date_fin)){
                         array_push($operations_dec, $operation);
                    }
               }

               $n_enc = count($operations_enc);
               $n_dec = count($operations_dec);

               $cpt_enc = 0;
               $cpt_dec = 0;

               while(($cpt_enc < $n_enc) && ($cpt_dec < $n_dec)){
                    if($operations_enc[$cpt_enc]["date"] < $operations_dec[$cpt_dec]["date"]){
                         array_push($operations, $operations_enc[$cpt_enc]);
                         $cpt_enc++;
                    }else{
                         array_push($operations, $operations_dec[$cpt_dec]);
                         $cpt_dec++;
                    }
               }

               if($cpt_enc == $n_enc){
                    while($cpt_dec < $n_dec){
                         array_push($operations, $operations_dec[$cpt_dec]);
                         $cpt_dec++;
                    }
               }
               if($cpt_dec == $n_enc){
                    while($cpt_enc < $n_enc){
                         array_push($operations, $operations_enc[$cpt_enc]);
                         $cpt_enc++;
                    }
               }

               return $operations;
          }
}
