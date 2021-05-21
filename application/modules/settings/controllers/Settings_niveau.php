<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_niveau extends IBEMS_Controller {

     protected $cycle;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_niveau_model');
          $this->cycle = $this->input->post("settings_cycle_id");
          $this->set_data('title', 'Paramètre des niveaux');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          redirect('/settings/settings_cycle');
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_niveau_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_niveau_id", "settings_niveau_code", "settings_niveau_name", "settings_niveau_desc");

          echo json_encode($result);

     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_niveau_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le niveau a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le niveau n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/settings/settings_cycle/showNiveau/'.$this->cycle);
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_niveau_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le niveau a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le niveau n'a pas été modifié !"
                    ));
               }
          }
          redirect('/settings/settings_cycle/showNiveau/'.$this->cycle);
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_niveau_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le niveau a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le niveau n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/settings/settings_cycle/showNiveau/'.$this->cycle);
     }
}
?>
