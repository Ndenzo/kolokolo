<style media="screen">

</style>

<div class="row">
     <div class="col-lg-8">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mb-0">
                    Tableau de bord
               </h5>
               <!-- <p class="ml-md-3 font-weight-light mb-0 mt-1">Dashboard</p> -->
          </div>
     </div>
     <div class="col-lg-4 text-lg-right">
          <div class="d-lg-flex justify-content-end  pageheader-icons">
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-heart-outline"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-calendar-blank"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-bookmark-outline"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-settings"></i></a>
          </div>
     </div>
</div>

<div class="row mt-4">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title">
                         <div class="row">
                              <div class="col-7">
                                   <h5 class="text-uppercase font-weight-bold mt-2">Projets</h5>
                              </div>
                              <div class="col-5">

                              </div>
                         </div>
                    </div>
                    <div class="owl-carousel">
                         <?php if(is_array(@$projects)):?>
                              <?php foreach(@$projects as $key => $project):?>
                                   <div class="mb-3" style="width: 450px!important;">
                                        <div class="card">
                                             <div class="card-body">
                                                  <div class="blog-box blog-list row">
                                                       <!-- <div class="col-12"> -->
                                                       <?php if ($project->project_picture == null): ?>
                                                            <img class="img-fluid col-12" src="https://via.placeholder.com/43x43" alt="" style="margin-top: -20px; border-radius: 10px;">
                                                       <?php else: ?>
                                                            <img class="img-fluid col-12" src="<?= _url(@$project->project_picture); ?>" alt="" style="margin-top: -20px; border-radius: 10px;">
                                                       <?php endif; ?>
                                                       <!-- </div> -->
                                                       <!-- <div class="col-12"> -->
                                                       <div class="col-12">
                                                            <h5 class="text-center" style=""><?= $project->project_name ?> - <?= $project->project_address ?></h5>

                                                            <div class="row mt-3">
                                                                 <div class="col-3 text-center border p-3 ml-3">
                                                                      Durée restante
                                                                      <br>
                                                                      <strong class="mt-20"><?= @$project->project_ ?> mois</strong>
                                                                 </div>
                                                                 <div class="col-3 offset-1 text-center border p-3">
                                                                      Loyer prévue
                                                                      <br>
                                                                      <strong class="mt-20"><?= @$project->project_prev_rent ?>%</strong>
                                                                 </div>
                                                                 <div class="col-3 offset-1 text-center border p-3">
                                                                      Retour prévu
                                                                      <br>
                                                                      <strong class="mt-20"><?= @$project->project_prev_return ?>%</strong>
                                                                 </div>
                                                            </div>

                                                            <div class="d-flex justify-content-between mt-4">
                                                                 <p class="text-warning">actuel : <strong><?= thousand(get_project_investments($project->project_id)) ?></strong> F CFA</p>
                                                                 <p class="text-info">max: <strong><?= thousand($project->project_value) ?></strong>  F CFA</p>
                                                            </div>
                                                            <div class="progress progress-lg">
                                                                 <div class="progress-bar bg-warning" role="progressbar" style="width: <?= get_project_tx($project->project_id) ?>%" aria-valuenow="<?= get_project_tx($project->project_id) ?>" aria-valuemin="0" aria-valuemax="100"><?= get_project_tx($project->project_id) ?>%</div>
                                                            </div>
                                                            <!-- <a href="<?= _url('investor/showProject/'.$project->project_id) ?>" class="btn btn-inverse-info form-control mt-4">Consulter</a> -->
                                                            <a href="<?= _url('content/project/showContent/'.$project->project_id) ?>" class="btn btn-inverse-info form-control mt-4">Consulter</a>

                                                       </div>
                                                       <!-- </div> -->
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              <?php endforeach;?>
                         <?php endif;?>
                    </div>

                    <a href="#" class="btn btn-outline-info btn-icon-text float-right text-uppercase mt-3" style="font-size: 10px;">
                         Tous les projets
                         <!-- <i class="mdi mdi-more btn-icon-append"></i> -->
                    </a>

               </div>
          </div>

          <div class="card mt-3">
               <div class="card-body">
                    <div class="card-title">
                         <div class="row">
                              <div class="col-7">
                                   <h5 class="text-uppercase font-weight-bold mt-2">Etudes</h5>
                              </div>
                              <div class="col-5">

                              </div>
                         </div>
                    </div>
                    <div class="owl-carousel-studies">
                         <?php if(is_array(@$studies)):?>
                              <?php foreach(@$studies as $key => $studie):?>
                                   <div class="mb-3" style="width: 450px!important;">
                                        <div class="card">
                                             <div class="card-body">
                                                  <h4 class="card-title"><?= $studie->studie_name ?></h4>
                                                  <div class="row">
                                                       <?php $cpt = 0; ?>
                                                       <?php foreach ($studie->contents as $key => $content): ?>
                                                            <?php if ($content->studie_content_type == 1 && $cpt == 0): ?>
                                                                 <?= substr(quill_format($content->studie_content_desc), 0, 200); ?>
                                                                 <?php $cpt++; ?>
                                                            <?php endif; ?>
                                                       <?php endforeach; ?>
                                                  </div>
                                                  <div class="d-flex justify-content-between mt-20">
                                                       <p class="text-muted mt-3">
                                                            <strong>Date : </strong><?= gmdate("d-m-Y", $studie->studie_added) ?>
                                                       </p>
                                                       <div class="float-right">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                 <a href="<?= _url($module_base.'showContent/'.$studie->studie_id) ?>" class="btn btn-info btn-icon-text btn-icon-prepend">
                                                                      Consulter
                                                                 </a>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              <?php endforeach;?>
                         <?php endif;?>
                    </div>

                    <a href="#" class="btn btn-outline-info btn-icon-text float-right text-uppercase mt-3" style="font-size: 10px;">
                         Toutes les études
                         <!-- <i class="mdi mdi-more btn-icon-append"></i> -->
                    </a>

               </div>
          </div>
     </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
     var owl = $('.owl-carousel');
     owl.owlCarousel({
          items: 2,
          rewind: true,
          autoplay: true,
          margin: 20,
          autoWidth: true,
          // center: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
          stagePadding: 20,
          slideBy: 1,
     });

     var owl = $('.owl-carousel-studie');
     owl.owlCarousel({
          items: 2,
          rewind: true,
          margin: 20,
          autoWidth: true,
          // center: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
          stagePadding: 20,
          slideBy: 3,
     });
})
</script>
