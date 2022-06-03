<!--================Blog Categorie Area =================-->
<!-- <section class="blog_categorie_area">
<div class="container">
<div class="row">
<?php if(is_array(@$categories)):?>
<?php foreach(@$categories as $categorie):?>
<?php $post = get_last_blog($categorie->categorie_id); ?>
<div class="col-lg-4 col-md-6 mb-4 mb-lg-0" >
<div class="categories_post">
<img src="<?php _url(); ?><?= $post->article_photo ?>" alt="post" style="height: 230px;" class="col-3">
<div class="categories_details">
<div class="categories_text">
<a href="blog-details.html"><h5><?= $categorie->categorie_libelle ?></h5></a>
<div class="border_line"></div>
<p><?= $post->article_libelle ?></p>
</div>
</div>
</div>
</div>
<?php endforeach;?>
<?php endif;?>
</div>
</div>
</section> -->
<!--================Blog Categorie Area =================-->
<?php if($current_blog_id == 3): ?>
	<section class="welcome-area section-padding3">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 align-self-center">
					<div class="welcome-img">
						<img src="<?php _url(); ?>/assets/front/images/welcome.jpeg" alt="">
					</div>
				</div>
				<div class="col-lg-8">
					<div class="welcome-text mt-5 mt-lg-0">
						<h2 style="margin-bottom: 30px;">Bienvenue</h2>
						<p class="pt-3" style="font-size: 12px; margin-top: -20px;">
							Bonjour à tous, je suis Waré Ndoye, étudiante en médecine et grande passionnée de
							pédiatrie et de tout ce qui tourne autour des enfants. J’ai créé ce blog « Sunu
							Blog Santé » pour partager avec vous des articles et des bonnes pratiques pour le bien
							être de nos enfants.
						</p>
						<p class="pt-3" style="font-size: 12px; margin-top: -20px;">
							Sunu Blog Santé est un site essentiellement centré sur la nutrition des enfants mais
							visant également une meilleure compréhension de certaines pathologies assez
							fréquentes. Le terme « Sunu » parce que c’est un blog qui se veut interactif où chacun
							pourra proposer un thème ou poser des questions, mais aussi parce que ce blog vise
							en mettre en avant le Sénégal à travers ses produits et ses valeurs.
						</p>
						<p class="pt-3" style="font-size: 12px; margin-top: -20px;">
							Le blog comprend 3 parties : la première nommée « coin nutrition bébé » qui permettra
							aux parents d’avoir de meilleures connaissances sur l’alimentation mais aussi la bonne
							santé de bébé, en insistant sur nos produits locaux.
						</p>
						<p class="pt-3" style="font-size: 12px; margin-top: -20px;">
							La deuxième partie ou encore « coin santé » a pour objectif de rendre la
							compréhension de certaines pathologies fréquentes au sénégalais lambda par une
							explication simplifiée.
						</p>
						<p class="pt-3" style="font-size: 12px; margin-top: -20px;">
							Et enfin, la troisième partie intitulée « le blog de Waré » sera une tribune où je pourrai
							partager ma vision sur des thèmes d’actualité ou mes passions.
						</p>
						<p class="pt-3" style="font-size: 12px; margin-top: -20px;">
							J’aimerais adresser mes sincères remerciements au Docteur B.Niang pédiatre qui m’a
							donné les outils nécessaires pour démarrer ce blog mais également à l’ensemble du
							personnel de l’hôpital Albert Royer particulièrement au Dr G.Diagne pour ses
							encouragements.
							Merci au Dr M.A.Ndour pour son soutien et ses encouragements
							Je remercie du fond du cœur I.Dioum et Mr Pape Ndene Diaham pour la conception du
							logo et du site web et leur disponibilité, sans eux tout cela ne serait pas possible.
							Merci à Mme J.Badiane pour son aide précieuse.
							Merci à Monsieur Ndao pour ses conseils.
							Je ne saurais finir sans remercier mes parents, ma famille et mes amis (mention
							spéciale à A.T, merci pour le soutien)
							Merci à tous et à très bientôt en espérant que mon objectif qui est de sensibiliser le
							maximum de personne par rapport aux problèmes de santé publique soit atteint.
						</p>
						<!-- <a href="#" class="template-btn mt-3">learn more</a> -->
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<!--================Blog Area =================-->
<section class="blog_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="blog_left_sidebar">
					<?php if(is_array(@$blogs)):?>
						<?php foreach(@$blogs as $blog):?>
							<article class="row blog_item">
								<div class="col-md-3">
									<div class="blog_info text-right">
										<div class="post_tag">
											<a class="active" href="<?php _url("blog/".$blog->categorie_id); ?>"><?= $blog->categorie_libelle ?></a>
										</div>
										<ul class="blog_meta list">
											<li><a href="#"><?= $blog->user_nicename ?><i class="fa fa-user-o"></i></a></li>
											<li><a href="#"><?= gmdate("d/m/Y H:i", $blog->added) ?><i class="fa fa-calendar-o"></i></a></li>
											<li><a href="#">1.2M Views<i class="fa fa-eye"></i></a></li>
											<li><a href="#">06 Comments<i class="fa fa-comment-o"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-9">
									<div class="blog_post">
										<img src="<?php _url(); ?><?= $blog->article_photo ?>" alt="">
										<div class="blog_details">
											<a href="<?php _url("blog_detail/".$blog->article_id); ?>"><h4><?= $blog->article_libelle ?></h4></a>
											<?php echo substr(strval($blog->article_desc), 0, 150)."...";?> <br>
											<a href="<?php _url($module_base.'showBlogDetail/'.$blog->article_id); ?>" class="template-btn">Voir plus ...</a>
										</div>
									</div>
								</div>
							</article>
						<?php endforeach;?>
					<?php endif;?>

					<nav class="blog-pagination justify-content-center d-flex">
						<ul class="pagination">
							<?php if ($page != 1): ?>
								<li class="page-item">
									<a href="<?php _url('blog/'.$categorie_id.'/'.($page-1)); ?>" class="page-link" aria-label="Précédent">
										<span aria-hidden="true">
											<span class="fa fa-angle-left"></span>
										</span>
									</a>
								</li>
							<?php endif; ?>
							<?php for($i=1; $i<=$nb_page; $i++): ?>
								<?php if ($i == $page): ?>
									<li class="page-item active"><a href="<?php _url('blog/'.$categorie_id.'/'.$i); ?>" class="page-link"><?= $i ?></a></li>
								<?php else: ?>
									<li class="page-item"><a href="<?php _url('blog/'.$categorie_id.'/'.$i); ?>" class="page-link"><?= $i ?></a></li>
								<?php endif; ?>
							<?php endfor; ?>
							<?php if ($page != $nb_page): ?>
								<li class="page-item">
									<a href="<?php _url('blog/'.$categorie_id.'/'.($page+1)); ?>" class="page-link" aria-label="Suivant">
										<span aria-hidden="true">
											<span class="fa fa-angle-right"></span>
										</span>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</nav>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="blog_right_sidebar">
					<aside class="single_sidebar_widget search_widget">
						<div class="input-group">
							<input type="text" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div><!-- /input-group -->
						<div class="br"></div>
					</aside>
					<aside class="single_sidebar_widget author_widget">
						<img class="author_img rounded-circle" src="<?php _url(); ?>/assets/front/images/author-ware.png" alt="">
						<h5>Waré NDOYE</h5>
						<p>Passionnée de Pédiatrie</p>
						<div class="social_icon">
							<a href="https://www.facebook.com/ware.ndoye" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="https://twitter.com/wareiih" target="_blank"><i class="fa fa-twitter"></i></a>
							<a href="https://www.instagram.com/wareiih/" target="_blank"><i class="fa fa-instagram"></i></a>
						</div>
						<p>
							Bonjour à tous, je suis Waré Ndoye, étudiante en médecine et grande passionnée de
							pédiatrie et de tout ce qui tourne autour des enfants. J’ai créé ce blog « Sunu
							Blog Santé » pour partager avec vous des articles et des bonnes pratiques pour le bien
							être de nos enfants.
						</p>
						<div class="br"></div>
					</aside>
					<aside class="single_sidebar_widget popular_post_widget">
						<h4 class="widget_title">Popular Posts</h4>
						<div class="media post_item">
							<img src="<?php _url(); ?>assets/front/images/blog/popular-post/post1.jpg" alt="post">
							<div class="media-body">
								<a href="blog-details.html"><h5>Space The Final Frontier</h5></a>
								<p>02 Hours ago</p>
							</div>
						</div>
						<div class="media post_item">
							<img src="<?php _url(); ?>assets/front/images/blog/popular-post/post2.jpg" alt="post">
							<div class="media-body">
								<a href="blog-details.html"><h5>The Amazing Hubble</h5></a>
								<p>02 Hours ago</p>
							</div>
						</div>
						<div class="media post_item">
							<img src="<?php _url(); ?>assets/front/images/blog/popular-post/post3.jpg" alt="post">
							<div class="media-body">
								<a href="blog-details.html"><h5>Astronomy Or Astrology</h5></a>
								<p>03 Hours ago</p>
							</div>
						</div>
						<div class="media post_item">
							<img src="<?php _url(); ?>assets/front/images/blog/popular-post/post4.jpg" alt="post">
							<div class="media-body">
								<a href="blog-details.html"><h5>Asteroids telescope</h5></a>
								<p>01 Hours ago</p>
							</div>
						</div>
						<div class="br"></div>
					</aside>
					<aside class="single_sidebar_widget ads_widget">
						<a href="#"><img class="img-fluid" src="<?php _url(); ?>assets/front/images/blog/add.jpg" alt=""></a>
						<div class="br"></div>
					</aside>
					<aside class="single_sidebar_widget post_category_widget">
						<h4 class="widget_title">Post Catgories</h4>
						<ul class="list cat-list">
							<?php if(is_array(@$categories)):?>
								<?php foreach(@$categories as $categorie):?>
									<li>
										<a href="<?php _url("blog/".$categorie->categorie_id); ?>" class="d-flex justify-content-between">
											<p><?= $categorie->categorie_libelle ?></p>
											<p><?= count(get_nb_blog($categorie->categorie_id)) ?></p>
										</a>
									</li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
						<div class="br"></div>
					</aside>
					<aside class="single-sidebar-widget newsletter_widget">
						<h4 class="widget_title">Newsletter</h4>
						<p>
							Here, I focus on a range of items and features that we use in life without
							giving them a second thought.
						</p>
						<div class="form-group d-flex flex-row">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
								</div>
								<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
							</div>
							<a href="#" class="bbtns">Envoyer</a>
						</div>
						<!-- <p class="text-bottom">You can unsubscribe at any time</p> -->
						<div class="br"></div>
					</aside>
					<!-- <aside class="single-sidebar-widget tag_cloud_widget">
					<h4 class="widget_title">Tag Clouds</h4>
					<ul class="list">
					<li><a href="#">Technology</a></li>
					<li><a href="#">Fashion</a></li>
					<li><a href="#">Architecture</a></li>
					<li><a href="#">Fashion</a></li>
					<li><a href="#">Food</a></li>
					<li><a href="#">Technology</a></li>
					<li><a href="#">Lifestyle</a></li>
					<li><a href="#">Art</a></li>
					<li><a href="#">Adventure</a></li>
					<li><a href="#">Food</a></li>
					<li><a href="#">Lifestyle</a></li>
					<li><a href="#">Adventure</a></li>
				</ul>
			</aside> -->
		</div>
	</div>
</div>
</div>
</section>
<!--================Blog Area =================-->
