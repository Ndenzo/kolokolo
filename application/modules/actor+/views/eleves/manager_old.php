<style media="screen">
.required{
     color: red;
     font-weight: bold;
}
</style>
<div class="row mb-3">
     <div class="col-xl-4">
          <button class="btn btn-success btn-md waves-effect waves-light dropdown-toggle" data-toggle="dropdown">Gestion des élèves<i class="mdi mdi-chevron-down"></i></button>
          <div class="dropdown-menu dropdown-menu">
               <a href="#custom-modal" class="dropdown-item" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-account-plus"> </i> Ajouter nouvel élève </a>
               <a href="<?= _url($module_base.'showReinscription') ?>" class="dropdown-item"><i class="mdi mdi-account-convert"> </i> Réinscrire élève </a>
               <!-- <a href="#custom-modal-reinscription" class="dropdown-item" data-toggle="modal"><i class="mdi mdi-account-convert"> </i> Réinscrire élève </a> -->
               <!-- <a href="#custom-modal-import" class="dropdown-item" data-toggle="modal"><i class="mdi mdi-account-switch"> </i> Importer élève </a> -->
          </div>
     </div>
     <div class="col-xl-8">
          <div class="float-right">
               <form class="app-search">
                    <div class="app-search-box">
                         <div class="input-group">
                              <input type="text" class="form-control" id="search" placeholder="Rechercher ...">
                              <span class="input-group-text">
                                   <i class="fe-search"></i>
                              </span>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</div>
