<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_pack extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_pack_model');

          $this->set_data('title', 'Settings Packs');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_pack_model->get_all());

          $this->add_data('content', $this->load->view('settings_packs/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_pack_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_pack_id", "settings_pack_name", "settings_pack_value");

          echo json_encode($result);

     }

     // Pack manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_pack_model->insert()){
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
          redirect('settings/settings_pack');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_pack_model->update()){
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
          redirect('settings/settings_pack');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_pack_model->delete()){
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
          redirect('settings/settings_pack');
     }

}
?>
