<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classe extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('classe_model');

          $this->set_data('title', 'Gestion des classes');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));

          $_SESSION['scolarite'] = array();
          $_SESSION['dashboard']['settings_scolarite_id'] = $_SESSION['dashboard']['settings_scolarite_id'];
     }

     public function index()
     {
          $this->set_data('cycles', $this->classe_model->get_all());
          $this->add_data('content', $this->load->view('classes/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showSpliter()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('settings_niveau_id', $id);
          $this->add_data('content', $this->load->view('classes/dragula', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showComposition()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('classe_id', $id);
          $this->set_data('enseignants', $this->classe_model->get_enseignant_classe($id));
          $this->set_data('eleves', $this->classe_model->get_eleves_classe($id));
          $this->add_data('content', $this->load->view('classes/composition', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProgramme()
     {
          $id = (int)$this->uri->segment(4);

          add_js(null,'application/modules/scolarite/js/scolarite_script.js');

          $this->set_data('horaires', $this->classe_model->get_horaires($id));
          $this->set_data('opendays', $this->classe_model->get_opendays($id));
          $this->set_data('jours', $this->classe_model->get_jours($id));
          $this->set_data('cours', $this->classe_model->get_cours($id));
          $this->set_data('classe', $this->classe_model->get_one($id));
          $this->set_data('matieres', $this->classe_model->get_classe_matieres($id));
          $this->add_data('content', $this->load->view('classes/programme', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showClasseList(){
          $id = (int)$this->uri->segment(4);
          $eleves = $this->classe_model->get_eleves_classe_by_name($id);
          $classe = $this->classe_model->get_one($id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/standard.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $pdf->SetFont('Arial','B',11);
          $pdf->text(155, 40, 'Date : '.gmdate('d/m/Y'));
          $pdf->text(155, 45, 'Classe : '.@$classe->classe_name);
          $pdf->text(155, 50, 'Nombre : '.@count($eleves));


          $pdf->SetFillColor(255, 255, 255);
          $pdf->setY(55);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          $pdf->cell(195, 11, strtoupper(utf8_decode("Liste d'appel")),1,1,'C',1);

          $cols = [20,45,25,40,25,40];
          $pdf->SetFillColor(15, 37, 63);
          $h = 9;

          $pdf->SetFont('Arial','B',6.5);
          $pdf->SetTextColor(255, 255, 255);

          $pdf->setY(70);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0],$h, utf8_decode("Matricule"),1 ,0,'C',1);
          $pdf->cell($cols[1],$h, utf8_decode("Prénoms"),1,0,'C',1);
          $pdf->cell($cols[2],$h, utf8_decode("Noms"),1,0,'C',1);
          $pdf->cell($cols[3],$h, utf8_decode("Date et lieu de naissance"),1,0,'C',1);
          $pdf->cell($cols[4],$h, utf8_decode("Portable"),1,0,'C',1);
          $pdf->cell($cols[5],$h, utf8_decode("Adresse"),1,1,'C',1);

          foreach ($eleves as $key=>$eleve) {
               if($key==28){
                    $pdf->AddPage();
                    $pageCount = $pdf->setSourceFile('temp/models/standard.pdf');
                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);

                    $pdf->SetFont('Arial','B',11);
                    $pdf->text(155, 40, 'Date : '.gmdate('d/m/Y'));
                    $pdf->text(155, 45, 'Classe : '.@$classe->classe_name);
                    $pdf->text(155, 50, 'Nombre : '.@count($eleves));


                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->setY(55);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->SetFont('Arial','B',15);
                    $pdf->cell(195, 11, strtoupper(utf8_decode("Liste d'appel suite")),1,1,'C',1);

                    $cols = [20,45,25,40,25,40];
                    $pdf->SetFillColor(15, 37, 63);
                    $h = 9;

                    $pdf->SetFont('Arial','B',6.5);
                    $pdf->SetTextColor(255, 255, 255);

                    $pdf->setY(70);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->cell($cols[0],$h, utf8_decode("Matricule"),1 ,0,'C',1);
                    $pdf->cell($cols[1],$h, utf8_decode("Prénoms"),1,0,'C',1);
                    $pdf->cell($cols[2],$h, utf8_decode("Noms"),1,0,'C',1);
                    $pdf->cell($cols[3],$h, utf8_decode("Date et lieu de naissance"),1,0,'C',1);
                    $pdf->cell($cols[4],$h, utf8_decode("Portable"),1,0,'C',1);
                    $pdf->cell($cols[5],$h, utf8_decode("Adresse"),1,1,'C',1);

               }
               $cols = [20,45,25,40,25,40];
               $pdf->SetFillColor(255, 255, 255);
               $h = 7;

               $pdf->SetFont('Arial','B',6.5);
               $pdf->SetTextColor(0, 0, 0);

               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->cell($cols[0],$h, @$eleve->eleve_matricule,1,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode(@$eleve->prenoms),1,0,'L',1);
               $pdf->cell($cols[2],$h, utf8_decode(@$eleve->nom),1,0,'L',1);
               $pdf->cell($cols[3],$h, utf8_decode(@$eleve->naissance_date.', '.@$eleve->naissance_lieu),1,0,'L',1);
               $pdf->cell($cols[4],$h, @$eleve->telephone_1,1,0,'C',1);
               $pdf->cell($cols[5],$h, utf8_decode(@$eleve->adresse),1,1,'L',1);
          }

          $pdf->Output('I');

     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->classe_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("classe_id", "settings_niveau_id", "classe_name");

          echo json_encode($result);

     }

     public function showCoursEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->classe_model->get_cours_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_jour_id", "enseignant_id", "cours_classe_heure_deb", "cours_classe_heure_fin", "cours_classe_id");

          echo json_encode($result);

     }

     // Classes ---------------------------------------------------------------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->classe_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La classe a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La classe n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/classe');
     }


     public function update()
     {
          if(isPostBack())
          {
               if($this->classe_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La classe a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La classe n'a pas été modifié !"
                    ));
               }
          }
          redirect('/scolarite/classe');
     }

     // Matieres ---------------------------------------------------------------------------------------------------------------

     public function insert_matiere()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->insert_matiere()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La matière a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La matière n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     public function update_matiere()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->update_matiere()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La matière a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La matière n'a pas été modifié !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }


     public function delete_matiere()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->delete_matiere()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La matière a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La matière n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     // Horaires ---------------------------------------------------------------------------------------------------------------

     public function insert_horaire()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->insert_horaire()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'horaire a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'horaire' n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     public function delete_horaire()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->delete_horaire()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'horaire a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'horaire n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     // Cours ---------------------------------------------------------------------------------------------------------------

     public function insert_cours()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->insert_cours()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le cours a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le cours n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     public function update_cours()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->update_cours()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le cours a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le cours n'a pas été modifié !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }


     public function delete_cours()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->delete_cours()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le cours a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le cours n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     // Days ---------------------------------------------------------------------------------------------------------------


     public function insert_days()
     {
          if(isPostBack())
          {
               $id = $this->input->post("classe_id");
               if($this->classe_model->insert_days()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Les jours ouvrables ont été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Les jours ouvrables n'ont pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/classe/showProgramme/'.$id);
     }

     // Spliters ---------------------------------------------------------------------------------------------------------------

     public function classe_spliter()
     {
          $id = (int)$this->uri->segment(4);

          if($this->classe_model->classe_spliter($id)){

               set_notification(array(
                    'type'=>'success',
                    'message'=>"Les élèves ont été réparti !"
               ));
          }else{
               set_notification(array(
                    'type'=>'danger',
                    'message'=>"Les élèves ont été réparti !"
               ));
          }
          redirect('/scolarite/classe');
     }
}
?>
