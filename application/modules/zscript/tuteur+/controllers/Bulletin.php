<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bulletin extends IBEMS_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->model('evaluation/evaluation_model');
     }

     public function showBulletin(){
          $classe_id = (int)$this->uri->segment(4);
          $evaluation_modele_niveau_id = (int)$this->uri->segment(5);
          $eleves_scolarite_id = (int)$this->uri->segment(6);
          $scolarite_id = (int)$this->uri->segment(7);

          $_SESSION['scolarite'] = array();
          $_SESSION['dashboard']['settings_scolarite_id'] = $scolarite_id;

          $data = $this->evaluation_model->get_bulletin($classe_id, $evaluation_modele_niveau_id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');

          switch($data->settings_cycle_code) {
               case 'presco':
               self::showBulletin_prescolaire($pdf, $data);
               break;
               case 'eleme':
               self::showBulletin_elementaire($pdf, $data, $eleves_scolarite_id);
               break;
               case 'moyen':
               self::showBulletin_moyen($pdf, $data, $eleves_scolarite_id);
               break;

               default:
               redirect("help");
               break;
          }

          $file_name = 'Bulletin.pdf';

          $pdf->Output('I');
     }

     public function showBulletin_prescolaire($pdf, $data){
          foreach ($data->eleves as $eleve) {
               $som_point = 0;
               $som_coef = 0;
               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/bulletin/bul_'.$data->settings_cycle_code.'.pdf');

               $pageId = $pdf->importPage(1);
               $pdf->useTemplate($pageId, 0, 0);
               $pdf->SetFont('Arial','',10);

               $pdf->text(155, 40, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));

               $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
               $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));


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

     public function showBulletin_elementaire($pdf, $data, $eleves_scolarite_id){
          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 10;

          foreach($data->eleves as $eleve) {
               $som_point = 0;
               $som_coef = 0;

               foreach($data->modules as $module) {
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                              foreach ($eleve->notes as $note) {
                                   if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                        $som_coef += $module->activites[0]->evaluation_note_config_coef;
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

               $som_moy += @round($som_point/$som_coef, 2);

               if($moy_min > @round($som_point/$som_coef, 2)){
                    $moy_min = @round($som_point/$som_coef, 2);
               }
               if($moy_max < @round($som_point/$som_coef, 2)){
                    $moy_max = @round($som_point/$som_coef, 2);
               }
          }

          // die();


          foreach ($data->eleves as $eleve) {
               $som_point = 0;
               $som_coef = 0;
               $som_note = 0;

               if($data->settings_evaluation_code == "com") {
                    $som_point_cont = 0;
                    $som_coef_cont = 0;
                    $som_note_cont = 0;

                    $som_point_trim = 0;
                    $som_coef_trim = 0;
                    $som_note_trim = 0;
               }

               if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                    $pdf->AddPage();
                    $pageCount = $pdf->setSourceFile('temp/models/bulletin/bul_'.$data->settings_cycle_code.'.pdf');

                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);
                    $pdf->SetFont('Arial','',10);

                    $pdf->text(155, 40, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));

                    $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
                    $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));


                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(51, 102, 153);
                    $pdf->setY(60);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->SetFont('Arial','B',15);
                    if($data->settings_evaluation_code == "con")
                    $pdf->cell(195, 9, strtoupper(utf8_decode("tableau récapitulatif du ".$data->evaluation_modele_name)),0,1,'C',1);
                    else
                    $pdf->cell(195, 9, strtoupper(utf8_decode("tableau récapitulatif de la ".$data->evaluation_modele_name)),0,1,'C',1);

                    $pdf->SetFont('Arial','',10);

                    $cols = [92.5,13,13,24.5,42];
                    $pdf->SetFillColor(15, 37, 63);
                    $h = 7;

                    $pdf->SetFont('Arial','B',9);
                    $pdf->SetTextColor(255, 255, 255);

                    $pdf->setY(75);
                    $pdf->setX(3);
                    $pdf->cell(10);
                    $pdf->cell($cols[0],10, utf8_decode("ACTIVITES"),1 ,0,'C',1);
                    $pdf->cell($cols[1],10, utf8_decode("NOTES"),1,0,'C',1);
                    $pdf->cell($cols[2],10, utf8_decode("COEF"),1,0,'C',1);
                    $pdf->cell($cols[3],10, utf8_decode("NOTES*COEF"),1,0,'C',1);
                    $pdf->cell($cols[4],10, utf8_decode("APPRECIATIONS"),1,1,'C',1);

               }

               foreach ($data->modules as $module) {
                    if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                         $pdf->SetFont('Arial','',9);
                         $pdf->SetFillColor(255, 255, 255);
                         $pdf->SetTextColor(0, 0, 0);

                         $pdf->setX(3);
                         $pdf->cell(10);
                    }
                    if(count($module->activites) != 0){
                         if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                              if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                                   if($eleve->eleves_scolarite_id == $eleves_scolarite_id)
                                   $pdf->cell($cols[0],$h, utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
                                   $check = false;
                                   foreach ($eleve->notes as $note) {
                                        if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                             $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                             if($data->settings_evaluation_code == "com" && $module->activites[0]->evaluation_note_config_cont == 1) {
                                                  $som_coef_cont += $module->activites[0]->evaluation_note_config_coef;
                                             }
                                             $som_point += @$note->evaluation_note_value * @$module->activites[0]->evaluation_note_config_coef;
                                             $som_note += @$note->evaluation_note_value;
                                             if($data->settings_evaluation_code == "com") {
                                                  if($module->activites[0]->evaluation_note_config_cont == 1){
                                                       $som_point_cont += self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value * @$module->activites[0]->evaluation_note_config_coef;
                                                       $som_note_cont += self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value;
                                                       $som_point_trim += ((@$note->evaluation_note_value + self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value) / 2) * @$module->activites[0]->evaluation_note_config_coef;
                                                  }else{
                                                       $som_point_trim += (@$note->evaluation_note_value) * @$module->activites[0]->evaluation_note_config_coef;
                                                  }

                                             }
                                             if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                                                  $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
                                                  $pdf->cell($cols[2],$h, utf8_decode(@$module->activites[0]->evaluation_note_config_coef),1,0,'C',1);
                                                  $pdf->cell($cols[3],$h, utf8_decode(@$note->evaluation_note_value*@$module->activites[0]->evaluation_note_config_coef),1,0,'C',1);
                                                  $pdf->cell($cols[4],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
                                             }
                                             $check = true;
                                        }
                                   }
                                   if($check == false){
                                        if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                                             $pdf->cell($cols[1],$h, "-",1,0,'C',1);
                                             $pdf->cell($cols[2],$h, "-",1,0,'C',1);
                                             $pdf->cell($cols[3],$h, "-",1,0,'C',1);
                                             $pdf->cell($cols[4],$h, "-",1,1,'C',1);
                                        }
                                   }
                              }
                         }else{
                              if($eleve->eleves_scolarite_id == $eleves_scolarite_id)
                              $pdf->cell(67.5,($h*count($module->activites)), utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
                              foreach($module->activites as $index => $activite) {
                                   $yo = false;

                                   if(@$activite->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){

                                        $som_coef += $activite->evaluation_note_config_coef;
                                        if($data->settings_evaluation_code == "com" && $activite->evaluation_note_config_cont == 1) {
                                             $som_coef_cont += $activite->evaluation_note_config_coef;
                                        }

                                        $check = false;


                                        foreach ($eleve->notes as $key => $note) {
                                             if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                                                  // if(@$key == 0 && @$index != 0)$pdf->cell(70.5);
                                                  if(@$key != 0 && @$index != 0){
                                                       $pdf->cell(70.5);
                                                       $yo = true;
                                                  }
                                                  if(@$index != 0 && @$yo == false)$pdf->cell(70.5);
                                                  $som_point += @$note->evaluation_note_value * @$activite->evaluation_note_config_coef;
                                                  $som_note += @$note->evaluation_note_value;
                                                  if($data->settings_evaluation_code == "com") {
                                                       if($activite->evaluation_note_config_cont == 1){
                                                            $som_point_cont += self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value * $activite->evaluation_note_config_coef;
                                                            $som_note_cont += self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value;
                                                            $som_point_trim += ((@$note->evaluation_note_value + self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value) / 2)* $activite->evaluation_note_config_coef;
                                                       }else{
                                                            $som_point_trim += (@$note->evaluation_note_value)* $activite->evaluation_note_config_coef;
                                                       }
                                                  }
                                                  if($eleve->eleves_scolarite_id == $eleves_scolarite_id){
                                                       $pdf->cell(25,$h, utf8_decode(@$activite->settings_activite_name),1,0,'L',1);
                                                       $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
                                                       $pdf->cell($cols[2],$h, utf8_decode(@$activite->evaluation_note_config_coef),1,0,'C',1);
                                                       $pdf->cell($cols[3],$h, utf8_decode(round(@$note->evaluation_note_value*@$activite->evaluation_note_config_coef, 2)),1,0,'C',1);
                                                       $pdf->cell($cols[4],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
                                                  }
                                                  $check = true;
                                             }
                                        }
                                        if($check == false){
                                             if($eleve->eleves_scolarite_id == $eleves_scolarite_id){
                                                  if(@$index != 0 && @$yo == false)$pdf->cell(70.5);
                                                  // if(@$key == 0 || @$index != 0)$pdf->cell(70.5);
                                                  $pdf->cell(25,$h, utf8_decode(@$activite->settings_activite_name),1,0,'L',1);
                                                  $pdf->cell($cols[1],$h, "-",1,0,'C',1);
                                                  $pdf->cell($cols[2],$h, "-",1,0,'C',1);
                                                  $pdf->cell($cols[3],$h, "-",1,0,'C',1);
                                                  $pdf->cell($cols[4],$h, "-",1,1,'C',1);
                                             }
                                        }
                                   }
                              }
                         }
                    }
               }

               if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetFillColor(240, 240, 240);


                    $pdf->setX(3);
                    $pdf->cell(10);

                    $pdf->cell($cols[0],$h, "TOTAUX",1,0,'C',1);
                    $pdf->cell($cols[1],$h, round(@$som_note, 2),1,0,'C',1);
                    $pdf->cell($cols[2],$h, round(@$som_coef, 2),1,0,'C',1);
                    $pdf->cell($cols[3],$h, round(@$som_point, 2),1,0,'C',1);
                    $pdf->cell($cols[4],$h, "",1,1,'C',1);

                    $pdf->SetFont('Arial','b',9);
                    $pdf->SetFillColor(255, 255, 255);


                    $h = 12;
               }
               if($data->settings_evaluation_code == "con"){
                    if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell(92.5,$h, utf8_decode("TOTAL : ".round(@$som_point, 2)),1,0,'C',1);
                         $pdf->cell(92.5,$h, utf8_decode("MOY : ".@round($som_point/$som_coef, 2)),1,1,'C',1);

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell(92.5,$h, utf8_decode("MEILLEURE MOYENNE : ".@$moy_max),1,0,'C',1);
                         $pdf->cell(92.5,$h, utf8_decode("PLUS FAIBLE MOYENNE : ".@$moy_min),1,1,'C',1);

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell(185,$h, utf8_decode("MOYENNE DE LA CLASSE : ".@round($som_moy/count($data->eleves), 2)),1,1,'C',1);
                    }
               }else{
                    if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $moy_cont = @round($som_point_cont/$som_coef_cont, 2);
                         $moy_comp = @round($som_point/$som_coef, 2);
                         $pdf->cell(61,$h, utf8_decode("MOYENNE CONTROLE : ".@$moy_cont),1,0,'L',1);
                         $pdf->cell(62,$h, utf8_decode("MOYENNE COMPOSITION : ".@$moy_comp),1,0,'L',1);
                         // $pdf->cell(62,$h, utf8_decode("MOYENNE TRIMESTRE : ".@round($som_point_trim/$som_coef, 2)),1,1,'L',1);
                         $pdf->cell(62,$h, utf8_decode("MOYENNE TRIMESTRE : ".@round(($moy_cont+$moy_comp)/2, 2)),1,1,'L',1);

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell(61,$h, utf8_decode("MOYENNE DE CLASSE : ".@round($som_moy/count($data->eleves), 2)),1,0,'L',1);
                         $pdf->cell(62,$h, utf8_decode("MEILLEURE MOYENNE : ".@$moy_max),1,0,'L',1);
                         $pdf->cell(62,$h, utf8_decode("PLUS FAIBLE MOYENNE : ".@$moy_min),1,1,'L',1);
                    }
                    $evaluation = array();
                    $evaluation['evaluation_modele_niveau_id'] = $data->evaluation_modele_niveau_id;
                    $evaluation['eleves_scolarite_id'] = $eleve->eleves_scolarite_id;
                    $evaluation['evaluation_moyenne_cont'] = str_replace(',', '.', @$moy_cont);
                    $evaluation['evaluation_moyenne_comp'] = str_replace(',', '.', @$moy_comp);
                    $evaluation['evaluation_moyenne_trim'] = str_replace(',', '.', @round(($moy_cont+$moy_comp)/2, 2));
                    $evaluation['evaluation_retard'] = (int) filter_var(@self::get_retards($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id), FILTER_SANITIZE_NUMBER_INT);
                    $evaluation['evaluation_absence'] = (int) filter_var(@self::get_absences($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id), FILTER_SANITIZE_NUMBER_INT);

                    $this->evaluation_model->insert_evaluation($evaluation);
               }


          }
     }

     public function showBulletin_moyen($pdf, $data, $eleves_scolarite_id){
          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 20;
          $moyenne_eleves = array();
          $moyenne_of_modules = array();

          foreach($data->modules as $module) {
               if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                    if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                         $moyenne_of_modules[$module->activites[0]->evaluation_note_config_id] = array();
                    }
               }
          }

          foreach($data->eleves as $eleve) {
               $som_point = 0;
               $som_coef = 0;

               foreach($data->modules as $module) {
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                              foreach ($eleve->notes as $note) {
                                   if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                        $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                        $mcc = @round(self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value / 2, 2);
                                        $som_point += @round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef;
                                        $moyenne_of_modules[$module->activites[0]->evaluation_note_config_id] = self::to_sort($moyenne_of_modules[$module->activites[0]->evaluation_note_config_id], @round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef, $eleve->eleves_scolarite_id);
                                   }
                              }
                         }else{
                              foreach ($eleve->notes as $note) {
                                   if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                        $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                        $som_point += @$note->evaluation_note_value * @$note->evaluation_note_config_coef;
                                   }
                              }
                         }
                    }else{
                         foreach($module->activites as $index => $activite) {
                              if(@$activite->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                                   foreach ($eleve->notes as $key => $note) {
                                        if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                                             $som_coef += @$activite->evaluation_note_config_coef;
                                             $mcc = @round(self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value / 2, 2);
                                             $som_point += @round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef;
                                             $moyenne_of_modules[$activite->evaluation_note_config_id] = self::to_sort($moyenne_of_modules[$activite->evaluation_note_config_id], round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef, $eleve->eleves_scolarite_id);
                                        }
                                   }
                                   foreach ($eleve->notes as $note) {
                                        if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                             $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                             $som_point += @$note->evaluation_note_value * @$note->evaluation_note_config_coef;
                                        }
                                   }
                              }
                         }
                    }
               }

               $moyenne_eleves = self::to_sort($moyenne_eleves, @round($som_point/$som_coef, 2), $eleve->eleves_scolarite_id);

               $moy = @round($som_point/$som_coef, 2);
               if($moy > 0){
                    $som_moy += $moy;
               }

               if($moy_min > @round($som_point/$som_coef, 2)){
                    $moy_min = @round($som_point/$som_coef, 2);
               }
               if($moy_max < @round($som_point/$som_coef, 2)){
                    $moy_max = @round($som_point/$som_coef, 2);
               }
          }

          foreach ($data->eleves as $eleve) {
               $som_point = 0;
               $som_coef = 0;
               $som_note = 0;

               if($data->settings_evaluation_code == "com") {
                    $som_point_cont = 0;
                    $som_coef_cont = 0;
                    $som_note_cont = 0;

                    $som_point_trim = 0;
                    $som_coef_trim = 0;
                    $som_note_trim = 0;

                    $som_point_cont = 0;
                    $som_point_comp = 0;
               }

               if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                    $pdf->AddPage();
                    $pageCount = $pdf->setSourceFile('temp/models/bulletin/bul_'.$data->settings_cycle_code.'.pdf');

                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(51, 102, 153);

                    if($data->settings_evaluation_code == "con"){
                         $pdf->setY(55);
                         $pdf->setX(3);
                         $pdf->cell(5);
                         $pdf->SetFont('Arial','B',15);
                         $pdf->cell(195, 9, strtoupper(utf8_decode($data->evaluation_trimestre_name)),0,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(5);
                         $pdf->cell(195, 9, strtoupper(utf8_decode($data->evaluation_modele_name)),0,1,'C',1);
                    }else{
                         $pdf->setY(60);
                         $pdf->setX(3);
                         $pdf->cell(5);
                         $pdf->SetFont('Arial','B',20);
                         $pdf->cell(195, 9, strtoupper(utf8_decode("COMPOSITION DU ".$data->evaluation_trimestre_name)),0,1,'C',1);
                    }

                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->SetFont('Arial','',10);

                    $pdf->text(25, 80, utf8_decode('Prénoms : '.@$eleve->personne_prenoms));
                    $pdf->text(25, 85, utf8_decode('Né (e) le : '.mysql_to_date(@$eleve->personne_naissance_date)));
                    $pdf->text(25, 90, utf8_decode('Matricule : '.@$eleve->eleve_matricule));

                    $pdf->text(100, 80, utf8_decode('Nom : '.@$eleve->personne_nom));
                    $pdf->text(100, 85, utf8_decode('à : '.@$eleve->personne_naissance_lieu));
                    $pdf->text(100, 90, utf8_decode("Nbre d'elèves : ".@count($data->eleves)));

                    $pdf->text(155, 80, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));
                    $pdf->text(155, 85, utf8_decode('Classe : '.@$eleve->classe_name));
                    $pdf->text(155, 90, utf8_decode('Classe redoublée : '.null));



                    if($data->settings_evaluation_code == "con"){
                         $cols = [100,25,60];
                         $pdf->SetFillColor(15, 37, 63);
                         $h = 7;

                         $pdf->SetFont('Arial','B',9);
                         $pdf->SetTextColor(255, 255, 255);

                         $pdf->setY(95);
                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell($cols[0],$h, utf8_decode("DISCIPLINES"),1 ,0,'C',1);
                         $pdf->cell($cols[1],$h, utf8_decode("NOTES"),1,0,'C',1);
                         $pdf->cell($cols[2],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);
                    }else{
                         $cols = [59, 14, 14, 14, 14, 14, 14, 42];
                         $pdf->SetFillColor(15, 37, 63);
                         $h = 7;

                         $pdf->SetFont('Arial','B',10);
                         $pdf->SetTextColor(255, 255, 255);

                         $pdf->setY(95);
                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell($cols[0],$h, utf8_decode("DISCIPLINES"),1 ,0,'C',1);
                         $pdf->cell($cols[1],$h, utf8_decode("MCC"),1,0,'C',1);
                         $pdf->cell($cols[2],$h, utf8_decode("COMP"),1,0,'C',1);
                         $pdf->cell($cols[3],$h, utf8_decode("MOY/20"),1,0,'C',1);
                         $pdf->cell($cols[4],$h, utf8_decode("COEF"),1,0,'C',1);
                         $pdf->cell($cols[5],$h, utf8_decode("MOY X"),1,0,'C',1);
                         $pdf->cell($cols[6],$h, utf8_decode("RANG"),1,0,'C',1);
                         $pdf->cell($cols[7],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);
                    }

               }

               foreach ($data->modules as $module) {
                    if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                         $pdf->SetFont('Arial','',9);
                         $pdf->SetFillColor(255, 255, 255);
                         $pdf->SetTextColor(0, 0, 0);

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell($cols[0],$h, utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
                    }
                    $check = false;
                    foreach ($eleve->notes as $note) {
                         if($data->settings_evaluation_code == "con"){
                              if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                   if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                                        $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
                                        $pdf->cell($cols[2],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
                                   }
                                   $som_coef += $note->evaluation_note_config_coef;
                                   $som_point += @$note->evaluation_note_value * @$note->evaluation_note_config_coef;
                                   $check = true;
                              }
                         }else{
                              if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                   $som_coef += $note->evaluation_note_config_coef;
                                   if($data->settings_evaluation_code == "com" && $note->evaluation_note_config_cont == 1) {
                                        $som_coef_cont += $note->evaluation_note_config_coef;
                                   }
                                   $mcc = round(self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value / 2, 2);
                                   $som_point += round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef;
                                   $som_point_cont += $mcc *  @$note->evaluation_note_config_coef;
                                   $som_point_comp += @$note->evaluation_note_value * @$note->evaluation_note_config_coef;
                                   if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                                        $pdf->cell($cols[1],$h, utf8_decode(@$mcc),1,0,'C',1);
                                        $pdf->cell($cols[2],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
                                        $pdf->cell($cols[3],$h, utf8_decode(round((@$note->evaluation_note_value+$mcc)/2, 2)),1,0,'C',1);
                                        $pdf->cell($cols[4],$h, utf8_decode(@$note->evaluation_note_config_coef),1,0,'C',1);
                                        $pdf->cell($cols[5],$h, utf8_decode(round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef),1,0,'C',1);
                                        $pdf->cell($cols[6],$h, utf8_decode(@self::get_rank($moyenne_of_modules[$module->activites[0]->evaluation_note_config_id], round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef, 'moyenne')),1,0,'C',1);
                                        $pdf->cell($cols[7],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
                                   }
                                   $check = true;
                              }
                         }
                    }
                    if($check == false){
                         if($data->settings_evaluation_code == "con"){
                              if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                                   $pdf->cell($cols[1],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[2],$h, "",1,1,'L',1);
                              }
                         }else{
                              if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                                   $pdf->cell($cols[1],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[2],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[3],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[4],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[5],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[6],$h, "",1,0,'L',1);
                                   $pdf->cell($cols[7],$h, "",1,1,'L',1);
                              }
                         }
                    }
               }
               if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                    $pdf->SetFont('Arial','B',10);
                    $pdf->SetFillColor(240, 240, 240);
               }
               if($data->settings_evaluation_code == "com"){
                    if($eleve->eleves_scolarite_id == $eleves_scolarite_id){

                         $pdf->setX(3);
                         $pdf->cell(10);

                         $pdf->cell(101,$h, "TOTAUX",1,0,'C',1);
                         $pdf->cell($cols[4],$h, round(@$som_coef, 2),1,0,'C',1);
                         $pdf->cell($cols[5] + $cols[6],$h, round(@$som_point, 2),1,0,'C',1);
                         $pdf->cell($cols[7],$h, "",1,1,'C',1);

                         $pdf->SetFont('Arial','b',9);
                         $pdf->SetFillColor(255, 255, 255);

                         $cols = [46.25, 46.25, 46.25, 46.25];

                         $test = 0;

                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell($cols[0],$h, utf8_decode("MOYENNE : ".@round($som_point/$som_coef, 2)),1,0,'C',1);
                         $pdf->cell($cols[1],$h, utf8_decode("RANG : ".@self::get_rank($moyenne_eleves, round($som_point/$som_coef, 2), 'moyenne')),1,0,'C',1);
                         $pdf->cell($cols[2],$h, utf8_decode("RETARDS : ".@self::get_retards($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id)),1,0,'C',1);
                         $pdf->cell($cols[3],$h, utf8_decode("ABSENCES : ".@self::get_absences($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id)),1,1,'C',1);


                         $h = 5;
                         $pdf->SetFont('Arial','i',9);

                         $pdf->setY(220);
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
                         $pdf->cell($cols[0],$h, utf8_decode("Risque de redoubler"),1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(10);
                         $pdf->cell($cols[0],$h, "Risque l'exclusion",1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);

                         $h = 6.25;
                         $pdf->setY(220);
                         $pdf->setX(3);
                         $pdf->cell(75.875);
                         $pdf->cell(40,$h, utf8_decode("Plus Forte Moyenne"),1,0,'L',1);
                         $pdf->cell(13.25,$h, $moy_max,1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(75.875);
                         $pdf->cell(40,$h, utf8_decode("Plus Faible Moyenne"),1,0,'L',1);
                         $pdf->cell(13.25,$h, $moy_min,1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(75.875);
                         $pdf->cell(40,$h, utf8_decode("Moyenne de la classe"),1,0,'L',1);
                         $pdf->cell(13.25,$h, @round($som_moy/count($data->eleves), 2),1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(75.875);
                         $pdf->cell(40,$h, utf8_decode("Taux de réussite"),1,0,'L',1);
                         $pdf->cell(13.25,$h, @self::get_taux($moyenne_eleves, 10, count($data->eleves))." %",1,1,'C',1);

                         $h = 5;
                         $pdf->setY(220);
                         $pdf->setX(3);
                         $pdf->cell(141.75);
                         $pdf->cell($cols[0],$h, utf8_decode("Félicitation "),1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(141.75);
                         $pdf->cell($cols[0],$h, utf8_decode("Encouragement "),1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(141.75);
                         $pdf->cell($cols[0],$h, "Tableau d'honneur ",1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(141.75);
                         $pdf->cell($cols[0],$h, utf8_decode("Avertissement "),1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);
                         $pdf->setX(3);
                         $pdf->cell(141.75);
                         $pdf->cell($cols[0],$h, utf8_decode("Blâme "),1,0,'L',1);
                         $pdf->cell(7,$h, "",1,1,'C',1);
                    }
                    $evaluation = array();
                    $evaluation['evaluation_modele_niveau_id'] = $data->evaluation_modele_niveau_id;
                    $evaluation['eleves_scolarite_id'] = $eleve->eleves_scolarite_id;
                    $evaluation['evaluation_moyenne_cont'] = str_replace(',', '.', @round($som_point_comp/$som_coef, 2));
                    $evaluation['evaluation_moyenne_comp'] = str_replace(',', '.', @round($som_point_cont/$som_coef, 2));
                    $evaluation['evaluation_moyenne_trim'] = str_replace(',', '.', @round($som_point/$som_coef, 2));
                    $evaluation['evaluation_retard'] = (int) filter_var(@self::get_retards($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id), FILTER_SANITIZE_NUMBER_INT);
                    $evaluation['evaluation_absence'] = (int) filter_var(@self::get_absences($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id), FILTER_SANITIZE_NUMBER_INT);

                    $this->evaluation_model->insert_evaluation($evaluation);
               }
               // else{
               //
               //      $evaluation = array();
               //      $evaluation['evaluation_modele_niveau_id'] = $data->evaluation_modele_niveau_id;
               //      $evaluation['eleves_scolarite_id'] = $eleve->eleves_scolarite_id;
               //      $evaluation['evaluation_moyenne_value'] = str_replace(',', '.', @round($som_point/$som_coef, 2));
               //      $evaluation['evaluation_rang'] = @self::get_rank($moyenne_eleves, round($som_point/$som_coef, 2), 'moyenne');
               //      $evaluation['evaluation_retard'] = (int) filter_var(@self::get_retards($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id), FILTER_SANITIZE_NUMBER_INT);
               //      $evaluation['evaluation_absence'] = (int) filter_var(@self::get_absences($eleve->eleves_scolarite_id, $data->evaluation_modele_niveau_id), FILTER_SANITIZE_NUMBER_INT);
               //
               //      $this->evaluation_model->insert_evaluation($evaluation);
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

               $status["data"] = $this->evaluation_model->get_bulletin($classe_id, $evaluation_modele_niveau->evaluation_modele_niveau_id);

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
          $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
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
          $this->db->where('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);
          $query = $this->db->get();
          $eleve->absences = @$query->result();
          $nombre = 0;
          foreach ($eleve->absences as $absence) {
               $nombre += ($absence->evaluation_retard_fin - $absence->evaluation_retard_debut);
          }
          return $nombre." H";
     }

}
