
<section class="hero-wrap hero-wrap-2" style="background-image: url(<?php _url(); ?>assets/front/images/about-3.jpg); background-position: top;" data-stellar-background-ratio="0.5">
     <div class="overlay"></div>
     <div class="container">
          <div class="row no-gutters slider-text align-items-end justify-content-start">
               <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?= _url('/') ?>">Accueil <i class="fa fa-chevron-right"></i></a></span> <span>Contact <i class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-3 bread">Contactez nous</h1>
               </div>
          </div>
     </div>
</section>

<section class="ftco-section contact-section ftco-no-pb mb-5" id="contact-section">
     <div class="container">
          <div class="row justify-content-center mb-5 pb-3">
               <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Contactez nous</span>
                    <h2 class="mb-4">Envoyez-nous un message pour plus de détails </h2>
                    <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
               </div>
          </div>

          <div class="row block-9">
               <div class="col-md-8">
                    <form class="p-4 p-md-5 contact-form" action="<?= _url($module_base."send_contact_mail") ?>" method="post">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Votre nom complet" name="contact_name" required>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Votre email" name="contact_email" required>
                                   </div>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Objet" name="contact_object" required>
                                   </div>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <textarea name="contact_content" id="" cols="30" rows="7" class="form-control" placeholder="Contenue" required></textarea>
                                   </div>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <input type="submit" value="Envoyer" class="btn btn-primary py-3 px-5">
                                   </div>
                              </div>
                         </div>
                    </form>

               </div>

               <div class="col-md-4 d-flex pl-md-5">
                    <div class="row">
                         <div class="dbox w-100 d-flex ftco-animate">
                              <div class="icon d-flex align-items-center justify-content-center">
                                   <span class="fa fa-map-marker"></span>
                              </div>
                              <div class="text">
                                   <p><span>Adresse :</span>HLM Grand Yoff en face Stade Léopold Sedar Senghor</p>
                              </div>
                         </div>
                         <div class="dbox w-100 d-flex ftco-animate">
                              <div class="icon d-flex align-items-center justify-content-center">
                                   <span class="fa fa-phone"></span>
                              </div>
                              <div class="text">
                                   <p><span>Téléphone :</span> <a href="tel://+221 77 490 91 34">+221 77 490 91 34</a> <br/> <a href="tel://+221 77 099 14 13">+221 77 099 14 13</a></p>
                              </div>
                         </div>
                         <div class="dbox w-100 d-flex ftco-animate">
                              <div class="icon d-flex align-items-center justify-content-center">
                                   <span class="fa fa-paper-plane"></span>
                              </div>
                              <div class="text">
                                   <p><span>Email :</span> <a href="mailto:contact@tmdbtp.com">contact@tmdbtp.com</a></p>
                              </div>
                         </div>
                         <!-- <div class="dbox w-100 d-flex ftco-animate">
                              <div class="icon d-flex align-items-center justify-content-center">
                                   <span class="fa fa-globe"></span>
                              </div>
                              <div class="text">
                                   <p><span>Website</span> <a href="#">yoursite.com</a></p>
                              </div>
                         </div> -->
                    </div>
               </div>
               <!-- <div class="col-md-12">
               <div id="map" class="map"></div>
          </div> -->
     </div>
</div>
</section>
