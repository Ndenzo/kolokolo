<style media="screen">
#img-hover {
     position: relative;
     text-align: center;
     color: white;
}

/* Centered text */
#img-hover-centered {
     position: absolute;
     top: 50%;
     left: 40%;
     transform: translate(-50%, -50%);
}
</style>

<div class="container-fluid">
     <form method="post" action="<?= _url($module_base.'update') ?>" autocomplete="off" enctype="multipart/form-data">
          <div class="row clearfix">
               <div class="col-xl-7 box-col-12">
                    <div class="card">
                         <div class="card-title mb-5">
                              <h5>Identity</h5>
                         </div>
                         <div class="card-body">
                              <?php show_notification();?>
                              <div class="row">
                                   <div class="col-md-4">
                                        <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                             <?php if (@$profile->personne_photo == null): ?>
                                                  <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url('assets/custom/img/default/boy.png') ?>" alt="No image"  style="width: 200px!important;">
                                             <?php else: ?>
                                                  <img class="rounded ml-auto mr-auto " id="avatar"  src="<?= _url(@$profile->personne_photo); ?>" alt="No image" style="width: 200px!important;">
                                             <?php endif; ?>
                                             <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                             <div id="picture_data"></div>
                                             <div id="img-hover-centered"><i data-feather="image"></i></div>
                                        </label>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Civilité</label>
                                                  <?php dropDown('SELECT settings_genre_code, settings_genre_name FROM settings_genres', array(
                                                       'id'=>'genre_insc',
                                                       'name'=>'personne_genre',
                                                       'class'=>'form-control selectpicker',
                                                       'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected',
                                                       'selected' => @$profile->personne_genre
                                                  )); ?>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-7">
                                                       <label>First name</label>
                                                       <input type="text" class="form-control" placeholder="First name .." name="personne_prenoms" value="<?= @$profile->personne_prenoms ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-5">
                                                       <label>Last name</label>
                                                       <input type="text" class="form-control" placeholder="Last name .." name="personne_nom" value="<?= @$profile->personne_nom ?>" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-7">
                                                       <label>Birth date</label>
                                                       <input type="date" class="form-control digits" name="personne_naissance_date" value="<?= @$profile->personne_naissance_date ?>" data-language="en" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-5">
                                                       <label>Birth place</label>
                                                       <input type="text" class="form-control" placeholder="Birth place .." name="personne_naissance_lieu" value="<?= @$profile->personne_naissance_lieu ?>" required>
                                                  </div>
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label>Email</label>
                                                  <input type="text" class="form-control" placeholder="Email .." name="employe_email" value="<?= @$profile->employe_email ?>" >
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card">
                         <div class="card-title mb-5">
                              <h5>Contact </h5>
                         </div>
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Address</label>
                                                  <input type="text" class="form-control" placeholder="Address .." name="personne_adresse" value="<?= @$profile->personne_adresse ?>" required>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-7">
                                                       <label>Country</label>
                                                       <?php dropDown('SELECT iso2, short_name FROM settings_countries',array(
                                                            'name'=>'personne_country',
                                                            'id'=>"personne_country_form",
                                                            'class' => 'form-control selectpicker',
                                                            'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required',
                                                            'selected' => @$profile->personne_country,
                                                       ));?>
                                                  </div>
                                                  <div class="form-group mb-3 col-5">
                                                       <label>City</label>
                                                       <input type="text" class="form-control" placeholder="City .." name="personne_ville" value="<?= @$profile->personne_ville ?>" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Phone number 1</label>
                                                       <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Number 1 .." name="personne_telephone_1" value="<?= @$profile->personne_telephone_1 ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Phone number 2</label>
                                                       <input type="text" class="form-control mask-phone-<?=$config->country_code?>" placeholder="Number 2 .." name="personne_telephone_2" value="<?= @$profile->personne_telephone_2 ?>" >
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-xl-5 box-col-12">
                    <div class="card">
                         <div class="card-title mb-5">
                              <h5>Profile </h5>
                         </div>
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="row">
                                                  <div class="form-group mb-3 col-12">
                                                       <label>Fonction <span class="required">*</span></label>
                                                       <?php foreach ($fonctions as $key => $fonction): ?>
                                                            <label class="d-block" for="chk-ani">
                                                                <input class="checkbox_animated" id="chk-ani" type="checkbox" <?php if (in_array($fonction->settings_fonction_id, @$profile->settings_fonction_ids)): ?> checked="" <?php endif; ?>  name="settings_fonction_ids[]" value="<?= $fonction->settings_fonction_id ?>"> <?= $fonction->settings_fonction_name ?>
                                                            </label>
                                                       <?php endforeach; ?>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Date de début <span class="required">*</span></label>
                                                       <input type="text" class="form-control mask-date" placeholder="Date de prise de service" name="employe_date_deb" value="<?= mysql_to_date(@$profile->employe_date_deb) ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Date de fin </label>
                                                       <input type="text" class="form-control mask-date" placeholder="Date de fin de service" name="employe_date_fin" value="<?= mysql_to_date(@$profile->employe_date_fin) ?>">
                                                  </div>
                                                  <div class="form-group mb-3 col-12">
                                                       <label>Description de la fonction</label>
                                                       <input type="text" class="form-control" placeholder="Description .." name="employe_desc" value="<?= @$profile->employe_desc ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-12">
                                                       <label>Statut de l'employé</label>
                                                       <?php dropDown('SELECT employe_flag_id, employe_flag_label FROM employe_flags',array(
                                                            'name'=>'employe_flag_id',
                                                            'id'=>"employe_flag_id",
                                                            'class' => 'form-control selectpicker',
                                                            'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required',
                                                            'selected' => @$profile->employe_flag_id,
                                                       ));?>
                                                  </div>
                                                  <div class="form-group mb-3 col-12">
                                                       <label>Diplomes Obtenues (séparer par des virgules)</label>
                                                       <input type="text" class="form-control" placeholder="Liste des diplômes .." name="employe_diplome" value="<?= @$profile->employe_diplome ?>">
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="row clearfix">
               <div class="fixed-bottom mb-5 col-1 ml-auto">
                    <!-- <input type="hidden" name="password" id="password" value="<?= password_generator() ?>"> -->
                    <input type="hidden" name="personne_id" value="<?= @$profile->personne_id ?>">
                    <input type="hidden" name="user_id" value="<?= @$profile->user_id ?>">
                    <input type="hidden" name="employe_id" value="<?= @$profile->employe_id ?>">
                    <!-- <input type="hidden" name="is_profile" value="<?= @$is_profile ?>"> -->
                    <div class="col-1 offset-8 col-xxl-1 offset-xxl-9" style="position:fixed!important; z-index: 1030; margin-top: -550px;">
                         <button type="submit" class="btn btn-success btn-lg" title="submit"> <h1><span class="fa fa-check"></span></h1> </button>
                    </div>
               </div>
          </div>
     </form>

     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                         <div class="img-container">
                              <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                         <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    </div>
               </div>
          </div>
     </div>
