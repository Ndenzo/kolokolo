<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends IBEMS_Controller {

     public $user;

     function __construct()
     {
          parent::__construct();
          is_protected();
          $this->user = get_user_info();
          $this->load->model('content/project_model');
          $this->load->model('studie/studie_model');

     }

     public function index()
     {
          $this->set_data('projects', $this->project_model->get_all());
          $this->set_data('studies', $this->studie_model->get_all());
          $this->set_data('title',  $this->lang->line('dashboard-title') );

          switch(strtolower($this->user['role_code']))
          {

               case 'root':
               add_css(null,'assets/back/vendors/morris.js/morris.css');

               add_js(null,'assets/back/vendors/raphael/raphael.min.js');
               add_js(null,'assets/back/vendors/morris.js/morris.min.js');

               $this->add_data('menu', $this->load->view('back/menu/root', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/root', $this->get_data(), true));
               break;

               case 'potentiel':
               $this->add_data('menu', $this->load->view('back/menu/potentiel', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/potentiel', $this->get_data(), true));
               break;

               case 'investisseur':
               $this->add_data('menu', $this->load->view('back/menu/investisseur', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/investisseur', $this->get_data(), true));
               break;

               case 'partenaire':
               $this->add_data('menu', $this->load->view('back/menu/partenaire', $this->get_data(), true));
               $this->add_data('content', $this->load->view('back/dashboard/partenaire', $this->get_data(), true));
               break;

               case 'client':
               redirect('/');
               break;
          }

          if(strtolower($this->user['role_code']) != "simple"){
               $this->load->view('back/layout',$this->get_data());
          }
     }

     public function insert_contact(){

     }
}
?>
