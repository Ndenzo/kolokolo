<style media="screen">
#pills-decais-tab-custom, #pills-timeline-tab-custom{
     border-radius: 5px!important;
}

.left-timeline{
     width: 50% !important;
     margin-left: 5%!important;
     /* left: 3px!important; */
}
.right-timeline{
     width: 50% !important;
     margin-left: 45%!important;
}
.timeline:before {
     left: 50%!important;
     /* margin-left: -1px!important; */
}
.timeline .timeline-wrapper .timeline-badge{
     left: calc(50% - 7px);
}
/* .c3 svg g{
width: -50% !important;
} */
</style>

<div class="row mb-3">
     <div class="col-lg-7">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mt-3">
                    Détail du projet
               </h5>
          </div>
     </div>
     <div class="col-lg-5 text-lg-right">
          <div class="btn-group" role="group" aria-label="Basic example">
               <a href="<?= _url($module_base.'showEdit/'.@$project->project_id) ?>" class="btn btn-warning">
                    <i class="mdi mdi-pencil text-white"></i>
               </a>
               <a href="#custom-desc-modal" class="btn btn-outline-info" data-toggle="modal">
                    <i class="mdi mdi-clipboard-text"></i>
               </a>
               <a href="#custom-galerie-modal" class="btn btn-outline-info" data-toggle="modal">
                    <i class="mdi mdi-image-multiple"></i>
               </a>
               <a href="#custom-position-modal" class="btn btn-outline-info" data-toggle="modal">
                    <i class="mdi mdi-map-marker"></i>
               </a>
               <a href="#custom-modal" class="btn btn-info btn-icon-text btn-icon-prepend" data-toggle="modal">
                    <i class="mdi mdi-plus btn-icon-prepend"></i>
                    Investir
               </a>
               <!-- <a href="#custom-decaissement-modal" class="btn btn-warning btn-icon-text btn-icon-prepend text-white" data-toggle="modal">
               <i class="fa fa-sign-out btn-icon-prepend"></i>
               Décaissement
          </a> -->
     </div>
</div>
</div>

