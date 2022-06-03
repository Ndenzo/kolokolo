<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Annuelle extends IBEMS_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->model('evaluation_model');
          $this->load->model('classe_model');
     }

     public function showAnnuelle(){
          $classe_id = (int)$this->uri->segment(4);
          // $evaluation_modele_niveau_id = (int)$this->uri->segment(5);

          $data = $this->evaluation_model->get_annuelle($classe_id);
          // $data->eleves = $this->classe_model->get_eleves_classe($classe_id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');

          switch($data->trimestres[0]->settings_cycle_code) {
               case 'presco':
               self::showAnnuelle_prescolaire($pdf, $data);
               break;
               case 'eleme':
               self::showAnnuelle_elementaire($pdf, $data);
               break;
               case 'moyen':
               self::showAnnuelle_moyen($pdf, $data);
               break;

               default:
               redirect("help");
               break;
          }

          $file_name = 'Annuelle.pdf';

          $pdf->Output('I');
     }

     public function showAnnuelle_prescolaire($pdf, $data){
          foreach ($data->eleves as $eleve) {
               $som_point = 0;
               $som_coef = 0;
               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/annuelle/ann_'.$data->settings_cycle_code.'.pdf');



               $pageId = $pdf->importPage(1);
               $pdf->useTemplate($pageId, 0, 0);
               $pdf->SetFont('Arial','',10);

               $pdf->text(155, 40, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));

               $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
               $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->prenoms.' '.@$eleve->nom));


               $pdf->SetFillColor(255, 255, 255);
               $pdf->SetTextColor(51, 102, 153);
               $pdf->setY(60);
               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->SetFont('Arial','B',15);
               $pdf->cell(195, 9, strtoupper(utf8_decode("tableau récapitulatif du ".$data->evaluation_modele_name)),0,1,'C',1);

               $pdf->SetFont('Arial','',10);

               $cols = [100, 85];
               $pdf->SetFillColor(15, 37, 63);
               $h = 10;

               $pdf->SetFont('Arial','B',10);
               $pdf->SetTextColor(255, 255, 255);

               $pdf->setY(80);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("ACTIVITES"),1 ,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);

               foreach ($data->modules as $module) {
                    $h = 8;

                    $pdf->SetFont('Arial','',9);
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->setX(3);
                    $pdf->cell(10);
                    $pdf->cell($cols[0],$h, utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
                    $check = false;
                    foreach ($eleve->notes as $note) {
                         if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                              // $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
                              $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
                              $check = true;
                         }
                    }
                    if($check == false){
                         // $pdf->cell($cols[1],$h, "",1,0,'L',1);
                         $pdf->cell($cols[1],$h, "-",1,1,'C',1);
                    }
               }
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("Appréciation trimestrielle"),1,0,'L',1);
               $pdf->cell($cols[1],$h, utf8_decode(""),1,1,'C',1);
          }

     }

     public function showAnnuelle_elementaire($pdf, $data){
          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 20;

          $som_moy_trim_1 = 0;
          $moy_max_trim_1 = 0;
          $moy_min_trim_1 = 20;

          $som_moy_trim_2 = 0;
          $moy_max_trim_2 = 0;
          $moy_min_trim_2 = 20;

          $som_moy_trim_3 = 0;
          $moy_max_trim_3 = 0;
          $moy_min_trim_3 = 20;

          $moyenne_eleves = array();
          $moyenne_eleves_trim_1 = array();
          $moyenne_eleves_trim_2 = array();
          $moyenne_eleves_trim_3 = array();


          foreach($data->eleves as $eleve) {
               $som_point = 0;
               $som_moy_trim = 0;

               foreach ($eleve->evaluations as $evaluation) {
                    foreach ($data->trimestres as  $key =>  $trimestre) {
                         $index = $key + 1;
                         foreach ($trimestre->evaluation_modeles as $k => $evaluation_modele) {
                              if($evaluation_modele->evaluation_modele_niveau_id == $evaluation->evaluation_modele_niveau_id){
                                   $som_moy_trim += @$evaluation->evaluation_moyenne_trim;
                                   ${"moyenne_eleves_trim_$index"} = self::to_sort(${"moyenne_eleves_trim_$index"}, @$evaluation->evaluation_moyenne_trim, $eleve->eleves_scolarite_id);
                              }
                         }
                    }
               }

               $moyenne_eleves = self::to_sort($moyenne_eleves, @round(($som_moy_trim/3), 2), $eleve->eleves_scolarite_id);

               $moy = @round(($som_moy_trim/3), 2);
               if($moy > 0){
                    $som_moy += $moy;
                    if($moy_min > $moy){
                         $moy_min = $moy;
                    }
                    if($moy_max < $moy){
                         $moy_max = $moy;
                    }
               }
          }

          for ($i=1; $i <= 3; $i++) {
               foreach (${"moyenne_eleves_trim_$i"} as $value) {
                    if($value['moyenne'] > 0){
                         ${"som_moy_trim_$i"} += $value['moyenne'];
                         if(${"moy_min_trim_$i"} > $value['moyenne']){
                              ${"moy_min_trim_$i"} = $value['moyenne'];
                         }
                         if(${"moy_max_trim_$i"} < $value['moyenne']){
                              ${"moy_max_trim_$i"} = $value['moyenne'];
                         }
                    }
               }
          }

          foreach ($data->eleves as $eleve) {
               $som_moy_trim = 0;

               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/annuelle/ann_'.$data->trimestres[0]->settings_cycle_code.'.pdf');

               $pageId = $pdf->importPage(1);
               $pdf->useTemplate($pageId, 0, 0);
               $pdf->SetFillColor(255, 255, 255);
               $pdf->SetTextColor(51, 102, 153);

               $pdf->setY(60);
               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->SetFont('Arial','B',20);
               $pdf->cell(195, 9, strtoupper(utf8_decode("TABLEAU RECAPITULATIF")),0,1,'C',1);

               $pdf->SetTextColor(0, 0, 0);

               $pdf->SetFont('Arial','',10);

               $pdf->text(25, 80, utf8_decode('Prénoms : '.@$eleve->prenoms));
               $pdf->text(25, 85, utf8_decode('Né (e) le : '.mysql_to_date(@$eleve->naissance_date)));
               $pdf->text(25, 90, utf8_decode('Matricule : '.@$eleve->eleve_matricule));

               $pdf->text(100, 80, utf8_decode('Nom : '.@$eleve->nom));
               $pdf->text(100, 85, utf8_decode('à : '.@$eleve->naissance_lieu));
               $pdf->text(100, 90, utf8_decode("Nbre d'elèves : ".@count($data->eleves)));

               $pdf->text(155, 80, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));
               $pdf->text(155, 85, utf8_decode('Classe : '.@$eleve->classe_name));
               $pdf->text(155, 90, utf8_decode('Classe redoublée : '.null));

               $cols = [100,25,60];
               $pdf->SetFillColor(15, 37, 63);
               $h = 9;

               $pdf->SetFont('Arial','B',12);
               $pdf->SetTextColor(255, 255, 255);

               $pdf->setY(95);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("DISCIPLINES"),1 ,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode("NOTES"),1,0,'C',1);
               $pdf->cell($cols[2],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);

               foreach ($data->trimestres as $index => $trimestre) {
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->setX(3);
                    $pdf->cell(10);

                    $pdf->cell(40,($h*3), strtoupper(utf8_decode(@$trimestre->evaluation_trimestre_name)),1,0,'L',1);
                    foreach ($trimestre->evaluation_modeles as $key => $evaluation_modele) {
                         $verif = false;

                         foreach ($eleve->evaluations as $k => $evaluation) {
                              if($evaluation_modele->evaluation_modele_niveau_id == $evaluation->evaluation_modele_niveau_id){
                                   $pdf->SetFont('Arial','',9);
                                   $pdf->cell(60,$h, utf8_decode('MOYENNE CONTRÔLE CONTINUE'),1,0,'L',1);
                                   $pdf->SetFont('Arial','',12);
                                   $pdf->cell($cols[1],$h, utf8_decode(@$evaluation->evaluation_moyenne_cont),1,0,'C',1);
                                   $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_elementaire(@$evaluation->evaluation_moyenne_cont)),1,1,'C',1);

                                   $pdf->cell(43);
                                   $pdf->SetFont('Arial','',9);
                                   $pdf->cell(60,$h, utf8_decode('MOYENNE COMPOSITION N°'.($index+1)),1,0,'L',1);
                                   $pdf->SetFont('Arial','',12);
                                   $pdf->cell($cols[1],$h, utf8_decode(@$evaluation->evaluation_moyenne_comp),1,0,'C',1);
                                   $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_elementaire(@$evaluation->evaluation_moyenne_comp)),1,1,'C',1);

                                   $pdf->cell(43);
                                   $pdf->SetFont('Arial','b',9);
                                   $pdf->cell(60,$h, utf8_decode('MOYENNE TRIMESTRE N°'.($index+1)),1,0,'L',1);
                                   $pdf->SetFont('Arial','b',12);
                                   $pdf->cell($cols[1],$h, utf8_decode(@$evaluation->evaluation_moyenne_trim),1,0,'C',1);
                                   $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_elementaire(@$evaluation->evaluation_moyenne_trim)),1,1,'C',1);
                                   $som_moy_trim += @$evaluation->evaluation_moyenne_trim;

                                   $verif = true;
                              }
                         }
                         if($verif == false){

                              $pdf->SetFont('Arial','',9);
                              $pdf->cell(60,$h, utf8_decode('MOYENNE CONTRÔLE CONTINUE'),1,0,'L',1);
                              $pdf->SetFont('Arial','',12);
                              $pdf->cell($cols[1],$h, "0",1,0,'C',1);
                              $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_elementaire(0)),1,1,'C',1);
                              $pdf->cell(43);

                              $pdf->SetFont('Arial','',9);
                              $pdf->cell(60,$h, utf8_decode('MOYENNE COMPOSITION N°'.($index+1)),1,0,'L',1);
                              $pdf->SetFont('Arial','',12);
                              $pdf->cell($cols[1],$h, "0",1,0,'C',1);
                              $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_elementaire(0)),1,1,'C',1);
                              $pdf->cell(43);

                              $pdf->SetFont('Arial','b',9);
                              $pdf->cell(60,$h, utf8_decode('MOYENNE TRIMESTRE N°'.($index+1)),1,0,'L',1);
                              $pdf->SetFont('Arial','b',12);
                              $pdf->cell($cols[1],$h, "0",1,0,'C',1);
                              $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_elementaire(0)),1,1,'C',1);
                         }
                    }
               }
               $h = 7;

               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],($h*2), "MOYENNE ANNUELLE",1,0,'L',1);
               $pdf->cell($cols[1],($h*2), utf8_decode(@round(($som_moy_trim/3), 2)),1,0,'C',1);
               $pdf->cell($cols[2],($h*2), "",1,1,'C',1);

               $cols = [92.5, 92.5];
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[0],$h, utf8_decode("MEILLEURE MOYENNE : ".$moy_max),1,0,'C',1);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[1],$h, utf8_decode("PLUS FAIBLE MOYENNE : ".$moy_min),1,1,'C',1);

               $cols = [185];
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[0],($h*4), "",1,0,'c',1);

               $cols = [185];
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[0],$h, utf8_decode("DECISION DU CONSEIL DES CLASSES"),"LRT",1,'C',1);


               $cols = [185];
               $pdf->setY(215);
               $pdf->cell(15);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell(50,($h*2), "",1,0,'c',1);

               $cols = [185];
               $pdf->setY(215);
               $pdf->cell(15);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell(50,$h, utf8_decode("Passe en classe supérieure"),"LRT",1,'C',1);

               $cols = [185];
               $pdf->setY(215);
               $pdf->cell(70);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell(50,($h*2), "",1,0,'c',1);

               $cols = [185];
               $pdf->setY(215);
               $pdf->cell(70);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell(50,$h, utf8_decode("Redouble la classe"),"LRT",1,'C',1);

               $cols = [185];
               $pdf->setY(215);
               $pdf->cell(125);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell(50,($h*2), "",1,0,'c',1);

               $cols = [185];
               $pdf->setY(215);
               $pdf->cell(125);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell(50,$h, utf8_decode("Cours de vacances obligatoires"),"LRT",1,'C',1);
          }
     }

     public function showAnnuelle_moyen($pdf, $data){
          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 20;

          $som_moy_trim_1 = 0;
          $moy_max_trim_1 = 0;
          $moy_min_trim_1 = 20;

          $som_moy_trim_2 = 0;
          $moy_max_trim_2 = 0;
          $moy_min_trim_2 = 20;

          $som_moy_trim_3 = 0;
          $moy_max_trim_3 = 0;
          $moy_min_trim_3 = 20;

          $moyenne_eleves = array();
          $moyenne_eleves_trim_1 = array();
          $moyenne_eleves_trim_2 = array();
          $moyenne_eleves_trim_3 = array();


          foreach($data->eleves as $eleve) {
               $som_point = 0;
               $som_moy_trim = 0;

               foreach ($eleve->evaluations as $evaluation) {
                    foreach ($data->trimestres as  $key =>  $trimestre) {
                         $index = $key + 1;
                         foreach ($trimestre->evaluation_modeles as $k => $evaluation_modele) {
                              if($evaluation_modele->evaluation_modele_niveau_id == $evaluation->evaluation_modele_niveau_id){
                                   $som_moy_trim += @$evaluation->evaluation_moyenne_trim;
                                   ${"moyenne_eleves_trim_$index"} = self::to_sort(${"moyenne_eleves_trim_$index"}, @$evaluation->evaluation_moyenne_trim, $eleve->eleves_scolarite_id);
                              }
                         }
                    }
               }

               $moyenne_eleves = self::to_sort($moyenne_eleves, @round(($som_moy_trim/3), 2), $eleve->eleves_scolarite_id);

               $moy = @round(($som_moy_trim/3), 2);
               if($moy > 0){
                    $som_moy += $moy;
                    if($moy_min > $moy){
                         $moy_min = $moy;
                    }
                    if($moy_max < $moy){
                         $moy_max = $moy;
                    }
               }
          }

          for ($i=1; $i <= 3; $i++) {
               foreach (${"moyenne_eleves_trim_$i"} as $value) {
                    if($value['moyenne'] > 0){
                         ${"som_moy_trim_$i"} += $value['moyenne'];
                         if(${"moy_min_trim_$i"} > $value['moyenne']){
                              ${"moy_min_trim_$i"} = $value['moyenne'];
                         }
                         if(${"moy_max_trim_$i"} < $value['moyenne']){
                              ${"moy_max_trim_$i"} = $value['moyenne'];
                         }
                    }
               }
          }

          foreach ($data->eleves as $eleve) {
               $som_moy_trim = 0;

               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/annuelle/ann_'.$data->trimestres[0]->settings_cycle_code.'.pdf');

               $pageId = $pdf->importPage(1);
               $pdf->useTemplate($pageId, 0, 0);
               $pdf->SetFillColor(255, 255, 255);
               $pdf->SetTextColor(51, 102, 153);

               $pdf->setY(60);
               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->SetFont('Arial','B',20);
               $pdf->cell(195, 9, strtoupper(utf8_decode("TABLEAU RECAPITULATIF")),0,1,'C',1);

               $pdf->SetTextColor(0, 0, 0);

               $pdf->SetFont('Arial','',10);

               $pdf->text(25, 80, utf8_decode('Prénoms : '.@$eleve->prenoms));
               $pdf->text(25, 85, utf8_decode('Né (e) le : '.mysql_to_date(@$eleve->naissance_date)));
               $pdf->text(25, 90, utf8_decode('Matricule : '.@$eleve->eleve_matricule));

               $pdf->text(100, 80, utf8_decode('Nom : '.@$eleve->nom));
               $pdf->text(100, 85, utf8_decode('à : '.@$eleve->naissance_lieu));
               $pdf->text(100, 90, utf8_decode("Nbre d'elèves : ".@count($data->eleves)));

               $pdf->text(155, 80, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));
               $pdf->text(155, 85, utf8_decode('Classe : '.@$eleve->classe_name));
               $pdf->text(155, 90, utf8_decode('Classe redoublée : '.null));

               $cols = [100,25,60];
               $pdf->SetFillColor(15, 37, 63);
               $h = 9;

               $pdf->SetFont('Arial','B',12);
               $pdf->SetTextColor(255, 255, 255);

               $pdf->setY(95);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("DISCIPLINES"),1 ,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode("NOTES"),1,0,'C',1);
               $pdf->cell($cols[2],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);

               foreach ($data->trimestres as $index => $trimestre) {
                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->setX(3);
                    $pdf->cell(10);

                    $pdf->cell(40,($h*2), strtoupper(utf8_decode(@$trimestre->evaluation_trimestre_name)),1,0,'L',1);
                    foreach ($trimestre->evaluation_modeles as $key => $evaluation_modele) {
                         $verif = false;

                         foreach ($eleve->evaluations as $k => $evaluation) {
                              if($evaluation_modele->evaluation_modele_niveau_id == $evaluation->evaluation_modele_niveau_id){
                                   // $pdf->SetFont('Arial','',9);
                                   // $pdf->cell(60,$h, utf8_decode('MOYENNE CONTRÔLE CONTINUE'),1,0,'L',1);
                                   // $pdf->SetFont('Arial','',12);
                                   // $pdf->cell($cols[1],$h, utf8_decode(@$evaluation->evaluation_moyenne_cont),1,0,'C',1);
                                   // $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_moyen(@$evaluation->evaluation_moyenne_cont)),1,1,'C',1);

                                   // $pdf->cell(43);
                                   $pdf->SetFont('Arial','',9);
                                   $pdf->cell(60,$h, utf8_decode('COMPOSITION N°'.($index+1)),1,0,'L',1);
                                   $pdf->SetFont('Arial','',12);
                                   $pdf->cell($cols[1],$h, utf8_decode(@$evaluation->evaluation_moyenne_trim),1,0,'C',1);
                                   $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_moyen(@$evaluation->evaluation_moyenne_trim)),1,1,'C',1);

                                   $pdf->cell(43);
                                   $pdf->SetFont('Arial','b',9);
                                   $pdf->cell(60,$h, utf8_decode('MOYENNE TRIMESTRE N°'.($index+1)),1,0,'L',1);
                                   $pdf->SetFont('Arial','b',12);
                                   $pdf->cell($cols[1],$h, utf8_decode(@$evaluation->evaluation_moyenne_trim),1,0,'C',1);
                                   $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_moyen(@$evaluation->evaluation_moyenne_trim)),1,1,'C',1);
                                   $som_moy_trim += @$evaluation->evaluation_moyenne_trim;

                                   $verif = true;
                              }
                         }
                         if($verif == false){

                              // $pdf->SetFont('Arial','',9);
                              // $pdf->cell(60,$h, utf8_decode('MOYENNE CONTRÔLE CONTINUE'),1,0,'L',1);
                              // $pdf->SetFont('Arial','',12);
                              // $pdf->cell($cols[1],$h, "0",1,0,'C',1);
                              // $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_moyen(0)),1,1,'C',1);
                              // $pdf->cell(43);

                              $pdf->SetFont('Arial','',9);
                              $pdf->cell(60,$h, utf8_decode('MOYENNE COMPOSITION N°'.($index+1)),1,0,'L',1);
                              $pdf->SetFont('Arial','',12);
                              $pdf->cell($cols[1],$h, "0",1,0,'C',1);
                              $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_moyen(0)),1,1,'C',1);
                              $pdf->cell(43);

                              $pdf->SetFont('Arial','b',9);
                              $pdf->cell(60,$h, utf8_decode('MOYENNE TRIMESTRE N°'.($index+1)),1,0,'L',1);
                              $pdf->SetFont('Arial','b',12);
                              $pdf->cell($cols[1],$h, "0",1,0,'C',1);
                              $pdf->cell($cols[2],$h, utf8_decode(self::get_comment_moyen(0)),1,1,'C',1);
                         }
                    }
               }

               $cols = [100, 25, 45, 15];

               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[0],$h, utf8_decode("MOYENNE ANNUELLE"),1,0,'L',1);
               $pdf->SetFont('Arial','B',12);
               $pdf->cell($cols[1],$h, utf8_decode(@round(($som_moy_trim/3), 2)),1,0,'C',1);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[2],$h, utf8_decode("ABSENCES ANNUELLE"),1,0,'L',1);
               $pdf->SetFont('Arial','B',12);
               $pdf->cell($cols[3],$h, utf8_decode(@self::get_absences($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id)),1,1,'C',1);

               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[0],$h, utf8_decode("RANG"),1,0,'L',1);
               $pdf->SetFont('Arial','B',12);
               $pdf->cell($cols[1],$h, utf8_decode(@self::get_rank($moyenne_eleves, round(($som_moy_trim/3), 2), 'moyenne')),1,0,'C',1);
               $pdf->SetFont('Arial','B',9);
               $pdf->cell($cols[2],$h, utf8_decode("RETARD ANNUELLE"),1,0,'L',1);
               $pdf->SetFont('Arial','B',12);
               $pdf->cell($cols[3],$h, utf8_decode(@self::get_retards($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id)),1,1,'C',1);

               $h = 5;
               $pdf->SetFont('Arial','i',9);

               $cols = [42, 25, 40, 20];

               $pdf->setY(215);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("Satisfaisant ; doit continuer"),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("Peut mieux faire"),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("Insatisfaisant"),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("Redouble"),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(10);
               $pdf->cell($cols[0],$h, utf8_decode("Exclu"),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);

               $h = 5;
               $pdf->setY(215);
               $pdf->setX(3);
               $pdf->cell(98.5);
               $pdf->cell(14,$h,  utf8_decode('Trim. 1'),1,0,'C',1);
               $pdf->cell(14,$h,  utf8_decode('Trim. 2'),1,0,'C',1);
               $pdf->cell(14,$h,  utf8_decode('Trim. 3'),1,0,'C',1);
               $pdf->cell(14,$h, utf8_decode('Gén.'),1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(62.5);
               $pdf->cell(36,$h, utf8_decode("Plus Forte Moyenne"),1,0,'L',1);
               $pdf->cell(14,$h, $moy_max_trim_1,1,0,'C',1);
               $pdf->cell(14,$h, $moy_max_trim_2,1,0,'C',1);
               $pdf->cell(14,$h, $moy_max_trim_3,1,0,'C',1);
               $pdf->cell(14,$h, $moy_max,1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(62.5);
               $pdf->cell(36,$h, utf8_decode("Plus Faible Moyenne"),1,0,'L',1);
               if($moy_min_trim_1 != 20)
               $pdf->cell(14,$h, $moy_min_trim_1,1,0,'C',1);
               else
               $pdf->cell(14,$h, '0',1,0,'C',1);
               if($moy_min_trim_2 != 20)
               $pdf->cell(14,$h, $moy_min_trim_2,1,0,'C',1);
               else
               $pdf->cell(14,$h, '0',1,0,'C',1);
               if($moy_min_trim_3 != 20)
               $pdf->cell(14,$h, $moy_min_trim_3,1,0,'C',1);
               else
               $pdf->cell(14,$h, '0',1,0,'C',1);
               $pdf->cell(14,$h, $moy_min,1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(62.5);
               $pdf->cell(36,$h, utf8_decode("Moyenne de la classe"),1,0,'L',1);
               $pdf->cell(14,$h, round(($som_moy_trim_1/count($moyenne_eleves_trim_1)), 2),1,0,'C',1);
               $pdf->cell(14,$h, round(($som_moy_trim_2/count($moyenne_eleves_trim_2)), 2),1,0,'C',1);
               $pdf->cell(14,$h, round(($som_moy_trim_3/count($moyenne_eleves_trim_3)), 2),1,0,'C',1);
               $pdf->cell(14,$h, round(($som_moy/count($data->eleves)), 2),1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(62.5);
               $pdf->cell(36,$h, utf8_decode("Taux de réussite"),1,0,'L',1);
               $pdf->cell(14,$h, @self::get_taux($moyenne_eleves_trim_1, 10, count($moyenne_eleves_trim_1))." %",1,0,'C',1);
               $pdf->cell(14,$h, @self::get_taux($moyenne_eleves_trim_2, 10, count($moyenne_eleves_trim_2))." %",1,0,'C',1);
               $pdf->cell(14,$h, @self::get_taux($moyenne_eleves_trim_3, 10, count($moyenne_eleves_trim_3))." %",1,0,'C',1);
               $pdf->cell(14,$h, @self::get_taux($moyenne_eleves, 10, count($data->eleves))." %",1,1,'C',1);               //
               $h = 5;
               $pdf->setY(215);
               $pdf->setX(3);
               $pdf->cell(158);
               $pdf->cell(30,$h, utf8_decode("Félicitation "),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(158);
               $pdf->cell(30,$h, utf8_decode("Encouragement "),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(158);
               $pdf->cell(30,$h, "Tableau d'honneur ",1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(158);
               $pdf->cell(30,$h, utf8_decode("Avertissement "),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               $pdf->setX(3);
               $pdf->cell(158);
               $pdf->cell(30,$h, utf8_decode("Blâme "),1,0,'L',1);
               $pdf->cell(7,$h, "",1,1,'C',1);
               // }
          }
     }

     public function get_cont_stats($classe_id, $evaluation_trimestre_id){
          $this->db->select('evaluation_modele_niveau_id');
          $this->db->from('evaluation_modele_niveaux');
          $this->db->join('settings_niveaux', 'settings_niveaux.settings_niveau_id = evaluation_modele_niveaux.settings_niveau_id');
          $this->db->join('classes', 'classes.settings_niveau_id = settings_niveaux.settings_niveau_id');
          $this->db->join('settings_cycles', 'settings_cycles.settings_cycle_id = settings_niveaux.settings_cycle_id');
          $this->db->join('evaluation_modeles', 'evaluation_modeles.evaluation_modele_id = evaluation_modele_niveaux.evaluation_modele_id');
          $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
          $this->db->join('evaluation_trimestres', 'evaluation_trimestres.evaluation_trimestre_id = evaluation_modeles.evaluation_trimestre_id');
          $this->db->where('evaluation_trimestres.evaluation_trimestre_id', $evaluation_trimestre_id);
          $this->db->where('classes.classe_id', $classe_id);
          $this->db->where('settings_evaluations.settings_evaluation_code', "con");
          $query = $this->db->get();
          $evaluation_modele_niveaux = @$query->result();

          $status = array();

          foreach($evaluation_modele_niveaux as $evaluation_modele_niveau) {

               $status["data"] = $this->evaluation_model->get_annuelle($classe_id, $evaluation_modele_niveau->evaluation_modele_niveau_id);

               switch($status["data"]->settings_cycle_code) {
                    case 'presco':
                    break;
                    case 'eleme':
                    $status["som_moy"] = 0;
                    $status["moy_max"] = 0;
                    $status["moy_min"] = 10;

                    foreach($data->eleves as $eleve) {
                         $som_point = 0;
                         $som_coef = 0;

                         foreach($data->modules as $module) {
                              if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                                   if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                                        $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                        foreach ($eleve->notes as $note) {
                                             if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                                  $som_point += @$note->evaluation_note_value * @$module->activites[0]->evaluation_note_config_coef;
                                             }
                                        }
                                   }
                              }else{
                                   foreach($module->activites as $index => $activite) {
                                        if(@$activite->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                                             $check = false;
                                             foreach ($eleve->notes as $key => $note) {
                                                  if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                                                       $som_coef += @$activite->evaluation_note_config_coef;
                                                       $som_point += @$note->evaluation_note_value * @$activite->evaluation_note_config_coef;
                                                       $check = true;
                                                  }
                                             }
                                             if($check == false){
                                                  $som_coef += @$activite->evaluation_note_config_coef;
                                             }
                                        }
                                   }
                              }
                         }

                         $status["som_moy"] += @round($som_point/$som_coef, 2);

                         if($moy_min > @round($som_point/$som_coef, 2)){
                              $status["moy_min"] = @round($som_point/$som_coef, 2);
                         }
                         if($moy_max < @round($som_point/$som_coef, 2)){
                              $status["moy_max"] = @round($som_point/$som_coef, 2);
                         }
                    }
                    break;
                    case 'moyen':
                    break;

                    default:
                    redirect("help");
                    break;
               }
          }
          return $status;
     }

     public function get_notes_cont($evaluation_trimestre_id, $eleves_scolarite_id, $evaluation_note_config_id){
          $this->db->select('sum(evaluation_note_value) as evaluation_note_value, evaluation_note_config_coef');
          $this->db->from('evaluation_notes');
          $this->db->join('evaluation_note_configs', 'evaluation_note_configs.evaluation_note_config_id = evaluation_notes.evaluation_note_config_id');
          $this->db->join('evaluation_modele_niveaux', 'evaluation_modele_niveaux.evaluation_modele_niveau_id = evaluation_notes.evaluation_modele_niveau_id');
          $this->db->join('evaluation_modeles', 'evaluation_modeles.evaluation_modele_id = evaluation_modele_niveaux.evaluation_modele_id');
          $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
          $this->db->join('evaluation_trimestres', 'evaluation_trimestres.evaluation_trimestre_id = evaluation_modeles.evaluation_trimestre_id');
          $this->db->where('evaluation_trimestres.evaluation_trimestre_id', $evaluation_trimestre_id);
          $this->db->where('evaluation_notes.eleves_scolarite_id', $eleves_scolarite_id);
          $this->db->where('evaluation_notes.evaluation_note_config_id', $evaluation_note_config_id);
          $this->db->where('settings_evaluations.settings_evaluation_code', "con");
          $query = $this->db->get();
          return @$query->row();
     }

     public function get_rank_in_module($evaluation_trimestre_id, $eleves_scolarite_id, $evaluation_note_config_id){
          $this->db->select('sum(evaluation_note_value) as evaluation_note_value, evaluation_note_config_coef');
          $this->db->from('evaluation_notes');
          $this->db->join('evaluation_note_configs', 'evaluation_note_configs.evaluation_note_config_id = evaluation_notes.evaluation_note_config_id');
          $this->db->join('evaluation_modele_niveaux', 'evaluation_modele_niveaux.evaluation_modele_niveau_id = evaluation_notes.evaluation_modele_niveau_id');
          $this->db->join('evaluation_modeles', 'evaluation_modeles.evaluation_modele_id = evaluation_modele_niveaux.evaluation_modele_id');
          $this->db->join('settings_evaluations', 'settings_evaluations.settings_evaluation_id = evaluation_modeles.settings_evaluation_id');
          $this->db->join('evaluation_trimestres', 'evaluation_trimestres.evaluation_trimestre_id = evaluation_modeles.evaluation_trimestre_id');
          $this->db->where('evaluation_trimestres.evaluation_trimestre_id', $evaluation_trimestre_id);
          $this->db->where('evaluation_notes.eleves_scolarite_id', $eleves_scolarite_id);
          $this->db->where('evaluation_notes.evaluation_note_config_id', $evaluation_note_config_id);
          $this->db->where('settings_evaluations.settings_evaluation_code', "con");
          $query = $this->db->get();
          return @$query->row();
     }

     public function get_rank($tab, $search, $identifier){
          $rank = 0;
          if(is_nan($search)){
               $search = 0;
          }
          foreach ($tab as $key => $value) {
               if($value[$identifier] == $search){
                    $rank = $key+1;
                    return $rank;
               }
          }
          return $rank;
     }

     public function to_sort($tab, $moyenne, $eleves_scolarite_id){
          $result = array();
          if(is_nan($moyenne)){
               $data["moyenne"] = 0;
               $moyenne = 0;
          }else{
               $data["moyenne"] = $moyenne;
          }
          $data["eleves_scolarite_id"] = $eleves_scolarite_id;
          $verif = false;

          foreach($tab as $row) {
               if($row['moyenne'] >= $moyenne){
                    array_push($result, $row);
               }else{
                    if($verif == false){
                         array_push($result, $data);
                         $verif = true;
                    }
                    array_push($result, $row);
               }
          }

          if($verif == false){
               array_push($result, $data);
          }
          return $result;
     }

     public function get_taux($tab, $moyenne, $n){
          $cpt = 0;

          foreach($tab as $row) {
               if($row['moyenne'] >= $moyenne){
                    $cpt ++;
               }
          }

          return round($cpt/$n*100, 2);
     }

     public function get_absences($eleves_scolarite_id, $evaluation_modele_niveau_id){
          $this->db->select('*');
          $this->db->from('evaluation_absences');
          $this->db->where('eleves_scolarite_id', $eleves_scolarite_id);
          $query = $this->db->get();
          $eleve->absences = @$query->result();
          $nombre = 0;
          foreach ($eleve->absences as $absence) {
               $start_date = strtotime($absence->evaluation_absence_debut);
               $end_date = strtotime($absence->evaluation_absence_fin);
               $nombre += ($end_date - $start_date)/60/60/24;
          }
          return $nombre." J";
     }

     public function get_retards($eleves_scolarite_id, $evaluation_modele_niveau_id){
          $this->db->select('*');
          $this->db->from('evaluation_retards');
          $this->db->where('eleves_scolarite_id', $eleves_scolarite_id);
          $query = $this->db->get();
          $eleve->absences = @$query->result();
          $nombre = 0;
          foreach ($eleve->absences as $absence) {
               $nombre += ($absence->evaluation_retard_fin - $absence->evaluation_retard_debut);
          }
          return $nombre." H";
     }

     public function get_comment_moyen($value){
          if($value == 20)return("Excellent");
          else if($value >= 17)return("Très Bien");
          else if($value >= 14)return("Bien");
          else if($value >= 12)return("Assez Bien");
          else if($value >= 9)return("Passable");
          else if($value >= 7)return("Insuffisant");
          else if($value >= 5)return("Faible");
          else return("Très Faible");
     }

     public function get_comment_elementaire($value){
          if($value == 10)return("Excellent");
          else if($value >= 9)return("Très Bien");
          else if($value >= 8)return("Bien");
          else if($value >= 6)return("Assez Bien");
          else if($value >= 5)return("Passable");
          else if($value >= 3)return("Peu Réussi");
          else return("Pas Réussi");
     }

}
