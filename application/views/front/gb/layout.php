<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noarchive">
	<title> InterSIP | <?= @$title ?> </title>
	<!-- favicon -->
	<link rel="shortcut icon" href="<?= _url('assets/front') ?>/img/bg/favicon.png" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/bootstrap.min.css">
	<!-- icofont -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/fontawesome.5.7.2.css">
	<!-- flaticon -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/flaticon.css">
	<!-- animate.css -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/animate.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/owl.carousel.min.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/magnific-popup.css">
	<!-- stylesheet -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/style.css">
	<!-- responsive -->
	<link rel="stylesheet" href="<?php _url(); ?>assets/front/css/responsive.css">

	<link rel="stylesheet" href="<?php _url(); ?>assets/custom/plugins/particle/css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css">

</head>

<body>
	<style media="screen">

	.header_logo{
		width: 200px;
	}
	.header_logo_small{
		width: 100px;
	}
	.why-object{
		background-image: url(<?= _url('assets/front') ?>/img/bg/record.png);
		background-repeat: no-repeat;
		background-size: 250px;
		background-position: center;
		height: 250px;
		margin-top: 25px;
	}
	@media only screen and (max-width: 767px) {
		.navbar-area .navbar-collapse{
			background-color: rgba(255, 255, 255);
			z-index: 1000;
		}
		.navbar-area .navbar-collapse a{
			color: #EA2700!important;
		}
		.about-us-area.style-two{
			margin-top: 0px!important;
		}
		.header-inner{
			margin-top: -50px!important;
		}
		.header-area.header-bg-2{
			background-size:auto;
		}
	}
	.product-object{
		background-image: url(<?= _url('assets/front') ?>/img/bg/product_object_primary.png);
		background-repeat: no-repeat;
		background-size: contain;
		background-position: top;
		border-radius: 25px;
	}
	.desc-object{
		-webkit-box-shadow: 0px 0px 25px 3px rgba(0,0,0,0.35);
		box-shadow: 0px 0px 25px 3px rgba(0,0,0,0.35);
		margin: 25px;
	}
	.desc-object:hover{
	     margin-top: -20px;
	}
	.product-icon{
		/* margin-top: -20px; */
		height: 70px;
		width: auto;
	}
	.inditxt{
		text-align: center;
		margin-top: 105px;
		color: white;
		font-weight: bold;
		font-size: 30px;
	}
	.indi{
		font-size: 20px;
		text-align: center;
	}
	.owl-item{
		width: 250px!important;
	}
	.video-custom{
		position: absolute;
		top: 250px;
		right: 250px;
		width: 400px;
		z-index: 20;
	}
	.particles-js-canvas-el{
		position: absolute!important;
		z-index: 20;
	}
	.price-body p{
		padding: 15px;
		font-size: 13px;
		margin-top: -20px;
	}
	.price-header h4{
		padding: 15px;
	}
	</style>

	<nav class="navbar navbar-area navbar-expand-lg nav-absolute white nav-style-01" style="z-index:22;">
		<div class="container nav-container">
			<div class="responsive-mobile-menu">
				<div class="logo-wrapper">
					<a href="<?= _url('/') ?>" class="logo">
						<?php if ($style == "default"): ?>
							<img src="<?php _url(); ?>assets/custom/img/logo/logow.png" alt="logo" class="header_logo">
						<?php else: ?>
							<img src="<?php _url(); ?>assets/custom/img/logo/logo.png" alt="logo" class="header_logo">
						<?php endif; ?>
					</a>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appside_main_menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="appside_main_menu">
				<ul class="navbar-nav">
					<li class="menu-item-has-children">
						<a href="#">Products</a>
						<ul class="sub-menu">
							<li><a href="<?= _url('sms') ?>">SMS</a></li>
							<li><a href="<?= _url('ivr') ?>">IVR</a></li>
							<li><a href="<?= _url('airtime') ?>">AIRTIME</a></li>
							<li><a href="<?= _url('transfer') ?>">CASH TRANSFER</a></li>
							<li><a href="<?= _url('collection') ?>">DATA COLLECTION APP</a></li>
						</ul>
					</li>
					<li><a href="<?= _url('pricing') ?>">Pricing</a></li>
					<li><a href="<?= _url('about') ?>">About US</a></li>
					<li><a href="<?= _url('marketplace') ?>">Marketplace</a></li>
					<li><a href="<?= _url('blog') ?>">Blog</a></li>

					<li><a href="#lang_selector" data-toggle="modal"><i class="flag-icon flag-icon-<?= $this->session->lang ?>"></i></a></li>
				</ul>
			</div>
			<div class="nav-right-content">
				<ul>
					<li class="button-wrapper">
						<a href="#" class="boxed-btn btn-rounded bg-white text-primary">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<?= $content ?>

	<!-- footer area start -->
	<footer class="footer-area">
		<div class="border-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="footer-widget nav_menus_widget">
							<h2 class=" text-primary mt-1">CONTACT US</h2>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="footer-widget nav_menus_widget">
							<input class="form-control mt-4" type="text" name="" placeholder="Name">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="footer-widget nav_menus_widget">
							<input class="form-control mt-4" type="email" name="" placeholder="Email">
						</div>
					</div>
					<div class="col-lg-2 col-md-6">
						<div class="footer-widget nav_menus_widget">
							<a href="#" class="btn btn-primary mt-4 col-12">SUBSCRIBE</a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- //. copyright area -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-md-10">
						<div class="row">
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget nav_menus_widget">
									<h4 class="widget-title text-primary">PRODUCTS</h4>
									<ul>
										<li><a href="index.html"> SMS</a></li>
										<li><a href="#"> IVR</a></li>
										<li><a href="#"> Airtime & Cash Transfer</a></li>
										<li><a href="#"> Data Collection App</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget nav_menus_widget">
									<h4 class="widget-title text-primary">RESOURCES</h4>
									<ul>
										<li><a href="index.html"> Support</a></li>
										<li><a href="#"> Developers</a></li>
										<li><a href="#"> Github</a></li>
										<li><a href="#"> Status</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget nav_menus_widget">
									<h4 class="widget-title text-primary">COMPANY</h4>
									<ul>
										<li><a href="#"> Our Story</a></li>
										<li><a href="#"> Contact US</a></li>
										<li><a href="#"> Career</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget nav_menus_widget">
									<h4 class="widget-title text-primary">LEGAL</h4>
									<ul>
										<li><a href="#"> Term of Service </a></li>
										<li><a href="#"> Privacy Policy</a></li>
										<li><a href="#"> Service Level Agreement</a></li>
										<li><a href="#"> Code of Product</a></li>
										<li><a href="#"> Marketplace Terms of Service</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
					<div class="col-12 col-md-2">
						<div class="footer-widget about_widget">
							<h4 class="widget-title text-primary">Follow US</h4>
							<ul class="social-icon">
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright-area"><!-- copyright area -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="copyright-inner"><!-- copyright inner wrapper -->
							<div class="text-center text-primary"><!-- left content area -->
								InterSIP International.All rights reserved.
							</div><!-- //. left content aera -->
						</div><!-- //.copyright inner wrapper -->
					</div>
				</div>
			</div>
		</div><!-- //. copyright area -->
	</footer>
	<!-- footer area end -->

	<!-- preloader area start -->
	<div class="preloader-wrapper" id="preloader">
		<div class="preloader" >
			<div class="sk-circle">
				<div class="sk-circle1 sk-child"></div>
				<div class="sk-circle2 sk-child"></div>
				<div class="sk-circle3 sk-child"></div>
				<div class="sk-circle4 sk-child"></div>
				<div class="sk-circle5 sk-child"></div>
				<div class="sk-circle6 sk-child"></div>
				<div class="sk-circle7 sk-child"></div>
				<div class="sk-circle8 sk-child"></div>
				<div class="sk-circle9 sk-child"></div>
				<div class="sk-circle10 sk-child"></div>
				<div class="sk-circle11 sk-child"></div>
				<div class="sk-circle12 sk-child"></div>
			</div>
		</div>
	</div>

	<div id="lang_selector" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myCenterModalLabel">Select your language</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="feature-area">
						<div class="row wow fadeInUp">
							<a href="<?= _url('lang/?lang=fr') ?>">
								<div class="single-feature-list col-md-3 col-4 ml-auto mr-auto">
									<div class="icon icon-bg-4" style="background-image: url(<?= _url('assets/front') ?>/img/bg/icon.png)">
										<i class="flag-icon flag-icon-fr"></i>
									</div>
									<div class="content">
										<h4 class="title"><a href="#">Français</a></h4>
									</div>
								</div>
							</a>

							<a href="<?= _url('lang/?lang=gb') ?>">
								<div class="single-feature-list col-md-3 col-4 ml-auto mr-auto">
									<div class="icon icon-bg-4" style="background-image: url(<?= _url('assets/front') ?>/img/bg/icon.png)">
										<i class="flag-icon flag-icon-gb"></i>
									</div>
									<div class="content">
										<h4 class="title"><a href="#">English</a></h4>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- preloader area end -->

	<!-- back to top area start -->
	<div class="back-to-top">
		<i class="fas fa-angle-up"></i>
	</div>
	<!-- back to top area end -->

	<!-- jquery -->
	<script src="<?php _url(); ?>assets/front/js/jquery.js"></script>
	<!-- popper -->
	<script src="<?php _url(); ?>assets/front/js/popper.min.js"></script>
	<!-- bootstrap -->
	<script src="<?php _url(); ?>assets/front/js/bootstrap.min.js"></script>
	<!-- owl carousel -->
	<script src="<?php _url(); ?>assets/front/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="<?php _url(); ?>assets/front/js/jquery.magnific-popup.js"></script>
	<!-- contact js-->
	<script src="<?php _url(); ?>assets/front/js/contact.js"></script>
	<!-- wow js-->
	<script src="<?php _url(); ?>assets/front/js/wow.min.js"></script>
	<!-- way points js-->
	<script src="<?php _url(); ?>assets/front/js/waypoints.min.js"></script>
	<!-- counterup js-->
	<script src="<?php _url(); ?>assets/front/js/jquery.counterup.min.js"></script>
	<script src="<?php _url(); ?>assets/custom/js/paginate/jquery.paginate.min.js"></script>
	<script src="<?php _url(); ?>assets/custom/plugins/particle/js/particles.min.js"></script>
	<script src="<?php _url(); ?>assets/custom/plugins/particle/js/app.js"></script>
	<!-- main -->
	<script src="<?php _url(); ?>assets/front/js/main.js"></script>
	<script type="text/javascript">
	$('#example3').paginate({itemsPerPage: 6});
	$.getJSON('data.json', function(data) {
		var items = [];
		$.each(data.items, function(i, item) {
			items.push('<li>' + item + '</li>');
		});
		$('#example4').append(items.join(''));
		$('#example4').paginate({itemsPerPage: 10});
	});
	</script>
</body>

</html>
