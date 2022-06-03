<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title><?= $title ?> - ACS Capital</title>
     <!-- base:css -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/mdi/css/materialdesignicons.min.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/css/vendor.bundle.base.css">
     <link href="<?php _url(); ?>assets/custom/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <link href="<?php _url(); ?>assets/custom/select2/css/select2.css" rel="stylesheet" type="text/css"/>
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/flag-icon-css/css/flag-icon.min.css"/>
     <!-- endinject -->
     <!-- plugin css for this page -->
     <!-- End plugin css for this page -->
     <!-- inject:css -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vertical-layout-light/style.css">
     <!-- endinject -->
     <link rel="shortcut icon" href="<?php _url(); ?>assets/custom/img/logo/logo.jpg"/>
</head>

<body>
     <style media="screen">
     body{
          font-family: "Galano Classic Regular", sans-serif;
     }
     .needed{
          font-weight: bold;
          color: red;
     }
     .select2{
          width: 100%!important;
          border: 1px solid #ced4da!important;
          border-radius: 0.25rem!important;
          color: #495057!important;
          line-height: 50px!important;
     }
     .select2-container--default .select2-selection--single .select2-selection__arrow{
          height:45px!important;
     }
     .btn-small{
          width:40px;
          height:40px;
          padding: 10px!important;
     }
     .vertical-center {
          margin: 0;
          position: relative;
          top: 40%;
          -ms-transform: translateY(50%);
          transform: translateY(50%);
     }
     .img-project{
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          border-radius: 3px;
     }
     .modal-header .close{
          font-size: 50px!important;
     }
     .modal-title{
          text-transform: uppercase!important;
     }
     input.form-control{
          border: 1px solid #aaa;
     }
     .select2-container--default .select2-selection--single{
          border-radius: 0px;
     }
     </style>
     <div class="container-scroller">
          <div class="container-fluid page-body-wrapper full-page-wrapper">
               <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0  mb-5">
                         <div class="col-lg-6 mx-auto">
                              <a href="https://capital-acs.com" class="brand-logo" style="">
                                   <center>
                                        <img src="<?php _url(); ?>assets/custom/img/logo/logo_outline.png" alt="logo" style="margin-left:auto!important; margin-right:auto!important;">
                                   </center>
                              </a>
                              <div class="auth-form-light text-left py-5 px-4 px-sm-5 mt-5">
                                   <?php show_notification();?>
                                   <!-- <h4 class="text-center"></h4> -->
                                   <h2 class="font-weight-bold text-primary text-center">Créer votre compte !</h2>

                                   <h5 class="text-center mt-4 font-weight-light text-muted">
                                        Vous êtes déjà inscrit ? <a href="<?= _url("/"); ?>" class="text-info">Connexion</a>
                                   </h5>

                                   <div class="mb-4 mt-5 d-flex">
                                        <?= $google_auth ?>
                                     <!-- <button type="button" class="btn btn-google auth-form-btn flex-grow">
                                       <i class="mdi mdi-google"></i> Google
                                     </button> -->
                                   </div>

                                   <div class="d-flex align-items-center mb-10">
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								<span class="fw-bold text-gray-400 fs-7 mx-2">OU</span>
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							</div>

                                   <form method="post" action="<?= _url($module_base."insert"); ?>" class="pt-3 validatedForm" autocomplete="off">
                                        <div class="row">
                                             <div class="form-group col-12">
                                                  <label for="prenoms">Prénoms <span class="needed">*</span> </label>
                                                  <input type="text" class="form-control" id="prenoms" name="person_first_name" placeholder="Prénoms utilisateur" required>
                                             </div>
                                             <div class="form-group col-12">
                                                  <label for="prenoms">Nom <span class="needed">*</span> </label>
                                                  <input type="text" class="form-control" id="nom" name="person_last_name" placeholder="Nom utilisateur" required>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="form-group col-12">
                                                  <label for="email">Email <span class="needed">*</span> </label>
                                                  <input type="email" class="form-control" id="email" name="user_email" placeholder="identifiant@domaine.com" required>
                                             </div>
                                             <div class="form-group mb-3 col-12">
                                                  <label>Mobile</label>
                                                  <div class="input-group">
                                                       <div class="input-group-prepend">
                                                            <select name="person_country_phone_1"></select>
                                                       </div>
                                                       <input type="text" class="form-control" id="phone" name="person_phone_1" placeholder="Numéro de téléphone" >
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="entreprise">Entreprise <span class="needed">*</span> </label>
                                             <input type="text" class="form-control" id="entreprise" name="investor_company" placeholder="Nom de la structure" required>
                                        </div>
                                        <hr>

                                        <div class="row">
                                             <div class="form-group col-6">
                                                  <label for="password1">Mot de passe <span class="needed">*</span> </label>
                                                  <input type="password" class="form-control form-control-lg" id="password1" name="password" placeholder="Password">
                                             </div>
                                             <div class="form-group col-6">
                                                  <label for="password2">Confirmer Mot de passe <span class="needed">*</span> </label>
                                                  <input type="password" class="form-control form-control-lg" id="password2" name="password_confirm" placeholder="Password">
                                             </div>
                                        </div>

                                        <div class="mb-4">
                                             <div class="col-12 form-group">
                                                  <input type="checkbox" class="form-check-input" required>
                                                  <p>I agree to all <a href="#">Terms & Conditions</a></p>
                                             </div>
                                        </div>
                                        <div class="mt-3">
                                             <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SOUMETTRE</button>
                                        </div>

                                   </form>
                              </div>
                         </div>
                         <div class="row w-100 mx-0 mb-5 mt-5">
                              <p class="font-weight-bold text-center flex-grow align-self-end">Copyright &copy; <?= gmdate('Y') ?>  All rights reserved.</p>
                         </div>
                    </div>

               </div>
               <!-- content-wrapper ends -->
          </div>
          <!-- page-body-wrapper ends -->
     </div>
     <!-- container-scroller -->
     <!-- base:js -->
     <script src="<?php _url(); ?>assets/back/vendors/js/vendor.bundle.base.js"></script>
     <!-- endinject -->
     <!-- inject:js -->
     <script src="<?php _url(); ?>assets/back/js/off-canvas.js"></script>
     <script src="<?php _url(); ?>assets/back/js/hoverable-collapse.js"></script>
     <script src="<?php _url(); ?>assets/back/js/template.js"></script>
     <script src="<?php _url(); ?>assets/back/js/settings.js"></script>
     <script src="<?php _url(); ?>assets/back/js/todolist.js"></script>
     <!-- endinject -->
     <!-- custom -->
     <script src="<?php _url(); ?>assets/custom/js/jquery.validate.js"></script>
     <script src="<?php _url(); ?>application/modules/profile/js/profile_script.js" type="text/javascript"></script>

     <script src="<?php _url(); ?>assets/custom/select2/js/select2.full.min.js"></script>
     <script src="<?php _url(); ?>assets/custom/select2/js/select2-custom.js"></script>
     <!-- endcustom -->

     <script type="text/javascript">
     (function($) {
          $(function() {
               var isoCountries1 = [
                    <?php if (is_array(get_countries())): ?>
                    {
                         id : '',
                         text : '',
                    },
                    <?php foreach (get_countries() as $key => $country): ?>
                    {
                         id : '<?= $country->iso2 ?>',
                         text : '+<?= $country->calling_code ?>'
                    },
                    <?php endforeach; ?>
                    <?php endif; ?>
               ];

               function formatCountry (country) {
                    if (!country.id) { return country.text; }
                    var $country = $(
                         '<span class="flag-icon flag-icon-'+ country.id.toLowerCase() +' flag-icon-squared"></span>' +
                         '<span class="flag-text pl-2">  '+ country.text+"</span>"
                    );
                    return $country;
               };

               //Assuming you have a select element with name country
               // e.g. <select name="name"></select>

               $("[name='person_country_phone_1']").select2({
                    placeholder: "Indicatif",
                    templateResult: formatCountry,
                    data: isoCountries1
               });

          });
     })(jQuery);
     </script>
</body>

</html>
