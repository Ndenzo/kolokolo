<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livraison extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model(array(
               'api/commande_model' => 'commande_model',
          ));
          $this->set_data('title', 'reff | livraisons');
          $this->set_data('page_title', 'Gestion des commandes');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          add_js(null,'assets/back/demo/demo.js');
     }

     public function index()
     {
          $this->set_data('datagrid', $this->commande_model->get_all());
          $this->add_data('content', $this->load->view('list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $commande_id = (int)$this->uri->segment(4);
          $where = array(
               "commande_id" => $commande_id
          );
          change_flag("commandes", "commande_flag", 4, $where);
          redirect("livraison/livraison");
          // $this->add_data('content', $this->load->view('add', $this->get_data(), true));
          // $this->load->view('back/layout',$this->get_data());
     }
     public function showValid()
     {
          $commande_id = (int)$this->uri->segment(4);
          $where = array(
               "commande_id" => $commande_id
          );
          change_flag("commandes", "commande_flag", 2, $where);
          redirect("livraison/livraison");
          // $this->add_data('content', $this->load->view('add', $this->get_data(), true));
          // $this->load->view('back/layout',$this->get_data());
     }
     public function showInvalid()
     {
          $commande_id = (int)$this->uri->segment(4);
          $where = array(
               "commande_id" => $commande_id
          );
          change_flag("commandes", "commande_flag", 3, $where);
          redirect("livraison/livraison");
          // $this->add_data('content', $this->load->view('add', $this->get_data(), true));
          // $this->load->view('back/layout',$this->get_data());
     }


     public function showEdit()
     {
          $commande_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->commande_model->get_one($commande_id));
          $this->add_data('content', $this->load->view('edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $commande_id = (int)$this->uri->segment(4);
          $this->set_data('commande_id', $this->commande_model->get_one($commande_id)->commande_id);
          $this->add_data('content', $this->load->view('remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     // public function showCustomer()
     // {
     //      $commande_id = (int)$this->uri->segment(4);
     //      $where = array(
     //           'commande_id' => $commande_id
     //      );
     //      $this->set_data('datagrid', $this->produit_model->search($where));
     //      $this->add_data('content', $this->load->view('produit/list', $this->get_data(), true));
     //      $this->load->view('back/layout',$this->get_data());
     // }

     // public function update()
     // {
     //      if(isPostBack())
     //      {
     //           if($this->commande_model->update()){
     //                set_notification(array(
     //                     'type'=>'success',
     //                     'message'=>"La commande a été modifié !"
     //                ));
     //           }else{
     //                set_notification(array(
     //                     'type'=>'danger',
     //                     'message'=>"La commande n'a pas été modifié !"
     //                ));
     //           }
     //      }
     //      redirect("stock/commande");
     // }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->commande_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La commande a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La commande n'a pas été supprimé !"
                    ));
               }
          }
          redirect("commande");
     }

}
