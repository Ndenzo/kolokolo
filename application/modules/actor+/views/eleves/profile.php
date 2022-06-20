<style>
.nav-link.text-info.active{
     background-color: #35B8E0!important;
     color: white!important;
     font-weight: bold!important;
     border-radius: 5px!important;
}
</style>

<div class="row">
     <div class="col-xl-4">
          <div class="card">
               <div class="card-title mb-5">
                    <h4 class="card-title mb-0">Profil</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
               </div>
               <div class="card-body">
                    <form>
                         <div class="row mb-30">
                              <div class="profile-title">
                                   <div class="media">
                                        <?php if($eleve->personne_photo != null):?>
                                             <img class="img-70 rounded-circle" alt="" src="<?= _url($eleve->personne_photo) ?>">
                                        <?php else:?>
                                             <img class="img-70 rounded-circle" alt="" src="<?php _url(); ?>assets/custom/img/default/boy.png">
                                        <?php endif;?>
                                        <div class="media-body mt-10 m-l-20">
                                             <h5 class="mb-1"><?= $eleve->personne_prenoms." ".$eleve->personne_nom ?></h5>
                                             <p class="badge badge-<?= $eleve->eleve_flag_class ?>"><?= $eleve->eleve_flag_label ?></p>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <?php if (@$eleve->renseignement_comp_ind != null && @$eleve->renseignement_comp_group != null): ?>
                              <div class=" border-top py-4">
                                   <p><strong>Caractères</strong></p>
                                   <div>
                                        <?php if (@$eleve->renseignement_comp_ind != null): ?><label class="badge badge-success" style="font-size: 15px; font-weight: bold;"><?= $eleve->renseignement_comp_ind ?></label><?php endif; ?>
                                        <?php if (@$eleve->renseignement_comp_group != null): ?><label class="badge badge-success" style="font-size: 15px; font-weight: bold;"><?= $eleve->renseignement_comp_group ?></label><?php endif; ?>
                                   </div>
                              </div>
                         <?php endif; ?>

                         <div class="border-top py-4">
                              <p class="clearfix">
                                   <span class="float-left" style="font-weight: bold;">
                                        Matricule :
                                   </span>
                                   <span class="float-right text-muted">
                                        <?= $eleve->eleve_matricule ?>
                                   </span>
                              </p>
                              <p class="clearfix">
                                   <span class="float-left" style="font-weight: bold;">
                                        Niveau :
                                   </span>
                                   <span class="float-right text-muted">
                                        <?= $eleve->scolarite->settings_niveau_name ?>
                                   </span>
                              </p>
                              <p class="clearfix">
                                   <span class="float-left" style="font-weight: bold;">
                                        Adresse :
                                   </span>
                                   <span class="float-right text-muted">
                                        <?= $eleve->personne_adresse ?>
                                   </span>
                              </p>
                              <p class="clearfix">
                                   <span class="float-left text-success" style="font-weight: bold;">
                                        Date d'inscription :
                                   </span>
                                   <span class="float-right text-muted">
                                        <?= mysql_to_date($eleve->eleve_date_deb) ?>
                                   </span>
                              </p>
                              <?php if($eleve->scolarite->settings_scolarite_id != @get_current_scolarite()->settings_scolarite_id): ?>
                                   <p class="clearfix">
                                        <span class="float-left text-danger" style="font-weight: bold;">
                                             Date de départ :
                                        </span>
                                        <span class="float-right text-muted">
                                             <?= mysql_to_date($eleve->eleve_date_fin) ?>
                                        </span>
                                   </p>
                              <?php endif; ?>
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <div class="col-xl-8">
          <div class="card">
               <div class="card-title mb-5">
                    <div class="header-top">
                         <h5 class="m-0">Scolarité</h5>
                         <div class="card-header-right-icon">
                              <div class="dropdown">
                                   <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-expanded="false" style="width: 135px!important;">
                                        Années
                                   </button>
                                   <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <div class="nav nav-pills" id="pills-danger-tab" role="tablist">
                                             <?php foreach($eleve->scolarites as  $key => $scolarite): ?>
                                                  <a class="nav-link dropdown-item" id="pills-scolarite-<?= $scolarite->settings_scolarite_id ?>-tab" data-toggle="pill" href="#pills-scolarite-<?= $scolarite->settings_scolarite_id ?>" role="tab" aria-controls="pills-scolarite-<?= $scolarite->settings_scolarite_id ?>" aria-selected="false"><?= $scolarite->settings_scolarite_code ?></a>
                                             <?php endforeach; ?>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card-body">

                    <?php show_notification();?>

                    <div class="tab-content" id="pills-danger-tabContent">
                         <?php foreach($eleve->scolarites as  $key => $scolarite): ?>

                              <div class="tab-pane fade <?php if ($key == 0): ?> show active <?php endif; ?>" id="pills-scolarite-<?= $scolarite->settings_scolarite_id ?>" role="tabpanel" aria-labelledby="pills-scolarite-<?= $scolarite->settings_scolarite_id ?>-tab">

                                   <div class="row">
                                        <ul class="nav nav-pills nav-primary col-8" id="right-tab" role="tablist" style="font-size: 12px!important;">

                                             <li class="nav-item">
                                                  <a class="nav-link active" id="contact-right-tab" data-toggle="tab" href="#docs<?= $scolarite->eleves_scolarite_id ?>" role="tab" aria-controls="contact-icon" aria-selected="false">
                                                       <i class="icofont icofont-document-folder"></i>
                                                       Rapport
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" id="profile-right-tab" data-toggle="tab" href="#fact<?= $scolarite->eleves_scolarite_id ?>" role="tab" aria-controls="profile-icon" aria-selected="false">
                                                       <i class="icofont icofont-ticket"></i>
                                                       Factures
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" id="contact-right-tab" data-toggle="tab" href="#eval<?= $scolarite->eleves_scolarite_id ?>" role="tab" aria-controls="contact-icon" aria-selected="false">
                                                       <i class="icofont icofont-print"></i>
                                                       Bulletins
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" id="right-home-tab" data-toggle="tab" href="#info<?= $scolarite->eleves_scolarite_id ?>" role="tab" aria-controls="right-home" aria-selected="true">
                                                       <i class="icofont icofont-comment"></i>
                                                       Commentaires
                                                  </a>
                                             </li>

                                        </ul>
                                        <h5 class="mb-30 text-secondary col-4" style="text-align: right;"><?= $scolarite->settings_scolarite_code ?></h5>
                                   </div>

                                   <div class="tab-content">

                                        <div class="profile-feed tab-pane show active" id="docs<?= $scolarite->eleves_scolarite_id ?>">
                                             <div class="row">

                                                  <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                                                       <?php if (me('role_code') == "root"): ?>
                                                            <div class="card o-hidden">
                                                                 <div class="card-body">
                                                                      <div class="ecommerce-widgets media">
                                                                           <div class="media-body">
                                                                                <h4 class="f-w-500 mb-0 f-20 text-primary">Certificat</h4>
                                                                                <p class="f-w-500 font-roboto mt-20">Télécharger le certificat de scolarité</p>
                                                                           </div>
                                                                           <a href="<?php _url($module_base."showCertificat/".$eleve->eleve_id) ?>" class="ecommerce-box light-bg-primary" target="_blank"><i data-feather="download-cloud" aria-hidden="true"></i></a>
                                                                      </div>
                                                                 </div>
                                                            </div>

                                                            <!-- <div class="card o-hidden">
                                                                 <div class="card-body">
                                                                      <div class="ecommerce-widgets media">
                                                                           <div class="media-body">
                                                                                <h4 class="f-w-500 mb-0 f-20 text-primary">Fiche d'engagement</h4>
                                                                                <p class="f-w-500 font-roboto mt-20">Télécharger la Fiche d'engagement</p>
                                                                           </div>
                                                                           <a href="<?php _url($module_base."showCertificat/".$eleve->eleve_id) ?>" class="ecommerce-box light-bg-primary" target="_blank"><i data-feather="download-cloud" aria-hidden="true"></i></a>
                                                                      </div>
                                                                 </div>
                                                            </div> -->
                                                       <?php endif; ?>

                                                       <div class="card o-hidden">
                                                            <div class="card-body">
                                                                 <div class="ecommerce-widgets media">
                                                                      <div class="media-body">
                                                                           <h4 class="f-w-500 mb-0 f-20 text-primary">Programme</h4>
                                                                           <p class="f-w-500 font-roboto mt-20">Télécharger le programme de l'élève</p>
                                                                      </div>
                                                                      <a href="<?= _url("classe/showClasseCalendar/".$scolarite->classe_id) ?>" class="ecommerce-box light-bg-primary" target="_blank"><i data-feather="download-cloud" aria-hidden="true"></i></a>
                                                                 </div>
                                                            </div>
                                                       </div>

                                                  </div>

                                                  <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                                                       <div class="card social-widget-card">
                                                            <div class="card-body">
                                                                 <div class="media-img">
                                                                      <img class="redial-social-widget" src="<?= _url("assets/custom/png/calendar.png") ?>" alt="" style="border-radius: 0px;">
                                                                 </div>

                                                                 <h5 class="b-b-light">Absences et Retards</h5>
                                                                 <div class="row">
                                                                      <a href="#custom-absence-modal" class="col text-center b-r-light badge-light-success b-r-10" data-toggle="modal"><span>Absences</span>
                                                                           <h4 class="mb-0"><?= get_absences($scolarite->eleves_scolarite_id, "nb") ?> <span>J</span></h4>
                                                                      </a>
                                                                      <a href="#custom-retard-modal" class="col text-center badge-light-warning b-r-10" data-toggle="modal"><span>Retards</span>
                                                                           <h4 class="mb-0"><?= get_retards($scolarite->eleves_scolarite_id, "nb") ?> <span>H</span></h4>
                                                                      </a>
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
                                                                                     <a href="<?= _url("tuteur/bulletin/showBulletin/".@$scolarite->classe_id."/".$evaluation->evaluation_modele_niveau_id.'/'.$scolarite->eleves_scolarite_id.'/'.$scolarite->settings_scolarite_id) ?>" class="btn btn-pill btn-outline-warning btn-lg option-sm-btn" target="_blank" style="font-size: 15px;"><i class="icon-eye"></i></a>
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
                                                       </tbody>
                                                  </table>
                                             </div>
                                        </div>

                                        <div class="profile-feed tab-pane" id="info<?= $scolarite->eleves_scolarite_id ?>">
                                             <div class="row">
                                                  <div class="col-12">
                                                       <a href="#custom-comment-modal" class="btn btn-pill btn-outline-success btn-lg option-btn" data-toggle="modal"><i data-feather="plus"></i></a>
                                                       <ul class="comment-box" style="overflow-y: auto; overflow-x: hidden; height: 400px;">
                                                            <?php foreach($scolarite->comments as $comment): ?>
                                                                 <li class="b-light p-10">
                                                                      <div class="media align-self-center">
                                                                           <?php if($comment->personne_photo != null):?>
                                                                                <img class="align-self-center" src="<?= _url($comment->personne_photo) ?>" alt="Generic placeholder image">
                                                                           <?php else:?>
                                                                                <img class="align-self-center" src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="Generic placeholder image">
                                                                           <?php endif;?>
                                                                           <div class="media-body">
                                                                                <div class="row">
                                                                                     <div class="col-md-4">
                                                                                          <h6 class="mt-0"><?= $comment->user_nicename ?></h6>
                                                                                     </div>
                                                                                     <div class="col-md-8">
                                                                                          <ul class="comment-social float-start float-md-end">
                                                                                               <li><i class="icofont icofont-calendar"></i><?= gmdate("d-m-Y h:i", $comment->eleve_scolarite_comment_added ) ?></li>
                                                                                          </ul>
                                                                                     </div>
                                                                                </div>
                                                                                <p><?= $comment->eleve_scolarite_comment_desc ?></p>
                                                                           </div>
                                                                      </div>
                                                                 </li>
                                                            <?php endforeach; ?>
                                                       </ul>
                                                  </div>



                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <?php if ($scolarite->reduction != null): ?>
                                   <div id="custom-show-reduction-modal-<?=@$eleve->eleve_id?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                             <div class="modal-content">
                                                  <div class="modal-header">
                                                       <h4 class="modal-title" id="myCenterModalLabel">Réduction élève</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  </div>
                                                  <div class="modal-body">
                                                       <div class="row justify-content-center">
                                                            <div class="col-10 col-md-12 text-center">

                                                                 <h3>Valeur</h3>
                                                                 <br>
                                                                 <h2 class="text-danger"> <?= thousand($scolarite->reduction->eleves_reduction_value)  ?> </h2>

                                                                 <div class="modal-footer mt-3">
                                                                      <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                      <a href="#custom-delete-reduction-modal" class="btn btn-danger col-md-4"  data-toggle="modal" onclick="define_delete(<?= $scolarite->reduction->eleves_reduction_id ?>, 'eleves_reduction_id')"><i class="dropdown-icon mdi mdi-cash-refund"></i> Supprimer </a>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              <?php endif; ?>

                              <div id="custom-comment-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                   <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                  <h4 class="modal-title" id="myCenterModalLabel">Ajouter commentaire</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                             </div>
                                             <div class="modal-body">
                                                  <form class="row" action="<?php _url($module_base.'insert_comment'); ?>" method="post">
                                                       <div class="col-10 col-md-12">
                                                            <div class="form-group mb-3">
                                                                 <label>Description</label>
                                                                 <textarea class="form-control" placeholder="Description" name="eleve_scolarite_comment_desc" rows="3" cols="80" required></textarea>
                                                            </div>
                                                            <div class="modal-footer mt-20">
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

                              <?php if (me('role_code') == "root"): ?>

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
