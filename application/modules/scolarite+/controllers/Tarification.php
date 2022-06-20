<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tarification extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('tarification_model');
          $this->load->model('settings/settings_niveau_model');

          if($this->input->get("modele")){
               $_SESSION['scolarite']['modele_id'] = @$this->input->get("modele");
          }

          $this->set_data('title', 'Modèles de tarification');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('modeles', $this->tarification_model->get_modeles());

          $this->add_data('content', $this->load->view('tarifications/modele', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showTarification(){
          $modele = $this->tarification_model->get_one_modele($_SESSION['scolarite']['modele_id']);

          $this->set_data('title', 'Tarification - '.$modele->tarification_modele_name);
          $this->set_data('tarifications', $this->tarification_model->get_all($_SESSION['scolarite']['modele_id']));
          $this->set_data('tarification_details', $this->tarification_model->get_details());

          $this->add_data('content', $this->load->view('tarifications/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->tarification_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("tarification_id", "tarification_name");

          echo json_encode($result);
     }

     public function showEditModele()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->tarification_model->get_one_modele($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("tarification_modele_id", "tarification_modele_name", "tarification_modele_desc");

          echo json_encode($result);
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->tarification_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/tarification/showTarification/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function insert_details()
     {
          if(isPostBack())
          {
               if($this->tarification_model->insert_details()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/tarification/showTarification/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function insert_modeles()
     {
          if(isPostBack())
          {
               if($this->tarification_model->insert_modeles()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le modeles a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le modeles n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/tarification');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->tarification_model->update()){
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
          redirect('/scolarite/tarification/showTarification/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function update_modeles()
     {
          if(isPostBack())
          {
               if($this->tarification_model->update_modeles()){
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
          redirect('/scolarite/tarification');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->tarification_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/tarification/showTarification/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function delete_modeles()
     {
          if(isPostBack())
          {
               if($this->tarification_model->delete_modeles()){
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
          redirect('/scolarite/tarification');
     }

     public function delete_detail()
     {
          if(isPostBack())
          {
               if($this->tarification_model->delete_detail()){
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
          redirect('/scolarite/tarification/showTarification/?modele='.$_SESSION['scolarite']['modele_id']);
     }


}
?>
