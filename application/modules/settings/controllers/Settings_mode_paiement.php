<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_mode_paiement extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_mode_paiement_model');

          $this->set_data('title', 'Paramètre des mode_paiements');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_mode_paiement_model->get_all());
          $this->add_data('content', $this->load->view('settings_mode_paiements/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_mode_paiement_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_mode_paiement_id", "settings_mode_paiement_code", "settings_mode_paiement_name", "settings_mode_paiement_photo", "settings_mode_paiement_verif");

          echo json_encode($result);

     }

     public function showNiveau()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('mode_paiement', $this->settings_mode_paiement_model->get_one($id));
          $this->set_data('datagrid', $this->settings_mode_paiement_model->get_niveaux($id));
          $this->add_data('content', $this->load->view('settings_niveaux/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_mode_paiement_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le mode de paiement a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le mode de paiement n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/settings/settings_mode_paiement');
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_mode_paiement_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le mode de paiement a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le mode de paiement n'a pas été modifié !"
                    ));
               }
          }
          redirect('/settings/settings_mode_paiement');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_mode_paiement_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le mode de paiement a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le mode de paiement n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/settings/settings_mode_paiement');
     }
}
?>
