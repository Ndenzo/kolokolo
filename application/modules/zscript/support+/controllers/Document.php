<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Document extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('document_model');

          $this->set_data('title', 'Liste des documents');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->document_model->get_all());
          $this->add_data('content', $this->load->view('documents/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->document_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le document a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le document n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/document/document');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->document_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le document a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le document n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/document/document');
     }
}
?>
