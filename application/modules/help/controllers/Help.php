<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Help extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          $this->set_data('title', '404');
     }

     public function index()
     {
          $this->load->view('back/404_error',$this->get_data());
     }
}
?>
