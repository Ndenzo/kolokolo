<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cashin extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('cashin_model');

          $this->set_data('title', 'Encaissements');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('datagrid', $this->cashin_model->get_all());
          $this->add_data('content', $this->load->view('cashins/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->cashin_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'encaissement a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'encaissement n'a pas été supprimé !"
                    ));
               }
          }
          redirect('cashin');
     }

}
?>
