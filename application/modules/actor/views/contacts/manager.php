<style>
.img-container img {
     max-width: 100%;
}
.option-btn{
     max-width: 40px!important;
     margin: 5px!important;
}
</style>

<div class="row mb-5">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h4 class="col-7 font-weight-bold text-uppercase"><?= $this->lang->line('contact-title') ?> </h4>
                         <div class="col-5">
                              <a href="#custom-modal"  class="btn btn-success btn-icon-text float-right btn-lg" data-toggle="modal"><?= $this->lang->line('btn-add') ?> <i class="fa fa-plus btn-icon-append"> </i></a>
                         </div>
                    </div>

                    <?php show_notification();?>

                    <div class="table-responsive">
                         <table id="order-listing" class="table table-striped table-bordered">
                              <thead>
                                   <tr>
                                        <th class="text-center" style="width:30px;">#</th>
                                        <th><?= $this->lang->line('contact-table-label-contact') ?></th>
                                        <th><?= $this->lang->line('contact-table-label-email') ?></th>
                                        <th><?= $this->lang->line('contact-table-label-phone') ?></th>
                                        <th><?= $this->lang->line('contact-table-label-statut') ?></th>
                                        <th class="text-center" style="width: 70px;"><?= $this->lang->line('contact-table-label-action') ?></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $key => $rows):?>
                                             <tr>
                                                  <td class="text-center"><?=@$key+1?></td>
                                                  <td>
                                                       <div class="d-flex">
                                                            <div class="mr-3">
                                                                 <?php if (@$rows->contact_image == null): ?>
                                                                      <div class="user-symbols bg-warning text-uppercase">
                                                                           <?= substr(@$rows->contact_fullname, 0, 1); ?>
                                                                      </div>
                                                                 <?php else: ?>
                                                                      <img class="img-sm rounded-circle mb-md-0 mr-2" src="<?= _url(@$rows->contact_image) ?>" alt="profile image">
                                                                 <?php endif; ?>
                                                            </div>
                                                            <div>
                                                                 <?= @$rows->contact_fullname ?>
                                                                 <div class="text-muted"><?= (@me('user_lang') == "english") ? @$rows->contact_function_gb : @$rows->contact_function ?></div>
                                                            </div>
                                                       </div>
                                                  </td>
                                                  <td><?= @$rows->contact_email ?></td>
                                                  <td>
                                                       +<?= id_getter('calling_code','settings_countries','iso2', @$rows->contact_country_num) ?> <?= @$rows->contact_num ?>
                                                  </td>
                                                  <td>
                                                       <?php if (@$rows->contact_locked == 0): ?>
                                                            <span class="badge badge-success"><?= $this->lang->line('contact-badge-active') ?></span>
                                                       <?php else: ?>
                                                            <span class="badge badge-warning"><?= $this->lang->line('contact-badge-inactive') ?></span>
                                                       <?php endif; ?>
                                                  </td>
                                                  <td class="footable-last-visible text-center">
                                                       <div class="dropdown dropleft">
                                                            <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                 <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                            </button>
                                                            <div class="dropdown-menu"  data-x-placement="left-start">
                                                                 <?php if ($rows->contact_locked != 0): ?>
                                                                      <a href="#custom-lock-modal-<?= @$rows->contact_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-unlock mr-2"></i> <?= $this->lang->line('btn-unlock') ?></a>
                                                                      <div class="dropdown-divider"></div>
                                                                 <?php else: ?>
                                                                      <a href="#custom-lock-modal-<?= @$rows->contact_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-lock mr-2"></i> <?= $this->lang->line('btn-lock') ?></a>
                                                                      <div class="dropdown-divider"></div>
                                                                 <?php endif; ?>
                                                                 <a href="#custom-update-modal" class="text-warning dropdown-item" data-toggle="modal" onclick="define_edit(<?= @$rows->contact_id ?>, 'actor/contact/showEdit')"><i class="fa fa-pencil mr-2"></i> <?= $this->lang->line('btn-edit') ?></a>
                                                                 <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->contact_id ?>, 'contact_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                            </div>
                                                       </div>
                                                  </td>
                                                  <div id="custom-lock-modal-<?= @$rows->contact_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                       <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                 <div class="modal-header">
                                                                      <h4 class="modal-title" id="myCenterModalLabel">
                                                                           <?php if ($rows->contact_locked != 0): ?>
                                                                                <?= $this->lang->line('contact-header-unlock') ?> | <?=$rows->contact_fullname?>
                                                                           <?php else: ?>
                                                                                <?= $this->lang->line('contact-header-lock') ?> | <?=$rows->contact_fullname?>
                                                                           <?php endif; ?>
                                                                      </h4>
                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                      <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">
                                                                           <div class="col-12 mt-3">
                                                                                <p style="text-align: center; font-size: 14px;">
                                                                                     <?= $this->lang->line('contact-message-update') ?>
                                                                                </p>
                                                                                <div class="modal-footer mt-3">
                                                                                     <?php if ($rows->contact_locked != 0): ?>
                                                                                          <input type="hidden" type="text" name="contact_locked" value="0">
                                                                                     <?php else: ?>
                                                                                          <input type="hidden" type="text" name="contact_locked" value="1">
                                                                                     <?php endif; ?>
                                                                                     <input type="hidden" type="text" name="contact_id" value="<?= @$rows->contact_id ?>">
                                                                                     <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                     <button type="submit" class="btn btn-info col-md-4">
                                                                                          <?php if ($rows->contact_locked != 0): ?>
                                                                                               <?= $this->lang->line('btn-unlock') ?>
                                                                                          <?php else: ?>
                                                                                               <?= $this->lang->line('btn-lock') ?>
                                                                                          <?php endif; ?>
                                                                                     </button>
                                                                                </div>
                                                                           </div>
                                                                      </form>
                                                                 </div>
                                                            </div><!-- /.modal-content -->
                                                       </div><!-- /.modal-dialog -->
                                                  </div>
                                             </tr>
                                        <?php endforeach;?>
                                   <?php endif;?>
                              </tbody>
                         </table>
                    </div>

               </div>
          </div>
     </div>
