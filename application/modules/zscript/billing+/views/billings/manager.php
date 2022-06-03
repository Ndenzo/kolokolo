<div class="col-md-12 project-list">
     <div class="card">
          <div class="row">
               <div class="col-md-12 dropdown-basic">
                    <div class="form-group mb-0 me-0"></div>
                    <div class="dropdown f-right">
                         <button class="dropbtn btn btn-success" type="button">
                              Gestion des factures <span><i class="icofont icofont-plus" style="margin-left: 20px;"></i></span>
                         </button>
                         <div class="dropdown-content" style="margin-top: -10px;">
                              <a href="#custom-individuel-modal"  class="dropdown-item" data-toggle="modal"><i class="fa fa-user"> </i> Facturer Elève </a>
                              <a href="#custom-groupe-modal" class="dropdown-item" data-toggle="modal"><i class="fa fa-th-large"> </i> Facturer Classe </a>
                              <a href="#custom-search-modal" class="dropdown-item" data-toggle="modal"><i class="fa fa-search"> </i> Chercher Facture </a>
                              <div class="dropdown-divider"></div>
                              <a href="#custom-unpaid-modal" class="dropdown-item text-warning" data-toggle="modal"><i class="fa fa-warning"> </i> Impayés </a>
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
                    <h5>Liste des Factures </h5><span></span>
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
                                                  <h4 class="mb-0 counter"><?= @get_billing_sum()->facture_total ?></h4><i class="icon-bg" data-feather="archive"></i>
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
                                             <div class="media-body"><span class="m-0">Payés</span>
                                                  <h4 class="mb-0 counter"><?= @get_billing_flaged_sum('reg')->facture_total ?></h4><i class="icon-bg" data-feather="check"></i>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-warning b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="alert-octagon"></i></div>
                                             <div class="media-body"><span class="m-0">Impayés</span>
                                                  <h4 class="mb-0 counter"><?= @get_billing_flaged_sum('!reg')->facture_total ?></h4><i class="icon-bg" data-feather="alert-octagon"></i>
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
                                             <div class="media-body"><span class="m-0">Annulés</span>
                                                  <h4 class="mb-0 counter"><?= @get_billing_locked_sum()->facture_total ?></h4><i class="icon-bg" data-feather="x"></i>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="table-responsive product-table mt-50">
                         <table class="display" id="basic-2">
                              <thead>
                                   <tr>
                                        <th>ID</th>
                                        <th>Numero</th>
                                        <th>Date</th>
                                        <!-- <th>Classe</th> -->
                                        <th>Destinataire</th>
                                        <th>Montant</th>
                                        <th>Encaisser</th>
                                        <th>A encaisser</th>
                                        <th>Statuts</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody id="facture_list">
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $rows):?>
                                             <tr>
                                                  <td><?=@$rows->facture_id?></td>
                                                  <td><?=@$rows->facture_num?></td>
                                                  <td><?=gmdate("d-m-Y H:i", @$rows->facture_added)?></td>
                                                  <!-- <td><?=@$rows->classe_name?></td> -->
                                                  <td><?=@$rows->eleve_matricule?></td>
                                                  <td><?=thousand(@$rows->montant - @$rows->facture_remise)?></td>
                                                  <td><?=thousand(@$rows->encaissement)?></td>
                                                  <td><?=thousand(@$rows->montant - @$rows->encaissement - @$rows->facture_remise)?></td>
                                                  <td><span class="badge badge-<?=@$rows->facture_flag_class?>"><?=@$rows->facture_flag_label?></span></td>
                                                  <td style="width: 100px;">
                                                       <div class="text-end text-center" style="width: 90px!important;">
                                                            <div class="dropdown">
                                                                 <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                 <div class="dropdown-menu dropdown-menu-end">
                                                                      <a href="<?php _url($module_base."showFacture/".$rows->facture_id) ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-text"></i> Facture </a>
                                                                      <?php if (@$rows->facture_flag_code != "reg"): ?>
                                                                           <a href="#custom-encaissement-modal" class="dropdown-item text-success" data-toggle="modal" onclick="define_custom(<?= $rows->facture_id ?>, 'facture_id', <?= @$rows->montant - @$rows->encaissement - @$rows->facture_remise ?>)"><i class="fa fa-dollar"></i> Encaisser </a>
                                                                      <?php else: ?>
                                                                           <a href="<?php _url($module_base."showQuittance/".$rows->facture_id) ?>" class="dropdown-item  text-success" target="_blank"><i class="fa fa-ticket"></i> Reçu </a>

                                                                      <?php endif; ?>
                                                                      <div class="dropdown-divider"></div>
                                                                      <!-- <a href="#custom-update-modal" class="dropdown-item text-warning" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'actor/eleve/showCustom')"><i class="fa fa-pencil"></i> Edit</a> -->
                                                                      <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $rows->facture_id ?>, 'facture_id')"><i class="fa fa-trash"></i> Supprimer </a>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </td>
                                             </tr>
                                        <?php endforeach;?>
                                   <?php endif;?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>


