<style>
.img-container img {
     max-width: 100%;
}
.option-btn{
     max-width: 40px!important;
     margin: 5px!important;
}
.sim{
     height: 25px!important;
     vertical-align: middle;
     margin-top: 12px!important;
}
.form-group.row{
     margin-top: -25px !important;
}
.col-form-label{
     margin-bottom: 0px!important;
}

.select2{
     margin-top: 10px!important;
}

.select2-container .select2-selection--single{
     height:25px!important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
     margin-top: -15px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow{
     height:20px!important;
     margin-top: 4px!important;
}
</style>

<div class="row">
     <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h4 class="col-7">Simulateur </h4>
                         <div class="col-5">
                              <button id="sim_activate" class="btn btn-success float-right"><i class="fa fa-check"> </i> Simuler </button>
                         </div>
                    </div>
                    <form class="forms-sample">
                         <div class="form-group row">
                              <label for="exampleInputUsername2" class="col-sm-7 col-form-label">Apport</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="invest_value" placeholder="Valeur">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-7 col-form-label">Période de placement (Année)</label>
                              <div class="col-sm-5">
                                   <select class="select_custom" id="per_place" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                   </select>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputMobile" class="col-sm-7 col-form-label">Effet de levier</label>
                              <div class="col-sm-5">
                                   <select class="select_custom" id="eff_lev" required>
                                        <option value="2">2</option>
                                        <option value="1.5" selected>1.5</option>
                                        <option value="1">1</option>
                                        <option value="0.5">0.5</option>
                                   </select>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputPassword2" class="col-sm-7 col-form-label">Montant de la dette</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="mnt_dette" placeholder="Montant">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Type d'immobilier</label>
                              <div class="col-sm-5">
                                   <?php dropDown('SELECT sim_type_id, sim_type_name FROM sim_types ORDER BY sim_type_name',array(
                                        'name' => 'sim_type_id',
                                        'id' => "sim_type_id_form",
                                        'class' => 'form-control sim select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Pays</label>
                              <div class="col-sm-5">
                                   <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                        'name' => 'sim_state_id',
                                        'id' => "sim_state_id_form",
                                        'class' => 'form-control sim select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Ville</label>
                              <div class="col-sm-5">
                                   <?php dropChained('SELECT sim_town_id, sim_town_name, sim_state_id FROM sim_towns',array(
                                        'name' => 'sim_town_id',
                                        'id' => "sim_town_id_form",
                                        'class' => 'form-control select_custom sim',
                                        'attr' => 'required',
                                   ));?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Taux d'emprunt (%)</label>
                              <div class="col-sm-5">
                                   <?php if(@sim_meta('tx_emp') != null): ?>
                                        <input type="number" class="form-control sim" id="tx_emp" value="<?= sim_meta('tx_emp') ?>" disabled>
                                   <?php else: ?>
                                        <input type="number" class="form-control sim" id="tx_emp">
                                   <?php endif; ?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Montant de l'intérêt</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="mnt_inter" placeholder="Montant">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Revenue Net d'exploitation (NOI)</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="rev_net_exp" placeholder="Montant">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Montant Total d'Investissement</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="mnt_total_invest" placeholder="Montant">
                              </div>
                         </div>

                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Taxe sur Revenus locatifs (Hyp.)</label>
                              <div class="col-sm-5">
                                   <?php if(@sim_meta('tax_loc') != null): ?>
                                        <input type="number" class="form-control sim" id="tax_loc" value="<?= sim_meta('tax_loc') ?>" disabled>
                                   <?php else: ?>
                                        <input type="number" class="form-control sim" id="tax_loc">
                                   <?php endif; ?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Taxe sur foncier batie</label>
                              <div class="col-sm-5">
                                   <input type="hidden" class="form-control sim" id="" placeholder="">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Abattement forfaitaire</label>
                              <div class="col-sm-5">
                                   <?php if(@sim_meta('abat_for') != null): ?>
                                        <input type="number" class="form-control sim" id="abat_for" value="<?= sim_meta('abat_for') ?>" disabled>
                                   <?php else: ?>
                                        <input type="number" class="form-control sim" id="abat_for">
                                   <?php endif; ?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Rent Escalation</label>
                              <div class="col-sm-5">
                                   <?php if(@sim_meta('rent_esc') != null): ?>
                                        <input type="number" class="form-control sim" id="rent_esc" value="<?= sim_meta('rent_esc') ?>" disabled>
                                   <?php else: ?>
                                        <input type="number" class="form-control sim" id="rent_esc">
                                   <?php endif; ?>
                              </div>
                         </div>
                         <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button>
                         <button class="btn btn-light">Cancel</button> -->
                    </form>
               </div>
          </div>
     </div>
     <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h4 class="col-7">Résultat & Ratios </h4>
                         <div class="col-5">
                              <a href="#custom-modal"  class="btn btn-success float-right" data-toggle="modal"><i class="fa fa-sliders"> </i> Constants </a>
                         </div>
                    </div>
                    <form class="forms-sample">
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Yield (src Knight Frank)  </label>
                              <div class="col-sm-5">
                                   <?php if(@sim_meta('yield') != null): ?>
                                        <input type="number" class="form-control sim" id="yield" value="<?= sim_meta('yield') ?>" disabled>
                                   <?php else: ?>
                                        <input type="number" class="form-control sim" id="yield">
                                   <?php endif; ?>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputUsername2" class="col-sm-7 col-form-label">ROE</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="roe" placeholder="Valeur">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-7 col-form-label">Cash on cash return (Before tax CF/Inv Capital)</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="cash_on_cash" placeholder="Valeur">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputMobile" class="col-sm-7 col-form-label">Cap rate (Net Operating / Market val)</label>
                              <div class="col-sm-5">
                                   <input type="hidden" class="form-control sim" id="" placeholder="">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputPassword2" class="col-sm-7 col-form-label">IRR</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" d="mnt_dette" placeholder="Montant">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">DRCI (Année)</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="drci" placeholder="Montant">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Loan To Value (Loan / Market Value)</label>
                              <div class="col-sm-5">

                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Gross rent multiplier(Market Value / Annual Income)</label>
                              <div class="col-sm-5">

                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Debt service coverage(EBITDA/Interest+Principal)</label>
                              <div class="col-sm-5">
                                   <input type="text" class="form-control sim" id="ebitda" placeholder="Montant">
                              </div>
                         </div>
                         <div class="form-group row">
                              <label for="exampleInputConfirmPassword2" class="col-sm-7 col-form-label">Capital appreciation (fonction du PIB pays)</label>
                              <div class="col-sm-5">
                                   <input type="hidden" class="form-control sim" id="" placeholder="">
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<!-- Add manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Constants</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body row">
                    <div class="col-4 border-right">
                         <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                              <div class="col-12">
                                   <div class="form-group mb-3">
                                        <label>Nom de la constante</label>
                                        <input type="text" class="form-control" placeholder="Nom" name="sim_meta_name" required>
                                   </div>

                                   <div class="form-group mb-3">
                                        <label>Code de la constante</label>
                                        <input type="text" class="form-control" placeholder="Code" name="sim_meta_code" required>
                                   </div>

                                   <div class="form-group mb-3">
                                        <label>Valeur de la constante</label>
                                        <input type="text" class="form-control" placeholder="Valeur" name="sim_meta_value" required>
                                   </div>

                                   <div class="modal-footer mt-5">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-success col-md-7">Ajouter</button>
                                   </div>
                              </div>
                         </form>
                    </div>
                    <div class="col-8" style="overflow-y: auto;">
                         <?php if(is_array(@$metas)):?>
                              <?php foreach(@$metas as $key => $meta):?>
                                   <li class="list-group-item" style="height:45px!important;">
                                        <div class="float-left row col-8">
                                             <div class="col-8">
                                                  <?= @$meta->sim_meta_code ?>
                                             </div>
                                             <div class="col-4 text-right">
                                                  <?= @$meta->sim_meta_value ?>
                                             </div>
                                        </div>
                                        <div class="float-right">
                                             <a href="#custom-update-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= @$meta->sim_meta_id ?>, 'simulator/demo/showEdit')" data-dismiss="modal" style="margin-top: -5px;"><i class="fa fa-pencil"></i></a>
                                             <a href="#custom-delete-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= @$meta->sim_meta_id ?>, 'sim_meta_id')" data-dismiss="modal" style="margin-top: -5px;"><i class="fa fa-trash"></i></a>
                                        </div>
                                   </li>
                              <?php endforeach;?>
                         <?php endif;?>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Update manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Modifier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Nom de la constante</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="sim_meta_name" id="sim_meta_name" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Code de la constante</label>
                                   <input type="text" class="form-control" placeholder="Code" name="sim_meta_code" id="sim_meta_code" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Valeur de la constante</label>
                                   <input type="text" class="form-control" placeholder="Valeur" name="sim_meta_value" id="sim_meta_value" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" type="text" name="sim_meta_id" id="sim_meta_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   La constante selectionner sera supprimer. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="sim_meta_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-5">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
