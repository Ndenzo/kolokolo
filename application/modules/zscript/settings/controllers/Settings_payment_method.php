<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_payment_method extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_payment_method_model');

          $this->set_data('title', $this->lang->line('settingsPayment-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_payment_method_model->get_all());

          $this->add_data('content', $this->load->view('settings_payment_methods/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_payment_method_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_payment_method_code", "settings_payment_method_name", "settings_payment_method_name_gb", "settings_payment_method_id");

          echo json_encode($result);

     }

     // payment manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_payment_method_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('settingsPayment-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('settingsPayment-insert-error')
                    ));
               }
          }
          redirect('settings/settings_payment_method');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_payment_method_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('settingsPayment-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('settingsPayment-update-error')
                    ));
               }
          }
          redirect('settings/settings_payment_method');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_payment_method_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('settingsPayment-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('settingsPayment-delete-error')
                    ));
               }
          }
          redirect('settings/settings_payment_method');
     }

}
?>
