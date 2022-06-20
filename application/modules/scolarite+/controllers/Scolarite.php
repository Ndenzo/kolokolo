<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Scolarite extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('settings/settings_cycle_model');

          $this->set_data('title', 'Scolarite');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          redirect("dashboard");
     }

     public function home($scolarite_id)
     {
          $_SESSION['scolarite'] = array();
          $_SESSION['dashboard']['settings_scolarite_id'] = $scolarite_id;

          $this->set_data('role_code', get_user_info('role_code'));
          $this->set_data('cycles', $this->settings_cycle_model->get_all());
          $this->add_data('content', $this->load->view('index', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

}
?>
