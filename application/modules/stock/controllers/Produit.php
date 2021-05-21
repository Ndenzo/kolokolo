<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends IBEMS_Controller {

     protected $__categorie_id;

     public function __construct()
     {
          parent::__construct();
          $this->__categorie_id = (int)$this->input->get('categorie_id',true);
          $this->load->model('produit_model');
          $this->set_data('title', 'reff | produit_list');
          $this->set_data('page_title', 'Gestion des types de produits');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          add_js(null,'assets/back/demo/demo.js');
          add_js(null, 'application/modules/stock/js/script_produit.js');
     }

     public function showAdd()
     {
          $this->add_data('content', $this->load->view('produit/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $produit_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->produit_model->get_one($produit_id));
          $this->add_data('content', $this->load->view('produit/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $produit_id = (int)$this->uri->segment(4);
          $this->set_data('produit_id', $this->produit_model->get_one($produit_id)->produit_id);
          $this->add_data('content', $this->load->view('produit/remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->produit_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le produit a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le produit n'a pas été enregistré !"
                    ));
               }
          }
          redirect("stock/categorie/showProduct/?categorie_id=".$this->__categorie_id);
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->produit_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le produit a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le produit n'a pas été modifié !"
                    ));
               }
          }
          redirect("stock/categorie/showProduct/?categorie_id=".$this->__categorie_id);
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->produit_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le produit a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le produit n'a pas été supprimé !"
                    ));
               }
          }
          redirect("stock/categorie/showProduct/?categorie_id=".$this->__categorie_id);
     }

}
