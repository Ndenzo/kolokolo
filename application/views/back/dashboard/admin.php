<div class="row">

     <div class="col-xl-3 col-md-6">
          <div class="card">

               <h4 class="card-header mt-0 mb-4">Nombre d'élèves</h4>

               <div class="widget-chart-1">
                    <div class="avatar-lg float-left mr-3" dir="ltr">
                         <img class="img-fluid" src="<?= _url()."assets/custom/png/002-graduate.png" ?>" alt="Classes img"/>
                    </div>

                    <div class="widget-detail-1 text-right">
                         <h2 class="font-weight-normal pt-2 mb-1"><?= @thousand($eleve_info->eleve_total) ?></h2>
                         <p class="text-muted mb-1">Elèves inscrits</p>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-3 col-md-6">
          <div class="card">

               <h4 class="card-header mt-0 mb-4">Valeur Facturation</h4>

               <div class="widget-chart-1">
                    <div class="avatar-lg float-left mr-3" dir="ltr">
                         <img class="img-fluid" src="<?= _url()."assets/custom/png/contract.png" ?>" alt="Classes img"/>
                    </div>

                    <div class="widget-detail-1 text-right">
                         <h2 class="font-weight-normal pt-2 mb-1"><?= @thousand($facturation_info->facturation_total - $facturation_info->remise_total) ?> F CFA</h2>
                         <p class="text-muted mb-1">Facturée</p>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-3 col-md-6">
          <div class="card">

               <h4 class="card-header mt-0 mb-4">Valeur Encaisser</h4>

               <div class="widget-chart-1">
                    <div class="avatar-lg float-left mr-3" dir="ltr">
                         <img class="img-fluid" src="<?= _url()."assets/custom/png/piggy-bank.png" ?>" alt="Classes img"/>
                    </div>

                    <div class="widget-detail-1 text-right">
                         <h2 class="font-weight-normal pt-2 mb-1"><?= @thousand($encaissement_info->encaissement_total) ?> F CFA</h2>
                         <p class="text-muted mb-1">De recettes</p>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-xl-3 col-md-6">
          <div class="card">

               <h4 class="card-header mt-0 mb-4">Valeur Décaissement</h4>

               <div class="widget-chart-1">
                    <div class="avatar-lg float-left mr-3" dir="ltr">
                         <img class="img-fluid" src="<?= _url()."assets/custom/png/briefcase-1.png" ?>" alt="Classes img"/>
                    </div>

                    <div class="widget-detail-1 text-right">
                         <h2 class="font-weight-normal pt-2 mb-1"><?= @thousand($decaissement_info->decaissement_total) ?></h2>
                         <p class="text-muted mb-1">De charges</p>
                    </div>
               </div>
          </div>
     </div>



</div>
