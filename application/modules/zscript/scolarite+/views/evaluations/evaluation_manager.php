<style media="screen">
td{
     vertical-align: center;
}
</style>
<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter un trimestre</a>
     </div>
</div>

<?php show_notification();?>

<div class="row">
     <?php if(is_array(@$cycles)):?>
          <?php foreach(@$cycles as $cycle):?>
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

                         <h4 class="card-header mt-0 mb-3 text-warning"><?= $cycle->settings_cycle_name ?></h4>

                         <div class="row">
                              <div class="col-12">
                                   <div id="accordion">
                                        <?php foreach(@$cycle->trimestres as $trimestre):?>

                                             <div class="card mb-0">
                                                  <a href="#collapseOne<?= $trimestre->evaluation_trimestre_id ?>" class="text-dark mb-3 btn-primary" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                                       <div class="card-title mb-5" id="headingOne">
                                                            <table class="m-0 col-12">
                                                                 <tr>
                                                                      <td valign="middle"><h5 class="m-0"><?= $trimestre->evaluation_trimestre_name ?></h5></td>
                                                                      <td valign="middle" style="width: 50px;"><a href="#custom-modal-<?= $trimestre->evaluation_trimestre_id ?>" class="btn btn-success btn-md waves-effect waves-light m-0" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">+</a></td>
                                                                 </tr>
                                                            </table>
                                                       </div>
                                                  </a>


                                                  <div id="collapseOne<?= $trimestre->evaluation_trimestre_id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                       <div class="card-body">
                                                            <ul class="list-group mb-0 user-list">
                                                                 <?php foreach(@$trimestre->evaluations as $evaluation):?>
                                                                      <li class="list-group-item">
                                                                           <div class="dropdown float-right mt-2">
                                                                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                                                     <i class="mdi mdi-dots-vertical"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                     <a href="#custom-detail-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-calculator-variant"></i> Remplir notes </a>
                                                                                     <a href="#custom-dispense-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-account-remove"></i> Dispensés d'évaluation </a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-statistique-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-receipt"></i> Générer statistiques </a>
                                                                                     <a href="#custom-releve-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-format-list-numbered"></i> Générer relevé </a>
                                                                                     <a href="#custom-bulletin-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-receipt"></i> Générer bulletin </a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-update-modele-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $evaluation->evaluation_modele_id ?>, 'scolarite/evaluation/showEdit_modele')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-delete-modele-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $evaluation->evaluation_modele_id ?>, 'evaluation_modele_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                                                </div>
                                                                           </div>
                                                                           <div class="user-list-item">
                                                                                <div class="user float-left mr-3">
                                                                                     <i class="mdi mdi-circle text-primary"></i>
                                                                                </div>
                                                                                <div class="user-desc overflow-hidden">
                                                                                     <h5 class="name mt-0 mb-1"><?= $evaluation->evaluation_modele_name ?></h5>
                                                                                     <span class="desc text-muted font-12 text-truncate d-block">Du <strong><?= mysql_to_date($evaluation->evaluation_modele_debut) ?></strong> au <strong><?= mysql_to_date($evaluation->evaluation_modele_fin) ?></strong></span>
                                                                                </div>
                                                                           </div>
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
                                                                                                                        <td style="text-align:left;"><?= @$classe->classe_name ?> <span class="text-warning" style="font-weight: bold;">( Bulletin à regénerez ! )</span> </td>
                                                                                                                   <?php endif; ?>
                                                                                                                   <td>
                                                                                                                        <center>
                                                                                                                             <?php if(check_evaluation_modele_ready(@$niveau->evaluation_modele_niveau_id) == true): ?>
                                                                                                                                  <a href="<?= _url("scolarite/bulletin/showBulletin/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="social-list-item border-success text-success" target="_blank"><i class="dropdown-icon mdi mdi-file-account"></i></a>
                                                                                                                             <?php else: ?>
                                                                                                                                  <a href="<?= _url("scolarite/bulletin/showBulletin/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-pill btn-outline-warning option-sm-btn" target="_blank" onclick="setTimeout(function(){ window.location.reload(); }, 200)"><i class="dropdown-icon mdi mdi-file-alert"></i></a>
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
                                                                                                                             <a href="<?= _url("scolarite/releve/showReleve/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
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
                                                                                                                             <a href="<?= _url("scolarite/statistique/showStatistique/".@$classe->classe_id."/".$niveau->evaluation_modele_niveau_id) ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
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
                                                                                                                             <a href="<?= _url($module_base."delete_dispense/".@$dispense->evaluation_dispense_id) ?>" class="social-list-item border-success text-success" title="Enlever dispense" style="margin-top: -5px;"><i class="dropdown-icon mdi mdi-account-check"></i></a>
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
                                                                 <?php endforeach;?>
                                                            </ul>

                                                       </div>
                                                  </div>
                                             </div>

                                             <div id="custom-modal-<?= $trimestre->evaluation_trimestre_id ?>" class="modal-demo">
                                                  <button type="button" class="close" onclick="Custombox.modal.close();">
                                                       <span>&times;</span><span class="sr-only">Close</span>
                                                  </button>
                                                  <h4 class="custom-modal-title">Ajouter evaluation</h4>
                                                  <div class="custom-modal-text text-left">
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

                                                                 <hr>
                                                                 <div class="modal-footer mt-3">
                                                                      <input type="hidden" name="evaluation_trimestre_id" value="<?= $trimestre->evaluation_trimestre_id ?>" required>
                                                                      <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                      <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div>

                                        <?php endforeach;?>

                                        <div class="btn-group dropdown mt-1 float-right">
                                             <button type="button" class="btn btn-info waves-effect waves-light">Evaluation Annuelle</button>
                                             <button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-chevron-down"></i></button>
                                             <div class="dropdown-menu">
                                                  <!-- <a href="#custom-statistique-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-receipt"></i> Générer statistiques </a>
                                                  <a href="#custom-releve-modal-<?= $evaluation->evaluation_modele_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-format-list-numbered"></i> Générer relevé </a> -->
                                                  <a href="#custom-annuelle-modal-<?= $cycle->settings_cycle_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-receipt"></i> Générer bulletin </a>
                                             </div>
                                        </div>



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
                                                                                                         <a href="<?= _url("scolarite/annuelle/showAnnuelle/".@$classe->classe_id) ?>" class="social-list-item border-success text-success" target="_blank"><i class="dropdown-icon mdi mdi-file-account"></i></a>
                                                                                                    <?php else: ?>
                                                                                                         <a href="javascript:void(0)" class="social-list-item border-dangersuccess text-dangersuccess " data-container="body" title="" data-toggle="popover" data-placement="right" data-content="Des modifications ont été effectués. Regénerez les évaluations de cette classe." data-original-title="Alert !">
                                                                                                              <i class="dropdown-icon mdi mdi-file-lock"></i>
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
               </div>
          <?php endforeach;?>
     <?php endif;?>
