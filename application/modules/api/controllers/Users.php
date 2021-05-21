<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends IBEMS_Controller
{
    protected $type_pack_id;

    function __construct()
    {
        parent::__construct();

    }
    function check_login()
    {
      $user_login = $this->input->get('user_login');
      echo json_encode(!login_exist($user_login));
    }
    function check_email()
    {
        $user_email = $this->input->get('user_email');
        echo json_encode(!email_exist($user_email));
    }
}