<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configurator extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model('configurator_model');
          $this->set_data('title', 'reff | configurator_list');
          $this->set_data('page_title', 'Configurator');
          $this->set_data('base_url', './');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->configurator_model->get_all());
          $this->add_data('content', $this->load->view('configurator_view/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $this->add_data('content', $this->load->view('configurator_view/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $configurator_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->configurator_model->get_one($configurator_id));
          $this->add_data('content', $this->load->view('configurator/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $configurator_id = (int)$this->uri->segment(4);
          $this->set_data('configurator_id', $this->configurator_model->get_one($configurator_id)->configurator_id);
          $this->add_data('content', $this->load->view('configurator/remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProduct()
     {
          $configurator_id = (int)$this->uri->segment(4);
          $where = array(
               'configurator_id' => $configurator_id
          );
          $this->set_data('datagrid', $this->produit_model->search($where));
          $this->add_data('content', $this->load->view('produit/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->configurator_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le type de produits a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le type de produits n'a pas été enregistré !"
                    ));
               }
          }
          redirect("configurator");
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->configurator_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le type de produits a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le type de produits n'a pas été modifié !"
                    ));
               }
          }
          redirect("configurator");
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->configurator_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le type de produits a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le type de produits n'a pas été supprimé !"
                    ));
               }
          }
          redirect("configurator");
     }

}
