<div class="row">
     <div class="col-12">
          <div class="mb-3">
               <h1>Vente</h1>
               <div class="text-zero top-right-button-container">
                    <!-- <a href="#custom-modal" class="btn btn-success btn-lg top-right-button mr-1" data-toggle="modal">ADD NEW</a> -->
               </div>
               <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                         <li class="breadcrumb-item">
                              <a href="#">Home</a>
                         </li>
                         <li class="breadcrumb-item active" aria-current="page">Vente</li>
                    </ol>
               </nav>
          </div>
          <div class="separator mb-5"></div>
     </div>
</div>

<div class="row mb-4">
     <div class="col-12 mb-4">
          <div class="card">
               <div class="card-body">
                    <h5 class="card-title">vente List</h5>
                    <?php show_notification();?>
                    <table class="data-table data-table-feature">
                         <thead>
                              <tr>
                                   <th style="width: 150px;">Date</th>
                                   <th>First Name</th>
                                   <th>Last Name</th>
                                   <th>Email</th>
                                   <th>Produit</th>
                                   <th>Nom du produit</th>
                                   <th>Montant</th>
                                   <th style="width: 100px;">Actions</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php if(is_array(@$datagrid)):?>
                                   <?php foreach(@$datagrid as $key => $row):?>
                                        <tr class="<?php if (@$row->vente_token == null): ?>bg-warning <?php else: ?> bg-success<?php endif; ?>">
                                             <td><?= gmdate("d-m-Y H:i", @$row->vente_added) ?></td>
                                             <td><?= @$row->vente_first_name ?></td>
                                             <td><?= @$row->vente_last_name ?></td>
                                             <td><?= @$row->vente_email ?></td>
                                             <th><?= @$row->vente_product ?></th>
                                             <th><?= get_product_name(@$row->vente_product, @$row->vente_product_id)?></th>
                                             <th><?= @$row->vente_pu * @$row->vente_qte ?></th>
                                             <td>
                                                  <a href="#custom-update-modal" class="btn btn-sm default btn-warning" data-toggle="modal" onclick="define_delete(<?= $row->vente_id ?>, 'vente_id')"><i class="fa fa-pencil"></i></a>
                                                  <a href="#custom-delete-modal" class="btn btn-sm default btn-danger" data-toggle="modal" onclick="define_delete(<?= $row->vente_id ?>, 'vente_id')"><i class="fa fa-trash"></i></a>
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


<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->


<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Ajouter vente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>vente code</label>
                                   <input type="text" class="form-control" placeholder="Code.." name="vente_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>vente icon</label>
                                   <input type="text" class="form-control" placeholder="Name.." name="vente_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>vente name</label>
                                   <input type="text" class="form-control" placeholder="Name.." name="vente_value" required>
                              </div>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Update</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Edit vente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>vente code</label>
                                   <input type="text" class="form-control" placeholder="Code.." name="vente_code" id="vente_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>vente icon</label>
                                   <input type="text" class="form-control" placeholder="Name.." name="vente_name" id="vente_icon" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>vente name</label>
                                   <input type="text" class="form-control" placeholder="Name.." name="vente_value" id="vente_value" required>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="vente_id" id="vente_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Update</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Delete vente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   The selected element will be permanently deleted. <br>
                                   Do you want to continue this operation?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="vente_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
