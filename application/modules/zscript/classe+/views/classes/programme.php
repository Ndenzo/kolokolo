<div class="email-wrap bookmark-wrap">
     <div class="row">
          <div class="col-xl-3 box-col-6">
               <div class="email-left-aside">
                    <div class="card">
                         <div class="card-body">
                              <div class="email-app-sidebar left-bookmark">
                                   <div class="media">
                                        <div class="media-size-email">
                                             <img class="me-3" src="<?php _url(); ?>assets/custom/png/046-board.png" alt="" style="width: 50px; border:none!important;">
                                        </div>
                                        <div class="media-body">
                                             <h6 class="f-w-600">Matières</h6>
                                             <p>Liste de toutes les matières</p>
                                        </div>
                                   </div>
                                   <ul class="nav main-menu mb-30" role="tablist">
                                        <li class="nav-item">
                                             <button class="btn btn-success btn-block w-100 mt-20 mb-20" type="button" data-toggle="modal" data-bs-target="#add-category">
                                                  Ajouter Matière
                                             </button>
                                        </li>
                                        <li>
                                             <form class="app-search">
                                                  <div class="app-search-box">
                                                       <div class="input-group">
                                                            <input type="text" class="form-control" id="search" placeholder="Rechercher ...">
                                                       </div>
                                                  </div>
                                             </form>
                                        </li>
                                   </ul>
                                   <ul class="nav main-menu" role="tablist" style="overflow-y: auto; height: 480px;">
                                        <?php if(is_array(@$matieres)):?>
                                             <?php foreach(@$matieres as $matiere):?>
                                                  <li class="element b-t-light">
                                                       <a href="#addCours<?= $matiere->settings_matiere_id?>" data-toggle="modal"><span class="title"> <?= substr($matiere->settings_matiere_name , 0, 30)?> </span></a>
                                                  </li>

                                                  <div class="modal fade none-border" id="addCours<?= $matiere->settings_matiere_id?>">
                                                       <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                 <div class="modal-header">
                                                                      <h6 class="modal-title mt-0"><strong><?= $matiere->settings_matiere_name ?> </strong></h6>
                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                 </div>

                                                                 <form action="<?php _url($module_base.'insert_cours'); ?>" method="post">
                                                                      <div class="modal-body">
                                                                           <div class="row mt-2">
                                                                                <div class="col-md-12">
                                                                                     <label class="control-label">Choix du jour</label>
                                                                                     <?php dropDown('SELECT settings_jour_id, settings_jour_name FROM settings_jours', array(
                                                                                          'id'=>'settings_jour_id_'.$matiere->settings_matiere_id,
                                                                                          'name'=>'settings_jour_id',
                                                                                          'class'=>'form-control selectpicker',
                                                                                          'attr'=>'title ="-- Choose --"  data-size="6" data-live-search="true" required'
                                                                                     )); ?>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row mt-3">
                                                                                <div class="col-md-12">
                                                                                     <label class="control-label">Enseignant</label>
                                                                                     <?php dropDown('SELECT enseignant_id, CONCAT(personne_prenoms, " ", personne_nom)
                                                                                     FROM enseignants
                                                                                     INNER JOIN employes ON employes.employe_id = enseignants.employe_id
                                                                                     INNER JOIN personnes ON personnes.personne_id = employes.personne_id
                                                                                     WHERE enseignants.settings_cycle_id = '.$classe->settings_cycle_id, array(
                                                                                          'id'=>'enseignant_id',
                                                                                          'name'=>'enseignant_id',
                                                                                          'class'=>'form-control selectpicker',
                                                                                          'attr'=>'title ="-- Choose --"  data-size="6" data-live-search="true" required'
                                                                                     )); ?>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row mt-3">
                                                                                <div class="col-md-6">
                                                                                     <label class="control-label">Heure de début</label>
                                                                                     <input class="form-control" type="time" name="cours_classe_heure_deb">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                     <label class="control-label">Heure de fin</label>
                                                                                     <input class="form-control" type="time" name="cours_classe_heure_fin">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="modal-footer mt-3">
                                                                           <input type="hidden" name="classes_matiere_id" value="<?= $matiere->classes_matiere_id ?>">
                                                                           <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                                                                           <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                           <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                      </div>
                                                                 </form>

                                                            </div>
                                                       </div>
                                                  </div>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-xl-9 col-md-12 box-col-12">
               <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                         <div class="ps-0">
                              <div class="tab-content">
                                   <div class="card mb-0">
                                        <div class="card-header d-flex">
                                             <h6 class="mb-0">Calendrier - <?= $classe->classe_name ?></h6>
                                             <ul>
                                                  <li><a href="#opendays_modal" data-toggle="modal"><i data-feather="calendar"></i></a></li>
                                                  <!-- <li><a class="list-layout-view" href="javascript:void(0)"><i data-feather="list"></i></a></li> -->
                                             </ul>
                                        </div>
                                        <div class="card-body pb-0">
                                             <div class="details-bookmark text-center">
                                                  <div class="mt-1">
                                                       <div class="row mb-50">

                                                            <table class="table-bordered col">
                                                                 <thead>
                                                                      <tr>
                                                                           <th class="bg-light-primary text-primary p-t-10"><h6>Horaires</h6></th>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>

                                                                      <?php if(is_array(@$horaires)):?>
                                                                           <?php foreach ($horaires as $horaire): ?>
                                                                                <?php $tmp = explode(":", $horaire->classes_horaire_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1]; ?>
                                                                                <?php $tmp = explode(":", $horaire->classes_horaire_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1]; ?>
                                                                                <?php $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5); ?>
                                                                                <tr>
                                                                                     <td style="height: <?= (6*$cpt) ?>px!important; padding: 0.05rem!important;">
                                                                                          <a href="#custom-delete-horaire-modal" data-toggle="modal" class="font-secondary" onclick="define_delete(<?= $horaire->classes_horaire_id ?>, 'classes_horaire_id')" style="font-size: 11px; font-weight: bold; width: 100%; height: 100%;"><?= $heure_deb.":".$minute_deb." - ".$heure_fin.":".$minute_fin ?></a>
                                                                                     </td>
                                                                                </tr>
                                                                           <?php endforeach; ?>
                                                                      <?php endif;?>
                                                                      <tr>
                                                                           <td style="height: 25px!important;">
                                                                                <a href="#addHoraires" data-toggle="modal" class="text-success badge-light-success form-control" style="font-size: 12px; height: 100%!important;  font-weight: bold;"><i class="fa fa-calendar"></i></a>
                                                                           </td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>

                                                            <?php foreach ($jours as $j => $jour): ?>
                                                                 <table class="table-bordered col">
                                                                      <thead>
                                                                           <tr>
                                                                                <th class="bg-light-primary text-primary p-t-10"><h6><?= $jour->settings_jour_name ?></h6></th>
                                                                           </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                           <?php foreach ($cours as $cour): ?>
                                                                                <?php if($cour->settings_jour_id == $jour->settings_jour_id):?>
                                                                                     <?php $tmp = explode(":", $cour->cours_classe_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1]; ?>
                                                                                     <?php $tmp = explode(":", $cour->cours_classe_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1]; ?>
                                                                                     <?php $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5); ?>
                                                                                     <?php if ($cour->settings_matiere_type_code == "pause"): ?>
                                                                                          <tr>
                                                                                               <td class="badge-light-warning" style="font-weight: bold; height: <?= (6*$cpt) ?>px!important;">
                                                                                                    <a href="#editCours" data-toggle="modal" class="font-warning" onclick="define_edit(<?= $cour->cours_classe_id ?>, 'scolarite/classe/showCoursEdit')" style="font-size: 11px; font-weight: bold; width: 100%; height: 100%;"><?= $cour->settings_matiere_code ?></a>
                                                                                               </td>
                                                                                          </tr>
                                                                                     <?php else: ?>
                                                                                          <tr>
                                                                                               <td style="font-weight: bold; height: <?= (6*$cpt) ?>px!important;">
                                                                                                    <a href="#editCours" data-toggle="modal" class="font-dark" onclick="define_edit(<?= $cour->cours_classe_id ?>, 'scolarite/classe/showCoursEdit')" style="font-size: 11px; font-weight: bold; width: 100%; height: 100%;"><?= $cour->settings_matiere_code ?></a>
                                                                                               </td>
                                                                                          </tr>
                                                                                     <?php endif; ?>

                                                                                <?php endif;?>
                                                                           <?php endforeach; ?>

                                                                           <tr>
                                                                                <td style="height: 25px!important;">
                                                                                     <a href="#addCustomCours<?= $jour->settings_jour_id ?>" data-toggle="modal" class="text-success badge-light-success form-control" style="font-size: 12px; height: 100%!important;  font-weight: bold;"><i class="fa fa-plus"></i></a>
                                                                                </td>
                                                                           </tr>
                                                                      </tbody>
                                                                 </table>

                                                            <?php endforeach; ?>
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
</div>

