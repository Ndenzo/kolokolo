<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
     }

     public function index()
     {
          // $this->set_data('blogs', $this->article_model->get_articles(4));
          // $this->set_data('datagrid', $this->produit_model->get_all());
          // $this->set_data('header_version', "v3");
          $this->add_data('menu', $this->load->view('front/menu/main',$this->get_data(), true));
          $this->add_data('content', $this->load->view('home',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }




}
