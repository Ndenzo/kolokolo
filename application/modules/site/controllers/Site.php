<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          if(@$this->session->lang == null){
               $this->session->lang = "gb";
          }
     }

     public function index()
     {
          $products_fr = array(
               "sms" => "Nos services SMS vous permettront d’avoir des communications textuelles efficaces à vos clients ou à vos bénéficiaires quand ils en ont le plus besoin.
               Nous vous permettons d’accompagner vos cibles en leur donnant les meilleures informations via SMS.
               Nos API SMS, faciles à utiliser et fiables, vous offrent une grande variété de moyens pour ajouter des messages texte à vos applications mobiles et web.",
               "ivr" => "La voix programmable vous permet d'enrichir votre expérience d'appel en ajoutant des fonctionnalités qui auraient été inaccessibles en utilisant les lignes physiques normales.
               Notre service IVR complet vous offre un grand nombre d'actions que vous pouvez utiliser ensemble pour créer des solutions intuitives et atteindre des cibles lointaines à travers un simple téléphone.",
               "airtime" => "Nous offrons des services de distribution de temps d'antenne ou crédit téléphonique instantanément aux abonnés mobiles ou bénéficiaires avec des notifications instantanées en cas de livraison ou d'échec.
               L'utilisation de nos API de temps d'antenne permet d'obtenir des remises sur chaque transaction, ce qui vous permet de réaliser des économies.",
               "cash" => "Le transfert d’argent rapide, efficace et sans intermédiaire est l'un des canaux les plus efficaces pour effectuer des micro paiements à un grand nombre de personnes sur les marchés émergents.
               Elle permet aussi aux bénéficiaires de ne pas subir un cas d’escroquerie, de fraude ou de rétention de fonds. Notre plateforme permet de créer facilement une solution de ce type et de bénéficier de remises.",
               "data" => "La collecte de données sur le terrain, le partage d’informations importantes et la formation en ligne effective sont des moyens pour veiller sur la qualités des politiques d’interventions mais aussi apporter un système de gestion participative des populations.
               Notre plateforme permet d’avoir des données de qualité sur le terrain même dans les zones de haute tension avec un système de suivi très efficace.",
          );

          $products_gb = array(
               "sms" => "Our SMS services will allow you to have effective text communications to your customers or beneficiaries when they need it most.
               We allow you to support your targets by giving them the best information by SMS.
               Our easy-to-use and reliable SMS APIs allow you a wide variety of ways to add text messages to your mobile and web applications.",
               "ivr" => "Programmable voice allows you to enrich your calling experience by adding features that would have been inaccessible using normal physical lines.
               Our comprehensive IVR service gives you a large number of actions that you can use together to create intuitive solutions and reach distant targets through a simple phone.",
               "airtime" => "We offer airtime or airtime distribution services instantly to mobile subscribers or beneficiaries with instant notifications in case of delivery or failure.
               Using our airtime APIs results in discounts on every transaction, saving you money.",
               "cash" => "Fast, efficient, no-middleman money transfer is one of the most effective channels for making micro payments to large numbers of people in emerging markets.
               It also allows beneficiaries to avoid a case of fraud, fraud or withholding of funds. Our platform makes it easy to create such a solution and benefit from discounts.",
               "data" => "The collection of data in the field, the sharing of important information and effective online training are ways to ensure the quality of intervention policies but also to provide a participatory management system for populations.
               Our platform makes it possible to have quality data in the field even in high voltage areas with a very efficient monitoring system.",
          );
          if ($this->session->lang == "fr") {
               $this->set_data('products', $products_fr);
          }else {
               $this->set_data('products', $products_gb);
          }
          $this->set_data('title', "Home");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/home', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function about()
     {
          $this->set_data('title', "A Propos");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/about', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function pricing()
     {
          $this->set_data('title', "Prix");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/pricing', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function blogs()
     {
          $this->db->select('*');
          $this->db->from('articles');
          $this->db->order_by('article_id', 'desc');
          $articles = $this->db->get()->result();

          $this->set_data('articles', $articles);
          $this->set_data('title', "Blogs");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/blog', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function blog_detail()
     {
          $id = (int)$this->uri->segment(2);
          $this->db->select('*');
          $this->db->from('articles');
          $this->db->where('article_id', $id);
          $article = $this->db->get()->row();

          $this->set_data('article', $article);
          $this->set_data('title', $article->article_name);
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/blog_detail', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function market()
     {
          $markets = array(
               array(
                    "name" => "Wave",
                    "desc" => "Transfert d'argent à 1% seulement Dépôts et retraits gratuits chez Wave à travers le Sénégal et la Côte D'Ivoire Paiements de factures GRATUITS.",
                    "link" => "https://www.wave.com/fr/",
                    "logo" => "images/marketplace/wave_logo_1.png"
               ),
               array(
                    "name" => "Paydunya",
                    "desc" => "Développez votre potentiel grâce à nos solutions de paiements digitaux <br> Pionnier - Sécurisé - Performant",
                    "link" => "https://paydunya.com/",
                    "logo" => "images/marketplace/paydunya_logo_2.png"
               ),
               array(
                    "name" => "Infobip",
                    "desc" => "Concevez et orchestrez intelligemment toutes les activités d'engagement à travers vos parcours clients grâce à une plateforme de communication complète, évolutive et facile à utiliser.",
                    "link" => "https://www.infobip.com/",
                    "logo" => "images/marketplace/infobip_logo_1.png"
               ),
               array(
                    "name" => "Twilio",
                    "desc" => "Twilio permet de personnaliser les interactions et de rendre les communications internationales fiables pour que vous engagiez vos clients.",
                    "link" => "https://www.twilio.com/fr/",
                    "logo" => "images/marketplace/twilio_logo_3.png"
               ),
               array(
                    "name" => "Wizzall Money",
                    "desc" => "Facilitez vous la vie avec le Wizall Money : payez vos factures et envoyez de l'argent à vos proches gratuitement.",
                    "link" => "https://www.wizallmoney.com/accueil",
                    "logo" => "images/marketplace/wizall_logo_2.png"
               ),
               array(
                    "name" => "Africa’s talking",
                    "desc" => "Africastalking fournit une variété de produits API de communication et de paiement qui sont tout ce dont vous avez besoin pour créer des solutions d'engagement mobile à fort impact.",
                    "link" => "https://africastalking.com/",
                    "logo" => "images/marketplace/talking_logo_1.png"
               ),
               array(
                    "name" => "Paypal",
                    "desc" => "Remboursez rapidement, facilement et de manière sécurisée. Si quelqu'un est parti faire vos courses, vous pouvez lui envoyer de l'argent en quelques secondes. Envoyez de l'argent à vos amis gratuitement dans l’EEE*.",
                    "link" => "https://www.paypal.com/fr/webapps/mpp/home",
                    "logo" => "images/marketplace/Paypal_logo_1.jpg"
               ),
               array(
                    "name" => "Free Money",
                    "desc" => "Free Money est un service de transfert d’argent national ouvert à tout client Free et qui lui permet d’envoyer de l’argent à ses proches dans tout le pays quel que soit son opérateur.",
                    "link" => "https://www.free.sn/free-money",
                    "logo" => "images/marketplace/freemoney_logo_1.png"
               ),
               array(
                    "name" => "Paps",
                    "desc" => "Que vous soyez une entreprise ou un e-commerçant, grâce à notre expertise, notre flotte multimodale et nos solutions axées sur la technologie, nous vous aidons à faire face aux challenges logistiques.",
                    "link" => "https://papslogistics.com/",
                    "logo" => "images/marketplace/paps_logo_1.png"
               ),
               array(
                    "name" => "Visa Card",
                    "desc" => "Mon e-Carte Bleue, ma carte virtuelle. Avec elle, je règle mes achats sur Internet sans avoir à communiquer mon numéro de carte Visa.",
                    "link" => "https://www.visa.fr/pay-with-visa/ma-carte-visa/e-carte-bleue.html",
                    "logo" => "images/marketplace/mastercard_logo_1.jpg"
               ),
          );
          $this->set_data('title', "Marketplace");
          $this->set_data('markets', $markets);
          $this->set_data('style', "dark");
          $this->add_data('content', $this->load->view($this->session->lang.'/marketplace', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function sms()
     {
          $this->set_data('title', "SMS");
          $this->set_data('style', "dark");
          $this->add_data('content', $this->load->view($this->session->lang.'/product_sms', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function ivr()
     {
          $this->set_data('title', "IVR");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/product_ivr', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function airtime()
     {
          $this->set_data('title', "Airtime");
          $this->set_data('style', "dark");
          $this->add_data('content', $this->load->view($this->session->lang.'/product_airtime', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function transfer()
     {
          $this->set_data('title', "Cash Transfer");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/product_transfer', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function collection()
     {
          $this->set_data('title', "Collection");
          $this->set_data('style', "default");
          $this->add_data('content', $this->load->view($this->session->lang.'/product_collection', $this->get_data(), true));
          $this->load->view('front/'.$this->session->lang.'/layout',$this->get_data());
     }

     public function change_lang(){
          $this->session->lang = $this->input->get('lang');
          redirect('/');
     }



}
