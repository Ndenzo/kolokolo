<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classe extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          $this->load->model('classe_model');

          $this->set_data('title', 'Classes');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));

          $_SESSION['scolarite'] = array();
          $_SESSION['dashboard']['settings_scolarite_id'] = $_SESSION['dashboard']['settings_scolarite_id'];
     }

     public function index()
     {
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->set_data('cycles', $this->classe_model->get_all());
          $this->add_data('content', $this->load->view('classes/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showMove()
     {
          is_protected(array('root','admin','secretaire','surveillant'));
          $id = (int)$this->uri->segment(3);
          $record = $this->classe_model->get_scolarite_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("eleves_scolarite_id_".$record->classe_id, "personne_full_name_".$record->classe_id);

          echo json_encode($result);
     }

     public function showComposition()
     {
          is_protected(array('root','admin','secretaire','surveillant'));
          $id = (int)$this->uri->segment(3);
          $this->set_data('classe_id', $id);
          $this->set_data('enseignants', $this->classe_model->get_enseignant_classe($id));
          $this->set_data('eleves', $this->classe_model->get_eleves_classe($id));
          $this->add_data('content', $this->load->view('classes/composition', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProgramme()
     {
          is_protected(array('root','admin','secretaire','surveillant'));
          $id = (int)$this->uri->segment(3);

          add_js(null,'application/modules/scolarite/js/scolarite_script.js');

          $this->set_data('horaires', $this->classe_model->get_horaires($id));
          $this->set_data('opendays', $this->classe_model->get_opendays($id));
          $this->set_data('settings_jours', $this->classe_model->get_settings_jours($id));
          $this->set_data('jours', $this->classe_model->get_jours($id));
          $this->set_data('cours', $this->classe_model->get_cours($id));
          $this->set_data('classe', $this->classe_model->get_one($id));
          $this->set_data('matieres', $this->classe_model->get_classe_matieres($id));
          $this->add_data('content', $this->load->view('classes/programme', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          is_protected(array('root','admin','secretaire','surveillant'));
          $id = (int)$this->uri->segment(4);
          $record = $this->classe_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("classe_id", "settings_niveau_id", "classe_name");

          echo json_encode($result);

     }

     public function showCoursEdit()
     {
          is_protected(array('root','admin','secretaire','surveillant'));
          $id = (int)$this->uri->segment(4);
          $record = $this->classe_model->get_cours_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_jour_id", "enseignant_id", "cours_classe_heure_deb", "cours_classe_heure_fin", "cours_classe_id", "classes_matiere_id");

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
          redirect('classe');
     }

     public function move()
     {
          if(isPostBack())
          {
               if($this->classe_model->move()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La modification a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La modification n'a pas été enregistré !"
                    ));
               }
          }
          redirect('classe');
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
          redirect('classe');
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe/showProgramme/'.$id);
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
          redirect('classe');
     }

     public function showClasseList()
     {
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
               $pdf->cell($cols[1],$h, utf8_decode(@$eleve->personne_prenoms),1,0,'L',1);
               $pdf->cell($cols[2],$h, utf8_decode(@$eleve->personne_nom),1,0,'L',1);
               $pdf->cell($cols[3],$h, utf8_decode(@$eleve->personne_naissance_date.', '.@$eleve->personne_naissance_lieu),1,0,'L',1);
               $pdf->cell($cols[4],$h, @$eleve->personne_telephone_1,1,0,'C',1);
               $pdf->cell($cols[5],$h, utf8_decode(@$eleve->personne_adresse),1,1,'L',1);
          }

          $pdf->Output('I');

     }

     public function showClasseCalendar(){
          is_protected(array('root','admin','secretaire','surveillant','tuteur'));

          $id = (int)$this->uri->segment(4);
          $horaires = @$this->classe_model->get_horaires($id);
          $classe = $this->classe_model->get_one($id);
          $jours = $this->classe_model->get_jours($id);
          $cours = $this->classe_model->get_cours($id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage('L');
          $pageCount = $pdf->setSourceFile('temp/models/paysage.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $pdf->SetFont('Arial','B',11);
          $pdf->text(235, 41, utf8_decode('Date : '.gmdate('d/m/Y')));
          $pdf->text(235, 46, utf8_decode('Classe : '.@$classe->classe_name));

          // $pdf->text(155, 40, 'Date : '.gmdate('d/m/Y'));
          // $pdf->text(155, 45, 'Classe : '.@$classe->classe_name);
          // $pdf->text(155, 50, 'Nombre : '.@count($eleves));

          $cols = array();
          $width = round(280/(count($jours)+1),0);
          array_push($cols, $width);
          foreach ($jours as $key => $jour) {
               array_push($cols, $width);
          }

          $pdf->SetFillColor(255, 255, 255);
          $pdf->setY(37);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          $pdf->cell(100, 11, strtoupper(utf8_decode("Calendrier")),1,1,'C',1);


          // $pdf->SetFillColor(195, 235, 255);
          $pdf->SetTextColor(72, 49, 212);

          $pdf->setY(50);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',12);
          $h = 8;

          $pdf->cell($cols[0],$h, utf8_decode("Horaires"),1 ,0,'C',0);
          foreach ($jours as $key => $jour) {
               if ($key != (count($jours)-1)) {
                    $pdf->cell($cols[$key+1],$h, utf8_decode(@$jour->settings_jour_name),1 ,0,'C',0);
               }else {
                    $pdf->cell($cols[$key+1],$h, utf8_decode(@$jour->settings_jour_name),1 ,1,'C',1);
               }
          }

          $pdf->SetFillColor(255, 255, 255);
          $pdf->SetTextColor(234, 32, 135);
          $hor = end($horaires);

          $tmp = explode(":", @$hor->classes_horaire_heure_fin); $heure_fin = @$tmp[0]; $minute_fin = @$tmp[1];

          // ndebug($heure_fin);

          switch($heure_fin) {
               case "18":
               $h = 1;
               break;

               case "17":
               $h = 1.1;
               break;

               case "13":
               $h = 2.1;
               break;

               default:
               $h = 1.1;
               break;
          }

          $pdf->setY(58);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',7);
          if(is_array(@$horaires)){
               foreach ($horaires as $k => $horaire) {
                    $tmp = explode(":", $horaire->classes_horaire_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1];
                    $tmp = explode(":", $horaire->classes_horaire_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1];
                    $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->cell($cols[0],($h*$cpt), utf8_decode($heure_deb.":".$minute_deb." - ".$heure_fin.":".$minute_fin),1 ,1,'C',1);
               }
          }

          $x = 5;
          foreach ($jours as $j => $jour){

               $pdf->setY(58);
               $x += $cols[$j+1];
               foreach ($cours as $cour){
                    if($cour->settings_jour_id == $jour->settings_jour_id){
                         $pdf->setX(3);
                         $pdf->cell($x);

                         $tmp = explode(":", $cour->cours_classe_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1];
                         $tmp = explode(":", $cour->cours_classe_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1];
                         $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5);
                         if ($cour->settings_matiere_type_code == "pause"){
                              $pdf->SetFillColor(254, 250, 231);
                              $pdf->SetTextColor(234, 115, 23);
                         }else{
                              $pdf->SetFillColor(255, 255, 255);
                              $pdf->SetTextColor(44, 50, 63);
                         }
                         $pdf->cell($cols[0],($h*$cpt), utf8_decode($cour->settings_matiere_code),1 ,1,'C',1);
                    }
               }
          }

          $pdf->Output('I');

     }

     public function showCards($classe_id = null)
     {
          if($classe_id != null){
               $eleves = $this->classe_model->cards_get_classes($classe_id);
          }else{
               $eleves = $this->classe_model->cards_get_all();
          }

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/cards.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $pdf->SetFont('Arial','',6);

          $col_photo = [46, 116, 186];
          $col_name = [24, 94, 164];
          $col_naissance = [33, 103, 173];
          $col_adresse = [16, 86, 156];
          $col_telephone = [19, 89, 159];
          $col_classe = [15, 85, 155];
          $col_matricule = [18, 88, 158];
          $col_assurance = [21, 91, 161];

          $line_photo = [24.5, 123.6, 222.5];
          $line_name = [57.2, 156.2, 255];
          $line_naissance = [60, 159, 258];
          $line_adresse = [63, 162, 261];
          $line_telephone = [65.8, 164.8, 263.8];
          $line_classe = [68.6, 167.6, 266.6];
          $line_matricule = [71.6, 170.6, 269.6];
          $line_assurance = [74.5, 173.5, 272.5];

          $key = 0;

          while($key < count($eleves)) {
               $cpt = 0;
               for($i=0; $i<3; $i++){
                    for($j=0; $j<3; $j++){

                         if(@$eleves[$key]->personne_photo != null){
                              $link = base_url($eleves[$key]->personne_photo);
                              $tmp = explode(".", $eleves[$key]->personne_photo);
                              $extension = strtoupper($tmp[2]);
                         }else{
                              $link = base_url('/assets/custom/img/default/boy.png');
                              $extension = "PNG";
                         }

                         $pdf->Image($link, $col_photo[$i], $line_photo[$j], 20, 20, $extension);
                         $pdf->text($col_name[$i], $line_name[$j], utf8_decode(@$eleves[$key]->personne_prenoms." ".@$eleves[$key]->personne_nom));
                         $pdf->text($col_naissance[$i], $line_naissance[$j], utf8_decode(@$eleves[$key]->personne_naissance_date.", ".@$eleves[$key]->personne_naissance_lieu));
                         $pdf->text($col_adresse[$i], $line_adresse[$j], utf8_decode(@$eleves[$key]->personne_adresse));
                         $pdf->text($col_telephone[$i], $line_telephone[$j], utf8_decode(@$eleves[$key]->personne_telephone_1));
                         $pdf->text($col_classe[$i], $line_classe[$j], utf8_decode(@$eleves[$key]->classe_name));
                         $pdf->text($col_matricule[$i], $line_matricule[$j], utf8_decode(@$eleves[$key]->eleve_matricule));
                         $pdf->text($col_assurance[$i], $line_assurance[$j], utf8_decode(""));
                         $key++;
                    }
               }
               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/cards.pdf');
               $pageId = $pdf->importPage(2);
               $pdf->useTemplate($pageId, 0, 0);

               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/cards.pdf');
               $pageId = $pdf->importPage(1);
               $pdf->useTemplate($pageId, 0, 0);
          }

          $pdf->Output('I');
     }
}
?>
