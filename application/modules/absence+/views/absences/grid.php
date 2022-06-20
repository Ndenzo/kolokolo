<style media="screen">
     td{
          font-size: 11px;
          vertical-align: middle;
     }
</style>
<div class="row">
     <div class="col-xl-7 col-md-12 box-col-12">
          <div class="email-right-aside bookmark-tabcontent">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <div class="card mb-0">
                                   <div class="card-header d-flex">
                                        <?php if($type == "abs"): ?>
                                             <h6 class="mb-0">Gestion des absences - <?= @$niveau->settings_niveau_name ?></h6>
                                        <?php else: ?>
                                             <h6 class="mb-0">Gestion des retards - <?= @$niveau->settings_niveau_name ?></h6>
                                        <?php endif; ?>
                                   </div>
                                   <div class="card-body pb-0 mb-30">

                                        <?php show_notification();?>

                                        <h4 class="font-primary"><?= $niveau->evaluation_trimestre_name ?></h4>
                                        <h6 class="font-dark"><?= $niveau->evaluation_modele_name ?></h6>

                                        <ul class="nav nav-pills nav-primary mt-30" id="pills-infotab" role="tablist">
                                             <?php foreach($classes as $kk => $classe): ?>
                                                  <li class="nav-item">
                                                       <a class="nav-link <?php if ($kk == 0): ?> active <?php endif; ?>" id="pills-info<?= @$classe->classe_id ?>-tab" data-toggle="pill" href="#pills-info<?= @$classe->classe_id ?>" role="tab" aria-controls="pills-info<?= @$classe->classe_id ?>" aria-selected="true">
                                                            <i class="fa fa-mortar-board"></i><?= @$classe->classe_name ?>
                                                       </a>
                                                  </li>
                                             <?php endforeach;?>
                                        </ul>

                                        <div class="tab-content" id="pills-infotabContent">
                                             <?php foreach($classes as $kk => $classe): ?>
                                                  <div class="tab-pane fade <?php if ($kk == 0): ?> show active <?php endif; ?>" id="pills-info<?= @$classe->classe_id ?>" role="tabpanel" aria-labelledby="pills-info<?= @$classe->classe_id ?>-tab">
                                                       <div class="col-12">
                                                            <table class="table table-striped table-bordered mt-10">
                                                                 <thead>
                                                                      <tr class="table-primary">
                                                                           <th colspan="2"> Elèves </th>
                                                                           <th style="border: 2px solid #dee2e6;"> Nombre </th>
                                                                           <th style="border: 2px solid #dee2e6;"> Actions </th>
                                                                      </tr>
                                                                 </thead>

                                                                 <tbody>
                                                                      <?php foreach($classe->eleves as $key => $eleve): ?>
                                                                           <tr>
                                                                                <td><?= $key+1 ?></td>
                                                                                <td class="text-left">
                                                                                     <?= $eleve->personne_prenoms." ".$eleve->personne_nom ?>
                                                                                </td>
                                                                                <td style="border: 2px solid #dee2e6;"> <?= $eleve->nombre_absence ?> </td>
                                                                                <td style="border: 2px solid #dee2e6;">
                                                                                     <ul class="social-list list-inline mb-0">
                                                                                          <li class="list-inline-item">
                                                                                               <a href="#custom-<?= $eleve->eleve_id ?>" class="btn btn-success option-sm-btn mt-1 mb-1" data-toggle="modal"><i class="icofont icofont-edit"></i></a>
                                                                                               <a href="javascript:show_details(<?= $eleve->eleve_id ?>)" class="btn btn-info option-sm-btn mt-1 mb-1"><i class="icofont icofont-eye-alt"></i></a>
                                                                                          </li>
                                                                                     </ul>
                                                                                </td>
                                                                           </tr>

                                                                           <div id="custom-<?= $eleve->eleve_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                     <div class="modal-content">
                                                                                          <div class="modal-header">

                                                                                               <?php if($type == "abs"): ?>
                                                                                                    <h4 class="modal-title" id="myCenterModalLabel">Absence de <?= $eleve->personne_prenoms." ".$eleve->personne_nom ?></h4>
                                                                                               <?php else: ?>
                                                                                                    <h4 class="modal-title" id="myCenterModalLabel">Retard de <?= $eleve->personne_prenoms." ".$eleve->personne_nom ?></h4>
                                                                                               <?php endif; ?>

                                                                                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                          </div>
                                                                                          <div class="modal-body">
                                                                                               <form class="row justify-content-center" action="<?= _url($module_base."insert_".$type) ?>" method="post">
                                                                                                    <div class="col-10 col-md-12">

                                                                                                         <?php if($type == "ret"): ?>
                                                                                                              <div class="form-group mb-3">
                                                                                                                   <label>Date de retard <span class="required">*</span></label>
                                                                                                                   <input type="date" class="form-control" placeholder="date" name="evaluation_retard_date" required>
                                                                                                              </div>
                                                                                                         <?php endif; ?>

                                                                                                         <div class="form-group mb-3">
                                                                                                              <label>Debut <span class="required">*</span></label>
                                                                                                              <?php if($type == "abs"): ?>
                                                                                                                   <input type="date" class="form-control" placeholder="date" name="evaluation_absence_debut" required>
                                                                                                              <?php else: ?>
                                                                                                                   <input type="time" class="form-control" placeholder="date" name="evaluation_retard_debut" required>
                                                                                                              <?php endif; ?>
                                                                                                         </div>

                                                                                                         <div class="form-group mb-3">
                                                                                                              <label>Fin <span class="required">*</span></label>
                                                                                                              <?php if($type == "abs"): ?>
                                                                                                                   <input type="date" class="form-control" placeholder="date" name="evaluation_absence_fin" required>
                                                                                                              <?php else: ?>
                                                                                                                   <input type="time" class="form-control" placeholder="date" name="evaluation_retard_fin" required>
                                                                                                              <?php endif; ?>
                                                                                                         </div>

                                                                                                         <div class="form-group mb-3">
                                                                                                              <label>Commentaire </label>
                                                                                                              <?php if($type == "abs"): ?>
                                                                                                                   <textarea class="form-control" placeholder="Commentaire ..." name="evaluation_absence_desc" rows="3"></textarea>
                                                                                                              <?php else: ?>
                                                                                                                   <textarea class="form-control" placeholder="Commentaire ..." name="evaluation_retard_desc" rows="3"></textarea>
                                                                                                              <?php endif; ?>
                                                                                                         </div>

                                                                                                         <div class="modal-footer mt-30">
                                                                                                              <input type="hidden" class="form-control" name="evaluation_modele_niveau_id" id="evaluation_modele_niveau_id" value="<?= $niveau->evaluation_modele_niveau_id ?>" required>
                                                                                                              <input type="hidden" class="form-control" name="eleves_scolarite_id" id="eleves_scolarite_id" value="<?= $eleve->eleves_scolarite_id ?>" required>

                                                                                                              <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                              <button type="submit" class="btn btn-success col-md-4">Enregistrer</button>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </form>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      <?php endforeach; ?>
                                                                 </tbody>
                                                            </table>

                                                            <div id="details">
                                                                 <?php foreach($classe->eleves as $key => $eleve): ?>
                                                                      <div id="detail_<?= $eleve->eleve_id ?>" class="to_hidde">
                                                                           <table  class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                                                                <thead>
                                                                                     <tr>
                                                                                          <?php if($type == "ret"): ?>
                                                                                               <th>Date</th>
                                                                                          <?php endif; ?>
                                                                                          <th>Debut</th>
                                                                                          <th>Fin</th>
                                                                                          <th>Commentaires</th>
                                                                                          <th style="text-align:center; width: 100px;">Action</th>
                                                                                     </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                     <?php foreach(@$eleve->absences as $absence):?>
                                                                                          <tr>
                                                                                               <?php if($type == "abs"): ?>
                                                                                                    <td class=""="text-center"><?= mysql_to_date(@$absence->evaluation_absence_debut) ?></td>
                                                                                                    <td class=""="text-center"><?= mysql_to_date(@$absence->evaluation_absence_fin) ?></td>
                                                                                                    <td class=""="text-center"><?= @$absence->evaluation_absence_desc ?></td>
                                                                                               <?php else: ?>
                                                                                                    <td class=""="text-center"><?= mysql_to_date(@$absence->evaluation_retard_date) ?></td>
                                                                                                    <td class=""="text-center"><?= @$absence->evaluation_retard_debut ?></td>
                                                                                                    <td class=""="text-center"><?= @$absence->evaluation_retard_fin ?></td>
                                                                                                    <td class=""="text-center"><?= @$absence->evaluation_retard_desc ?></td>
                                                                                               <?php endif; ?>
                                                                                               <td>
                                                                                                    <div class="item-action dropdown">
                                                                                                         <button class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>

                                                                                                         <?php if($type == "abs"): ?>
                                                                                                              <div class="dropdown-menu dropdown-menu-right">
                                                                                                                   <a href="#custom-update-modal" class="dropdown-item text-warning" data-toggle="modal" onclick="define_edit(<?= $absence->evaluation_absence_id ?>, 'scolarite/absence/showEdit_absence')"><i class="fa fa-edit"></i> Modifier </a>
                                                                                                                   <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $absence->evaluation_absence_id ?>, 'evaluation_absence_id')"><i class="fa fa-trash"></i> Supprimer </a>
                                                                                                              </div>
                                                                                                         <?php else: ?>
                                                                                                              <div class="dropdown-menu dropdown-menu-right">
                                                                                                                   <a href="#custom-update-modal" class="dropdown-item text-warning" data-toggle="modal" onclick="define_edit(<?= $absence->evaluation_retard_id ?>, 'scolarite/absence/showEdit_retard')"><i class="fa fa-edit"></i> Modifier </a>
                                                                                                                   <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $absence->evaluation_retard_id ?>, 'evaluation_retard_id')"><i class="fa fa-trash"></i> Supprimer </a>
                                                                                                              </div>
                                                                                                         <?php endif; ?>
                                                                                                    </div>
                                                                                               </td>
                                                                                          </tr>
                                                                                     <?php endforeach;?>
                                                                                </tbody>
                                                                           </table>
                                                                      </div>
                                                                 <?php endforeach; ?>
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


     <div class="col-xl-5 box-col-6">
          <div class="email-right-aside bookmark-tabcontent">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <div class="card mb-0">
                                   <div class="card-header d-flex">
                                        <h6 class="mb-0">Détails</h6>
                                   </div>
                                   <div class="card-body pb-0 mb-30">
                                        <div class="col-12" id="detail_view">
                                             <div class="text-info text-center to_change">
                                                  Les details des absences s'afficheront ici !
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


