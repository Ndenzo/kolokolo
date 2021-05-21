<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->set_data('title', 'Paramètres');
          $this->set_data('page_title', 'Gestion des types de produits');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->add_data('content', $this->load->view('settings', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

}