<div id="custom-individuel-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Facture Elève</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="form_individual_facture" class="row justify-content-center" action="<?php _url($module_base.'insert_individual'); ?>" target="_blank" method="post">
                         <div class="col-12 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Matricule</label>
                                   <div class="row">
                                        <div class="col-8">
                                             <input type="text" class="form-control" placeholder="Le matricule de l'élève" name="eleve_matricule" id="eleve_matricule" required>
                                             <input type="hidden" name="settings_scolarite_id" value="<?= $_SESSION['dashboard']['settings_scolarite_id'] ?>" required>
                                        </div>
                                        <div class="col-4">
                                             <button class="btn btn-info form-control" type="button" id="matricule_checker">Rechercher</button>
                                        </div>
                                   </div>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Eléments de facturation</label>
                                   <div class="row">
                                        <div class="col-6">
                                             <div id="facturation_tarification_detail_id">
                                                  -- Entrez le matricule de l'élève --
                                             </div>
                                        </div>

                                        <div class="col-6">
                                             <div style="margin-top:10%;">

                                                  <div id="montant_total"></div>

                                                  <div class="form-group">
                                                       <label>Réduction mensuelle</label>
                                                       <input type="number" class="form-control" placeholder="Montant" name="facturation_remise" id="facturation_remise" min="0" value="0" required>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4"  onclick="setTimeout(function(){ window.location.reload(); }, 500)">Enregistrer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-groupe-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Facture Classe</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="form_group_facture" class="row justify-content-center" action="<?php _url($module_base.'insert_grouped'); ?>" target="_blank" method="post">
                         <div class="col-12 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Classe</label>
                                   <?php dropDown('SELECT classe_id, classe_name FROM classes order by classe_id', array(
                                        'id'=>'classe_id',
                                        'name'=>'classe_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="5" data-live-search="true" required'
                                   )); ?>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Eléments de facturation</label>
                                   <?php dropDown('SELECT tarification_details.tarification_detail_id, tarification_details.tarification_detail_name FROM tarification_details JOIN tarifications ON tarifications.tarification_id = tarification_details.tarification_id WHERE tarifications.tarification_code = "men" group by tarification_detail_name order by tarification_detail_id ', array(
                                        'id'=>'tarification_detail_id',
                                        'name'=>'tarification_detail_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="5" data-live-search="true" required'
                                   ));
                                   ?>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="settings_scolarite_id" value="<?= $_SESSION['dashboard']['settings_scolarite_id'] ?>" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4"  onclick="setTimeout(function(){ window.location.reload(); }, 500)">Enregistrer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-search-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Chercher Facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="search_form_facture" class="row justify-content-center" method="post">
                         <div class="col-10 ">
                              <div class="form-group">
                                   <label for="search_element">Element :</label>
                                   <input type="text" name="search_element" required placeholder="Element à rechercher" class="form-control" id="search_element">
                              </div>

                              <div class="form-group mt-3">
                                   <label for="facturation_element text-primary">Chercher par : </label>
                                   <div class="mt-1">
                                        <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio1" name="search_option" class="custom-control-input" value="1" required>
                                             <label class="custom-control-label" for="customRadio1">N° de Facture</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio2" name="search_option" class="custom-control-input" value="2" required>
                                             <label class="custom-control-label" for="customRadio2">Matricule Elève</label>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-2">
                                   <button class="btn btn-success waves-effect waves-light mr-1 form-control" id="searcher" data-dismiss="modal">
                                        Recherche
                                   </button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-encaissement-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_facture="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Encaisser facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="form_encaissement" class="row justify-content-center" action="<?php _url($module_base.'insert_encaissement'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Mode de paiement</label>
                                   <?php
                                   dropDown("select settings_mode_paiement_id, settings_mode_paiement_name FROM settings_mode_paiements", array(
                                        'id'=>'settings_mode_paiement_id',
                                        'name'=>'settings_mode_paiement_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                   )); ?>
                              </div>
                              <div id="to_justif">
                              </div>
                              <div class="form-group mb-3">
                                   <label>Montant</label>
                                   <input type="number" class="form-control" placeholder="Montant" name="encaissement_value" id="encaissement_value" min="0"  required>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="facture_id" value="<?=@$facture_id?>" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Encaisser</button>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-20">
                              <p style="text-align: center; font-size: 14px;">
                                   La facture sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="facture_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-unpaid-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Générer etat par classes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base."showUnpaid") ?>" method="post" target="_blank" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Classe</label>
                                   <?php dropDown('SELECT classe_id, classe_name FROM classes order by classe_id', array(
                                        'id'=>'classe_id',
                                        'name'=>'classe_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="5" data-live-search="true" required'
                                   )); ?>
                              </div>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
