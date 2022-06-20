<div class="row">
     <div class="col-xl-3 box-col-6">
          <div class="email-wrap bookmark-wrap">
               <div class="email-left-aside">
                    <div class="card">
                         <div class="card-body">
                              <div class="email-app-sidebar left-bookmark">
                                   <div class="media">
                                        <div class="media-size-email">
                                             <img class="me-3" src="<?php _url(); ?>assets/custom/png/011-exam.png" alt="" style="width: 50px; border:none!important;">
                                        </div>
                                        <div class="media-body">
                                             <h6 class="f-w-600">Modules</h6>
                                             <p>List of all modules for classes</p>
                                        </div>
                                   </div>
                                   <ul class="nav main-menu mb-30 mt-20" role="tablist">
                                        <li>
                                             <form class="app-search">
                                                  <div class="app-search-box">
                                                       <div class="input-group">
                                                            <input type="text" class="form-control" id="search" placeholder="Search ...">
                                                       </div>
                                                  </div>
                                             </form>
                                        </li>
                                   </ul>
                                   <ul class="crm-activity" role="tablist" style="overflow-y: auto; height: 510px;">
                                        <?php if(is_array(@$modules)):?>
                                             <?php foreach($modules as $module): ?>
                                                  <?php foreach($module->activites as $activite): ?>
                                                       <li class="media p-t-10 p-b-10 col-12">
                                                            <span class="me-2" style="margin-top: 55px;">
                                                                 <a href="javascript:showGrid(<?= @$activite->config->evaluation_note_config_id ?>, <?= @$niveau->evaluation_modele_niveau_id ?>)" class="btn btn-pill btn-outline-warning option-sm-btn" style="padding-left:8px;"><i class="fa fa-cog"></i></a>
                                                            </span>

                                                            <div class="align-self-center media-body">
                                                                 <h6 class="f-w-500" style="margin-left: -30px;"><?= $module->evaluation_module_name ?></h6>
                                                                 <input type="hidden" id="current_module_<?= @$activite->config->evaluation_note_config_id ?>" value="<?= $module->evaluation_module_name ?>">

                                                                 <br>
                                                                 <?php if($activite->settings_activite_code != "non"): ?>
                                                                      <h6 class="text-primary"> <?= $activite->settings_activite_name ?> </h6>
                                                                      <input type="hidden" id="current_activity_<?= @$activite->config->evaluation_note_config_id ?>" value="<?= $activite->settings_activite_name ?>">
                                                                 <?php else: ?>
                                                                      <h6 class="text-primary"> Module  </h6>
                                                                      <input type="hidden" id="current_activity_<?= @$activite->config->evaluation_note_config_id ?>" value="Module">
                                                                 <?php endif; ?>


                                                                 <?php if($activite->config != null): ?>
                                                                      <ul class="dates">
                                                                           <li>Bar : <strong><?= $activite->config->evaluation_note_config_max ?></strong></li>
                                                                           <li> Coef : <strong><?= $activite->config->evaluation_note_config_coef ?></strong></li>
                                                                      </ul>
                                                                 <?php endif; ?>
                                                            </div>
                                                       </li>
                                                  <?php endforeach; ?>
                                             <?php endforeach; ?>
                                        <?php endif;?>
                                   </ul>
                              </div>
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
                                        <h6 class="mb-0">Notation Grid - <?= @$niveau->settings_niveau_name ?></h6>
                                   </div>
                                   <div class="card-body pb-0 mb-30">

                                        <?php show_notification();?>

                                        <h4 class="font-primary" id="show_current_module"></h4>
                                        <h6 class="font-dark" id="show_current_activity"></h6>

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
                                                                           <th colspan="2" class="text-primary" > Intitilés </th>
                                                                           <th class="to_hide"> Note </th>
                                                                           <th class="to_hide" style="width: 200px;"> Commentaire </th>
                                                                           <th class="text-primary" style="border: 1px solid #dee2e6;"> Total </th>
                                                                           <th class="text-primary" style="border: 1px solid #dee2e6;"> Moyenne </th>
                                                                      </tr>
                                                                 </thead>

                                                                 <tbody>
                                                                      <?php foreach($classe->eleves as $key => $eleve): ?>
                                                                           <tr>
                                                                                <td><?= $key+1 ?></td>
                                                                                <td style="text-align: left;">
                                                                                     <?= $eleve->personne_prenoms." ".@$eleve->personne_nom ?>
                                                                                     <div class="f-right to_hide">
                                                                                          <a href="#custom-note-<?= $eleve->eleve_id ?>" data-toggle="modal" class="font-warning">
                                                                                               <i class="fa fa-edit"></i>
                                                                                          </a>
                                                                                     </div>
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
                                                                                               <h4 class="modal-title" id="myCenterModalLabel">Note de <?= $eleve->personne_prenoms." ".@$eleve->personne_nom ?></h4>
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
