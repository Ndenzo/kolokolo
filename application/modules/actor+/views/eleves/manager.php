<div class="col-md-12 project-list">
     <div class="card">
          <div class="row">
               <div class="col-12 dropdown-basic">
                    <div class="form-group mb-0 me-0"></div>
                    <div class="dropdown f-right">
                         <button class="dropbtn btn btn-success" type="button">
                              Gestion des élèves <span><i class="icofont icofont-settings-alt" style="margin-left: 20px;"></i></span>
                         </button>
                         <div class="dropdown-content" style="margin-top: -10px;">
                              <a href="#custom-modal" class="dropdown-item" data-toggle="modal"><i class="fa fa-save"></i> Inscrire Elève </a>
                              <a href="<?= _url($module_base.'showReinscription') ?>" class="dropdown-item"><i class="fa fa-repeat"> </i> Réinscrire Elève </a>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-sm-12">
          <div class="card">
               <div class="card-title mb-5">
                    <h5>Gestion des élèves </h5><span></span>
               </div>
               <div class="card-body">
                    <?php show_notification();?>
                    <div class="row">
                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                             <div class="media-body"><span class="m-0">Total</span>
                                                  <h4 class="mb-0 counter"><?= count(@$datagrid) ?></h4><i class="icon-bg" data-feather="archive"></i>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-secondary b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="repeat"></i></div>
                                             <div class="media-body"><span class="m-0">Réinscrit</span>
                                                  <h4 class="mb-0 counter"><?= @thousand(get_eleves_sum_old($_SESSION['dashboard']['settings_scolarite_id'], $_SESSION['dashboard']['settings_scolarite_id']-1)) ?></h4><i class="icon-bg" data-feather="repeat"></i>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-success b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="check"></i></div>
                                             <div class="media-body"><span class="m-0">Inscrit</span>
                                                  <h4 class="mb-0 counter"><?= @thousand(get_eleves_sum($_SESSION['dashboard']['settings_scolarite_id'])->eleve_total) ?></h4><i class="icon-bg" data-feather="check"></i>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-danger b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="x"></i></div>
                                             <div class="media-body"><span class="m-0">Départ</span>
                                                  <h4 class="mb-0 counter"><?= @thousand(count(@$datagrid) - get_eleves_sum($_SESSION['dashboard']['settings_scolarite_id'])->eleve_total) ?></h4><i class="icon-bg" data-feather="x"></i>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="table-responsive product-table mt-50" style="overflow: hidden;">
                         <table class="display" id="basic-2">
                              <thead>
                                   <tr>
                                        <th>Image</th>
                                        <th>Identification</th>
                                        <th>Adresse</th>
                                        <th>Niveau</th>
                                        <th>Statut</th>
                                        <th style="width: 100px;">Arrivé</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $rows):?>
                                             <tr>
                                                  <td>
                                                       <?php if($rows->personne_photo != null):?>
                                                            <img class="rounded ml-auto mr-auto lozad shadow shadow-showcase" style="width: 70px;" data-src="<?= _url($rows->personne_photo) ?>"/>
                                                       <?php else:?>
                                                            <img class="rounded ml-auto mr-auto lozad shadow shadow-showcase" style="width: 70px;" data-src="<?php _url(); ?>assets/custom/img/default/boy.png"/>
                                                       <?php endif;?>
                                                  </td>
                                                  <td>
                                                       <h6 class="text-left"> <?= $rows->eleve_matricule ?> </h6><span><?= $rows->personne_prenoms." ".$rows->personne_nom ?></span>
                                                  </td>
                                                  <td><?= $rows->personne_adresse ?></td>
                                                  <td><?= $rows->scolarite->settings_niveau_name ?></td>
                                                  <td><div class="span badge rounded-pill pill-badge-<?= $rows->eleve_flag_class ?> form-control"><?= $rows->eleve_flag_label ?></div></td>
                                                  <td><?= mysql_to_date($rows->eleve_date_deb) ?></td>
                                                  <td style="width: 100px;">
                                                       <div class="text-end text-center" style="width: 90px!important;">
                                                            <div class="dropdown">
                                                                 <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                 <div class="dropdown-menu dropdown-menu-end">
                                                                      <a href="<?= _url($module_base.'showEleve/'.$rows->eleve_id) ?>" class="dropdown-item" target="_blank"><i class="fa fa-user"></i> Profile</a>
                                                                      <a href="<?php _url($module_base."cropper/".$rows->eleve_id) ?>" class="dropdown-item" target="_blank"><i class="fa fa-camera"></i> Photos</a>
                                                                      <a href="#custom-scolarite-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showEditScolarite')"><i class="fa fa-eye"></i> Scolarite</a>
                                                                      <div class="dropdown-divider"></div>
                                                                      <?php if ($rows->scolarite->reduction == null): ?>
                                                                           <a href="#custom-reduction-modal" class="dropdown-item font-primary" data-toggle="modal" onclick="define_delete(<?= $rows->scolarite->eleves_scolarite_id ?>, 'eleves_scolarite_id')"><i class="icofont icofont-sale-discount"></i> Réduction</a>
                                                                      <?php else: ?>
                                                                           <a href="#custom-show-reduction-modal-<?=@$rows->eleve_id?>" class="dropdown-item font-secondary" data-toggle="modal"><i class="icofont icofont-sale-discount"></i> Réduction</a>
                                                                      <?php endif; ?>
                                                                      <div class="dropdown-divider"></div>
                                                                      <a href="#custom-update-modal" class="dropdown-item text-warning" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showCustom')"><i class="fa fa-pencil"></i> Modifier</a>
                                                                      <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $rows->personne_id ?>, 'personne_id')"><i class="fa fa-trash"></i> Supprimer</a>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </td>
                                             </tr>

                                             <?php if ($rows->scolarite->reduction != null): ?>
                                                  <div id="custom-show-reduction-modal-<?=@$rows->eleve_id?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                                                                <h2 class="text-danger"> <?= thousand($rows->scolarite->reduction->eleves_reduction_value)  ?> </h2>

                                                                                <div class="modal-footer mt-3">
                                                                                     <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                     <a href="#custom-delete-reduction-modal" class="btn btn-danger col-md-4"  data-toggle="modal" onclick="define_delete(<?= $rows->scolarite->reduction->eleves_reduction_id ?>, 'eleves_reduction_id')"><i class="dropdown-icon mdi mdi-cash-refund"></i> Supprimer </a>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             <?php endif; ?>
                                        <?php endforeach;?>
                                   <?php endif;?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>


