<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Specification extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('specification_model');

          $this->set_data('title', $this->lang->line('spec-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->specification_model->get_all());
          $this->set_data('types', $this->specification_model->get_all_type());

          $this->add_data('content', $this->load->view('specifications/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->specification_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("sim_state_id", "sim_state_name", "sim_state_name_gb", "sim_state_rate");

          echo json_encode($result);
     }

     public function showEdit_Town()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->specification_model->get_one_town($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("sim_town_id", "sim_state_update_id", "sim_town_name", "sim_town_name_gb");

          echo json_encode($result);

     }

     public function showEdit_Type()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->specification_model->get_one_type($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("sim_type_id", "sim_type_name", "sim_type_name_gb");

          echo json_encode($result);

     }

     // Insert manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->specification_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-insert-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     public function insert_town()
     {
          if(isPostBack())
          {
               if($this->specification_model->insert_town()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-insertTown-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-insertTown-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     public function insert_type()
     {
          if(isPostBack())
          {
               if($this->specification_model->insert_type()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-insertType-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-insertType-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     // Update manager -----------------------------------------------------------

     public function update()
     {
          if(isPostBack())
          {
               if($this->specification_model->update()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-update-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     public function update_town()
     {
          if(isPostBack())
          {
               if($this->specification_model->update_town()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-updateTown-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-updateTown-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     public function update_type()
     {
          if(isPostBack())
          {
               if($this->specification_model->update_type()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-updateType-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-updateType-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     // Locker manager -----------------------------------------------------------

     public function locker()
     {
          if(isPostBack())
          {
               if($this->specification_model->locker()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-update-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     // Delete manager -----------------------------------------------------------

     public function delete()
     {
          if(isPostBack())
          {
               if($this->specification_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-delete-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     public function delete_town()
     {
          if(isPostBack())
          {
               if($this->specification_model->delete_town()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-deleteTown-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-deleteTown-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }

     public function delete_type()
     {
          if(isPostBack())
          {
               if($this->specification_model->delete_type()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('spec-deleteType-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('spec-deleteType-error')
                    ));
               }
          }
          redirect('simulator/specification');
     }
}
?>
