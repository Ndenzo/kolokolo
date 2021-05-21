<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php _url(); ?>/assets/front/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php _url(); ?>/assets/front/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Login Page - Now Ui Kit by Creative Tim</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
  <!-- CSS Files -->
  <link href="<?php _url(); ?>/assets/front/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php _url(); ?>/assets/front/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php _url(); ?>/assets/front/css/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="dropdown button-dropdown">
        <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
          <span class="button-bar"></span>
          <span class="button-bar"></span>
          <span class="button-bar"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-header">Dropdown header</a>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">One more separated link</a>
        </div>
      </div>
      <div class="navbar-translate">
        <a class="navbar-brand" href="{{ path_for('index') }}"  rel="tooltip" title="Designed by Invision. Coded by Creative Tim" data-placement="bottom">
          Reff
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="<?php _url(); ?>/assets/front/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
              <p><strong>Accueil</strong></p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./documentation/tutorial-components.html" target="_blank">
              <p><strong>Homme</strong></p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./documentation/tutorial-components.html" target="_blank">
              <p><strong>Femme</strong></p>
            </a>
          </li>
          <div class="nav-item dropdown">
            <a href="#pablo" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink1">
              <strong>Enfants</strong>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
              <a class="dropdown-item" href="#">Garçon</a>
              <a class="dropdown-item" href="#">Fille</a>
            </ul>
          </div>

          <li class="nav-item">
            <a class="btn btn-primary" style="color: white; margin-left:30px; " data-placement="bottom" href="{{ path_for('signin') }}">
              Connexion
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header" filter-color="orange">
    <div class="page-header-image" style="background-image:url(<?php _url(); ?>/assets/front/img/bg/header1.jpg)"></div>
    <div class="container">
      <div class="col-md-6 content-center">
        <div class="row">
          <div class="card card-signup col-md-12" data-background-color="orange">
            <form class="form" method="post" action="inscription">
              <div class="header text-center">
                <h4 class="title title-up">inscription</h4>
              </div>
              <div class="card-body">
                <div class="input-group form-group-no-border">
                  <span class="input-group-addon">
                    <i class="now-ui-icons users_circle-08"></i>
                  </span>
                  <input type="text" name="prenom" class="form-control" placeholder="Prénom..." required/>
                </div>
                <div class="input-group form-group-no-border">
                  <span class="input-group-addon">
                    <i class="now-ui-icons text_caps-small"></i>
                  </span>
                  <input type="text" name="nom" class="form-control" placeholder="Nom..." required/>
                </div>
                <div class="input-group form-group-no-border">
                  <span class="input-group-addon">
                    <i class="now-ui-icons business_briefcase-24"></i>
                  </span>
                  <select class="form-control" name="role" required>
                    <option value="">Que faites vous ?</option>
                    <option value="styliste">Styliste</option>
                    <option value="commerçant">Commerçant</option>
                    <option value="tailleur">Tailleur</option>
                  </select>
                </div>
                <div class="input-group form-group-no-border">
                  <span class="input-group-addon">
                    <i class="now-ui-icons ui-1_email-85"></i>
                  </span>
                  <input type="email" name="email" class="form-control" placeholder="Votre email..." required/>
                </div>
                <div class="input-group form-group-no-border">
                  <span class="input-group-addon">
                    <i class="now-ui-icons objects_key-25"></i>
                  </span>
                  <input type="password" name="password" class="form-control" placeholder="Votre mot de passe..." required/>
                </div>
                <!-- If you want to add a checkbox to this form, uncomment this code -->
                <!-- <div class="checkbox">
                <input id="checkboxSignup" type="checkbox">
                <label for="checkboxSignup">
                Unchecked
              </label>
            </div> -->
          </div>
          <div class="footer text-center">
            <input type="submit" class="btn btn-neutral btn-round btn-lg"/>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container">
    <nav>
      <ul>
        <li>
          <a href="https://www.creative-tim.com">
            Accueil
          </a>
        </li>
        <li>
          <a href="http://presentation.creative-tim.com">
            Hommes
          </a>
        </li>
        <li>
          <a href="http://blog.creative-tim.com">
            Femmes
          </a>
        </li>
        <li>
          <a href="https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md">
            Enfants
          </a>
        </li>
      </ul>
    </nav>
    <div class="copyright">
      &copy;
      <script>
      document.write(new Date().getFullYear())
      </script> Coded by
      <a href="https://www.creative-tim.com" target="_blank">Reff</a>.
    </div>
  </div>
</footer>
</div>
</body>
<?php  ?>
<!--   Core JS Files   -->
<script src="<?php _url(); ?>/assets/front/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php _url(); ?>/assets/front/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php _url(); ?>/assets/front/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?php _url(); ?>/assets/front/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?php _url(); ?>/assets/front/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="<?php _url(); ?>/assets/front/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="<?php _url(); ?>/assets/front/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>
