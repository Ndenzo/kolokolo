<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Realisation extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('realisation_model');

          $this->set_data('title', 'Settings realisations');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->realisation_model->get_all());

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          $this->add_data('content', $this->load->view('realisations/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->realisation_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("realisation_id", "realisation_name", "realisation_picture", "realisation_address");

          echo json_encode($result);

     }

     // realisation manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->realisation_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Element added ... "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('realisation');
     }

     public function insert_illustration()
     {
          if(isPostBack())
          {
               if($this->realisation_model->insert_illustration()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Element added ... "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('realisation');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->realisation_model->update()){
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
          redirect('realisation');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->realisation_model->delete()){
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
          redirect('realisation');
     }

     public function delete_illustration()
     {
          if(isPostBack())
          {
               if($this->realisation_model->delete_illustration()){
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
          redirect('realisation');
     }

}
?>
