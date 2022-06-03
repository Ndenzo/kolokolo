<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SendIT extends IBEMS_Model{

     protected $mail;

     public function __construct(array $config = array()) {
          require_once(APPPATH . 'third_party/PHPMailer/PHPMailerAutoload.php');
          /*require_once(APPPATH.'third_party/Mailer/src/Exception.php');
          require_once(APPPATH.'third_party/Mailer/src/PHPMailer.php');
          require_once(APPPATH.'third_party/Mailer/src/SMTP.php');*/
          //$CI = get_instance();
          $this ->mail = new PHPMailer();
          return $this;
     }
     public function send_mail($view, $objet, $to, $lastname, $firstname, $args = array()) {
          $this->mail->clearAddresses();
          $this->mail->clearAttachments();
          //$this->mail = new PHPMailer();
          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465;                   // SMTP port to connect to GMail
          $this->mail->Username   = "contact@capital-acs.com";  // user email address
          $this->mail->Password   = "acscapitalgroup1";            // password in GMail
          $this->mail->SetFrom('contact@capital-acs.com', 'ACS-CAPITAL');  //Who is sending the email
          $this->mail->AddReplyTo('contact@capital-acs.com','ACS-CAPITAL');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/custom/img/logo/logo_outline.png'),'logo','logo.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/facebook.png'), 'facebook','facebook.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/linkedin.png'), 'linkedin','linkedin.png', "base64", "image/png");
          // $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/success.png'),'success','success.png',"base64", "image/png");
          // foreach ($args as $key => $attachment) {
          //      $this->mail->AddAttachment($attachment);
          // }
          // foreach ($products as $product) {
          //      $this->mail->AddStringEmbeddedImage(file_get_contents(_url().$product->type_pack_image), $product->type_pack_code, $product->type_pack_code.'.png', "base64", "image/png");
          // }
          $this->mail->Body       = $view;
          $this->mail->AltBody    = "";
          $destino = $to; // Who is addressed the email to
          $this->mail->AddAddress($destino, $firstname." ".$lastname);
          //$this->mail->addCC('julie.bally@april.com');
          // if (HTTP_HOST!=DOMAIN_NAME){
          //      $this->mail->addBCC('ndene.diahame@gmail.com');
          // }else{
               // $this->mail->addBCC('ndene.diahame@gmail.com');
               $this->mail->addBCC('contact@capital-acs.com');
          // }

          //$this->mail->addBCC('fatou.diagne@april.com');

          // if(!$this->mail->Send()) {
          //      $data["message"] = "Error: " . $this->mail->ErrorInfo;
          // } else {
          //      $data["message"] = "Message sent correctly!";
          // }
          // print_r($data["message"]);

          return $this->mail->Send();
     }

     public function send_mail_2($view, $objet, $to, $args = array()) {
          $this->mail->clearAddresses();
          $this->mail->clearAttachments();
          $this->mail->SMTPDebug = false;

          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465;                   // SMTP port to connect to GMail
          $this->mail->Username   = "contact@capital-acs.com";  // user email address
          $this->mail->Password   = "acscapitalgroup1";            // password in GMail
          $this->mail->SetFrom('contact@capital-acs.com', 'ACS-CAPITAL');  //Who is sending the email
          $this->mail->AddReplyTo('contact@capital-acs.com','ACS-CAPITAL');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/custom/img/logo/logo_outline.png'),'logo','logo.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/facebook.png'), 'facebook','facebook.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/linkedin.png'), 'linkedin','linkedin.png', "base64", "image/png");

          // if (HTTP_HOST!=DOMAIN_NAME){
          //      $this->mail->addBCC('ndene.diahame@gmail.com');
          // }else{
               // $this->mail->addBCC('ndene.diahame@gmail.com');
               $this->mail->addBCC('contact@capital-acs.com');
          // }

          $this->mail->Body       = $view;
          $this->mail->AltBody    = "";
          $destino = $to; // Who is addressed the email to
          $this->mail->AddAddress($destino, $to);
          $this->mail->addBCC('ndene.diahame@gmail.com');
          if(!$this->mail->Send()) {
               return false;
          } else {
               return true;
          }
     }

     public function send_mail_studie($view, $objet, $to, $args = array()) {
          $this->mail->clearAddresses();
          $this->mail->clearAttachments();
          $this->mail->SMTPDebug = false;

          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465;                   // SMTP port to connect to GMail
          $this->mail->Username   = "contact@capital-acs.com";  // user email address
          $this->mail->Password   = "acscapitalgroup1";            // password in GMail
          $this->mail->SetFrom('contact@capital-acs.com', 'ACS-CAPITAL');  //Who is sending the email
          $this->mail->AddReplyTo('contact@capital-acs.com','ACS-CAPITAL');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/custom/img/logo/logo_outline.png'),'logo','logo.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/facebook.png'), 'facebook','facebook.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/linkedin.png'), 'linkedin','linkedin.png', "base64", "image/png");
          if (HTTP_HOST!=DOMAIN_NAME){
               $this->mail->addBCC('ndene.diahame@gmail.com');
          }else{
               // $this->mail->addBCC('contact.langack@gmail.com');
               $this->mail->addBCC('contact@capital-acs.com');
          }
          foreach ($args as $key => $attachment) {
               $this->mail->AddAttachment(platform_slashes($attachment));
          }
          $this->mail->Body       = $view;
          $this->mail->AltBody    = "";
          $destino = $to; // Who is addressed the email to
          $this->mail->AddAddress($destino, $to);
          //$this->mail->addBCC('ndene.diahame@gmail.com');
          if(!$this->mail->Send()) {
               return false;
          } else {
               return true;
          }
     }

     public function send_contact() {
          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "aprilapps.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465;                   // SMTP port to connect to GMail
          $this->mail->Username   = "Support@aprilapps.com";  // user email address
          $this->mail->Password   = "W7lMIvexgSVV";            // password in GMail

          $message =  $this->input->post('message');
          $objet =  $this->input->post('objet');
          $prenoms =  $this->input->post('prenoms');
          $nom =  $this->input->post('nom');
          $email =  $this->input->post('email');
          if($this->input->post('genre') == 'F'){
               $genre = "Mme" ;
          }else {
               $genre ="M";
          }

          $phone =  $this->input->post('phone');

          $body = "
          <pre>
          nom : ".$genre." ".$prenoms." ".$nom."
          email : ".$email."
          phone : ".$phone."

          ".$message."
          </pre>
          ";

          $this->mail->SetFrom('support@aprilapps.com', 'april-africa');  //Who is sending the email
          $this->mail->AddReplyTo('support@aprilapps.com','april-africa');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->Body       = $body;
          $this->mail->AltBody    = "Plain text message";
          $destino = "contact-sn@april.com"; // Who is addressed the email to
          $this->mail->AddAddress($destino, $prenoms." ".$nom);
          $this->mail->addCC('julie.bally@april.com');
          $this->mail->addCC('fatou.diagne@april.com');

          if(!$this->mail->Send()) {
               $data["message"] = "Error: " . $this->mail->ErrorInfo;
          } else {
               $data["message"] = "Message sent correctly!";
          }
          print_r($data);
     }

     public function simple_message($body, $objet){
          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "aprilapps.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465;                   // SMTP port to connect to GMail
          $this->mail->Username   = "Support@aprilapps.com";  // user email address
          $this->mail->Password   = "W7lMIvexgSVV";            // password in GMail

          $this->mail->SetFrom('support@aprilapps.com', 'april-africa');  //Who is sending the email
          $this->mail->AddReplyTo('support@aprilapps.com','april-africa');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->Body       = $body;
          $this->mail->AltBody    = "Plain text message";
          $destino = "ndenz28@gmail.com"; // Who is addressed the email to
          $this->mail->AddAddress($destino, 'contact');
          /*$this->mail->addCC('julie.bally@april.com');
          $this->mail->addCC('fatou.diagne@april.com');*/

          if(!$this->mail->Send()) {
               $data["message"] = "Error: " . $this->mail->ErrorInfo;
          } else {
               $data["message"] = "Message sent correctly!";
          }
          print_r($data);
     }

     public function simple_message_client($body, $objet, $destino){
          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "aprilapps.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465;                   // SMTP port to connect to GMail
          $this->mail->Username   = "Support@aprilapps.com";  // user email address
          $this->mail->Password   = "W7lMIvexgSVV";            // password in GMail

          $this->mail->SetFrom('support@aprilapps.com', 'april-africa');  //Who is sending the email
          $this->mail->AddReplyTo('support@aprilapps.com','april-africa');  //email address that receives the response
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/frontend/images/bg/coming-end.png'),'produit','produit.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/pages/img/frontend/logo-april-africa.png'),'logo','logo.png',"base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/mail/facebook.png'), 'facebook','facebook.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/mail/linkedin.png'), 'linkedin','linkedin.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/mail/marker.png'), 'marker','marker.png', "base64", "image/png");
          $this->mail->Subject    = $objet;
          $this->mail->Body       = $body;
          $this->mail->AltBody    = "Plain text message";
          $destino = "ndenz28@gmail.com"; // Who is addressed the email to
          $this->mail->AddAddress($destino, 'contact');
          /*$this->mail->addCC('julie.bally@april.com');
          $this->mail->addCC('fatou.diagne@april.com');*/

          if(!$this->mail->Send()) {
               $data["message"] = "Error: " . $this->mail->ErrorInfo;
          } else {
               $data["message"] = "Message sent correctly!";
          }
          print_r($data);
     }
}
