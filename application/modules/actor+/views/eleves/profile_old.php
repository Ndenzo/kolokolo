<style>
.nav-link.text-info.active{
     background-color: #35B8E0!important;
     color: white!important;
     font-weight: bold!important;
     border-radius: 5px!important;
}
</style>
<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="row">
                         <div class="col-lg-4">

                              <div class="border-bottom text-center pb-4">
                                   <?php if($eleve->personne_photo != null):?>
                                        <div class="rounded avatar-xl mb-4 ml-auto mr-auto" style="height: 150px; width: 150px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($eleve->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                   <?php else:?>
                                        <div class="rounded avatar-xl mb-4 ml-auto mr-auto" style="height: 150px; width: 150px; box-shadow: 10px 10px 10px; background-image: url('<?php _url(); ?>assets/custom/img/default/boy.png'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                   <?php endif;?>
                                   <div class="mb-3">
                                        <h3><?= $eleve->personne_prenoms." ".$eleve->personne_nom ?></h3>
                                        <div class="d-flex align-items-center">
                                             <h5 class="mb-0 text-muted ml-auto mr-auto"><?= $eleve->eleve_flag_label ?></h5>
                                        </div>
                                   </div>
                                   <!-- <p class="w-75 mx-auto mb-3">Bureau Oberhaeuser is a design bureau focused on Information- and Interface Design. </p> -->
                                   <div class="d-flex justify-content-center">

                                   </div>
                              </div>

                              <div class="border-bottom py-4">
                                   <p><strong>Caractères</strong></p>
                                   <div>
                                        <?php if (@$eleve->renseignement_comp_ind != null): ?><label class="badge badge-success" style="font-size: 15px; font-weight: bold;"><?= $eleve->renseignement_comp_ind ?></label><?php endif; ?>
                                        <?php if (@$eleve->renseignement_comp_group != null): ?><label class="badge badge-success" style="font-size: 15px; font-weight: bold;"><?= $eleve->renseignement_comp_group ?></label><?php endif; ?>
                                   </div>
                              </div>
                              <div class="py-4">
                                   <p class="clearfix">
                                        <span class="float-left" style="font-weight: bold;">
                                             Matricule
                                        </span>
                                        <span class="float-right text-muted">
                                             <?= $eleve->eleve_matricule ?>
                                        </span>
                                   </p>
                                   <p class="clearfix">
                                        <span class="float-left" style="font-weight: bold;">
                                             Niveau
                                        </span>
                                        <span class="float-right text-muted">
                                             <?= $eleve->scolarite->settings_niveau_name ?>
                                        </span>
                                   </p>
                                   <p class="clearfix">
                                        <span class="float-left" style="font-weight: bold;">
                                             Adresse
                                        </span>
                                        <span class="float-right text-muted">
                                             <?= $eleve->personne_adresse ?>
                                        </span>
                                   </p>
                                   <p class="clearfix">
                                        <span class="float-left text-success" style="font-weight: bold;">
                                             Date d'inscription
                                        </span>
                                        <span class="float-right text-muted">
                                             <?= mysql_to_date($eleve->eleve_date_deb) ?>
                                        </span>
                                   </p>
                                   <?php if($eleve->scolarite->settings_scolarite_id != @get_current_scolarite()->settings_scolarite_id): ?>
                                        <p class="clearfix">
                                             <span class="float-left text-danger" style="font-weight: bold;">
                                                  Date de départ
                                             </span>
                                             <span class="float-right text-muted">
                                                  <?= mysql_to_date($eleve->eleve_date_fin) ?>
                                             </span>
                                        </p>
                                   <?php endif; ?>
                              </div>
                              <!-- <button class="btn btn-primary btn-block mb-2">Preview</button> -->
                         </div>
                         <div class="col-lg-8">
                              <ul class="nav nav-tabs nav-justified">
                                   <?php foreach($eleve->scolarites as $key => $scolarite): ?>
                                        <li class="nav-item">
                                             <a href="#home<?= $scolarite->eleves_scolarite_id ?>" data-toggle="tab" aria-expanded="false" class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>">
                                                  <span class="d-block d-sm-none <?php if ($key == 0): ?>text-warning<?php endif; ?>" style="font-size: 20px; font-weight: bold;"><?= $scolarite->settings_scolarite_code ?></span>
                                                       <span class="d-none d-sm-block <?php if ($key == 0): ?>text-warning<?php endif; ?>" style="font-size: 20px; font-weight: bold;"><?= $scolarite->settings_scolarite_code ?></span>
                                                       </a>
                                                  </li>
                                             <?php endforeach; ?>
                                        </ul>
                                        <div class="tab-content">
                                             <?php foreach($eleve->scolarites as $key => $scolarite): ?>
                                                  <div role="tabpanel" class="tab-pane fade <?php if ($key == 0): ?>show active <?php endif; ?>" id="home<?= $scolarite->eleves_scolarite_id ?>">
                                                       <div class="mt-4 py-2 border-top border-bottom">
                                                            <ul class="nav profile-navbar">
                                                                 <li class="nav-item">
                                                                      <a class="nav-link text-info active" data-toggle="tab" aria-expanded="false" style="font-size: 15px; font-weight: bold;" href="#info<?= $scolarite->eleves_scolarite_id ?>">
                                                                           <i class="mdi mdi-newspaper"></i>
                                                                           Infos
                                                                      </a>
                                                                 </li>
                                                                 <li class="nav-item">
                                                                      <a class="nav-link text-info" data-toggle="tab" aria-expanded="false" style="font-size: 15px; font-weight: bold;" href="#fact<?= $scolarite->eleves_scolarite_id ?>">
                                                                           <i class="mdi mdi-file"></i>
                                                                           Factures
                                                                      </a>
                                                                 </li>
                                                                 <li class="nav-item">
                                                                      <a class="nav-link text-info" data-toggle="tab" aria-expanded="false" style="font-size: 15px; font-weight: bold;" href="#eval<?= $scolarite->eleves_scolarite_id ?>">
                                                                           <i class="mdi mdi-chart-bar"></i>
                                                                           Evaluations
                                                                      </a>
                                                                 </li>
                                                                 <li class="nav-item">
                                                                      <a class="nav-link text-info" data-toggle="tab" aria-expanded="false" style="font-size: 15px; font-weight: bold;" href="#docs<?= $scolarite->eleves_scolarite_id ?>">
                                                                           <i class="mdi mdi-notebook"></i>
                                                                           Documents
                                                                      </a>
                                                                 </li>
                                                            </ul>
                                                       </div>
                                                       <div class="tab-content">

                                                            <div class="profile-feed tab-pane show active" id="info<?= $scolarite->eleves_scolarite_id ?>">
                                                                 <div class="d-flex align-items-start profile-feed-item">

                                                                      <div class="col-8">
                                                                           <div class="card alert alert-info">
                                                                                <?php if (me('role_code') != "tuteur"): ?>
                                                                                     <a href="#custom-comment-modal" class="btn btn-success float-right"  data-toggle="modal" style="margin-top: -10px;"><i class="dropdown-icon mdi mdi-comment-account"></i> Ajouter </a>
                                                                                <?php endif; ?>

                                                                                <h4 class="card-header mt-0 mb-3">Commentaires</h4>

                                                                                <div class="widget-chart-1" style="overflow-y: auto; max-height: 500px;">

                                                                                     <?php foreach($scolarite->comments as $comment): ?>
                                                                                          <hr>

                                                                                          <div class="media mb-3">
                                                                                               <!-- <div class="d-flex mr-3">
                                                                                               <a href="#"> <img class="media-object rounded-circle avatar-sm" alt="64x64" src="assets/images/users/user-1.jpg"> </a>
                                                                                          </div> -->
                                                                                          <div class="media-body">
                                                                                               <span class="float-right text-muted" style="font-size: 10px; margin-right: 20px;"><?= gmdate("d-m-Y h:i", $comment->eleve_scolarite_comment_added ) ?></span>
                                                                                               <h5 class="mt-0 mb-2"><?= $comment->user_nicename ?></h5>
                                                                                               <p class="font-13 text-muted mb-0">
                                                                                                    <?= $comment->eleve_scolarite_comment_desc ?>
                                                                                               </p>
                                                                                               <!-- <a href="" class="text-success font-13">Reply</a> -->
                                                                                          </div>
                                                                                     </div>

                                                                                <?php endforeach; ?>


                                                                           </div>

                                                                      </div>
                                                                 </div>

                                                                 <div class="col-4">
                                                                      <div class="row">
                                                                           <div class="col-xl-12">
                                                                                <div class="card widget-user card border border-success mt-1">
                                                                                     <div class="text-center">
                                                                                          <h2 class="font-weight-normal text-success"><span data-plugin="counterup"><?= get_absences($scolarite->eleves_scolarite_id, "nb") ?></span>J</h2>
                                                                                          <h5>Absences</h5>
                                                                                          <a href="#custom-absence-modal" class="btn btn-info ml-auto mr-auto"  data-toggle="modal"><i class="mdi mdi-account-question"></i> Consulter </a>
                                                                                     </div>
                                                                                </div>
                                                                           </div>

                                                                           <div class="col-xl-12">
                                                                                <div class="card widget-user card border border-warning mt-1">
                                                                                     <div class="text-center">
                                                                                          <h2 class="font-weight-normal text-warning"><span data-plugin="counterup"><?= get_retards($scolarite->eleves_scolarite_id, "nb") ?></span>H</h2>
                                                                                          <h5>Retards</h5>
                                                                                          <a href="#custom-retard-modal" class="btn btn-info ml-auto mr-auto"  data-toggle="modal"><i class="mdi mdi-account-question"></i> Consulter </a>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <?php if (me('role_code') != "tuteur"): ?>
                                                                           <div class="row">
                                                                                <div class="col-12">
                                                                                     <a href="#custom-download-modal" class="btn btn-purple btn-lg ml-auto mr-auto form-control" data-toggle="modal"><i class="mdi mdi-cloud-download-outline"></i> Télécharger </a>
                                                                                </div>
                                                                           </div>
                                                                           <?php if ($key == 0): ?>
                                                                                <div class="row mt-2">
                                                                                     <div class="col-12">
                                                                                          <a href="#custom-mutation-modal" class="btn btn-danger btn-lg ml-auto mr-auto form-control" data-toggle="modal"><i class="mdi mdi-arrow-expand"></i> Muter </a>
                                                                                     </div>
                                                                                </div>
                                                                           <?php endif; ?>
                                                                      <?php endif; ?>

                                                                 </div>


                                                                 <div id="custom-absence-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:center;">N°</th>
                                                                                                    <th style="text-align:center;">Début</th>
                                                                                                    <th style="text-align:center;">Fin</th>
                                                                                                    <th style="text-align:center;">Commentaire</th>
                                                                                               </tr>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                               <?php foreach(@get_absences($scolarite->eleves_scolarite_id) as $key => $absence):?>
                                                                                                    <tr>
                                                                                                         <td style="text-align:center;"><?= $key+1 ?></td>
                                                                                                         <td style="text-align:center;"><?= @$absence->evaluation_absence_debut ?></td>
                                                                                                         <td style="text-align:center;"><?= @$absence->evaluation_absence_fin ?></td>
                                                                                                         <td style="text-align:center;"><?= @$absence->evaluation_absence_desc ?></td>
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

                                                                 <div id="custom-retard-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:center;">N°</th>
                                                                                                    <th style="text-align:center;">Début</th>
                                                                                                    <th style="text-align:center;">Fin</th>
                                                                                                    <th style="text-align:center;">Commentaire</th>
                                                                                               </tr>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                               <?php foreach(@get_retards($scolarite->eleves_scolarite_id) as $retard):?>
                                                                                                    <tr>
                                                                                                         <td style="text-align:center;"><?= $key+1 ?></td>
                                                                                                         <td style="text-align:center;"><?= @$retard->evaluation_retard_debut ?></td>
                                                                                                         <td style="text-align:center;"><?= @$retard->evaluation_retard_fin ?></td>
                                                                                                         <td style="text-align:center;"><?= @$retard->evaluation_retard_desc ?></td>
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

                                                            </div>
                                                       </div>

                                                       <div class="profile-feed tab-pane" id="fact<?= $scolarite->eleves_scolarite_id ?>">
                                                            <div class="d-flex align-items-start profile-feed-item">
                                                                 <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4020">
                                                                      <thead>
                                                                           <tr>
                                                                                <th>Numero</th>
                                                                                <th>Date</th>
                                                                                <th>Montant</th>
                                                                                <th>Encaisser</th>
                                                                                <th>A encaisser</th>
                                                                                <th>Statuts</th>
                                                                                <!-- <th class="justify-content-center" style="width: 100px;">Opérations</th> -->
                                                                           </tr>
                                                                      </thead>
                                                                      <tbody id="facture_list">
                                                                           <?php if(is_array(@$scolarite->factures)):?>
                                                                                <?php foreach(@$scolarite->factures as $facture):?>
                                                                                     <tr >
                                                                                          <td><?=@$facture->facture_num?></td>
                                                                                          <td><?=gmdate("d-m-Y H:i", @$facture->facture_added)?></td>
                                                                                          <td><?=thousand(@$facture->montant - @$facture->facture_remise)?></td>
                                                                                          <td><?=thousand(@$facture->encaissement)?></td>
                                                                                          <td><?=thousand(@$facture->montant - @$facture->encaissement - @$facture->facture_remise)?></td>
                                                                                          <td><span class="badge badge-<?=@$facture->facture_flag_class?>"><?=@$facture->facture_flag_label?></span></td>
                                                                                     </tr>
                                                                                <?php endforeach;?>
                                                                           <?php endif;?>
                                                                      </tbody>
                                                                 </table>
                                                            </div>
                                                       </div>

                                                       <div class="profile-feed tab-pane" id="eval<?= $scolarite->eleves_scolarite_id ?>">
                                                            <div class="d-flex align-items-start profile-feed-item">
                                                                 <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                                                      <thead>
                                                                           <tr>
                                                                                <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:left;">Evaluations</th>
                                                                                <th style="text-align:center; width: 100px;">Action</th>
                                                                           </tr>
                                                                      </thead>
                                                                      <tbody>

                                                                           <?php foreach(@get_evaluation_modeles($scolarite->classe_id, $scolarite->settings_scolarite_id) as $evaluation):?>
                                                                                <?php if(check_evaluation_modele_ready(@$evaluation->evaluation_modele_niveau_id) == true): ?>
                                                                                     <tr>
                                                                                          <td style="text-align:left;"><?= @$evaluation->evaluation_modele_name ?></td>
                                                                                          <td>
                                                                                               <center>
                                                                                                    <a href="<?= _url("tuteur/bulletin/showBulletin/".@$scolarite->classe_id."/".$evaluation->evaluation_modele_niveau_id.'/'.$scolarite->eleves_scolarite_id.'/'.$scolarite->settings_scolarite_id) ?>" class="btn btn-warning option-sm-btn" style="margin-top: -10px; margin-bottom: -10px;" target="_blank"><i class="icon-eye"></i></a>
                                                                                               </center>
                                                                                          </td>
                                                                                     </tr>
                                                                                <?php endif; ?>
                                                                           <?php endforeach;?>
                                                                           <?php if(check_annuelle_evaluation_modele_ready(@$scolarite->classe_id, $scolarite->settings_scolarite_id)): ?>
                                                                                <tr>
                                                                                     <td colspan="2">
                                                                                          <center>
                                                                                               <a href="<?= _url("tuteur/annuelle/showAnnuelle/".@$scolarite->classe_id."/".$scolarite->eleves_scolarite_id.'/'.$scolarite->settings_scolarite_id) ?>" class="btn btn-info form-control" target="_blank">Bulletin Annuelle</a>
                                                                                          </center>
                                                                                     </td>
                                                                                </tr>
                                                                           <?php endif; ?>
                                                                           <!-- <?php //else: ?>
                                                                           <tr>
                                                                           <td colspan="2">
                                                                           <center>
                                                                           <a href="#" class="btn btn-light form-control disable">Aucune évaluation disponible</a>
                                                                      </center>
                                                                 </td>
                                                            </tr>
                                                            <?php //endif; ?> -->
                                                       </tbody>
                                                  </table>
                                             </div>
                                        </div>

                                        <div class="profile-feed tab-pane" id="docs<?= $scolarite->eleves_scolarite_id ?>">
                                             <div class="d-flex align-items-start profile-feed-item">
                                                  <ul class="list-group mb-0 mt-0 user-list col-12" style="max-height: 500px; overflow-y: auto;">
                                                       <?php foreach(@$eleve->modules as $module):?>
                                                            <li class="list-group-item">
                                                                 <div class="float-right">
                                                                      <a href="#support-modal-<?= $module->support_module_niveau_id ?>" class="btn btn-icon waves-effect waves-light btn-lighten-info mt-2" data-toggle="modal" ><i class="dropdown-icon mdi mdi-book-multiple"></i></a>
                                                                 </div>
                                                                 <div class="user-list-item">
                                                                      <div class="user-desc overflow-hidden">
                                                                           <h5 class="name"><?= $module->evaluation_module_name ?></h5>
                                                                           <p class="desc text-muted mb-0 font-12">Nombre de support : <?= count(@$module->supports) ?></p>
                                                                      </div>
                                                                 </div>
                                                            </li>

                                                            <div id="support-modal-<?= $module->support_module_niveau_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                 <div class="modal-dialog modal-dialog-centered">
                                                                      <div class="modal-content">
                                                                           <div class="modal-header">
                                                                                <h4 class="modal-title" id="myCenterModalLabel">Consultez les supports</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                           </div>
                                                                           <div class="modal-body">
                                                                                <div class="row">
                                                                                     <ul class="list-group mb-0 user-list col-12">
                                                                                          <?php foreach(@$module->supports as $support):?>
                                                                                               <li class="list-group-item">
                                                                                                    <a href="<?= _url($support->support_link) ?>" target="_blank" class="user-list-item">
                                                                                                         <div class="float-right text-purple mt-2 h3">
                                                                                                              <i class="mdi mdi-cloud-download-outline"></i>
                                                                                                         </div>
                                                                                                         <div class="user avatar-sm float-left mr-2">
                                                                                                              <img src="<?php _url(); ?>assets/custom/png/pdf.png" alt="" class="img-fluid rounded-circle">
                                                                                                         </div>
                                                                                                         <div class="user-desc">
                                                                                                              <h5 class="name mt-0 mb-1"><?= $support->support_name ?></h5>
                                                                                                              <p class="desc text-muted mb-0 font-12"><?= gmdate("d-m-Y", $support->support_added) ?></p>
                                                                                                         </div>
                                                                                                    </a>
                                                                                               </li>
                                                                                          <?php endforeach;?>
                                                                                     </ul>
                                                                                </div>
                                                                           </div>
                                                                      </div><!-- /.modal-content -->
                                                                 </div><!-- /.modal-dialog -->
                                                            </div>
                                                       <?php endforeach;?>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div id="custom-comment-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                   <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                  <h4 class="modal-title" id="myCenterModalLabel">Ajouter commentaire</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                             </div>
                                             <div class="modal-body">
                                                  <form class="row justify-content-center" action="<?php _url($module_base.'insert_comment'); ?>" method="post">
                                                       <div class="col-10 col-md-12">
                                                            <div class="form-group mb-3">
                                                                 <label>Description</label>
                                                                 <textarea class="form-control" placeholder="Description" name="eleve_scolarite_comment_desc" rows="3" cols="80" required></textarea>
                                                            </div>
                                                            <hr>
                                                            <div class="modal-footer mt-3">
                                                                 <input type="hidden" class="form-control" name="eleves_scolarite_id" value="<?= $scolarite->eleves_scolarite_id ?>" required>
                                                                 <input type="hidden" class="form-control" name="eleve_id" value="<?= $eleve->eleve_id ?>" required>
                                                                 <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                 <button type="submit" class="btn btn-success col-md-4">Enregistrer</button>
                                                            </div>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div><!-- /.modal-content -->
                                   </div><!-- /.modal-dialog -->
                              </div>
                              <?php if (me('role_code') != "tuteur"): ?>

                                   <div id="custom-download-modal" class="modal fade bs-example-modal-lg show" tabindex="-1" facture_flag="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                             <div class="modal-content">
                                                  <div class="modal-header">
                                                       <h4 class="modal-title" id="myCenterModalLabel">Téléchargement</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  </div>
                                                  <div class="modal-body">
                                                       <form class="row justify-content-center" action="<?php _url('settings/facture_flag/delete'); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="col-10 mt-50">
                                                                 <div class="row">
                                                                      <div class="col-6" >
                                                                           <div class="card">
                                                                                <div class="row">
                                                                                     <img src="<?php _url(); ?>assets/custom/png/031-calendar.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                                                                                     <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                                                                                          <h4>Certificat de scolarite</h4>
                                                                                     </div>
                                                                                     <div class="col-8 mr-auto ml-auto">
                                                                                          <a href="<?php _url($module_base."showCertificat/".$eleve->eleve_id) ?>" class="btn btn-warning btn-sm form-control" target="_blank"><i class="fa fa-download"></i> Télécharger </a>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                                 <div class="modal-footer mt-3">
                                                                      <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                   </div>

                                   <?php if ($key == 0): ?>
                                        <div id="custom-mutation-modal" class="modal fade bs-example-modal-lg show" tabindex="-1" facture_flag="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                             <div class="modal-dialog modal-dialog-centered">
                                                  <div class="modal-content">
                                                       <div class="modal-header">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Mutation</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                       </div>
                                                       <div class="modal-body">
                                                            <form class="row justify-content-center" action="<?php _url($module_base.'insert_mutation'); ?>" method="post" enctype="multipart/form-data">
                                                                 <div class="col-11 mt-20">
                                                                      <div class="alert alert-warning fade show mb-3">
                                                                           <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                                                           <h4>Note !</h4>
                                                                           <p>Attention, vous êtes sur le point d'appliquer une mutation de l'élève ! Celle-ci aura une incidence sur sa scolarite.</p>
                                                                      </div>
                                                                      <div class="form-group mb-3">
                                                                           <label>Cycle <span class="required">*</span></label>
                                                                           <?php dropDown('SELECT settings_cycle_id, settings_cycle_name FROM settings_cycles', array(
                                                                                'id'=>'settings_cycle_id_sco',
                                                                                'name'=>'settings_cycle_id',
                                                                                'class'=>'form-control selectpicker',
                                                                                'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required',
                                                                                'selected'=> $scolarite->settings_cycle_id
                                                                           )); ?>
                                                                      </div>
                                                                      <div class="form-group mb-3">
                                                                           <label>Niveau <span class="required">*</span></label>
                                                                           <?php dropChained('SELECT settings_niveau_id, settings_niveau_name, settings_cycle_id FROM settings_niveaux', array(
                                                                                'id'=>'settings_niveau_id_sco',
                                                                                'name'=>'settings_niveau_id',
                                                                                'class'=>'form-control selectpicker',
                                                                                'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                                                           )); ?>
                                                                      </div>
                                                                      <div class="form-group mb-3">
                                                                           <label>Classe <span class="required">*</span></label>
                                                                           <?php dropChained('SELECT classe_id, classe_name, settings_niveau_id FROM classes', array(
                                                                                'id'=>'classe_id_sco',
                                                                                'name'=>'classe_id',
                                                                                'class'=>'form-control selectpicker',
                                                                                'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required',
                                                                           )); ?>
                                                                      </div>
                                                                      <div class="modal-footer mt-3">
                                                                           <input type="hidden" class="form-control" name="settings_scolarite_id" value="<?= $scolarite->settings_scolarite_id ?>" required>
                                                                           <input type="hidden" class="form-control" name="eleves_scolarite_id" value="<?= $scolarite->eleves_scolarite_id ?>" required>
                                                                           <input type="hidden" class="form-control" name="eleve_id" value="<?= $eleve->eleve_id ?>" required>
                                                                           <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                           <button type="submit" class="btn btn-danger col-md-4">Muter</button>
                                                                      </div>
                                                                 </div>
                                                            </form>
                                                       </div>
                                                  </div><!-- /.modal-content -->
                                             </div><!-- /.modal-dialog -->
                                        </div>
                                   <?php endif; ?>

                              <?php endif; ?>
                         <?php endforeach; ?>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>
</div>
