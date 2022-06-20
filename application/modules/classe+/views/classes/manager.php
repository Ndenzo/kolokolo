<div class="row project-cards">
     <div class="col-md-12 project-list">
          <div class="card">
               <div class="row">
                    <div class="col-md-8">
                         <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                              <?php if(is_array(@$cycles)):?>
                                   <?php foreach(@$cycles as $key => $cycle):?>
                                        <li class="nav-item"><a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" id="top-<?= $cycle->settings_cycle_id ?>-tab" data-toggle="tab" href="#top-<?= $cycle->settings_cycle_id ?>" role="tab" aria-controls="top-<?= $cycle->settings_cycle_id ?>" aria-selected="true">
                                             <i data-feather="corner-left-down"></i><?= $cycle->settings_cycle_name ?></a>
                                        </li>
                                   <?php endforeach;?>
                              <?php endif;?>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-sm-12">
          <div class="tab-content" id="top-tabContent">
               <?php if(is_array(@$cycles)):?>
                    <?php foreach(@$cycles as $key => $cycle):?>
                         <div class="tab-pane fade <?php if ($key == 0): ?> show active <?php endif; ?>" id="top-<?= $cycle->settings_cycle_id ?>" role="tabpanel" aria-labelledby="top-<?= $cycle->settings_cycle_id ?>-tab">
                              <div class="card mb-0">
                                   <div class="card-header d-flex">
                                        <h5>Gestion des classes</h5>
                                   </div>
                                   <div class="card-body p-0">
                                        <div class="row list-persons" id="addcon">
                                             <div class="col-xl-3 xl-25 col-md-5" >
                                                  <div class="col-12 nav nav-pills b-r-light p-r-25 p-l-25 p-t-25" aria-orientation="vertical" style="overflow-y: auto;">
                                                       <?php foreach(@$cycle->niveaux as $k => $niveau):?>
                                                            <a class="contact-tab-0 nav-link col-12 element <?php if ($k == 0): ?> active <?php endif; ?>" id="v-pills-<?= $niveau->settings_niveau_id ?>-tab" data-toggle="pill" href="#v-pills-<?= $niveau->settings_niveau_id ?>" role="tab" aria-controls="v-pills-<?= $niveau->settings_niveau_id ?>" aria-selected="true"style="margin-bottom:0px!important;">
                                                                 <div class="media">
                                                                      <img class="img-50 img-fluid m-r-20 rounded-circle update_img_0" src="<?php _url(); ?>assets/custom/png/037-medal.png">
                                                                      <div class="media-body">
                                                                           <h6> <span class="first_name_0"><?= $niveau->settings_niveau_name ?></span></h6>
                                                                           <p class="email_add_0"><strong>Elèves : </strong> <?= @$niveau->n_eleves ?></p>
                                                                      </div>
                                                                 </div>
                                                            </a>
                                                       <?php endforeach;?>
                                                       <!-- <a class="nav-link btn btn-success form-control mt-10 mb-20" href="#">Add Level <span><i class="icofont icofont-plus" style="margin-left: 20px;"></i></span></a> -->
                                                  </div>
                                             </div>
                                             <div class="col-xl-9 col-md-7" style="height: 600px;">
                                                  <div class="tab-content" id="v-pills-tabContent-<?= $cycle->settings_cycle_id ?>">
                                                       <?php foreach(@$cycle->niveaux as $k => $niveau):?>
                                                            <div class="tab-pane contact-tab-4 tab-content-child fade <?php if ($k == 0): ?> show active <?php endif; ?>" id="v-pills-<?= $niveau->settings_niveau_id ?>" role="tabpanel" aria-labelledby="v-pills-<?= $niveau->settings_niveau_id ?>-tab">
                                                                 <div class="row mt-30">
                                                                      <div class="col-sm-3 col-xs-12">
                                                                           <div class="nav flex-column nav-pills" id="v-pillo-tab" role="tablist" aria-orientation="vertical">
                                                                                <?php foreach(@$niveau->classes as $kk => $classe):?>
                                                                                     <a class="nav-link <?php if ($kk == 0): ?> active <?php endif; ?>" id="v-pillo-<?= $classe->classe_id ?>-tab" data-toggle="pill" href="#v-pillo-<?= $classe->classe_id ?>" role="tab" aria-controls="v-pillo-<?= $classe->classe_id ?>" aria-selected="true">
                                                                                          <?= $classe->classe_name ?>
                                                                                     </a>
                                                                                <?php endforeach;?>
                                                                                <a class="nav-link btn btn-success mt-10" href="#custom-modal-<?= $niveau->settings_niveau_id ?>" data-toggle="modal">Ajouter Classe <span><i class="icofont icofont-plus" style="margin-left: 20px;"></i></span></a>
                                                                                <?php if($niveau->nb_eleves != 0):?>
                                                                                     <a href="<?= _url($module_base."classe_spliter/".$niveau->settings_niveau_id) ?>" class="nav-link btn btn-light mt-10">
                                                                                          Elèves non affectés &nbsp;
                                                                                          <span class="badge badge-warning float-right" style="margin-top: 3px;"><?= $niveau->nb_eleves ?></span>
                                                                                     </a>
                                                                                <?php endif;?>
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-sm-9 col-xs-12">
                                                                           <div class="tab-content" id="v-pillo-tabContent" >
                                                                                <?php foreach(@$niveau->classes as $kk => $classe):?>
                                                                                     <div class="tab-pane fade <?php if ($kk == 0): ?> show active <?php endif; ?>" id="v-pillo-<?= $classe->classe_id ?>" role="tabpanel" aria-labelledby="v-pillo-<?= $classe->classe_id ?>-tab">
                                                                                          <div class="row">
                                                                                               <div class="col-10">
                                                                                                    <a href="<?= _url("classe/showProgramme/".$classe->classe_id) ?>" class="btn btn-pill btn-outline-secondary btn-lg option-btn"><i class="icofont icofont-calendar"></i></a>
                                                                                                    <!-- <a href="<?= _url("classe/showComposition/".$classe->classe_id) ?>" class="btn btn-pill btn-outline-info btn-lg option-btn"><i data-feather="users"></i></a> -->
                                                                                                    <a href="#custom-download-modal-<?= $classe->classe_id ?>" class="btn btn-pill btn-outline-warning btn-lg option-btn" data-toggle="modal"><i class="icofont icofont-download"></i></a>
                                                                                                    <a href="<?php _url($module_base."showCards/".$classe->classe_id) ?>" class="btn btn-pill btn-outline-info btn-lg option-btn" target="_blank"><i class="icofont icofont-id-card"></i></a>
                                                                                               </div>
                                                                                               <div class="col-2">
                                                                                                    <div class="f-right me-4">
                                                                                                         <!-- <a href="#custom-delete-modal" class="btn btn-pill btn-outline-danger btn-lg option-btn" target="_blank"><i class="icofont icofont-trash"></i></a> -->
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                          <div class="row mt-30 col-12" style="height: 450px; overflow-y: auto;">
                                                                                               <div class="user-status table-responsive">
                                                                                                    <table class="table table-bordernone">
                                                                                                         <thead>
                                                                                                              <tr class="table-primary">
                                                                                                                   <th scope="col" style="width: 25px;">#</th>
                                                                                                                   <th scope="col" class="p-t-10">Prénom et Nom</th>
                                                                                                                   <th scope="col">Matricules</th>
                                                                                                                   <th scope="col"></th>
                                                                                                              </tr>
                                                                                                         </thead>
                                                                                                         <tbody>
                                                                                                              <?php foreach(@$classe->eleves as $kk => $eleve):?>
                                                                                                                   <tr>
                                                                                                                        <td><?= (int) $kk+1 ?></td>
                                                                                                                        <td class="bd-t-none u-s-tb"  style="text-align: left;">
                                                                                                                             <div class="align-middle image-sm-size">
                                                                                                                                  <?php if($eleve->personne_photo != null):?>
                                                                                                                                       <img class="img-radius align-top m-r-15 rounded-circle" src="<?= _url($eleve->personne_photo) ?>" alt="">
                                                                                                                                  <?php else:?>
                                                                                                                                       <img class="img-radius align-top m-r-15 rounded-circle" src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="">
                                                                                                                                  <?php endif;?>
                                                                                                                                  <div class="d-inline-block">
                                                                                                                                       <h6><?= $eleve->personne_prenoms ?> <?= $eleve->personne_nom ?></h6>
                                                                                                                                  </div>
                                                                                                                             </div>
                                                                                                                        </td>
                                                                                                                        <td><h6><span class="text-muted"><?= $eleve->eleve_matricule ?></span></h6></td>
                                                                                                                        <td>
                                                                                                                             <?php if (count(@$niveau->classes) > 1): ?>
                                                                                                                                  <a href="#custom-move-modal-<?= $classe->classe_id ?>" class="btn btn-secondary btn-sm" data-toggle="modal" onclick="define_edit(<?= $eleve->eleves_scolarite_id ?>, 'classe/showMove')">
                                                                                                                                       <i class="fa fa-exchange"></i>
                                                                                                                                  </a>
                                                                                                                             <?php endif; ?>
                                                                                                                        </td>
                                                                                                                   </tr>
                                                                                                              <?php endforeach;?>
                                                                                                         </tbody>
                                                                                                    </table>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>

                                                                                     <?php if (count(@$niveau->classes) > 1): ?>
                                                                                          <div id="custom-move-modal-<?= $classe->classe_id ?>" class="modal fade bs-example-modal-lg show" tabindex="-1" facture_flag="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                               <div class="modal-dialog modal-dialog-centered">
                                                                                                    <div class="modal-content">
                                                                                                         <div class="modal-header">
                                                                                                              <h4 class="modal-title" id="myCenterModalLabel">Déplacer Elève</h4>
                                                                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                         </div>
                                                                                                         <div class="modal-body">
                                                                                                              <form class="row justify-content-center" action="<?php _url($module_base.'move'); ?>" method="post">
                                                                                                                   <div class="col-11 mt-20">
                                                                                                                        <div class="form-group mb-3">
                                                                                                                             <label>Elève</label>
                                                                                                                             <input type="text" class="form-control" id="personne_full_name_<?= $classe->classe_id ?>" disabled>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                                   <div class="col-11 mt-20 megaoptions-border-space-sm">
                                                                                                                        <label>Déplacer vers ..</label>
                                                                                                                        <div class="mega-inline plain-style">
                                                                                                                             <div class="row">
                                                                                                                                  <?php foreach(@$niveau->classes as $ki => $clas):?>
                                                                                                                                       <?php if ($clas->classe_id != $classe->classe_id): ?>
                                                                                                                                            <div class="col-6">
                                                                                                                                                 <div class="card">
                                                                                                                                                      <div class="media p-10">
                                                                                                                                                           <div class="form-check radio radio-primary me-2">
                                                                                                                                                                <input class="form-check-input" id="classe_<?= $clas->classe_id ?><?= $classe->classe_id ?>" type="radio" name="classe_id" value="<?= $clas->classe_id ?>">
                                                                                                                                                                <label class="form-check-label" for="classe_<?= $clas->classe_id ?><?= $classe->classe_id ?>"></label>
                                                                                                                                                           </div>
                                                                                                                                                           <div class="media-body">
                                                                                                                                                                <h6 class="mt-0 mega-title-badge"><span class="badge badge-primary" style="margin-top:7px;"><?= $clas->classe_name ?></span></h6>
                                                                                                                                                           </div>
                                                                                                                                                      </div>
                                                                                                                                                 </div>
                                                                                                                                            </div>
                                                                                                                                       <?php endif; ?>
                                                                                                                                  <?php endforeach;?>
                                                                                                                             </div>
                                                                                                                        </div>
                                                                                                                   </div>
                                                                                                                   <div class="modal-footer mt-30">
                                                                                                                        <input type="hidden" class="form-control" name="eleves_scolarite_id" id="eleves_scolarite_id_<?= $classe->classe_id ?>" required>
                                                                                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                        <button type="submit" class="btn btn-success col-md-4">Submit</button>
                                                                                                                   </div>
                                                                                                              </form>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                     <?php endif; ?>

                                                                                     <div id="custom-download-modal-<?= $classe->classe_id ?>" class="modal fade bs-example-modal-lg show" tabindex="-1" facture_flag="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                          <div class="modal-dialog modal-dialog-centered">
                                                                                               <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                         <h4 class="modal-title" id="myCenterModalLabel">Téléchargement - <?= $classe->classe_name ?></h4>
                                                                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                    </div>
                                                                                                    <div class="modal-body row">
                                                                                                         <div class="col-10 mt-20 offset-1">
                                                                                                              <div class="row">
                                                                                                                   <div class="col-12">
                                                                                                                        <a href="<?php _url($module_base."showClasseCalendar/".$classe->classe_id) ?>" target="_blank" style="text-decoration: none; color: black;">
                                                                                                                             <div class="card b-info">
                                                                                                                                  <div class="media p-10">
                                                                                                                                       <div class="form-check radio radio-primary">
                                                                                                                                       </div>
                                                                                                                                       <div class="media-body">
                                                                                                                                            <h6 class="mt-0 mb-20 mega-title-badge">
                                                                                                                                                 Programme
                                                                                                                                                 <span class="badge badge-info pull-right digits">Télécharger</span>
                                                                                                                                            </h6>
                                                                                                                                            <p>Télécharger le programme de la classe de <?= $classe->classe_name ?>!</p>
                                                                                                                                       </div>
                                                                                                                                  </div>
                                                                                                                             </div>
                                                                                                                        </a>
                                                                                                                   </div>
                                                                                                                   <div class="col-12">
                                                                                                                        <a href="<?php _url($module_base."showClasseList/".$classe->classe_id) ?>" target="_blank" style="text-decoration: none; color: black;">
                                                                                                                             <div class="card b-info">
                                                                                                                                  <div class="media p-10">
                                                                                                                                       <div class="form-check radio radio-primary">
                                                                                                                                       </div>
                                                                                                                                       <div class="media-body">
                                                                                                                                            <h6 class="mt-0  mb-20 mega-title-badge">
                                                                                                                                                 Liste de classe
                                                                                                                                                 <span class="badge badge-success pull-right digits">Download</span>
                                                                                                                                            </h6>
                                                                                                                                            <p>Télécharger la liste des élèves de classe de <?= $classe->classe_name ?>!</p>
                                                                                                                                       </div>
                                                                                                                                  </div>
                                                                                                                             </div>
                                                                                                                        </a>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                         <div class="modal-footer mt-3">
                                                                                                              <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                <?php endforeach;?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>

                                                            <div id="custom-modal-<?= $niveau->settings_niveau_id ?>" class="modal fade bs-example-modal-lg show" tabindex="-1" facture_flag="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                 <div class="modal-dialog modal-dialog-centered">
                                                                      <div class="modal-content">
                                                                           <div class="modal-header">
                                                                                <h4 class="modal-title" id="myCenterModalLabel">Ajouter Classe</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                           </div>
                                                                           <div class="modal-body">
                                                                                <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                                                                                     <div class="col-10 ml-auto mr-auto">

                                                                                          <div class="form-group mb-3">
                                                                                               <label>Niveau</label>
                                                                                               <?php
                                                                                               dropDown('SELECT settings_niveau_id, settings_niveau_name FROM settings_niveaux', array(
                                                                                                    'id'=>'settings_niveau_id',
                                                                                                    'name'=>'settings_niveau_id',
                                                                                                    'class'=>'form-control selectpicker',
                                                                                                    'attr'=>'title ="-- Choose --"  data-size="17" data-live-search="true" required',
                                                                                                    'selected' => $niveau->settings_niveau_id
                                                                                               )); ?>
                                                                                          </div>

                                                                                          <div class="form-group mb-3">
                                                                                               <label>Classe</label>
                                                                                               <input type="text" class="form-control" placeholder="Classe" name="classe_name" required>
                                                                                          </div>

                                                                                          <div class="modal-footer mt-40">
                                                                                               <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                               <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                                          </div>
                                                                                     </div>
                                                                                </form>
                                                                           </div>
                                                                      </div><!-- /.modal-content -->
                                                                 </div><!-- /.modal-dialog -->
                                                            </div>
                                                       <?php endforeach;?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach;?>
               <?php endif;?>
          </div>
     </div>
</div>
