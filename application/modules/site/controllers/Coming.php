<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coming extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model(array(
               'api/prospect_model' => 'prospect_model'
          ));
     }

     public function index()
     {
          $this->load->view('coming',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack()){
               if($this->prospect_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Vous êtes maintenant inscrit aux Newsletters !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'inscription aux Newsletter a avorté !"
                    ));
               }
          }
          redirect("/");
     }

}
