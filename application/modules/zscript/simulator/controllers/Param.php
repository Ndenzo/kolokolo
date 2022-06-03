<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Param extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root'));
          $this->load->model('param_model');

          $this->set_data('title', 'Liste des specifications');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->param_model->get_all());

          add_js(null,'application/modules/simulator/js/simulator_script.js');

          $this->add_data('content', $this->load->view('params/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // Edit manager -----------------------------------------------------------

     public function showEdit()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->param_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("sim_param_id", "sim_state_id", "sim_town_id", "sim_type_id", "sim_param_value");

          echo json_encode($result);

     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->param_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le paramètre a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le paramètre n'a pas été enregistré !"
                    ));
               }
          }
          redirect('simulator/param');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->param_model->update()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le paramètre a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le paramètre n'a pas été modifié !"
                    ));
               }
          }
          redirect('simulator/param');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->param_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le paramètre a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le paramètre n'a pas été supprimé !"
                    ));
               }
          }
          redirect('simulator/param');
     }
}
?>