<div class="row mt-4 mb-5">
     <div class="col-12">
          <div class="card">
               <div class="card-body" style="height: auto;">
                    <div class="row">
                         <div class="col-lg-5">
                              <div class="col-12 ml-auto mr-auto">
                                   <?php if ($project->project_picture == null): ?>
                                        <img class="img-fluid sm-100-w" src="https://via.placeholder.com/43x43" alt="" style="border-radius:10px; width: 100%!important; max-height: 350px!important">
                                   <?php else: ?>
                                        <img class="img-fluid sm-100-w" src="<?= _url(@$project->project_picture); ?>" alt="" style="border-radius:10px; width: 100%!important; max-height: 350px!important">
                                   <?php endif; ?>
                              </div>

                              <h5 class="text-info text-center mt-4 mb-4"><?= $project->project_name ?> - <?= $project->project_address ?></h5>

                              <div class="row">
                                   <div class="btn-group col-8 ml-auto mr-auto mb-4" role="group" aria-label="Basic example">
                                        <a href="#custom-timeline-modal" class="btn btn-inverse-info" data-toggle="modal">
                                             <i class="fa fa-calendar-o"></i>
                                        </a>
                                        <a href="#custom-invests-modal" class="btn btn-inverse-info" data-toggle="modal">
                                             <i class="fa fa-list"></i>
                                        </a>
                                        <a href="#custom-schedule-modal" class="btn btn-inverse-info" data-toggle="modal">
                                             <i class="fa fa-sign-out"></i>
                                        </a>
                                   </div>
                              </div>


                              <div class="border-top">
                                   <div class="d-flex justify-content-between mt-4">
                                        <p class="text-warning">actuel : <strong><?= thousand(get_project_investments($project->project_id)) ?></strong> F CFA</p>
                                        <p class="text-info">max: <strong><?= thousand($project->project_value) ?></strong>  F CFA</p>
                                   </div>
                                   <div class="progress progress-lg">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= get_project_tx($project->project_id) ?>%" aria-valuenow="<?= get_project_tx($project->project_id) ?>" aria-valuemin="0" aria-valuemax="100"><?= get_project_tx($project->project_id) ?>%</div>
                                   </div>
                              </div>

                              <div class="border-top  mt-4 mb-6">
                                   <div class="py-4">
                                        <p class="clearfix">
                                             <span class="float-left">
                                                  Durée de l'investissement
                                             </span>
                                             <span class="float-right text-muted">
                                                  <strong><?= @$project->project_invest_term ?> mois</strong>
                                             </span>
                                        </p>
                                        <p class="clearfix">
                                             <span class="float-left">
                                                  Durée restante
                                             </span>
                                             <span class="float-right text-muted">
                                                  <strong><?= @$project->project_invest_term ?> mois</strong>
                                             </span>
                                        </p>
                                        <p class="clearfix">
                                             <span class="float-left">
                                                  Loyer Prévisionnel
                                             </span>
                                             <span class="float-right text-muted">
                                                  <strong><?= @$project->project_prev_rent ?>%</strong>
                                             </span>
                                        </p>
                                        <p class="clearfix">
                                             <span class="float-left">
                                                  Retour Prévisionnel
                                             </span>
                                             <span class="float-right text-muted">
                                                  <strong><?= @$project->project_prev_return ?>%</strong>
                                             </span>
                                        </p>
                                   </div>
                              </div>

                              <div class="form-group mb-3 col-4">
                                   <input type="hidden" name="project_lat" id="project_lat" value="<?= $project->project_lat ?>">
                              </div>
                              <div class="form-group mb-3 col-8">
                                   <input type="hidden" name="project_lon" id="project_lon" value="<?= $project->project_lon ?>">
                              </div>
                         </div>
                         <div class="col-lg-7" id="project_content">

                              <?php show_notification();?>

                              <ul class="nav nav-pills nav-pills-primary mt-2" id="pills-tab" role="tablist">

                                   <li class="nav-item">
                                        <a class="nav-link active" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false"><i class="mdi mdi-buffer"></i> Chantier</a>
                                   </li>

                                   <li class="nav-item">
                                        <a class="nav-link" id="pills-programme-tab" data-toggle="pill" href="#pills-programme" role="tab" aria-controls="pills-programme" aria-selected="false"><i class="mdi mdi-calendar-clock"></i> Programmes</a>
                                   </li>

                                   <li class="nav-item">
                                        <a class="nav-link" id="pills-rapport-tab" data-toggle="pill" href="#pills-rapport" role="tab" aria-controls="pills-rapport" aria-selected="false"><i class="mdi mdi-file-multiple"></i> Rapports</a>
                                   </li>

                              </ul>

                              <div class="tab-content mb-3" id="pills-tabContent" style="max-height: 1000px; overflow-y: auto;">
                                   <div class="tab-pane fade show active" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="card-title row mb-5">
                                                       <h5 class="col-7">Infos Chantiers </h5>
                                                       <?php if (me('role_code') == "root"): ?>
                                                            <div class="col-5 mt-2">
                                                                 <a href="#custom-info-modal"  class="btn btn-success btn-sm float-right" data-toggle="modal" style="margin-top: -15px;"><i class="fa fa-plus"></i> Ajouter </a>
                                                            </div>
                                                       <?php endif; ?>
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

                                                                                <div class="d-flex mt-4">
                                                                                     <?php if(is_array(@$info->pictures)):?>
                                                                                          <?php foreach(@$info->pictures as $key => $picture):?>
                                                                                               <div class="col-4">
                                                                                                    <a data-fslightbox="gallery" href="<?= _url(@$picture->project_info_picture_link); ?>">
                                                                                                         <div class="row">

                                                                                                         </div>
                                                                                                         <?php $ext = @pathinfo(base_url(@$picture->project_info_picture_link), PATHINFO_EXTENSION); ?>
                                                                                                         <?php if(in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])): ?>
                                                                                                              <img src="<?= _url(@$picture->project_info_picture_link); ?>" class="col-12">
                                                                                                         <?php else: ?>
                                                                                                              <img src="<?= _url() ?>assets/custom/img/default/player.jpg" class="col-12">
                                                                                                         <?php endif; ?>
                                                                                                         <center>
                                                                                                              <a href="#custom-delete-picture-modal" class="btn btn-small btn-outline-danger text-danger mt-2" data-toggle="modal" onclick="define_delete(<?= @$picture->project_info_picture_id ?>, 'project_info_picture_id')"><i class="fa fa-trash"></i></a>
                                                                                                         </center>
                                                                                                    </a>

                                                                                               </div>
                                                                                          <?php endforeach;?>
                                                                                     <?php endif;?>
                                                                                </div>
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
                                                                                <div class="col-5 text-right mt-2">
                                                                                     <a href="#custom-picture-info-modal" class="btn btn-sm btn-outline-info" data-toggle="modal" onclick="define_delete(<?= @$info->project_info_id ?>, 'project_info_id')"><i class="mdi mdi-image-multiple text-info mr-1"></i></a>
                                                                                     <!-- <a href="#custom-update-info-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= @$info->project_info_id ?>, 'project/project/showEdit_info')"><i class="mdi mdi-pencil text-warning mr-1"></i></a> -->
                                                                                     <a href="#custom-delete-info-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= @$info->project_info_id ?>, 'project_info_id')"><i class="mdi mdi-delete text-danger mr-1"></i></a>
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

                                   <div class="tab-pane fade" id="pills-programme" role="tabpanel" aria-labelledby="pills-programme-tab">
                                        <div class="row" style="overflow: hidden;">
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
                                                                           <div class="d-flex align-items-center flex-wrap">
                                                                                <a href="#custom-lock-modal-<?= @$timeline->project_timeline_id ?>" class="btn btn-sm btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i></a>
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
                                                                           <div class="d-flex align-items-center flex-wrap">
                                                                                <a href="#custom-lock-modal-<?= @$timeline->project_timeline_id ?>" class="btn btn-sm btn-outline-warning ml-auto" data-toggle="modal"><i class="fa fa-remove"></i></a>
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

                                   <div class="tab-pane fade" id="pills-rapport" role="tabpanel" aria-labelledby="pills-rapport-tab">
                                        <div class="row">
                                             <div class="col-12">
                                                  <div class="card-title row mb-5">
                                                       <h5 class="col-7">Rapports </h5>
                                                       <?php if (me('role_code') == "root"): ?>
                                                            <div class="col-5 mt-2">
                                                                 <a href="#custom-report-modal"  class="btn btn-success btn-sm float-right" data-toggle="modal" style="margin-top: -15px;"><i class="fa fa-plus"></i> Ajouter </a>
                                                            </div>
                                                       <?php endif; ?>
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
                                                                                     <div class="dropdown dropleft">
                                                                                          <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                               <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                          </button>
                                                                                          <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                               <a href="<?php _url(@$report->project_report_link) ?>" class="text-info dropdown-item" target="_blank"><i class="fa fa-download mr-2"></i> Télécharger</a>
                                                                                               <?php if (me('role_code') == "root"): ?>
                                                                                                    <div class="dropdown-divider"></div>
                                                                                                    <a href="#custom-delete-report-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$report->project_report_id ?>, 'project_report_id')"><i class="fa fa-trash mr-2"></i> Supprimer</a>
                                                                                               <?php endif; ?>
                                                                                          </div>
                                                                                     </div>
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
                    </div>
               </div>
          </div>
     </div>
