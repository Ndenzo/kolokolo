<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model(array(
               "site_model",
               "contact/contact_model",
               "meet/meet_model"
          ));
          $this->set_data('rx_links',  $this->site_model->get_rx_links());
     }

     public function index()
     {
          $this->set_data('title', "Accueil");
          $this->set_data('main', true);
          $this->set_data('blogs',  $this->site_model->get_blogs(3));
          // $this->set_data('singles',  $this->site_model->get_singles());
          $this->set_data('realisations',  $this->site_model->get_realisations(6));

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('home',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function biographie()
     {
          $this->set_data('title', "Biographie");
          $this->set_data('main', false);

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('biographie',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function blogs()
     {
          $this->set_data('title', "Blog");
          $this->set_data('main', false);
          $this->set_data('blogs',  $this->site_model->get_blogs());

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('blog',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function blog()
     {
          $id = $this->uri->segment(2);
          $this->set_data('main', false);
          $this->set_data('record', $this->site_model->get_blog($id));
          $this->set_data('title', $this->site_model->get_blog($id)->blog_name);
          $this->set_data('blogs',  $this->site_model->get_blogs(5));

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('blog_detail',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function download()
     {
          $code = $this->uri->segment(2);

          $this->set_data('title', "Télécharger");
          $this->set_data('main', false);
          $this->set_data('download',  $this->site_model->get_download($code));
          $this->set_data('singles',  $this->site_model->get_singles());
          $this->set_data('streams',  $this->site_model->get_streams());

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('download',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function evenement()
     {
          $this->set_data('title', "Evenement");
          $this->set_data('main', false);
          $this->set_data('evenements',  $this->site_model->get_evenements());

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('evenement',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function media()
     {
          $this->set_data('title', "Media");
          $this->set_data('main', false);
          $this->set_data('medias',  $this->site_model->get_medias());

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('media',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function contact()
     {
          $this->set_data('title', "Contact");
          $this->set_data('main', false);

          $this->add_data('menu', $this->load->view('front/menu',$this->get_data(), true));
          $this->add_data('content', $this->load->view('contact',$this->get_data(), true));
          $this->load->view('front/layout',$this->get_data());
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->contact_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Merci de vous être inscrit à notre newsletter ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('/');
     }

     public function insert_meet()
     {
          if(isPostBack())
          {
               if($this->meet_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Merci d'avoir pris rendez-vous. Nous vous contacterons ultérieurement ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Une erreur est survenue veuillez réessayer ultérieurement !"
                    ));
               }
          }
          redirect('/');
     }

     public function send_contact_mail()
     {
          if(isPostBack())
          {
               if($this->site_model->send_contact_mail()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Merci, Votre mail a été bien reçu ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('/');
     }

     public function insert_payment()
     {
          if(isPostBack())
          {
               if($this->site_model->insert_payment()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Merci pour votre achat ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
               }
          }
          redirect('/');
     }

     public function check_paydunya_token()
     {
          $this->site_model->check_paydunya_token();
          set_notification(array(
               'type'=>'success',
               'message'=>"<p style='color:grey;'>Votre achat a été pris en compte. Veuillez consultez votre boite de réception pour le téléchargement. Dans le cas où vous ne voyez pas le mail, veuillez vérifiez vos <strong>SPAMS</strong> ! </p>"
          ));
          redirect('/');
     }
}
