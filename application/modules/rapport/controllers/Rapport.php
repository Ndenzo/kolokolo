<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rapport extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          // is_protected(array('root'));
          $this->load->model('rapport_model');

          $this->set_data('title', 'Liste des etudes');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->rapport_model->get_all());
          $this->add_data('content', $this->load->view('rapports/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->rapport_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le rapport a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le rapport n'a pas été enregistré !"
                    ));
               }
          }
          redirect('rapport');
     }

     public function locker()
     {
          if(isPostBack())
          {
               if($this->rapport_model->locker()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le rapport a été bloqué !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le rapport n'a pas été bloqué !"
                    ));
               }
          }
          redirect('rapport');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->rapport_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le rapport a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le rapport n'a pas été supprimé !"
                    ));
               }
          }
          redirect('rapport');
     }
}
?>
