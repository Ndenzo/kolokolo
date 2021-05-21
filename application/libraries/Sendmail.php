<?php defined('BASEPATH') OR exit('No direct script access allowed.');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH.'third_party/Mailer/src/Exception.php';
require APPPATH.'third_party/Mailer/src/PHPMailer.php';
require APPPATH.'third_party/Mailer/src/SMTP.php';

class Sendmail  {
    protected  $__mail;
    public function __construct()
    {
        $CI = get_instance();
        $CI->mail = new PHPMailer(true);
        //$CI->mail->SMTPDebug = 2;                   // Enable verbose debug output
        $CI->mail->isSMTP();                        // Set mailer to use SMTP
        $CI->mail->Host = 'aprilapps.com';          // Specify main and backup SMTP servers
        $CI->mail->SMTPAuth = true;                 // Enable SMTP authentication
        $CI->mail->Username = 'test@aprilapps.com'; // SMTP username
        $CI->mail->Password = 'Ev@ngel10n';         // SMTP password
        $CI->mail->SMTPSecure = 'ssl';              // Enable TLS encryption, `ssl` also accepted
        $CI->mail->Port = 465;                      // TCP port to connect to
        return $this;
        /*try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'aprilapps.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'test@aprilapps.com';                 // SMTP username
            $mail->Password = 'Ev@ngel10n';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('test@aprilapps.com', 'Mailer');
            $mail->addAddress('cyrkakou@gmail.com', 'Joe User');     // Add a recipient
            $mail->addAddress('ellen@gmail.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cyrkakou@gmail.com');
            $mail->addBCC('cyrkakou@gmail.com');
            //

            //and on the <img> tag put src='cid:logo_2u'

            //Attachments
            $mail->addAttachment(platform_slashes('dossiers/contrat_PCA022000082.pdf'));
            $mail->addAttachment(platform_slashes('dossiers/facture_PCA022000082.pdf'));// Add attachments
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            //$mail->Body    = file_get_contents(platform_slashes('dossiers/index.html'));


            $mail->AddEmbeddedImage(base_url('auto.png'), 'logoimg', 'auto.png'); // attach file logo.jpg, and later link to it using identfier logoimg
            $mail->msgHTML ("<h1>Test 1 of PHPMailer html</h1><p>This is a test picture: <img src=\"cid:logoimg\" /></p>");



            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }*/
    }


}
