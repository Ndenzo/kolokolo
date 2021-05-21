<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Meet extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('meet_model');

          $this->set_data('title', 'Settings meets');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->meet_model->get_all());

          $this->add_data('content', $this->load->view('meets/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->meet_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("meet_id", "meet_first_name", "meet_last_name", "meet_phone", "meet_email", "meet_object");

          echo json_encode($result);

     }

     // meet manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->meet_model->insert()){
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
          redirect('meet');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->meet_model->update()){
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
          redirect('meet');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->meet_model->delete()){
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
          redirect('meet');
     }

}
?>
