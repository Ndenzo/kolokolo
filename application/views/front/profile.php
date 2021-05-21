<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php _url() ?>assets/front/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php _url() ?>assets/front/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Profile Page - Now UI Kit by Creative Tim</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
  <!-- CSS Files -->
  <link href="<?php _url() ?>assets/front/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php _url() ?>assets/front/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php _url() ?>assets/front/css/demo.css" rel="stylesheet" />
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/now-ui-kit" />
  <!--  Social tags      -->
  <meta name="keywords" content="bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, now ui, now ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit">
  <meta name="description" content="Start your development with a beautiful Bootstrap 4 UI kit. It is yours Free.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Now UI Kit by Creative Tim">
  <meta itemprop="description" content="Start your development with a beautiful Bootstrap 4 UI kit. It is yours Free.">
  <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/56/original/opt_nuk_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Now UI Kit by Creative Tim">
  <meta name="twitter:description" content="Start your development with a beautiful Bootstrap 4 UI kit. It is yours Free.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="http://s3.amazonaws.com/creativetim_bucket/products/56/original/opt_nuk_thumbnail.jpg">
  <meta name="twitter:data1" content="Now UI Kit by Creative Tim">
  <meta name="twitter:label1" content="Product Type">
  <meta name="twitter:data2" content="Free">
  <meta name="twitter:label2" content="Price">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Now UI Kit by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/now-ui-kit/index.html" />
  <meta property="og:image" content="http://s3.amazonaws.com/creativetim_bucket/products/56/original/opt_nuk_thumbnail.jpg" />
  <meta property="og:description" content="Start your development with a beautiful Bootstrap 4 UI kit. It is yours Free." />
  <meta property="og:site_name" content="Creative Tim" />
</head>

