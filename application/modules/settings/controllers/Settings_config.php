<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_config extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_config_model');

          $this->set_data('title', 'Settings configs');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_config_model->get_all());

          $this->add_data('content', $this->load->view('settings_configs/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_config_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("meta_key", "meta_value", "meta_id");

          echo json_encode($result);

     }

     // config manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_config_model->insert()){
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
          redirect('settings/settings_config');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_config_model->update()){
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
          redirect('settings/settings_config');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_config_model->delete()){
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
          redirect('settings/settings_config');
     }

}
?>
