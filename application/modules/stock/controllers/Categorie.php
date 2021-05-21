<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorie extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model('categorie_model');
          $this->load->model('produit_model');
          $this->set_data('title', 'reff | categorie_list');
          $this->set_data('page_title', 'Gestion des types de produits');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          add_js(null,'assets/back/demo/demo.js');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->categorie_model->get_all());
          $this->add_data('content', $this->load->view('categorie/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $this->add_data('content', $this->load->view('categorie/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $categorie_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->categorie_model->get_one($categorie_id));
          $this->add_data('content', $this->load->view('categorie/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $categorie_id = (int)$this->uri->segment(4);
          $this->set_data('categorie_id', $this->categorie_model->get_one($categorie_id)->categorie_id);
          $this->add_data('content', $this->load->view('categorie/remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProduct()
     {
          $categorie_id = (int)$this->uri->segment(4);
          $where = array(
               'categorie_id' => $categorie_id
          );
          $this->set_data('datagrid', $this->produit_model->search($where));
          $this->add_data('content', $this->load->view('produit/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->categorie_model->insert()){
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
          redirect("stock/categorie");
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->categorie_model->update()){
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
          redirect("stock/categorie");
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->categorie_model->delete()){
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
          redirect("stock/categorie");
     }

}
