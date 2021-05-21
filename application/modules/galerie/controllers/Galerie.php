<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galerie extends IBEMS_Controller {

     protected $__galerie_id;

     public function __construct()
     {
          parent::__construct();
          $this->__galerie_id = $this->input->get('galerie_id');
          $this->load->model('galerie_model');
          $this->set_data('title', 'reff | galerie_list');
          $this->set_data('page_title', 'galerie');
          $this->set_data('base_url', '../');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->galerie_model->get_all());
          $this->add_data('content', $this->load->view('galeries/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $this->add_data('content', $this->load->view('galeries/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showGalerie()
     {
          $galerie_id = (int)$this->uri->segment(4);
          $this->set_data('galerie_id', $galerie_id);
          $this->set_data('photos', $this->galerie_model->get_photo_galerie($galerie_id));
          $this->add_data('content', $this->load->view('galeries/galerie', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $galerie_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->galerie_model->get_one($galerie_id));
          $this->add_data('content', $this->load->view('galeries/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $galerie_id = (int)$this->uri->segment(4);
          $this->set_data('galerie_id', $this->galerie_model->get_one($galerie_id)->galerie_id);
          $this->add_data('content', $this->load->view('galeries/remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProduct()
     {
          $galerie_id = (int)$this->uri->segment(4);
          $where = array(
               'galerie_id' => $galerie_id
          );
          $this->set_data('datagrid', $this->produit_model->search($where));
          $this->add_data('content', $this->load->view('produit/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->galerie_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La galerie a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La galerie n'a pas été enregistré !"
                    ));
               }
          }
          redirect("galerie");
     }

     public function upload_images()
     {
          $galerie_id = (int)$this->uri->segment(4);
          if($this->galerie_model->upload_images($galerie_id)){
               set_notification(array(
                    'type'=>'success',
                    'message'=>"Les photos ont été enregistré !"
               ));
          }else{
               set_notification(array(
                    'type'=>'danger',
                    'message'=>"Les photos n'ont pas été enregistré !"
               ));
          }

          redirect("galerie");
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->galerie_model->update()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La galerie a été modifié !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La galerie n'a pas été modifié !"
                    ));
               }
          }
          redirect("galerie");
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->galerie_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"La galerie a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"La galerie n'a pas été supprimé !"
                    ));
               }
          }
          redirect("galerie");
     }

     public function deletePhoto()
     {
          if($this->galerie_model->delete_photo()){
               set_notification(array(
                    'type'=>'success',
                    'message'=>"La photo a été supprimé !"
               ));
          }else{
               set_notification(array(
                    'type'=>'danger',
                    'message'=>"La photo n'a pas été supprimé !"
               ));
          }
          redirect("galerie/galerie/showGalerie/".$this->__galerie_id);
     }

}
