<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statistique extends IBEMS_Controller{

     public function __construct(){
          parent::__construct();
          $this->load->model('evaluation_model');
     }

     public function showStatistique(){
          $classe_id = (int)$this->uri->segment(4);
          $evaluation_modele_niveau_id = (int)$this->uri->segment(5);

          $data = $this->evaluation_model->get_bulletin($classe_id, $evaluation_modele_niveau_id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');

          switch($data->settings_cycle_code) {
               case 'presco':
               self::showStatistique_prescolaire($pdf, $data);
               break;
               case 'eleme':
               self::showStatistique_elementaire($pdf, $data);
               break;
               case 'moyen':
               self::showStatistique_moyen($pdf, $data);
               break;

               default:
               redirect("help");
               break;
          }

          $file_name = 'Statistique.pdf';

          $pdf->Output('I');
     }

     public function showStatistique_elementaire($pdf, $data){

          $notations = ['00 à 2.99', '03 à 4.99', '05 à 6.99', '07 à 7.99', '08 à 9', '09.01 à 10'];
          $appreciations = ['Pas réussi', 'Pas réussi', 'Pas réussi', 'Assez Bien', 'Bien', 'Très bien'];

          $pdf->AddPage('L');
          $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');

          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);
          $pdf->SetFont('Arial','',10);

          $pdf->text(240, 40, utf8_decode('Année scolaire : '.@$data->settings_scolarite_code));
          $pdf->text(240, 45, utf8_decode('Classe : '.@$data->eleves[0]->classe_name));
          $pdf->text(240, 50, utf8_decode('Effectif : '.count(@$data->eleves)));

          $pdf->SetFillColor(255, 255, 255);
          $pdf->SetTextColor(51, 102, 153);
          $pdf->setY(50);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          if($data->settings_evaluation_code == "con")
          $pdf->cell(280, 9, strtoupper(utf8_decode("Statistique du ".$data->evaluation_modele_name)),0,1,'C',1);
          else
          $pdf->cell(280, 9, strtoupper(utf8_decode("Statistique de la ".$data->evaluation_modele_name)),0,1,'C',1);


          $pdf->SetFont('Arial','',10);

          $cols = [28,50,0];
          $h = 6;

          $pdf->SetFont('Arial','B',7);
          $pdf->SetTextColor(0, 0, 0);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0], $h*3, utf8_decode("Matières"),1 ,0,'C',1);

          $pdf->cell($cols[0], $h, utf8_decode("Notes"),'TRL',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(5 + $cols[0]);
          $pdf->cell($cols[0], $h, utf8_decode("Appreciations"),'RL',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(5 + $cols[0]);
          $pdf->cell($cols[0], $h, utf8_decode("Valeurs"),'BRL',1,'C',1);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+5);
          foreach ($notations as $notation) {
               if($notation != end($notations))
               $pdf->cell($cols[0], $h, utf8_decode($notation),1,0,'C',1);
               else
               $pdf->cell($cols[0], $h, utf8_decode($notation),1,1,'C',1);
          }
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+5);
          foreach ($appreciations as $appreciation) {
               if($appreciation != end($appreciations))
               $pdf->cell($cols[0], $h, utf8_decode($appreciation),1,0,'C',1);
               else
               $pdf->cell($cols[0], $h, utf8_decode($appreciation),1,1,'C',1);
          }
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+5);
          foreach ($appreciations as $appreciation) {
               $pdf->cell($cols[0]/2, $h, utf8_decode("VA "),1,0,'C',1);
               $pdf->cell($cols[0]/2, $h, utf8_decode("VR"),1,0,'C',1);
          }
          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+5+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h*2, utf8_decode("Moyenne classe"),'TLR' ,1,'C',1);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+5+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h, utf8_decode("Valeur absolue"),1 ,0,'C',1);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*3)+5+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h, utf8_decode("Ont Moyenne"),'TLR',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*3)+5+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h,utf8_decode(">="),'LR',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*3)+5+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h, utf8_decode("Moyenne classe"),'BRL',1,'C',1);

          $cpt = 0;
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    $pdf->setX(3);
                    $pdf->cell(5);
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         $pdf->cell($cols[0]*2,$h, substr(utf8_decode(@$module->evaluation_module_name), 0, 6).".",1,0,'C',1);
                         foreach ($notations as $c => $notation) {
                              $pdf->setX(3);
                              $pdf->cell(($cols[0]*2)+5+($c*$cols[0]));
                              $valeurs = @self::get_stats($data->eleves, $module->activites[0], $notation);
                              $pdf->cell($cols[0]/2,$h,$valeurs['va'],1,0,'C',1);
                              $pdf->cell($cols[0]/2,$h,$valeurs['vr'],1,0,'C',1);
                         }
                         $moyenne = @self::get_moys($data->eleves, $module->activites[0]);
                         $pdf->cell($cols[0],$h, $moyenne['moy_note'],1,0,'C',1);
                         $pdf->cell($cols[0],$h, $moyenne['cpt_moy'],1,1,'C',1);
                    }else{
                         $pdf->cell($cols[0],$h*count($module->activites), substr(utf8_decode(@$module->evaluation_module_name), 0, 15).".",1,0,'C',1);
                         foreach($module->activites as $index => $activite) {
                              $pdf->setX(3);
                              $pdf->cell(5 + $cols[0]);
                              $pdf->cell($cols[0],$h,substr(utf8_decode(@$activite->settings_activite_name), 0, 5).".",1,0,'C',1);
                              foreach ($notations as $c => $notation) {
                                   $pdf->setX(3);
                                   $pdf->cell(($cols[0]*2)+5+($c*$cols[0]));
                                   $valeurs = @self::get_stats($data->eleves, $activite, $notation);
                                   $pdf->cell($cols[0]/2,$h,$valeurs['va'],1,0,'C',1);
                                   $pdf->cell($cols[0]/2,$h,$valeurs['vr'],1,0,'C',1);
                              }
                              $moyenne = @self::get_moys($data->eleves, $activite);
                              $pdf->cell($cols[0],$h,$moyenne['moy_note'],1,0,'C',1);
                              $pdf->cell($cols[0],$h,$moyenne['cpt_moy'],1,1,'C',1);
                         }
                    }
                    $cpt += count($module->activites);
               }
          }
     }

     public function showStatistique_moyen($pdf, $data){

          $notations = ['00 à 4.99', '05 à 7.99', '08 à 8.99', '09 à 11.99', '12 à 13.99', '14 à 15.99', '16 à 17.99', '18 à 19.99', '20'];
          $appreciations = ['Très Faible', 'Blame', 'Avertissement', 'Passable', 'Assez bien', 'Bien', 'Très bien', 'Excellent', 'Honorable'];

          $pdf->AddPage('L');
          $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');

          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);
          $pdf->SetFont('Arial','',10);

          $pdf->text(240, 40, utf8_decode('Année scolaire : '.@$data->settings_scolarite_code));
          $pdf->text(240, 45, utf8_decode('Classe : '.@$data->eleves[0]->classe_name));
          $pdf->text(240, 50, utf8_decode('Effectif : '.count(@$data->eleves)));

          $pdf->SetFillColor(255, 255, 255);
          $pdf->SetTextColor(51, 102, 153);
          $pdf->setY(50);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          if($data->settings_evaluation_code == "con")
          $pdf->cell(280, 9, strtoupper(utf8_decode("Statistique du ".$data->evaluation_modele_name)),0,1,'C',1);
          else
          $pdf->cell(280, 9, strtoupper(utf8_decode("Statistique de la ".$data->evaluation_modele_name)),0,1,'C',1);


          $pdf->SetFont('Arial','',10);

          $cols = [22,50,0];
          $h = 6;

          $pdf->SetFont('Arial','B',7);
          $pdf->SetTextColor(0, 0, 0);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(2);
          $pdf->cell($cols[0], $h*3, utf8_decode("Matières"),1 ,0,'C',1);

          $pdf->cell($cols[0], $h, utf8_decode("Notes"),'TRL',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(2 + $cols[0]);
          $pdf->cell($cols[0], $h, utf8_decode("Appreciations"),'RL',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(2 + $cols[0]);
          $pdf->cell($cols[0], $h, utf8_decode("Valeurs"),'BRL',1,'C',1);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+2);
          foreach ($notations as $notation) {
               if($notation != end($notations))
               $pdf->cell($cols[0], $h, utf8_decode($notation),1,0,'C',1);
               else
               $pdf->cell($cols[0], $h, utf8_decode($notation),1,1,'C',1);
          }
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+2);
          foreach ($appreciations as $appreciation) {
               if($appreciation != end($appreciations))
               $pdf->cell($cols[0], $h, utf8_decode($appreciation),1,0,'C',1);
               else
               $pdf->cell($cols[0], $h, utf8_decode($appreciation),1,1,'C',1);
          }
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+2);
          foreach ($appreciations as $appreciation) {
               $pdf->cell($cols[0]/2, $h, utf8_decode("VA "),1,0,'C',1);
               $pdf->cell($cols[0]/2, $h, utf8_decode("VR"),1,0,'C',1);
          }
          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+2+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h*2, utf8_decode("Moyenne classe"),'TLR' ,1,'C',1);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*2)+2+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h, utf8_decode("Valeur absolue"),1 ,0,'C',1);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*3)+2+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h, utf8_decode("Ont Moyenne"),'TLR',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*3)+2+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h,utf8_decode(">="),'LR',1,'C',1);
          $pdf->setX(3);
          $pdf->cell(($cols[0]*3)+2+(count($appreciations)*$cols[0]));
          $pdf->cell($cols[0], $h, utf8_decode("Moyenne classe"),'BRL',1,'C',1);

          $cpt = 0;
          foreach ($data->modules as $module) {
               if(count($module->activites) != 0){
                    $pdf->setX(3);
                    $pdf->cell(2);
                    if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
                         $pdf->cell($cols[0]*2,$h, substr(utf8_decode(@$module->evaluation_module_name), 0, 6).".",1,0,'C',1);
                         foreach ($notations as $c => $notation) {
                              $pdf->setX(3);
                              $pdf->cell(($cols[0]*2)+2+($c*$cols[0]));
                              $valeurs = @self::get_stats($data->eleves, $module->activites[0], $notation);
                              $pdf->cell($cols[0]/2,$h,$valeurs['va'],1,0,'C',1);
                              $pdf->cell($cols[0]/2,$h,$valeurs['vr'],1,0,'C',1);
                         }
                         $moyenne = @self::get_moys($data->eleves, $module->activites[0]);
                         $pdf->cell($cols[0],$h, $moyenne['moy_note'],1,0,'C',1);
                         $pdf->cell($cols[0],$h, $moyenne['cpt_moy'],1,1,'C',1);
                    }else{
                         $pdf->cell($cols[0],$h*count($module->activites), substr(utf8_decode(@$module->evaluation_module_name), 0, 15).".",1,0,'C',1);
                         foreach($module->activites as $index => $activite) {
                              $pdf->setX(3);
                              $pdf->cell(2 + $cols[0]);
                              $pdf->cell($cols[0],$h,substr(utf8_decode(@$activite->settings_activite_name), 0, 5).".",1,0,'C',1);
                              foreach ($notations as $c => $notation) {
                                   $pdf->setX(3);
                                   $pdf->cell(($cols[0]*2)+2+($c*$cols[0]));
                                   $valeurs = @self::get_stats($data->eleves, $activite, $notation);
                                   $pdf->cell($cols[0]/2,$h,$valeurs['va'],1,0,'C',1);
                                   $pdf->cell($cols[0]/2,$h,$valeurs['vr'],1,0,'C',1);
                              }
                              $moyenne = @self::get_moys($data->eleves, $activite);
                              $pdf->cell($cols[0],$h,$moyenne['moy_note'],1,0,'C',1);
                              $pdf->cell($cols[0],$h,$moyenne['cpt_moy'],1,1,'C',1);
                         }
                    }
                    $cpt += count($module->activites);
               }
          }
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

     public function get_stats($eleves, $activite, $notation){
          $result['va'] = 0;
          $limit = explode(" à ", $notation);

          foreach ($eleves as $key => $eleve) {
               foreach ($eleve->notes as $note) {
                    if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                         if(count($limit) != 1){
                              if((float)$limit[0] <= (float)$note->evaluation_note_value && (float)$note->evaluation_note_value <= (float)$limit[1]){
                                   $result['va'] ++;
                              }
                         }else{
                              if((float)$limit[0] == (float)$note->evaluation_note_value){
                                   $result['va'] ++;
                              }
                         }
                    }
               }
          }
          $result['vr'] = round($result['va']/count($eleves)*100, 2);
          return $result;
     }

     public function get_moys($eleves, $activite){
          $result['som_note'] = 0;
          $result['cpt_moy'] = 0;

          foreach ($eleves as $key => $eleve) {
               foreach ($eleve->notes as $note) {
                    if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                         $result['som_note'] += (float)$note->evaluation_note_value;
                    }
               }
          }

          $result['moy_note'] = round($result['som_note']/count($eleves), 2);

          foreach ($eleves as $key => $eleve) {
               foreach ($eleve->notes as $note) {
                    if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
                         if($result['moy_note'] <= (float)$note->evaluation_note_value){
                              $result['cpt_moy'] ++;
                         }
                    }
               }
          }

          return $result;
     }

}
