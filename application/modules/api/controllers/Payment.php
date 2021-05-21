<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends IBEMS_Controller
{
     function __construct(){
          parent::__construct();
          $this->load->library("paydunya");
     }


}
