<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tuteur extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','surveillant'));
          $this->load->model('tuteur_model');

          $this->set_data('title', 'Tuteurs');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          add_js(null,'application/modules/actor/js/acteur_script.js');
          $this->set_data('datagrid', $this->tuteur_model->get_all());
          $this->add_data('content', $this->load->view('tuteurs/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->tuteur_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("personne_id", "photo", "prenoms", "nom", "adresse", "telephone_1", "telephone_2", "ville", "genre", "settings_fonction_id", "naissance_date", "naissance_lieu", "tuteur_date_deb", "tuteur_desc");

          echo json_encode($result);

     }

     public function showNiveau()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('tuteur', $this->tuteur_model->get_one($id));
          $this->set_data('datagrid', $this->tuteur_model->get_niveaux($id));
          $this->add_data('content', $this->load->view('settings_niveaux/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->tuteur_model->insert()){
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
          redirect('actor/tuteur');
     }

     public function status()
     {
          if(isPostBack())
          {
               if($this->tuteur_model->change_status()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le tuteur a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le tuteur n'a pas été modifié !"
                    ));
               }
          }
          redirect('actor/tuteur');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->tuteur_model->update()){
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
          redirect('actor/tuteur');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->tuteur_model->delete()){
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
          redirect('actor/tuteur');
     }
}
?>
