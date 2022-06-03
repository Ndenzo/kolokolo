<style media="screen">

</style>

<div class="row">
     <div class="col-lg-8">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mb-0">
                    Détail du projet
               </h5>
          </div>
     </div>
     <div class="col-lg-4 text-lg-right">
          <div class="btn-group" role="group" aria-label="Basic example">
               <a href="#custom-modal" class="btn btn-info btn-icon-text font-weight-bold" data-toggle="modal">
                    Simulateur
               </a>
          </div>
     </div>
</div>

<div class="row mt-4 mb-50">
     <div class="container">

          <div class="col-12">
               <div class="card" style="margin-top: 100px;">
                    <div class="card-body">
                         <div class="blog-box blog-list row">
                              <div class="col-5">
                                   <?php if ($project->project_picture == null): ?>
                                        <img class="img-fluid col-12" src="https://via.placeholder.com/43x43" alt="" style="margin-top: -150px">
                                   <?php else: ?>
                                        <img class="img-fluid col-12" src="<?= _url(@$project->project_picture); ?>" alt="" style="margin-top: -150px">
                                   <?php endif; ?>
                                   <h5 class="text-center mt-3 text-info font-weight-bold" style=""><?= $project->project_name ?> - <?= $project->project_address ?></h5>

                              </div>
                              <div class="col-7">
                                   <div class="col-12">

                                        <div class="row mt-3">
                                             <div class="col-3 text-center border p-3">
                                                  Durée restante
                                                  <br>
                                                  <strong class="mt-20"><?= @get_project_months($project->project_invest_debut, $project->project_invest_term) ?> mois</strong>
                                             </div>
                                             <div class="col-3 text-center border p-3">
                                                  Loyer prévue
                                                  <br>
                                                  <strong class="mt-20"><?= @$project->project_prev_rent ?>%</strong>
                                             </div>
                                             <div class="col-3 text-center border p-3">
                                                  Retour prévu
                                                  <br>
                                                  <strong class="mt-20"><?= @$project->project_prev_return ?>%</strong>
                                             </div>
                                             <div class="col-3 text-center border p-3">
                                                  Revenus Locatif
                                                  <br>
                                                  <strong class="mt-20"><?= @$project->project_local_income ?>F CFA</strong>
                                             </div>
                                        </div>


                                        <div class="d-flex justify-content-between mt-4">
                                             <p class="text-warning">actuel : <strong><?= thousand(get_project_investments($project->project_id)) ?></strong> F CFA</p>
                                             <p class="text-info">max: <strong><?= thousand($project->project_value) ?></strong>  F CFA</p>
                                        </div>
                                        <div class="progress progress-lg">
                                             <div class="progress-bar bg-warning" role="progressbar" style="width: <?= get_project_tx($project->project_id) ?>%" aria-valuenow="<?= get_project_tx($project->project_id) ?>" aria-valuemin="0" aria-valuemax="100"><?= get_project_tx($project->project_id) ?>%</div>
                                        </div>

                                        <div class="form-group mb-3 col-4">
                                             <input type="hidden" name="project_lat" id="project_lat" value="<?= $project->project_lat ?>">
                                        </div>
                                        <div class="form-group mb-3 col-8">
                                             <input type="hidden" name="project_lon" id="project_lon" value="<?= $project->project_lon ?>">
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="row mt-3">
                              <div class="col-12">
                                   <?php show_notification();?>
                              </div>
                              <div class="col-12 border-top">
                                   <ul class="nav nav-pills nav-pills-info ml-auto mr-auto offset-2 col-8" id="pills-tab" role="tablist" style="border-bottom: none; margin-bottom: 0px; margin-top : 20px; padding-bottom: 0px;">
                                        <li class="nav-item col-4 ml-auto mr-auto">
                                             <a class="nav-link text-center font-weight-bold active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Présentation</a>
                                        </li>
                                        <li class="nav-item col-4 ml-auto mr-auto">
                                             <a class="nav-link text-center font-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Evolutions</a>
                                        </li>
                                        <li class="nav-item col-4 ml-auto mr-auto">
                                             <a class="nav-link text-center font-weight-bold" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Détails</a>
                                        </li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>


          <div class="tab-content" id="pills-tabContent">

               <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="row">

                         <div class="col-12">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">DESCRIPTION </h5>
                                        </div>
                                        <div class="row">
                                             <div class="col-6 border-right">
                                                  <?= quill_format(@$project->project_desc) ?>
                                             </div>
                                             <div class="col-6">
                                                  <h6 class="mb-30 text-warning font-weight-bold">CARACTERISTIQUES </h6>
                                                  <p class="mb-3"> <strong>Adresse Complète</strong> : <span class="text-muted"><?= $project->project_address.", ".$project->sim_town_name.", ".$project->sim_state_name ?></span> </p>
                                                  <p class="mb-3"> <strong>Type d'immobilier</strong> : <span class="text-muted"><?= $project->sim_type_name ?></span> </p>

                                                  <?php if (@is_array($project->characteristics)): ?>
                                                       <?php foreach ($project->characteristics as $key => $charac): ?>
                                                            <p class="mb-3"> <strong><?= $charac->project_characteristic_code ?></strong> : <span class="text-muted"><?= $charac->project_characteristic_value ?></span> </p>
                                                       <?php endforeach; ?>
                                                  <?php endif; ?>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-12 mt-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">COMMODITES </h5>
                                        </div>
                                        <div class="card-body">
                                             <div class="row">
                                                  <?php if (@is_array($project->conveniences)): ?>
                                                       <?php foreach ($project->conveniences as $key => $convenience): ?>
                                                            <div class="col-3">
                                                                 <div class="text-center">
                                                                      <img class="mr-3 ml-2" src="<?= _url($convenience->convenience_image) ?>" style="width: 50px; height: 50px; border:none;">
                                                                      <h5 class="mt-2 text-primary"> <strong><?= $convenience->convenience_name ?></strong> </h5>
                                                                 </div>
                                                            </div>
                                                       <?php endforeach; ?>
                                                  <?php endif; ?>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-12 mt-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">GALERIE </h5>
                                        </div>
                                        <div class="card-body">
                                             <div class="row">
                                                  <div id="lightgallery" class="row lightGallery">
                                                       <?php if(is_array(@$project->pictures)):?>
                                                            <?php foreach(@$project->pictures as $key => $picture):?>
                                                                 <a href="<?= _url(@$picture->project_picture_link); ?>" class="image-tile gallery-item"><img src="<?= _url(@$picture->project_picture_link); ?>" alt="Galerie - <?= $project->project_name ?>" style="max-height:200px;"></a>
                                                            <?php endforeach;?>
                                                       <?php endif;?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-12 mt-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">LOCALISATION </h5>
                                        </div>
                                        <div class="card-body">
                                             <div class="row">
                                                  <div class="col-6 border-right">
                                                       <div class="col-12 border" id="map2" style="height:400px!important;"></div>
                                                  </div>
                                                  <div class="col-6">
                                                       <h6 class="mb-30 text-warning font-weight-bold">STRUCTURES VOISINES </h6>
                                                       <?php if (@is_array($project->neighborhoods)): ?>
                                                            <?php foreach ($project->neighborhoods as $key => $neighbor): ?>
                                                                 <p class="mb-3"> <strong><?= $neighbor->project_neighborhood_structure ?></strong> : <span class="text-muted"><?= $neighbor->project_neighborhood_distance ?></span> </p>
                                                            <?php endforeach; ?>
                                                       <?php endif; ?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-12 mt-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">CONTACTS </h5>
                                        </div>
                                        <div class="card-body">
                                             <div class="row">
                                                  <div class="col-6 border-right">
                                                       <?php if (@is_array($contacts)): ?>
                                                            <?php foreach ($contacts as $key => $contact): ?>
                                                                 <div class="col-12 grid-margin stretch-card">
                                                                      <button class="card" data-toggle="modal" data-target="#custom-contact_<?= $contact->contact_id ?>-modal">
                                                                           <div class="card-body">
                                                                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                                                                     <i class="mdi mdi-account-box-outline text-info mr-3" style="font-size: 70px;"></i>

                                                                                     <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                                                                          <h4 class="mb-2"><?= $contact->contact_fullname ?></h4>
                                                                                          <!-- <p class="text-muted mb-1"><?= $contact->contact_email ?></p> -->
                                                                                          <p class="mb-0 text-info font-weight-bold" style="font-size: 15px;"><?= $contact->contact_function ?></p>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </button>

                                                                      <div id="custom-contact_<?= $contact->contact_id ?>-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
                                                                           <div class="modal-dialog">
                                                                                <div class="modal-content">

                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel1">Contact</h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>

                                                                                     <div class="modal-body">
                                                                                          <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                                                                               <!-- <i class="mdi mdi-account-box-outline text-info mr-5" style="font-size: 70px;"></i> -->

                                                                                               <div class="col-12 mt-2 text-center">
                                                                                                    <h4 class="mb-2"><?= $contact->contact_fullname ?></h4>
                                                                                                    <!-- <p class="text-muted mb-1"><?= $contact->contact_email ?></p> -->
                                                                                                    <p class="mb-0 text-info font-weight-bold" style="font-size: 18px;"><?= $contact->contact_function ?></p>
                                                                                               </div>

                                                                                               <div class="row mt-5">
                                                                                                    <?php if(@$contact->contact_num != null): ?>
                                                                                                         <h5 class="col-5 mt-3">
                                                                                                              Téléphone :
                                                                                                         </h5>
                                                                                                         <div class="col-7 mt-3">
                                                                                                              <p class="mb-0 text-info font-weight-bold float-right" style="font-size: 18px;">
                                                                                                                   <?= @$contact->contact_num ?>
                                                                                                              </p>
                                                                                                         </div>
                                                                                                    <?php endif; ?>
                                                                                                    <?php if (@$contact->contact_email != null): ?>
                                                                                                         <h5 class="col-5 mt-3">
                                                                                                              Email :
                                                                                                         </h5>
                                                                                                         <div class="col-7 mt-3">
                                                                                                              <p class="mb-0 text-info font-weight-bold float-right" style="font-size: 18px;">
                                                                                                                   <?= @$contact->contact_email ?>
                                                                                                              </p>
                                                                                                         </div>
                                                                                                    <?php endif; ?>

                                                                                               </div>
                                                                                          </div>
                                                                                     </div>

                                                                                     <div class="modal-footer mt-3">
                                                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                     </div>

                                                                                </div><!-- /.modal-content -->
                                                                           </div><!-- /.modal-dialog -->
                                                                      </div>

                                                                 </div>
                                                            <?php endforeach; ?>
                                                       <?php endif; ?>
                                                  </div>


                                                  <div class="col-6">

                                                       <div class="col-12 grid-margin stretch-card">
                                                            <button class="card bg-success hoverable card-xl-stretch mb-xl-8" data-toggle="modal" data-target="#custom-toinvest-modal">
                                                                 <div class="card-body">
                                                                      <div class="row">
                                                                           <div class="col-3">
                                                                                <i class="mdi mdi-briefcase-check text-white" style="font-size: 70px;"></i>
                                                                           </div>
                                                                           <div class="col-9">
                                                                                <h3 class="text-white fw-bolder fs-2 mb-2 mt-3 font-weight-bold text-left">Devenez Investisseur</h3>
                                                                                <div class="fw-bold text-white text-left">Contactez-nous pour investir sur ce projet.</div>
                                                                           </div>
                                                                      </div>

                                                                 </div>
                                                            </button>
                                                       </div>

                                                       <!-- <div class="col-12 grid-margin stretch-card">
                                                            <div class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                                                 <div class="card-body">
                                                                      <div class="row">
                                                                           <div class="col-3">
                                                                                <i class="mdi mdi-link-variant text-white" style="font-size: 70px;"></i>
                                                                           </div>
                                                                           <div class="col-9">
                                                                                <h3 class="text-white fw-bolder fs-2 mb-2 mt-3 font-weight-bold">Devenez Partenaire</h3>
                                                                                <div class="fw-bold text-white text-left">Ecrivez-nous si vous souhaitez nouer un partenariat.</div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div> -->

                                                       <div id="custom-toinvest-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
                                                            <div class="modal-dialog">
                                                                 <div class="modal-content">
                                                                      <div class="modal-header">
                                                                           <h4 class="modal-title" id="customLabel">Faire un investissement</h4>
                                                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                      </div>
                                                                      <div class="modal-body container">
                                                                           <form class="row justify-content-center" action="#" method="post" enctype="multipart/form-data">
                                                                                <div class="col-10 col-md-12">

                                                                                     <div class="form-group mb-3">
                                                                                          <!-- <label>Objet</label> -->
                                                                                          <input type="text" class="form-control" placeholder="Numero de téléphone" name="rapport_name" required>
                                                                                     </div>

                                                                                     <div class="form-group mb-3">
                                                                                          <!-- <label>Message</label> -->
                                                                                          <input type="text" class="form-control" placeholder="Budget (min - max)" name="rapport_name" required>
                                                                                     </div>

                                                                                     <div class="form-group mb-3">
                                                                                          <!-- <label>Message</label> -->
                                                                                          <textarea class="form-control" placeholder="Ecrire message." name="name" rows="8"></textarea>
                                                                                     </div>
                                                                                </div>
                                                                           </form>
                                                                      </div>
                                                                      <div class="modal-footer ">
                                                                           <button type="submit" class="btn btn-success col-md-6 ml-auto mr-auto">Envoyer</button>
                                                                      </div>
                                                                 </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                       </div>

                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                    </div>

               </div>

               <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">

                         <div class="col-7">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">INFOS CHANTIER </h5>
                                        </div>
                                        <div class="accordion accordion-bordered" id="accordion-info" role="tablist" style="height: auto;">
                                             <?php if(is_array(@$project->infos)):?>
                                                  <?php foreach(@$project->infos as $key => $info):?>
                                                       <div class="card">
                                                            <div class="card-header text-info" role="tab" id="heading-<?= @$info->project_info_id ?>">
                                                                 <h6 class="mb-0">
                                                                      <a data-toggle="collapse" href="#collapse-<?= @$info->project_info_id ?>" aria-expanded="false" aria-controls="collapse-<?= @$info->project_info_id ?>">
                                                                           <?= @$info->project_info_name ?>
                                                                      </a>
                                                                 </h6>
                                                            </div>
                                                            <div id="collapse-<?= @$info->project_info_id ?>" class="collapse <?php if ($key == 0): ?>shows<?php endif; ?> " role="tabpanel" aria-labelledby="heading-<?= @$info->project_info_id ?>" data-parent="#accordion-info">
                                                                 <div class="card-body">


                                                                      <p class="mb-0 mt-4" style="text-align: left;"><?= @$info->project_info_desc ?> </p>

                                                                      <div class="d-flex mt-4 row">
                                                                           <?php if(is_array(@$info->pictures)):?>
                                                                                <?php foreach(@$info->pictures as $key => $picture):?>
                                                                                     <a class="col-4" data-fslightbox="gallery" href="<?= _url(@$picture->project_info_picture_link); ?>">
                                                                                          <?php $ext = @pathinfo(base_url(@$picture->project_info_picture_link), PATHINFO_EXTENSION); ?>
                                                                                          <?php if(in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])): ?>
                                                                                               <img src="<?= _url(@$picture->project_info_picture_link); ?>" class="col-12">
                                                                                          <?php else: ?>
                                                                                               <img src="<?= _url() ?>assets/custom/img/default/player.jpg" class="col-12">
                                                                                          <?php endif; ?>
                                                                                     </a>
                                                                                <?php endforeach;?>
                                                                           <?php endif;?>


                                                                      </div>

                                                                      <div class="row mt-4">
                                                                           <div class="col-7">
                                                                                <p>
                                                                                     <i class="mdi mdi-account text-info"></i>
                                                                                     <?= @$info->user_nicename ?>
                                                                                </p>
                                                                                <p>
                                                                                     <i class="mdi mdi-calendar-clock text-info"></i>
                                                                                     <?= gmdate("d-m-Y H:i", @$info->project_info_added)?>
                                                                                </p>
                                                                           </div>

                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </div>

                                   </div>
                              </div>
                         </div>

                         <div class="col-5">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">RAPPORTS </h5>
                                        </div>

                                        <div class="table-responsive">
                                             <table class="table table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Nom</th>
                                                            <th class="text-center" style="width: 70px;">Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if(is_array(@$project->reports)):?>
                                                            <?php foreach(@$project->reports as $key => $report):?>
                                                                 <tr>
                                                                      <td class="text-left">
                                                                           <p><?= @$report->project_report_name ?></p>
                                                                           <p class="text-muted"> <?= gmdate("d-m-Y H:i", @$report->project_report_added)?></p>
                                                                      </td>
                                                                      <td class="footable-last-visible text-center">
                                                                           <a href="<?php _url(@$report->project_report_link) ?>" class="text-info btn btn-inverse-info btn-small" target="_blank"><i class="fa fa-download mr-2"></i></a>

                                                                           <!-- <div class="dropdown dropleft">
                                                                                <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                     <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                     <?php if (me('role_code') == "root"): ?>
                                                                                          <div class="dropdown-divider"></div>
                                                                                          <a href="#custom-delete-report-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$report->project_report_id ?>, 'project_report_id')"><i class="fa fa-trash mr-2"></i> Supprimer</a>
                                                                                     <?php endif; ?>
                                                                                </div>
                                                                           </div> -->
                                                                      </td>
                                                                 </tr>
                                                            <?php endforeach;?>
                                                       <?php endif;?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>

                    </div>
               </div>

               <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <div class="row">

                         <div class="col-12 mb-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">PROGRAMME DU PROJET </h5>
                                        </div>
                                        <div class="timeline mt-5 col-12">

                                             <?php if(is_array(@$project->timelines)):?>
                                                  <?php foreach(@$project->timelines as $key => $timeline):?>
                                                       <?php if ($timeline->project_timeline_locked == 0): ?>
                                                            <div class="timeline-wrapper timeline-wrapper-warning">
                                                                 <div class="timeline-badge"></div>
                                                                 <div class="timeline-panel left-timeline">
                                                                      <div class="timeline-heading" style="text-align:left;">
                                                                           <h6 class="timeline-title" ><?= @$timeline->project_timeline_name ?></h6>
                                                                      </div>
                                                                      <div class="timeline-body" style="width: 400px">
                                                                           <p><?= get_month_fr($timeline->project_timeline_month) ?> <?= $timeline->project_timeline_year ?></p>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       <?php else: ?>
                                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-success">
                                                                 <div class="timeline-badge"></div>
                                                                 <div class="timeline-panel right-timeline">
                                                                      <div class="timeline-heading" style="text-align:left;">
                                                                           <h6 class="timeline-title"><?= @$timeline->project_timeline_name ?></h6>
                                                                      </div>
                                                                      <div class="timeline-body" style="width: 350px">
                                                                           <!-- <p><?= get_month_fr($timeline->project_timeline_month) ?> <?= $timeline->project_timeline_year ?></p> -->
                                                                           <p>Date : <?= mysql_to_date(@$timeline->project_timeline_date) ?></p>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       <?php endif; ?>

                                                       <div id="custom-lock-modal-<?= @$timeline->project_timeline_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                 <div class="modal-content">
                                                                      <div class="modal-header">
                                                                           <h4 class="modal-title" id="myCenterModalLabel">
                                                                                <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                                     Infirmer
                                                                                <?php else: ?>
                                                                                     Confirmer
                                                                                <?php endif; ?>
                                                                           </h4>
                                                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                           <form class="row justify-content-center" action="<?php _url($module_base.'timeline_locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                <div class="col-12">
                                                                                     <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                                                                          <p class="mt-2" style="font-size: 12px;">
                                                                                               Vous êtes sur le point de changer le statut de la timeline : <strong><?= @$timeline->project_timeline_name ?></strong> !
                                                                                          </p>
                                                                                          <?php if ($timeline->project_timeline_locked != 1): ?>
                                                                                               <p class="mt-2" style="font-size: 12px;">
                                                                                                    Veuiller spécifier la date de confirmation !
                                                                                               </p>
                                                                                          <?php endif; ?>
                                                                                     </div>
                                                                                     <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                                          <strong class="text-center mt-2 mb-2">Souhaitez vous continuer ? </strong>
                                                                                     <?php else: ?>
                                                                                          <div class="form-group mb-3 mt-3">
                                                                                               <label>Date de confirmation</label>
                                                                                               <input type="date" class="form-control mask-date" placeholder="" name="project_timeline_date" required>
                                                                                          </div>
                                                                                     <?php endif; ?>

                                                                                     <div class="modal-footer mt-3">
                                                                                          <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                                               <input type="hidden" type="text" name="project_timeline_locked" value="0">
                                                                                          <?php else: ?>
                                                                                               <input type="hidden" type="text" name="project_timeline_locked" value="1">
                                                                                          <?php endif; ?>
                                                                                          <input type="hidden" type="text" name="project_timeline_id" value="<?= @$timeline->project_timeline_id ?>">
                                                                                          <input type="hidden" type="text" name="project_id" value="<?= @$project->project_id ?>">
                                                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                          <button type="submit" class="btn btn-info col-md-6">
                                                                                               <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                                                    Infirmer
                                                                                               <?php else: ?>
                                                                                                    Confirmer
                                                                                               <?php endif; ?>
                                                                                          </button>
                                                                                     </div>
                                                                                </div>
                                                                           </form>
                                                                      </div>
                                                                 </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                       </div>
                                                  <?php endforeach;?>
                                             <?php endif;?>

                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-7">
                              <div class="card mt-3">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">INVESTISSEMENTS </h5>
                                        </div>
                                        <div class="col-12">
                                             <div class="mb-3">
                                                  <p>Nombre d'investissement : <strong><?= count(@get_project_investors($project->project_id)) ?></strong> </p>
                                             </div>
                                             <div class="table-responsive">
                                                  <table class="table table-striped table-bordered">
                                                       <thead>
                                                            <tr>
                                                                 <th class="text-center" style="width: 150px;">Date</th>
                                                                 <th>Nom</th>
                                                                 <th class="text-center" style="width: 200px;">Montant</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            <?php if(is_array(@get_project_investors($project->project_id))):?>
                                                                 <?php foreach(@get_project_investors($project->project_id) as $key => $investor):?>
                                                                      <tr>
                                                                           <td class="text-center">
                                                                                <?= gmdate("d-m-Y H:i", @$investor->investor_added)?>
                                                                           </td>
                                                                           <td class="text-left">
                                                                                <?= @$investor->person_first_name ?> <?= @$investor->person_last_name ?>
                                                                           </td>
                                                                           <td class="text-center">
                                                                                <?= thousand(@$investor->project_invest_value) ?> F CFA
                                                                           </td>
                                                                      </tr>
                                                                 <?php endforeach;?>
                                                            <?php endif;?>
                                                       </tbody>
                                                  </table>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-5">
                              <div class="card mt-3">
                                   <div class="card-body">
                                        <div class="card-title">
                                             <h5 class="font-weight-bold">DECAISSEMENTS </h5>
                                        </div>
                                        <div class="col-12" id="schedule_chart"></div>
                                        <div class="col-12 mb-3 mt-5 ml-5" id="schedule_legend">
                                             <?php $colors_1 = ['#540d6e', '#ee4266', '#ffd23f', '#3bceac', '#0ead69', '#072ac8', '#1e96fc', '#a2d6f9', '#fcf300', '#ffc600']; ?>
                                             <?php if(is_array(@$project->schedules)):?>
                                                  <?php foreach(@$project->schedules as $key => $schedule):?>
                                                       <div class="col-12 ml-3" style="text-align: left;">
                                                            <i style="background-color: <?= $colors_1[$key] ?>; height: 20px; width: 10%; float: left;"></i>
                                                            <p style="width: 90%; margin-top: 10px; font-size: 9px; margin-left: 60px;"><?= @$schedule->project_schedule_name ?></p>
                                                       </div>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </div>
                                   </div>
                              </div>
                         </div>

                    </div>

               </div>

          </div>
     </div>
