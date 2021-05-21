<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facebook extends IBEMS_Controller {
    public $data;
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('frontend/facebook', $this->get_data());
    }
}
?>