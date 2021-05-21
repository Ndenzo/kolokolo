<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partenaire extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model('partenaire_model');
          $this->set_data('title', 'reff | partenaire_list');
          $this->set_data('page_title', 'partenaire');
          $this->set_data('base_url', '../');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->partenaire_model->get_all());
          $this->add_data('content', $this->load->view('partenaires/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $this->add_data('content', $this->load->view('partenaires/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $partenaire_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->partenaire_model->get_one($partenaire_id));
          $this->add_data('content', $this->load->view('partenaires/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $partenaire_id = (int)$this->uri->segment(4);
          $this->set_data('partenaire_id', $this->partenaire_model->get_one($partenaire_id)->partenaire_id);
          $this->add_data('content', $this->load->view('partenaires/remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProduct()
     {
          $partenaire_id = (int)$this->uri->segment(4);
          $where = array(
               'partenaire_id' => $partenaire_id
          );
          $this->set_data('datagrid', $this->produit_model->search($where));
          $this->add_data('content', $this->load->view('produit/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->partenaire_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le partenaire a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le partenaire n'a pas été enregistré !"
                    ));
               }
          }
          redirect("acteur/partenaire");
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->partenaire_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le partenaire a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le partenaire n'a pas été modifié !"
                    ));
               }
          }
          redirect("acteur/partenaire");
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->partenaire_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le partenaire a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le partenaire n'a pas été supprimé !"
                    ));
               }
          }
          redirect("acteur/partenaire");
     }

}