</div>

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 90%;">
          <div class="modal-content">
               <form class="forms-sample">

                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel1">Simulateur</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                         <div class="row pb-4">
                              <div class="col-6 row">
                                   <div class="form-group col-12 mb-2">
                                        <label>Apport</label>
                                        <input type="number" min="1" class="form-control" id="invest_value" placeholder="Valeur">
                                   </div>
                                   <div class="form-group col-6 mb-2">
                                        <label>Période de placement</label>
                                        <select class="select_custom form-control" id="per_place" required>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3" selected>3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                             <option value="6">6</option>
                                             <option value="7">7</option>
                                             <option value="8">8</option>
                                             <option value="9">9</option>
                                             <option value="10">10</option>
                                        </select>
                                   </div>
                                   <div class="form-group col-6 mb-2">
                                        <label>Effet de levier</label>
                                        <select class="select_custom form-control" id="eff_lev" required>
                                             <option value="2">2</option>
                                             <option value="1.5" selected>1.5</option>
                                             <option value="1">1</option>
                                             <option value="0.5">0.5</option>
                                        </select>
                                   </div>
                                   <div class="form-group col-6 mb-2">
                                        <label>Taux d'emprunt</label>
                                        <input type="text" class="form-control" id="tx_emp" value="<?= @$project->param->tx_emp ?>" disabled>
                                   </div>
                                   <div class="form-group col-6 mb-2">
                                        <label>Yield</label>
                                        <input type="text" class="form-control" id="yield" value="<?= @$project->param->yield ?>" disabled>
                                   </div>
                                   <?php if(@sim_meta('tax_loc') != null): ?>
                                        <input type="hidden" class="form-control sim" id="tax_loc" value="<?= sim_meta('tax_loc') ?>" disabled>
                                   <?php else: ?>
                                        <input type="hidden" class="form-control sim" id="tax_loc">
                                   <?php endif; ?>
                                   <?php if(@sim_meta('abat_for') != null): ?>
                                        <input type="hidden" class="form-control sim" id="abat_for" value="<?= sim_meta('abat_for') ?>" disabled>
                                   <?php else: ?>
                                        <input type="hidden" class="form-control sim" id="abat_for">
                                   <?php endif; ?>
                                   <?php if(@sim_meta('rent_esc') != null): ?>
                                        <input type="hidden" class="form-control sim" id="rent_esc" value="<?= sim_meta('rent_esc') ?>" disabled>
                                   <?php else: ?>
                                        <input type="hidden" class="form-control sim" id="rent_esc">
                                   <?php endif; ?>

                                   <div class="col-12 mt-3">
                                        <div class="table-responsive pt-3">
                                             <table class="table table-bordered">
                                                  <thead>
                                                       <tr class="bg-inverse-light">
                                                            <th class="font-weight-bold">
                                                                 Description
                                                            </th>
                                                            <th class="font-weight-bold">
                                                                 Valeur
                                                            </th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <tr>
                                                            <td>
                                                                 Apport
                                                            </td>
                                                            <td>
                                                                 <strong id="apport_view"></strong>
                                                            </td>
                                                       </tr>
                                                       <tr>
                                                            <td>
                                                                 Montant de la dette
                                                            </td>
                                                            <td>
                                                                 <strong id="mnt_dette_view"></strong>
                                                                 <input type="hidden" id="mnt_dette">
                                                            </td>
                                                       </tr>
                                                       <tr>
                                                            <td>
                                                                 Gain Annuel
                                                            </td>
                                                            <td>
                                                                 <strong id="gain_view"></strong>
                                                                 <input type="hidden" id="mnt_gain">
                                                            </td>
                                                       </tr>
                                                       <tr>
                                                            <td>
                                                                 Montant de l'intérêt
                                                            </td>
                                                            <td>
                                                                 -
                                                                 <strong id="mnt_inter_view"></strong>
                                                                 <input type="hidden" id="mnt_inter">
                                                            </td>
                                                       </tr>
                                                       <tr>
                                                            <td>
                                                                 Montant total
                                                            </td>
                                                            <td>
                                                                 <strong id="sim_total_view"></strong>
                                                                 <input type="hidden" id="mnt_sim_total">
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-6 row">
                                   <div id="simulator_bar"  class="col-10 offset-1 mt-50"></div>
                              </div>
                         </div>

                    </div>
               </form>

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                    <button  id="sim_activate"  class="btn btn-success col-md-4">Simuler</button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-schedule-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 60%!important;">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Décaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <div class="modal-body">
                    <div class="row">

                         <div class="col-6 mb-3">
                              <div class="col-12" id="schedule_chart"></div>
                         </div>

                         <div class="col-6 mb-3 mt-5" id="schedule_legend">
                              <?php $colors_1 = ['#540d6e', '#ee4266', '#ffd23f', '#3bceac', '#0ead69', '#072ac8', '#1e96fc', '#a2d6f9', '#fcf300', '#ffc600']; ?>
                              <?php if(is_array(@$project->schedules)):?>
                                   <?php foreach(@$project->schedules as $key => $schedule):?>
                                        <div class="col-12 ml-3" style="text-align: left;">
                                             <i style="background-color: <?= $colors_1[$key] ?>; height: 20px; width: 10%; float: left;"></i>
                                             <p style="width: 90%; margin-top: 10px; font-size: 9px; margin-left: 60px;"><?= @$schedule->project_schedule_name ?></p>
                                        </div>
                                   <?php endforeach;?>
                              <?php endif;?>
                         </div>

                    </div>
               </div>

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-timeline-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 50%!important;">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Programme du projet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <div class="modal-body">
                    <div class="timeline mt-4 col-12">

                         <?php if(is_array(@$project->timelines)):?>
                              <?php foreach(@$project->timelines as $key => $timeline):?>
                                   <?php if ($timeline->project_timeline_locked == 0): ?>
                                        <div class="timeline-wrapper timeline-wrapper-warning">
                                             <div class="timeline-badge"></div>
                                             <div class="timeline-panel left-timeline">
                                                  <div class="timeline-heading" style="text-align:left;">
                                                       <h6 class="timeline-title" ><?= @$timeline->project_timeline_name ?></h6>
                                                  </div>
                                                  <div class="timeline-body" style="width: 400px">
                                                       <p><?= get_month_fr($timeline->project_timeline_month) ?> <?= $timeline->project_timeline_year ?></p>
                                                  </div>
                                             </div>
                                        </div>
                                   <?php else: ?>
                                        <div class="timeline-wrapper timeline-inverted timeline-wrapper-success">
                                             <div class="timeline-badge"></div>
                                             <div class="timeline-panel right-timeline">
                                                  <div class="timeline-heading" style="text-align:left;">
                                                       <h6 class="timeline-title"><?= @$timeline->project_timeline_name ?></h6>
                                                  </div>
                                                  <div class="timeline-body" style="width: 350px">
                                                       <!-- <p><?= get_month_fr($timeline->project_timeline_month) ?> <?= $timeline->project_timeline_year ?></p> -->
                                                       <p>Date : <?= mysql_to_date(@$timeline->project_timeline_date) ?></p>
                                                  </div>
                                             </div>
                                        </div>
                                   <?php endif; ?>

                                   <div id="custom-lock-modal-<?= @$timeline->project_timeline_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                             <div class="modal-content">
                                                  <div class="modal-header">
                                                       <h4 class="modal-title" id="myCenterModalLabel">
                                                            <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                 Infirmer
                                                            <?php else: ?>
                                                                 Confirmer
                                                            <?php endif; ?>
                                                       </h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  </div>
                                                  <div class="modal-body">
                                                       <form class="row justify-content-center" action="<?php _url($module_base.'timeline_locker'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="col-12">
                                                                 <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                                                      <p class="mt-2" style="font-size: 12px;">
                                                                           Vous êtes sur le point de changer le statut de la timeline : <strong><?= @$timeline->project_timeline_name ?></strong> !
                                                                      </p>
                                                                      <?php if ($timeline->project_timeline_locked != 1): ?>
                                                                           <p class="mt-2" style="font-size: 12px;">
                                                                                Veuiller spécifier la date de confirmation !
                                                                           </p>
                                                                      <?php endif; ?>
                                                                 </div>
                                                                 <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                      <strong class="text-center mt-2 mb-2">Souhaitez vous continuer ? </strong>
                                                                 <?php else: ?>
                                                                      <div class="form-group mb-3 mt-3">
                                                                           <label>Date de confirmation</label>
                                                                           <input type="date" class="form-control mask-date" placeholder="" name="project_timeline_date" required>
                                                                      </div>
                                                                 <?php endif; ?>

                                                                 <div class="modal-footer mt-3">
                                                                      <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                           <input type="hidden" type="text" name="project_timeline_locked" value="0">
                                                                      <?php else: ?>
                                                                           <input type="hidden" type="text" name="project_timeline_locked" value="1">
                                                                      <?php endif; ?>
                                                                      <input type="hidden" type="text" name="project_timeline_id" value="<?= @$timeline->project_timeline_id ?>">
                                                                      <input type="hidden" type="text" name="project_id" value="<?= @$project->project_id ?>">
                                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                      <button type="submit" class="btn btn-info col-md-6">
                                                                           <?php if ($timeline->project_timeline_locked == 1): ?>
                                                                                Infirmer
                                                                           <?php else: ?>
                                                                                Confirmer
                                                                           <?php endif; ?>
                                                                      </button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                   </div>
                              <?php endforeach;?>
                         <?php endif;?>

                    </div>
               </div>

               <div class="modal-footer mt-5">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-invests-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 50%!important;">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Liste des investisseurs</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <div class="modal-body">
                    <div class="table-responsive">
                         <table class="table table-striped table-bordered">
                              <thead>
                                   <tr>
                                        <th class="text-center" style="width: 150px;">Date</th>
                                        <th>Nom</th>
                                        <th class="text-center" style="width: 200px;">Montant</th>
                                        <th class="text-center" style="width: 70px;">Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@get_project_investors($project->project_id))):?>
                                        <?php foreach(@get_project_investors($project->project_id) as $key => $investor):?>
                                             <tr>
                                                  <td class="text-center">
                                                       <?= gmdate("d-m-Y H:i", @$investor->investor_added)?>
                                                  </td>
                                                  <td class="text-left">
                                                       <?= @$investor->person_first_name ?> <?= @$investor->person_last_name ?>
                                                  </td>
                                                  <td class="text-center">
                                                       <?= thousand(@$investor->project_invest_value) ?> F CFA
                                                  </td>
                                                  <td class="footable-last-visible text-center">
                                                       <a href="#custom-delete-invest-modal" class="btn btn-small btn-outline-danger invest-action" data-toggle="modal" onclick="define_delete(<?= @$investor->project_invest_id ?>, 'project_invest_id')"><i class="mdi mdi-delete text-danger mr-1"></i></a>
                                                  </td>
                                             </tr>
                                        <?php endforeach;?>
                                   <?php endif;?>
                              </tbody>
                         </table>
                    </div>
               </div>

               <div class="modal-footer mt-5">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
