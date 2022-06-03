<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Studie extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          // is_protected(array('root'));
          $this->load->model('studie_model');

          $this->set_data('title', $this->lang->line('studie-title'));
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('datagrid_actif', $this->studie_model->get_all('available'));
          $this->set_data('datagrid_inactif', $this->studie_model->get_all('unavailable'));

          add_css(null,'application/modules/studie/css/studie_style.css');
          add_js(null,'application/modules/studie/js/studie_script.js');

          $this->add_data('content', $this->load->view('studies/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showContent()
     {
          $id = (int)$this->uri->segment(4);
          $this->set_data('studie', $this->studie_model->get_one($id));

          add_css(null,'application/modules/studie/css/studie_style.css');
          add_js(null,'application/modules/studie/js/studie_script.js');

          $this->add_data('content', $this->load->view('studies/content', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $this->set_data('datagrid', $this->studie_model->get_all());

          add_css(null,'assets/back/vendors/quill/quill.snow.css');
          add_js(null,'assets/back/vendors/quill/quill.min.js');

          add_js(null,'application/modules/studie/js/studie_script.js');

          $this->add_data('content', $this->load->view('studies/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function download()
     {
          $this->load->library("sendit");

          $id = $this->input->post('studie_id');
          $studie =  $this->studie_model->get_one($id);

          $join = array();
          array_push($join, $studie->studie_link);

          $object = "Etude de marché ACS-CAPITAL !";
          $to = me('user_email');
          $nicename = me('user_nicename');

          $content = '<p style="width: 100%;">Bonjour '.$nicename.',</p>
          <p>Votre demande de téléchargement est disponible ! </p>
          <p></p>
          <p style="margin-top: 30px; margin-bottom: 30px;">Vous trouverez en ci-joint le document demander</p>
          <br>
          <strong>Bonne réception</strong>';

          $data['content'] = $content;
          $view = $this->load->view('back/mail/default', $data, true);
          if($this->sendit->send_mail_studie($view, $object, $to, $join)){
               redirect('studie');
          }
          redirect('studie');
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->studie_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('studie-insert-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('studie-insert-error')
                    ));
               }
          }
          redirect('studie');
     }

     public function locker()
     {
          if(isPostBack())
          {
               if($this->studie_model->locker()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('studie-update-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('studie-update-error')
                    ));
               }
          }
          redirect('studie');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->studie_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>$this->lang->line('studie-delete-done')
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>$this->lang->line('studie-delete-error')
                    ));
               }
          }
          redirect('studie');
     }
}
?>
