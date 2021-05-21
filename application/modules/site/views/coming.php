<!DOCTYPE html>
<html lang="en">
<head>
	<title>ANCER | Page en construction</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php _url(); ?>assets/coming/images/icons/logo.png"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/coming/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/coming/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/coming/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/coming/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/coming/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/coming/css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	<style media="screen">
	.respon2{
		background-size: 344px 340px;
		background-position: center;
	}
	@media (max-width: 992px){
		.respon2 {
			background-size: 400px 400px;
			background-position: center top;
		}
	}
	</style>

	<?php show_notification();?>
	<div class="size1 bg0 where1-parent">
		<!-- Coutdown -->
		<div class="flex-c-m bg-img1 size2 where1 overlay1 where2 respon2" style="background-image: url('<?php _url(); ?>assets/coming/images/anser23.jpg');   background-color: white">
			<div class="wsize2 flex-w flex-c-m cd100 js-tilt">
				<!-- <div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
				<span class="l2-txt1 p-b-9 days">35</span>
				<span class="s2-txt4">Days</span>
			</div>

			<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
			<span class="l2-txt1 p-b-9 hours">17</span>
			<span class="s2-txt4">Hours</span>
		</div>

		<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
		<span class="l2-txt1 p-b-9 minutes">50</span>
		<span class="s2-txt4">Minutes</span>
	</div>

	<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">
	<span class="l2-txt1 p-b-9 seconds">39</span>
	<span class="s2-txt4">Seconds</span>
</div> -->
</div>
</div>

<!-- Form -->
<div class="size3 flex-col-sb flex-w p-l-75 p-r-75 p-t-45 p-b-45 respon1">
	<div class="wrap-pic1">
		<img src="<?php _url(); ?>assets/coming/images/anser.png" alt="LOGO" style="width: 100px; height: 100px;">


	</div>
	<h5 style="text-align: center; margin-top: 15px; font-size: 20px; font-weight: bold;">
		Agence Nationale des Services Energétiques Ruraux<br>
		<br>
		<strong>ANSER</strong>
	</h5>
	<div class="p-t-50 p-b-60">
		<p class="m1-txt1 p-b-20">
			Cette page est en construction.
		</p>

		<form class="contact100-form validate-form" action="<?php _url('site/coming/insert'); ?>" method="post">

			<div class="wrap-input100 m-b-20 validate-input" data-validate = "Email obligatoire : ex@abc.xyz">
				<input class="s2-txt1 placeholder0 input100" type="text" name="prospect_email" placeholder="Votre email. " required>
				<span class="focus-input100"></span>
			</div>

			<div class="w-full">
				<button class="flex-c-m s2-txt2 size4 bg1 bor1 hov1 trans-04" type="submit">
					Restez informer
				</button>
			</div>
		</form>

		<p class="s2-txt3 p-t-18">
			En renseignant votre adresse email vous consentez à vouloir être informer de toutes activitées de ce site.
		</p>
	</div>

	<div class="flex" style="font-size: 10px;">
		<p> <strong>Adresse : </strong>Immeuble JVL, Avenue du Port n° 3, 2ème et 3ème niveaux, Commune de la Gombe – KINSHASA </p> <br>
		<p> <strong>Email : </strong>cpanser.erh@gmail.com </p> <br>
		<p> <strong>Tel : </strong>+243 813211705 +243 840212375 +243 851219835 </p>
		<!-- <a href="#" class="flex-c-m size5 bg3 how1 trans-04 m-r-5">
		<i class="fa fa-facebook"></i>
	</a>

	<a href="#" class="flex-c-m size5 bg4 how1 trans-04 m-r-5">
	<i class="fa fa-twitter"></i>
</a>

<a href="#" class="flex-c-m size5 bg5 how1 trans-04 m-r-5">
<i class="fa fa-youtube-play"></i>
</a> -->
</div>
</div>
</div>





<!--===============================================================================================-->
<script src="<?php _url(); ?>assets/coming/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php _url(); ?>assets/coming/vendor/bootstrap/js/popper.js"></script>
<script src="<?php _url(); ?>assets/coming/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php _url(); ?>assets/coming/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php _url(); ?>assets/coming/vendor/countdowntime/moment.min.js"></script>
<script src="<?php _url(); ?>assets/coming/vendor/countdowntime/moment-timezone.min.js"></script>
<script src="<?php _url(); ?>assets/coming/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
<script src="<?php _url(); ?>assets/coming/vendor/countdowntime/countdowntime.js"></script>
<script>
$('.cd100').countdown100({
	/*Set Endtime here*/
	/*Endtime must be > current time*/
	endtimeYear: 0,
	endtimeMonth: 0,
	endtimeDate: 35,
	endtimeHours: 18,
	endtimeMinutes: 0,
	endtimeSeconds: 0,
	timeZone: ""
	// ex:  timeZone: "America/New_York"
	//go to " http://momentjs.com/timezone/ " to get timezone
});
</script>
<!--===============================================================================================-->
<script src="<?php _url(); ?>assets/coming/vendor/tilt/tilt.jquery.min.js"></script>
<script >
$('.js-tilt').tilt({
	scale: 1.1
})
</script>
<script type="text/javascript">
$(document).ready(function () {
     setTimeout(function () {
          $('.alert').hide();
     }, 5000);
});
</script>
<!--===============================================================================================-->
<script src="<?php _url(); ?>assets/coming/js/main.js"></script>

</body>
</html>
