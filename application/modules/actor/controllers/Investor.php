<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Investor extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->model('investor_model');
          $this->load->model('securite/users_model');

          $this->set_data('title', $this->lang->line('investor-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid_actif', $this->investor_model->get_all("available"));
          $this->set_data('datagrid_inactif', $this->investor_model->get_all("unavailable"));
          $this->set_data('datagrid_locked', $this->investor_model->get_locked());

          $this->add_data('content', $this->load->view('investors/manager', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->investor_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("investor_id", "user_id", "role_id");

          echo json_encode($result);

     }

     // investor manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->investor_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('investor-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('investor-insert-error')
                    ));
               }
          }
          redirect('actor/investor');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->investor_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('investor-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('investor-update-error')
                    ));
               }
          }
          redirect('actor/investor');
     }

     public function update_profile()
     {
          if(isPostBack())
          {
               if($this->investor_model->update_profile()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('investor-update_profile-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('investor-update_profile-error')
                    ));
               }
          }
          redirect('actor/investor');
     }

     public function locker()
     {
          if(isPostBack())
          {
               if($this->users_model->locker()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('investor-locker-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('investor-locker-error')
                    ));
               }
          }
          redirect('actor/investor');
     }

     public function investor_locker()
     {
          if(isPostBack())
          {
               if($this->investor_model->investor_locker()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('investor-investor_locker-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('investor-investor_locker-error')
                    ));
               }
          }
          redirect('actor/investor');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->investor_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('investor-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('investor-delete-error')
                    ));
               }
          }
          redirect('actor/investor');
     }

     // public function export()
     // {
     //      $file = null;
     //
     //      if(isPostBack())
     //      {
     //           $file = $this->investor_model->export();
     //
     //           if ($file != null) {
     //                set_notification(array(
     //                     'type' => 'success',
     //                     'message' => 'ok'
     //                ));
     //                redirect('temp/'.$file);
     //           }else{
     //                set_notification(array(
     //                     'type' => 'danger',
     //                     'message' => 'not ok'
     //                ));
     //                redirect('actor/investor');
     //           }
     //      }
     // }

}
?>
