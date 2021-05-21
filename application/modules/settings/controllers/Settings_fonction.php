<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_fonction extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_fonction_model');

          $this->set_data('title', 'Paramètre des fonctions');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_fonction_model->get_all());
          $this->add_data('content', $this->load->view('settings_fonctions/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_fonction_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_fonction_id", "settings_fonction_code", "settings_fonction_name", "settings_fonction_desc");

          echo json_encode($result);

     }

     public function showNiveau()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('fonction', $this->settings_fonction_model->get_one($id));
          $this->set_data('datagrid', $this->settings_fonction_model->get_niveaux($id));
          $this->add_data('content', $this->load->view('settings_niveaux/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
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
          redirect('/settings/settings_fonction');
     }
     public function update()
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
          redirect('/settings/settings_fonction');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_fonction_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le fonction a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le fonction n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/settings/settings_fonction');
     }
}
?>
