<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employe extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('employe_model');
          $this->load->model('settings_fonction_model');

          $this->set_data('title', 'Employés');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          add_js(null,'application/modules/actor/js/acteur_script.js');
          $this->set_data('settings_fonctions', $this->employe_model->get_all());

          $this->add_data('content', $this->load->view('employes/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          add_js(null,'assets/custom/js/jquery.validate.js');
          add_js(null,'application/modules/actor/js/acteur_script.js');
          $this->set_data('profile', $this->employe_model->get_one($id));
          $this->set_data('fonctions', $this->settings_fonction_model->get_all());

          $this->add_data('content', $this->load->view('employes/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          add_js(null,'assets/custom/js/jquery.validate.js');
          add_js(null,'application/modules/actor/js/acteur_script.js');
          $this->set_data('fonctions', $this->settings_fonction_model->get_all());

          $this->add_data('content', $this->load->view('employes/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // public function showEdit()
     // {
     //      $id = (int)$this->uri->segment(4);
     //      $record = $this->employe_model->get_one($id);
     //      $result = array();
     //      $result['record'] = $record;
     //      $result['header'] = array("personne_id", "personne_photo", "personne_prenoms", "personne_nom", "personne_adresse", "personne_telephone_1", "personne_telephone_2", "personne_ville", "personne_genre", "settings_fonction_id", "personne_naissance_date", "personne_naissance_lieu", "employe_date_deb", "employe_desc");
     //
     //      echo json_encode($result);
     //
     // }

     public function showEdit_fonction()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_fonction_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_fonction_id", "settings_fonction_code", "settings_fonction_name", "settings_fonction_desc");

          echo json_encode($result);

     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->employe_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'employé a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'employé n'a pas été enregistré !"
                    ));
               }
          }
          redirect('actor/employe');
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->employe_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'employé a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'employé n'a pas été modifié !"
                    ));
               }
          }
          redirect('actor/employe');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->employe_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'employé a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'employé n'a pas été supprimé !"
                    ));
               }
          }
          redirect('actor/employe');
     }

     public function lock()
     {
          if(isPostBack())
          {
               if($this->employe_model->lock()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'employé a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'employé n'a pas été supprimé !"
                    ));
               }
          }
          redirect('actor/employe');
     }

     public function insert_fonction()
     {
          if(isPostBack())
          {
               if($this->settings_fonction_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le fonction a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le fonction n'a pas été enregistré !"
                    ));
               }
          }
          redirect('actor/employe');
     }

     public function update_fonction()
     {
          if(isPostBack())
          {
               if($this->settings_fonction_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le fonction a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le fonction n'a pas été modifié !"
                    ));
               }
          }
          redirect('actor/employe');
     }
}
?>
