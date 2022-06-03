<!-- <div class="row">
<div class="col-xl-4">
<a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter un module</a>
</div>
</div> -->

<input type="hidden" class="form-control" id="settings_cyles" value="<?= $niveau->settings_cycle_code ?>">


<?php show_notification();?>

<div class="row">
     <div class="col-xl-4">
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

               <h4 class="card-header mt-0 mb-3 text-warning">Configurator</h4>

               <div class="row">
                    <div class="col-12">
                         <div id="accordion">

                              <div class="card mb-0">

                                   <a href="#collapseOne" class="text-dark mb-3 btn-primary" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="card-title mb-5" id="headingOne">
                                             <table class="m-0 col-12">
                                                  <tr>
                                                       <td valign="middle"><h5 class="m-0">Liste des modules</h5></td>
                                                  </tr>
                                             </table>
                                        </div>
                                   </a>

                                   <div id="collapseOne" class="" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">

                                             <ul class="list-group mb-0 user-list">
                                                  <?php foreach($modules as $module): ?>
                                                       <?php foreach($module->activites as $activite): ?>
                                                            <li class="list-group-item">
                                                                 <div class="user-list-item">
                                                                      <h5 class="name mt-1"><?= $module->evaluation_module_name ?></h5>
                                                                      <span class="desc text-muted font-12 text-truncate d-block">
                                                                           <button class="btn btn-icon waves-effect waves-light btn-warning module_activite float-left mr-3 mt-1" onclick="showGrid(<?= @$activite->config->evaluation_note_config_id ?>, <?= @$niveau->evaluation_modele_niveau_id ?>)">
                                                                                <i class="dripicons-gear"></i>
                                                                           </button>
                                                                           <div class="user-desc overflow-hidden">
                                                                                <?php if($activite->settings_activite_code != "non"): ?>
                                                                                     <h6 class="text-primary"> <?= @$activite->settings_activite_name ?>  </h6>
                                                                                <?php else: ?>
                                                                                     <h6 class="text-primary"> Module  </h6>
                                                                                <?php endif; ?>
                                                                                <?php if($activite->config != null): ?>
                                                                                     Bar : <strong><?= @$activite->config->evaluation_note_config_max ?></strong>  Coef : <strong><?= @$activite->config->evaluation_note_config_coef ?></strong>
                                                                                <?php endif; ?>
                                                                           </div>
                                                                      </span>
                                                                      <!-- <div class="user float-left mr-3">
                                                                           <button class="btn btn-icon waves-effect waves-light btn-warning module_activite" onclick="showGrid(<?= @$activite->config->evaluation_note_config_id ?>, <?= @$niveau->settings_niveau_id ?>)">
                                                                           <i class="dripicons-gear"></i>
                                                                           </button>
                                                                      </div>
                                                                      <div class="user-desc overflow-hidden">
                                                                           <h5 class="name mt-2 mb-1"><?= $module->evaluation_module_name ?> </h5>
                                                                      </div> -->
                                                                 </div>
                                                            </li>
                                                       <?php endforeach; ?>
                                                  <?php endforeach; ?>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-8">
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

               <h4 class="card-header mt-0 mb-3 text-warning">Grille de note - <?= @$niveau->settings_niveau_name ?></h4>

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
                                                       <th colspan="2" class="text-warning" > Intitilés </th>
                                                       <th class="to_hide"> Note </th>
                                                       <th class="to_hide" style="width: 200px;"> Commentaire </th>
                                                       <th class="text-warning" style="border: 2px solid #dee2e6;"> Total </th>
                                                       <th class="text-warning" style="border: 2px solid #dee2e6;"> Moyenne </th>
                                                  </tr>
                                             </thead>

                                             <tbody>
                                                  <?php foreach($classe->eleves as $key => $eleve): ?>
                                                       <tr>
                                                            <td><?= $key+1 ?></td>
                                                            <td class="text-left">
                                                                 <div class="dropdown float-right to_hide">
                                                                      <a href="#custom-note-<?= $eleve->eleve_id ?>" data-toggle="modal">
                                                                           <i class="dripicons-document-edit"></i>
                                                                      </a>
                                                                 </div>
                                                                 <?= $eleve->prenoms." ".$eleve->nom ?>
                                                            </td>
                                                            <td class="to_hide"> <div id="note-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>"></div> </td>
                                                            <td class="to_hide"> <div id="commentaire-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>"></div> </td>
                                                            <td style="border: 2px solid #dee2e6;"><div id="total-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>"></div></td>
                                                            <td style="border: 2px solid #dee2e6;"><div id="moyenne-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>"></div></td>
                                                       </tr>

                                                       <div id="custom-note-<?= $eleve->eleve_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                 <div class="modal-content">
                                                                      <div class="modal-header">
                                                                           <h4 class="modal-title" id="myCenterModalLabel">Note de <?= $eleve->prenoms." ".$eleve->nom ?></h4>
                                                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                           <form class="row justify-content-center" id="note-submit-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>" action="" method="post" >
                                                                                <div class="col-10 col-md-12">

                                                                                     <div class="form-group mb-3">
                                                                                          <label>Note <span class="required">*</span></label>
                                                                                          <input type="number" class="form-control" placeholder="Note" name="evaluation_note_value" id="note_value-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>" onkeyup="define_comment('<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>')">
                                                                                     </div>

                                                                                     <div class="form-group mb-3">
                                                                                          <label>Commentaire </label>
                                                                                          <textarea class="form-control" placeholder="Commentaire ..." name="evaluation_note_commentaire" id="note_commentaire-<?= $eleve->eleves_scolarite_id ?>-<?= $classe->classe_id ?>" rows="3"></textarea>
                                                                                     </div>

                                                                                     <hr>
                                                                                     <div class="modal-footer mt-3">
                                                                                          <input type="hidden" class="form-control evaluation_note_config_id" name="evaluation_note_config_id" required>
                                                                                          <input type="hidden" class="form-control" name="evaluation_modele_niveau_id" value="<?= $evaluation_modele_niveau_id ?>" required>
                                                                                          <input type="hidden" class="form-control" name="eleves_scolarite_id"  value="<?= $eleve->eleves_scolarite_id ?>" required>

                                                                                          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                          <button type="submit" class="btn btn-warning col-md-4" onclick="insert_note(<?= $eleve->eleves_scolarite_id ?>, <?= $classe->classe_id ?>)" data-dismiss="modal">Enregistrer</button>
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
                                   </div>
                              <?php endforeach; ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- <table class="table table-centered mb-0" id="inline-editable">
