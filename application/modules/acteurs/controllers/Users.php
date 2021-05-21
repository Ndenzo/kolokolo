<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends IBEMS_Controller {

  //public $__user_id;

  public function __construct()
  {
    parent::__construct();
    //$this->user_id = get_user_info('user_id');
  }
  public function index()
  {
    //$this->add_data('content', $this->load->view('users/signup', $this->get_data(), true));
    $this->load->view('users/signup',$this->get_data());
  }
  public function login()
  {

  }
}
