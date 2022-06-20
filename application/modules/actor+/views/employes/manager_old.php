<style media="screen">
.required{
     color: red;
     font-weight: bold;
}
</style>
<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter employe</a>
     </div><!-- end col -->
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
               <div class="col-xl-3 element">
                    <div class="text-center card">
                         <div class="dropdown float-right">
                              <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                   <i class="mdi mdi-dots-vertical"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                   <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->personne_id ?>, 'actor/employe/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                   <div class="dropdown-divider"></div>
                                   <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->personne_id ?>, 'personne_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                              </div>
                         </div>
                         <div>
                              <?php if($rows->personne_photo != null):?>
                                   <div class="rounded avatar-xl mb-4 ml-auto mr-auto" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                   <!-- <img src="<?= _url($rows->personne_photo) ?>" class="rounded avatar-xl img-thumbnail mb-2" alt="profile-image"> -->
                              <?php else:?>
                                   <img src="<?php _url(); ?>assets/custom/img/default/boy.png" class="rounded avatar-xl img-thumbnail mb-2" alt="profile-image" style="height: 120px; width: 120px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                              <?php endif;?>

                              <p class="text-muted font-13 mb-4 mt-3">
                                   <?= $rows->personne_prenoms." ".$rows->personne_nom ?>
                              </p>

                              <div class="text-left">
                                   <p class="text-muted font-13"><strong>Téléphone :</strong> <span class="ml-2"><?= $rows->personne_telephone_1 ?></span></p>

                                   <p class="text-muted font-13"><strong>Adresse :</strong> <span class="ml-2"><?= $rows->personne_adresse ?></span></p>

                                   <p class="text-muted font-13"><strong>Fonction :</strong> <span class="ml-2"><?= $rows->settings_fonction_name ?></span></p>

                                   <p class="text-muted font-13"><strong>Début de service :</strong> <span class="ml-2"><?= mysql_to_date($rows->employe_date_deb) ?></span></p>
                              </div>

                              <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Details</button>
                         </div>
                    </div>
               </div>

          <?php endforeach;?>
     <?php endif;?>
</div>

<div id="custom-modal" class="modal-demo col-md-8">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter employe</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
               <div class="col-md-12">
                    <div class="row">
                         <div class="col-md-4">
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
                                        <label>Civilité <span class="required">*</span></label>
                                        <?php dropDown('SELECT settings_genre_code, settings_genre_name FROM settings_genres', array(
                                             'id'=>'genre',
                                             'name'=>'genre',
                                             'class'=>'form-control selectpicker',
                                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                        )); ?>
                                   </div>
                                   <div class="form-group mb-3 col-md-6">
                                        <label>Fonction <span class="required">*</span></label>
                                        <?php dropDown('SELECT settings_fonction_id, settings_fonction_name FROM settings_fonctions', array(
                                             'id'=>'settings_fonction_id',
                                             'name'=>'settings_fonction_id',
                                             'class'=>'form-control selectpicker',
                                             'attr'=>'title ="-- Choose --"  data-size="3" data-live-search="true" required selected'
                                        )); ?>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="form-group mb-3 col-md-8">
                                        <label>Prénom <span class="required">*</span></label>
                                        <input type="text" class="form-control" placeholder="Prénom de l'employé" name="prenoms" required>
                                   </div>
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Nom <span class="required">*</span></label>
                                        <input type="text" class="form-control" placeholder="Nom de l'employé" name="nom" required>
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
                         </div>
                    </div>
               </div>
               <div class="col-md-12">
                    <div class="row">
                         <div class="form-group mb-3 col-md-8">
                              <label>Adresse <span class="required">*</span></label>
                              <input type="text" class="form-control" placeholder="Adresse de l'employé" name="adresse" required>
                         </div>
                         <div class="form-group mb-3 col-md-4">
                              <label>Ville <span class="required">*</span></label>
                              <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                   'id'=>'ville',
                                   'name'=>'personne_ville',
                                   'class'=>'form-control selectpicker',
                                   'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                              )); ?>
                         </div>
                    </div>

                    <div class="row">
                         <div class="form-group mb-3 col-md-4">
                              <label>Date de service <span class="required">*</span></label>
                              <input type="date" class="form-control mask-date" placeholder="Date de prise de service" name="employe_date_deb" required>
                         </div>
                         <div class="form-group mb-3 col-md-4">
                              <label>Telephone 1 <span class="required">*</span></label>
                              <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="telephone_1" required>
                         </div>
                         <div class="form-group mb-3 col-md-4">
                              <label>Telephone 2</label>
                              <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="telephone_2">
                         </div>
                    </div>

                    <div class="form-group mb-3">
                         <label>Description</label>
                         <textarea class="form-control" placeholder="Description" name="employe_desc" rows="3" cols="80"></textarea>
                    </div>
                    <hr>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>

               </div>
          </form>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" employe="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier employe</h4>
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
                                                       <input type="file" name="photo" >
                                                  </span>
                                                  <a href="javascript:;" class="btn red fileinput-exists" data-bs-dismiss="fileinput"> Remove </a>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="row">
                                             <div class="form-group mb-3 col-md-6">
                                                  <label>Civilité</label>
                                                  <?php dropDown('SELECT settings_genre_code, settings_genre_name FROM settings_genres', array(
                                                       'id'=>'genre',
                                                       'name'=>'genre',
                                                       'class'=>'form-control selectpicker',
                                                       'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                                  )); ?>
                                             </div>
                                             <div class="form-group mb-3 col-md-6">
                                                  <label>Fonction</label>
                                                  <?php dropDown('SELECT settings_fonction_id, settings_fonction_name FROM settings_fonctions', array(
                                                       'id'=>'settings_fonction_id',
                                                       'name'=>'settings_fonction_id',
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
                                             'class'=>'form-control select2-allow-clear',
                                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                        )); ?>
                                   </div>
                              </div>

                              <div class="row">
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Date de service</label>
                                        <input type="date" class="form-control" placeholder="Date de prise de service" name="employe_date_deb" id="employe_date_deb" required>
                                   </div>
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Telephone 1</label>
                                        <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="telephone_1" id="telephone_1" required>
                                   </div>
                                   <div class="form-group mb-3 col-md-4">
                                        <label>Telephone 2</label>
                                        <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="telephone_2" id="telephone_2">
                                   </div>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="employe_desc" id="employe_desc" rows="3" cols="80"></textarea>
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


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" employe="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer employe</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   Le employe sélectionner va être supprimer de manière permanante. <br>
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
