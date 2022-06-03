<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pricing extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('pricing_model');
          $this->load->model('settings/settings_niveau_model');

          if($this->input->get("modele")){
               $_SESSION['scolarite']['modele_id'] = (int) @$this->input->get("modele");
          }

          $this->set_data('title', 'Pricing Modeles');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('modeles', $this->pricing_model->get_modeles());

          $this->add_data('content', $this->load->view('pricings/modele', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showPricing(){
          $modele = $this->pricing_model->get_one_modele($_SESSION['scolarite']['modele_id']);

          $this->set_data('title', 'Pricing - '.$modele->tarification_modele_name);
          $this->set_data('tarifications', $this->pricing_model->get_all($_SESSION['scolarite']['modele_id']));
          $this->set_data('tarification_details', $this->pricing_model->get_details());

          $this->add_data('content', $this->load->view('pricings/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $id = (int)$this->uri->segment(3);
          $record = $this->pricing_model->get_one($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("tarification_id", "tarification_name");

          echo json_encode($result);
     }

     public function showEditModele()
     {
          $id = (int)$this->uri->segment(3);
          $record = $this->pricing_model->get_one_modele($id);
          $result = array();
          $result['record'] = $record;
          $result['header'] = array("tarification_modele_id", "tarification_modele_name", "tarification_modele_desc");

          echo json_encode($result);
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->pricing_model->insert()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/pricing/showPricing/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function insert_details()
     {
          if(isPostBack())
          {
               if($this->pricing_model->insert_details()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été enregistré !"
                    ));
               }
          }
          redirect('/pricing/showPricing/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function insert_modeles()
     {
          if(isPostBack())
          {
               if($this->pricing_model->insert_modeles()){

                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le modeles a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le modeles n'a pas été enregistré !"
                    ));
               }
          }
          redirect('pricing');
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->pricing_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été modifié !"
                    ));
               }
          }
          redirect('/pricing/showPricing/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function update_modeles()
     {
          if(isPostBack())
          {
               if($this->pricing_model->update_modeles()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le modeles a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le modeles n'a pas été modifié !"
                    ));
               }
          }
          redirect('pricing');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->pricing_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'élément a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'élément n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/pricing/showPricing/?modele='.$_SESSION['scolarite']['modele_id']);
     }

     public function delete_modeles()
     {
          if(isPostBack())
          {
               if($this->pricing_model->delete_modeles()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le modele a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le modele n'a pas été supprimé !"
                    ));
               }
          }
          redirect('pricing');
     }

     public function delete_detail()
     {
          if(isPostBack())
          {
               if($this->pricing_model->delete_detail()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le detail a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le detail n'a pas été supprimé !"
                    ));
               }
          }
          redirect('/pricing/showPricing/?modele='.$_SESSION['scolarite']['modele_id']);
     }


}
?>
