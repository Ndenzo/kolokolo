<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tuteur extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('tuteur'));
          $this->load->model('actor/eleve_model');

          $this->set_data('title', 'Gestion des tuteurs');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function showEleve()
     {
          $id = (int)$this->uri->segment(3);
          $this->set_data('eleve', $this->eleve_model->get_one($id));
          $this->add_data('content', $this->load->view('actor/eleves/profile', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

}
?>
