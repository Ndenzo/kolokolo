<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Demo extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('demo_model');

          $this->set_data('title', 'Demo');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->set_data('metas', $this->demo_model->get_all());

          add_js(null,'application/modules/simulator/js/simulator_script.js');

          $this->add_data('content', $this->load->view('demos/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->demo_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("sim_meta_id", "sim_meta_name", "sim_meta_value", "sim_meta_code");

          echo json_encode($result);

     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->demo_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La constante a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La constante n'a pas été enregistré !"
                    ));
               }
          }
          redirect('simulator/demo');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->demo_model->update()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La constante a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La constante n'a pas été modifié !"
                    ));
               }
          }
          redirect('simulator/demo');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->demo_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La constante a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La constante n'a pas été supprimé !"
                    ));
               }
          }
          redirect('simulator/demo');
     }
}
?>
