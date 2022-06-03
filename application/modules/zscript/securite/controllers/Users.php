<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends IBEMS_Controller {

     protected $__user_id;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('users_model');
          $this->load->model('users_model');
          $this->load->model('users_connection_model');
          $this->set_data('title', 'Gestion des utilisateurs');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }
     public function index()
     {
          $this->set_data('datagrid', $this->users_model->get_all());
          $this->add_data('content', $this->load->view('users/manager', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->users_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("user_id", "role_id", "user_nicename", "user_email", "user_login");

          echo json_encode($result);
     }


     public function ShowLog()
     {
          $id = (int)$this->uri->segment(4);
          $user = $this->users_model->get_one($id);
          $result = $this->users_connection_model->get_all();

          $this->add_crumb(array('text'=>'Historique','url'=>''));

          $this->set_data('user',$user);
          $this->set_data('breadcrumb',$this->breadcrumb());
          $this->set_data('page_title',"<h1>$user->user_nicename<small> historique de connection</small></h1>");
          $this->set_data('content',$this->load->view('back/page-header',$this->get_data(),true));

          $this->set_data('datagrid',$result);
          $this->add_data('content',$this->load->view('users/log',$this->get_data(),true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->users_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'utilisateur a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'utilisateur n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/securite/users');
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->users_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'utilisateur a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'utilisateur n'a pas été modifié !"
                    ));
               }
          }
          redirect('/securite/users');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->users_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'utilisateur a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'utilisateur n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/securite/users');
     }
}
?>
