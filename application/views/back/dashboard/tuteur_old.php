<div class="row">

     <?php show_notification();?>
     <?php if(is_array(@$tuteur->eleves)):?>
          <?php foreach(@$tuteur->eleves as $rows):?>

               <div class="col-lg-3 col-md-4 col-6 element">
                    <div class="text-center card widget-user border border-<?= $rows->eleve_flag_class ?>">

                         <div>
                              <?php if($rows->personne_photo != null):?>
                                   <div class="rounded avatar-xl mb-4 ml-auto mr-auto" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                              <?php else:?>
                                   <div class="rounded avatar-xl mb-4 ml-auto mr-auto" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?php _url(); ?>assets/custom/img/default/boy.png'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                              <?php endif;?>

                              <p class="text-muted font-13 mb-4 mt-3">
                                   <?= $rows->personne_prenoms." ".$rows->personne_nom ?>
                              </p>

                              <div class="text-left">
                                   <p class="text-muted font-13"><strong>Matricule :</strong> <span class="ml-2"><?= $rows->eleve_matricule ?></span></p>

                                   <p class="text-muted font-13"><strong>Adresse :</strong> <span class="ml-2"><?= $rows->personne_adresse ?></span></p>

                                   <p class="text-muted font-13"><strong>Niveau :</strong> <span class="ml-2"><?= $rows->scolarite->settings_niveau_name ?></span></p>

                                   <p class="text-muted font-13"><strong class="text-success">Date d'inscription :</strong><span class="ml-2"><?= mysql_to_date($rows->eleve_date_deb) ?></span><?php if($rows->scolarite->settings_scolarite_id != @get_current_scolarite()->settings_scolarite_id): ?><strong class="ml-2 text-danger">Départ : </strong> <span class="ml-2"><?= mysql_to_date($rows->eleve_date_fin) ?><?php endif; ?></p>

                                   </div>

                                   <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Details</button> -->
                                   <div class="col-6 ml-auto mr-auto">
                                        <a href="<?= _url('tuteur/showEleve/'.$rows->eleve_id) ?>" class="btn btn-primary waves-effect waves-light mt-3 form-control"><i class="mdi mdi-account-card-details-outline"> </i> Profil </a>
                                   </div>

                                   <!-- <div class="col-6 ml-auto mr-auto">
                                        <button class="btn btn-primary waves-effect waves-light mt-3" data-toggle="dropdown">Gérer élève <i class="mdi mdi-chevron-down"></i></button>
                                        <div class="dropdown-menu">
                                             <a href="<?php _url($module_base."cropper/".$rows->eleve_id) ?>" class="dropdown-item" target="_blank"><i class="mdi mdi-image"> </i> Photo </a>
                                             <a href="<?= _url($module_base.'showEleve/'.$rows->eleve_id) ?>" class="dropdown-item" target="_blank"><i class="mdi mdi-account-card-details-outline"> </i> Profil </a>
                                             <a href="#custom-detail-modal" class="dropdown-item reset" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showCustom')"><i class="mdi mdi-book-outline"></i> Renseignement </a>
                                             <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal"  onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showEditScolarite')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Scolarite </a>
                                             <div class="dropdown-divider"></div>
                                             <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->personne_id ?>, 'personne_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                        </div>
                                   </div> -->

                              </div>
                         </div>
                    </div>

               <?php endforeach;?>
          <?php endif;?>
     </div>
