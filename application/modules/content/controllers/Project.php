<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Project extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->model('project_model');
          $this->load->model('actor/contact_model');


          $this->set_data('title', $this->lang->line('project-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->project_model->get_all());
          $this->set_data('datagrid_locked', $this->project_model->get_locked());

          $this->add_data('content', $this->load->view('projects/manager', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     public function showAdd()
     {
          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_css(null,'assets/back/vendors/quill/quill.snow.css');
          add_css(null,'application/modules/content/css/project_style.css');
          add_css(null,'assets/custom/plugins/leaflet/leaflet.css');

          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');
          add_js(null,'assets/back/vendors/quill/quill.min.js');
          add_js(null,'application/modules/content/js/project_script.js');

          add_js(null,'assets/custom/plugins/leaflet/leaflet.js');
          add_js(null,'assets/custom/plugins/leaflet/custom.js');

          $this->add_data('content', $this->load->view('projects/add', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('project', $this->project_model->get_one($id));

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_css(null,'assets/back/vendors/quill/quill.snow.css');
          add_css(null,'application/modules/content/css/project_style.css');

          add_css(null,'assets/custom/plugins/leaflet/leaflet.css');

          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');
          add_js(null,'assets/back/vendors/quill/quill.min.js');
          add_js(null,'application/modules/content/js/project_script.js');

          add_js(null,'assets/custom/plugins/leaflet/leaflet.js');
          add_js(null,'assets/custom/plugins/leaflet/custom.js');

          $this->add_data('content', $this->load->view('projects/edit', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());

     }

     // Detail manager -----------------------------------------------------------

     public function showDetail()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('project', $this->project_model->get_one($id));

          add_css(null,'assets/back/vendors/morris.js/morris.css');
          add_css(null,'assets/custom/plugins/leaflet/leaflet.css');

          add_js(null,'assets/custom/plugins/leaflet/leaflet.js');
          add_js(null,'assets/back/vendors/raphael/raphael.min.js');
          add_js(null,'assets/back/vendors/morris.js/morris.min.js');

          add_js(null,'assets/back/vendors/justgage/raphael-2.1.4.min.js');
          add_js(null,'assets/back/vendors/justgage/justgage.js');

          add_css(null,'application/modules/content/css/project_style.css');
          add_js(null,'application/modules/content/js/project_script.js');

          add_js(null,'assets/custom/plugins/fslightbox/fslightbox.js');


          $this->add_data('content', $this->load->view('projects/detail', $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }

     // Detail manager -----------------------------------------------------------

     public function showContent()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('project', $this->project_model->get_one($id));
          $this->set_data('contacts', $this->contact_model->get_all());

          add_css(null,'assets/back/vendors/morris.js/morris.css');
          add_css(null,'assets/custom/plugins/leaflet/leaflet.css');

          add_js(null,'assets/custom/plugins/leaflet/leaflet.js');
          add_js(null,'assets/back/vendors/raphael/raphael.min.js');
          add_js(null,'assets/back/vendors/morris.js/morris.min.js');

          // add_js(null,'assets/back/vendors/justgage/raphael-2.1.4.min.js');
          // add_js(null,'assets/back/vendors/justgage/justgage.js');
          add_js(null,'https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js');

          add_css(null,'application/modules/content/css/project_style.css');
          add_js(null,'application/modules/content/js/project_script.js');

          add_js(null,'application/modules/simulator/js/simulator_script.js');

          add_js(null,'assets/custom/plugins/fslightbox/fslightbox.js');


          if (me('role_code') == "root") {
               $this->add_data('content', $this->load->view('projects/content', $this->get_data(), true));
          }else{
               $this->add_data('content', $this->load->view('projects/'.me('role_code').'/content', $this->get_data(), true));
          }
          $this->load->view('back/layout', $this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit_info()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->project_model->get_one_info($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("project_info_id", "project_info_name", "project_info_desc");

          echo json_encode($result);

     }

     // project manager -----------------------------------------------------------

     public function insert()
     {
          if(isPostBack())
          {
               if($this->project_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-insert-error')
                    ));
               }
          }
          redirect('content/project');
     }

     public function insert_invest()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->insert_invest()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-insert-invest-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-insert-invest-error')
                    ));
               }
          }
          redirect('content/project/showDetail/'.$project_id);
     }

     public function insert_report()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->insert_report()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-insert-report-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-insert-report-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function insert_info()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->insert_info()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-insert-info-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-insert-info-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function insert_investor_request()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->insert_investor_request()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-insert-request-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-insert-request-error')
                    ));
               }
          }

          redirect('content/project/showContent/'.$project_id);
     }

     public function update()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-update-error')
                    ));
               }
          }

          redirect('content/project/showEdit/'.$project_id);
     }

     public function update_info()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->update_info()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-update-info-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-update-info-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function update_info_picture()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->update_info_picture()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-update-info-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-update-info-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function locker()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-locker-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-locker-error')
                    ));
               }
          }

          redirect('content/project');
     }

     public function timeline_locker()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->timeline_locker()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-locker-timeline-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-locker-timeline-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->project_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-delete-error')
                    ));
               }
          }
          redirect('content/project');
     }

     public function delete_picture()
     {
          $project_id = $this->input->post('project_id');
          if(isPostBack())
          {
               if($this->project_model->delete_picture()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-delete-picture-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-delete-picture-error')
                    ));
               }
          }
          redirect('content/project/showEdit/'.$project_id);
     }

     public function delete_info_picture()
     {
          $project_id = $this->input->post('project_id');
          if(isPostBack())
          {
               if($this->project_model->delete_info_picture()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-delete-picture-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-delete-picture-error')
                    ));
               }
          }
          redirect('content/project/showDetail/'.$project_id);
     }

     public function delete_report()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->delete_report()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-delete-report-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-delete-report-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function delete_info()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->delete_info()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-delete-report-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-delete-report-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }

     public function delete_invest()
     {
          $project_id = $this->input->post('project_id');

          if(isPostBack())
          {
               if($this->project_model->delete_invest()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('project-delete-invest-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('project-delete-invest-error')
                    ));
               }
          }

          redirect('content/project/showDetail/'.$project_id);
     }


}
?>
