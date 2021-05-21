<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Decaissement_bon_flag extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('decaissement_bon_flag_model');

          $this->set_data('title', 'Paramètre des flags - Decaissement bon');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->decaissement_bon_flag_model->get_all());
          $this->add_data('content', $this->load->view('decaissement_bon_flags/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->decaissement_bon_flag_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("decaissement_bon_flag_id", "decaissement_bon_flag_code", "decaissement_bon_flag_name", "decaissement_bon_flag_desc");

          echo json_encode($result);

     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->decaissement_bon_flag_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le flag a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le flag n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/settings/decaissement_bon_flag');
     }
     public function update()
     {
          if(isPostBack())
          {
               if($this->decaissement_bon_flag_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le flag a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le flag n'a pas été modifié !"
                    ));
               }
          }
          redirect('/settings/decaissement_bon_flag');
     }
     public function delete()
     {
          if(isPostBack())
          {
               if($this->decaissement_bon_flag_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le flag a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le flag n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/settings/decaissement_bon_flag');
     }
}
?>
