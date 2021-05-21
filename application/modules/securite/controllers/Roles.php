<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('roles_model');

          $this->set_data('title', 'Profils');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->roles_model->get_all());
          $this->add_data('content', $this->load->view('roles/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->roles_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("role_id", "role_code", "role_name", "role_desc");

          echo json_encode($result);

     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->roles_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le rôle a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le rôle n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/securite/roles');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->roles_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le rôle a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le rôle n'a pas été modifié !"
                    ));
               }
          }
          redirect('/securite/roles');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->roles_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le rôle a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le rôle n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/securite/roles');
     }
}
?>
