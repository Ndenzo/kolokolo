<div class="row">
     <div class="col-12">
          <div class="mb-3">
               <h1>Stream</h1>
               <div class="text-zero top-right-button-container">
                    <a href="#custom-modal" class="btn btn-success btn-lg top-right-button mr-1" data-toggle="modal">ADD NEW</a>
               </div>
               <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                         <li class="breadcrumb-item">
                              <a href="#">Home</a>
                         </li>
                         <li class="breadcrumb-item active" aria-current="page">Stream</li>
                    </ol>
               </nav>
          </div>

          <div class="mb-2">
               <div class="collapse d-md-block" id="displayOptions">
                    <div class="d-block d-md-inline-block">
                         <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                              <input placeholder="Search...">
                         </div>
                    </div>
                    <div class="float-md-right">
                         <span class="text-muted text-small">Displaying 1-10 of 210 items </span>
                         <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              20
                         </button>
                         <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">10</a>
                              <a class="dropdown-item active" href="#">20</a>
                              <a class="dropdown-item" href="#">30</a>
                              <a class="dropdown-item" href="#">50</a>
                              <a class="dropdown-item" href="#">100</a>
                         </div>
                    </div>
               </div>
          </div>
          <div class="separator mb-5"></div>
     </div>
</div>
<?php show_notification();?>
<div class="row list disable-text-selection" data-check-all="checkAll">
     <?php if(is_array(@$datagrid)):?>
          <?php foreach(@$datagrid as $key => $row):?>
               <div class="col-xl-2 col-lg-2 col-4 col-sm-3 mb-4">
                    <div class="card">
                         <div class="position-relative">
                              <img class="card-img-top" src="<?= _url(@$row->stream_picture) ?>" alt="stream image">
                         </div>
                         <div class="card-body text-center">
                              <h5 class="mb-3 listing-heading ellipsis" style="font-weight:bold;">
                                   <?= @$row->stream_name?>
                              </h5>

                              <footer class="text-center mt-3">
                                   <a href="<?= @$row->stream_link?>" class="btn btn-sm default btn-info" target="_blank"><i class="fa fa-play"></i></a>
                                   <a href="#custom-update-modal" class="btn btn-sm default btn-warning" data-toggle="modal" onclick="define_edit(<?= $row->stream_id ?>, 'stream/stream/showEdit')"><i class="fa fa-pencil"></i></a>
                                   <a href="#custom-delete-modal" class="btn btn-sm default btn-danger" data-toggle="modal" onclick="define_delete(<?= $row->stream_id ?>, 'stream_id')"><i class="fa fa-trash"></i></a>
                              </footer>
                         </div>
                    </div>
               </div>
          <?php endforeach;?>
     <?php endif;?>
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->


<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Ajouter stream</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center validatedForm" action="<?php _url($module_base.'insert'); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                         <div class="col-10 col-md-12 mt-50">
                              <label class="label row" data-toggle="tooltip" title="Change your avatar">
                                   <img class="ml-auto mr-auto" id="avatar" src="<?= _url('assets/custom/img/default/photo.png') ?>" alt="avatar" style="width: 200px;">
                                   <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                   <div id="picture_data"></div>
                              </label>
                              <div class="form-group mb-3">
                                   <label>stream name</label>
                                   <input type="text" class="form-control" placeholder="Name .." name="stream_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>stream link</label>
                                   <input type="text" class="form-control" placeholder="Link .." name="stream_link" required>
                              </div>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-success col-md-4">insert</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Edit stream</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <label class="label row" data-toggle="tooltip" title="Change your avatar">
                                   <img class="ml-auto mr-auto" id="stream_picture" src="<?= _url('assets/custom/img/default/photo.png') ?>" alt="avatar" style="width: 200px;">
                                   <input type="file" class="sr-only" id="input_edit" name="picture" accept="image/*">
                                   <div id="picture_data_edit"></div>
                              </label>
                              <div class="form-group mb-3">
                                   <label>stream name</label>
                                   <input type="text" class="form-control" placeholder="Code.." name="stream_name" id="stream_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>stream link</label>
                                   <input type="text" class="form-control" placeholder="Name.." name="stream_link" id="stream_link" required>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="stream_id" id="stream_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Update</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Delete stream</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   The selected element will be permanently deleted. <br>
                                   Do you want to continue this operation?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="stream_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

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

<script>
window.addEventListener('DOMContentLoaded', function () {
     var avatar = document.getElementById('avatar');
     var stream_picture = document.getElementById('stream_picture');
     var image = document.getElementById('image');
     var input = document.getElementById('input');
     var input_edit = document.getElementById('input_edit');
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

     input_edit.addEventListener('change', function (e) {
          var files = e.target.files;
          var done = function (url) {
               input_edit.value = '';
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
          var initialstream_pictureURL;
          var canvas;

          $modal.modal('hide');

          if (cropper) {
               canvas = cropper.getCroppedCanvas({
                    width: 512,
                    height: 512,
               });
               initialAvatarURL = avatar.src;
               avatar.src = canvas.toDataURL();

               initialstream_pictureURL = stream_picture.src;
               stream_picture.src = canvas.toDataURL();

               $('#picture_data').html(
                    "<input type='hidden' name='photo' value='"+canvas.toDataURL()+"' >"
               );

               $('#picture_data_edit').html(
                    "<input type='hidden' name='photo' value='"+canvas.toDataURL()+"' >"
               );

               canvas.toBlob(function (blob) {
                    var formData = new FormData();

                    formData.append('avatar', blob, 'avatar.jpg');

                    formData.append('stream_picture', blob, 'avatar.jpg');

               });
          }
     });
});
</script>
