<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class support extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('support_model');
          $this->load->model('evaluation_model');
          $this->load->model('classe_model');
          $this->load->model('settings/settings_niveau_model');

          if($this->input->get("modele")){
               $_SESSION['scolarite']['modele_id'] = @$this->input->get("modele");
          }

          $this->set_data('title', 'Modèles de support');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('cycles', $this->support_model->get_all());
          $this->set_data('modules', $this->evaluation_model->get_all_modules());

          $this->add_data('content', $this->load->view('supports/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit_module()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->support_model->get_one_module($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("support_module_id", "support_module_code", "support_module_name");

          echo json_encode($result);

     }

     public function showEdit_modele()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->support_model->get_one_modele($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("support_modele_id", "settings_support_id", "support_modele_code", "support_modele_name", "support_modele_debut", "support_modele_fin");

          echo json_encode($result);
     }

     public function showEditModele()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->support_model->get_one_modele($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("support_modele_id", "support_modele_name", "support_modele_desc");

          echo json_encode($result);
     }

     public function insert_support()
     {
          if(isPostBack())
          {
               if($this->support_model->insert_support()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le support a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le support n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function insert_modele()
     {
          if(isPostBack())
          {
               if($this->support_model->insert_modele()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'évaluation a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'évaluation n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function insert_module()
     {
          if(isPostBack())
          {
               if($this->support_model->insert_module()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le module a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le module n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function insert_config()
     {
          if(isPostBack())
          {
               if($this->support_model->insert_config()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La configuration a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La configuration n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function insert_dispense()
     {
          if(isPostBack())
          {
               if($this->support_model->insert_dispense()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La dispense a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La dispense n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function insert_module_niveau()
     {
          if(isPostBack())
          {
               if($this->support_model->insert_module_niveau()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le module a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le module n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }


     public function update()
     {
          if(isPostBack())
          {
               if($this->support_model->update()){
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
          redirect('/scolarite/support/showsupport/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function update_modele()
     {
          if(isPostBack())
          {
               if($this->support_model->update_modele()){
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
          redirect('/scolarite/support');
     }

     public function update_module()
     {
          if(isPostBack())
          {
               if($this->support_model->update_module()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le module a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le module n'a pas été modifié !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->support_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le module a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le module n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function delete_modele()
     {
          if(isPostBack())
          {
               if($this->support_model->delete_modele()){
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
          redirect('/scolarite/support');
     }

     public function delete_module_niveau()
     {
          if(isPostBack())
          {
               if($this->support_model->delete_module_niveau()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le module a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le module n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }

     public function delete_support()
     {
          if(isPostBack())
          {
               if($this->support_model->delete_support()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le support a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le support n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/scolarite/support');
     }


     public function delete_detail()
     {
          if(isPostBack())
          {
               if($this->support_model->delete_detail()){
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
          redirect('/scolarite/support/showsupport/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function delete_dispense()
     {
          $support_dispense_id = (int)$this->uri->segment(4);

          if($this->support_model->delete_dispense($support_dispense_id)){
               set_notification(array(
                    'type'=>'success',
                    'message'=>"La dispense été supprimé !"
               ));
          }else{
               set_notification(array(
                    'type'=>'danger',
                    'message'=>"La dispense n'a pas été supprimé !"
               ));
          }

          redirect('/scolarite/support');
     }

}
?>
