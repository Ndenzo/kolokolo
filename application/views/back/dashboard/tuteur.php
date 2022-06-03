<div class="row">

     <?php show_notification();?>
     <?php if(is_array(@$tuteur->eleves)):?>
          <?php foreach(@$tuteur->eleves as $eleve):?>
               <div class="col-lg-4 col-md-4 col-6 element">
                    <div class="ribbon-wrapper card">
                         <div class="card-body">
                              <div class="ribbon ribbon-clip-right ribbon-right ribbon-info">Elève</div>

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
                              <div class="col-6 ml-auto mr-auto">
                                   <a href="<?= _url('tuteur/showEleve/'.$eleve->eleve_id) ?>" class="btn btn-primary mt-3 form-control"><i class="mdi mdi-account-card-details-outline"> </i> Consulter </a>
                              </div>
                         </div>
                    </div>

               </div>
          <?php endforeach;?>
     <?php endif;?>
</div>
