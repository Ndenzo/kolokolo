<div class="row">
     <!-- <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter document</a>
     </div> -->
</div>
<?php show_notification();?>

<div class="row mt-3">

     <div class="col-lg-3" >
          <div class="card">
               <div class="row">
                    <img src="<?php _url(); ?>assets/custom/png/034-student.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                    <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                         <h4>Cartes d'identité</h4>
                    </div>
                    <div class="item-action dropdown col-8 mr-auto ml-auto">
                         <!-- <a href="<?php _url("scolarite/eleve/showCards") ?>" class="btn btn-success btn-md waves-effect waves-light mb-3 form-control" target="_blank"><i class="mdi mdi-briefcase-download-outline"> </i> Générer </a> -->
                         <a href="#custom-cards-modal" class="btn btn-success btn-md waves-effect waves-light mb-3 form-control" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-briefcase-download-outline"> </i> Générer </a>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-lg-3" >
          <div class="card">
               <div class="row">
                    <img src="<?php _url(); ?>assets/custom/png/pdf.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                    <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                         <h4>Petite caisse</h4>
                    </div>
                    <div class="item-action dropdown col-8 mr-auto ml-auto">
                         <a href="#custom-caisse-modal" class="btn btn-success btn-md waves-effect waves-light mb-3 form-control" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-briefcase-download-outline"> </i> Télécharger </a>
                    </div>
               </div>
          </div>
     </div>

     <div class="col-lg-3" >
          <div class="card">
               <div class="row">
                    <img src="<?php _url(); ?>assets/custom/png/pdf.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                    <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                         <h4>Etat des impayés</h4>
                    </div>
                    <div class="item-action dropdown col-8 mr-auto ml-auto">
                         <a href="#custom-unpaid-modal" class="btn btn-success btn-md waves-effect waves-light mb-3 form-control" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-briefcase-download-outline"> </i> Télécharger </a>
                    </div>
               </div>
          </div>
     </div>

</div>

<div id="custom-caisse-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter document</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base."showCaisse") ?>" method="post" target="_blank" enctype="multipart/form-data">
               <div class="col-10 col-md-12">

                    <div class="form-group mb-3">
                         <label>Date de début</label>
                         <input type="date" class="form-control" name="date_deb" required/>
                    </div>

                    <div class="form-group mb-3">
                         <label>Date de fin</label>
                         <input type="date" class="form-control" name="date_fin" required/>
                    </div>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-unpaid-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Générer etat par classes</h4>
     <div class="custom-modal-text text-left">
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
</div>

<div id="custom-cards-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Générer cartes par classes</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url("scolarite/eleve/showCards") ?>" method="post" target="_blank" enctype="multipart/form-data">
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
</div>
