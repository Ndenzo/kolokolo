<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_rx_link extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_rx_link_model');

          $this->set_data('title', 'Settings rx_links');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_rx_link_model->get_all());

          $this->add_data('content', $this->load->view('settings_rx_links/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_rx_link_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("settings_rx_link_id", "settings_rx_link_code", "settings_rx_link_icon", "settings_rx_link_value");

          echo json_encode($result);

     }

     // rx_link manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_rx_link_model->insert()){
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
          redirect('settings/settings_rx_link');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_rx_link_model->update()){
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
          redirect('settings/settings_rx_link');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_rx_link_model->delete()){
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
          redirect('settings/settings_rx_link');
     }

}
?>
