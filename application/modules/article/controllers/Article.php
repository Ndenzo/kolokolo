<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model('article_model');
          $this->set_data('title', 'reff | article_list');
          $this->set_data('page_title', 'article');
          $this->set_data('base_url', '../');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index()
     {
          $this->set_data('datagrid', $this->article_model->get_all());
          $this->add_data('content', $this->load->view('articles/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showAdd()
     {
          $this->add_data('content', $this->load->view('articles/add', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showEdit()
     {
          $article_id = (int)$this->uri->segment(4);
          $this->set_data('record', $this->article_model->get_one($article_id));
          $this->add_data('content', $this->load->view('articles/edit', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showRemove()
     {    $article_id = (int)$this->uri->segment(4);
          $this->set_data('article_id', $this->article_model->get_one($article_id)->article_id);
          $this->add_data('content', $this->load->view('articles/remove', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showProduct()
     {
          $article_id = (int)$this->uri->segment(4);
          $where = array(
               'article_id' => $article_id
          );
          $this->set_data('datagrid', $this->produit_model->search($where));
          $this->add_data('content', $this->load->view('produit/list', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->article_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"L'article a été enregistré !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"L'article n'a pas été enregistré !"
                    ));
               }
          }
          redirect("article");
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->article_model->update()){
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
          redirect("article");
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->article_model->delete()){
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
          redirect("article");
     }

}
