<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_matiere extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_matiere_model');

          $this->set_data('title', 'Paramètre des matieres');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_matiere_model->get_all());
          $this->add_data('content', $this->load->view('settings_matieres/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_matiere_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_matiere_id", "settings_cycle_id", "settings_matiere_code", "settings_matiere_name", "settings_matiere_desc");

          echo json_encode($result);

     }

     public function showNiveau()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('matiere', $this->settings_matiere_model->get_one($id));
          $this->set_data('datagrid', $this->settings_matiere_model->get_niveaux($id));
          $this->add_data('content', $this->load->view('settings_niveaux/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_matiere_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le matiere a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le matiere n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/settings/settings_matiere');
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_matiere_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le matiere a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le matiere n'a pas été modifié !"
                    ));
               }
          }
          redirect('/settings/settings_matiere');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_matiere_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le matiere a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le matiere n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/settings/settings_matiere');
     }
}
?>
