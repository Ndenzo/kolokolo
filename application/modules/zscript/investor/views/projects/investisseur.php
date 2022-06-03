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

<div class="row">
     <div class="col-lg-7">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mt-3">
                    Détail du projet
               </h5>
          </div>
     </div>
     <div class="col-lg-5 text-lg-right">
          <div class="btn-group" role="group" aria-label="Basic example">
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
                    Simulateur
               </a>
          </div>
     </div>
</div>

<div class="row mt-4">
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
                                        <!-- <a href="#custom-timeline-modal" class="btn btn-inverse-info" data-toggle="modal">
                                        <i class="fa fa-calendar-o"></i>
                                   </a> -->
                                   <a href="#custom-invests-modal" class="btn btn-inverse-info" data-toggle="modal">
                                        <i class="fa fa-list"></i>
                                   </a>
                                   <!-- <a href="#custom-schedule-modal" class="btn btn-inverse-info" data-toggle="modal">
                                   <i class="fa fa-sign-out"></i>
                              </a> -->
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
                              <a class="nav-link" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false"><i class="mdi mdi-buffer"></i> Chantier</a>
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
                                                                                <div id="lightgallery-<?= @$info->project_info_id ?>" class="row lightGallery">
                                                                                     <?php foreach(@$info->pictures as $key => $picture):?>
                                                                                          <a href="<?= _url(@$picture->project_info_picture_link); ?>" class="w-25 h-100 rounded image-tile gallery-item mr-2"><img src="<?= _url(@$picture->project_info_picture_link); ?>" alt="Galerie - <?= $info->project_info_name ?>" style="max-height:200px;"></a>
                                                                                     <?php endforeach;?>
                                                                                </div>
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
     <div class="modal-dialog" style="max-width: 60%;">
          <div class="modal-content">
               <form class="forms-sample">

                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel1">Simulateur</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                         <div class="row border-bottom pb-4">
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
                         </div>
                         <div class="card mt-4">
                              <div class="card-body bg-inverse-secondary">
                                   <div class="row">
                                        <div class="col-6">
                                             <div class="form-group col-12 mb-2">
                                                  <label>Montant de la dette</label>
                                                  <br>
                                                  <strong id="mnt_dette_view"></strong>
                                                  <input type="hidden" id="mnt_dette">
                                             </div>
                                             <hr>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Montant de l'intérêt</label>
                                                  <br>
                                                  <strong id="mnt_inter_view"></strong>
                                                  <input type="hidden" id="mnt_inter">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Revenue Net d'exploitation (NOI)</label>
                                                  <br>
                                                  <strong id="rev_net_exp_view"></strong>
                                                  <input type="hidden" id="rev_net_exp">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Montant Total d'Investissement</label>
                                                  <br>
                                                  <strong id="mnt_total_invest_view"></strong>
                                                  <input type="hidden" id="mnt_total_invest">
                                             </div>
                                        </div>

                                        <div class="col-6">
                                             <div class="form-group col-12 mb-2">
                                                  <label>ROE</label>
                                                  <br>
                                                  <strong id="roe_view"></strong>
                                                  <input type="hidden" id="roe">
                                             </div>
                                             <hr>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Cash on cash return</label>
                                                  <br>
                                                  <strong id="cash_on_cash_view"></strong>
                                                  <input type="hidden" id="cash_on_cash">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>DRCI</label>
                                                  <br>
                                                  <strong id="drci_view"></strong>
                                                  <input type="hidden" id="drci">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Debt service coverage</label>
                                                  <br>
                                                  <strong id="ebitda_view"></strong>
                                                  <input type="hidden" id="ebitda">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </form>

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                    <button  id="sim_activate"  class="btn btn-success col-md-6">Simuler</button>
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

</script>
