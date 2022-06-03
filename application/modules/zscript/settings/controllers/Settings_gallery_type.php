<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_gallery_type extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_gallery_type_model');

          $this->set_data('title', 'Settings payments');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_gallery_type_model->get_all());

          $this->add_data('content', $this->load->view('settings_gallery_types/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_gallery_type_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_gallery_type_code", "settings_gallery_type_name", "settings_gallery_type_id");

          echo json_encode($result);

     }

     // payment manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_gallery_type_model->insert()){
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
          redirect('settings/settings_gallery_type');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_gallery_type_model->update()){
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
          redirect('settings/settings_gallery_type');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_gallery_type_model->delete()){
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
          redirect('settings/settings_gallery_type');
     }

}
?>
