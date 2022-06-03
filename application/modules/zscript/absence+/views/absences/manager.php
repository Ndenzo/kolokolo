<div class="row">
     <div class="col-12">
          <div class="email-right-aside bookmark-tabcontent">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <div class="card mb-0">
                                   <div class="card-header d-flex">
                                        <h6 class="mb-0">Gérer Absences</h6>
                                   </div>
                                   <div class="card-body pb-0">

                                        <?php show_notification();?>

                                        <div class="row list-persons" id="addcon">
                                             <div class="col-xxl-3 col-xl-3" >
                                                  <div class="col-12 nav nav-pills b-r-light p-r-25 p-b-25" aria-orientation="vertical" style="overflow-y: auto;">
                                                       <?php foreach(@$cycles as $k => $cycle):?>
                                                            <a class="nav-link col-12 element <?php if ($k == 0): ?> active <?php endif; ?>" id="v-pills-<?= $cycle->settings_cycle_id ?>-tab" data-toggle="pill" href="#v-pills-<?= $cycle->settings_cycle_id ?>" role="tab" aria-controls="v-pills-<?= $cycle->settings_cycle_id ?>" aria-selected="true" style="margin-bottom:0px!important;">
                                                                 <div class="media">
                                                                      <img class="img-50 img-fluid m-r-10 update_img_0" src="<?php _url(); ?>assets/custom/png/023-graduation cap.png">
                                                                      <div class="media-body">
                                                                           <h6 style="margin-top: 15px!important;"> <span><?= $cycle->settings_cycle_name ?></span></h6>
                                                                      </div>
                                                                 </div>
                                                            </a>
                                                       <?php endforeach;?>
                                                  </div>
                                             </div>

                                             <div class="col-xxl-9 col-xl-9" style="height: 600px;">
                                                  <div class="tab-content" id="v-pills-tabContent">
                                                       <?php foreach(@$cycles as $k => $cycle):?>
                                                            <div class="tab-pane contact-tab-4 tab-content-child fade <?php if ($k == 0): ?> show active <?php endif; ?>" id="v-pills-<?= $cycle->settings_cycle_id ?>" role="tabpanel" aria-labelledby="v-pills-<?= $cycle->settings_cycle_id  ?>-tab">
                                                                 <div class="row">
                                                                      <div class="col-xxl-4 col-xl-4">
                                                                           <div class="nav flex-column nav-pills" id="v-pillo-tab" role="tablist" aria-orientation="vertical">
                                                                                <?php foreach(@$cycle->trimestres as $kk => $trimestre):?>
                                                                                     <a class="nav-link <?php if ($kk == 0): ?> active <?php endif; ?>" id="v-pillo-<?= $trimestre->evaluation_trimestre_id ?>-tab" data-toggle="pill" href="#v-pillo-<?= $trimestre->evaluation_trimestre_id ?>" role="tab" aria-controls="v-pillo-<?= $trimestre->evaluation_trimestre_id ?>" aria-selected="true"><?= $trimestre->evaluation_trimestre_name ?></a>
                                                                                <?php endforeach;?>
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-xxl-8 col-xl-8">
                                                                           <div class="tab-content" id="v-pillo-tabContent" >
                                                                                <?php foreach(@$cycle->trimestres as $kk => $trimestre):?>
                                                                                     <div class="tab-pane fade <?php if ($kk == 0): ?> show active <?php endif; ?>" id="v-pillo-<?= $trimestre->evaluation_trimestre_id ?>" role="tabpanel" aria-labelledby="v-pillo-<?= $trimestre->evaluation_trimestre_id ?>-tab">

                                                                                          <div class="row mt-30 col-12" style="height: 450px; overflow-y: auto; overflow-x: hidden;">
                                                                                               <ul class="crm-activity mb-20" style="height:auto!important;">
                                                                                                    <?php foreach(@$trimestre->evaluations as $evaluation):?>
                                                                                                         <li class="media b-b-light p-20 <?php if ($evaluation->settings_evaluation_code == "con"): ?> bg-light-primary  <?php else: ?> bg-light-secondary  <?php endif; ?> mb-10">
                                                                                                              <div class="align-self-center media-body">

                                                                                                                   <h6 class="text-primary"><?= $evaluation->evaluation_modele_name ?> </h6>

                                                                                                                   <ul class="dates">
                                                                                                                        <li>Début <strong><?= mysql_to_date($evaluation->evaluation_modele_debut) ?></strong> </strong></li>
                                                                                                                        <li>fin <strong><?= mysql_to_date($evaluation->evaluation_modele_fin) ?></strong></li>
                                                                                                                   </ul>

                                                                                                              </div>

                                                                                                              <span class="f-right">
                                                                                                                   <div class="text-end text-center" style=";">
                                                                                                                        <div class="dropdown">
                                                                                                                             <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                                                             <div class="dropdown-menu dropdown-menu-end" style="font-weight: bold!important;">
                                                                                                                                  <a href="#custom-absence-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-primary" data-toggle="modal"><i class="fa fa-calendar-o"></i> Absences </a>
                                                                                                                                  <a href="#custom-retard-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-primary" data-toggle="modal"><i class="fa fa-clock-o"></i> Retards </a>
                                                                                                                                  <div class="dropdown-divider"></div>
                                                                                                                                  <!-- <a href="#custom-update-modele-modal" class="dropdown-item font-warning" data-toggle="modal" onclick="define_edit(<?= $evaluation->evaluation_modele_id ?>, 'scolarite/evaluation/showEdit_modele')"><strong><i class="fa fa-edit"></i> Modifier </strong></a>
                                                                                                                                  <a href="#custom-delete-modele-modal" class="dropdown-item font-danger" data-toggle="modal" onclick="define_delete(<?= $evaluation->evaluation_modele_id ?>, 'evaluation_modele_id')"><strong><i class="fa fa-trash"></i> Supprimer </strong></a> -->
                                                                                                                             </div>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </span>
                                                                                                         </li>

                                                                                                         <div id="custom-detail-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                                              <div class="modal-dialog modal-dialog-centered">
                                                                                                                   <div class="modal-content">
                                                                                                                        <div class="modal-header">
                                                                                                                             <h4 class="modal-title" id="myCenterModalLabel">Liste des classes</h4>
                                                                                                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                                        </div>
                                                                                                                        <div class="modal-body">
                                                                                                                             <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                                                                                                                  <thead>
                                                                                                                                       <tr>
                                                                                                                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:left;">Classes</th>
                                                                                                                                            <th style="text-align:center; width: 100px;">Action</th>
                                                                                                                                       </tr>
                                                                                                                                  </thead>
                                                                                                                                  <tbody>
                                                                                                                                       <?php foreach(@$evaluation->niveaux as $niveau):?>
                                                                                                                                            <tr>
                                                                                                                                                 <td style="text-align:left;"><?= @$niveau->settings_niveau_name ?></td>
                                                                                                                                                 <td>
                                                                                                                                                      <center>
                                                                                                                                                           <a href="<?= _url($module_base."showGrid/".@$niveau->settings_niveau_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
                                                                                                                                                      </center>
                                                                                                                                                 </td>
                                                                                                                                            </tr>
                                                                                                                                       <?php endforeach;?>
                                                                                                                                  </tbody>
                                                                                                                             </table>
                                                                                                                             <div class="modal-footer mt-3">
                                                                                                                                  <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                             </div>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                         <div id="custom-absence-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                                              <div class="modal-dialog modal-dialog-centered">
                                                                                                                   <div class="modal-content">
                                                                                                                        <div class="modal-header">
                                                                                                                             <h4 class="modal-title" id="myCenterModalLabel">Liste des classes</h4>
                                                                                                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                                        </div>
                                                                                                                        <div class="modal-body">
                                                                                                                             <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                                                                                                                  <thead>
                                                                                                                                       <tr>
                                                                                                                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:left;">Classes</th>
                                                                                                                                            <th style="text-align:center; width: 100px;">Action</th>
                                                                                                                                       </tr>
                                                                                                                                  </thead>
                                                                                                                                  <tbody>
                                                                                                                                       <?php foreach(@$evaluation->niveaux as $niveau):?>
                                                                                                                                            <tr>
                                                                                                                                                 <td style="text-align:left;"><?= @$niveau->settings_niveau_name ?></td>
                                                                                                                                                 <td>
                                                                                                                                                      <center>
                                                                                                                                                           <a href="<?= _url($module_base."showGrid/".@$niveau->evaluation_modele_niveau_id."/abs") ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
                                                                                                                                                      </center>
                                                                                                                                                 </td>
                                                                                                                                            </tr>
                                                                                                                                       <?php endforeach;?>
                                                                                                                                  </tbody>
                                                                                                                             </table>
                                                                                                                             <div class="modal-footer mt-3">
                                                                                                                                  <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                             </div>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>

                                                                                                         <div id="custom-retard-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                                              <div class="modal-dialog modal-dialog-centered">
                                                                                                                   <div class="modal-content">
                                                                                                                        <div class="modal-header">
                                                                                                                             <h4 class="modal-title" id="myCenterModalLabel">Liste des classes</h4>
                                                                                                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                                        </div>
                                                                                                                        <div class="modal-body">
                                                                                                                             <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                                                                                                                  <thead>
                                                                                                                                       <tr>
                                                                                                                                            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:left;">Classes</th>
                                                                                                                                            <th style="text-align:center; width: 100px;">Action</th>
                                                                                                                                       </tr>
                                                                                                                                  </thead>
                                                                                                                                  <tbody>
                                                                                                                                       <?php foreach(@$evaluation->niveaux as $niveau):?>
                                                                                                                                            <tr>
                                                                                                                                                 <td style="text-align:left;"><?= @$niveau->settings_niveau_name ?></td>
                                                                                                                                                 <td>
                                                                                                                                                      <center>
                                                                                                                                                           <a href="<?= _url($module_base."showGrid/".@$niveau->evaluation_modele_niveau_id."/ret") ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
                                                                                                                                                      </center>
                                                                                                                                                 </td>
                                                                                                                                            </tr>
                                                                                                                                       <?php endforeach;?>
                                                                                                                                  </tbody>
                                                                                                                             </table>
                                                                                                                             <div class="modal-footer mt-3">
                                                                                                                                  <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                             </div>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>

                                                                                                    <?php endforeach; ?>
                                                                                               </ul>
                                                                                          </div>
                                                                                     </div>

                                                                                <?php endforeach;?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
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
     </div>
</div>
