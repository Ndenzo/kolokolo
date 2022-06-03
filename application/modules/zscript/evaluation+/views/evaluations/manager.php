<div class="row">
     <div class="col-12">
          <div class="email-right-aside bookmark-tabcontent">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <div class="card mb-0">
                                   <div class="card-header d-flex">
                                        <h6 class="mb-0">Evaluation Manager</h6>
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
                                                                                <div class="col-12 dropdown-basic mt-30">
                                                                                     <div class="form-group mb-0 me-0"></div>
                                                                                     <div class="dropdown">
                                                                                          <button class="dropbtn btn btn-success form-control" type="button">
                                                                                               Evaluation Annuelle <span><i class="fa fa-download" style="margin-left: 20px;"></i></span>
                                                                                          </button>
                                                                                          <div class="dropdown-content" style="margin-top: -10px;">
                                                                                               <a href="#custom-annuelle-modal-<?= $cycle->settings_cycle_id ?>" class="dropdown-item font-primary" data-toggle="modal"><strong><i class="fa fa-print"></i> Générer bulletin </strong> </a>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>

                                                                           <!-- <div class="btn-group dropdown mt-30">
                                                                           <button type="button" class="btn btn-info waves-effect waves-light">Evaluation Annuelle</button>
                                                                           <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-chevron-down"></i></button>
                                                                           <div class="dropdown-menu">
                                                                      </div>
                                                                 </div> -->
                                                            </div>
                                                       </div>
                                                       <div class="col-xxl-8 col-xl-8">
                                                            <div class="tab-content" id="v-pillo-tabContent" >
                                                                 <?php foreach(@$cycle->trimestres as $kk => $trimestre):?>
                                                                      <div class="tab-pane fade <?php if ($kk == 0): ?> show active <?php endif; ?>" id="v-pillo-<?= $trimestre->evaluation_trimestre_id ?>" role="tabpanel" aria-labelledby="v-pillo-<?= $trimestre->evaluation_trimestre_id ?>-tab">
                                                                           <div class="row">
                                                                                <div class="f-left">
                                                                                     <a href="#custom-modal-<?= $trimestre->evaluation_trimestre_id ?>" class="btn btn-pill btn-outline-success btn-lg option-btn" data-toggle="modal"><i data-feather="plus"></i></a>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row mt-30 col-12" style="height: 450px; overflow-y: auto; overflow-x: hidden;">
                                                                                <ul class="crm-activity mb-20" style="height:auto!important;">
                                                                                     <?php foreach(@$trimestre->evaluations as $evaluation):?>
                                                                                          <li class="media b-b-light p-20 <?php if ($evaluation->settings_evaluation_code == "con"): ?> bg-light-primary  <?php else: ?> bg-light-secondary  <?php endif; ?> mb-10">
                                                                                               <div class="align-self-center media-body">

                                                                                                    <h6 class="text-primary"><?= $evaluation->evaluation_modele_name ?> </h6>

                                                                                                    <ul class="dates">
                                                                                                         <li>Start <strong><?= mysql_to_date($evaluation->evaluation_modele_debut) ?></strong> </strong></li>
                                                                                                         <li>End <strong><?= mysql_to_date($evaluation->evaluation_modele_fin) ?></strong></li>
                                                                                                    </ul>

                                                                                               </div>

                                                                                               <span class="f-right">
                                                                                                    <div class="text-end text-center" style=";">
                                                                                                         <div class="dropdown">
                                                                                                              <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                                                              <div class="dropdown-menu dropdown-menu-end" style="font-weight: bold!important;">
                                                                                                                   <a href="#custom-detail-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-secondary" data-toggle="modal"><strong> <i class="fa fa-calculator"></i> Remplir notes </strong></a>
                                                                                                                   <a href="#custom-dispense-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-warning" data-toggle="modal"><strong><i class="fa fa-user-times"></i> Dispensés d'évaluation </strong></a>
                                                                                                                   <div class="dropdown-divider"></div>
                                                                                                                   <a href="#custom-statistique-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-primary" data-toggle="modal"><strong><i class="fa fa-bar-chart-o"></i> Générer statistiques </strong></a>
                                                                                                                   <a href="#custom-releve-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-primary" data-toggle="modal"><strong><i class="fa fa-clipboard"></i> Générer relevé </strong></a>
                                                                                                                   <a href="#custom-bulletin-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item font-primary" data-toggle="modal"><strong><i class="fa fa-print"></i> Générer bulletin </strong></a>
                                                                                                                   <div class="dropdown-divider"></div>
                                                                                                                   <a href="#custom-update-modele-modal" class="dropdown-item font-warning" data-toggle="modal" onclick="define_edit(<?= $evaluation->evaluation_modele_id ?>, 'scolarite/evaluation/showEdit_modele')"><strong><i class="fa fa-edit"></i> Edit </strong></a>
                                                                                                                   <a href="#custom-delete-modele-modal" class="dropdown-item font-danger" data-toggle="modal" onclick="define_delete(<?= $evaluation->evaluation_modele_id ?>, 'evaluation_modele_id')"><strong><i class="fa fa-trash"></i> Remove </strong></a>
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

                                                                                          <div id="custom-bulletin-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                                                             <?php foreach(@$niveau->classe as $classe):?>
                                                                                                                                  <tr>
                                                                                                                                       <?php if(check_evaluation_modele_ready(@$niveau->evaluation_modele_niveau_id) == true): ?>
                                                                                                                                            <td style="text-align:left;"><?= @$classe->classe_name ?></td>
                                                                                                                                       <?php else: ?>
                                                                                                                                            <td style="text-align:left;"><?= @$classe->classe_name ?> <span class="text-warning" style="font-weight: bold; font-size: 11px;">( Bulletin à regénerez ! )</span> </td>
                                                                                                                                       <?php endif; ?>
                                                                                                                                       <td>
                                                                                                                                            <center>
                                                                                                                                                 <?php if(check_evaluation_modele_ready(@$niveau->evaluation_modele_niveau_id) == true): ?>
                                                                                                                                                      <a href="<?= _url("evaluation/bulletin/showBulletin/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-success option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="fa fa-print"></i></a>
                                                                                                                                                 <?php else: ?>
                                                                                                                                                      <a href="<?= _url("evaluation/bulletin/showBulletin/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-pill btn-outline-warning option-sm-btn" target="_blank" onclick="setTimeout(function(){ window.location.reload(); }, 200)"><i class="fa fa-refresh"></i></a>
                                                                                                                                                 <?php endif; ?>

                                                                                                                                            </center>
                                                                                                                                       </td>
                                                                                                                                  </tr>
                                                                                                                             <?php endforeach;?>
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

                                                                                          <div id="custom-releve-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                                                             <?php foreach(@$niveau->classe as $classe):?>
                                                                                                                                  <tr>
                                                                                                                                       <td style="text-align:left;"><?= @$classe->classe_name ?></td>
                                                                                                                                       <td>
                                                                                                                                            <center>
                                                                                                                                                 <a href="<?= _url("evaluation/releve/showReleve/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
                                                                                                                                            </center>
                                                                                                                                       </td>
                                                                                                                                  </tr>
                                                                                                                             <?php endforeach;?>
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

                                                                                          <div id="custom-statistique-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                                                             <?php foreach(@$niveau->classe as $classe):?>
                                                                                                                                  <tr>
                                                                                                                                       <td style="text-align:left;"><?= @$classe->classe_name ?></td>
                                                                                                                                       <td>
                                                                                                                                            <center>
                                                                                                                                                 <a href="<?= _url("evaluation/statistique/showStatistique/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
                                                                                                                                            </center>
                                                                                                                                       </td>
                                                                                                                                  </tr>
                                                                                                                             <?php endforeach;?>
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

                                                                                          <div id="custom-dispense-modal-<?= $evaluation->evaluation_modele_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                               <div class="modal-dialog modal-dialog-centered">
                                                                                                    <div class="modal-content">
                                                                                                         <div class="modal-header">
                                                                                                              <h4 class="modal-title" id="myCenterModalLabel">Les dispensés - <?= $evaluation->evaluation_modele_name ?></h4>
                                                                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                         </div>
                                                                                                         <div class="modal-body">
                                                                                                              <div class="alert alert-warning fade show mb-3">
                                                                                                                   <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                                                                                                   <h4>Note !</h4>
                                                                                                                   <p>Attention, les élèves sur cette liste ne seront pas pris en compte dans la génération des bulletins.</p>
                                                                                                              </div>
                                                                                                              <form class="row justify-content-center" id="matricule_checker_form_<?= $evaluation->evaluation_modele_id ?>" action="<?php _url($module_base.'insert_dispense'); ?>" method="post">
                                                                                                                   <div class="col-12">

                                                                                                                        <div class="form-group mb-3">
                                                                                                                             <label>Matricule de l'élève <span class="required">*</span></label>
                                                                                                                             <div class="input-group">
                                                                                                                                  <input type="text" class="form-control" name="eleve_matricule" required>
                                                                                                                                  <div class="input-group-append">
                                                                                                                                       <button class="btn btn-info waves-effect waves-light matricule_checker" type="button" onclick="check_matricule(<?= $evaluation->evaluation_modele_id ?>)"><i class="dropdown-icon mdi mdi-check"></i> Vérifier</button>
                                                                                                                                  </div>
                                                                                                                             </div>
                                                                                                                        </div>

                                                                                                                        <div id="dispense_<?= $evaluation->evaluation_modele_id ?>"></div>

                                                                                                                        <hr>
                                                                                                                        <div class="modal-footer mt-3">
                                                                                                                             <input type="hidden" name="evaluation_modele_id" value="<?= $evaluation->evaluation_modele_id ?>" required>
                                                                                                                             <input type="hidden" name="eleves_scolarite_id" id="eleves_scolarite_id_<?= $evaluation->evaluation_modele_id ?>" required>
                                                                                                                             <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                             <button type="submit" class="btn btn-success col-md-4 to_hide">Enregistrer</button>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                              </form>

                                                                                                              <?php if(is_array(@$evaluation->dispenses)):?>
                                                                                                                   <table class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                                                                                                        <thead>
                                                                                                                             <tr>
                                                                                                                                  <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:center;">Classes</th>
                                                                                                                                  <th style="text-align:left;">Eleves</th>
                                                                                                                                  <th style="text-align:center; width: 100px;">Action</th>
                                                                                                                             </tr>
                                                                                                                        </thead>
                                                                                                                        <tbody>
                                                                                                                             <?php foreach(@$evaluation->dispenses as $dispense):?>
                                                                                                                                  <tr>
                                                                                                                                       <td style="text-align:center;"><?= @$dispense->classe_name ?></td>
                                                                                                                                       <td style="text-align:left;"><?= @$dispense->prenoms ?> <?= @$dispense->nom ?></td>
                                                                                                                                       <td>
                                                                                                                                            <center>
                                                                                                                                                 <a href="<?= _url($module_base."delete_dispense/".@$dispense->evaluation_dispense_id) ?>" class="btn btn-pill btn-outline-success option-sm-btn" title="Enlever dispense" style="margin-top: -5px;"><i class="fa fa-user-plus"></i></a>
                                                                                                                                            </center>
                                                                                                                                       </td>
                                                                                                                                  </tr>
                                                                                                                             <?php endforeach;?>
                                                                                                                        </tbody>
                                                                                                                   </table>
                                                                                                              <?php endif; ?>

                                                                                                         </div>
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>


                                                                                     <?php endforeach; ?>
                                                                                </ul>
                                                                           </div>
                                                                      </div>

                                                                      <div id="custom-modal-<?= $trimestre->evaluation_trimestre_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">Add Activity</h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <form class="row justify-content-center" action="<?php _url($module_base.'insert_modele'); ?>" method="post">
                                                                                               <div class="col-12 col-md-12">

                                                                                                    <div class="form-group mb-3">
                                                                                                         <label>Type d'évaluation <span class="required">*</span></label>
                                                                                                         <?php dropDown('SELECT settings_evaluation_id, settings_evaluation_name FROM settings_evaluations', array(
                                                                                                              'id'=>'settings_evaluation_id_'.$trimestre->evaluation_trimestre_id,
                                                                                                              'name'=>'settings_evaluation_id',
                                                                                                              'class'=>'form-control selectpicker',
                                                                                                              'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                                                                                         )); ?>
                                                                                                    </div>

                                                                                                    <div class="form-group mb-3">
                                                                                                         <label>Niveau pris en compte <span class="required">*</span></label>
                                                                                                         <?php dropDown('SELECT settings_niveau_id, settings_niveau_name FROM settings_niveaux where settings_cycle_id = '.$cycle->settings_cycle_id , array(
                                                                                                              'id'=>'settings_niveau_cycle_id_'.$trimestre->evaluation_trimestre_id.'[]',
                                                                                                              'name'=>'settings_niveau_cycle_id[]',
                                                                                                              'class'=>'form-control selectpicker',
                                                                                                              'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" multiple required'
                                                                                                         )); ?>
                                                                                                    </div>

                                                                                                    <div class="form-group mb-3">
                                                                                                         <label>Code de l'évaluation <span class="required">*</span></label>
                                                                                                         <input type="text" class="form-control" placeholder="Code" name="evaluation_modele_code" required>
                                                                                                    </div>

                                                                                                    <div class="form-group mb-3">
                                                                                                         <label>Nom de l'évaluation <span class="required">*</span></label>
                                                                                                         <input type="text" class="form-control" placeholder="Nom" name="evaluation_modele_name" required>
                                                                                                    </div>

                                                                                                    <div class="form-group mb-3 row">
                                                                                                         <div class="col-6">
                                                                                                              <label>Date de début <span class="required">*</span></label>
                                                                                                              <input type="date" class="form-control" name="evaluation_modele_debut" required/>
                                                                                                         </div>
                                                                                                         <div class="col-6">
                                                                                                              <label>Date de fin <span class="required">*</span></label>
                                                                                                              <input type="date" class="form-control" name="evaluation_modele_fin" required/>
                                                                                                         </div>
                                                                                                    </div>

                                                                                               </div>
                                                                                               <div class="modal-footer mt-3">
                                                                                                    <input type="hidden" name="evaluation_trimestre_id" value="<?= $trimestre->evaluation_trimestre_id ?>" required>
                                                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                    <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                                               </div>
                                                                                          </form>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>

                                                                 <?php endforeach;?>





                                                                 <div id="custom-annuelle-modal-<?= $cycle->settings_cycle_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                               <?php if(is_array(@$evaluation->niveaux)):?>

                                                                                                    <?php foreach(@$evaluation->niveaux as $niveau):?>
                                                                                                         <?php foreach(@$niveau->classe as $classe):?>
                                                                                                              <tr>
                                                                                                                   <td style="text-align:left;"><?= @$classe->classe_name ?></td>
                                                                                                                   <td>
                                                                                                                        <center>
                                                                                                                             <?php if(check_annuelle_evaluation_modele_ready(@$classe->classe_id, $_SESSION['dashboard']['settings_scolarite_id'])): ?>
                                                                                                                                  <a href="<?= _url("evaluation/annuelle/showAnnuelle/".@$classe->classe_id) ?>" class="btn btn-pill btn-outline-success option-sm-btn" target="_blank"><i class="icon-eye"></i></a>
                                                                                                                             <?php else: ?>
                                                                                                                                  <a href="javascript:void(0)" class="btn btn-pill btn-outline-danger option-sm-btn disabled" data-container="body" title="" data-toggle="popover" data-placement="right" data-content="Des modifications ont été effectués. Regénerez les évaluations de cette classe." data-original-title="Alert !">
                                                                                                                                       <i class="fa fa-lock"></i>
                                                                                                                                  </a>
                                                                                                                             <?php endif; ?>
                                                                                                                        </center>
                                                                                                                   </td>
                                                                                                              </tr>
                                                                                                         <?php endforeach;?>
                                                                                                    <?php endforeach;?>

                                                                                               <?php endif;?>


                                                                                          </tbody>
                                                                                     </table>
                                                                                     <div class="modal-footer mt-3">
                                                                                          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
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

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Add Activity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_module'); ?>" method="post">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Code du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Code du module" name="evaluation_module_code" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Nom du module" name="evaluation_module_name" required>
                              </div>

                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier Module</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_module'); ?>" method="post">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Code du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Code du module" name="evaluation_module_code" id="evaluation_module_code" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Nom du module" name="evaluation_module_name" id="evaluation_module_name" required>
                              </div>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="evaluation_module_id" id="evaluation_module_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-module-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer module de niveau</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_module_niveau'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le module sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                         </div>
                         <div class="modal-footer mt-3">
                              <input type="hidden" type="text" name="evaluation_module_niveau_id" value="">
                              <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                              <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
