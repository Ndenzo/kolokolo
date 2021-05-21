<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_language extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_language_model');

          $this->set_data('title', 'Settings Languages');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_language_model->get_all());

          $this->add_data('content', $this->load->view('settings_languages/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_language_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_language_id", "settings_language_name", "settings_language_code");

          echo json_encode($result);

     }

     // language manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_language_model->insert()){
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
          redirect('settings/settings_language');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_language_model->update()){
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
          redirect('settings/settings_language');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_language_model->delete()){
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
          redirect('settings/settings_language');
     }

}
?>
