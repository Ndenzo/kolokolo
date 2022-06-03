<div class="row">
     <form id="form-tarif" class="row" action="<?php _url($module_base."insert_renew"); ?>" method="post" target="_blank" enctype="multipart/form-data">
          <div class="col-xl-7 col-md-12 box-col-12">
               <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                         <div class="ps-0">
                              <div class="tab-content">
                                   <div class="card mb-0">
                                        <div class="card-header d-flex">
                                             <h6 class="mb-0">Rechercher élève</h6>
                                        </div>
                                        <div class="card-body pb-0">

                                             <?php show_notification();?>

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

                                                       <div class="form-group mb-30 to_hide">
                                                            <label>Année scolaire <span class="required">*</span></label>
                                                            <?php dropDown('SELECT settings_scolarite_id, settings_scolarite_code FROM settings_scolarites ORDER BY settings_scolarite_code DESC', array(
                                                                 'id'=>'settings_scolarite_id',
                                                                 'name'=>'settings_scolarite_id',
                                                                 'class'=>'form-control selectpicker',
                                                                 'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                                            )); ?>
                                                       </div>
                                                       <div class="form-group mb-30 to_hide">
                                                            <label>Cycle <span class="required">*</span></label>
                                                            <?php dropDown('SELECT settings_cycle_id, settings_cycle_name FROM settings_cycles', array(
                                                                 'id'=>'settings_cycle_id',
                                                                 'name'=>'settings_cycle_id',
                                                                 'class'=>'form-control selectpicker',
                                                                 'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                                            )); ?>
                                                       </div>
                                                       <div class="form-group mb-30 to_hide">
                                                            <label>Niveau <span class="required">*</span></label>
                                                            <?php dropChained('SELECT settings_niveau_id, settings_niveau_name, settings_cycle_id FROM settings_niveaux', array(
                                                                 'id'=>'settings_niveau_id',
                                                                 'name'=>'settings_niveau_id',
                                                                 'class'=>'form-control selectpicker',
                                                                 'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                                            )); ?>
                                                       </div>

                                                       <div class="form-group mb-30 to_hide">
                                                            <label>Classe <span class="required">*</span></label>
                                                            <?php dropChained('SELECT classe_id, classe_name, settings_niveau_id FROM classes', array(
                                                                 'id'=>'classe_id',
                                                                 'name'=>'classe_id',
                                                                 'class'=>'form-control selectpicker',
                                                                 'attr'=>'title ="-- Choose --"  data-size="4" data-live-search="true" required'
                                                            )); ?>
                                                       </div>

                                                       <!-- <div class="modal-footer mt-3"> -->
                                                       <input type="hidden" class="form-control" name="eleve_id" id="eleve_id_renew" required>
                                                       <!-- <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                       <button type="submit" class="btn btn-success col-md-4">Enregistrer</button> -->
                                                       <!-- </div> -->
                                                  </div>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="col-xl-5 box-col-6">
               <div class="email-wrap bookmark-wrap">
                    <div class="email-left-aside">
                         <div class="card">
                              <div class="card-header d-flex">
                                   <h6 class="mb-0">Facturation</h6>
                              </div>
                              <div class="card-body">
                                   <div class="email-app-sidebar left-bookmark">
                                        <div class="col-12">
                                             <div class="row" id="tarification_modeles"></div>
                                        </div>

                                        <div class="col-12">
                                             <div id="tarification_inscription"></div>
                                        </div>

                                        <div class="col-12 mt-30">
                                             <div id="montant_total"></div>
                                             <div class="form-group">
                                                  <label>Réduction </label>
                                                  <input type="number" class="form-control" placeholder="Montant" name="facture_remise" id="facture_remise" min="0" value="0" required>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-1 offset-8 col-xxl-1 offset-xxl-9" style="position:fixed!important; z-index: 1030; margin-top: -550px;">
                    <button type="submit" id="customhide" class="btn btn-success btn-lg disabled" title="submit" onclick="setTimeout(function(){ window.location.reload(); }, 5000)"> <h1><span class="fa fa-check"></span></h1> </button>
               </div>
          </div>
     </form>

</div>
