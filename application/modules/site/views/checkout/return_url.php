<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/paydunya/paydunya.php';

//A insérer dans le fichier du code source qui doit effectuer l'action

// PayDunya rajoutera automatiquement le token de la facture sous forme de QUERYSTRING "token"
// si vous avez configuré un "return_url" ou "cancel_url".
// Récupérez donc le token en pur PHP via $_GET['token']
$token = $_GET['token'];

$invoice = new Paydunya_Checkout_Invoice();
if ($invoice->confirm($token)) {

     // Récupérer le statut du paiement
     // Le statut du paiement peut être soit completed, pending, cancelled
     echo $invoice->getStatus();

     // Vous pouvez récupérer le nom, l'adresse email et le
     // numéro de téléphone du client en utilisant
     // les méthodes suivantes
     echo $invoice->getCustomerInfo('name');
     echo $invoice->getCustomerInfo('email');
     echo $invoice->getCustomerInfo('phone');

     // Les méthodes qui suivent seront disponibles si et
     // seulement si le statut du paiement est égal à "completed".

     // Récupérer l'URL du reçu PDF électronique pour téléchargement
     echo $invoice->getReceiptUrl();

     // Récupérer n'importe laquelle des données personnalisées que
     // vous avez eu à rajouter précédemment à la facture.
     // Merci de vous assurer à utiliser les mêmes clés que celles utilisées
     // lors de la configuration.
     echo $invoice->getCustomData("categorie");
     echo $invoice->getCustomData("periode");
     echo $invoice->getCustomData("numero_gagnant");
     echo $invoice->getCustomData("prix");

     // Vous pouvez aussi récupérer le montant total spécifié précédemment
     echo $invoice->getTotalAmount();

}else{
     echo $invoice->getStatus();
     echo $invoice->response_text;
     echo $invoice->response_code;
}