<?php show_notification();?>
<div class="row mt-1">
     <?php if(is_array(@$datagrid)):?>
          <?php foreach(@$datagrid as $rows):?>
               <div class="col-lg-3 col-md-4 col-6 element">
                    <div class="text-center card-box widget-user border border-<?= $rows->eleve_flag_class ?>">

                         <div>
                              <!-- <?php if($rows->personne_photo != null):?>
                                   <div class="rounded avatar-xl mb-4 ml-auto mr-auto lozad" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                              <?php else:?>
                                   <div class="rounded avatar-xl mb-4 ml-auto mr-auto lozad" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?php _url(); ?>assets/custom/img/default/boy.png'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                              <?php endif;?> -->

                              <?php if($rows->personne_photo != null):?>
                                   <img class="rounded avatar-xl mb-4 ml-auto mr-auto lozad" style="box-shadow: 10px 10px 10px;" data-src="<?= _url($rows->personne_photo) ?>"/>
                              <?php else:?>
                                   <img class="rounded avatar-xl mb-4 ml-auto mr-auto lozad" style="box-shadow: 10px 10px 10px;" data-src="<?php _url(); ?>assets/custom/img/default/boy.png"/>
                              <?php endif;?>

                              <p class="text-muted font-13 mb-4 mt-3">
                                   <?= $rows->personne_prenoms." ".$rows->personne_nom ?>
                              </p>

                              <div class="text-left">
                                   <p class="text-muted font-13"><strong>Matricule :</strong> <span class="ml-2"><?= $rows->eleve_matricule ?></span></p>

                                   <p class="text-muted font-13"><strong>Adresse :</strong> <span class="ml-2"><?= $rows->personne_adresse ?></span></p>

                                   <p class="text-muted font-13"><strong>Niveau :</strong> <span class="ml-2"><?= $rows->scolarite->settings_niveau_name ?></span></p>

                                   <p class="text-muted font-13"><strong>Tarification :</strong> <span class="ml-2"><?= $rows->scolarite->tarification_modele_name ?></span></p>

                                   <p class="text-muted font-13"><strong class="text-success">Date d'inscription :</strong><span class="ml-2"><?= mysql_to_date($rows->eleve_date_deb) ?></span><?php if($rows->scolarite->settings_scolarite_id != @get_current_scolarite()->settings_scolarite_id): ?><strong class="ml-2 text-danger">Départ : </strong> <span class="ml-2"><?= mysql_to_date($rows->eleve_date_fin) ?><?php endif; ?></p>
                                   </div>

                                   <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Details</button> -->
                                   <div class="col-6 ml-auto mr-auto">
                                        <button class="btn btn-primary waves-effect waves-light mt-3" data-toggle="dropdown">Gérer élève <i class="mdi mdi-chevron-down"></i></button>
                                        <div class="dropdown-menu">
                                             <a href="<?php _url($module_base."cropper/".$rows->eleve_id) ?>" class="dropdown-item" target="_blank"><i class="mdi mdi-image"> </i> Photo </a>
                                             <a href="<?= _url($module_base.'showEleve/'.$rows->eleve_id) ?>" class="dropdown-item" target="_blank"><i class="mdi mdi-account-card-details-outline"> </i> Profil </a>
                                             <a href="#custom-detail-modal" class="dropdown-item reset" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showCustom')"><i class="mdi mdi-book-outline"></i> Renseignement </a>
                                             <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal"  onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showEditScolarite')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Scolarite </a>
                                             <div class="dropdown-divider"></div>
                                             <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->personne_id ?>, 'personne_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                        </div>
                                   </div>

                              </div>
                         </div>
                    </div>

               <?php endforeach;?>
          <?php endif;?>
     </div>

     <div id="custom-modal" class="modal-demo col-7">
          <button type="button" class="close" onclick="Custombox.modal.close();">
               <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">Ajouter eleve</h4>
          <div class="custom-modal-text text-left">
               <form id="form-tarif" class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" target="_blank" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-12">
                         <div class="card">
                              <div class="card-body">
                                   <div id="progressbarwizard">

                                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-1">
                                             <li class="nav-item">
                                                  <a href="#eleve" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                       <i class="mdi mdi-account-circle mr-1"></i>
                                                       <span class="d-none d-sm-inline">Elève</span>
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a href="#tuteur" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                       <i class="mdi mdi-home-circle mr-1"></i>
                                                       <span class="d-none d-sm-inline">Tuteur</span>
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a href="#scolarite" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                       <i class="mdi mdi-school mr-1"></i>
                                                       <span class="d-none d-sm-inline">Scolarite</span>
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a href="#facturation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                       <i class="mdi mdi-calculator-variant mr-1"></i>
                                                       <span class="d-none d-sm-inline">Facturation</span>
                                                  </a>
                                             </li>
                                        </ul>

                                        <div class="tab-content border-0 mb-0">

                                             <div id="bar" class="progress mb-3" style="height: 7px;">
                                                  <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                             </div>

                                             <div class="tab-pane" id="eleve">
                                                  <div class="row">
                                                       <div class="col-lg-3 ml-auto mr-auto">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                 <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                      <img src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="">
                                                                 </div>
                                                                 <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                 <div>
                                                                      <span class="btn default btn-file">
                                                                           <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                                           <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                                           <input type="file" name="photo" >
                                                                      </span>
                                                                      <a href="javascript:;" class="btn red fileinput-exists" data-bs-dismiss="fileinput"> Remove </a>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-8">
                                                            <div class="row">
                                                                 <div class="form-group mb-3 col-md-6">
                                                                      <label>Civilité <span class="required">*</span> </label>
                                                                      <?php dropDown('SELECT genre_code, genre_libelle FROM settings_genre', array(
                                                                           'id'=>'genre_insc',
                                                                           'name'=>'genre',
                                                                           'class'=>'form-control selectpicker',
                                                                           'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                                                      )); ?>
                                                                 </div>
                                                                 <div class="form-group mb-3 col-md-6">
                                                                      <label>Matricule <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" name="eleve_matricule" value="<?= matricule_generator() ?>" readonly required>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-3 col-md-8">
                                                                      <label>Prénoms <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" placeholder="Prénoms" name="prenoms" required>
                                                                 </div>
                                                                 <div class="form-group mb-3 col-md-4">
                                                                      <label>Nom <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-3 col-md-6">
                                                                      <label>Date de naissance <span class="required">*</span></label>
                                                                      <input type="date" class="form-control mask-date" placeholder="Date de naissance" name="naissance_date" required>
                                                                 </div>
                                                                 <div class="form-group mb-3 col-md-6">
                                                                      <label>Lieu de naissance <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" placeholder="Lieu de naissance" name="naissance_lieu" required>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-3 col-md-6">
                                                                      <label>Origine</label>
                                                                      <input type="text" class="form-control" placeholder="Origine de l'élève" name="eleve_origine">
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="tab-pane" id="tuteur">
                                                  <div class="row">
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Telephone 1 <span class="required">*</span></label>
                                                            <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="telephone_1" id="phone_1" required>
                                                       </div>
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Telephone 2</label>
                                                            <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="telephone_2" id="phone_2">
                                                       </div>
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Prénoms <span class="required">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Prénom du tuteur" name="prenoms_tuteur" required>
                                                       </div>
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Nom <span class="required">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Nom du tuteur" name="nom_tuteur" required>
                                                       </div>
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Email </label>
                                                            <input type="text" class="form-control" placeholder="Email du tuteur" name="email">
                                                       </div>
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Adresse <span class="required">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Adresse du tuteur" name="adresse" required>
                                                       </div>
                                                       <div class="form-group mb-3 col-md-6">
                                                            <label>Ville <span class="required">*</span></label>
                                                            <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                                                 'id'=>'ville_insc',
                                                                 'name'=>'ville',
                                                                 'class'=>'form-control selectpicker',
                                                                 'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required'
                                                            )); ?>
                                                       </div>
                                                  </div> <!-- end row -->
                                             </div>

                                             <div class="tab-pane" id="scolarite">
                                                  <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                 <label>Année scolaire <span class="required">*</span></label>
                                                                 <?php dropDown('SELECT settings_scolarite_id, settings_scolarite_code FROM settings_scolarites order by settings_scolarite_id desc ', array(
                                                                      'id'=>'settings_scolarite_id_form',
                                                                      'name'=>'settings_scolarite_id',
                                                                      'class'=>'form-control selectpicker',
                                                                      'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                                                 )); ?>
                                                            </div>
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
                                                                 <label>Niveau <span class="required">*</span></label>
                                                                 <?php dropChained('SELECT settings_niveau_id, settings_niveau_name, settings_cycle_id FROM settings_niveaux', array(
                                                                      'id'=>'settings_niveau_id',
                                                                      'name'=>'settings_niveau_id',
                                                                      'class'=>'form-control selectpicker',
                                                                      'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                                                 )); ?>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-5 offset-1">

                                                            <div class="row" id="tarification_modeles">

                                                            </div>
                                                       </div>
                                                  </div> <!-- end row -->
                                             </div>

                                             <div class="tab-pane" id="facturation">
                                                  <div class="row">
                                                       <div class="col-md-7">
                                                            <div id="tarification_inscription">
                                                            </div>
                                                       </div>
                                                       <div class="col-md-5" style="margin-top:10%;">

                                                            <div id="montant_total">

                                                            </div>
                                                            <div class="form-group">
                                                                 <label>Réduction </label>
                                                                 <input type="number" class="form-control" placeholder="Montant" name="facture_remise" id="facture_remise" min="0" value="0" required>
                                                            </div>
                                                       </div>
                                                  </div> <!-- end row -->
                                             </div>
                                             <hr>
                                             <ul class="list-inline mb-0 wizard mt-30">
                                                  <li class="previous list-inline-item col-3">
                                                       <a href="javascript: void(0);" class="btn btn-warning form-control" id="toReturn">Précédent</a>
                                                  </li>
                                                  <li class="next list-inline-item float-right col-3">
                                                       <a href="javascript: void(0);" class="btn btn-success form-control" id="toSubmit">Suivant</a>
                                                  </li>
                                             </ul>

                                        </div> <!-- tab-content -->
                                   </div> <!-- end #progressbarwizard-->

                              </div> <!-- end card-body -->
                         </div> <!-- end card-->
                    </div>
               </form>
          </div>
     </div>

     <div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel">Modifier scolarite</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                         <form id="form-modif" class="row justify-content-center" action="<?php _url($module_base.'update_scolarite'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                              <div class="col-10 col-md-12">
                                   <div class="alert alert-warning fade show mb-3">
                                        <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                        <h4>Note !</h4>
                                        <p>Attention, vous êtes sur le point d'appliquer une modification sur la scolarité de l'élève ! Celle-ci aura une incidence sur sa scolarite.</p>
                                   </div>
                                   <div class="form-group mb-3">
                                        <label>Cycle <span class="required">*</span></label>
                                        <?php dropDown('SELECT settings_cycle_id, settings_cycle_name FROM settings_cycles', array(
                                             'id'=>'settings_cycle_id_sco',
                                             'name'=>'settings_cycle_id',
                                             'class'=>'form-control selectpicker',
                                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
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
                                             'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                        )); ?>
                                   </div>
                                   <div class="form-group mb-3">
                                        <label>Tarification <span class="required">*</span></label>
                                        <?php $settings_scolarite_id = get_current_scolarite()->settings_scolarite_id; ?>

                                        <?php dropChained('SELECT tarification_modeles.tarification_modele_id, tarification_modele_name, settings_niveau_id FROM tarification_modeles join tarification_modele_niveaux on tarification_modele_niveaux.tarification_modele_id = tarification_modeles.tarification_modele_id  WHERE settings_scolarite_id = '.$settings_scolarite_id, array(
                                             'id'=>'tarification_modele_id_sco',
                                             'name'=>'tarification_modele_id',
                                             'class'=>'form-control selectpicker',
                                             'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                        )); ?>
                                   </div>
                                   <div class="modal-footer mt-3">
                                        <input type="hidden" class="form-control" name="settings_scolarite_id" id="settings_scolarite_id" required>
                                        <input type="hidden" class="form-control" name="eleves_scolarite_id" id="eleves_scolarite_id" required>
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
     </div>


     <div id="custom-detail-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
               <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel">Fiche de renseignement de l'élève</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                         <form id="form-renseignement" class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                              <div class="col-12">
                                   <div class="card">
                                        <div class="card-body">
                                             <div id="basicwizard">

                                                  <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-1">
                                                       <li class="nav-item">
                                                            <a href="#eleve_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                                 <i class="mdi mdi-account-badge mr-1"></i>
                                                                 <span class="d-none d-sm-inline">Elève</span>
                                                            </a>
                                                       </li>
                                                       <li class="nav-item">
                                                            <a href="#sante_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                                 <i class="mdi mdi-medical-bag mr-1"></i>
                                                                 <span class="d-none d-sm-inline">Santé</span>
                                                            </a>
                                                       </li>
                                                       <li class="nav-item">
                                                            <a href="#tuteur_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                                 <i class="mdi mdi-home-heart mr-1"></i>
                                                                 <span class="d-none d-sm-inline">Famille</span>
                                                            </a>
                                                       </li>
                                                  </ul>

                                                  <div class="tab-content border-0 mb-0">

                                                       <div class="tab-pane" id="eleve_info">
                                                            <div class="row">
                                                                 <div class="col-lg-3 ml-auto mr-auto">
                                                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                           <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                <img src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="" id="photo">
                                                                           </div>
                                                                           <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                           <div>
                                                                                <span class="btn default btn-file">
                                                                                     <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                                                     <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                                                     <input type="file" name="photo" >
                                                                                </span>
                                                                                <a href="javascript:;" class="btn red fileinput-exists" data-bs-dismiss="fileinput"> Remove </a>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-8">

                                                                      <h4 class="modal-title text-info mb-30" >Généralité</h4>

                                                                      <div class="row">
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Civilité <span class="required">*</span> </label>
                                                                                <?php dropDown('SELECT genre_code, genre_libelle FROM settings_genre', array(
                                                                                     'id'=>'genre',
                                                                                     'name'=>'genre',
                                                                                     'class'=>'form-control selectpicker',
                                                                                     'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                                                                )); ?>
                                                                           </div>
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Matricule <span class="required">*</span></label>
                                                                                <input type="text" class="form-control" name="eleve_matricule" id="eleve_matricule" readonly required>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="form-group mb-2 col-md-8">
                                                                                <label>Prénoms <span class="required">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="Prénoms" name="prenoms" id="prenoms" required>
                                                                           </div>
                                                                           <div class="form-group mb-2 col-md-4">
                                                                                <label>Nom <span class="required">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="Nom" name="nom" id="nom" required>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Date de naissance <span class="required">*</span></label>
                                                                                <input type="date" class="form-control" placeholder="Date de naissance" name="naissance_date" id="naissance_date" required>
                                                                           </div>
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Lieu de naissance <span class="required">*</span></label>
                                                                                <input type="text" class="form-control" placeholder="Lieu de naissance" name="naissance_lieu" id="naissance_lieu" required>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Origine</label>
                                                                                <input type="text" class="form-control" placeholder="Origine de l'élève" name="eleve_origine" id="eleve_origine">
                                                                           </div>
                                                                      </div>

                                                                      <hr>

                                                                      <h4 class="modal-title text-info mb-30" >Comportement</h4>

                                                                      <div class="row">
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Individuel </label>
                                                                                <select class="form-control selectpicker" name="renseignement_comp_ind" id="renseignement_comp_ind" title ="-- Choose --"  data-size="7" data-live-search="true">
                                                                                     <option value="Audacieux">Audacieux</option>
                                                                                     <option value="Téméraire">Téméraire</option>
                                                                                     <option value="Nonchalant">Nonchalant</option>
                                                                                     <option value="Hésitant">Hésitant</option>
                                                                                     <option value="Craintif">Craintif</option>
                                                                                </select>
                                                                           </div>
                                                                           <div class="form-group mb-2 col-md-6">
                                                                                <label>Dans le groupe </label>
                                                                                <select class="form-control selectpicker" name="renseignement_comp_group" id="renseignement_comp_group" title ="-- Choose --"  data-size="7" data-live-search="true">
                                                                                     <option value="Effacement">Effacement</option>
                                                                                     <option value="Initiative">Initiative</option>
                                                                                     <option value="Responsablilité">Responsablilité</option>
                                                                                     <option value="Emulation">Emulation</option>
                                                                                     <option value="Esprit d'équipe">Esprit d'équipe</option>
                                                                                </select>
                                                                           </div>
                                                                      </div>

                                                                 </div>
                                                            </div>
                                                       </div>

                                                       <div class="tab-pane" id="sante_info">
                                                            <div class="row">
                                                                 <h4 class="modal-title text-info mb-30" >Etat de santé</h4>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-2 col-12">
                                                                      <label>Maladie traitées </label>
                                                                      <input type="text" class="form-control" name="renseignement_maladie" id="renseignement_maladie">
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Acuité auditive </label>
                                                                      <input type="text" class="form-control" name="renseignement_acuite_auditive" id="renseignement_acuite_auditive">
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Acuité visuelle </label>
                                                                      <input type="text" class="form-control" name="renseignement_acuite_visuelle" id="renseignement_acuite_visuelle">
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <h4 class="modal-title text-info mb-30" >Répercussions de l'état de santé</h4>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-2 col-12">
                                                                      <label>Avis général </label>
                                                                      <select class="form-control selectpicker" name="renseignement_repercussion" id="renseignement_repercussion" title="-- Choose --"  data-size="7" data-live-search="true">
                                                                           <option value="false">Pas de répercussion</option>
                                                                           <option value="true">Répercussion probable</option>
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="form-group mb-2 col-4">
                                                                      <label>Répercussion certaine </label>
                                                                      <select class="form-control selectpicker" name="renseignement_repercussion_certaine" id="renseignement_repercussion_certaine" title="-- Choose --"  data-size="7" data-live-search="true">
                                                                           <option value="Légère">Légère</option>
                                                                           <option value="Importante">Importante</option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-4">
                                                                      <label>Avec interruption de la scolarité </label>
                                                                      <select class="form-control selectpicker" name="renseignement_interruption" id="renseignement_interruption" title="-- Choose --"  data-size="7" data-live-search="true">
                                                                           <option value="Courte">Courte</option>
                                                                           <option value="Prolongée">Prolongée</option>
                                                                           <option value="Répétée">Répétée</option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-4">
                                                                      <label>Niveau général de valeur physique </label>
                                                                      <select class="form-control selectpicker" name="renseignement_physique" id="renseignement_physique" title="-- Choose --"  data-size="7" data-live-search="true">
                                                                           <option value="Très bon">Très bon</option>
                                                                           <option value="Bon">Bon</option>
                                                                           <option value="Assez bon">Assez bon</option>
                                                                           <option value="Passable">Passable</option>
                                                                           <option value="Faible">Faible</option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-4">
                                                                      <label>Régulatité dans l'effort</label>
                                                                      <select class="form-control selectpicker" name="renseignement_effort" id="renseignement_effort" title="-- Choose --"  data-size="7" data-live-search="true">
                                                                           <option value="Bonne">Bonne</option>
                                                                           <option value="Moyenne">Moyenne</option>
                                                                           <option value="Difficile">Difficile</option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-4">
                                                                      <label>Motricité </label>
                                                                      <select class="form-control selectpicker" name="renseignement_motricite" id="renseignement_motricite" title="-- Choose --"  data-size="7" data-live-search="true">
                                                                           <option value="Rapide">Rapide</option>
                                                                           <option value="Moyenne">Moyenne</option>
                                                                           <option value="Lente">Lente</option>
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>

                                                       <div class="tab-pane" id="tuteur_info">

                                                            <div class="row">
                                                                 <h4 class="modal-title text-info mb-30" >Renseignement parents</h4>
                                                            </div>

                                                            <div class="row">
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Prénoms du père </label>
                                                                      <input type="text" class="form-control" placeholder="Prénom du père" name="renseignement_prenoms_pere" id="renseignement_prenoms_pere">
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Nom du père </label>
                                                                      <input type="text" class="form-control" placeholder="Nom du père" name="renseignement_nom_pere" id="renseignement_nom_pere">
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Prénoms de la mère </label>
                                                                      <input type="text" class="form-control" placeholder="Prénom de la mère" name="renseignement_prenoms_mere" id="renseignement_prenoms_mere">
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Nom de la mère </label>
                                                                      <input type="text" class="form-control" placeholder="Nom de la mère" name="renseignement_nom_mere" id="renseignement_nom_mere">
                                                                 </div>
                                                            </div>

                                                            <div class="row">
                                                                 <h4 class="modal-title text-info mb-30" >Renseignement tuteur(trice)</h4>
                                                            </div>

                                                            <div class="row">
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Prénoms du tuteur(trice) <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" placeholder="Prénom du tuteur" name="prenoms_tuteur" id="prenoms_tuteur" required>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Nom du tuteur(trice) <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" placeholder="Nom du tuteur" name="nom_tuteur" id="nom_tuteur" required>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Telephone 1 <span class="required">*</span></label>
                                                                      <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="telephone_1" id="telephone_1" required>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Telephone 2 </label>
                                                                      <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="telephone_2" id="telephone_2">
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Email </label>
                                                                      <input type="text" class="form-control" placeholder="Email du tuteur" name="email" id="email">
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Adresse <span class="required">*</span></label>
                                                                      <input type="text" class="form-control" placeholder="Adresse du tuteur" name="adresse" id="adresse" required>
                                                                 </div>
                                                                 <div class="form-group mb-2 col-md-6">
                                                                      <label>Ville <span class="required">*</span></label>
                                                                      <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                                                           'id'=>'ville',
                                                                           'name'=>'ville',
                                                                           'class'=>'form-control selectpicker',
                                                                           'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required'
                                                                      )); ?>
                                                                 </div>
                                                            </div> <!-- end row -->
                                                       </div>

                                                       <input type="hidden" name="eleve_id" id="eleve_id">
                                                       <input type="hidden" name="eleve_personne_id" id="eleve_personne_id">
                                                       <input type="hidden" name="tuteur_personne_id" id="tuteur_personne_id">
                                                       <hr>
                                                       <ul class="list-inline mb-0 wizard mt-30">

                                                            <li class="previous list-inline-item col-3">
                                                                 <a href="javascript: void(0);" class="btn btn-warning form-control" id="toReturn_info">Précédent</a>
                                                            </li>
                                                            <li class="next list-inline-item float-right col-3">
                                                                 <a href="javascript: void(0);" class="btn btn-success form-control" id="toSubmit_info">Suivant</a>
                                                            </li>
                                                       </ul>

                                                  </div> <!-- tab-content -->
                                             </div> <!-- end #progressbarwizard-->

                                        </div> <!-- end card-body -->
                                   </div> <!-- end card-->
                              </div>
                         </form>
                    </div>
               </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
     </div>

     <div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel">Supprimer eleve</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                         <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 mt-50">
                                   <p style="text-align: center; font-size: 14px;">
                                        Le eleve sélectionner va être supprimer de manière permanante. <br>
                                        Voulez-vous continuer cette opérations ?
                                   </p>
                                   <hr>
                                   <div class="modal-footer mt-3">
                                        <input type="hidden" type="text" name="personne_id" value="<?=@$personne_id?>">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
     </div>