<body class="profile-page sidebar-collapse">

  <style>
  .back{
    background-image: url('<?php _url() ?>assets/front/img/bg/header1.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  }

  .border{
    border: 1px solid black;
  }

  .bold{
    font-weight: bold;
  }

  .images{
    margin-bottom: 30px;
  }

  .images img{
    height: 250px;
    margin-left: auto;
    margin-right: auto;
    width: auto;
  }

  .images:hover{
    box-shadow: 0px 5px 5px 0px silver;
  }
  </style>
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
      <div class="collapse navbar-collapse justify-content-end" data-nav-image="<?php _url() ?>assets/front/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.html">
              <p><strong>Accueil</strong></p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html">
              <p><strong>Hommes</strong></p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html">
              <p><strong>Femmes</strong></p>
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
            <a class="btn btn-default" style="color: white; margin-left:30px; " data-placement="bottom" href="{{ path_for('signin') }}">
              Deconnexion
            </a>
          </li>
          <!--li class="nav-item">
          <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
          <i class="fa fa-twitter"></i>
          <p class="d-lg-none d-xl-none">Twitter</p>
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
      <i class="fa fa-facebook-square"></i>
      <p class="d-lg-none d-xl-none">Facebook</p>
    </a>
  </li>
  <li class="nav-item">
  <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
  <i class="fa fa-instagram"></i>
  <p class="d-lg-none d-xl-none">Instagram</p>
</a>
</li-->
</ul>
</div>
</div>
</nav>
<!-- End Navbar -->
<div class="wrapper">
  <div class="page-header page-header-small" filter-color="orange">
    <div class="page-header-image" data-parallax="true" style="background-image: url('<?php _url() ?>assets/front/img/bg5.jpg');">
    </div>
    <div class="container">
      <div class="content-center">
        <div class="photo-container">
          <img src="<?php _url() ?>assets/front/img/ryan.jpg" alt="">
        </div>
        <h3 class="title">Rama Diaw</h3>
        <p class="category">Styliste</p>
        <div class="content">
          <div class="social-description">
            <h2>52</h2>
            <p>Produits</p>
          </div>
          <div class="social-description">
            <h2>450</h2>
            <p>Suiveurs</p>
          </div>
          <div class="social-description">
            <h2>45</h2>
            <p>Favoris</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
          <h4 class="title text-center"></h4>
          <div class="nav-align-center">
            <ul class="nav nav-pills nav-pills-primary" role="tablist">
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile" role="tablist" data-toggle="tooltip" data-placement="top" title="Favoris">
                  <i class="fa fa-heart"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tablist" data-toggle="tooltip" data-placement="top" title="Produits">
                  <i class="fa fa-shopping-bag"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tablist" data-toggle="tooltip" data-placement="top" title="Profil">
                  <i class="fa fa-user"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content gallery">
          <div class="tab-pane active" id="home" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
              <div class="section container">
                <div class="row">
                  <div class="col-xs-12">
                    <a href="#" class="btn btn-success col-xs-12">
                      <strong>Ajouter</strong>
                    </a>
                  </div>
                </div>
                <hr>
                <div class="row border"  style="margin-top: 30px; ">
                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/avatar.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im1.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im2.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="profile" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
              <div class="section container">
                <div class="row">
                  <div class="nav-item dropdown col-sm-9">
                    <a href="#pablo" class="nav-link text-primary dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink1">
                      <strong>Classements</strong>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                      <a class="dropdown-item" href="#">Top de la semaine</a>
                      <a class="dropdown-item" href="#">Top du mois</a>
                      <a class="dropdown-item" href="#">Top de tous les temps</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Tenues traditionnelles</a>
                      <a class="dropdown-item" href="#">Robes</a>
                      <a class="dropdown-item" href="#">Costumes</a>
                    </ul>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                      </span>
                      <input type="text" class="form-control" placeholder="Recherche">
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row"  style="margin-top: 30px; ">
                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/avatar.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im1.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im2.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im3.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im4.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im5.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im6.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im7.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-3 images">
                    <center>
                      <img src="<?php _url() ?>assets/front/img/catalogue/im8.jpg" alt="Thumbnail Image" class="rounded img-raised">
                    </center>
                    <div class="container-fluid">
                      <div class="row" style="font-size:20px;">
                        <div class="col-7">
                          Createur
                        </div>
                        <div class="col-5 text-warning" style="font-size:10px; margin-top: 7px; ">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-half"></i>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom: 10px;">
                        <div class="col-7">
                          Intitulé
                        </div>
                        <div class="col-5 text-success bold">
                          <a href="#"> <i class="fa fa-search-plus"></i> </a>
                          <a href="#"> <i class="fa fa-comments"></i> </a>
                          <a href="#"> <i class="fa fa-trash"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>



                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="messages" role="tabpanel">
            <div class="row">
              <div class="col-sm-7">
                <h3 class="title">Bio</h3>
                <h5 class="description" style="font-weight: bold;">
                  Ambassadrice d’une ville au carrefour des cultures, Rama Diaw, styliste, citoyenne du monde, a su séduire sur le continent africain, mais aussi en Europe, une clientèle de femmes dynamiques et élégantes de toutes origines. Les voyages, le partage autour d’une p’tite touche de wax savamment choisie, sont au cœur de sa collection : une collection urbaine et nomade, très tendance.
                </h5>
              </div>
              <div class="col-sm-5">
                <h3 class="title">Contacts</h3>
                <p style="line-height: 40px; padding: 20px;">
                  &emsp; <strong> <i class="fa fa-map-marker"></i> </strong> &emsp; Rue Blaise Diagne, Ile Nord, Saint-Louis du Sénégal <br>
                  &emsp; <strong> <i class="fa fa-envelope"></i> </strong> &emsp; ramadiawsl@gmail.com <br>
                  &emsp; <strong> <i class="fa fa-phone"></i> </strong> &emsp; +221 77 149 54 77 <br>
                  &emsp; <strong> <i class="fa fa-phone"></i> </strong> &emsp; +221 77 378 26 00
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer" data-background-color="black">
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
<!--   Core JS Files   -->
<script src="<?php _url() ?>assets/front/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php _url() ?>assets/front/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php _url() ?>assets/front/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?php _url() ?>assets/front/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?php _url() ?>assets/front/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="<?php _url() ?>assets/front/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Share Library etc -->
<script src="<?php _url() ?>assets/front/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="<?php _url() ?>assets/front/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

</html>
