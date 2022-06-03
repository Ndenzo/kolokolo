<div id="particles-js"></div>
<!-- header area start  -->
<header class="header-area header-bg-2 style-two" id="home">
	<div class="container">
		<div class="row">

			<div class="col-lg-6">
				<div class="header-inner" style=" margin-top: -150px;">
					<h1 class="title wow fadeInDown text-left">Blog</h1>
					<p class="wow fadeInDown text-left text-white" style="font-size: 14px;">
						Profitez de nos services à des prix imbattables.
						Vous êtes commercial, revendeur ou contributeur nous
						vous offrons des prix défiants toute concurrence pour vos campagnes
						dans le monde entier. Nous sommes là pour vous aider à atteindre vos objectifs d’impact.
					</p>
				</div>
			</div>
			<div class="col-lg-6">
				<img src="<?= _url(); ?>assets/front/img/bg/blog.png" alt="header right image" class="d-none d-sm-block" style="max-width: 650px!important; margin-left: -50px; margin-top: -100px;">
			</div>
		</div>
	</div>
</header>
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

			<div class="col-lg-8 mt-3">
				<div class="row">
					<?php foreach ($articles as $key => $article): ?>
						<div class="col-lg-6 col-md-6">
							<div class="single-blog-grid-item"><!-- single blog grid item -->
								<div class="thumb" style="width: 359px; height: 251px;">
									<img src="<?= _url($article->article_picture) ?>" alt="blog images">
								</div>
								<div class="content">
									<ul class="post-meta">
										<li><a href="<?= _url('blog_detail/'.$article->article_id) ?>"><?= gmdate('d M Y', $article->article_added) ?> </a></li>
									</ul>
									<h4 class="title"><a href="<?= _url('blog_detail/'.$article->article_id) ?>"><?= $article->article_name ?></a></h4>
									<a href="<?= _url('blog_detail/'.$article->article_id) ?>" class="readmore">Voir Plus <i class="fas fa-long-arrow-alt-right"></i></a>
								</div>
							</div><!-- //. single blog grid item -->
						</div>
					<?php endforeach; ?>


					<!-- <div class="col-lg-12">
						<div class="blog-pagination margin-top-10">
							<nav aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item active"><a class="page-link" href="#">2</a></li>
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<i class="fas fa-chevron-right"></i>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div> -->
				</div>
			</div>

		</div>
	</div>
</div>