<?php foreach ($jours as $j => $jour): ?>
<div class="modal fade none-border" id="addCustomCours<?= $jour->settings_jour_id ?>">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h6 class="modal-title mt-0"><strong>Programme | <?= $jour->settings_jour_name ?> </strong></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <form action="<?php _url($module_base.'insert_cours'); ?>" method="post">
                    <div class="modal-body">
                         <div class="row mt-2">
                              <div class="col-md-12">
                                   <input type="hidden" name="settings_jour_id" value="<?= $jour->settings_jour_id ?>">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <label class="control-label">Choix de la matière</label>
                              <?php dropDown('SELECT classes_matiere_id, settings_matiere_name FROM classes_matieres JOIN `settings_matieres` ON `settings_matieres`.`settings_matiere_id` = `classes_matieres`.`settings_matiere_id` WHERE `classes_matieres`.`classe_id` = '.$classe->classe_id.'', array(
                                   'id'=>'classes_matiere_id_form',
                                   'name'=>'classes_matiere_id',
                                   'class'=>'form-control selectpicker',
                                   'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required'
                              ));   ?>
                         </div>
                         <div class="row mt-3">
                              <div class="col-md-12">
                                   <label class="control-label">Enseignant</label>
                                   <?php dropDown('SELECT enseignant_id, CONCAT(personne_prenoms, " ", personne_nom)
                                   FROM enseignants
                                   INNER JOIN employes ON employes.employe_id = enseignants.employe_id
                                   INNER JOIN personnes ON personnes.personne_id = employes.personne_id
                                   WHERE enseignants.settings_cycle_id = '.$classe->settings_cycle_id, array(
                                        'id'=>'enseignant_id',
                                        'name'=>'enseignant_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="6" data-live-search="true" required'
                                   )); ?>
                              </div>
                         </div>
                         <div class="row mt-3">
                              <div class="col-md-6">
                                   <label class="control-label">Heure de début</label>
                                   <input class="form-control" type="time" name="cours_classe_heure_deb" value="<?= @$cour->cours_classe_heure_fin ?>">
                              </div>
                              <div class="col-md-6">
                                   <label class="control-label">Heure de fin</label>
                                   <input class="form-control" type="time" name="cours_classe_heure_fin">
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </form>

          </div>
     </div>
