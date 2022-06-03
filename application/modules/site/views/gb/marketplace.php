<div id="particles-js"></div>
<!-- header area start  -->
<header class="header-area header-bg-2 style-two" id="home" style="background-image: url(<?= _url('assets/front') ?>/img/bg/header-bg-3-dark.png);">
	<div class="container">
		<div class="row">

			<div class="col-lg-6">
				<img src="<?php _url(); ?>assets/front/img/bg/market.png" class="d-none d-sm-block" alt="header right image" style="max-width: 550px!important; margin-top: -100px; margin-left:-20px;">
			</div>

			<div class="col-lg-6">
				<div class="header-inner" style="margin-left: 0px; margin-top: -150px;">
					<h1 class="title wow fadeInDown text-left">INTERSIP MARKETPLACE</h1>
					<p class="wow fadeInDown text-left text-white" style="font-size: 14px;">
						Take advantage of our services at unbeatable prices. You are commercial,
						reseller or contributor we offer you unbeatable prices
						for your campaigns worldwide. We're here to help you achieve your impact goals.
					</p>
					<div class="btn-wrapper wow fadeInUp">
						<a href="#" class="btn btn-white border-white bg-white" style="margin-right: 150px;"> <h3 class="text-primary">Showcase your App</h3></a>
						<!-- <a href="#" class="boxed-btn btn-rounded blank">Learn More</a> -->
					</div>
				</div>
			</div>

		</div>
	</div>
</header>
<br>
<!-- header area end  -->

<!-- about us area start -->

<div class="page-content-area padding-bottom-120">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="sidebar widget-area"><!-- widget area -->

					<div class="widget widget_search"><!-- widget  -->
						<h4 class="widget-title">Recherche</h4>
						<form action="blog.html" class="search-form">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
							<button class="submit-btn" type="submit"><i class="fas fa-search"></i></button>
						</form>
					</div><!-- //. widget -->

					<div class="widget widget_categories"><!-- widget  -->
						<h4 class="widget-title text-primary text-uppercase">Product</h4>
						<ul>
							<li class="cat-item"><a href="#">SMS</a></li>
							<li class="cat-item"><a href="#">IVR</a></li>
							<li class="cat-item"><a href="#">AIRTIME & CASH TRANSFER</a></li>
							<li class="cat-item"><a href="#">DATA COLLECTION APP</a></li>
						</ul>
					</div>
					<div class="widget widget_popular_posts"><!-- widget  -->
						<h4 class="widget-title text-primary text-uppercase">USES CASES</h4>
						<ul>
							<li class="cat-item"><a href="#">VENTES ET MARKETING</a></li>
							<li class="cat-item"><a href="#">FINANCES</a></li>
							<li class="cat-item"><a href="#">OPÉRATIONS</a></li>
							<li class="cat-item"><a href="#">SERVICE CLIENT</a></li>
							<li class="cat-item"><a href="#">ENTREPRISE</a></li>
							<li class="cat-item"><a href="#">PME</a></li>
							<li class="cat-item"><a href="#">STARTUPS</a></li>
							<li class="cat-item"><a href="#">PME</a></li>
							<li class="cat-item"><a href="#">INSTITUTIONS DE MICROFINANCEMENT</a></li>
							<li class="cat-item"><a href="#">BANQUES</a></li>
							<li class="cat-item"><a href="#">AUTRES COMPAGNIES DE DÉBARQUEMENT</a></li>
							<li class="cat-item"><a href="#">ONG</a></li>
						</ul>
					</div>
					<div class="widget widget_tag_cloud"><!-- widget -->
						<h4 class="widget-title  text-primary text-uppercase">COUNTRY</h4>
						<ul>
							<li class="cat-item"><a href="#">SÉNÉGAL</a></li>
							<li class="cat-item"><a href="#">MALI</a></li>
							<li class="cat-item"><a href="#">SIERRA-LEONE</a></li>
							<li class="cat-item"><a href="#">COTE D'IVOIRE</a></li>
							<li class="cat-item"><a href="#">NIGER</a></li>
							<li class="cat-item"><a href="#">RD CONGO</a></li>
						</ul>
					</div>

				</div>
			</div>

			<div class="col-lg-8">
				<div id="example3" class="row">
					<?php foreach ($markets as $key => $market): ?>
						<div class="col-lg-6 col-md-6 mt-4">
							<div class="single-feature-item-02" style="height: 350px;">
								<a href="<?= $market['link'] ?>">
									<div class="icon col-12" style="height: 130px; background-image: url(<?= _url($market['logo']); ?>); background-repeat: no-repeat; background-position: center; background-size: contain;"></div>
									<div class="content mt-4	">
										<h4 class="title"><a href="<?= $market['link'] ?>" target="_blank"><?= $market['name'] ?></a></h4>
										<p style="font-size: 12px;"><?= $market['desc'] ?></p>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach; ?>


				</div>
				<div class="col-lg-12">

					<div class="blog-pagination margin-top-10">
						<nav aria-label="Page navigation example">
							<ul class="pagination" id="example3-pagination">
								<li class="page-item">
									<a class="page-link" id="example3-previous" href="#">
										<i class="fas fa-chevron-left"></i>
									</a>
								</li>
								<li class="page-item" id="example3-next">
									<a class="page-link" id="example3-next" href="#">
										<i class="fas fa-chevron-right"></i>
									</a>
								</li>
								<!-- <li class="page-item">
								<a class="page-link" href="#" aria-label="Next">
								<i class="fas fa-chevron-right"></i>
							</a>
						</li> -->
					</ul>
				</nav>
			</div>
		</div>
	</div>

</div>
</div>
</div>
