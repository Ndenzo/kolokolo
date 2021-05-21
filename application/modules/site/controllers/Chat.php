<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model(array(
               'api/chat_model' => 'chat_model'
          ));
          add_js(null, 'application/modules/site/js/script.js');
          $this->set_data('subjects', $this->chat_model->get_all_subjects());
          $this->add_data('menu', $this->load->view('back/menu/admin', $this->get_data(), true));
     }

     public function index()
     {
          $this->add_data('sub_content', $this->load->view('chat/default',$this->get_data(), true));
          $this->add_data('content', $this->load->view('chat/index', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAddSubject()
     {
          $this->add_data('sub_content', $this->load->view('chat/default',$this->get_data(), true));
          $this->add_data('content', $this->load->view('chat/index', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEditSubject()
     {
          $this->add_data('sub_content', $this->load->view('chat/default',$this->get_data(), true));
          $this->add_data('content', $this->load->view('chat/index', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showDeleteSubject()
     {
          $this->add_data('sub_content', $this->load->view('chat/default',$this->get_data(), true));
          $this->add_data('content', $this->load->view('chat/index', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showBox($type, $identifier)
     {
          $this->add_data('sub_content', $this->load->view('chat/box',$this->get_data(), true));
          $this->add_data('content', $this->load->view('chat/index', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert_subjet()
     {
          if(isPostBack()){
               if($this->chat_model->insert_subjet()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Vous avez un nouveau sujet de discussion ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'opération à avorté ! "
                    ));
               }
          }
          redirect("site/chat");
     }
}
