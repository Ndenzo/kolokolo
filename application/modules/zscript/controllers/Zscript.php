<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Zscript extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('zscript_model');

          $this->set_data('title', 'Script mode');
     }

     public function index()
     {
          // $this->zscript_model->update_tuteur();
          // $this->zscript_model->update_facture();
          $this->zscript_model->update_images();
          echo "ok";
     }
}
?>
