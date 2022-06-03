<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Investor extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          $this->load->model('investor_model');

          $this->set_data('title', 'projects');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          redirect('dashboard');
     }

     public function showProject()
     {
          $id = (int)$this->uri->segment(3);
          $this->set_data('project', $this->investor_model->get_one($id));

          add_css(null,'assets/back/vendors/morris.js/morris.css');
          add_css(null,'assets/custom/plugins/leaflet/leaflet.css');

          add_js(null,'assets/custom/plugins/leaflet/leaflet.js');
          if(get_user_info('role_code') == 'potentiel'){
               add_js(null,'assets/custom/plugins/leaflet/custom.js');
          }
          add_js(null,'assets/back/vendors/raphael/raphael.min.js');
          add_js(null,'assets/back/vendors/morris.js/morris.min.js');

          add_js(null,'assets/back/vendors/justgage/raphael-2.1.4.min.js');
          add_js(null,'assets/back/vendors/justgage/justgage.js');

          add_js(null,'application/modules/simulator/js/simulator_script.js');

          $this->add_data('content', $this->load->view('projects/'.get_user_info('role_code'), $this->get_data(), true));
          $this->load->view('back/layout', $this->get_data());
     }
}
?>
