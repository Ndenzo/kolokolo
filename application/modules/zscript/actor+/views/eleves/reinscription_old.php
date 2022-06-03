<style media="screen">
.required{
     color: red;
     font-weight: bold;
}
</style>
<div class="row mb-3">


</div>

<?php show_notification();?>

<div class=" mt-1">
     <form id="form-tarif" class="row" action="<?php _url($module_base."insert_renew"); ?>" method="post" target="_blank" enctype="multipart/form-data">

          <div class="col-7">
               <div class="text-left card">
                    <h4 class="mt-0 card-header">Rechercher élève</h4>
                    <hr>
                    <div class="row justify-content-left">

                         <div class="col-10 col-md-12">

                              <div class="row">
                                   <div class="col-8">
                                        <div class="form-group mb-3">
                                             <label>Matricule<span class="required">*</span></label>
                                             <input type="text" class="form-control" name="eleve_matricule">
                                        </div>
                                   </div>
                                   <div class="col-4">
                                        <button type="button" style="margin-top: 30px;" id="search_to_renew" name="search_to_renew" class="btn btn-info form-control">Chercher</button>
                                   </div>
                              </div>

                              <div id="show_eleve"></div>

                              <div class="form-group mb-3 to_hide">
                                   <label>Année scolaire <span class="required">*</span></label>
                                   <?php dropDown('SELECT settings_scolarite_id, settings_scolarite_code FROM settings_scolarites ORDER BY settings_scolarite_code DESC', array(
                                        'id'=>'settings_scolarite_id',
                                        'name'=>'settings_scolarite_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                   )); ?>
                              </div>
                              <div class="form-group mb-3 to_hide">
                                   <label>Cycle <span class="required">*</span></label>
                                   <?php dropDown('SELECT settings_cycle_id, settings_cycle_name FROM settings_cycles', array(
                                        'id'=>'settings_cycle_id',
                                        'name'=>'settings_cycle_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                   )); ?>
                              </div>
                              <div class="form-group mb-3 to_hide">
                                   <label>Niveau <span class="required">*</span></label>
                                   <?php dropChained('SELECT settings_niveau_id, settings_niveau_name, settings_cycle_id FROM settings_niveaux', array(
                                        'id'=>'settings_niveau_id',
                                        'name'=>'settings_niveau_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                   )); ?>
                              </div>

                              <div class="form-group mb-3 to_hide">
                                   <label>Classe <span class="required">*</span></label>
                                   <?php dropChained('SELECT classe_id, classe_name, settings_niveau_id FROM classes', array(
                                        'id'=>'classe_id',
                                        'name'=>'classe_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                   )); ?>
                              </div>

                              <hr>
                              <!-- <div class="modal-footer mt-3"> -->
                                   <input type="hidden" class="form-control" name="eleve_id" id="eleve_id_renew" required>
                                   <!-- <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Enregistrer</button> -->
                              <!-- </div> -->
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-5">
               <div class="text-left card">
                    <h4 class="mt-0 card-header">Facturation</h4>
                    <hr>

                    <div class="col-12">
                         <div class="row" id="tarification_modeles"></div>
                    </div>

                    <div class="col-12">
                         <div id="tarification_inscription"></div>
                    </div>

                    <div class="col-12 mt-3">
                         <div id="montant_total"></div>
                         <div class="form-group">
                              <label>Réduction </label>
                              <input type="number" class="form-control" placeholder="Montant" name="facture_remise" id="facture_remise" min="0" value="0" required>
                         </div>
                    </div>
               </div>
          </div>

          <div class="fixed-bottom mb-5 col-1 ml-auto">
               <button type="submit" class="btn btn-success btn-lg" title="submit" onclick="setTimeout(function(){ window.location.reload(); }, 5000)"> <h1><span class="fa fa-check"></span></h1> </button>
          </div>
     </form>
</div>
