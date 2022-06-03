<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coming extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          $this->load->view('front/coming',$this->get_data());
     }
}
