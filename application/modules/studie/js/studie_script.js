var content_id = 1;
var tmp = '<center id="content_tmp" class="mt-30">'+$('#content_tmp').html()+'</center>';
var toolbarOptions = [
     [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
     [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

     ['bold', 'italic', 'underline', 'strike'],

     [{ 'list': 'ordered'}, { 'list': 'bullet' }],

     [{ 'indent': '-1'}, { 'indent': '+1' }],

     [{ 'font': [] }],
     [{ 'align': [] }],

     ['image'],
];

$(document).ready(function() {
     $('#text_adder').on('click', function (e) {
          e.preventDefault();
          extend_content_txt();
     });

     $('#image_adder').on('click', function (e) {
          e.preventDefault();
          extend_content_img();
     });
})

function extend_content_txt(){
     var id = content_id;
     var content = '<div id="content_'+id+'" class="mt-30">'+
     '<a href="javascript:delete_content('+id+');" class="btn btn-danger">Remove</a>'+

     '<ul class="nav nav-pills nav-pills-custom mt-3" id="pills'+id+'-tab-custom" role="tablist">'+
     '<li class="nav-item">'+
     '<a class="nav-link active" id="pills'+id+'-fr-tab-custom" data-toggle="pill" href="#pills'+id+'-fr" role="tab" aria-controls="pills-'+id+'fr" aria-selected="true">'+
     $("#pills-fr-tab-custom").html()+
     '</a>'+
     '</li>'+
     '<li class="nav-item">'+
     '<a class="nav-link" id="pills'+id+'-gb-tab-custom" data-toggle="pill" href="#pills'+id+'-gb" role="tab" aria-controls="pills'+id+'-gb" aria-selected="false">'+
     $("#pills-gb-tab-custom").html()+
     '</a>'+
     '</li>'+
     '</ul>'+

     '<div class="tab-content tab-content-custom-pill" id="pills'+id+'-tabContent-custom" style="margin-top:-30px;">'+
     '<div class="tab-pane fade show active" id="pills'+id+'-fr" role="tabpanel" aria-labelledby="pills'+id+'-fr-tab-custom">'+
     '<div id="quillEditor_'+id+'" class="quill-container col-12" style="height:250px;"></div>'+
     '<textarea class="d-none" name="studie_content_'+id+'" id="studie_content_'+id+'"></textarea>'+
     '<input type="hidden" name="studie_content_types[]" value="1"/>'+
     '<input type="hidden" name="content_ids[]" value="'+id+'"/>'+
     '</div>'+
     '<div class="tab-pane fade" id="pills'+id+'-gb" role="tabpanel" aria-labelledby="pills'+id+'-gb-tab-custom">'+
     '<div id="quillEditor_'+id+'_gb" class="quill-container col-12" style="height:250px;"></div>'+
     '<textarea class="d-none" name="studie_content_'+id+'_gb" id="studie_content_'+id+'_gb"></textarea>'+
     '</div>'+
     '</div>'+

     '</div>' + tmp;

     $('#content_tmp').replaceWith(content);

     if ($("#quillEditor_"+id).length) {

          var quill = new Quill('#quillEditor_'+id, {
               modules: {
                    toolbar: toolbarOptions
               },
               placeholder: 'Description du contenue ...',
               theme: 'snow' // or 'bubble'
          });

          var quill = new Quill('#quillEditor_'+id+'_gb', {
               modules: {
                    toolbar: toolbarOptions
               },
               placeholder: 'Description du contenue ...',
               theme: 'snow' // or 'bubble'
          });

          $("#form_studie").on("submit",function(){
               $("#studie_content_"+id).val($("#quillEditor_"+id).html());
               $("#studie_content_"+id+"_gb").val($("#quillEditor_"+id+"_gb").html());
          });
     }

     $('#text_adder').on('click', function (e) {
          e.preventDefault();
          extend_content_txt();
     });

     $('#image_adder').on('click', function (e) {
          e.preventDefault();
          extend_content_img();
     });

     content_id++;
}

function extend_content_img(){
     var id = content_id;
     var content = '<div id="content_'+id+'" class="mt-30">'+
     '<a href="javascript:delete_content('+id+');" class="btn btn-danger">Remove</a>'+
     // '<div class="custom-file mb-3">'+
     // '<input type="file" class="custom-file-input" id="studie_content_'+id+'" name="studie_content_'+id+'">'+
     // '<label class="custom-file-label" for="customFile">Choose file</label>'+
     // '</div>'+
     '<input type="file" class="dropify" name="studie_content_'+id+'"  id="studie_content_'+id+'" required/>'+
     '<input type="hidden" name="studie_content_types[]" value="2"/>'+
     '<input type="hidden" name="content_ids[]" value="'+id+'"/>'+
     '</div>' + tmp;

     $('#content_tmp').replaceWith(content);

     $("#studie_content_"+id).dropify();

     $('#text_adder').on('click', function (e) {
          e.preventDefault();
          extend_content_txt();
     });

     $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
     });

     $('#image_adder').on('click', function (e) {
          e.preventDefault();
          extend_content_img();
     });

     content_id++;
}

function delete_content(id){
     $('#content_'+id).remove();
}
