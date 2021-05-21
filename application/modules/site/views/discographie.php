<div class="breadcrumb-option">
     <div class="container">
          <div class="row">
               <div class="col-lg-12">
                    <div class="breadcrumb__links">
                         <a href="#"><i class="fa fa-home"></i> Accueil</a>
                         <span>Discographie</span>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Breadcrumb End -->

<!-- Discography Section Begin -->
<section class="discography spad">
     <div class="container">
          <div class="row">
               <div class="col-lg-12">
                    <div class="section-title center-title" style="margin-bottom: 150px;">
                         <!-- <h2>Latest Releases</h2> -->
                         <h1 class="text-primary">Discography</h1>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-7 p-0">
                    <div class="track__content nice-scroll">
                         <?php if (is_array(@$singles)): ?>
                              <?php foreach (@$singles as $key => $single): ?>
                                   <div class="single_player_container">
                                        <h4><?= @$single->single_name ?></h4>
                                        <div class="jp-jplayer jplayer" data-ancestor=".jp_container_<?= @$single->single_id ?>" data-url="<?= _url(@$single->single_link) ?>"></div>
                                        <div class="jp-audio jp_container_<?= @$single->single_id ?>" role="application" aria-label="media player">
                                             <div class="jp-gui jp-interface">
                                                  <!-- Player Controls -->
                                                  <div class="player_controls_box">
                                                       <button class="jp-play player_button" tabindex="0" id="audio_<?= @$single->single_id ?>"></button>
                                                  </div>
                                                  <!-- Progress Bar -->
                                                  <div class="player_bars">
                                                       <div class="jp-progress">
                                                            <div class="jp-seek-bar">
                                                                 <div>
                                                                      <div class="jp-play-bar">
                                                                           <div class="jp-current-time" role="timer" aria-label="time">0:00</div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="jp-duration ml-auto" role="timer" aria-label="duration">00:00</div>
                                                  </div>
                                                  <!-- Volume Controls -->
                                                  <div class="jp-volume-controls">
                                                       <button class="jp-mute" tabindex="0">
                                                            <i class="fa fa-volume-down"></i>
                                                       </button>
                                                       <div class="jp-volume-bar">
                                                            <div class="jp-volume-bar-value" style="width: 0%;"></div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              <?php endforeach; ?>
                         <?php endif; ?>
                    </div>
               </div>

               <div class="col-lg-5 p-0">
                    <div class="track__pic">
                         <img id="single_view" style="width: 100%; height: 100%;" src="<?php _url(@reset($singles)->single_picture); ?>" alt="">
                    </div>
               </div>
          </div>

          <div class="row" style="margin-top: 150px;">
               <div class="col-lg-12">
                    <div class="section-title center-title" style="margin-bottom: 150px;">
                         <h1 class="text-primary">Singles</h1>
                    </div>
               </div>
          </div>
          <div class="row">
               <?php if (is_array(@$singles)): ?>
                    <?php foreach (@$singles as $key => $single): ?>
                         <div class="col-lg-4 col-md-6 col-sm-6">
                              <div class="discography__item">
                                   <div class="discography__item__pic">
                                        <img id="single_view_<?= @$single->single_id ?>" src"<?= str_replace("/", " ", _url(@$single->single_picture)) ?>" alt="">
                                   </div>
                                   <div class="discography__item__text">
                                        <span><?= thousand(@$single->single_value) ?> F CFA</span>
                                        <h4><?= @$single->single_name ?></h4>

                                        <a href="#custom-modal-<?= @$single->single_id ?>" class="btn btn-primary" data-toggle="modal">Acheter</a>

                                        <div id="custom-modal-<?= @$single->single_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                             <div class="modal-dialog ">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Acheter - <?= @$single->single_name ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <form class="row justify-content-center" action="<?php _url($module_base.'insert_payment'); ?>" method="post">
                                                                 <div class="col-10 col-md-10">

                                                                      <div class="discography__item__pic col-8 ml-auto mr-auto">
                                                                           <img id="single_view_purchase_<?= @$single->single_id ?>" src"" alt="">
                                                                      </div>

                                                                      <div style="text-align: center;">
                                                                           <h4> <strong><?= @$single->single_name ?></strong> </h4>
                                                                      </div>

                                                                      <div class="form-group mb-3">
                                                                           <input type="text" class="form-control" placeholder="Votre prenom *" name="vente_first_name" required>
                                                                      </div>
                                                                      <div class="form-group mb-3">
                                                                           <input type="text" class="form-control" placeholder="Votre nom *" name="vente_last_name" required>
                                                                      </div>
                                                                      <div class="form-group mb-3">
                                                                           <input type="email" class="form-control" placeholder="Votre email *" name="vente_email" required>
                                                                      </div>

                                                                      <div class="modal-footer mt-3">
                                                                           <?php $code = password_generator(); ?>
                                                                           <input type="hidden" name="product[]" value="<?= @$single->single_name ?>" required>
                                                                           <input type="hidden" name="qte[]" value="1" required>
                                                                           <input type="hidden" name="pu[]" value="<?= @$single->single_value ?>" required>
                                                                           <input type="hidden" name="desc[]" value="<?= $code ?>" required>

                                                                           <input type="hidden" name="vente_pu" value="<?= @$single->single_value ?>" required>
                                                                           <input type="hidden" name="vente_qte" value="1" required>
                                                                           <input type="hidden" name="vente_product_id" value="<?= @$single->single_id ?>" required>
                                                                           <input type="hidden" name="vente_product" value="single" required>
                                                                           <input type="hidden" name="vente_code" value="<?= $code ?>" required>

                                                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                           <button type="submit" class="btn btn-success col-md-4">Continuer</button>
                                                                      </div>
                                                                 </div>
                                                            </form>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               <?php endif; ?>
          </div>

          <div class="row" style="margin-top: 150px;">
               <div class="col-lg-12">
                    <div class="section-title center-title" style="margin-bottom: 150px;">
                         <h1 class="text-primary">Streaming</h1>
                    </div>
               </div>
          </div>
          <div class="row">
               <?php if (is_array(@$streams)): ?>
                    <?php foreach (@$streams as $key => $stream): ?>
                         <div class="col-lg-3 col-md-3 col-sm-6">
                              <a href="<?= @$stream->stream_link ?>" target="_blank">
                                   <div class="youtube__item">
                                        <div class="youtube__item__pic set-bg" data-setbg="<?= _url(@$stream->stream_picture) ?>" style="background-position: center; background-size: 200px;">
                                        </div>
                                        <div class="youtube__item__text text-center">
                                             <h4><?= @$stream->stream_name ?></h4>
                                        </div>
                                   </div>
                              </a>
                         </div>
                    <?php endforeach; ?>
               <?php endif; ?>
          </div>
     </div>

</section>

<script type="text/javascript">
<?php if (is_array(@$singles)): ?>
<?php foreach (@$singles as $key => $single): ?>
element = document.getElementById("audio_<?= @$single->single_id ?>");
element.addEventListener("click", function(){
     document.getElementById("single_view").src = "<?= _url(@$single->single_picture) ?>";
});
document.getElementById("single_view_<?= @$single->single_id ?>").src = "<?= _url(@$single->single_picture) ?>"
document.getElementById("single_view_purchase_<?= @$single->single_id ?>").src = "<?= _url(@$single->single_picture) ?>"
<?php endforeach; ?>
<?php endif; ?>
</script>
