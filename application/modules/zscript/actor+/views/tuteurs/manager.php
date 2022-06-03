<div class="row">
     <div class="col-sm-12">
          <div class="card">
               <div class="card-title mb-5">
                    <h5>Liste des tuteurs</h5><span></span>
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
                                                  <h4 class="mb-0 counter"><?= @get_tutor_sum()->tuteur_total ?></h4><i class="icon-bg" data-feather="archive"></i>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-success b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="check-square"></i></div>
                                             <div class="media-body"><span class="m-0">Actif</span>
                                                  <h4 class="mb-0 counter"><?= (int) @get_tutor_sum()->tuteur_total - @get_tutor_locked_sum()->tuteur_total ?></h4><i class="icon-bg" data-feather="check-square"></i>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-warning b-r-4 card-body">
                                        <div class="media static-top-widget">
                                             <div class="align-self-center text-center"><i data-feather="alert-circle"></i></div>
                                             <div class="media-body"><span class="m-0">Bloqué</span>
                                                  <h4 class="mb-0 counter"><?= @get_tutor_locked_sum()->tuteur_total ?></h4><i class="icon-bg" data-feather="alert-circle"></i>
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
                                                  <h4 class="mb-0 counter"><?= @get_tutor_leave_sum() ?></h4><i class="icon-bg" data-feather="x"></i>
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
                                        <th>Image</th>
                                        <th>Identification</th>
                                        <th>Adresse</th>
                                        <th>Phone</th>
                                        <th>Statut</th>
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
                                                       <h6 class="text-left"> <?= $rows->personne_prenoms." ".$rows->personne_nom ?> </h6>
                                                  </td>
                                                  <td><?= $rows->personne_adresse ?></td>
                                                  <td><?= $rows->personne_telephone_1 ?></td>
                                                  <td>
                                                       <?php if(id_getter('tuteur_flag_id', 'tuteur_flags', 'tuteur_flag_code', '!act') == $rows->tuteur_flag_id): ?>
                                                            <div class="span badge rounded-pill pill-badge-warning form-control">Bloqué</div>
                                                       <?php else: ?>
                                                            <div class="span badge rounded-pill pill-badge-success form-control">Activé</div>
                                                       <?php endif; ?>
                                                  </td>
                                                  <td style="width: 100px;">
                                                       <div class="text-end text-center" style="width: 90px!important;">
                                                            <div class="dropdown">
                                                                 <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                                 <div class="dropdown-menu dropdown-menu-end">
                                                                      <?php if(id_getter('tuteur_flag_id', 'tuteur_flags', 'tuteur_flag_code', '!act') == $rows->tuteur_flag_id): ?>
                                                                           <a href="#custom-activate-modal" class="dropdown-item text-success" data-toggle="modal" onclick="define_delete(<?= $rows->tuteur_id ?>, 'tuteur_id')"><i class="fa fa-unlock"></i> Débloquer </a>
                                                                      <?php else: ?>
                                                                           <a href="#custom-unactivate-modal" class="dropdown-item text-warning" data-toggle="modal" onclick="define_delete(<?= $rows->tuteur_id ?>, 'tuteur_id')"><i class="fa fa-lock"></i> Bloquer </a>
                                                                      <?php endif; ?>
                                                                      <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $rows->tuteur_id ?>, 'tuteur_id')"><i class="fa fa-trash"></i> Supprimer</a>
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

<div id="custom-activate-modal" class="modal fade bs-example-modal-center show" tabindex="-1" employe="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Activer Tuteur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'status'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10">
                              <p style="text-align: center; font-size: 14px;">
                                   Le tuteur selectionner aura accès à la plateforme. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" name="tuteur_flag_id" value="<?= id_getter('tuteur_flag_id', 'tuteur_flags', 'tuteur_flag_code', 'act') ?>">
                                   <input type="hidden" type="text" name="tuteur_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Activer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-unactivate-modal" class="modal fade bs-example-modal-center show" tabindex="-1" employe="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Bloquer Tuteur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'status'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10">
                              <p style="text-align: center; font-size: 14px;">
                                   Le tuteur selectionner sera bloqué de la plateforme. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" name="tuteur_flag_id" value="<?= id_getter('tuteur_flag_id', 'tuteur_flags', 'tuteur_flag_code', '!act') ?>">
                                   <input type="hidden" type="text" name="tuteur_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Bloquer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
