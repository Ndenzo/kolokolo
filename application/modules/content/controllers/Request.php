<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->model('investor_request_model');

          $this->set_data('title', $this->lang->line('request-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid_actif', $this->investor_request_model->get_all('available'));
          $this->set_data('datagrid_inactif', $this->investor_request_model->get_all('unavailable'));

          $this->add_data('content', $this->load->view('investor_requests/manager', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->investor_request_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("investor_request_id", "investor_request_name", "investor_request_image");

          echo json_encode($result);
     }

     // investor_request manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->investor_request_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('request-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('request-insert-error')
                    ));
               }
          }
          redirect('content/request');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->investor_request_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('request-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('request-update-error')
                    ));
               }
          }

          redirect('content/request');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->investor_request_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('request-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('request-delete-error')
                    ));
               }
          }
          redirect('content/request');
     }

}
?>
