<?php show_notification();?>
<style>
td {
     height: 6px!important;
}
</style>
<div class="row">
     <div class="col-xl-3 col-md-6">
          <div class="card">

               <h4 class="card-header mt-0 mb-3"><i class="mdi mdi-notification-clear-all mr-1"></i> Liste des activitées</h4>

               <div >
                    <div class="list-group-item">
                         <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-success col-12">
                              Ajouter activitée
                         </a>
                    </div>


                    <div class="list-group-item">
                         <form class="app-search">
                              <div class="app-search-box">
                                   <div class="input-group">
                                        <input type="text" class="form-control" id="search" placeholder="Rechercher ...">
                                   </div>
                              </div>
                         </form>
                    </div>

                    <p class="text-center text-info">Cliquez sur la matière pour créer le cours</p>

               </div>

               <ul class="list-group mb-0 user-list" style="height: 550px; overflow-y: auto;">
                    <?php if(is_array(@$matieres)):?>
                         <?php foreach(@$matieres as $matiere):?>
                              <li class="list-group-item element">
                                   <a href="#addCours<?= $matiere->settings_matiere_id?>" class="user-list-item" data-toggle="modal">
                                        <div class="user float-left mr-3" style="margin-top: 2px;">
                                             <i class="mdi mdi-circle text-primary"></i>
                                        </div>
                                        <div class="user-desc overflow-hidden">
                                             <h6 class="name mt-1"><?= $matiere->settings_matiere_name ?></h6>
                                             <!-- <span class="desc text-muted font-12 text-truncate d-block">February 24, 2019 - 10:30am to 12:45pm</span> -->
                                        </div>
                                   </a>
                              </li>

                              <div class="modal fade none-border" id="addCours<?= $matiere->settings_matiere_id?>">
                                   <div class="modal-dialog">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                  <h4 class="modal-title mt-0"><strong>Ajout du cours de <?= $matiere->settings_matiere_name ?> </strong></h4>
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
                                                                      'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required'
                                                                 )); ?>
                                                            </div>
                                                       </div>
                                                       <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                 <label class="control-label">Enseignant</label>
                                                                 <?php dropDown('SELECT enseignant_id, CONCAT(prenoms, " ", nom)
                                                                 FROM enseignants
                                                                 INNER JOIN employes ON employes.employe_id = enseignants.employe_id
                                                                 INNER JOIN personnes ON personnes.personne_id = employes.personne_id
                                                                 WHERE enseignants.settings_cycle_id = '.$classe->settings_cycle_id, array(
                                                                      'id'=>'enseignant_id',
                                                                      'name'=>'enseignant_id',
                                                                      'class'=>'form-control selectpicker',
                                                                      'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required'
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

     <div class="col-lg-9">
          <div class="card">
               <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                         <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                         <a href="#opendays_modal" class="dropdown-item" data-toggle="modal">Jours ouvrables</a>
                    </div>
               </div>

               <h4 class="mt-0 card-header"><i class="mdi mdi-calendar mr-1"></i>Emploi du temps - <?= $classe->classe_name ?></h4>

               <div class="row table-responsive mt-3">
                    <div class="row mr-auto mr-auto" style="margin: 25px;">
                         <table class="table-bordered" style="margin: 0px; width: 10%;">
                              <thead>
                                   <tr>
                                        <th style="width:15%;"><h4>Horaires</h4></th>
                                   </tr>
                              </thead>
                              <tbody>

                                   <?php if(is_array(@$horaires)):?>
                                        <?php
                                        $tab_horaire = array();
                                        ?>
                                        <?php foreach ($horaires as $horaire): ?>
                                             <?php $tmp = explode(":", $horaire->classes_horaire_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1]; ?>
                                             <?php $tmp = explode(":", $horaire->classes_horaire_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1]; ?>
                                             <?php $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5); ?>
                                             <?php array_push($tab_horaire, $cpt); ?>
                                             <tr>
                                                  <td class="bg-secondary" style="height: <?= (6*$cpt) ?>px!important; padding: 0.05rem!important;">
                                                       <a href="#custom-delete-horaire-modal" data-toggle="modal" class="text-white" onclick="define_delete(<?= $horaire->classes_horaire_id ?>, 'classes_horaire_id')" style="font-size: 11px; font-weight: bold; width: 100%; height: 100%;"><?= $heure_deb.":".$minute_deb." - ".$heure_fin.":".$minute_fin ?></a>
                                                  </td>
                                             </tr>
                                        <?php endforeach; ?>
                                   <?php endif;?>
                                   <tr>
                                        <td style="height: 25px!important;">
                                             <a href="#addHoraires" data-toggle="modal" class="text-white btn btn-lighten-warning form-control" style="font-size: 12px; height: 100%!important;  font-weight: bold;"><i class="mdi mdi-calendar-plus"></i></a>
                                        </td>
                                   </tr>
                              </tbody>
                         </table>

                         <?php
                         $start = strtotime(@reset($horaires)->classes_horaire_heure_deb);
                         $end = strtotime(@end($horaires)->classes_horaire_heure_fin);
                         $mins = ($end - $start) / 60;
                         ?>


                         <table class="table-bordered" style="margin: 0px; width: 90%;">
                              <thead>
                                   <?php if(is_array(@$jours)):?>
                                        <tr>
                                             <?php foreach ($jours as $j =>$jour): ?>
                                                  <td><h4><?= $jour->settings_jour_name ?></h4></td>
                                             <?php endforeach;?>
                                        </tr>
                                   <?php endif;?>
                              </thead>
                              <tbody>
                                   <?php $cpt = 0; ?>
                                   <?php $n = 0; ?>
                                   <?php $n_horaire = 0 ?>
                                   <?php if(is_array(@$jours)):?>
                                        <?php $check = true ?>
                                        <?php
                                        $tab = array();
                                        foreach ($jours as $j =>$jour){
                                             array_push($tab, 0);
                                        }
                                        ?>
                                        <?php while($check == true): ?>
                                             <tr>
                                                  <?php foreach ($jours as $j =>$jour): ?>
                                                       <?php $verif = false; ?>
                                                       <?php foreach ($cours as $cour): ?>
                                                            <?php $tmp = explode(":", $cour->cours_classe_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1]; ?>
                                                            <?php $tmp = explode(":", $cour->cours_classe_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1]; ?>
                                                            <?php if(($tab[$j] == (($heure_deb - 8) * 12) + ($minute_deb/5)) && ($cour->settings_jour_id == $jour->settings_jour_id)):?>
                                                                 <?php $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5); ?>
                                                                 <td class="bg-primary" style="font-weight: bold; height: <?= (6*$cpt) ?>px!important;">
                                                                      <a href="#editCours" data-toggle="modal" class="text-white" onclick="define_edit(<?= $cour->cours_classe_id ?>, 'scolarite/classe/showCoursEdit')" style="font-size: 11px; font-weight: bold; width: 100%; height: 100%;"><?= $cour->settings_matiere_code ?></a>
                                                                 </td>
                                                                 <?php $verif = true;?>
                                                                 <?php $tab[$j] = (($heure_fin - 8) * 12) + ($minute_fin/5) ?>
                                                                 <?php $n++; ?>
                                                                 <?php break; ?>
                                                            <?php endif;?>
                                                       <?php endforeach; ?>
                                                       <?php if(($verif == false) && ($cpt == 0)): ?>
                                                            <td class="bg-pink" style="font-weight: bold; height: <?= (6*$cpt) ?>px!important;"></td>
                                                       <?php else: ?>
                                                            <?php $cpt--; ?>
                                                       <?php endif; ?>
                                                  <?php endforeach;?>
                                             </tr>
                                             <?php $n_horaire ++; ?>
                                             <?php if ($n == count($cours)): ?>
                                                  <?php $check = false; ?>
                                             <?php endif; ?>
                                        <?php endwhile;?>
                                   <?php endif;?>
                              </tbody>
                         </table>

                         <?php if(is_array(@$jours)):?>

                              <?php foreach ($jours as $j =>$jour): ?>
                                   <table class="table-bordered" style="margin: 0px; width: 15%;">
                                        <thead>
                                             <tr>
                                                  <td style="width:15%;"><h4><?= $jour->settings_jour_name ?></h4></td>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php $cpt = 0; ?>
                                             <?php for($i=0; $i<($mins/5); $i++):?>
                                                  <tr >
                                                       <?php $verif = false; ?>
                                                       <?php foreach ($cours as $cour): ?>
                                                            <?php if($cour->settings_jour_id == $jour->settings_jour_id): ?>
                                                                 <?php $tmp = explode(":", $cour->cours_classe_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1]; ?>
                                                                 <?php $tmp = explode(":", $cour->cours_classe_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1]; ?>
                                                                 <?php $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5); ?>
                                                                 <?php if($i == (($heure_deb - 8) * 12) + ($minute_deb/5)):?>
                                                                      <td class="bg-primary" style="font-weight: bold; height: <?= (6*$cpt) ?>px!important;" id="calendar-">
                                                                           <a href="#editCours" data-toggle="modal" class="text-white" onclick="define_edit(<?= $cour->cours_classe_id ?>, 'scolarite/classe/showCoursEdit')" style="font-size: 11px; font-weight: bold; width: 100%; height: 100%;"><?= $cour->settings_matiere_code ?></a>
                                                                      </td>
                                                                      <?php $verif = true;?>
                                                                 <?php endif;?>
                                                            <?php endif; ?>
                                                       <?php endforeach; ?>
                                                       <?php if(($verif == false) && ($cpt == 0)): ?>
                                                            <td class="bg-pink" style="font-weight: bold; height: <?= (6*$cpt) ?>px!important;"></td>
                                                       <?php else: ?>
                                                            <?php $cpt--; ?>
                                                       <?php endif; ?>
                                                  </tr>

                                             <?php endfor;?>
                                        </tbody>
                                   </table>
                              <?php endforeach;?>

                         <?php endif;?>

                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade none-border" id="editCours">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title mt-0"><strong>Modification du cours de <?= $cour->settings_matiere_name ?> </strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <form action="<?php _url($module_base.'update_cours'); ?>" method="post">
                    <div class="modal-body">
                         <div class="row mt-2">
                              <div class="col-md-12">
                                   <label class="control-label">Choix du jour</label>
                                   <?php dropDown('SELECT settings_jour_id, settings_jour_name FROM settings_jours', array(
                                        'id'=>'settings_jour_id',
                                        'name'=>'settings_jour_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required'
                                   )); ?>
                              </div>
                         </div>
                         <div class="row mt-3">
                              <div class="col-md-12">
                                   <label class="control-label">Enseignant</label>
                                   <?php dropDown('SELECT enseignant_id, CONCAT(prenoms, " ", nom)
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
                                   <?php dropDown('SELECT settings_matiere_id, settings_matiere_name FROM settings_matieres WHERE settings_matiere_id NOT IN (SELECT settings_matiere_id FROM classes_matieres WHERE classe_id = '.$classe->classe_id.') AND settings_cycle_id = '.$classe->settings_cycle_id.' order by settings_matiere_name', array(
                                        'id'=>'settings_matiere_id',
                                        'name'=>'settings_matiere_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required'
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
                         <div class="col-12 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   Le jour sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
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
                         <div class="col-12 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   L'horaire sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
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

                              <?php foreach ($jours as $jour): ?>
                                   <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_1" <?php if(in_array($jour->settings_jour_id, $opendays)): ?>checked<?php endif; ?>  id="jour_<?= $jour->settings_jour_id ?>" name="jour_id[]" value="<?= $jour->settings_jour_id ?>">
                                        <label class="custom-control-label mb-1" for="jour_<?= $jour->settings_jour_id ?>"><?= $jour->settings_jour_name ?></label></br>
                                   </div>
                              <?php endforeach; ?>

                         </div>
                    </div>
                    <hr>
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
                    <hr>
                    <div class="modal-footer mt-3">
                         <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </form>

          </div>
     </div>
</div>

<script type="text/javascript">
var horaires = <?= json_encode(@$horaires) ?>;
var jours = <?= json_encode(@$jours) ?>;
var current_height = 0;
var real_height = 0;

horaires.forEach(
     function(horaire, i) {
          jours.forEach(
               function(jour, j) {
                    current_height = ;
                    real_height = ;
                    console.log(current_height + " : " + real_height);
               },
          );
     },
);
</script>
