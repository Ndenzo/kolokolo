<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->model('contact_model');

          $this->set_data('title', $this->lang->line('contact-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->contact_model->get_all());

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          $this->add_data('content', $this->load->view('contacts/manager', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->contact_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("contact_id", "contact_fullname", "contact_function", "contact_function_gb", "contact_num", "contact_country_num", "contact_email", "contact_image");

          echo json_encode($result);

     }

     // contact manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->contact_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('contact-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('contact-insert-error')
                    ));
               }
          }
          redirect('actor/contact');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->contact_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('contact-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('contact-update-error')
                    ));
               }
          }
          redirect('actor/contact');
     }

     public function locker()
     {
          if(isPostBack())
          {
               if($this->contact_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('contact-locker-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('contact-locker-error')
                    ));
               }
          }
          redirect('actor/contact');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->contact_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('contact-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('contact-delete-error')
                    ));
               }
          }
          redirect('actor/contact');
     }
}
?>