<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-xl">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title">Ajouter eleve</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="col-12 mt-30">
                         <div class="stepwizard">
                              <div class="stepwizard-row setup-panel">
                                   <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1"><i class="fa fa-user"></i></a>
                                        <p>Elève</p>
                                   </div>
                                   <div class="stepwizard-step"><a class="btn btn-light" href="#step-2"><i class="fa fa-home"></i></a>
                                        <p>Tuteur</p>
                                   </div>
                                   <div class="stepwizard-step"><a class="btn btn-light" href="#step-3"><i class="fa fa-graduation-cap"></i></a>
                                        <p>Scolarité</p>
                                   </div>
                                   <div class="stepwizard-step"><a class="btn btn-light" href="#step-4"><i class="fa fa-calculator"></i></a>
                                        <p>Facturation</p>
                                   </div>
                              </div>
                         </div>
                         <form id="form-tarif" class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" target="_blank" enctype="multipart/form-data" autocomplete="off">
                              <div class="setup-content col-12" id="step-1">
                                   <div class="row">
                                        <div class="col-md-4 ml-auto mr-auto">
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
                                                       <a href="javascript:;" class="btn red fileinput-exists" data-bs-dismiss="fileinput"> Supprimer </a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="row">
                                                  <div class="form-group mb-3 col-md-6">
                                                       <label>Civilité <span class="required">*</span> </label>
                                                       <?php dropDown('SELECT settings_genre_code, settings_genre_name FROM settings_genres', array(
                                                            'id'=>'genre_insc',
                                                            'name'=>'personne_genre',
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
                                                       <input type="text" class="form-control" placeholder="Prénoms" name="personne_prenoms" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-md-4">
                                                       <label>Nom <span class="required">*</span></label>
                                                       <input type="text" class="form-control" placeholder="Nom" name="personne_nom" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-md-6">
                                                       <label>Date de naissance <span class="required">*</span></label>
                                                       <input type="date" class="form-control mask-date" placeholder="Date de naissance" name="personne_naissance_date" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-md-6">
                                                       <label>Lieu de naissance <span class="required">*</span></label>
                                                       <input type="text" class="form-control" placeholder="Lieu de naissance" name="personne_naissance_lieu" required>
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
                                   <hr>
                                   <div class="col-12 mt-20">
                                        <button class="btn btn-primary nextBtn col-2 pull-right" type="button">Suivant</button>
                                   </div>
                              </div>
                              <div class="setup-content col-12" id="step-2">
                                   <div class="row">
                                        <div class="form-group mb-3 col-md-6">
                                             <label>Telephone 1 <span class="required">*</span></label>
                                             <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="personne_telephone_1" id="phone_1" required>
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                             <label>Telephone 2</label>
                                             <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="personne_telephone_2" id="phone_2">
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
                                             <input type="text" class="form-control" placeholder="Adresse du tuteur" name="personne_adresse" required>
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                             <label>Ville <span class="required">*</span></label>
                                             <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                                  'id'=>'ville_insc',
                                                  'name'=>'personne_ville',
                                                  'class'=>'form-control selectpicker',
                                                  'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required'
                                             )); ?>
                                        </div>
                                   </div> <!-- end row -->
                                   <hr>
                                   <div class="col-12 mt-20">
                                        <button class="btn btn-primary nextBtn col-2 pull-right" type="button">Suivant</button>
                                   </div>
                              </div>
                              <div class="setup-content col-12" id="step-3">
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
                                   <hr>
                                   <div class="col-12 mt-20">
                                        <button class="btn btn-primary nextBtn col-2 pull-right disabled" type="button" id="customhide">Suivant</button>
                                   </div>
                              </div>
                              <div class="setup-content col-12" id="step-4">
                                   <div class="row">
                                        <div class="col-md-6" style="margin-bottom: 30px;">
                                             <div id="tarification_inscription"></div>
                                        </div>
                                        <div class="col-md-4 offset-md-2 ml-auto" style="margin-top:8%;">
                                             <div id="montant_total"></div>
                                             <div class="form-group mb-20">
                                                  <label>Réduction </label>
                                                  <input type="number" class="form-control" placeholder="Montant" name="facture_remise" id="facture_remise" min="0" value="0" required>
                                             </div>
                                        </div>
                                        <hr>
                                        <div class="col-12 mt-20">
                                             <button class="btn btn-success col-2 pull-right" type="submit" onclick="setTimeout(function(){ window.location.reload(); }, 5000)">Terminer !</button>
                                        </div>
                                   </div> <!-- end row -->
                              </div>
                         </form>
                    </div>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-xl">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title">Fiche de renseignement de l'élève</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="f1">
                         <div class="f1-steps">
                              <div class="f1-progress">
                                   <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                              </div>
                              <div class="f1-step active">
                                   <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                                   <p>Elève</p>
                              </div>
                              <div class="f1-step">
                                   <div class="f1-step-icon"><i class="fa fa-stethoscope"></i></div>
                                   <p>Santé</p>
                              </div>
                              <div class="f1-step">
                                   <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                                   <p>Famille</p>
                              </div>
                         </div>

                         <form id="form-renseignement" class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                              <fieldset>
                                   <div class="row">
                                        <div class="col-lg-3 ml-auto mr-auto">
                                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                       <img src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="" id="personne_photo">
                                                  </div>
                                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                  <div>
                                                       <span class="btn default btn-file">
                                                            <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                            <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                            <input type="file" name="photo" >
                                                       </span>
                                                       <a href="javascript:;" class="btn red fileinput-exists" data-bs-dismiss="fileinput"> Supprimer </a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-8">

                                             <h4 class="modal-title text-info mb-30" >Généralité</h4>

                                             <div class="row">
                                                  <div class="form-group mb-2 col-md-6">
                                                       <label>Civilité <span class="required">*</span> </label>
                                                       <?php dropDown('SELECT settings_genre_code, settings_genre_name FROM settings_genres', array(
                                                            'id'=>'personne_genre',
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
                                                       <input type="text" class="form-control" placeholder="Prénoms" name="personne_prenoms" id="personne_prenoms" required>
                                                  </div>
                                                  <div class="form-group mb-2 col-md-4">
                                                       <label>Nom <span class="required">*</span></label>
                                                       <input type="text" class="form-control" placeholder="Nom" name="personne_nom" id="personne_nom" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-2 col-md-6">
                                                       <label>Date de naissance <span class="required">*</span></label>
                                                       <input type="date" class="form-control" placeholder="Date de naissance" name="personne_naissance_date" id="personne_naissance_date" required>
                                                  </div>
                                                  <div class="form-group mb-2 col-md-6">
                                                       <label>Lieu de naissance <span class="required">*</span></label>
                                                       <input type="text" class="form-control" placeholder="Lieu de naissance" name="personne_naissance_lieu" id="personne_naissance_lieu" required>
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
                                   <hr>
                                   <div class="f1-buttons col-12 mt-20">
                                        <button class="btn btn-primary btn-next" type="button">Suivant</button>
                                   </div>
                              </fieldset>

                              <fieldset>
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
                                   <hr>
                                   <div class="f1-buttons col-12 mt-20">
                                        <button class="btn btn-primary btn-previous" type="button">Précédent</button>
                                        <button class="btn btn-primary btn-next" type="button">Suivant</button>
                                   </div>
                              </fieldset>

                              <fieldset>
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
                                             <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 1" name="personne_telephone_1" id="personne_telephone_1" required>
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                             <label>Telephone 2 </label>
                                             <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Contact 2" name="personne_telephone_2" id="personne_telephone_2">
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                             <label>Email </label>
                                             <input type="text" class="form-control" placeholder="Email du tuteur" name="email" id="email">
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                             <label>Adresse <span class="required">*</span></label>
                                             <input type="text" class="form-control" placeholder="Adresse du tuteur" name="adresse" id="personne_adresse" required>
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                             <label>Ville <span class="required">*</span></label>
                                             <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                                  'id'=>'personne_ville',
                                                  'name'=>'ville',
                                                  'class'=>'form-control selectpicker',
                                                  'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required'
                                             )); ?>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="f1-buttons col-12 mt-20">
                                        <input type="hidden" name="eleve_id" id="eleve_id">
                                        <input type="hidden" name="eleve_personne_id" id="eleve_personne_id">
                                        <input type="hidden" name="tuteur_personne_id" id="tuteur_personne_id">
                                        <button class="btn btn-primary btn-previous" type="button">Précédent</button>
                                        <button class="btn btn-primary btn-submit" type="submit">Valider</button>
                                   </div>
                              </fieldset>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>

<div id="custom-scolarite-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier scolarite</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="form-modif" class="row justify-content-center" action="<?php _url($module_base.'init_scolarite'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                         <div class="col-10 col-md-12">
                              <div class="alert alert-secondary fade show mb-3">
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

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer eleve</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-20">
                              <p style="text-align: center; font-size: 14px;">
                                   Le eleve sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidde" type="text" name="personne_id" id="personne_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-reduction-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Réduction élève</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base."insert_reduction"); ?>" method="post">
                         <div class="col-10 col-md-12">

                              <div class="alert alert-danger fade show mb-3">
                                   <h4>Note !</h4>
                                   <p>Attention, vous êtes sur le point d'appliquer une réduction mensuelle pour cet élève. La somme renseignée sera déduite du montant dû dans chacune de ces factures.</p>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Réduction mensuelle</label>
                                   <input type="text" class="form-control" placeholder="Valeur" name="eleves_reduction_value" id="eleves_reduction_value" required>
                              </div>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="eleves_scolarite_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Enregistrer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-reduction-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer reduction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base."delete_reduction"); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   La réduction pour cet élève va supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="eleves_reduction_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
