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
     <div class="col-xl-9 xl-60">
          <div class="row">
               <?php if(is_array(@$projects)):?>
                    <?php foreach(@$projects as $key => $project):?>
                         <div class="col-xl-12 mb-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="blog-box blog-list row">
                                             <div class="col-sm-4">
                                                  <?php if ($project->project_picture == null): ?>
                                                       <img class="img-fluid sm-100-w" src="https://via.placeholder.com/43x43" alt="">
                                                  <?php else: ?>
                                                       <img class="img-fluid sm-100-w" src="<?= _url(@$project->project_picture); ?>" alt="">
                                                  <?php endif; ?>
                                             </div>
                                             <div class="col-sm-8">
                                                  <div class="col-12">
                                                       <h5 class="text-center" style=""><?= $project->project_name ?> - <?= $project->project_address ?></h5>

                                                       <div class="row mt-3">
                                                            <div class="col-3 text-center border p-3 ml-3">
                                                                 Durée restante
                                                                 <br>
                                                                 <strong class="mt-20"><?= @get_project_months($project->project_invest_debut, $project->project_invest_term) ?> mois</strong>
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
                                                       <a href="<?= _url('content/project/showContent/'.$project->project_id) ?>" class="btn btn-inverse-info form-control mt-4">Consulter</a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach;?>
               <?php endif;?>

          </div>
     </div>
     <div class="col-xl-3 xl-40">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-body">

                              <div class="row">
                                   <div class="col-12">
                                        <div class="input-group">
                                             <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
                                             <div class="input-group-append">
                                                  <span class="input-group-text" id="search">
                                                       <i class="mdi mdi-magnify"></i>
                                                  </span>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="row mt-4">
                                   <div class="col-12 mt-3 mb-3">
                                        <p class="text-info" style="font-size: 20px;"><strong>Type d'immobilier</strong></p>
                                   </div>

                                   <div class="col-12">
                                        <div class="form-group">
                                             <?php foreach(@get_types() as $key => $type):?>
                                                  <div class="form-check form-check-primary">
                                                       <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" value="<?= @$type->sim_type_id ?>">
                                                            <?= @$type->sim_type_name ?>
                                                       </label>
                                                  </div>
                                             <?php endforeach;?>
                                        </div>
                                   </div>
                              </div>

                              <div class="row mt-4">
                                   <div class="col-12 mb-3">
                                        <p class="text-info" style="font-size: 20px;"><strong>Pays</strong></p>
                                   </div>

                                   <div class="col-12">
                                        <div class="form-group">
                                             <?php foreach(@get_states() as $key => $state):?>
                                                  <div class="form-check form-check-primary">
                                                       <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" value="<?= @$state->sim_state_id ?>">
                                                            <?= @$state->sim_state_name ?>
                                                       </label>
                                                  </div>
                                             <?php endforeach;?>
                                        </div>
                                   </div>
                              </div>

                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
