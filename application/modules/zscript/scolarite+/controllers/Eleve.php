<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eleve extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('eleve_model');

          $this->set_data('title', 'Gestion des Elèves inscrits');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('datagrid', $this->eleve_model->get_all());
          $this->add_data('content', $this->load->view('eleves/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showCustom()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->eleve_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("eleves_scolarite_id", "nom_complet");

          echo json_encode($result);
     }

     public function showCards(){
          if(isPostBack()){
               $eleves = $this->eleve_model->cards_get_classes($this->input->post('classe_id'));
          }else{
               $eleves = $this->eleve_model->cards_get_all();
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

                         if(@$eleves[$key]->photo != null){
                              $link = base_url($eleves[$key]->photo);
                              $tmp = explode(".", $eleves[$key]->photo);
                              $extension = strtoupper($tmp[2]);
                         }else{
                              $link = base_url('/assets/back/images/users/user-3.jpg');
                              $extension = "JPG";
                         }

                         $pdf->Image($link, $col_photo[$i], $line_photo[$j], 20, 20, $extension);
                         $pdf->text($col_name[$i], $line_name[$j], utf8_decode(@$eleves[$key]->prenoms." ".@$eleves[$key]->nom));
                         $pdf->text($col_naissance[$i], $line_naissance[$j], utf8_decode(@$eleves[$key]->naissance_date.", ".@$eleves[$key]->naissance_lieu));
                         $pdf->text($col_adresse[$i], $line_adresse[$j], utf8_decode(@$eleves[$key]->adresse));
                         $pdf->text($col_telephone[$i], $line_telephone[$j], utf8_decode(@$eleves[$key]->telephone_1));
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


          // if(!is_dir('dossiers/decaissements')){
          //      mkdir('dossiers/decaissements', 0777, true);
          // }
          //
          // $file_name = 'dossiers/cartes/identity_cards.pdf';
          //
          // $pdf->Output('F',$file_name,true);
          //
          // header("location:".base_url($file_name));
     }

     public function insert_reduction()
     {
          if(isPostBack())
          {
               if($this->eleve_model->insert_reduction()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La réduction a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La réduction n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/eleve');
     }

     public function delete_reduction()
     {
          if(isPostBack())
          {
               if($this->eleve_model->delete_reduction()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La réduction a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La réduction n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/eleve');
     }

}
?>
