<!-- <div class="row">
<div class="col-xl-4">
<a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter un module</a>
</div>
</div> -->

<?php show_notification();?>

<div class="row">
     <div class="col-xl-7">
          <div class="card taskboard-box">
               <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                         <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                         <a href="javascript:void(0);" class="dropdown-item">Action</a>
                         <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                         <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                         <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
               </div>

               <?php if($type == "abs"): ?>
                    <h4 class="card-header mt-0 mb-3 text-warning">Gestion des absences - <?= @$niveau->settings_niveau_name ?></h4>
               <?php else: ?>
                    <h4 class="card-header mt-0 mb-3 text-warning">Gestion des retards - <?= @$niveau->settings_niveau_name ?></h4>
               <?php endif; ?>

               <div class="row">
                    <div class="col-12">
                         <ul class="nav nav-tabs nav-justified">
                              <?php foreach($classes as $classe): ?>
                                   <li class="nav-item">
                                        <a href="#classe<?= @$classe->classe_id ?>" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                             <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                             <span class="d-none d-sm-block"><?= @$classe->classe_name ?></span>
                                        </a>
                                   </li>
                              <?php endforeach; ?>
                         </ul>

                         <div class="tab-content" style="overflow-y: auto;">
                              <?php foreach($classes as $classe): ?>
                                   <div role="tabpanel" class="tab-pane fade show active row" id="classe<?= @$classe->classe_id ?>">
                                        <table class="table table-centered mb-0 " id="inline-editable">
                                             <thead>
                                                  <tr>
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
                                                                           <?php if($type == "abs"): ?>
                                                                                <a href="#custom-<?= $eleve->eleve_id ?>" class="social-list-item border-success text-success" data-toggle="modal"><i class="dripicons-document-edit"></i></a>
                                                                           <?php else: ?>
                                                                                <a href="#custom-<?= $eleve->eleve_id ?>" class="social-list-item border-success text-success" data-toggle="modal"><i class="dripicons-document-edit"></i></a>
                                                                           <?php endif; ?>
                                                                      </li>
                                                                      <li class="list-inline-item">
                                                                           <button class="social-list-item border-info text-info" style="background-color: white" onclick="show_details(<?= $eleve->eleve_id ?>)"><i class="mdi mdi-more"></i></button>
                                                                      </li>
                                                                 </ul>
                                                            </td>
                                                       </tr>

                                                       <div id="custom-<?= $eleve->eleve_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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

                                                                                     <hr>
                                                                                     <div class="modal-footer mt-3">
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
                                                                                     <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>

                                                                                     <?php if($type == "abs"): ?>
                                                                                          <div class="dropdown-menu dropdown-menu-right">
                                                                                               <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $absence->evaluation_absence_id ?>, 'scolarite/absence/showEdit_absence')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                                                               <div class="dropdown-divider"></div>
                                                                                               <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $absence->evaluation_absence_id ?>, 'evaluation_absence_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                                                          </div>
                                                                                     <?php else: ?>
                                                                                          <div class="dropdown-menu dropdown-menu-right">
                                                                                               <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $absence->evaluation_retard_id ?>, 'scolarite/absence/showEdit_retard')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                                                               <div class="dropdown-divider"></div>
                                                                                               <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $absence->evaluation_retard_id ?>, 'evaluation_retard_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
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
                              <?php endforeach; ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-5">
          <div class="card taskboard-box">
               <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                         <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                         <a href="javascript:void(0);" class="dropdown-item">Action</a>
                         <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                         <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                         <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
               </div>

               <h4 class="card-header mt-0 mb-3 text-warning">Détails</h4>

               <div class="row">
                    <div class="col-12" id="detail_view">
                         <div class="text-info text-center to_change">
                              Les details des absences s'afficheront ici !
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
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier evaluation</h4>
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

                              <hr>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer modele</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_'.$type); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le modele sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
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
