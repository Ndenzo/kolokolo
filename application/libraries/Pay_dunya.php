<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/paydunya/paydunya.php';

class Pay_dunya extends paydunya{

     public function config($path){
          Paydunya_Setup::setMasterKey("SlfssKGM-ASQ2-uFn5-9jil-VC8aO5qbGBhL");

          $mode = "test";
          if($mode == "live"){
               Paydunya_Setup::setPublicKey("live_public_Sep3AQ2vnM9Ps68iQdGHPkIC081");
               Paydunya_Setup::setPrivateKey("live_private_qY7umTKQ6T6XRJtPUykeAaZrynu");
               Paydunya_Setup::setToken("wDbVdQp5I0syXLQZwjik");
          }else{
               Paydunya_Setup::setPublicKey("test_public_A7jqNzyRkSoLLEOxbGaO3C8raHJ");
               Paydunya_Setup::setPrivateKey("test_private_h5IYzopZ1UqC3ongXT23GGLWPiL");
               Paydunya_Setup::setToken("S2mpZlCBUqo7ro0H082e");
          }



          Paydunya_Setup::setMode($mode);
          //Configuration des informations de votre service/entreprise
          Paydunya_Checkout_Store::setName("ArmandKoffi"); // Seul le nom est requis
          Paydunya_Checkout_Store::setTagline("Mon site");
          Paydunya_Checkout_Store::setPhoneNumber("78 478 35 10");
          Paydunya_Checkout_Store::setPostalAddress("OUAKAM CITE AVION, Dakar");
          Paydunya_Checkout_Store::setWebsiteUrl("https://www.armandkoffi.com");
          Paydunya_Checkout_Store::setLogoUrl("https://www.armandkoffi.com/assets/front/img/main/logo.png");
          Paydunya_Checkout_Store::setReturnUrl("https://www.armandkoffi.com/site/".$path);
          Paydunya_Checkout_Store::setCancelUrl("https://www.armandkoffi.com/site/".$path);

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

          $Return_url = "https://www.armandkoffi.com/site/".$path;
          $Cancel_url = "https://www.armandkoffi.com/site/".$path;

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
          if ($invoice->confirm($token)) {
               return true;
          }else{
               return false;
          }
     }

}

?>