<thead>
<tr>
<th colspan="2" class="text_warning" style="width: 150px;"> Intitilés </th>
<?php foreach($classe->modules as $module): ?>
<?php foreach($module->activites as $activite): ?>
<th style="font-size:10px;"> <?= $module->evaluation_module_name ?> </th>
<?php endforeach; ?>
<?php endforeach; ?>
<th style="width: 100px;"> Total </th>
<th style="width: 100px;"> Moyenne </th>
</tr>
</thead>

<tbody>
<?php foreach($classe->eleves as $key => $eleve): ?>
<tr id="<?= $key+1 ?>">
<td><?= $key+1 ?></td>
<td class="text-left"><?= $eleve->prenoms." ".$eleve->nom ?></td>
<?php foreach($classe->modules as $module): ?>
<?php foreach($module->activites as $activite): ?>
<td class="tabledit-view-mode" style="cursor: pointer; text-align:center;"><span class="tabledit-span" style=""><?= @$activite->evaluation->evaluation_note_value ?></span><input class="tabledit-input form-control form-control-sm" type="text" name="col2" value="System Architect" style="display: none;" disabled=""></td>
<?php endforeach; ?>
<?php endforeach; ?>
<td></td>
<td></td>
</tr>
<?php endforeach; ?>
</tbody>
</table> -->
