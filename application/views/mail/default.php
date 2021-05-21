<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Xolo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
     <meta name="keywords" content="admin template, Xolo admin template, dashboard template, flat admin template, responsive admin template, web app">
     <meta name="author" content="pixelstrap">
     <link rel="icon" href="<?php _url(); ?>assets/back/images/favicon.png" type="image/x-icon">
     <link rel="shortcut icon" href="<?php _url(); ?>assets/back/images/favicon.png" type="image/x-icon">
     <title>ArmandKoffi - Email</title>
     <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <style type="text/css">
     body{
          font-family: work-Sans, sans-serif;
          background-color: white;
          display: block;
     }
     a{
          text-decoration: none;
     }
     span {
          font-size: 14px;
     }
     p {
          font-size: 13px;
          line-height: 1.7;
          letter-spacing: 0.7px;
          margin-top: 0;
     }
     .text-center{
          text-align: center;
     }
     .footer-social-icon tr td img{
          margin-left:5px;
          margin-right:5px;
     }
     .main-bg-light{
          background-color: #fafafa;
          box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);
     }
     </style>
</head>
<body style="margin: 30px auto;">
     <table style="width: 100%; width:650px; margin-left: auto; margin-right: auto; background-color: #f6f7fb;">
          <tbody>
               <tr>
                    <td>
                         <table style=" background-color: white; width: 100%">
                              <tbody>
                                   <tr>
                                        <td>
                                             <table style="width: 650px; margin-left:0 auto;">
                                                  <tbody>
                                                       <tr>
                                                            <td><img src="cid:logo" alt="" width="90"></td>
                                                            <td style="text-align: right; color:#999">Ne répondez pas à ce mail !</td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                             <table class="main-bg-light">
                                                  <tbody>
                                                       <tr>
                                                            <td style="padding: 30px; width: 650px;">
                                                                 <?= $content ?>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                             <table class="main-bg-light text-center top-0" align="center" border="0" cellpadding="0" cellspacing="0" style="width: 650px;">
                                                  <tbody>
                                                       <tr>
                                                            <td style="padding: 30px;">
                                                                 <div>
                                                                      <h4 class="title" style="margin:0; text-align: center;">Suivez nous</h4>
                                                                 </div>
                                                                 <table class="footer-social-icon" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:20px;">
                                                                      <tbody>
                                                                           <tr style="text-align: center;">
                                                                                <td><a href="https://www.facebook.com/GarmandKoffi" target="_blank"><img src="cid:facebook" alt=""></a></td>
                                                                                <td><a href="https://www.youtube.com/channel/UCNiSFxJCfFO8WUxKRIMgF_Q" target="_blank"><img src="cid:youtube" alt=""></a></td>
                                                                                <td><a href="https://instagram.com/armand.koffi.officiel?igshid=l9muz31dtm47" target="_blank"><img src="cid:instagram" alt=""></a></td>

                                                                                <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/youtube.png" alt=""></a></td> -->
                                                                                <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/twitter.png" alt=""></a></td> -->
                                                                                <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/gplus.png" alt=""></a></td> -->
                                                                                <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/pinterest.png" alt=""></a></td> -->
                                                                           </tr>
                                                                      </tbody>
                                                                 </table>
                                                                 <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
                                                                 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;">
                                                                      <tbody>
                                                                           <tr>
                                                                                <!-- <td><a href="#" style="font-size:13px">Want to change how you receive these emails?</a></td> -->
                                                                           </tr>
                                                                           <tr>
                                                                                <td>
                                                                                     <p style="font-size:13px; margin:0; text-align:center;">&copy; Copyrights <?= gmdate('Y') ?> ArmandKoffi All rights reserved.</p>
                                                                                </td>
                                                                           </tr>
                                                                           <tr>
                                                                                <!-- <td><a href="#" style="font-size:13px; margin:0;text-decoration: underline;">Unsubscribe</a></td> -->
                                                                           </tr>
                                                                      </tbody>
                                                                 </table>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </td>
               </tr>
          </tbody>
     </table>
</body>
</html>