</div>

<div id="custom-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter trimestre</h4>
     <div class="custom-modal-text text-left" style="overflow-y: auto;">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert_trimestre'); ?>" method="post">
               <div class="col-10 col-md-12">
                    <div class="form-group mb-3">
                         <label>Cycle <span class="required">*</span></label>
                         <?php dropDown('SELECT settings_cycle_id, settings_cycle_name FROM settings_cycles', array(
                              'id'=>'settings_cycle_id',
                              'name'=>'settings_cycle_id',
                              'class'=>'form-control selectpicker',
                              'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                         )); ?>
                    </div>

                    <div class="form-group mb-3">
                         <label>Nom du trimestre <span class="required">*</span></label>
                         <input type="text" class="form-control" placeholder="Nom du trimestre" name="evaluation_trimestre_name" required>
                    </div>

                    <div class="form-group mb-3 row">
                         <div class="col-6">
                              <label>Date de début <span class="required">*</span></label>
                              <input type="date" class="form-control" name="evaluation_trimestre_debut" required/>
                         </div>
                         <div class="col-6">
                              <label>Date de fin <span class="required">*</span></label>
                              <input type="date" class="form-control" name="evaluation_trimestre_fin" required/>
                         </div>
                    </div>

                    <hr>
                    <div class="modal-footer mt-3">
                         <input type="hidden" class="form-control" name="settings_scolarite_id" value="<?= $_SESSION['dashboard']['settings_scolarite_id'] ?>" required/>
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </div>
          </form>
     </div>
</div>


<div id="custom-update-modele-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier evaluation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_modele'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Type d'évaluation <span class="required">*</span></label>
                                   <?php dropDown('SELECT settings_evaluation_id, settings_evaluation_name FROM settings_evaluations', array(
                                        'id'=>'settings_evaluation_id',
                                        'name'=>'settings_evaluation_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                   )); ?>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Code de l'évaluation <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Code" name="evaluation_modele_code" id="evaluation_modele_code" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom de l'évaluation <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Nom" name="evaluation_modele_name" id="evaluation_modele_name" required>
                              </div>

                              <div class="form-group mb-3 row">
                                   <div class="col-6">
                                        <label>Date de début <span class="required">*</span></label>
                                        <input type="date" class="form-control" name="evaluation_modele_debut" id="evaluation_modele_debut" required/>
                                   </div>
                                   <div class="col-6">
                                        <label>Date de fin <span class="required">*</span></label>
                                        <input type="date" class="form-control" name="evaluation_modele_fin" id="evaluation_modele_fin" required/>
                                   </div>
                              </div>

                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" name="evaluation_modele_id" id="evaluation_modele_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modele-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer modele</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_modele'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le modele sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="evaluation_modele_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
