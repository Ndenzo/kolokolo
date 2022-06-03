<?php show_notification();?>

<div class="row">
     <div class="col-lg-12">
          <div class="row">

               <div class="col-lg-3">
                    <div class="widget">
                         <div class="widget-body">
                              <div class="row">
                                   <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-success col-9" style="height: 50px;">
                                        <i class="fa fa-plus mr-1"></i> Ajouter activitée
                                   </a>
                                   <a href="#" data-toggle="modal" data-target="#config" class="btn btn-lg btn-success col-2 ml-auto" style="height: 50px; width: 50px; text-align:center;">
                                        <i class="fa fa-cog"></i>
                                   </a>
                              </div>

                              <div id="external-events" class="mt-3">
                                   <p class="text-center">Cliquez sur la matière pour créer le cours</p>
                                   <?php if(is_array(@$matieres)):?>
                                        <?php foreach(@$matieres as $matiere):?>
                                             <div class="row">
                                                  <a href="#addCours<?= $matiere->settings_matiere_id?>" data-toggle="modal" class="external-event btn btn-info text-left col-8 ml-auto mr-auto">
                                                       <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i><?= $matiere->settings_matiere_name ?>
                                                  </a>
                                             </div>


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
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-lg-9">
                    <div class="card">
                         <h4 class="mt-0 card-header">Emploi du temps - <?= $classe->classe_name ?></h4>

                         <div class="row table-responsive mt-3">
                              <div class="row mr-auto mr-auto" style="margin: 25px;">
                                   <table class="table-bordered" style="width: 10%;">
                                        <thead>
                                             <tr>
                                                  <td style="width:15%;"><h4>Horaires</h4></td>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php for($i=0; $i<120; $i++):?>
                                                  <tr class="" style="height:9px!important;">
                                                       <?php if($i%12 == 0):?>
                                                            <td rowspan="6"><?= 8 + ($i/12)." H 00 - ".(8 + ($i/12))." H 30" ?></td>
                                                       <?php endif;?>
                                                  </tr>
                                             <?php endfor;?>
                                        </tbody>
                                   </table>

                                   <?php foreach ($jours as $j =>$jour): ?>
                                        <table class="table-bordered" style="margin: 0px; width: 15%;">
                                             <thead>
                                                  <tr>
                                                       <td style="width:15%;"><h4><?= $jour->settings_jour_name ?></h4></td>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $cpt = 0; ?>
                                                  <?php for($i=0; $i<120; $i++):?>
                                                       <tr class="" style="height:9px!important;">
                                                            <?php $verif = false; ?>
                                                            <?php foreach ($cours as $cour): ?>
                                                                 <?php if($cour->settings_jour_id == $jour->settings_jour_id): ?>
                                                                      <?php $tmp = explode(":", $cour->cours_classe_heure_deb); $heure_deb = $tmp[0]; $minute_deb = $tmp[1]; ?>
                                                                      <?php $tmp = explode(":", $cour->cours_classe_heure_fin); $heure_fin = $tmp[0]; $minute_fin = $tmp[1]; ?>
                                                                      <?php if($i == (($heure_deb - 8) * 12) + ($minute_deb/5)):?>
                                                                           <?php $cpt = (($heure_fin - $heure_deb) * 12) + ($minute_fin/5) - ($minute_deb/5); ?>
                                                                           <td class="bg-info" rowspan="<?= $cpt ?>" style="border: 1px solid; border-radius: 0px; font-weight: bold;">
                                                                                <a href="#editCours<?= $cour->cours_classe_id?>" data-toggle="modal" class="text-white" style="font-size: 11px; height: 100%!important;"><?= $cour->settings_matiere_code ?></a>
                                                                                <!-- <br>
                                                                                <?= $heure_deb.":".$minute_deb." - ".$heure_fin.":".$minute_fin ?>
                                                                                <br>
                                                                                <a href="#custom-delete-modal<?= $cour->cours_classe_id?>" data-toggle="modal" class="social-list-item border-danger text-danger mr-auto ml-auto"><i class="fa fa-trash"></i></a> -->
                                                                           </td>
                                                                           <?php $verif = true;?>

                                                                           <div id="custom-delete-modal<?= $cour->cours_classe_id?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                     <div class="modal-content">
                                                                                          <div class="modal-header">
                                                                                               <h4 class="modal-title" id="myCenterModalLabel">Supprimer jour</h4>
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
                                                                                                              <input type="hidden" name="cours_classe_id" value="<?= $cour->cours_classe_id ?>">
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

                                                                           <div class="modal fade none-border" id="editCours<?= $cour->cours_classe_id?>">
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
                                                                                                                   'id'=>'temp_settings_jour_id',
                                                                                                                   'name'=>'temp_settings_jour_id',
                                                                                                                   'class'=>'form-control selectpicker',
                                                                                                                   'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required',
                                                                                                                   'selected'=> $cour->settings_jour_id
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
                                                                                                                   'id'=>'temp_enseignant_id',
                                                                                                                   'name'=>'temp_enseignant_id',
                                                                                                                   'class'=>'form-control selectpicker',
                                                                                                                   'attr'=>'title ="-- Choose --"  data-size="16" data-live-search="true" required',
                                                                                                                   'selected'=> $cour->enseignant_id
                                                                                                              )); ?>
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <div class="row mt-3">
                                                                                                         <div class="col-md-6">
                                                                                                              <label class="control-label">Heure de début</label>
                                                                                                              <input class="form-control" type="time" name="cours_classe_heure_deb" value="<?= $cour->cours_classe_heure_deb ?>">
                                                                                                         </div>
                                                                                                         <div class="col-md-6">
                                                                                                              <label class="control-label">Heure de fin</label>
                                                                                                              <input class="form-control" type="time" name="cours_classe_heure_fin" value="<?= $cour->cours_classe_heure_fin ?>">
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </div>
                                                                                               <div class="modal-footer mt-3">
                                                                                                    <input type="hidden" id="edit_enseignant_id" name="enseignant_id">
                                                                                                    <input type="hidden" id="edit_settings_jour_id" name="settings_jour_id">
                                                                                                    <input type="hidden" name="classes_matiere_id" value="<?= $cour->classes_matiere_id ?>">
                                                                                                    <input type="hidden" name="cours_classe_id" value="<?= $cour->cours_classe_id ?>">
                                                                                                    <input type="hidden" name="classe_id" value="<?= $classe->classe_id ?>">
                                                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                    <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                                                                                               </div>
                                                                                          </form>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      <?php endif;?>
                                                                 <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            <?php if(($verif == false) && ($cpt == 0)): ?>
                                                                 <td></td>
                                                            <?php else: ?>
                                                                 <?php $cpt--; ?>
                                                            <?php endif; ?>
                                                       </tr>

                                                  <?php endfor;?>
                                             </tbody>
                                        </table>
                                   <?php endforeach;?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <!-- BEGIN MODAL -->
          <div class="modal fade none-border" id="event-modal">
               <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h4 class="modal-title mt-0"><strong>Add New Event</strong></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         </div>
                         <div class="modal-body"></div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Fermer</button>
                              <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                              <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                         </div>
                    </div>
               </div>
          </div>

          <!-- Modal Add Category -->
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


     </div>
