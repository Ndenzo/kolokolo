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
     left: 50%;
     transform: translate(-50%, -50%);
}

</style>

<div class="container mb-5">
     <form class="validatedForm" method="post" action="<?= _url($module_base.'update') ?>" autocomplete="off" enctype="multipart/form-data">
          <div class="row clearfix">
               <div class="col-xl-8 box-col-12">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5><?= $this->lang->line('profile-header-profil') ?></h5>
                              </div>
                              <?php show_notification();?>
                              <div class="row">
                                   <div class="col-4 text-center">
                                        <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                             <?php if (@$profile->person_picture == null): ?>
                                                  <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url('assets/custom/img/default/boy.png') ?>" alt="No image"  style="width: 200px; height: 200px;">
                                             <?php else: ?>
                                                  <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url(@$profile->person_picture); ?>" alt="No image" style="width: 200px; height: 200px;">
                                             <?php endif; ?>
                                             <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                             <div id="picture_data"></div>
                                             <div id="img-hover-centered"><i data-feather="image"></i></div>
                                        </label>
                                   </div>
                                   <div class="col-8 mt-5">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label><?= $this->lang->line('profile-form-label-gender') ?></label>
                                                  <?php dropDown('SELECT settings_gender_id, settings_gender_name FROM settings_genders',array(
                                                       'name'=>'person_gender_id',
                                                       'id'=>"settings_gender_id_form",
                                                       'class' => 'form-control select_custom',
                                                       'attr' => 'required',
                                                       'selected' => @$profile->person_gender_id,
                                                  ));?>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-7">
                                                       <label><?= $this->lang->line('profile-form-label-firstName') ?></label>
                                                       <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-firstName') ?>" name="person_first_name" value="<?= @$profile->person_first_name ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-5">
                                                       <label><?= $this->lang->line('profile-form-label-lastName') ?></label>
                                                       <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-lastName') ?>" name="person_last_name" value="<?= @$profile->person_last_name ?>" required>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-12">
                                        <div class="row">
                                             <div class="form-group mb-3 col-7">
                                                  <label><?= $this->lang->line('profile-form-label-birthPlace') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-birthPlace') ?>" name="person_birth_place" value="<?= @$profile->person_birth_place ?>" required>
                                             </div>
                                             <div class="form-group mb-3 col-5">
                                                  <label><?= $this->lang->line('profile-form-label-birthDate') ?></label>
                                                  <input type="date" class="form-control digits" name="person_birth_date" value="<?= @$profile->person_birth_date ?>" required>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="form-group mb-3 col-7">
                                                  <label><?= $this->lang->line('profile-form-label-profession') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-profession') ?>" name="investor_profession" value="<?= @$profile->investor_profession ?>" required>
                                             </div>
                                             <div class="form-group mb-3 col-5">
                                                  <label><?= $this->lang->line('profile-form-label-sector') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-sector') ?>" name="investor_sector" value="<?= @$profile->investor_sector ?>" required>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-xl-4 box-col-12">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5><?= $this->lang->line('profile-header-auth') ?> </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label><?= $this->lang->line('profile-form-label-login') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-login') ?>" name="user_email" value="<?= @$profile->user_email ?>" required>
                                             </div>
                                             <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                                  <p class="mt-2" style="font-size: 12px;">
                                                       <?= $this->lang->line('profile-message-password') ?>
                                                  </p>
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label><?= $this->lang->line('profile-form-label-password') ?></label>
                                                  <input type="password" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-password') ?>" name="password" id="password">
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label><?= $this->lang->line('profile-form-label-passwordConfirm') ?></label>
                                                  <input type="password" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-passwordConfirm') ?>" name="password_confirm">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="row clearfix mt-5">
               <div class="col-xl-8 box-col-12">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5><?= $this->lang->line('profile-header-contact') ?> </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label><?= $this->lang->line('profile-form-label-address') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-address') ?>" name="person_address" value="<?= @$profile->person_address ?>" required>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= $this->lang->line('profile-form-label-country') ?></label>
                                                       <?php dropDown('SELECT iso2, short_name FROM settings_countries',array(
                                                            'name'=>'person_country',
                                                            'id'=>"person_country_form",
                                                            'class' => 'form-control select_custom',
                                                            'selected' => @$profile->person_country,
                                                       ));?>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= $this->lang->line('profile-form-label-city') ?></label>
                                                       <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-city') ?>" name="person_city" value="<?= @$profile->person_city ?>" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= $this->lang->line('profile-form-label-phone1') ?></label>
                                                       <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                 <select name="person_country_phone_1"></select>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-phone1') ?>" name="person_phone_1" value="<?= @$profile->person_phone_1 ?>" required>
                                                       </div>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= $this->lang->line('profile-form-label-phone2') ?></label>
                                                       <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                 <select name="person_country_phone_2"></select>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-phone2') ?>" name="person_phone_2" value="<?= @$profile->person_phone_2 ?>" >
                                                       </div>
                                                  </div>
                                             </div>
                                             <!-- <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= $this->lang->line('profile-form-label-phone1') ?></label>
                                                       <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-phone1') ?>" name="person_phone_1" value="<?= @$profile->person_phone_1 ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= $this->lang->line('profile-form-label-phone2') ?></label>
                                                       <input type="text" class="form-control" placeholder="<?= $this->lang->line('profile-form-placeholder-phone2') ?>" name="person_phone_2" value="<?= @$profile->person_phone_2 ?>" >
                                                  </div>
                                             </div> -->
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-xl-4 box-col-12">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5><?= $this->lang->line('profile-header-config') ?> </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label><?= $this->lang->line('profile-form-label-timezone') ?></label>
                                                  <?php dropDown('SELECT settings_timezone_id, settings_timezone_name FROM settings_timezones',array(
                                                       'name'=>'settings_timezone_id',
                                                       'id'=>"settings_timezone_id_form",
                                                       'class' => 'form-control select_custom',
                                                       'attr' => 'required',
                                                       'selected' => @$profile->settings_timezone_id,
                                                  ));?>
                                             </div>
                                             <div class="alert alert-info inverse alert-dismissible fade show" role="alert">
                                                  <p class="mt-2" style="font-size: 12px;">
                                                       <?php $datetime = new DateTime(gmdate('Y-m-d H:i'), new DateTimeZone('Africa/Dakar')); ?>
                                                       <?php $datetime->setTimezone(new DateTimeZone(get_timezone()));  ?>
                                                       <b> <?= $this->lang->line('profile-message-timezone') ?> : </b> <?= $datetime->format('H:i') ?>
                                                  </p>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="fixed-bottom mb-5 col-1 ml-auto">
                    <input type="hidden" name="person_id" value="<?= @$profile->person_id ?>">
                    <input type="hidden" name="user_id" value="<?= @$profile->user_id ?>">
                    <input type="hidden" name="is_profile" value="<?= @$is_profile ?>">
                    <button type="submit" class="btn btn-success btn-lg" title="submit"> <h1><span class="fa fa-check"></span></h1> </button>
               </div>
          </div>
     </form>
     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
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