</div>
<?php endforeach; ?>

<div class="modal fade none-border" id="editCours">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title mt-0"><strong>Modification du cours</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <form action="<?php _url($module_base.'update_cours'); ?>" method="post">
                    <div class="modal-body">
                         <div class="col-md-12">
                              <label class="control-label">Choix de la matière</label>
                              <?php dropDown('SELECT classes_matiere_id, settings_matiere_name FROM classes_matieres JOIN `settings_matieres` ON `settings_matieres`.`settings_matiere_id` = `classes_matieres`.`settings_matiere_id` WHERE `classes_matieres`.`classe_id` = '.$classe->classe_id.'', array(
                                   'id'=>'classes_matiere_id',
                                   'name'=>'classes_matiere_id',
                                   'class'=>'form-control selectpicker',
                                   'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required'
                              ));   ?>
                         </div>
                         <div class="row mt-3">
                              <div class="col-md-12">
                                   <label class="control-label">Enseignant</label>
                                   <?php dropDown('SELECT enseignant_id, CONCAT(personne_prenoms, " ", personne_nom)
                                   FROM enseignants
                                   INNER JOIN employes ON employes.employe_id = enseignants.employe_id
                                   INNER JOIN personnes ON personnes.personne_id = employes.personne_id
                                   WHERE enseignants.settings_cycle_id = '.$classe->settings_cycle_id, array(
                                        'id'=>'enseignant_id',
                                        'name'=>'enseignant_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required',
                                        'selected'=> $cour->enseignant_id
                                   )); ?>
                              </div>
                         </div>
                         <div class="row mt-3">
                              <div class="col-md-6">
                                   <label class="control-label">Heure de début</label>
                                   <input class="form-control" type="time" id="cours_classe_heure_deb" name="cours_classe_heure_deb">
                              </div>
                              <div class="col-md-6">
                                   <label class="control-label">Heure de fin</label>
                                   <input class="form-control" type="time" id="cours_classe_heure_fin" name="cours_classe_heure_fin">
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <input type="hidden" id="cours_classe_id" name="cours_classe_id">
                         <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<div class="modal fade none-border" id="add-category">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title mt-0"><strong>Affecter matière </strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <form action="<?php _url($module_base.'insert_matiere'); ?>" method="post">

                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-12">
                                   <label class="control-label">Choix de la matière</label>
                                   <?php dropDown('SELECT settings_matiere_id, settings_matiere_name FROM settings_matieres WHERE settings_matiere_id NOT IN (SELECT settings_matiere_id FROM classes_matieres WHERE classe_id = '.$classe->classe_id.') order by settings_matiere_name', array(
                                        'id'=>'settings_matiere_id',
                                        'name'=>'settings_matiere_id[]',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" multiple required'
                                   )); ?>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </form>

          </div>
     </div>
