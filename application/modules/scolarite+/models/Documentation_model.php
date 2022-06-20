<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documentation_model extends IBEMS_Model
{
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->img_base_path = './dossiers/templates/';
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

     public function get_unpaid($classe_id){
          $unpaids = array();

          $this->db->select('*');
          $this->db->from('factures');
          $this->db->join('facture_flags', 'facture_flags.facture_flag_id = factures.facture_flag_id');
          $this->db->where('facture_locked', 0);
          $this->db->where('facture_flag_code', '!reg');
          $this->db->order_by('facture_num');
          $query = $this->db->get();
          $factures = $query->result();
          foreach ($factures as $facture) {
               $this->db->select('sum(tarification_details.tarification_detail_value) as montant, eleve_matricule, classe_name, prenoms, nom, classes.classe_id, eleves_scolarites.eleves_scolarite_id');
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

               $facture->prenoms = $query->row()->prenoms;
               $facture->nom = $query->row()->nom;

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
}
