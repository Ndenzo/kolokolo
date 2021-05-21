<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vente extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('vente_model');

          $this->set_data('title', 'Settings ventes');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->vente_model->get_all());

          $this->add_data('content', $this->load->view('ventes/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->vente_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("vente_id", "vente_code", "vente_icon", "vente_value");

          echo json_encode($result);

     }

     // vente manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->vente_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Merci de vous être inscrit à notre newsletter ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('vente');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->vente_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Element updated ... "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('vente');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->vente_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Element deleted ..."
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('vente');
     }

}
?>