</div>

<div class="modal fade none-border" id="config">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title mt-0"><strong>Configurer l'emploi du temps</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <form action="<?php _url($module_base.'insert_cours'); ?>" method="post">

                    <div class="modal-body">

                         <div class="col-12">
                              <ul class="nav nav-tabs nav-justified">
                                   <li class="nav-item">
                                        <a href="#home2" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                             <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                             <span class="d-none d-sm-block">Générale</span>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#profile2" data-toggle="tab" aria-expanded="true" class="nav-link">
                                             <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                             <span class="d-none d-sm-block">Jours ouvrables</span>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a href="#messages2" data-toggle="tab" aria-expanded="false" class="nav-link">
                                             <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                             <span class="d-none d-sm-block">Horaires</span>
                                        </a>
                                   </li>
                              </ul>

                              <div class="tab-content">
                                   <div role="tabpanel" class="tab-pane fade active show" id="home2">
                                        <button type="button" name="add_meta" class="btn btn-success form-control" onclick="addMeta()">Ajouter paramètre</button>

                                        <?php if(is_array(@$metas)):?>
                                             <?php foreach(@$metas as $meta):?>
                                                  <div class="row mt-3">
                                                       <div class="col-md-5">
                                                            <label class="control-label"><?= @$meta->meta_key ?></label>
                                                       </div>
                                                       <div class="col-md-7">
                                                            <input class="form-control" type="text" name="meta_value" value="<?= @$meta->meta_value ?>">
                                                       </div>
                                                  </div>
                                             <?php endforeach; ?>
                                        <?php endif; ?>

                                        <div id="new_meta"></div>
                                   </div>
                                   <div role="tabpanel" class="tab-pane fade" id="profile2">
                                        <?php foreach ($jours as $j =>$jour): ?>
                                        <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input switcher_2" unchecked id="jour_<?= $jour->settings_jour_id ?>" name="jour_id[]" value="<?= $jour->settings_jour_id ?>">
                                             <label class="custom-control-label mb-1" for="jour_<?= $jour->settings_jour_id ?>"><?= $jour->settings_jour_name ?></label></br>
                                        </div>
                                   <?php endforeach; ?>
                                   </div>
                                   <div role="tabpanel" class="tab-pane fade" id="messages2">
                                        <p class="mb-0">Etsy mixtape wayfarers, ethical
                                             wes anderson tofu before they sold out mcsweeney's organic lomo
                                             retro fanny pack lo-fi farm-to-table readymade. Messenger bag
                                             gentrify pitchfork tattooed craft beer, iphone skateboard locavore
                                             carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy
                                             irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg
                                             banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy
                                             retro mlkshk vice blog. Scenester cred you probably haven't heard of
                                             them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu
                                             synth chambray yr.
                                        </p>
                                   </div>
                                   <div role="tabpanel" class="tab-pane fade" id="settings2">
                                        <p class="mb-0">Trust fund seitan letterpress,
                                             keytar raw denim keffiyeh etsy art party before they sold out master
                                             cleanse gluten-free squid scenester freegan cosby sweater. Fanny
                                             pack portland seitan DIY, art party locavore wolf cliche high life
                                             echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before
                                             they sold out farm-to-table VHS viral locavore cosby sweater. Lomo
                                             wolf viral, mustache readymade thundercats keffiyeh craft beer marfa
                                             ethical. Wolf salvia freegan, sartorial keffiyeh echo park
                                             vegan.
                                        </p>
                                   </div>
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
