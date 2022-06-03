<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Absence extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','surveillant'));
          $this->load->model('absence_model');
          $this->load->model('settings/settings_niveau_model');

          $this->set_data('title', 'Absences et Retards');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('cycles', $this->absence_model->get_all());

          $this->add_data('content', $this->load->view('absences/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showGrid(){
          $evaluation_modele_niveau_id = (int)$this->uri->segment(4);
          $type = $this->uri->segment(5);

          $evaluation_modele_niveau = $this->absence_model->get_modele_niveau($evaluation_modele_niveau_id);
          $this->set_data('niveau',  $evaluation_modele_niveau);
          $this->set_data('classes', $this->absence_model->get_grid($type, $evaluation_modele_niveau->settings_niveau_id, $evaluation_modele_niveau_id));
          $this->set_data('type', $type);

          add_js(null,'application/modules/absence/js/absence_script.js');

          $this->add_data('content', $this->load->view('absences/grid', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }


     public function showEdit_absence()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->absence_model->get_one_absence($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("evaluation_absence_id", "evaluation_absence_debut", "evaluation_absence_fin", "evaluation_absence_desc");

          echo json_encode($result);
     }

     public function showEdit_retard()
     {
          $id = (int)$this->uri->segment(4);
          $record = $this->absence_model->get_one_retard($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("evaluation_retard_id", "evaluation_retard_debut", "evaluation_retard_fin", "evaluation_retard_desc", "evaluation_retard_date");

          echo json_encode($result);
     }

     public function insert_abs()
     {
          if(isPostBack())
          {
               if($this->absence_model->insert_absence()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'absence a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'absence n'a pas été enregistré !"
                    ));
               }
          }
          redirect('absence/absence/showGrid/'. $this->input->post('evaluation_modele_niveau_id')."/abs");
     }

     public function insert_ret()
     {
          if(isPostBack())
          {
               if($this->absence_model->insert_retard()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le retard a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le retard n'a pas été enregistré !"
                    ));
               }
          }
          redirect('absence/absence/showGrid/'. $this->input->post('evaluation_modele_niveau_id')."/ret");
     }

     public function update_abs()
     {
          if(isPostBack())
          {
               if($this->absence_model->update_absence()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'absence a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'absence n'a pas été modifié !"
                    ));
               }
          }
          redirect('absence/absence/showGrid/'. $this->input->post('evaluation_modele_niveau_id')."/abs");
     }

     public function update_ret()
     {
          if(isPostBack())
          {
               if($this->absence_model->update_retard()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le retard a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le retard n'a pas été modifié !"
                    ));
               }
          }
          redirect('absence/absence/showGrid/'. $this->input->post('evaluation_modele_niveau_id')."/ret");
     }

     public function delete_abs()
     {
          if(isPostBack())
          {
               if($this->absence_model->delete_absence()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'absence a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'absence n'a pas été supprimé !"
                    ));
               }
          }
          redirect('absence/absence/showGrid/'. $this->input->post('evaluation_modele_niveau_id')."/abs");
     }

     public function delete_ret()
     {
          if(isPostBack())
          {
               if($this->absence_model->delete_retard()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le retard a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le retard n'a pas été supprimé !"
                    ));
               }
          }
          redirect('absence/absence/showGrid/'. $this->input->post('evaluation_modele_niveau_id')."/ret");
     }

}
?>
