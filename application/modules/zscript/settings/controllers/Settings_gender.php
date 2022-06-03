<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_gender extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_gender_model');

          $this->set_data('title', $this->lang->line('settingsGender-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_gender_model->get_all());

          $this->add_data('content', $this->load->view('settings_genders/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_gender_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_gender_id", "settings_gender_name", "settings_gender_name_gb", "settings_gender_code");

          echo json_encode($result);

     }

     // gender manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_gender_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('settingsGender-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('settingsGender-insert-error')
                    ));
               }
          }
          redirect('settings/settings_gender');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_gender_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('settingsGender-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('settingsGender-update-error')
                    ));
               }
          }
          redirect('settings/settings_gender');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_gender_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('settingsGender-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('settingsGender-delete-error')
                    ));
               }
          }
          redirect('settings/settings_gender');
     }

}
?>
