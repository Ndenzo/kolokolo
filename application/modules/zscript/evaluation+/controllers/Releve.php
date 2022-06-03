<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Releve extends IBEMS_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->model('evaluation/evaluation_model');
     }

     public function showReleve(){
          $classe_id = (int)$this->uri->segment(4);
          $evaluation_modele_niveau_id = (int)$this->uri->segment(5);

          $data = $this->evaluation_model->get_bulletin($classe_id, $evaluation_modele_niveau_id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');

          switch($data->settings_cycle_code) {
               case 'presco':
               self::showReleve_prescolaire($pdf, $data);
               break;
               case 'eleme':
               self::showReleve_elementaire($pdf, $data);
               break;
               case 'moyen':
               self::showReleve_moyen($pdf, $data);
               break;

               default:
               redirect("help");
               break;
          }

          $file_name = 'Releve.pdf';

          $pdf->Output('I');
     }

     public function showReleve_elementaire($pdf, $data){

          $pdf->AddPage('L');
          $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');

          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);
          $pdf->SetFont('Arial','',10);

          $pdf->text(240, 40, utf8_decode('Année scolaire : '.@$data->settings_scolarite_code));
          $pdf->text(240, 50, utf8_decode('Classe : '.@$data->eleves[0]->classe_name));


          // $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
          // $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));

          $nb = 0;
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    foreach($module->activites as $index => $activite) {
                         $nb++;
                    }
               }
          }

          $pdf->SetFillColor(255, 255, 255);
          $pdf->SetTextColor(51, 102, 153);
          $pdf->setY(50);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          if($data->settings_evaluation_code == "con")
          $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes du ".$data->evaluation_modele_name)),0,1,'C',1);
          else
          $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes de la ".$data->evaluation_modele_name)),0,1,'C',1);

          $pdf->SetFont('Arial','',10);

          $cols = [10,50,round(220/($nb+2),0)];
          // $pdf->SetFillColor(15, 37, 63);
          $h = 5;

          $pdf->SetFont('Arial','B',7);
          $pdf->SetTextColor(0, 0, 0);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0],16, utf8_decode("N°"),1 ,0,'C',1);
          $pdf->cell($cols[1],16, utf8_decode("Prénoms -  Nom"),1,0,'C',1);
          $cpt = 0;
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    $pdf->setY(65);
                    $pdf->setX(3);
                    $pdf->cell(65 + ($cols[2]*$cpt));
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         $pdf->cell($cols[2],16, substr(utf8_decode(@$module->evaluation_module_name), 0, 6).".",1,0,'C',1);
                    }else{
                         $pdf->cell($cols[2]*count($module->activites),8, substr(utf8_decode(@$module->evaluation_module_name), 0, 15).".",1,1,'C',1);
                         foreach($module->activites as $index => $activite) {
                              if($index == 0){
                                   $pdf->setY(73);
                                   $pdf->setX(3);
                                   $pdf->cell(65 + ($cols[2]*$cpt));
                              }
                              $pdf->cell($cols[2],8,substr(utf8_decode(@$activite->settings_activite_name), 0, 5).".",1,0,'C',1);
                         }
                    }
                    $cpt += count($module->activites);
               }
          }
          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(65 + ($cols[2]*$cpt));
          $pdf->cell($cols[2],16, utf8_decode("Total"),1 ,0,'C',1);
          $pdf->cell($cols[2],16, utf8_decode("Moyenne"),1,1,'C',1);

          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 10;

          $pdf->SetFillColor(255, 255, 255);
          $h = 5;

          $pdf->SetFont('Arial','B',7);
          $pdf->SetTextColor(15, 37, 63);

          $indexer = 0;

          foreach($data->eleves as $i => $eleve) {
               if($indexer == 21){
                    $indexer = 0;
                    $pdf->AddPage('L');
                    $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');

                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);
                    $pdf->SetFont('Arial','',10);

                    $pdf->text(240, 40, utf8_decode('Année scolaire : '.@$data->settings_scolarite_code));
                    $pdf->text(240, 50, utf8_decode('Classe : '.@$data->eleves[0]->classe_name));


                    // $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
                    // $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));


                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(51, 102, 153);
                    $pdf->setY(50);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->SetFont('Arial','B',15);
                    if($data->settings_evaluation_code == "con")
                    $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes du ".$data->evaluation_modele_name)),0,1,'C',1);
                    else
                    $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes de la ".$data->evaluation_modele_name)),0,1,'C',1);

                    $pdf->SetFont('Arial','',10);

                    $cols = [10,50,round(220/($nb+2),0)];
                    // $pdf->SetFillColor(15, 37, 63);
                    $h = 5;

                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->setY(65);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->cell($cols[0],16, utf8_decode("N°"),1 ,0,'C',1);
                    $pdf->cell($cols[1],16, utf8_decode("Prénoms -  Nom"),1,0,'C',1);
                    $cpt = 0;
                    foreach ($data->modules as $module) {
                         if(count($module->activites) != 0){
                              $pdf->setY(65);
                              $pdf->setX(3);
                              $pdf->cell(65 + ($cols[2]*$cpt));
                              if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                                   $pdf->cell($cols[2],16, substr(utf8_decode(@$module->evaluation_module_name), 0, 6).".",1,0,'C',1);
                              }else{
                                   $pdf->cell($cols[2]*count($module->activites),8, substr(utf8_decode(@$module->evaluation_module_name), 0, 15).".",1,1,'C',1);
                                   foreach($module->activites as $index => $activite) {
                                        if($index == 0){
                                             $pdf->setY(73);
                                             $pdf->setX(3);
                                             $pdf->cell(65 + ($cols[2]*$cpt));
                                        }
                                        $pdf->cell($cols[2],8,substr(utf8_decode(@$activite->settings_activite_name), 0, 5).".",1,0,'C',1);
                                   }
                              }
                              $cpt += count($module->activites);
                         }
                    }
                    $pdf->setY(65);
                    $pdf->setX(3);
                    $pdf->cell(65 + ($cols[2]*$cpt));
                    $pdf->cell($cols[2],16, utf8_decode("Total"),1 ,0,'C',1);
                    $pdf->cell($cols[2],16, utf8_decode("Moyenne"),1,1,'C',1);

                    $som_moy = 0;
                    $moy_max = 0;
                    $moy_min = 10;

                    $pdf->SetFillColor(255, 255, 255);
                    $h = 5;

                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetTextColor(15, 37, 63);
               }

               $pdf->setX(3);
               $pdf->cell(5);

               $pdf->cell($cols[0],$h, $i+1,1,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode(@$eleve->personne_prenoms.' '.@$eleve->personne_nom),1,0,'L',1);

               $som_point = 0;
               $som_coef = 0;
               $som_note = 0;

               foreach($data->modules as $module) {
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                              $check = false;
                              foreach ($eleve->notes as $note) {
                                   if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                        $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                        $som_point += @$note->evaluation_note_value * @$module->activites[0]->evaluation_note_config_coef;
                                        $som_note += @$note->evaluation_note_value;
                                        $pdf->cell($cols[2],$h, @$note->evaluation_note_value,1,0,'C',1);
                                        $check = true;
                                   }
                              }
                              if($check == false){
                                   $pdf->cell($cols[2],$h, "-",1,0,'C',1);
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
                                             $som_note += @$note->evaluation_note_value;
                                             $check = true;
                                             $pdf->cell($cols[2],$h, @$note->evaluation_note_value,1,0,'C',1);
                                        }
                                   }
                                   if($check == false){
                                        $som_coef += @$activite->evaluation_note_config_coef;
                                        $pdf->cell($cols[2],$h, "-",1,0,'C',1);
                                   }
                              }
                         }
                    }
               }

               $indexer ++;

               $pdf->cell($cols[2],$h, $som_note,1 ,0,'C',1);
               $pdf->cell($cols[2],$h, @round($som_point/$som_coef, 2),1,1,'C',1);
          }
     }

     public function showReleve_moyen($pdf, $data){
          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 20;
          $moyenne_eleves = array();
          $moyenne_of_modules = array();

          $pdf->AddPage('L');
          $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');

          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);
          $pdf->SetFont('Arial','',10);

          $pdf->text(240, 40, utf8_decode('Année scolaire : '.@$data->settings_scolarite_code));
          $pdf->text(240, 50, utf8_decode('Classe : '.@$data->eleves[0]->classe_name));


          // $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
          // $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));

          $nb = 0;
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    foreach($module->activites as $index => $activite) {
                         $nb++;
                    }
               }
          }


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
                                        // $moyenne_of_modules[$module->activites[0]->evaluation_note_config_id] = self::to_sort($moyenne_of_modules[$module->activites[0]->evaluation_note_config_id], @round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef, $eleve->eleves_scolarite_id);
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
                                             // $moyenne_of_modules[$activite->evaluation_note_config_id] = self::to_sort($moyenne_of_modules[$activite->evaluation_note_config_id], round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef, $eleve->eleves_scolarite_id);
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

          $pdf->SetFillColor(255, 255, 255);
          $pdf->SetTextColor(51, 102, 153);
          $pdf->setY(50);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          if($data->settings_evaluation_code == "con")
          $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes du ".$data->evaluation_modele_name)),0,1,'C',1);
          else
          $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes de la ".$data->evaluation_modele_name)),0,1,'C',1);

          $pdf->SetFont('Arial','',10);

          $cols = [10,50,round(220/($nb+3),0)];
          // $pdf->SetFillColor(15, 37, 63);
          $h = 5;

          $pdf->SetFont('Arial','B',7);
          $pdf->SetTextColor(0, 0, 0);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0],16, utf8_decode("N°"),1 ,0,'C',1);
          $pdf->cell($cols[1],16, utf8_decode("Prénoms -  Nom"),1,0,'C',1);
          $cpt = 0;
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    $pdf->setY(65);
                    $pdf->setX(3);
                    $pdf->cell(65 + ($cols[2]*$cpt));
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         $pdf->cell($cols[2],16, substr(utf8_decode(@$module->evaluation_module_name), 0, 6).".",1,0,'C',1);
                    }else{
                         $pdf->cell($cols[2]*count($module->activites),8, substr(utf8_decode(@$module->evaluation_module_name), 0, 15).".",1,1,'C',1);
                         foreach($module->activites as $index => $activite) {
                              if($index == 0){
                                   $pdf->setY(73);
                                   $pdf->setX(3);
                                   $pdf->cell(65 + ($cols[2]*$cpt));
                              }
                              $pdf->cell($cols[2],8,substr(utf8_decode(@$activite->settings_activite_name), 0, 5).".",1,0,'C',1);
                         }
                    }
                    $cpt += count($module->activites);
               }
          }
          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(65 + ($cols[2]*$cpt));
          $pdf->cell($cols[2],16, utf8_decode("Rang"),1 ,0,'C',1);
          $pdf->cell($cols[2],16, utf8_decode("Total"),1 ,0,'C',1);
          $pdf->cell($cols[2],16, utf8_decode("Moyenne"),1,1,'C',1);

          $som_moy = 0;
          $moy_max = 0;
          $moy_min = 10;

          $pdf->SetFillColor(255, 255, 255);
          $h = 5;

          $pdf->SetFont('Arial','B',7);
          $pdf->SetTextColor(15, 37, 63);

          $indexer = 0;

          foreach($data->eleves as $i => $eleve) {
               if($indexer == 21){
                    $indexer = 0;
                    $pdf->AddPage('L');
                    $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');

                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);
                    $pdf->SetFont('Arial','',10);

                    $pdf->text(240, 40, utf8_decode('Année scolaire : '.@$data->settings_scolarite_code));
                    $pdf->text(240, 50, utf8_decode('Classe : '.@$data->eleves[0]->classe_name));


                    // $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
                    // $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));


                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetTextColor(51, 102, 153);
                    $pdf->setY(50);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->SetFont('Arial','B',15);
                    if($data->settings_evaluation_code == "con")
                    $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes du ".$data->evaluation_modele_name)),0,1,'C',1);
                    else
                    $pdf->cell(280, 9, strtoupper(utf8_decode("Relevé des notes de la ".$data->evaluation_modele_name)),0,1,'C',1);

                    $pdf->SetFont('Arial','',10);

                    $cols = [10,50,round(220/($nb+3),0)];
                    // $pdf->SetFillColor(15, 37, 63);
                    $h = 5;

                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->setY(65);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->cell($cols[0],16, utf8_decode("N°"),1 ,0,'C',1);
                    $pdf->cell($cols[1],16, utf8_decode("Prénoms -  Nom"),1,0,'C',1);
                    $cpt = 0;
                    foreach ($data->modules as $module) {
                         if(count($module->activites) != 0){
                              $pdf->setY(65);
                              $pdf->setX(3);
                              $pdf->cell(65 + ($cols[2]*$cpt));
                              if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                                   $pdf->cell($cols[2],16, substr(utf8_decode(@$module->evaluation_module_name), 0, 6).".",1,0,'C',1);
                              }else{
                                   $pdf->cell($cols[2]*count($module->activites),8, substr(utf8_decode(@$module->evaluation_module_name), 0, 15).".",1,1,'C',1);
                                   foreach($module->activites as $index => $activite) {
                                        if($index == 0){
                                             $pdf->setY(73);
                                             $pdf->setX(3);
                                             $pdf->cell(65 + ($cols[2]*$cpt));
                                        }
                                        $pdf->cell($cols[2],8,substr(utf8_decode(@$activite->settings_activite_name), 0, 5).".",1,0,'C',1);
                                   }
                              }
                              $cpt += count($module->activites);
                         }
                    }
                    $pdf->setY(65);
                    $pdf->setX(3);
                    $pdf->cell(65 + ($cols[2]*$cpt));
                    $pdf->cell($cols[2],16, utf8_decode("Rang"),1 ,0,'C',1);
                    $pdf->cell($cols[2],16, utf8_decode("Total"),1 ,0,'C',1);
                    $pdf->cell($cols[2],16, utf8_decode("Moyenne"),1,1,'C',1);

                    $som_moy = 0;
                    $moy_max = 0;
                    $moy_min = 10;

                    $pdf->SetFillColor(255, 255, 255);
                    $h = 5;

                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetTextColor(15, 37, 63);
               }

               $pdf->setX(3);
               $pdf->cell(5);

               $pdf->cell($cols[0],$h, $i+1,1,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode(@$eleve->personne_prenoms.' '.@$eleve->personne_nom),1,0,'L',1);

               $som_point = 0;
               $som_coef = 0;
               $som_note = 0;

               foreach($data->modules as $module) {
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         if(@$module->activites[0]->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                              $check = false;
                              foreach ($eleve->notes as $note) {
                                   if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
                                        $som_coef += $module->activites[0]->evaluation_note_config_coef;
                                        $mcc = @round(self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value / 2, 2);
                                        $som_point += @round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef;
                                        $moyenne_of_modules[$module->activites[0]->evaluation_note_config_id] = self::to_sort($moyenne_of_modules[$module->activites[0]->evaluation_note_config_id], @$note->evaluation_note_value, $eleve->eleves_scolarite_id);
                                        $som_note += @round((@$note->evaluation_note_value+$mcc)/2, 2);
                                        $pdf->cell($cols[2],$h, @$note->evaluation_note_value,1,0,'C',1);
                                        $check = true;
                                   }
                              }
                              if($check == false){
                                   $pdf->cell($cols[2],$h, "-",1,0,'C',1);
                              }
                         }
                    }else{
                         foreach($module->activites as $index => $activite) {
                              if(@$activite->evaluation_note_config_cont != 0 || $data->settings_evaluation_code != "con"){
                                   $check = false;
                                   foreach ($eleve->notes as $key => $note) {
                                        if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                                             $som_coef += @$activite->evaluation_note_config_coef;
                                             $mcc = @round(self::get_notes_cont(@$data->evaluation_trimestre_id, @$note->eleves_scolarite_id, @$note->evaluation_note_config_id)->evaluation_note_value / 2, 2);
                                             $som_point += @round((@$note->evaluation_note_value+$mcc)/2, 2) * @$note->evaluation_note_config_coef;
                                             $moyenne_of_modules[$activite->evaluation_note_config_id] = self::to_sort($moyenne_of_modules[$activite->evaluation_note_config_id], @$note->evaluation_note_value, $eleve->eleves_scolarite_id);
                                             $som_note += @round((@$note->evaluation_note_value+$mcc)/2, 2);
                                             $check = true;
                                             $pdf->cell($cols[2],$h, @$note->evaluation_note_value,1,0,'C',1);
                                        }
                                   }
                                   if($check == false){
                                        $pdf->cell($cols[2],$h, "-",1,0,'C',1);
                                   }
                              }
                         }
                    }
               }

               $indexer ++;

               $pdf->cell($cols[2],$h, @self::get_rank($moyenne_eleves, round($som_point/$som_coef, 2), 'moyenne'),1 ,0,'C',1);
               $pdf->cell($cols[2],$h, $som_note,1 ,0,'C',1);
               $pdf->cell($cols[2],$h, @round($som_point/$som_coef, 2),1,1,'C',1);

               $som_moy += @round($som_point/$som_coef, 2);

               if($moy_min > @round($som_point/$som_coef, 2)){
                    $moy_min = @round($som_point/$som_coef, 2);
               }
               if($moy_max < @round($som_point/$som_coef, 2)){
                    $moy_max = @round($som_point/$som_coef, 2);
               }
          }

          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0]+$cols[1],$h, utf8_decode("Plus forte moyenne"),1,0,'L',1);
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    foreach($module->activites as $index => $activite) {
                         $max = @$moyenne_of_modules[$activite->evaluation_note_config_id][0]['moyenne'];
                         foreach ($moyenne_of_modules[$activite->evaluation_note_config_id] as $value) {
                              if($value['moyenne']>$max){
                                   $max = $value['moyenne'];
                              }
                         }
                         $pdf->cell($cols[2],$h, utf8_decode($max),1 ,0,'C',1);
                    }
               }
          }
          $pdf->cell($cols[2]*3,$h, "",1 ,1,'C',1);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0]+$cols[1],$h, utf8_decode("Plus faible moyenne"),1,0,'L',1);
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    foreach($module->activites as $index => $activite) {
                         $min = @$moyenne_of_modules[$activite->evaluation_note_config_id][0]['moyenne'];
                         foreach ($moyenne_of_modules[$activite->evaluation_note_config_id] as $value) {
                              if($value['moyenne']<$max){
                                   $min = $value['moyenne'];
                              }
                         }
                         $pdf->cell($cols[2],$h, utf8_decode($min),1 ,0,'C',1);
                    }
               }
          }
          $pdf->cell($cols[2]*3,$h, "",1 ,1,'C',1);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0]+$cols[1],$h, utf8_decode("Moyenne de la classe"),1,0,'L',1);
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    foreach($module->activites as $index => $activite) {
                         $som = 0;
                         foreach ($moyenne_of_modules[$activite->evaluation_note_config_id] as $value) {
                              $som += $value['moyenne'];
                         }
                         $pdf->cell($cols[2],$h, utf8_decode(round($som/count($data->eleves), 2)),1 ,0,'C',1);
                    }
               }
          }
          $pdf->cell($cols[2]*3,$h, "",1 ,1,'C',1);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0]+$cols[1],$h, utf8_decode("Taux de réussite"),1,0,'L',1);
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    foreach($module->activites as $index => $activite) {
                         $som = 0;
                         foreach ($moyenne_of_modules[$activite->evaluation_note_config_id] as $value) {
                              if($value['moyenne']>=10){
                                   $som ++;
                              }
                         }
                         $pdf->cell($cols[2],$h, utf8_decode(round($som/count($data->eleves), 2)*100),1 ,0,'C',1);
                    }
               }
          }
          $pdf->cell($cols[2]*3,$h, "",1 ,1,'C',1);
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

}
