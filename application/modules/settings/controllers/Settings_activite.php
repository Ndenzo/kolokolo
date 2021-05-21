<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_activite extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_activite_model');

          $this->set_data('title', 'Paramètre des activites');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_activite_model->get_all());
          $this->add_data('content', $this->load->view('settings_activites/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_activite_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_activite_id", "settings_activite_code", "settings_activite_name", "settings_activite_class");

          echo json_encode($result);

     }

     public function showNiveau()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('activite', $this->settings_activite_model->get_one($id));
          $this->set_data('datagrid', $this->settings_activite_model->get_niveaux($id));
          $this->add_data('content', $this->load->view('settings_niveaux/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_activite_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le activite a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le activite n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/settings/settings_activite');
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_activite_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le activite a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le activite n'a pas été modifié !"
                    ));
               }
          }
          redirect('/settings/settings_activite');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_activite_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le activite a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le activite n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/settings/settings_activite');
     }
}
?>
