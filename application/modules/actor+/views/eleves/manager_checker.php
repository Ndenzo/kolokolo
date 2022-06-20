<style media="screen">
     .required{
          color: red;
          font-weight: bold;
     }
</style>
<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter élève</a>
     </div><!-- end col -->
</div>
<?php show_notification();?>
<div class="row mt-1">
     <?php if(is_array(@$datagrid)):?>
          <?php foreach(@$datagrid as $rows):?>
               <div class="col-lg-3">
                    <div class="text-center card">
                         <div class="dropdown float-right">
                              <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                   <i class="mdi mdi-dots-vertical"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                   <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->personne_id ?>, 'actor/eleve/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                   <!-- <div class="dropdown-divider"></div>
                                   <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->personne_id ?>, 'personne_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a> -->
                              </div>
                         </div>
                         <div>
                              <?php if($rows->personne_photo != null):?>
                                   <div class="rounded avatar-xl mb-4 ml-auto mr-auto" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                   <!-- <img src="<?= _url($rows->personne_photo) ?>" class="rounded avatar-xl img-thumbnail mb-2" alt="profile-image"> -->
                              <?php else:?>
                                   <img  class="rounded avatar-xl img-thumbnail mb-2" alt="profile-image">
                              <?php endif;?>

                              <p class="text-muted font-13 mb-4 mt-3">
                                   <?= $rows->personne_prenoms." ".$rows->personne_nom ?>
                              </p>

                              <div class="text-left">
                                   <p class="text-muted font-13"><strong>Matricule :</strong> <span class="ml-2"><?= $rows->eleve_matricule ?></span></p>

                                   <p class="text-muted font-13"><strong>Adresse :</strong> <span class="ml-2"><?= $rows->personne_adresse ?></span></p>

                                   <p class="text-muted font-13"><strong>niveau :</strong> <span class="ml-2"><?= $rows->settings_niveau_name ?></span></p>

                                   <p class="text-muted font-13"><strong>Date d'inscription :</strong> <span class="ml-2"><?= mysql_to_date($rows->eleve_date_deb) ?></span></p>
                              </div>

                              <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Details</button>
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
                                                                      'id'=>'genre',
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
                                                       <label>Email <span class="required">*</span></label>
                                                       <input type="text" class="form-control" placeholder="Email du tuteur" name="email" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-md-6">
                                                       <label>Adresse <span class="required">*</span></label>
                                                       <input type="text" class="form-control" placeholder="Adresse du tuteur" name="adresse" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-md-6">
                                                       <label>Ville</label>
                                                       <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                                            'id'=>'ville',
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
                                                            <?php dropDown('SELECT settings_scolarite_id, settings_scolarite_code FROM settings_scolarites', array(
                                                                 'id'=>'settings_scolarite_id',
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
                                                                 'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required'
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
                                                       <div id="accordion">

                                                            <?php if(is_array(@$tarifications)):?>
                                                                 <?php foreach(@$tarifications as $tarification):?>
                                                                      <div class="card mb-0">
                                                                           <div class="card-title mb-5" id="heading<?= $tarification->tarification_id ?>">
                                                                                <a href="#collapse<?= $tarification->tarification_id ?>" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapse<?= $tarification->tarification_id ?>">
                                                                                     <h5 class="m-0">
                                                                                          <div class="row">
                                                                                               <div class="text-left col-8">
                                                                                                    <?= $tarification->tarification_name ?>
                                                                                               </div>
                                                                                               <div class="text-right col-4">
                                                                                                    <input type="checkbox" id="tarif_<?= $tarification->tarification_id ?>" data-plugin="switchery" data-color="#00b19d"/>
                                                                                               </div>
                                                                                          </div>
                                                                                     </h5>
                                                                                </a>
                                                                           </div>

                                                                           <div id="collapse<?= $tarification->tarification_id ?>" class="collapse" aria-labelledby="heading<?= $tarification->tarification_id ?>" data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                     <div class="row">
                                                                                          <div class="col-12">
                                                                                               <div id="tarification_<?= $tarification->tarification_id ?>">
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
                                                  <div class="col-md-5" style="margin-top:10%;">
                                                       <div id="montant_total">

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

               </form>
          </div>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true" style="border: 50px solid ">
     <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier eleve</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-md-12">
                              <div class="row">
                                   <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                             <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                  <img src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="" id="photo">
                                             </div>
                                             <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                             <div>
                                                  <span class="btn default btn-file">
                                                       <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                       <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                       <input type="file" name="photo">
                                                  </span>
                                                  <a href="javascript:;" class="btn red fileinput-exists" data-bs-dismiss="fileinput"> Remove </a>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="row">
                                             <div class="form-group mb-3 col-md-6">
                                                  <label>Civilité</label>
                                                  <?php dropDown('SELECT genre_code, genre_libelle FROM settings_genre', array(
                                                       'id'=>'genre',
                                                       'name'=>'genre',
                                                       'class'=>'form-control selectpicker',
                                                       'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                                  )); ?>
                                             </div>

                                        </div>
                                        <div class="row">
                                             <div class="form-group mb-3 col-md-8">
                                                  <label>Prénom</label>
                                                  <input type="text" class="form-control" placeholder="Prénom de l'employé" name="prenoms" id="prenoms" required>
                                             </div>
                                             <div class="form-group mb-3 col-md-4">
                                                  <label>Nom</label>
                                                  <input type="text" class="form-control" placeholder="Nom de l'employé" name="nom" id="nom" required>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="form-group mb-3 col-md-6">
                                                  <label>Date de naissance</label>
                                                  <input type="date" class="form-control" placeholder="Date de naissance" name="naissance_date" id="naissance_date" required>
                                             </div>
                                             <div class="form-group mb-3 col-md-6">
                                                  <label>Lieu de naissance</label>
                                                  <input type="text" class="form-control" placeholder="Lieu de naissance" name="naissance_lieu" id="naissance_lieu" required>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="row">
                                   <div class="form-group mb-3 col-md-8">
                                        <label>Adresse</label>
                                        <input type="text" class="form-control" placeholder="Adresse de l'employé" name="adresse" id="adresse" required>
                                   </div>
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Ville</label>
                                        <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                             'id'=>'ville',
                                             'name'=>'ville',
                                             'class'=>'form-control selectpicker',
                                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                        )); ?>
                                   </div>
                              </div>

                              <div class="row">
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Date d'entrer</label>
                                        <input type="date" class="form-control" placeholder="Date de prise de service" name="eleve_date_deb" id="eleve_date_deb" required>
                                   </div>
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Telephone 1</label>
                                        <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="telephone_1" id="telephone_1" required>
                                   </div>
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Telephone 2</label>
                                        <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="telephone_2" id="telephone_2" required>
                                   </div>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="eleve_desc" id="eleve_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" name="personne_id" id="personne_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
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
