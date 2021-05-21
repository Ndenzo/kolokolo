<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends IBEMS_Controller {

     public $user;

     function __construct()
     {
          parent::__construct();
          is_protected();
          $this->user = get_user_info();
          if(!isset($this->session->dark_mode)){
               $this->session->dark_mode = false;
          }
     }
     public function index()
     {
          $this->set_data('title', 'Home');

          switch(strtolower($this->user['role_code']))
          {
               case 'root':

               $this->add_data('menu', $this->load->view('back/menu/root', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/root', $this->get_data(), true));
               break;

               case 'customer':
               add_js(null,'application/modules/dashboard/js/dashboard_schedule_script.js');

               $this->set_data('events', $this->schedule_model->get_event());
               $this->add_data('menu', $this->load->view('back/menu/customer', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/customer', $this->get_data(), true));
               break;

               case 'teacher':
               add_js(null,'application/modules/dashboard/js/dashboard_schedule_script.js');

               $this->set_data('events', $this->schedule_model->get_event());
               $this->add_data('menu', $this->load->view('back/menu/teacher', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/teacher', $this->get_data(), true));
               break;

               case 'simple':
               redirect('/');
               break;
          }

          if(strtolower($this->user['role_code']) != "simple"){
               $this->load->view('back/layout', $this->get_data());
          }
     }

     public function mode($mode){
          if($mode == "dark"){
               $this->session->dark_mode = true;
          }else{
               $this->session->dark_mode = false;
          }
          redirect('dashboard');
     }
}
?>