<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">
                         Modifier
                         <?php if($type == "abs"): ?>
                              absence
                         <?php else: ?>
                              retard
                         <?php endif; ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_'.$type); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <?php if($type == "ret"): ?>
                                   <div class="form-group mb-3">
                                        <label>Date de retard <span class="required">*</span></label>
                                        <input type="date" class="form-control" placeholder="date" name="evaluation_retard_date" id="evaluation_retard_date" required>
                                   </div>
                              <?php endif; ?>

                              <div class="form-group mb-3">
                                   <label>Debut <span class="required">*</span></label>
                                   <?php if($type == "abs"): ?>
                                        <input type="date" class="form-control" placeholder="date" name="evaluation_absence_debut" id="evaluation_absence_debut" required>
                                   <?php else: ?>
                                        <input type="time" class="form-control" placeholder="date" name="evaluation_retard_debut" id="evaluation_retard_debut" required>
                                   <?php endif; ?>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Fin <span class="required">*</span></label>
                                   <?php if($type == "abs"): ?>
                                        <input type="date" class="form-control" placeholder="date" name="evaluation_absence_fin" id="evaluation_absence_fin" required>
                                   <?php else: ?>
                                        <input type="time" class="form-control" placeholder="date" name="evaluation_retard_fin" id="evaluation_retard_fin" required>
                                   <?php endif; ?>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Commentaire </label>
                                   <?php if($type == "abs"): ?>
                                        <textarea class="form-control" placeholder="Commentaire ..." name="evaluation_absence_desc" id="evaluation_absence_desc" rows="3"></textarea>
                                   <?php else: ?>
                                        <textarea class="form-control" placeholder="Commentaire ..." name="evaluation_retard_desc" id="evaluation_retard_desc" rows="3"></textarea>
                                   <?php endif; ?>
                              </div>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="evaluation_modele_niveau_id" id="evaluation_modele_niveau_id" value="<?= $niveau->evaluation_modele_niveau_id ?>" required>

                                   <?php if($type == "abs"): ?>
                                        <input type="hidden" name="evaluation_absence_id" id="evaluation_absence_id" required>
                                   <?php else: ?>
                                        <input type="hidden" name="evaluation_retard_id" id="evaluation_retard_id" required>
                                   <?php endif; ?>

                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Enregistrer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabe">
                         Supprimer
                         <?php if($type == "abs"): ?>
                              absence
                         <?php else: ?>
                              retard
                         <?php endif; ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_'.$type); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le modele sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="evaluation_modele_niveau_id" id="evaluation_modele_niveau_id" value="<?= $niveau->evaluation_modele_niveau_id ?>" required>
                                   <?php if($type == "abs"): ?>
                                        <input type="hidden" name="evaluation_absence_id" id="evaluation_absence_id" required>
                                   <?php else: ?>
                                        <input type="hidden" name="evaluation_retard_id" id="evaluation_retard_id" required>
                                   <?php endif; ?>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