</div>


<script>

document.getElementById("img-hover-centered").style.visibility = "hidden";

document.getElementById("img-hover").addEventListener("mouseover", function( event ) {
     document.getElementById("img-hover-centered").style.visibility = "visible";
}, false);

document.getElementById("img-hover").addEventListener("mouseout", function( event ) {
     document.getElementById("img-hover-centered").style.visibility = "hidden";
}, false);


window.addEventListener('DOMContentLoaded', function () {
     var avatar = document.getElementById('avatar');
     var image = document.getElementById('image');
     var input = document.getElementById('input');
     var $modal = $('#modal');
     var cropper;

     $('[data-toggle="tooltip"]').tooltip();

     input.addEventListener('change', function (e) {
          var files = e.target.files;
          var done = function (url) {
               input.value = '';
               image.src = url;
               $modal.modal('show');
          };
          var reader;
          var file;
          var url;

          if (files && files.length > 0) {
               file = files[0];

               if (URL) {
                    done(URL.createObjectURL(file));
               } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                         done(reader.result);
                    };
                    reader.readAsDataURL(file);
               }
          }
     });

     $modal.on('shown.bs.modal', function () {
          cropper = new Cropper(image, {
               aspectRatio: 1,
               viewMode: 2,
          });
     }).on('hidden.bs.modal', function () {
          cropper.destroy();
          cropper = null;
     });

     document.getElementById('crop').addEventListener('click', function () {
          var initialAvatarURL;
          var canvas;

          $modal.modal('hide');

          if (cropper) {
               canvas = cropper.getCroppedCanvas({
                    width: 350,
                    height: 350,
               });
               initialAvatarURL = avatar.src;
               avatar.src = canvas.toDataURL();

               $('#picture_data').html(
                    "<input type='hidden' name='photo' value='"+canvas.toDataURL()+"' >"
               );

               canvas.toBlob(function (blob) {
                    var formData = new FormData();

                    formData.append('avatar', blob, 'avatar.jpg');

               });
          }
     });
});

</script>