</div>

<!-- Add manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true" style="overflow-y: auto;">
     <div class="modal-dialog" style="max-width: 45%!important;">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel"><?= $this->lang->line('contact-header-new') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <form class="justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">

                    <div class="modal-body">
                         <div class="col-12 mt-3">
                              <center class="form-group">
                                   <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                        <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url('assets/custom/img/default/default.png') ?>" alt="No image"  style="height: 200px;">

                                        <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                        <div id="picture_data"></div>
                                        <div id="img-hover-centered"><i data-feather="image"></i></div>
                                   </label>
                              </center>
                              <div class="row mt-20">
                                   <div class="col-12 mb-3">
                                        <label><?= $this->lang->line('contact-form-label-fullname') ?> <span class="needed">*</span></label>
                                        <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-fullname') ?>" name="contact_fullname" required>
                                   </div>
                              </div>
                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-tab-custom" data-toggle="pill" href="#pills-fr" role="tab" aria-controls="pills-fr" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-tab-custom" data-toggle="pill" href="#pills-gb" role="tab" aria-controls="pills-gb" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr" role="tabpanel" aria-labelledby="pills-fr-tab-custom">
                                             <label><?= $this->lang->line('contact-form-label-function') ?> <span class="needed">*</span></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-function') ?>" name="contact_function" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                             <label><?= $this->lang->line('contact-form-label-function') ?> <span class="needed">*</span></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-function') ?>" name="contact_function_gb" required>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="form-group mb-3 col-7">
                                        <label><?= $this->lang->line('contact-form-label-email') ?> <span class="needed">*</span></label>
                                        <input type="email" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-email') ?>" name="contact_email" required>
                                   </div>
                                   <div class="form-group mb-3 col-5">
                                        <label><?= $this->lang->line('contact-form-label-phone') ?></label>
                                        <div class="input-group">
                                             <div class="input-group-prepend">
                                                  <select name="contact_country_num"></select>
                                             </div>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-phone') ?>" name="contact_num" >
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="modal-footer col-12">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-success col-md-4"><?= $this->lang->line('btn-save') ?></button>
                    </div>

               </form>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true" style="overflow-y: auto;">
     <div class="modal-dialog" style="max-width: 45%!important;">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1"><?= $this->lang->line('contact-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <form class="justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">

                    <div class="modal-body">
                         <div class="col-12 mt-3">
                              <center class="form-group">
                                   <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                        <img class="rounded ml-auto mr-auto" id="contact_image"  src="<?= _url('assets/custom/img/default/default.png') ?>" alt="No image"  style="height: 200px;">

                                        <input type="file" class="sr-only" id="input_edit" name="picture" accept="image/*">
                                        <div id="picture_data_edit"></div>
                                   </label>
                              </center>
                              <div class="row mt-20">
                                   <div class="col-12 mb-3">
                                        <label><?= $this->lang->line('contact-form-label-fullname') ?> <span class="needed">*</span></label>
                                        <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-fullname') ?>" name="contact_fullname" id="contact_fullname" required>
                                   </div>
                              </div>
                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-edit-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-edit-fr-tab-custom" data-toggle="pill" href="#pills-edit-fr" role="tab" aria-controls="pills-edit-fr" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-edit-gb-tab-custom" data-toggle="pill" href="#pills-edit-gb" role="tab" aria-controls="pills-edit-gb" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-edit-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-edit-fr" role="tabpanel" aria-labelledby="pills-fr-tab-custom">
                                             <label><?= $this->lang->line('contact-form-label-function') ?> <span class="needed">*</span></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-function') ?>" name="contact_function" id="contact_function" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-edit-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                             <label><?= $this->lang->line('contact-form-label-function') ?> <span class="needed">*</span></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-function') ?>" name="contact_function_gb" id="contact_function_gb" required>
                                        </div>
                                   </div>

                              </div>
                              <div class="row">
                                   <div class="form-group mb-3 col-7">
                                        <label><?= $this->lang->line('contact-form-label-email') ?> <span class="needed">*</span></label>
                                        <input type="email" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-email') ?>" name="contact_email" id="contact_email" required>
                                   </div>
                                   <div class="form-group mb-3 col-5">
                                        <label><?= $this->lang->line('contact-form-label-phone') ?></label>
                                        <div class="input-group">
                                             <div class="input-group-prepend">
                                                  <select class="select_custom" name="contact_country_num" id="contact_country_num"></select>
                                             </div>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('contact-form-placeholder-phone') ?>" name="contact_num" id="contact_num">
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="modal-footer col-12">
                         <input type="hidden" name="contact_id" id="contact_id">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-warning col-md-4"><?= $this->lang->line('btn-edit') ?></button>
                    </div>

               </form>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('contact-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>

               <form class="justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post">

                    <div class="modal-body">
                         <div class="col-12 mt-3 mb-3">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('contact-message-delete') ?>
                              </p>
                         </div>
                    </div>

                    <div class="modal-footer col-12">
                         <input type="hidden" type="text" name="contact_id">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                    </div>

               </form>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: auto;">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><?= $this->lang->line('contact-header-crop') ?></h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                    <button type="button" class="btn btn-primary" id="crop"><?= $this->lang->line('btn-crop') ?></button>
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

$( document ).ready(function() {

     $('#custom-modal').on('shown.bs.modal', function (e) {

          var image = document.getElementById('image');
          var avatar = document.getElementById('avatar');
          var input = document.getElementById('input');

          input.addEventListener('change', function (e) {
               var files = e.target.files;
               var done = function (url) {
                    input.value = '';
                    image.src = url;
                    $modal.modal('show');

                    $('#custom-modal').modal('hide');

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

          var $modal = $('#modal');
          var cropper;

          $('[data-toggle="tooltip"]').tooltip();

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

               $('#custom-modal').modal('show');

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
     })

     $('#custom-update-modal').on('shown.bs.modal', function (e) {

          var image = document.getElementById('image');
          var avatar = document.getElementById('contact_image');
          var input = document.getElementById('input_edit');

          input.addEventListener('change', function (e) {
               var files = e.target.files;
               var done = function (url) {
                    input.value = '';
                    image.src = url;
                    $modal.modal('show');

                    $('#custom-update-modal').modal('hide');

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

          var $modal = $('#modal');
          var cropper;

          $('[data-toggle="tooltip"]').tooltip();

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

               $('#custom-update-modal').modal('show');

               if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                         width: 350,
                         height: 350,
                    });
                    initialAvatarURL = avatar.src;
                    avatar.src = canvas.toDataURL();

                    $('#picture_data_edit').html(
                         "<input type='hidden' name='photo' value='"+canvas.toDataURL()+"' >"
                    );
                    canvas.toBlob(function (blob) {
                         var formData = new FormData();
                         formData.append('contact_image', blob, 'avatar.jpg');
                    });

               }
          });
     })

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

          $("[name='contact_country_num']").select2({
               placeholder: "Select a country",
               templateResult: formatCountry,
               data: isoCountries1
          });

     });
})(jQuery);

</script>
