<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('blog_model');

          $this->set_data('title', 'Settings blogs');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->blog_model->get_all());

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          $this->add_data('content', $this->load->view('blogs/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->blog_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("blog_id", "blog_name", "blog_date", "blog_picture", "blog_link");

          echo json_encode($result);

     }

     // blog manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->blog_model->insert()){
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
          redirect('blog');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->blog_model->update()){
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
          redirect('blog');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->blog_model->delete()){
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
          redirect('blog');
     }

}
?>
