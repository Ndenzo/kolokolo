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

<div class="container-fluid">
     <form class="validatedForm" method="post" action="<?= _url($module_base.'update') ?>" autocomplete="off" enctype="multipart/form-data">
          <div class="row clearfix">
               <div class="col-xl-8 box-col-12">
                    <div class="card">
                         <div class="card-body">
                              <h5 class="card-title">Your profile </h5>
                              <?php show_notification();?>
                              <div class="row">
                                   <div class="col-md-4 text-center">
                                        <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                             <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url(@$profile->person_picture); ?>" alt="No image" style="width: 200px; height: 200px;">
                                             <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                             <div id="picture_data"></div>
                                             <div id="img-hover-centered"><i data-feather="image"></i></div>
                                        </label>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Gender</label>
                                                  <?php dropDown('SELECT settings_gender_id, settings_gender_name FROM settings_genders', array(
                                                       'name'=>'person_gender_id',
                                                       'id'=>"settings_gender_id_form",
                                                       'class' => 'form-control select_custom',
                                                       'attr' => 'required',
                                                       'selected' => @$profile->person_gender_id,
                                                  ));?>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-7">
                                                       <label>First name</label>
                                                       <input type="text" class="form-control" placeholder="First name .." name="person_first_name" value="<?= @$profile->person_first_name ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-5">
                                                       <label>Last name</label>
                                                       <input type="text" class="form-control" placeholder="Last name .." name="person_last_name" value="<?= @$profile->person_last_name ?>" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-7">
                                                       <label>Birth place</label>
                                                       <input type="text" class="form-control" placeholder="Birth place .." name="person_birth_place" value="<?= @$profile->person_birth_place ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-5">
                                                       <label>Birth date</label>
                                                       <input type="date" class="form-control digits" name="person_birth_date" value="<?= @$profile->person_birth_date ?>" required>
                                                  </div>
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
                              <h5 class="card-title">Authentication </h5>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Your email and login</label>
                                                  <input type="text" class="form-control" placeholder="Email .." name="user_email" value="<?= @$profile->user_email ?>" required>
                                             </div>
                                             <div class="alert alert-warning inverse alert-dismissible fade show mt-2" role="alert"><i class="icon-bell"></i>
                                                  <p style="font-size: 12px;">
                                                       Only if you want to change your password !
                                                  </p>
                                                  <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                       <span aria-hidden="true">×</span>
                                                  </button>
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label>New password</label>
                                                  <input type="password" class="form-control" placeholder="Your password .." name="password" id="password">
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label>Rewrite new password</label>
                                                  <input type="password" class="form-control" placeholder="Rewrite your password .." name="password_confirm">
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
                              <h5 class="card-title">Contacts </h5>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Address</label>
                                                  <input type="text" class="form-control" placeholder="Address .." name="person_address" value="<?= @$profile->person_address ?>" required>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Country</label>
                                                       <?php dropDown('SELECT iso2, short_name FROM settings_countries',array(
                                                            'name'=>'person_country',
                                                            'id'=>"person_country_form",
                                                            'class' => 'form-control select_custom',
                                                            'selected' => @$profile->person_country,
                                                       ));?>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>City</label>
                                                       <input type="text" class="form-control" placeholder="City .." name="person_city" value="<?= @$profile->person_city ?>" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Phone number 1</label>
                                                       <input type="text" class="form-control" placeholder="Number 1 .." name="person_phone_1" value="<?= @$profile->person_phone_1 ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Phone number 2</label>
                                                       <input type="text" class="form-control" placeholder="Number 2 .." name="person_phone_2" value="<?= @$profile->person_phone_2 ?>" >
                                                  </div>
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
                              <h5 class="card-title">Configuration </h5>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Timezone</label>
                                                  <?php dropDown('SELECT settings_timezone_id, settings_timezone_name FROM settings_timezones',array(
                                                       'name'=>'settings_timezone_id',
                                                       'id'=>"settings_timezone_id_form",
                                                       'class' => 'form-control select_custom',
                                                       'attr' => 'required',
                                                       'selected' => @$profile->settings_timezone_id,
                                                  ));?>
                                             </div>
                                             <div class="alert alert-info inverse alert-dismissible fade show mt-2" role="alert"><i class="icon-info-alt"></i>
                                                  <p style="font-size: 12px;">
                                                       <?php $datetime = new DateTime(gmdate('Y-m-d H:i'), new DateTimeZone('Africa/Dakar')); ?>
                                                       <?php $datetime->setTimezone(new DateTimeZone(get_timezone()));  ?>
                                                       <b> Your time : </b> <?= $datetime->format('H:i') ?>
                                                  </p>
                                                  <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                       <span aria-hidden="true">×</span>
                                                  </button>
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
