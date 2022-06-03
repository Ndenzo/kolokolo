<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Convenience extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->model('convenience_model');

          $this->set_data('title', $this->lang->line('convenience-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->convenience_model->get_all());

          $this->add_data('content', $this->load->view('conveniences/manager', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->convenience_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("convenience_id", "convenience_name", "convenience_name_gb", "convenience_image");

          echo json_encode($result);
     }

     // convenience manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->convenience_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('convenience-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('convenience-insert-error')
                    ));
               }
          }
          redirect('content/convenience');
     }

     public function update()
     {
          $convenience_id = $this->input->post('convenience_id');

          if(isPostBack())
          {
               if($this->convenience_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('convenience-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('convenience-update-error')
                    ));
               }
          }

          redirect('content/convenience');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->convenience_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('convenience-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('convenience-delete-error')
                    ));
               }
          }
          redirect('content/convenience');
     }

}
?>
