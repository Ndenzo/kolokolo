<style media="screen">
a.disabled {
     pointer-events: none;
     cursor: default;
}
</style>

<div class="row mt-3">

     <?php if(in_array($role_code, ["admin", "root", "surveillant"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Gestion des classes</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/046-board.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de configurer l'ensemble de vos classes ainsi que les spécifications de chacune d'elle.</p>
                              <a href="<?= _url("scolarite/classe") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "secretaire", "surveillant"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Elèves</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/002-graduate.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les eleves inscrits dans l'établissement pour cette scolaritée.</p>
                              <a href="<?= _url("scolarite/eleve") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Enseignants</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/032-podium.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les inscriptions des élèves dans l'établissement</p>
                              <a href="<?= _url("scolarite/inscription") ?>" class="btn btn-bordred btn-primary mt-3 form-control disabled" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Tarification</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/028-abacus.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les éléments de tarification de l'année scolaire par cycle.</p>
                              <a href="<?= _url("scolarite/tarification") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "secretaire"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Facturation</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/contract.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les factures qui ont été émise dans l'année scolaire.</p>
                              <a href="<?= _url("scolarite/facturation") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "secretaire"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Encaissements</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/piggy-bank.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les éléments de tarification de l'année scolaire par cycle.</p>
                              <a href="<?= _url("scolarite/encaissement") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Décaissements</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/briefcase-1.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les éléments de tarification de l'année scolaire par cycle.</p>
                              <a href="<?= _url("scolarite/decaissement") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Documentations</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/038-file.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra d'accéder aux états et autres documents de la plateforme.</p>
                              <a href="<?= _url("scolarite/documentation") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "surveillant"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Evaluations</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/stats.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les évaluations de la plateforme.</p>
                              <a href="<?= _url("scolarite/evaluation/showEvaluation") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "surveillant"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Notations</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/011-exam.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer la notation de la plateforme.</p>
                              <a href="<?= _url("scolarite/evaluation/showNotation") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "surveillant"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Absences et Retards</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/calendar.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer les absences et les retards des élèves par périodes de la plateforme.</p>
                              <a href="<?= _url("scolarite/absence") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>

     <?php if(in_array($role_code, ["admin", "root", "surveillant", "tuteur"])): ?>
          <div class="col-xl-3 col-md-6">
               <div class="card">

                    <h4 class="card-header mt-0 mb-4">Support des élèves</h4>

                    <div class="widget-chart-1">
                         <div class="avatar-lg float-left mr-3" dir="ltr">
                              <img class="img-fluid" src="<?= _url()."assets/custom/png/015-knowledge.png" ?>" alt="Classes img"/>
                         </div>

                         <div class="widget-detail-1 text-left" style="padding-left: 30%;">
                              <p class="text-muted mb-1">Ce module vous permettra de gérer l'ensemble des supports pour les élèves'</p>
                              <a href="<?= _url("scolarite/support") ?>" class="btn btn-bordred btn-primary mt-3 form-control" style="align: right;">Configurer</a>
                         </div>
                    </div>
               </div>
          </div>
     <?php endif; ?>


</div>