</div>

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 40%;">
          <div class="modal-content">
               <form class="justify-content-center" action="<?php _url($module_base.'insert_invest'); ?>" method="post">

                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel1">Ajouter investissement</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                         <div class="col-12">
                              <div class="form-group mb-2">
                                   <label>Email</label>
                                   <input type="email" class="form-control" name="investor_email" placeholder="Email de l'investisseur"  required>
                              </div>
                              <div class="form-group mb-2">
                                   <label>Montant</label>
                                   <input type="number" class="form-control" name="project_invest_value" placeholder="Valeur" min="1" step="0.01" required>
                              </div>
                              <div class="form-group mb-2">
                                   <label>Méthode</label>
                                   <?php dropDown('SELECT settings_payment_method_id, settings_payment_method_name FROM settings_payment_methods',array(
                                        'name'=>'settings_payment_method_id',
                                        'id'=>"settings_payment_method_id",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>
                              <div class="form-group mb-2">
                                   <label>Référence</label>
                                   <input type="text" class="form-control" name="project_invest_ref" placeholder="Justificatif de paiement" required>
                              </div>
                         </div>
                    </div>

                    <div class="modal-footer">
                         <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-success col-md-6">Enregistrer</button>
                    </div>

               </form>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-decaissement-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 40%;">
          <div class="modal-content">
               <form class="justify-content-center" action="<?php _url($module_base.'insert_bon'); ?>" method="post">

                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel1">Ajouter décaissement</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                         <div class="col-12">
                              <div class="form-group mb-3 row">
                                   <div class="col-7">
                                        <label>Numéro</label>
                                        <input type="text" class="form-control" placeholder="Numéro" name="decaissement_bon_num" value="<?= decaissement_code_generator() ?>" required readonly>
                                   </div>
                                   <div class="col-5">
                                        <label>Nombre d'éléments</label>
                                        <input type="number" class="form-control" placeholder="Nombre" name="nb_decaissement" id="nb_decaissement" min="0" required>
                                   </div>
                              </div>

                              <hr>

                              <div class="form-group mb-3" id="decaissements"></div>

                         </div>
                    </div>

                    <div class="modal-footer">
                         <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-success col-md-6">Enregistrer</button>
                    </div>

               </form>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-report-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Ajouter Rapport</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_report'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Importer <strong class="needed">(.pdf)</strong> </label>
                                   <input type="file" class="dropify"  name="project_report_link"/>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom du rapport</label>
                                   <input type="text" class="form-control" placeholder="rapport" name="project_report_name" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-info-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Ajouter Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_info'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Titre</label>
                                   <input type="text" class="form-control" placeholder="Titre de l'info" name="project_info_name" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" name="project_info_desc" rows="8" placeholder="Description ..." required></textarea>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-info-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Modifier Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_info'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Titre</label>
                                   <input type="text" class="form-control" placeholder="Titre de l'info" name="project_info_name" id="project_info_name" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" name="project_info_desc" rows="8" placeholder="Description ..." id="project_info_desc" required></textarea>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_info_id" id="project_info_id"/>
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-picture-info-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Modifier Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_info_picture'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Importer </label>
                                   <input type="file" class="dropify"  name="capture"/>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_info_id"/>
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
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

<div id="custom-desc-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 60%!important;">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Description</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <div class="modal-body" style="max-height: 450px; overflow: auto;">
                    <div class="row">

                         <div class="col-12" style="overflow: hidden; padding-right: 30px;">
                              <?= quill_format($project->project_desc) ?>
                         </div>

                    </div>
               </div>

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-galerie-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 60%!important;">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Galerie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <div class="modal-body">
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

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-position-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 50%!important;">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Position</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <div class="modal-body">
                    <div class="row">
                         <div class="col-12 border" id="map2" style="height:400px!important;"></div>
                    </div>
               </div>

               <div class="modal-footer">
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


<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-report-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_report'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12">
                              <p style="text-align: center; font-size: 14px;">
                                   Le rapport selectionner sera supprimer. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <input type="hidden" type="text" name="project_report_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-info-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_info'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12">
                              <p style="text-align: center; font-size: 14px;">
                                   L'info selectionner sera supprimer. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <input type="hidden" type="text" name="project_info_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-invest-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_invest'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12">
                              <p style="text-align: center; font-size: 14px;">
                                   L'investissement selectionner sera supprimer. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="project_id" id="project_id" value="<?= $project->project_id ?>" />
                                   <input type="hidden" type="text" name="project_invest_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-delete-picture-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_info_picture'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-2">
                              <p style="text-align: center; font-size: 14px;">
                                   L'élément selectionner sera supprimer définitivement. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="project_id" value="<?= $project->project_id ?>">
                                   <input type="hidden" type="text" name="project_info_picture_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>



<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>

<script type="text/javascript">

$('#custom-schedule-modal').on('shown.bs.modal', function () {
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

$('#custom-galerie-modal').on('shown.bs.modal', function () {
     if ($("#lightgallery").length) {
          $("#lightgallery").lightGallery();
          $(".gallery-item").on('click', function(){
               $('#custom-galerie-modal').modal('hide');
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

$('#custom-position-modal').on('shown.bs.modal', function () {
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
});

$(".invest-action").on('click', function(){
     $('#custom-invests-modal').modal('hide');
});

$('#nb_decaissement').on('keyup', function () {
     get_decaissements();
});

function get_decaissements(){

     var nb = $("#nb_decaissement").val();

     content = '<div class="form-group mb-3 mt-2 row" id="decaissements">';
     for(var i=0; i<nb; i++) {
          content += '<div class="col-7">'+
          '<label>Libelle</label>'+
          '<input type="text" class="form-control" placeholder="Libelle" name="decaissement_libelle['+i+']" required>'+
          '</div>'+
          '<div class="col-5">'+
          '<label>Montant</label>'+
          '<input type="number" class="form-control" placeholder="Valeur" name="decaissement_value['+i+']" min="0" required>'+
          '</div>';
     };
     content += '</div>';

     $('#decaissements').replaceWith(content);
}
</script>
