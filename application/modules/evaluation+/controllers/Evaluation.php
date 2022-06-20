<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Evaluation extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('evaluation_model');
          $this->load->model('classe/classe_model');
          $this->load->model('settings/settings_niveau_model');

          if($this->input->get("modele")){
               $_SESSION['scolarite']['modele_id'] = @$this->input->get("modele");
          }

          $this->set_data('title', 'Modèles de evaluation');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('cycles', $this->evaluation_model->get_all());

          add_js(null,'application/modules/evaluation/js/evaluation_script.js');

          $this->add_data('content', $this->load->view('evaluations/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showGrid(){
          $settings_niveau_id = (int)$this->uri->segment(4);
          $evaluation_modele_niveau_id = (int)$this->uri->segment(5);

          $this->set_data('classes', $this->evaluation_model->get_grid($settings_niveau_id, $evaluation_modele_niveau_id));
          $this->set_data('modules', $this->evaluation_model->get_modules($settings_niveau_id));
          $this->set_data('niveau',  $this->evaluation_model->get_modele_niveau($evaluation_modele_niveau_id));
          $this->set_data('evaluation_modele_niveau_id', $evaluation_modele_niveau_id);

          add_js(null,'application/modules/evaluation/js/evaluation_script.js');

          $this->add_data('content', $this->load->view('evaluations/grid', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit_modele()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->evaluation_model->get_one_modele($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("evaluation_modele_id", "settings_evaluation_id", "evaluation_modele_code", "evaluation_modele_name", "evaluation_modele_debut", "evaluation_modele_fin");

          echo json_encode($result);
     }

     // public function showEditModele()
     // {
     //      $id = (int)$this->uri->segment(4);
     //      $record = $this->evaluation_model->get_one_modele($id);
     //      $result = array();
     //      $result['record'] = $record;
     //      $result['header'] = array("evaluation_modele_id", "evaluation_modele_name", "evaluation_modele_desc");
     //
     //      echo json_encode($result);
     // }

     public function insert_trimestre()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->insert_trimestre()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le trimestre a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le trimestre n'a pas été enregistré !"
                    ));
               }
          }
          redirect('evaluation');
     }

     public function insert_modele()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->insert_modele()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'évaluation a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'évaluation n'a pas été enregistré !"
                    ));
               }
          }
          redirect('evaluation');
     }

     // public function insert_module()
     // {
     //      if(isPostBack())
     //      {
     //           if($this->evaluation_model->insert_module()){
     //
     //                set_notification(array(
     //                     'type'=>'success',
     //                     'message'=>"Le module a été enregistré !"
     //                ));
     //           }else{
     //                set_notification(array(
     //                     'type'=>'danger',
     //                     'message'=>"Le module n'a pas été enregistré !"
     //                ));
     //           }
     //      }
     //      redirect('evaluation');
     // }

     public function insert_config()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->insert_config()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La configuration a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La configuration n'a pas été enregistré !"
                    ));
               }
          }
          redirect('evaluation');
     }

     public function insert_dispense()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->insert_dispense()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La dispense a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La dispense n'a pas été enregistré !"
                    ));
               }
          }
          redirect('evaluation');
     }

     // public function insert_module_niveau()
     // {
     //      if(isPostBack())
     //      {
     //           if($this->evaluation_model->insert_module_niveau()){
     //
     //                set_notification(array(
     //                     'type'=>'success',
     //                     'message'=>"Le module a été enregistré !"
     //                ));
     //           }else{
     //                set_notification(array(
     //                     'type'=>'danger',
     //                     'message'=>"Le module n'a pas été enregistré !"
     //                ));
     //           }
     //      }
     //      redirect('evaluation');
     // }


     public function update()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été modifié !"
                    ));
               }
          }
          redirect('evaluation/showevaluation/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function update_modele()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->update_modele()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le modeles a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le modeles n'a pas été modifié !"
                    ));
               }
          }
          redirect('evaluation');
     }

     // public function update_module()
     // {
     //      if(isPostBack())
     //      {
     //           if($this->evaluation_model->update_module()){
     //                set_notification(array(
     //                     'type'=>'success',
     //                     'message'=>"Le module a été modifié !"
     //                ));
     //           }else{
     //                set_notification(array(
     //                     'type'=>'danger',
     //                     'message'=>"Le module n'a pas été modifié !"
     //                ));
     //           }
     //      }
     //      redirect('evaluation');
     // }

     // public function delete()
     // {
     //      if(isPostBack())
     //      {
     //           if($this->evaluation_model->delete()){
     //                set_notification(array(
     //                     'type'=>'success',
     //                     'message'=>"Le module a été supprimé !"
     //                ));
     //           }else{
     //                set_notification(array(
     //                     'type'=>'danger',
     //                     'message'=>"Le module n'a pas été supprimé !"
     //                ));
     //           }
     //      }
     //      redirect('evaluation');
     // }

     public function delete_modele()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->delete_modele()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le modele a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le modele n'a pas été supprimé !"
                    ));
               }
          }
          redirect('evaluation');
     }

     // public function delete_module_niveau()
     // {
     //      if(isPostBack())
     //      {
     //           if($this->evaluation_model->delete_module_niveau()){
     //                set_notification(array(
     //                     'type'=>'success',
     //                     'message'=>"Le module a été supprimé !"
     //                ));
     //           }else{
     //                set_notification(array(
     //                     'type'=>'danger',
     //                     'message'=>"Le module n'a pas été supprimé !"
     //                ));
     //           }
     //      }
     //      redirect('evaluation');
     // }

     public function delete_detail()
     {
          if(isPostBack())
          {
               if($this->evaluation_model->delete_detail()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le detail a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le detail n'a pas été supprimé !"
                    ));
               }
          }
          redirect('evaluation/showevaluation/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function delete_dispense()
     {
          $evaluation_dispense_id = (int)$this->uri->segment(4);

          if($this->evaluation_model->delete_dispense($evaluation_dispense_id)){
               set_notification(array(
                    'type'=>'success',
                    'message'=>"La dispense été supprimé !"
               ));
          }else{
               set_notification(array(
                    'type'=>'danger',
                    'message'=>"La dispense n'a pas été supprimé !"
               ));
          }

          redirect('evaluation');
     }

     // public function showBulletin(){
     //      $classe_id = (int)$this->uri->segment(4);
     //      $evaluation_modele_niveau_id = (int)$this->uri->segment(5);
     //
     //      $data = $this->evaluation_model->get_bulletin($classe_id, $evaluation_modele_niveau_id);
     //
     //      setlocale(LC_TIME, "fr_FR");
     //
     //      $this->load->library('pdf');
     //      $pdf = new PDF('P','mm','A4');
     //
     //      $som_moy = 0;
     //      $moy_max = 0;
     //      $moy_min = 0;
     //
     //      foreach ($data->eleves as $eleve) {
     //           $som_point = 0;
     //           $som_coef = 0;
     //           switch($data->settings_cycle_code) {
     //                case 'eleme':
     //                foreach($data->modules as $module) {
     //                     if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
     //                          $som_coef += $module->activites[0]->evaluation_note_config_coef;
     //                          foreach ($eleve->notes as $note) {
     //                               if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
     //                                    $som_point += @$note->evaluation_note_value * @$module->activites[0]->evaluation_note_config_coef;
     //                               }
     //                          }
     //                     }
     //                }
     //                $som_moy += @round($som_point/$som_coef, 2);
     //
     //                if($moy_min > @round($som_point/$som_coef, 2)){
     //                     $moy_min = @round($som_point/$som_coef, 2);
     //                }
     //                if($moy_max < @round($som_point/$som_coef, 2)){
     //                     $moy_max = @round($som_point/$som_coef, 2);
     //                }
     //                break;
     //           }
     //      }
     //
     //      foreach ($data->eleves as $eleve) {
     //           $som_point = 0;
     //           $som_coef = 0;
     //           $pdf->AddPage();
     //           $pageCount = $pdf->setSourceFile('temp/models/bulletin/bul_'.$data->settings_cycle_code.'.pdf');
     //           // $pageCount = $pdf->setSourceFile('temp/models/bulletin/bul_presco.pdf');
     //           $pageId = $pdf->importPage(1);
     //           $pdf->useTemplate($pageId, 0, 0);
     //
     //           switch($data->settings_cycle_code) {
     //                case 'eleme':
     //                $pdf->SetFont('Arial','',10);
     //
     //                $pdf->text(155, 40, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));
     //
     //                $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
     //                $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));
     //
     //
     //                $pdf->SetFillColor(255, 255, 255);
     //                $pdf->SetTextColor(51, 102, 153);
     //                $pdf->setY(60);
     //                $pdf->setX(3);
     //                $pdf->cell(5);
     //                $pdf->SetFont('Arial','B',15);
     //                $pdf->cell(195, 9, strtoupper(utf8_decode("tableau récapitulatif du ".$data->evaluation_modele_name)),0,1,'C',1);
     //
     //                $pdf->SetFont('Arial','',10);
     //
     //                $cols = [92.5,27.5,65];
     //                $pdf->SetFillColor(15, 37, 63);
     //                $h = 7;
     //
     //                $pdf->SetFont('Arial','B',10);
     //                $pdf->SetTextColor(255, 255, 255);
     //
     //                $pdf->setY(75);
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell($cols[0],10, utf8_decode("ACTIVITES"),1 ,0,'C',1);
     //                $pdf->cell($cols[1],10, utf8_decode("NOTES"),1,0,'C',1);
     //                $pdf->cell($cols[2],10, utf8_decode("APPRECIATIONS"),1,1,'C',1);
     //
     //                foreach ($data->modules as $module) {
     //                     $pdf->SetFont('Arial','',9);
     //                     $pdf->SetFillColor(255, 255, 255);
     //                     $pdf->SetTextColor(0, 0, 0);
     //
     //                     $pdf->setX(3);
     //                     $pdf->cell(10);
     //
     //                     if(count($module->activites) == 1 && $module->activites[0]->settings_activite_code == "non"){
     //                          $som_coef += $module->activites[0]->evaluation_note_config_coef;
     //
     //                          $pdf->cell($cols[0],$h, utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
     //                          $check = false;
     //                          foreach ($eleve->notes as $note) {
     //                               if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
     //                                    $som_point += @$note->evaluation_note_value * @$module->activites[0]->evaluation_note_config_coef;
     //                                    $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
     //                                    $pdf->cell($cols[2],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
     //                                    $check = true;
     //                               }
     //                          }
     //                          if($check == false){
     //                               $pdf->cell($cols[1],$h, "-",1,0,'C',1);
     //                               $pdf->cell($cols[2],$h, "-",1,1,'C',1);
     //                          }
     //                     }else{
     //                          $pdf->cell(67.5,($h*count($module->activites)), utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
     //                          foreach($module->activites as $index => $activite) {
     //                               $som_coef += $activite->evaluation_note_config_coef;
     //                               $check = false;
     //
     //                               foreach ($eleve->notes as $key => $note) {
     //                                    if($activite->evaluation_note_config_id == $note->evaluation_note_config_id){
     //                                         if($key != 0 && $index != 0)$pdf->cell(70.5);
     //                                         $som_point += @$note->evaluation_note_value * @$activite->evaluation_note_config_coef;
     //                                         $pdf->cell(25,$h, utf8_decode(@$activite->settings_activite_name),1,0,'L',1);
     //                                         $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
     //                                         $pdf->cell($cols[2],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
     //                                         $check = true;
     //                                    }
     //                               }
     //                               if($check == false){
     //                                    if($key != 0 && $index != 0)$pdf->cell(70.5);
     //                                    $pdf->cell(25,$h, utf8_decode(@$activite->settings_activite_name),1,0,'L',1);
     //                                    $pdf->cell($cols[1],$h, "-",1,0,'C',1);
     //                                    $pdf->cell($cols[2],$h, "-",1,1,'C',1);
     //                               }
     //                          }
     //                     }
     //                }
     //
     //                $h = 12;
     //
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell(92.5,$h, utf8_decode("TOTAL : ".@$som_point),1,0,'C',1);
     //                $pdf->cell(92.5,$h, utf8_decode("MOY : ".@round($som_point/$som_coef, 2)),1,1,'C',1);
     //
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell(92.5,$h, utf8_decode("MEILLEUR MOYENNE : ".@$moy_max),1,0,'C',1);
     //                $pdf->cell(92.5,$h, utf8_decode("PLUS FAIBLE MOYENNE : ".@$moy_min),1,1,'C',1);
     //
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell(185,$h, utf8_decode("MOYENNE DE LA CLASSE : ".@round($som_moy/count($data->eleves), 2)),1,1,'C',1);
     //
     //                break;
     //
     //                case 'moyen':
     //                $pdf->SetFillColor(255, 255, 255);
     //                $pdf->SetTextColor(51, 102, 153);
     //                $pdf->setY(55);
     //                $pdf->setX(3);
     //                $pdf->cell(5);
     //                $pdf->SetFont('Arial','B',15);
     //                $pdf->cell(195, 9, strtoupper(utf8_decode($data->evaluation_trimestre_name)),0,1,'C',1);
     //                $pdf->setX(3);
     //                $pdf->cell(5);
     //                $pdf->cell(195, 9, strtoupper(utf8_decode($data->evaluation_modele_name)),0,1,'C',1);
     //                $pdf->SetTextColor(0, 0, 0);
     //
     //                $pdf->SetFont('Arial','',10);
     //
     //                $pdf->text(25, 80, utf8_decode('Prénoms : '.@$eleve->personne_prenoms));
     //                $pdf->text(25, 85, utf8_decode('Né (e) le : '.mysql_to_date(@$eleve->naissance_date)));
     //                $pdf->text(25, 90, utf8_decode('Matricule : '.@$eleve->eleve_matricule));
     //
     //                $pdf->text(100, 80, utf8_decode('Nom : '.@$eleve->personne_nom));
     //                $pdf->text(100, 85, utf8_decode('à : '.@$eleve->naissance_lieu));
     //                $pdf->text(100, 90, utf8_decode("Nbre d'elèves : ".@count($data->eleves)));
     //
     //                $pdf->text(155, 85, utf8_decode('Classe : '.@$eleve->classe_name));
     //                $pdf->text(155, 90, utf8_decode('Classe redoublée : '.null));
     //
     //                $cols = [100,25,60];
     //                $pdf->SetFillColor(15, 37, 63);
     //                $h = 7;
     //
     //                $pdf->SetFont('Arial','B',10);
     //                $pdf->SetTextColor(255, 255, 255);
     //
     //                $pdf->setY(95);
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell($cols[0],$h, utf8_decode("DISCIPLINES"),1 ,0,'C',1);
     //                $pdf->cell($cols[1],$h, utf8_decode("NOTES"),1,0,'C',1);
     //                $pdf->cell($cols[2],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);
     //
     //                foreach ($data->modules as $module) {
     //                     $pdf->SetFont('Arial','',9);
     //                     $pdf->SetFillColor(255, 255, 255);
     //                     $pdf->SetTextColor(0, 0, 0);
     //
     //                     $pdf->setX(3);
     //                     $pdf->cell(10);
     //                     $pdf->cell($cols[0],$h, utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
     //                     $check = false;
     //                     foreach ($eleve->notes as $note) {
     //                          if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
     //                               $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
     //                               $pdf->cell($cols[2],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
     //                               $check = true;
     //                          }
     //                     }
     //                     if($check == false){
     //                          $pdf->cell($cols[1],$h, "",1,0,'L',1);
     //                          $pdf->cell($cols[2],$h, "",1,1,'L',1);
     //                     }
     //                }
     //                break;
     //
     //                default:
     //                $pdf->SetFont('Arial','',10);
     //
     //                $pdf->text(155, 40, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));
     //
     //                $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));
     //                $pdf->text(15, 55, utf8_decode('Prénoms Nom: '.@$eleve->personne_prenoms.' '.@$eleve->personne_nom));
     //
     //
     //                $pdf->SetFillColor(255, 255, 255);
     //                $pdf->SetTextColor(51, 102, 153);
     //                $pdf->setY(60);
     //                $pdf->setX(3);
     //                $pdf->cell(5);
     //                $pdf->SetFont('Arial','B',15);
     //                $pdf->cell(195, 9, strtoupper(utf8_decode("tableau récapitulatif du ".$data->evaluation_modele_name)),0,1,'C',1);
     //
     //                $pdf->SetFont('Arial','',10);
     //
     //                $cols = [100, 85];
     //                $pdf->SetFillColor(15, 37, 63);
     //                $h = 10;
     //
     //                $pdf->SetFont('Arial','B',10);
     //                $pdf->SetTextColor(255, 255, 255);
     //
     //                $pdf->setY(80);
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell($cols[0],$h, utf8_decode("ACTIVITES"),1 ,0,'C',1);
     //                $pdf->cell($cols[1],$h, utf8_decode("APPRECIATIONS"),1,1,'C',1);
     //
     //                foreach ($data->modules as $module) {
     //                     $h = 8;
     //
     //                     $pdf->SetFont('Arial','',9);
     //                     $pdf->SetFillColor(255, 255, 255);
     //                     $pdf->SetTextColor(0, 0, 0);
     //
     //                     $pdf->setX(3);
     //                     $pdf->cell(10);
     //                     $pdf->cell($cols[0],$h, utf8_decode(@$module->evaluation_module_name),1,0,'L',1);
     //                     $check = false;
     //                     foreach ($eleve->notes as $note) {
     //                          if($module->activites[0]->evaluation_note_config_id == $note->evaluation_note_config_id){
     //                               // $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_value),1,0,'C',1);
     //                               $pdf->cell($cols[1],$h, utf8_decode(@$note->evaluation_note_commentaire),1,1,'C',1);
     //                               $check = true;
     //                          }
     //                     }
     //                     if($check == false){
     //                          // $pdf->cell($cols[1],$h, "",1,0,'L',1);
     //                          $pdf->cell($cols[1],$h, "-",1,1,'C',1);
     //                     }
     //                }
     //                $pdf->setX(3);
     //                $pdf->cell(10);
     //                $pdf->cell($cols[0],$h, utf8_decode("Appréciation trimestrielle"),1,0,'L',1);
     //                $pdf->cell($cols[1],$h, utf8_decode(""),1,1,'C',1);
     //                break;
     //           }
     //
     //      }
     //
     //      $file_name = 'Bulletin.pdf';
     //
     //      $pdf->Output('I');
     //
     //      // header("location:".base_url($file_name));
     // }


}
?>
