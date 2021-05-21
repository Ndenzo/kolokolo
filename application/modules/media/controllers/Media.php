<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('media_model');

          $this->set_data('title', 'Settings medias');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->media_model->get_all());

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          $this->add_data('content', $this->load->view('medias/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->media_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("media_id", "media_name", "media_date", "media_picture", "media_link");

          echo json_encode($result);

     }

     // media manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->media_model->insert()){
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
          redirect('media');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->media_model->update()){
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
          redirect('media');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->media_model->delete()){
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
          redirect('media');
     }

}
?>
