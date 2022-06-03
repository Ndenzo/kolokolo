<div class="row">
     <div class="col-sm-12">
          <div class="card">
               <div class="card-title mb-5">
                    <h5>Liste des encaissemsents </h5><span></span>
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
                                                  <h4 class="mb-0 counter"><?= @get_cashin_sum()->encaissement_total ?></h4><i class="icon-bg" data-feather="archive"></i>
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
                                             <div class="media-body"><span class="m-0">Par Cash</span>
                                                  <h4 class="mb-0 counter"><?= @get_cashin_flaged_sum('cash')->encaissement_total ?></h4><i class="icon-bg" data-feather="check"></i>
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
                                             <div class="media-body"><span class="m-0">Autre Methode</span>
                                                  <h4 class="mb-0 counter"><?= @get_cashin_flaged_sum('cash', true)->encaissement_total ?></h4><i class="icon-bg" data-feather="alert-octagon"></i>
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
                                             <div class="media-body"><span class="m-0">Annulé</span>
                                                  <h4 class="mb-0 counter"><?= @get_cashin_locked_sum()->encaissement_total ?></h4><i class="icon-bg" data-feather="x"></i>
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
                                        <th>Date</th>
                                        <th>Facture</th>
                                        <th>Montant</th>
                                        <th>Mode de paiement</th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $rows):?>
                                             <tr>
                                                  <td><?=@$rows->encaissement_id?></td>
                                                  <td><?=gmdate("d-m-Y H:i", @$rows->encaissement_added)?></td>
                                                  <td><?=@$rows->facture_num?></td>
                                                  <td><?=thousand(@$rows->encaissement_value)?></td>
                                                  <td><?=@$rows->settings_mode_paiement_name?></td>
                                                  <!-- <td><?=@$rows->encaissement_detail?></td> -->
                                                  <td style="width: 100px;">
                                                       <div class="text-end text-center" style="width: 90px!important;">
                                                            <div class="dropdown">
                                                                 <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                 <div class="dropdown-menu dropdown-menu-end">
                                                                      <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $rows->encaissement_id ?>, 'encaissement_id')"><i class="fa fa-trash"></i> Annulé</a>
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
                                   <input type="hidden" type="text" name="encaissement_id" value="<?=@$encaissement_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
