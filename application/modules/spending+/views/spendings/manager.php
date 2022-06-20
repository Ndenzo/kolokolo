<div class="col-md-12 project-list">
     <div class="card">
          <div class="row">
               <div class="col-md-6"></div>
               <div class="col-md-6">
                    <a href="#custom-modal"  class="btn btn-success f-right" data-toggle="modal"><i class="fa fa-plus"> </i> Ajouter bon </a>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-sm-12">
          <div class="card">
               <div class="card-title mb-5">
                    <h5>Liste des bons de décaissements </h5><span></span>
               </div>
               <div class="card-body">
                    <?php show_notification();?>
                    <!-- <div class="row">
                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                             <div class="media-body"><span class="m-0">All Spendings</span>
                                                  <h4 class="mb-0 counter"><?= @get_spending_sum()->decaissement_bon_total ?></h4><i class="icon-bg" data-feather="archive"></i>
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
                                             <div class="media-body"><span class="m-0">Spending Values</span>
                                                  <h4 class="mb-0 counter"><?= @get_cashin_sum()->encaissement_total ?></h4><i class="icon-bg" data-feather="check"></i>
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
                                             <div class="media-body"><span class="m-0">This Year</span>
                                                  <h4 class="mb-0 counter"><?= @get_cashin_sum()->encaissement_total ?></h4><i class="icon-bg" data-feather="alert-octagon"></i>
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
                                             <div class="media-body"><span class="m-0">This Month</span>
                                                  <h4 class="mb-0 counter"><?= @get_spending_locked_sum()->decaissement_bon_total ?></h4><i class="icon-bg" data-feather="x"></i>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div> -->
                    <div class="table-responsive product-table mt-50">
                         <table class="display" id="basic-2">
                              <thead>
                                   <tr>
                                        <th>Decaissement</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Statuts</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $rows):?>
                                             <tr>
                                                  <td><?=@$rows->decaissement_bon_num?></td>
                                                  <td><?=gmdate("d-m-Y H:i", @$rows->decaissement_bon_added)?></td>
                                                  <td><?=thousand(@$rows->montant_decaisser)."F CFA"?></td>
                                                  <td><span class="badge badge-<?=@$rows->decaissement_bon_flag_class?>"><?=@$rows->decaissement_bon_flag_label?></span></td>
                                                  <td style="width: 100px;">
                                                       <div class="text-end text-center" style="width: 90px!important;">
                                                            <div class="dropdown">
                                                                 <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                 <div class="dropdown-menu dropdown-menu-end">
                                                                      <a href="#custom-detail-modal-<?= $rows->decaissement_bon_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-credit-card-plus"></i> Détails </a>
                                                                      <a href="<?php _url($module_base."showDecaissement/".$rows->decaissement_bon_id) ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Bon de décaissement </a>
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


<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Add Element</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3 row">
                                   <div class="col-7">
                                        <label>Numéro</label>
                                        <input type="text" class="form-control" placeholder="Numéro" name="decaissement_bon_num" value="<?= decaissement_code_generator() ?>" required readonly>
                                   </div>
                                   <div class="col-4">
                                        <label>Nombre d'éléments</label>
                                        <input type="number" class="form-control" placeholder="Nombre" name="nb_decaissement" id="nb_decaissement" min="0" required>
                                   </div>
                              </div>

                              <hr>

                              <div class="form-group mb-3" id="decaissements"></div>

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

<?php if(is_array(@$datagrid)):?>
     <?php foreach(@$datagrid as $rows):?>
          <div id="custom-detail-modal-<?= $rows->decaissement_bon_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
               <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h4 class="modal-title" id="myCenterModalLabel">Détail du décaissement</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         </div>
                         <div class="modal-body">
                              <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                   <thead>
                                        <tr>
                                             <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:left;">Libelle</th>
                                             <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="1" class="tablesaw-priority-1">Montant</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$rows->decaissements)):?>
                                             <?php foreach(@$rows->decaissements as $decaissement):?>
                                                  <tr>
                                                       <td style="text-align:left;"><?= @$decaissement->decaissement_libelle ?></td>
                                                       <td class="tablesaw-priority-1"><?= thousand(@$decaissement->decaissement_value) ?></td>
                                                  </tr>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </tbody>
                              </table>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     <?php endforeach;?>
<?php endif;?>

<div id="custom-decaissement-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Encaisser decaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
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
                                   <input type="number" class="form-control" placeholder="Montant" name="decaissement_value" id="decaissement_value" required>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="decaissement_id" value="<?=@$decaissement_id?>" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer decaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le decaissement sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="decaissement_id" value="<?=@$decaissement_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
