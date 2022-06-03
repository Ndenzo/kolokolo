<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Potentiel extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('potentiel'));
          $this->load->model('profile_model');

          $this->set_data('title', 'Profile');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          if($this->profile_model->get_one() != null){
               $this->set_data('profile', $this->profile_model->get_one());
               $this->set_data('is_profile', 1);
          }else{
               $this->set_data('profile', $this->profile_model->get_user());
               $this->set_data('is_profile', 0);
          }

          add_css(null,'assets/custom/plugins/cropper/css/cropper.css');
          add_css(null,'assets/custom/plugins/cropper/css/main.css');
          add_js(null,'assets/custom/plugins/cropper/js/cropper.js');

          add_js(null,'assets/custom/js/jquery.validate.js');
          add_js(null,'application/modules/profile/js/profile_script.js');

          $this->add_data('content', $this->load->view('potentiels/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Pack manager -----------------------------------------------------------

     public function update()
     {
          if(isPostBack())
          {
               if($this->profile_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Well done !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('profile/potentiel');
     }

}
?>