$('document').ready(function() {
     $('#settings-trigger').hide();
});

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


(function($) {
     $(function() {
          var isoCountries1 = [
               <?php if (is_array(get_countries())): ?>
               {
                    id : '',
                    text : '',
               },
               <?php foreach (get_countries() as $key => $country): ?>
               {
                    id : '<?= $country->iso2 ?>',
                    text : '+<?= $country->calling_code ?>',
                    <?php if ($profile->person_country_phone_1 == $country->iso2 ): ?>
                    selected : true
                    <?php endif; ?>

               },
               <?php endforeach; ?>
               <?php endif; ?>
          ];

          var isoCountries2 = [
               <?php if (is_array(get_countries())): ?>
               {
                    id : '',
                    text : '',
               },
               <?php foreach (get_countries() as $key => $country): ?>
               {
                    id : '<?= $country->iso2 ?>',
                    text : '+<?= $country->calling_code ?>',
                    <?php if ($profile->person_country_phone_2 == $country->iso2 ): ?>
                    selected : true
                    <?php endif; ?>

               },
               <?php endforeach; ?>
               <?php endif; ?>
          ];



          function formatCountry (country) {
               if (!country.id) { return country.text; }
               var $country = $(
                    '<span class="flag-icon flag-icon-'+ country.id.toLowerCase() +' flag-icon-squared"></span>' +
                    '<span class="flag-text pl-2">  '+ country.text+"</span>"
               );
               return $country;
          };

          //Assuming you have a select element with name country
          // e.g. <select name="name"></select>

          $("[name='person_country_phone_1']").select2({
               placeholder: "Select a country",
               templateResult: formatCountry,
               data: isoCountries1
          });

          $("[name='person_country_phone_2']").select2({
               placeholder: "Select a country",
               templateResult: formatCountry,
               data: isoCountries2
          });

     });
})(jQuery);

</script>
