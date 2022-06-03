<!-- header area start  -->
<header class="header-area header-bg-2 style-two" id="home" style="background-image: url(<?= _url('assets/front') ?>/img/bg/degra_airtime.png), url(<?= _url('assets/front') ?>/img/bg/back_airtime.png);">
	<!-- <div class="header-right-image  wow zoomIn"></div> -->
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="header-inner" style="margin-top: -50px;">
					<h3 class="wow fadeInDown text-left text-white"><?= $article->article_name ?></h3>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- header area end  -->

<!-- about us area start -->

<div class="page-content-area padding-bottom-120 mt-5">
	<div class="container">
		<div class="row">

			<div class="col-lg-8 mt-3">
				<div class="row">
					<div class="single-post-details-item"><!-- blog single content -->
	                        <div class="thumb">
	                            <img src="<?= _url($article->article_picture) ?>" alt="blog image">
	                        </div>
	                        <div class="entry-content">
	                            <ul class="post-meta">
	                                <li><a href="#"><i class="far fa-calendar-alt"></i> Publier le <?= gmdate('d M Y', $article->article_added) ?> à <?= gmdate('H:i', $article->article_added) ?></a></li>
	                                <!-- <li><a href="#"><i class="far fa-user"></i> Admin</a></li> -->
	                                <!-- <li class="cat"><i class="fas fa-tags"></i> <a href="#">Lifestyle</a> <a href="#">Travel</a><a href="#">Music</a></li> -->
	                            </ul>
	                            <h4 class="title"><?= $article->article_name ?> </h4>
	                            <p><?= $article->article_content ?></p>
	                        </div>

	                        <!-- <div class="entry-footer">
	                            <div class="left">
	                                <ul class="tags">
	                                    <li class="title">Tags: </li>
	                                    <li><a href="#">Marketing</a><a href="#">Design</a></li>
	                                </ul>
	                            </div>
	                            <div class="right">
	                                <ul class="social-share">
	                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
	                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
	                                    <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
	                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
	                                </ul>
	                            </div>
	                        </div> -->

	                    </div>
				</div>
			</div>

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

					<div class="widget widget_categories"><!-- widget -->
						<h4 class="widget-title text-primary text-uppercase">Catégories</h4>
						<ul>
							<li class="cat-item"><a href="#">Actualités</a></li>
							<li class="cat-item"><a href="#">Tutoriels</a></li>
							<li class="cat-item"><a href="#">Éditorial</a></li>
							<li class="cat-item"><a href="#">Histoires de développeurs</a></li>
							<li class="cat-item"><a href="#">Événements</a></li>
							<li class="cat-item"><a href="#">Client</a></li>
							<li class="cat-item"><a href="#">Histoires de réussite</a></li>
						</ul>
					</div>
					<div class="widget widget_popular_posts"><!-- widget -->
						<h4 class="widget-title text-primary text-uppercase">Messages populaires</h4>
						<ul>

							<li class="single-popular-post-item"><!-- article de publication unique populaire -->
								<div class="thumb">
									<img src="<?php _url(); ?>assets/front/img/popular-post/01.jpg" alt="popular post image">
								</div>
								<div class="content">
									<span class="time">11 mars 2022</span>
									<h4 class="title"><a href="#">Aliquam eu mauris euismod lacus vel.</a></h4>
								</div>
							</li><!-- //. article de publication unique populaire -->
							<li class="single-popular-post-item"><!-- article de publication unique populaire -->
								<div class="thumb">
									<img src="<?php _url(); ?>assets/front/img/popular-post/02.jpg" alt="popular post image">
								</div>
								<div class="content">
									<span class="time">11 mars 2022</span>
									<h4 class="title"><a href="#">Aliquam eu mauris euismod lacus vel.</a></h4>
								</div>
							</li><!-- //. article de publication unique populaire -->
							<li class="single-popular-post-item"><!-- article de publication unique populaire -->
								<div class="thumb">
									<img src="<?php _url(); ?>assets/front/img/popular-post/03.jpg" alt="popular post image">
								</div>
								<div class="content">
									<span class="time">11 mars 2022</span>
									<h4 class="title"><a href="#">Aliquam eu mauris euismod lacus vel.</a></h4>
								</div>
							</li><!-- //. article de publication unique populaire -->

						</ul>
					</div>
					<div class="widget widget_tag_cloud"><!-- widget -->
						<h4 class="widget-title text-primary text-uppercase">Tags</h4>
						<div class="tagcloud">
							<a href="#">Événements</a>
							<a href="#">Amour</a>
							<a href="#">Histoire</a>
							<a href="#">Cadeau</a>
							<a href="#">Événements</a>
							<a href="#">Première rencontre</a>
							<a href="#">Couple</a>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>