</div>


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer cours</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_cours'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12">
                              <p style="text-align: center; font-size: 14px;">
                                   Le jour sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-horaire-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer horaire</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_horaire'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12">
                              <p style="text-align: center; font-size: 14px;">
                                   L'horaire sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" name="classes_horaire_id" id="classes_horaire_id">
                                   <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div class="modal fade none-border" id="opendays_modal">
     <div class="modal-dialog">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title mt-0"><strong>Gérer les jours ouvrables</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <form action="<?php _url($module_base.'insert_days'); ?>" method="post">
                    <div class="modal-body">
                         <div class="inbox-widget col-10 ml-auto mr-auto">
                              <?php if (count($settings_jours) != 0): ?>
                                   <?php foreach (@$settings_jours as $jour): ?>
                                        <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input switcher_1" <?php if(in_array($jour->settings_jour_id, $opendays)): ?>checked<?php endif; ?>  id="jour_<?= $jour->settings_jour_id ?>" name="jour_id[]" value="<?= $jour->settings_jour_id ?>">
                                             <label class="custom-control-label mb-1" for="jour_<?= $jour->settings_jour_id ?>"><?= $jour->settings_jour_name ?></label></br>
                                        </div>
                                   <?php endforeach; ?>
                              <?php endif;?>
                         </div>
                    </div>

                    <div class="modal-footer mt-3">
                         <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </form>

          </div>
     </div>
</div>


<div class="modal fade none-border" id="addHoraires">
     <div class="modal-dialog">
          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title mt-0"><strong>Ajouter Horaires</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <form action="<?php _url($module_base.'insert_horaire'); ?>" method="post">
                    <div class="modal-body">
                         <div class="row mt-3">
                              <div class="col-md-6">
                                   <label class="control-label">Heure de début</label>
                                   <input class="form-control" type="time" name="classes_horaire_heure_deb" value="<?= @end($horaires)->classes_horaire_heure_fin ?>">
                              </div>
                              <div class="col-md-6">
                                   <label class="control-label">Heure de fin</label>
                                   <input class="form-control" type="time" name="classes_horaire_heure_fin">
                              </div>
                         </div>
                    </div>

                    <div class="modal-footer mt-3">
                         <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </form>

          </div>
     </div>
</div>
