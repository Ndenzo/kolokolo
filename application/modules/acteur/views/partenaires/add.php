<div class="panel-header panel-header-sm"></div>

<div class="container">
     <form class="row" action="<?php _url($module_base."insert"); ?>" method="post" enctype="multipart/form-data">
          <div class="col-lg-4">
               <div class="card">
                    <div class="card-title">
                         <h3 class="card-title">Informations personnelles</h3>
                    </div>
                    <div class="card-body">
                         <!-- <div class="row">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                   <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                   </div>
                                   <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                   <div>
                                        <span class="btn default btn-file">
                                             <span class="fileinput-new btn btn-info"> Parcourir </span>
                                             <span class="fileinput-exists btn btn-warning"> Changer </span>
                                             <input type="file" name="user_photo">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                   </div>
                              </div>
                         </div> -->
                         <div class="form-group">
                              <label class="form-label">Nom d'utilisateur</label>
                              <input class="form-control" placeholder="Nom d'utilisateur" name="user_login"/>
                         </div>
                         <div class="form-group">
                              <label class="form-label">Genre</label>
                              <?php dropDown('SELECT genre_code, genre_libelle FROM settings_genre', array(
                                 'id'=>'genre',
                                 'name'=>'genre',
                                 'class'=>'form-control select2-nosearch',
                                 'attr'=>'data-placeholder ="Civilité" required'
                              )); ?>                         </div>
                         <div class="form-group">
                              <label class="form-label">Prénom</label>
                              <input type="text" class="form-control" placeholder="Votre prenom complet" name="prenoms">
                         </div>
                         <div class="form-group">
                              <label class="form-label">Nom</label>
                              <input type="text" class="form-control" placeholder="Votre nom" name="nom">
                         </div>
                         <div class="form-group">
                              <label class="form-label">Bio</label>
                              <textarea class="form-control" rows="5" name="user_note" placeholder="Biographie..."></textarea>
                         </div>
                         <div class="form-group">
                              <label class="form-label">Email</label>
                              <input class="form-control" placeholder="votre-email@domain.com" name="user_email"/>
                         </div>
                         <div class="form-group">
                              <label class="form-label">Mot de passe</label>
                              <input type="password" class="form-control" name="password" placeholder="Votre mot de passe"/>
                         </div>

                    </div>
               </div>
          </div>

          <div class="col-lg-8">
               <div class="card">
                    <div class="card-title">
                         <h3 class="card-title">Informations partenaire</h3>
                    </div>
                    <div class="card-body">
                         <div class="row">
                              <div class="col-12">
                                   <div class="col-md-4 ml-auto mr-auto">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                             <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                             </div>
                                             <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                             <div>
                                                  <span class="btn default btn-file">
                                                       <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                       <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                       <input type="file" name="partenaire_photo">
                                                  </span>
                                                  <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-5">
                                   <div class="form-group">
                                        <label class="form-label">Partenaire</label>
                                        <input type="text" class="form-control" placeholder="Nom du partenaire" name="partenaire_libelle">
                                   </div>
                              </div>

                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label">Adresse</label>
                                        <input type="text" class="form-control" placeholder="Adresse du partenaire" name="partenaire_adresse">
                                   </div>
                              </div>
                              <!-- <div class="col-sm-6 col-md-4">
                                   <div class="form-group">
                                        <label class="form-label">Pays</label>
                                        <input type="text" class="form-control" placeholder="partenaire_pays" value="Melbourne">
                                   </div>
                              </div> -->
                              <div class="col-sm-6 col-md-4">
                                   <div class="form-group">
                                        <label class="form-label">Ville</label>
                                        <?php dropDown('SELECT ville_libelle, ville_libelle FROM settings_villes', array(
                                            'id'=>'ville',
                                            'name'=>'ville',
                                            'class'=>'form-control select2-allow-clear',
                                            'attr'=>'data-placeholder ="Ville" required'
                                        )); ?>
                                   </div>
                              </div>
                              <div class="col-sm-6 col-md-4">
                                   <div class="form-group">
                                        <label class="form-label">Telephone</label>
                                        <input type="text" class="form-control mask-phone-<?=$config->country_code?>" name="telephone_1">
                                   </div>
                              </div>
                              <!-- <div class="col-md-5">
                                   <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <select class="form-control custom-select">
                                             <option value="">Germany</option>
                                        </select>
                                   </div>
                              </div> -->
                              <div class="col-md-12">
                                   <div class="form-group mb-0">
                                        <label class="form-label">Présentation</label>
                                        <textarea rows="5" class="form-control" placeholder="Une description du partenaire" name="partenaire_desc"></textarea>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
          <div class="col-12">
               <div class="form-footer mb-50 col-6 offset-3">
                    <button class="btn btn-success btn-block">Enregistrer</button>
               </div>
          </div>
     </form>
</div>

<script type="text/javascript">
CKEDITOR.replace('partenaire_desc',{
     removePlugins : 'easyimage, cloudservices'
});
</script>
