<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facturation extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant', 'tuteur'));
          $this->load->model('facturation_model');
          $this->load->model('encaissement_model');
          $this->load->model('eleve_model');
          $this->load->model('classe_model');
          $this->load->model('tarification_model');


          $this->set_data('title', 'Gestion des Factures');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('eleves', $this->eleve_model->get_all());
          $this->set_data('datagrid', $this->facturation_model->get_all());

          add_js(null,'application/modules/scolarite/js/facturation_script.js');

          $this->add_data('content', $this->load->view('facturations/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showFacture(){

          $id = (int)$this->uri->segment(4);

          $facture = $this->facturation_model->get_one($id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/facture.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $pdf->SetFont('Arial','',10);

          $pdf->text(167, 36.8, gmdate('d/m/Y', $facture->facture_added));
          $pdf->text(167, 172.5, gmdate('d/m/Y', $facture->facture_added));

          $pdf->text(110, 41.8, $facture->facture_num);
          $pdf->text(110, 177.5, $facture->facture_num);

          $pdf->text(20, 49, $facture->prenoms." ".$facture->nom);
          $pdf->text(20, 184.7, $facture->prenoms." ".$facture->nom);

          $pdf->text(167, 49, utf8_decode($facture->settings_niveau_name));
          $pdf->text(167, 184.7, utf8_decode($facture->settings_niveau_name));

          $pdf->text(25, 53.3, $facture->eleve_matricule);
          $pdf->text(25, 189.3, $facture->eleve_matricule);



          $pdf->text(25, 57.5, utf8_decode($facture->details[0]->tarification_name." ".$facture->details[0]->tarification_detail_name));
          $pdf->text(25, 193.2, utf8_decode($facture->details[0]->tarification_name." ".$facture->details[0]->tarification_detail_name));

          $this->db->select('sum(tarification_detail_value) as inscription_value');
          $this->db->from('tarification_details');
          $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
          $this->db->where('tarifications.tarification_code', 'ins');
          $query = $this->db->get();
          $inscription_value = $query->row()->inscription_value;

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
          $this->db->where('tarifications.tarification_code', 'men');
          $query = $this->db->get();
          $tarifications = $query->result();

          $this->db->select('*');
          $this->db->from('factures');
          $this->db->join('factures_scolarites', 'factures_scolarites.facture_id = factures.facture_id');
          $this->db->where('factures_scolarites.eleves_scolarite_id', $facture->eleves_scolarite_id);
          $this->db->order_by("factures.facture_id");
          $query = $this->db->get();
          $facturations = $query->result();

          foreach ($facturations as $facturation) {
               $this->db->select('*');
               $this->db->from('encaissements');
               $this->db->where('encaissements.facture_id', $facturation->facture_id);
               $this->db->group_by('encaissement_id');
               $this->db->order_by("encaissement_id", "desc");
               $query = $this->db->get();
               $encaissements = $query->result();
               $facturation->encaissements = $encaissements;
               $facturation->encaissement_total = 0;
               foreach ($encaissements as $encaissement) {
                    $facturation->encaissement_total += $encaissement->encaissement_value;
               }

               $this->db->select('*');
               $this->db->from('factures_scolarites_details');
               $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
               $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
               $this->db->where('factures_scolarites_details.factures_scolarite_id', $facturation->factures_scolarite_id);
               $this->db->order_by("factures_scolarites_details.factures_scolarites_detail_id");
               $query = $this->db->get();
               $facturation_details = $query->result();
               $facturation->facturation_details = $facturation_details;
          }

          $total_du = (int)$inscription_value;
          $total_enc = 0;
          $total_net = 0;

          $row = 80;
          $row_enc = 75.5;

          $row_2 = 215.7;
          $row_enc_2 = 211.2;

          if(!empty($facturations)){

               $to_ignore = array();
               $encaissements_total = 0;

               foreach($facturations as $key => $facturation) {
                    $encaissements_total = $facturation->encaissement_total;

                    if(@$facturation->facturation_details[0]->tarification_code == "ins"){
                         $pdf->text(45, $row_enc, thousand((int)$inscription_value - (int) $facturation->facture_remise)." FCFA");
                         $pdf->text(45, $row_enc_2, thousand((int)$inscription_value - (int) $facturation->facture_remise)." FCFA");

                         if(!empty($facturation->encaissements)){
                              if($facturation->encaissements[0]->encaissement_value != null){

                                   $pdf->text(80, $row_enc, thousand($facturation->encaissement_total)." FCFA");
                                   $pdf->text(80, $row_enc_2, thousand($facturation->encaissement_total)." FCFA");

                                   $pdf->text(120, $row_enc, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                   $pdf->text(120, $row_enc_2, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));

                              }
                         }

                         $pdf->text(165, $row_enc,  thousand($inscription_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");
                         $pdf->text(165, $row_enc_2,  thousand($inscription_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");

                         $total_net += (int)$inscription_value - (int) $facturation->facture_remise - (int)$facturation->encaissement_total;

                         $row_enc += 4.5;
                         $row_enc_2 += 4.5;
                    }else{
                         @$facturation->facture_remise = $facturation->facture_remise/count($facturation->facturation_details);


                         foreach ($facturation->facturation_details as $facturation_details) {
                              $pdf->text(45, $row, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");
                              $pdf->text(45, $row_2, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");

                              if(!empty($facturation->encaissements)){
                                   if($facturation->encaissements[0]->encaissement_value != null){
                                        if($facturation->encaissement_total >= ($facturation_details->tarification_detail_value - $facturation->facture_remise)){
                                             $pdf->text(80, $row_enc, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");
                                             $pdf->text(80, $row_enc_2, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");

                                             $pdf->text(165, $row_enc,  thousand($facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value)." FCFA");
                                             $pdf->text(165, $row_enc_2,  thousand($facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value)." FCFA");

                                             $total_net += $facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value;

                                             $facturation->encaissement_total -= $facturation_details->tarification_detail_value - $facturation->facture_remise;


                                        }else{
                                             $pdf->text(80, $row_enc, thousand($facturation->encaissement_total)." FCFA");
                                             $pdf->text(80, $row_enc_2, thousand($facturation->encaissement_total)." FCFA");

                                             $pdf->text(165, $row_enc,  thousand($facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");
                                             $pdf->text(165, $row_enc_2,  thousand($facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");

                                             $total_net += $facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise;
                                             $facturation->encaissement_total -= $facturation->encaissement_total;

                                        }
                                        $pdf->text(120, $row_enc, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                        $pdf->text(120, $row_enc_2, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                   }
                              }else{
                                   $pdf->text(165, $row_enc,  thousand((int) $facture->details[0]->tarification_detail_value - (int) $facture->facture_remise)." FCFA");
                                   $pdf->text(165, $row_enc_2,  thousand((int) $facture->details[0]->tarification_detail_value - (int) $facture->facture_remise)." FCFA");

                                   $total_net += (int) $facture->details[0]->tarification_detail_value - (int) $facture->facture_remise;
                              }

                              $row_enc += 4.5;
                              $row_enc_2 += 4.5;
                              $row += 4.5;
                              $row_2 += 4.5;
                              $total_du += (int)$facturation_details->tarification_detail_value - $facturation->facture_remise;
                              array_push($to_ignore, $facturation_details->tarification_detail_id);
                         }
                    }

                    $total_enc += (int)$encaissements_total;
               }

               $this->db->select("tarification_detail_id, tarification_detail_name, tarification_detail_value");
               $this->db->from("tarification_details");
               $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
               $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
               $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
               $this->db->where('tarifications.tarification_code', 'men');
               if(!empty($to_ignore)){
                    $this->db->where_not_in("tarification_detail_id", $to_ignore);
               }
               $query = $this->db->get();
               $tarifications = $query->result();

               foreach ($tarifications as $tarification) {
                    $pdf->text(45, $row, thousand($tarification->tarification_detail_value)." FCFA");
                    $pdf->text(45, $row_2, thousand($tarification->tarification_detail_value)." FCFA");
                    $row += 4.5;
                    $row_2 += 4.5;
                    $total_du += (int)$tarification->tarification_detail_value;
               }

               $pdf->text(80, $row, thousand($total_enc)." FCFA");
               $pdf->text(80, $row_2, thousand($total_enc)." FCFA");

               $pdf->text(165, $row, thousand($total_net)." FCFA");
               $pdf->text(165, $row_2, thousand($total_net)." FCFA");
          }

          $net_paye = (int) $total_net;

          $pdf->text(167, 32.3, thousand($net_paye)." FCFA");
          $pdf->text(167, 168, thousand($net_paye)." FCFA");

          $this->load->library('chiffreEnLettre');
          $montant = $this->chiffreenlettre->conversion($net_paye);
          $pdf->text(88, 53.3, $montant." FCFA");
          $pdf->text(88, 189.3, $montant." FCFA");

          $pdf->text(45, $row, thousand($total_du)." FCFA");
          $pdf->text(45, $row_2, thousand($total_du)." FCFA");

          $pdf->text(45, 122.5, "Le 05 ".get_month_fr((int)gmdate('m', $facture->facture_added) + 1)." ".gmdate('Y'));
          $pdf->text(45, 258.2, "Le 05 ".get_month_fr((int)gmdate('m', $facture->facture_added) + 1)." ".gmdate('Y'));

          $pdf->Output('I');


          // if(!is_dir('dossiers/factures')){
          //      mkdir('dossiers/factures', 0777, true);
          // }
          //
          // $file_name = 'dossiers/factures/facture_'.$facture->facture_num.'.pdf';
          //
          // $pdf->Output('F',$file_name,true);
          //
          // header("location:".base_url($file_name));
     }

     public function showQuittance(){

          $id = (int)$this->uri->segment(4);

          $facture = $this->facturation_model->get_one($id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/quittance.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $net_paye = (int) $facture->details[0]->montant - (int) $facture->facture_remise;

          $pdf->SetFont('Arial','',10);

          $pdf->text(167, 31.8, gmdate('d/m/Y', $facture->facture_added));
          $pdf->text(167, 170, gmdate('d/m/Y', $facture->facture_added));

          $pdf->text(20, 47.5, $facture->prenoms." ".$facture->nom);
          $pdf->text(20, 185.7, $facture->prenoms." ".$facture->nom);

          $pdf->text(167, 47.5, utf8_decode($facture->settings_niveau_name));
          $pdf->text(167, 185.7, utf8_decode($facture->settings_niveau_name));

          $pdf->text(25, 51.8, $facture->eleve_matricule);
          $pdf->text(25, 190.3, $facture->eleve_matricule);

          $pdf->text(25, 56, utf8_decode($facture->details[0]->tarification_name." ".$facture->details[0]->tarification_detail_name));
          $pdf->text(25, 194.2, utf8_decode($facture->details[0]->tarification_name." ".$facture->details[0]->tarification_detail_name));

          $this->db->select('sum(tarification_detail_value) as inscription_value');
          $this->db->from('tarification_details');
          $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
          $this->db->where('tarifications.tarification_code', 'ins');
          $query = $this->db->get();
          $inscription_value = $query->row()->inscription_value;

          $this->db->select('*');
          $this->db->from('tarification_details');
          $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
          $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
          $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
          $this->db->where('tarifications.tarification_code', 'men');
          $query = $this->db->get();
          $tarifications = $query->result();

          $this->db->select('*');
          $this->db->from('factures');
          $this->db->join('factures_scolarites', 'factures_scolarites.facture_id = factures.facture_id');
          $this->db->where('factures_scolarites.eleves_scolarite_id', $facture->eleves_scolarite_id);
          $this->db->order_by("factures.facture_id");
          $query = $this->db->get();
          $facturations = $query->result();
          foreach ($facturations as $facturation) {
               $this->db->select('*');
               $this->db->from('encaissements');
               $this->db->where('encaissements.facture_id', $facturation->facture_id);
               $this->db->group_by('encaissement_id');
               $this->db->order_by("encaissement_id", "desc");
               $query = $this->db->get();
               $encaissements = $query->result();
               $facturation->encaissements = @$encaissements;
               $facturation->encaissement_total = 0;
               foreach ($encaissements as $encaissement) {
                    $facturation->encaissement_total += $encaissement->encaissement_value;
               }

               $this->db->select('*');
               $this->db->from('factures_scolarites_details');
               $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
               $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
               $this->db->where('factures_scolarites_details.factures_scolarite_id', $facturation->factures_scolarite_id);
               $this->db->order_by("factures_scolarites_details.factures_scolarites_detail_id");
               $query = $this->db->get();
               $facturation_details = $query->result();
               $facturation->facturation_details = $facturation_details;
          }

          $pdf->text(118, 40.5, count($encaissements).'-'.$facture->facture_num);
          $pdf->text(118, 178.5,  count($encaissements).'-'.$facture->facture_num);

          $total_du = (int)$inscription_value;
          $total_enc = 0;
          $total_net = 0;

          $row = 76.5;
          $row_enc = 72;

          $row_2 = 214.7;
          $row_enc_2 = 210.2;

          $facturatio = new stdClass();

          if(!empty($facturations)){

               $to_ignore = array();
               $encaissements_total = 0;

               foreach($facturations as $key => $facturation) {
                    $encaissements_total = $facturation->encaissement_total;

                    if(@$facturation->facturation_details[0]->tarification_code == "ins"){
                         $pdf->text(45, 72, thousand((int)$inscription_value - (int) $facturation->facture_remise)." FCFA");
                         $pdf->text(45, 210.2, thousand((int)$inscription_value - (int) $facturation->facture_remise)." FCFA");

                         if(!empty($facturation->encaissements)){
                              if($facturation->encaissements[0]->encaissement_value != null){
                                   $facturatio = $facturation;

                                   $pdf->text(80, $row_enc, thousand($facturation->encaissement_total)." FCFA");
                                   $pdf->text(80, $row_enc_2, thousand($facturation->encaissement_total)." FCFA");

                                   $pdf->text(120, $row_enc, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                   $pdf->text(120, $row_enc_2, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));

                              }
                         }

                         $pdf->text(165, $row_enc,  thousand($inscription_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");
                         $pdf->text(165, $row_enc_2,  thousand($inscription_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");

                         $total_net += (int)$inscription_value - (int) $facturation->facture_remise - (int)$facturation->encaissement_total;

                         $row_enc += 4.5;
                         $row_enc_2 += 4.5;
                    }else{
                         @$facturation->facture_remise = $facturation->facture_remise/count($facturation->facturation_details);


                         foreach ($facturation->facturation_details as $facturation_details) {
                              $pdf->text(45, $row, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");
                              $pdf->text(45, $row_2, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");

                              if(!empty($facturation->encaissements)){
                                   if($facturation->encaissements[0]->encaissement_value != null){
                                        $facturatio = $facturation;
                                        if($facturation->encaissement_total >= ($facturation_details->tarification_detail_value - $facturation->facture_remise)){
                                             $pdf->text(80, $row_enc, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");
                                             $pdf->text(80, $row_enc_2, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");

                                             $pdf->text(165, $row_enc,  thousand($facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value)." FCFA");
                                             $pdf->text(165, $row_enc_2,  thousand($facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value)." FCFA");

                                             $total_net += $facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value;

                                             $facturation->encaissement_total -= $facturation_details->tarification_detail_value - $facturation->facture_remise;


                                        }else{
                                             $pdf->text(80, $row_enc, thousand($facturation->encaissement_total)." FCFA");
                                             $pdf->text(80, $row_enc_2, thousand($facturation->encaissement_total)." FCFA");

                                             $pdf->text(165, $row_enc,  thousand($facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");
                                             $pdf->text(165, $row_enc_2,  thousand($facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");

                                             $total_net += $facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise;
                                             $facturation->encaissement_total -= $facturation->encaissement_total;

                                        }
                                        $pdf->text(120, $row_enc, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                        $pdf->text(120, $row_enc_2, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                   }
                              }

                              $row_enc += 4.5;
                              $row_enc_2 += 4.5;
                              $row += 4.5;
                              $row_2 += 4.5;
                              $total_du += (int)$facturation_details->tarification_detail_value - $facturation->facture_remise;
                              array_push($to_ignore, $facturation_details->tarification_detail_id);
                         }
                    }

                    $total_enc += (int)$encaissements_total;
               }

               if(is_array($facturatio->encaissements)){
                    $this->db->select('*');
                    $this->db->from('encaissements');
                    $this->db->where('encaissements.facture_id', $id);
                    $this->db->group_by('encaissement_id');
                    $this->db->order_by("encaissement_id", "desc");
                    $query = $this->db->get();
                    $encaissement = $query->row();
                    $montant_verser = $encaissement->encaissement_value;
               }else{
                    $montant_verser = 0;
               }

               $pdf->text(167, 27.3, thousand($montant_verser)." FCFA");
               $pdf->text(167, 165.5, thousand($montant_verser)." FCFA");

               $this->load->library('chiffreEnLettre');
               $montant = $this->chiffreenlettre->conversion($montant_verser);
               $pdf->text(88, 51.8, $montant." FCFA");
               $pdf->text(88, 190.3, $montant." FCFA");

               $this->db->select("tarification_detail_id, tarification_detail_name, tarification_detail_value");
               $this->db->from("tarification_details");
               $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
               $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
               $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
               $this->db->where('tarifications.tarification_code', 'men');
               if(!empty($to_ignore)){
                    $this->db->where_not_in("tarification_detail_id", $to_ignore);
               }
               $query = $this->db->get();
               $tarifications = $query->result();

               foreach ($tarifications as $tarification) {
                    $pdf->text(45, $row, thousand($tarification->tarification_detail_value)." FCFA");
                    $pdf->text(45, $row_2, thousand($tarification->tarification_detail_value)." FCFA");
                    $row += 4.5;
                    $row_2 += 4.5;
                    $total_du += (int)$tarification->tarification_detail_value;
               }

               $pdf->text(80, $row, thousand($total_enc)." FCFA");
               $pdf->text(80, $row_2, thousand($total_enc)." FCFA");

               $pdf->text(165, $row, thousand($total_net)." FCFA");
               $pdf->text(165, $row_2, thousand($total_net)." FCFA");
          }

          $pdf->text(45, $row, thousand($total_du)." FCFA");
          $pdf->text(45, $row_2, thousand($total_du)." FCFA");

          $pdf->Output('I');


          // if(!is_dir('dossiers/quittances')){
          //      mkdir('dossiers/quittances', 0777, true);
          // }
          //
          // $file_name = 'dossiers/quittances/quittance_'.count($encaissements).'-'.$facture->facture_num.'.pdf';
          //
          // $pdf->Output('F',$file_name,true);
          //
          // header("location:".base_url($file_name));
     }

     public function showGroupedFacture(){

          $id = (int)$this->uri->segment(4);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');

          $this->load->library('chiffreEnLettre');

          if(!empty($_SESSION['scolarite']['facture_ids'])){
               foreach ($_SESSION['scolarite']['facture_ids'] as $key => $id) {
                    $net_paye = 0;
                    $facture = $this->facturation_model->get_one($id);

                    $pdf->AddPage();
                    $pageCount = $pdf->setSourceFile('temp/models/facture.pdf');
                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);

                    // $net_paye = (int) $facture->details[0]->montant - (int) $facture->facture_remise;

                    $pdf->SetFont('Arial','',10);

                    // $pdf->text(167, 32.3, thousand($net_paye)." FCFA");
                    // $pdf->text(167, 168, thousand($net_paye)." FCFA");

                    $pdf->text(167, 36.8, gmdate('d/m/Y', $facture->facture_added));
                    $pdf->text(167, 172.5, gmdate('d/m/Y', $facture->facture_added));

                    $pdf->text(110, 41.8, $facture->facture_num);
                    $pdf->text(110, 177.5, $facture->facture_num);

                    $pdf->text(20, 49, $facture->prenoms." ".$facture->nom);
                    $pdf->text(20, 184.7, $facture->prenoms." ".$facture->nom);

                    $pdf->text(167, 49, utf8_decode($facture->settings_niveau_name));
                    $pdf->text(167, 184.7, utf8_decode($facture->settings_niveau_name));

                    $pdf->text(25, 53.3, $facture->eleve_matricule);
                    $pdf->text(25, 189.3, $facture->eleve_matricule);

                    // $montant = $this->chiffreenlettre->conversion($net_paye);
                    // $pdf->text(88, 53.3, $montant." FCFA");
                    // $pdf->text(88, 189.3, $montant." FCFA");

                    unset($montant);

                    $pdf->text(25, 57.5, utf8_decode($facture->details[0]->tarification_name." ".$facture->details[0]->tarification_detail_name));
                    $pdf->text(25, 193.2, utf8_decode($facture->details[0]->tarification_name." ".$facture->details[0]->tarification_detail_name));

                    $this->db->select('sum(tarification_detail_value) as inscription_value');
                    $this->db->from('tarification_details');
                    $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
                    $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
                    $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
                    $this->db->where('tarifications.tarification_code', 'ins');
                    $query = $this->db->get();
                    $inscription_value = $query->row()->inscription_value;

                    $this->db->select('*');
                    $this->db->from('tarification_details');
                    $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
                    $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
                    $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
                    $this->db->where('tarifications.tarification_code', 'men');
                    $query = $this->db->get();
                    $tarifications = $query->result();

                    $this->db->select('*');
                    $this->db->from('factures');
                    $this->db->join('factures_scolarites', 'factures_scolarites.facture_id = factures.facture_id');
                    $this->db->where('factures_scolarites.eleves_scolarite_id', $facture->eleves_scolarite_id);
                    $this->db->order_by("factures.facture_id");
                    $query = $this->db->get();
                    $facturations = $query->result();

                    foreach ($facturations as $facturation) {
                         $this->db->select('*');
                         $this->db->from('encaissements');
                         $this->db->where('encaissements.facture_id', $facturation->facture_id);
                         $this->db->group_by('encaissement_id');
                         $this->db->order_by("encaissement_id", "desc");
                         $query = $this->db->get();
                         $encaissements = $query->result();
                         $facturation->encaissements = $encaissements;
                         $facturation->encaissement_total = 0;
                         foreach ($encaissements as $encaissement) {
                              $facturation->encaissement_total += $encaissement->encaissement_value;
                         }

                         $this->db->select('*');
                         $this->db->from('factures_scolarites_details');
                         $this->db->join('tarification_details', 'tarification_details.tarification_detail_id = factures_scolarites_details.tarification_detail_id');
                         $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
                         $this->db->where('factures_scolarites_details.factures_scolarite_id', $facturation->factures_scolarite_id);
                         $this->db->order_by("factures_scolarites_details.factures_scolarites_detail_id");
                         $query = $this->db->get();
                         $facturation_details = $query->result();
                         $facturation->facturation_details = $facturation_details;
                    }

                    $total_du = (int)$inscription_value;
                    $total_enc = 0;
                    $total_net = 0;

                    $row = 80;
                    $row_enc = 75.5;

                    $row_2 = 215.7;
                    $row_enc_2 = 211.2;

                    if(!empty($facturations)){

                         $to_ignore = array();
                         $encaissements_total = 0;

                         foreach($facturations as $key => $facturation) {
                              $encaissements_total = $facturation->encaissement_total;

                              if($facturation->facturation_details[0]->tarification_code == "ins"){
                                   $pdf->text(45, $row_enc, thousand((int)$inscription_value - (int) $facturation->facture_remise)." FCFA");
                                   $pdf->text(45, $row_enc_2, thousand((int)$inscription_value - (int) $facturation->facture_remise)." FCFA");

                                   if(!empty($facturation->encaissements)){
                                        if($facturation->encaissements[0]->encaissement_value != null){

                                             $pdf->text(80, $row_enc, thousand($facturation->encaissement_total)." FCFA");
                                             $pdf->text(80, $row_enc_2, thousand($facturation->encaissement_total)." FCFA");

                                             $pdf->text(120, $row_enc, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                             $pdf->text(120, $row_enc_2, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));

                                        }
                                   }

                                   $pdf->text(165, $row_enc,  thousand($inscription_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");
                                   $pdf->text(165, $row_enc_2,  thousand($inscription_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");

                                   $total_net += (int)$inscription_value - (int) $facturation->facture_remise - (int)$facturation->encaissement_total;

                                   $row_enc += 4.5;
                                   $row_enc_2 += 4.5;
                              }else{
                                   $facturation->facture_remise = $facturation->facture_remise/count($facturation->facturation_details);


                                   foreach ($facturation->facturation_details as $facturation_details) {
                                        $pdf->text(45, $row, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");
                                        $pdf->text(45, $row_2, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");

                                        if(!empty($facturation->encaissements)){
                                             if($facturation->encaissements[0]->encaissement_value != null){
                                                  if($facturation->encaissement_total >= ($facturation_details->tarification_detail_value - $facturation->facture_remise)){
                                                       $pdf->text(80, $row_enc, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");
                                                       $pdf->text(80, $row_enc_2, thousand($facturation_details->tarification_detail_value - $facturation->facture_remise)." FCFA");

                                                       $pdf->text(165, $row_enc,  thousand($facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value)." FCFA");
                                                       $pdf->text(165, $row_enc_2,  thousand($facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value)." FCFA");

                                                       $total_net += $facturation_details->tarification_detail_value - $facturation_details->tarification_detail_value;

                                                       $facturation->encaissement_total -= $facturation_details->tarification_detail_value - $facturation->facture_remise;


                                                  }else{
                                                       $pdf->text(80, $row_enc, thousand($facturation->encaissement_total)." FCFA");
                                                       $pdf->text(80, $row_enc_2, thousand($facturation->encaissement_total)." FCFA");

                                                       $pdf->text(165, $row_enc,  thousand($facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");
                                                       $pdf->text(165, $row_enc_2,  thousand($facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise)." FCFA");

                                                       $total_net += $facturation_details->tarification_detail_value - $facturation->encaissement_total - $facturation->facture_remise;
                                                       $facturation->encaissement_total -= $facturation->encaissement_total;

                                                  }
                                                  $pdf->text(120, $row_enc, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                                  $pdf->text(120, $row_enc_2, gmdate("d-m-Y H:i", $facturation->encaissements[0]->encaissement_added));
                                             }
                                        }else{
                                             $pdf->text(165, $row_enc,  thousand((int) $facture->details[0]->montant - (int) $facture->facture_remise)." FCFA");
                                             $pdf->text(165, $row_enc_2,  thousand((int) $facture->details[0]->montant - (int) $facture->facture_remise)." FCFA");

                                             $total_net += (int) $facture->details[0]->montant - (int) $facture->facture_remise;
                                        }

                                        $row_enc += 4.5;
                                        $row_enc_2 += 4.5;
                                        $row += 4.5;
                                        $row_2 += 4.5;
                                        $total_du += (int)$facturation_details->tarification_detail_value - $facturation->facture_remise;
                                        array_push($to_ignore, $facturation_details->tarification_detail_id);
                                   }
                              }

                              $total_enc += (int)$encaissements_total;
                         }

                         $this->db->select("tarification_detail_id, tarification_detail_name, tarification_detail_value");
                         $this->db->from("tarification_details");
                         $this->db->join('tarification_modeles', 'tarification_modeles.tarification_modele_id = tarification_details.tarification_modele_id');
                         $this->db->join('tarifications', 'tarifications.tarification_id = tarification_details.tarification_id');
                         $this->db->where('tarification_details.tarification_modele_id', $facture->details[0]->tarification_modele_id);
                         $this->db->where('tarifications.tarification_code', 'men');
                         if(!empty($to_ignore)){
                              $this->db->where_not_in("tarification_detail_id", $to_ignore);
                         }
                         $query = $this->db->get();
                         $tarifications = $query->result();

                         foreach ($tarifications as $tarification) {
                              $pdf->text(45, $row, thousand($tarification->tarification_detail_value)." FCFA");
                              $pdf->text(45, $row_2, thousand($tarification->tarification_detail_value)." FCFA");
                              $row += 4.5;
                              $row_2 += 4.5;
                              $total_du += (int)$tarification->tarification_detail_value;
                         }

                         $pdf->text(80, $row, thousand($total_enc)." FCFA");
                         $pdf->text(80, $row_2, thousand($total_enc)." FCFA");

                         $pdf->text(165, $row, thousand($total_net)." FCFA");
                         $pdf->text(165, $row_2, thousand($total_net)." FCFA");
                    }

                    $net_paye = (int) $total_net;

                    $pdf->text(167, 32.3, thousand($net_paye)." FCFA");
                    $pdf->text(167, 168, thousand($net_paye)." FCFA");

                    $this->load->library('chiffreEnLettre');
                    $montant = $this->chiffreenlettre->conversion($net_paye);
                    $pdf->text(88, 53.3, $montant." FCFA");
                    $pdf->text(88, 189.3, $montant." FCFA");

                    $pdf->text(45, $row, thousand($total_du)." FCFA");
                    $pdf->text(45, $row_2, thousand($total_du)." FCFA");

                    $m = gmdate('m', $facture->facture_added) + 1;

                    $pdf->text(45, 122.5, "Le 05 ".get_month_fr($m)." ".gmdate('Y'));
                    $pdf->text(45, 258.2, "Le 05 ".get_month_fr($m)." ".gmdate('Y'));
               }

               if(!is_dir('dossiers/factures')){
                    mkdir('dossiers/factures', 0777, true);
               }

               $file_name = 'dossiers/factures/facture_'.$_SESSION['scolarite']['mois'].'-'.@utf8_decode(str_replace(" ", "", $_SESSION['scolarite']['settings_niveau_name'])).'.pdf';

               $pdf->Output('F',$file_name,true);

               header("location:".base_url($file_name));
          }else{
               $file_name = 'dossiers/factures/facture_'.$_SESSION['scolarite']['mois'].'-'.@utf8_decode(str_replace(" ", "", $_SESSION['scolarite']['settings_niveau_name'])).'.pdf';
               header("location:".base_url($file_name));
          }
     }

     public function insert_individual()
     {
          if(isPostBack())
          {
               if($this->facturation_model->insert_individual()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La facture a été créée !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La facture n'a pas été créée !"
                    ));
               }
          }
          redirect('/scolarite/facturation');
     }

     public function insert_grouped()
     {
          if(isPostBack())
          {
               if($this->facturation_model->insert_grouped()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Les factures ont été créées !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La facture n'a pas été créées !"
                    ));
               }
          }
          redirect('/scolarite/facturation');
     }

     public function insert_encaissement()
     {
          if(isPostBack())
          {
               if($this->encaissement_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'encaissement a été encaissée !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'encaissement n'a pas été encaissée !"
                    ));
               }
          }
          redirect('/scolarite/facturation');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->facturation_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La facture a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La facture n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/facturation');
     }

}
?>
