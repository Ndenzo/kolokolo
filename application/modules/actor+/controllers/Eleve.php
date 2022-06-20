<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eleve extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('eleve_model');
          $this->load->model('scolarite/tarification_model');
          $this->set_data('title', 'Elèves');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          add_js(null,'application/modules/actor/js/acteur_script.js');

          $this->set_data('datagrid', $this->eleve_model->get_all());
          $this->add_data('content', $this->load->view('eleves/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function cropper()
     {
          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');

          add_js(null,'application/modules/actor/js/cropper_script.js');

          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');
          add_js(null,'assets/custom/plugins/cropper/js/jquery-cropper.js');
          add_js(null,'assets/custom/plugins/cropper/js/main.js');

          $id = (int)$this->uri->segment(4);
          $this->set_data('eleve', $this->eleve_model->get_one($id));
          $this->set_data('datagrid', $this->eleve_model->get_all());
          $this->add_data('content', $this->load->view('eleves/cropper', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEleve()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('eleve', $this->eleve_model->get_one($id));

          add_js(null,'application/modules/actor/js/acteur_script.js');

          $this->add_data('content', $this->load->view('eleves/profile', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showReinscription()
     {
          $this->set_data('title', 'Réinscrire un éléve');

          add_js(null,'application/modules/actor/js/acteur_script.js');
          $this->add_data('content', $this->load->view('eleves/reinscription', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEditScolarite()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->eleve_model->get_one_scolarite($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_scolarite_id", "eleves_scolarite_id");

          echo json_encode($result);

     }

     public function showCustom()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->eleve_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("eleve_personne_id", "tuteur_personne_id", "eleve_id", "personne_photo", "personne_prenoms", "personne_nom", "personne_adresse", "eleve_matricule", "personne_telephone_1",
          "personne_telephone_2", "personne_ville", "personne_genre", "settings_niveau_id", "personne_naissance_date", "personne_naissance_lieu", "eleve_date_deb", "eleve_desc", "eleve_origine", "prenoms_tuteur", "nom_tuteur",
          "renseignement_prenoms_pere", "renseignement_nom_pere", "renseignement_prenoms_mere", "renseignement_nom_mere", "renseignement_comp_ind", "renseignement_comp_group",
          "renseignement_maladie", "renseignement_acuite_auditive", "renseignement_acuite_visuelle", "renseignement_repercussion", "renseignement_repercussion_certaine",
          "renseignement_interruption", "renseignement_physique", "renseignement_effort", "renseignement_motricite");

          echo json_encode($result);
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->eleve_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élève a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élève n'a pas été enregistré !"
                    ));
               }
          }
          // redirect('actor/eleve');
     }

     public function insert_renew()
     {
          if(isPostBack())
          {
               if($this->eleve_model->insert_renew()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élève a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élève n'a pas été enregistré !"
                    ));
               }
          }
          // redirect('actor/eleve');
     }

     public function insert_image()
     {
          $eleve_id = $this->input->post('eleve_id');

          if(isPostBack())
          {
               if($this->eleve_model->insert_image($this->input->post('personne_id'))){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La photo a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La photo n'a pas été enregistré !"
                    ));
               }
          }

          redirect('actor/eleve/cropper/'.$eleve_id);
     }

     public function insert_comment()
     {
          $eleve_id = $this->input->post('eleve_id');

          if(isPostBack())
          {
               if($this->eleve_model->insert_comment()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le commentaire a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le commentaire n'a pas été enregistré !"
                    ));
               }
          }

          redirect('actor/eleve/showEleve/'.$eleve_id);
     }

     public function insert_mutation()
     {
          $eleve_id = $this->input->post('eleve_id');

          if(isPostBack())
          {
               if($this->eleve_model->insert_mutation()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La mutation a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La mutation n'a pas été enregistré !"
                    ));
               }
          }

          redirect('actor/eleve/showEleve/'.$eleve_id);
     }

     public function update_scolarite()
     {
          if(isPostBack())
          {
               if($this->eleve_model->update_scolarite()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élève a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élève n'a pas été modifié !"
                    ));
               }
          }
          redirect('actor/eleve');
     }

     public function init_scolarite()
     {
          if(isPostBack())
          {
               if($this->eleve_model->init_scolarite()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élève a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élève n'a pas été modifié !"
                    ));
               }
          }
          redirect('actor/eleve');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->eleve_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élève a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élève n'a pas été modifié !"
                    ));
               }
          }
          redirect('actor/eleve');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->eleve_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élève a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élève n'a pas été supprimé !"
                    ));
               }
          }
          redirect('actor/eleve');
     }

     public function insert_reduction()
     {
          if(isPostBack())
          {
               $eleve_id = $this->input->post('eleve_id');

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

          redirect('actor/eleve');
     }

     public function delete_reduction()
     {
          if(isPostBack())
          {
               $eleve_id = $this->input->post('eleve_id');

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

          redirect('actor/eleve');
     }

     public function showCertificat()
     {
          $id = (int)$this->uri->segment(4);
          $eleve = $this->eleve_model->get_one($id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');

          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/certificat.pdf');

          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          //Top part
          $pdf->SetFont('Arial','',9.5);
          $pdf->text(177, 47, utf8_decode("C-".@$eleve->eleve_matricule));

          $pdf->SetFont('Arial','',12);
          $pdf->text(55, 68, utf8_decode(@$eleve->prenoms.' '.@$eleve->nom));
          $pdf->text(160, 68, utf8_decode(mysql_to_date(@$eleve->naissance_date)));
          $pdf->text(15, 75, utf8_decode(@$eleve->naissance_lieu));

          $pdf->text(105, 75, utf8_decode(@$eleve->renseignement_prenoms_pere.' '.@$eleve->renseignement_nom_pere));
          $pdf->text(15, 82, utf8_decode(@$eleve->renseignement_prenoms_mere.' '.@$eleve->renseignement_nom_mere));

          $pdf->text(57, 88.5, utf8_decode(@get_current_scolarite()->settings_scolarite_code));
          $pdf->text(128, 88.5, utf8_decode(@$eleve->scolarites[0]->settings_niveau_name));

          $pdf->text(155, 123.5, utf8_decode(gmdate("d-m-Y")));

          //Bottom part
          $pdf->SetFont('Arial','',9.5);
          $pdf->text(177, 189, utf8_decode("C-".@$eleve->eleve_matricule));

          $pdf->SetFont('Arial','',12);
          $pdf->text(55, 204, utf8_decode(@$eleve->prenoms.' '.@$eleve->nom));
          $pdf->text(160, 204, utf8_decode(mysql_to_date(@$eleve->naissance_date)));
          $pdf->text(15, 210.5, utf8_decode(@$eleve->naissance_lieu));

          $pdf->text(105, 210.5, utf8_decode(@$eleve->renseignement_prenoms_pere.' '.@$eleve->renseignement_nom_pere));
          $pdf->text(15, 217.5, utf8_decode(@$eleve->renseignement_prenoms_mere.' '.@$eleve->renseignement_nom_mere));

          $pdf->text(57, 224, utf8_decode(@$eleve->scolarites[0]->settings_niveau_name));
          $pdf->text(128, 224, utf8_decode(@get_current_scolarite()->settings_scolarite_code));

          $pdf->text(155, 258.5, utf8_decode(gmdate("d-m-Y")));





          // $pdf->text(155, 40, utf8_decode('Année scolaire : '.@$eleve->settings_scolarite_code));

          // $pdf->text(15, 50, utf8_decode('Classe : '.@$eleve->classe_name));

          $file_name = 'Certificat.pdf';

          $pdf->Output('I');
     }
}
?>