$(document).ready(function() {

     if ($("#lightgallery").length) {
          $("#lightgallery").lightGallery();
     }


     if ($("#map2").length) {

          var map = L.map('map2').setView([$("#project_lat").val(), $("#project_lon").val()], 15);
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g', {
               attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
               maxZoom: 18,
               id: 'mapbox/streets-v11',
               tileSize: 512,
               zoomOffset: -1,
               accessToken: 'pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g'
          }).addTo(map);

          var marker = new L.marker([$("#project_lat").val(), $("#project_lon").val()],{
               draggable: false
          }).addTo(map);

     }

     $('#pills-contact-tab').on('shown.bs.tab', function () {
          if ($("#schedule_chart").length) {
               $( "#schedule_chart" ).empty();

               var data = [];
               var tmp;
               var colors_1 = ['#540d6e', '#ee4266', '#ffd23f', '#3bceac', '#0ead69', '#072ac8', '#1e96fc', '#a2d6f9', '#fcf300', '#ffc600'];
               var final_1 = [];

               <?php if(is_array(@$project->schedules)):?>
               <?php foreach(@$project->schedules as $key => $schedule):?>
               tmp = {};
               final_1.push(colors_1[<?= $key ?>]);
               tmp = {
                    "label":"<?= $schedule->project_schedule_name ?>",
                    "value":<?= $schedule->project_schedule_value ?>
               };
               data.push(tmp);
               <?php endforeach;?>
               <?php endif;?>

               Morris.Donut({
                    element: 'schedule_chart',
                    colors: final_1,
                    data: data,
                    labelColor: "#b1b1b5"
               });
          }
     });

     <?php if(is_array(@$project->infos)):?>
     <?php foreach(@$project->infos as $key => $info):?>
     <?php if(is_array(@$info->pictures)):?>
     $('#collapse-<?= @$info->project_info_id ?>').on('shown.bs.collapse', function () {
          if ($("#lightgallery-<?= @$info->project_info_id ?>").length) {
               $("#lightgallery-<?= @$info->project_info_id ?>").lightGallery();
          }
     });
     <?php endif;?>
     <?php endforeach;?>
     <?php endif;?>

})

</script>
