<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_country extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin'));
          $this->load->model('settings_country_model');

          $this->set_data('title', 'Settings countries');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->settings_country_model->get_all());

          $this->add_data('content', $this->load->view('settings_countries/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->settings_country_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("country_id", "iso2", "short_name", "long_name", "iso3", "numcode", "un_member", "calling_code", "cctld");

          echo json_encode($result);

     }

     // country manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->settings_country_model->insert()){
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
          redirect('settings/settings_country');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->settings_country_model->update()){
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
          redirect('settings/settings_country');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->settings_country_model->delete()){
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
          redirect('settings/settings_country');
     }

}
?>
