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
          $this->mail = new PHPMailer();
          return $this;
     }
     public function send_mail($view, $objet, $to, $lastname, $firstname, $args = array()) {
          $this->mail->clearAddresses();
          $this->mail->clearAttachments();
          //$this->mail = new PHPMailer();
          //$this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "mail48.lwspanel.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 465 ;                   // SMTP port to connect to GMail
          $this->mail->Username   = "contact@armandkoffi.com";  // user email address
          $this->mail->Password   = "eD2!WB8V8J";            // password in GMail
          $this->mail->SetFrom('contact@armandkoffi.com', 'ArmandKoffi');  //Who is sending the email
          $this->mail->AddReplyTo('contact@armandkoffi.com','ArmandKoffi');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/front/img/main/logo_icon.png'),'logo','logo.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/img/email-template/facebook.png'), 'facebook','facebook.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/img/email-template/youtube.png'), 'youtube','youtube.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/img/email-template/instagram.jpg'), 'instagram','instagram.jpg', "base64", "image/jpg");
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
          if (HTTP_HOST!=DOMAIN_NAME){
               $this->mail->addBCC('ndene.diahame@gmail.com');
          }else{
               $this->mail->addBCC('contact@armandkoffi.com');
               $this->mail->addBCC('ndene.diahame@gmail.com');
          }

          //$this->mail->addBCC('fatou.diagne@april.com');

          // if(!$this->mail->Send()) {
          //      $data["message"] = "Error: " . $this->mail->ErrorInfo;
          // } else {
          //      $data["message"] = "Message sent correctly!";
          // }
          // print_r($data["message"]);

          return $this->mail->Send();
     }

     public function send_mail_from_contact($view, $objet, $to, $name, $args = array()) {
          $this->mail->clearAddresses();
          $this->mail->clearAttachments();
          //$this->mail = new PHPMailer();
          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "mail48.lwspanel.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 587;                   // SMTP port to connect to GMail
          $this->mail->Username   = "contact@armandkoffi.com";  // user email address
          $this->mail->Password   = "eD2!WB8V8J";            // password in GMail
          $this->mail->SetFrom('contact@armandkoffi.com', 'ArmandKoffi');  //Who is sending the email
          $this->mail->AddReplyTo('contact@armandkoffi.com','ArmandKoffi');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/custom/img/logo/logoh.png'),'logo','logo.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/facebook.png'), 'facebook','facebook.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/linkedin.png'), 'youtube','linkedin.png', "base64", "image/png");
          $this->mail->AddStringEmbeddedImage(file_get_contents(_url().'assets/back/images/email-template/linkedin.png'), 'instagram','linkedin.png', "base64", "image/png");

          $this->mail->Body       = $view;
          $this->mail->AltBody    = "";
          $destino = $to;
          $this->mail->AddAddress($destino, "Contact");

          return $this->mail->Send();
     }

     public function send_contact() {
          $this->mail->clearAddresses();
          $this->mail->clearAttachments();

          $this->mail->IsSMTP(); // we are going to use SMTP
          $this->mail->IsHTML(true);
          $this->mail->SMTPAuth   = true; // enabled SMTP authentication
          $this->mail->CharSet    = 'UTF-8';
          $this->mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
          $this->mail->Host       = "mail48.lwspanel.com";      // setting GMail as our SMTP server
          $this->mail->Port       = 587;                   // SMTP port to connect to GMail
          $this->mail->Username   = "contact@armandkoffi.com";  // user email address
          $this->mail->Password   = "eD2!WB8V8J";            // password in GMail

          $message =  $this->input->post('contact_content');
          $nom =  $this->input->post('contact_name');
          $email =  $this->input->post('contact_email');

          $objet =  $this->input->post('contact_object');

          $body = "
          <pre>
          name : ".$nom."
          email : ".$email."

          ".$message."
          </pre>
          ";

          $this->mail->SetFrom('contact@armandkoffi.com', 'ArmandKoffi');  //Who is sending the email
          $this->mail->AddReplyTo('contact@armandkoffi.com','ArmandKoffi');  //email address that receives the response
          $this->mail->Subject    = $objet;
          $this->mail->Body       = $body;
          $this->mail->AltBody    = "Plain text message";
          $destino = "contact@armandkoffi.com"; // Who is addressed the email to
          $this->mail->AddAddress($destino, $nom);

          return $this->mail->Send();

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
