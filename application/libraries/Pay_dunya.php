<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/paydunya/paydunya.php';

class Pay_dunya extends paydunya{

     public function config($path){
          Paydunya_Setup::setMasterKey("ImXS0hIV-C0RD-xUc7-FARL-N7fUQgnoZXsu");

          $mode = "live";
          if($mode == "live"){
               Paydunya_Setup::setPublicKey("live_public_HI9I8TWjQYvYmFLpTiZoZKNPY3A");
               Paydunya_Setup::setPrivateKey("live_private_vOzqJcUxYRFCFajEhomivQP9OuC");
               Paydunya_Setup::setToken("GS5APV1YO7dUbC4P47KZ");
          }else{
               Paydunya_Setup::setPublicKey("test_public_9lb5eTLVHKfpOfXaNTgS6MtTSLG");
               Paydunya_Setup::setPrivateKey("test_private_5Jmr593BI08hCWpXZFk3zc2vmT8");
               Paydunya_Setup::setToken("jdhF5e7Cj27KbxUkcXbB");
          }



          Paydunya_Setup::setMode("live");
          //Configuration des informations de votre service/entreprise
          Paydunya_Checkout_Store::setName("APRIL Africa"); // Seul le nom est requis
          Paydunya_Checkout_Store::setTagline("L'assurance en plus facile");
          Paydunya_Checkout_Store::setPhoneNumber("33 864 27 00");
          Paydunya_Checkout_Store::setPostalAddress("N°2118, Liberté 3 - Avenue Bourguiba, Dakar");
          Paydunya_Checkout_Store::setWebsiteUrl("https://april-sn.com");
          Paydunya_Checkout_Store::setLogoUrl("http://april-africa.com/sites/default/files/domain_logo/header_logo/logo-april-africa.png");
          Paydunya_Checkout_Store::setReturnUrl("https://april-sn.com/site/".$path);
          Paydunya_Checkout_Store::setCancelUrl("https://april-sn.com/site/".$path);

     }

     public function set_trans($items, $taxes, $path){

          // Initialisation du mode de paiement PAR
          $invoice = new Paydunya_Checkout_Invoice();

          // Definition du montant de la facture total
          $total_fact = 0;

          // Definition des options de la facture
          if(!empty($items)){
               foreach ($items as $item) {
                    $invoice->addItem($item[0], $item[1], $item[2], $item[3], $item[4]);
                    $total_fact = $total_fact + $item[3];
               }
          }

          if (!empty($taxes)) {
               foreach ($taxes as $taxe) {
                    if($taxe[0] == 'Reduction'){
                         $invoice->addTax($taxe[0], '-'.$taxe[1]);
                         $total_fact = $total_fact - $taxe[1];
                    }else{
                         $invoice->addTax($taxe[0], $taxe[1]);
                         $total_fact = $total_fact + $taxe[1];
                    }

               }
          }

          //$total_fact = 200;

          // Definition du montant total de la facture
          $invoice->setTotalAmount($total_fact);

          $Return_url = "https://april-sn.com/site/".$path;
          $Cancel_url = "https://april-sn.com/site/".$path;

          // URL en cas de confirmation
          $invoice->setReturnUrl($Return_url);

          // URL en cas d'annulation
          $invoice->setCancelUrl($Cancel_url);

          //qry_debug();
          self::config($path);
          /*$invoice->create();
          echo "<pre>";
          var_dump($invoice);
          echo"</pre>";*/
          if($invoice->create()) {
               header("location:".$invoice->getInvoiceUrl());
          }else{
               echo $invoice->response_text;
          }
     }

     public function token_checker($token){
          $invoice = new Paydunya_Checkout_Invoice();
          $invoice->confirm($token);
          if ($invoice->confirm($token)) {

               return true;

          }else{
               return false;
          }
     }

}

?>
