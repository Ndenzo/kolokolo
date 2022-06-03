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
     <title>Langack - Email</title>
     <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <style type="text/css">
     body{
          text-align: center;
          margin: 0 auto;
          width: 650px;
          font-family: work-Sans, sans-serif;
          background-color: #f6f7fb;
          display: block;
     }
     ul{
          margin:0;
          padding: 0;
     }
     li{
          display: inline-block;
          text-decoration: unset;
     }
     a{
          text-decoration: none;
     }
     p{
          margin: 15px 0;
     }
     h5{
          color:#444;
          text-align:left;
          font-weight:400;
     }
     .text-center{
          text-align: center
     }
     .main-bg-light{
          background-color: #fafafa;
          box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);
     }
     .title{
          color: #444444;
          font-size: 22px;
          font-weight: bold;
          margin-top: 10px;
          margin-bottom: 10px;
          padding-bottom: 0;
          text-transform: uppercase;
          display: inline-block;
          line-height: 1;
     }
     table{
          margin-top:30px
     }
     table.top-0{
          margin-top:0;
     }
     table.order-detail , .order-detail th , .order-detail td {
          border: 1px solid #ddd;
          border-collapse: collapse;
     }
     .order-detail th{
          font-size:16px;
          padding:15px;
          text-align:center;
     }
     .footer-social-icon tr td img{
          margin-left:5px;
          margin-right:5px;
     }
     </style>
</head>
<body style="margin: 20px auto;">
     <table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 0 30px;background-color: #fff; width:650px; margin-left: auto; margin-right: auto; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%; text-align:center;">
          <tbody>
               <tr>
                    <td>
                         <table align="center" border="0" cellpadding="0" cellspacing="0">
                              <tbody>
                                   <tr>
                                        <td>
                                             <table class="main-bg-light">
                                                  <tbody>
                                                       <tr>
                                                            <td style="padding: 30px; width: 650px;">
                                                                 <?= @$content ?>
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </td>
                                   </tr>
                                   <!-- <tr>
                                        <td><img src="cid:logo" alt="" style="margin-bottom: 30px; width: 300px; margin-left: auto; margin-right: auto;"></td>
                                   </tr> -->
                                   <tr>
                                        <td><img src="cid:logo" alt="" style="margin-top : 40px; width: 300px;"></td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <h2 class="title">thank you</h2>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <p>Your Payment Is Successfully Processed. </p>
                                             <p>Check your account to see your credits.</p>
                                             <!-- <p>Transaction ID: </p> -->
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                             <div style="border-top:1px solid #777;height:1px;margin-top: 30px;"></div>
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                         <table border="0" cellpadding="0" cellspacing="0" style="width:650px; margin-left: auto; margin-right: auto;">
                              <tbody>
                                   <tr>
                                        <td>
                                             <h2 class="title">YOUR ORDER DETAILS</h2>
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                         <table class="order-detail" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-bottom: 50px; width:650px;">
                              <tbody>
                                   <tr align="left">
                                        <th style="padding-left: 15px;">DESCRIPTION</th>
                                        <th>CREDITS</th>
                                        <th>PRICE</th>
                                        <th>TOTAL</th>
                                   </tr>
                                   <?php if(is_array(@$products)):?>
                                        <?php $total = 0; ?>
                                        <?php foreach(@$products as $product):?>
                                             <tr>
                                                  <td valign="top" style="padding-left: 15px;">
                                                       <h5 style="font-size: 14px; color:#444;"><?= @$product->settings_language_name ?></h5>
                                                  </td>
                                                  <td valign="top" style="padding-left: 15px; text-align:center;">
                                                       <h5 style="font-size: 14px; color:#444;"><?= @$product->customer_credit_value ?></h5>
                                                  </td>
                                                  <td valign="top" style="padding-left: 15px; text-align:center;">
                                                       <h5 style="font-size: 14px; color:#444;"><b><?= @$product->pricing_value ?>$</b></h5>
                                                  </td>
                                                  <td valign="top" style="padding-left: 15px; text-align:center;">
                                                       <h5 style="font-size: 14px; color:#444;"><b><?= (float) @$product->customer_credit_value * @$product->pricing_value?>$</b></h5>
                                                       <?php $total += (float) @$product->customer_credit_value * @$product->pricing_value ?>
                                                  </td>
                                             </tr>
                                        <?php endforeach;?>
                                   <?php endif;?>
                                   <tr>
                                        <td style="line-height: 49px;font-size: 13px;color: #000000; padding-left: 20px;text-align:left;border-right: unset;">TOTAL PAID :</td>
                                        <td class="price" colspan="3" style="line-height: 49px;text-align: right;padding-right: 28px;font-size: 13px;color: #000000;text-align:right;border-left: unset;"><b><?= @$total ?>$</b></td>
                                   </tr>
                              </tbody>
                         </table>
                    </td>
               </tr>
          </tbody>
     </table>
     <table class="main-bg-light text-center top-0" align="center" border="0" cellpadding="0" cellspacing="0" style="width: 650px;">
          <tbody>
               <tr>
                    <td style="padding: 30px;">
                         <div>
                              <h4 class="title" style="margin:0; text-align: center;">Follow us</h4>
                         </div>
                         <table class="footer-social-icon" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:20px;">
                              <tbody>
                                   <tr style="text-align: center;">
                                        <td><a href="https://web.facebook.com/Langack-103071558109063/?_rdc=1&_rdr" target="_blank"><img src="cid:facebook" alt=""></a></td>
                                        <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/youtube.png" alt=""></a></td> -->
                                        <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/twitter.png" alt=""></a></td> -->
                                        <!-- <td><a href="#"><img src="<?php _url(); ?>assets/back/images/email-template/gplus.png" alt=""></a></td> -->
                                        <td><a href="https://www.linkedin.com/company/langack/" target="_blank"><img src="cid:linkedin" alt=""></a></td>
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
                                             <p style="font-size:13px; margin:0; text-align:center;">&copy; Copyrights <?= gmdate('Y') ?> Langack All rights reserved.</p>
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
</body>
</html>
