var cpt_time = 0;
var cpt_schedule = 0;

var schedule_max = $('#schedule_value').attr('max');

(function($) {
     'use strict';
     /*Quill editor*/
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

     if ($("#quillEditor").length) {

          $('#quillEditor').html($('#project_desc').val());

          var quill = new Quill('#quillEditor', {
               modules: {
                    toolbar: toolbarOptions
               },
               placeholder: 'Description du projet ...',
               theme: 'snow' // or 'bubble'
          });
     }

     $.fn.imagePicker = function( options ) {

          // Define plugin options
          var settings = $.extend({
               // Input name attribute
               name: "",
               // Classes for styling the input
               class: "form-control btn btn-default btn-block",
               // Icon which displays in center of input
               icon: "fa fa-plus"
          }, options );

          // Create an input inside each matched element
          return this.each(function() {
               $(this).html(create_btn(this, settings));
          });

     };

     // Private function for creating the input element
     function create_btn(that, settings) {
          // The input icon element
          var picker_btn_icon = $('<i class="'+settings.icon+'"></i>');

          // The actual file input which stays hidden
          var picker_btn_input = $('<input type="file" name="'+settings.name+'" />');

          // The actual element displayed
          var picker_btn = $('<div class="'+settings.class+' img-upload-btn"></div>')
          .append(picker_btn_icon)
          .append(picker_btn_input);

          // File load listener
          picker_btn_input.change(function() {
               if ($(this).prop('files')[0]) {
                    // Use FileReader to get file
                    var reader = new FileReader();

                    // Create a preview once image has loaded
                    reader.onload = function(e) {
                         var preview = create_preview(that, e.target.result, settings);
                         $(that).html(preview);
                    }

                    // Load image
                    reader.readAsDataURL(picker_btn_input.prop('files')[0]);
               }
          });

          return picker_btn
     };

     // Private function for creating a preview element
     function create_preview(that, src, settings) {

          // The preview image
          var picker_preview_image = $('<img src="'+src+'" class="img-responsive img-rounded col-12"/><input type="hidden" name="photos[]" value="'+src+'"/>');

          // The remove image button
          var picker_preview_remove = $('<button class="btn btn-link"><small>Remove</small></button>');

          // The preview element
          var picker_preview = $('<div class="text-center"></div>')
          .append(picker_preview_image)
          .append(picker_preview_remove);

          // Remove image listener
          picker_preview_remove.click(function() {
               var btn = create_btn(that, settings);
               $(that).html(btn);
          });

          return picker_preview;
     };
})(jQuery);

$(document).ready(function() {
     $('.img-picker').imagePicker({name: 'images'});

     $('#img_picker_add').on('click', function () {
          extend_img_picker();
          $('.img-picker').imagePicker({name: 'images'});
     })

     $('#timeline_form').on('submit', function(e){
          e.preventDefault();
          extend_timeline();
     });

     $('#schedule_form').on('submit', function(e){
          e.preventDefault();
          extend_schedule();
     });

     $("#form_project").on("submit",function(){
          $("#project_desc").val($("#quillEditor").html());
     })
})

function extend_img_picker(){
     var content = '<div class="form-group col-sm-4"><div class="img-picker"></div></div><div id="img_picker_extension"></div>';
     $('#img_picker_extension').replaceWith(content);
}

function extend_timeline(){
     var content = '';
     content = '<tr id="timeline_'+cpt_time+'">'+

     '<td class="text-left">'+
     $('#timeline_name').val()+
     '<input type="hidden" name="project_timeline_names[]" value="'+$('#timeline_name').val()+'">'+
     '</td>'+

     '<td class="text-center">'+
     $('#timeline_month').val()+'/'+
     $('#timeline_year').val()+
     '<input type="hidden" name="project_timeline_months[]" value="'+$('#timeline_month').val()+'">'+
     '<input type="hidden" name="project_timeline_years[]" value="'+$('#timeline_year').val()+'">'+
     '</td>'+

     '<td class="text-center">'+
     '<button class="btn btn-sm btn-outline-danger" onclick="javascript:timeline_destroy('+cpt_time+')"><i class="fa fa-trash"></i></button>'+
     '</td>'+

     '</tr>'+

     '<tr id="timeline_extension"></tr>';
     $('#timeline_extension').replaceWith(content);

     cpt_time++;

     content = undefined;

     document.getElementById("timeline_form").reset();
}

function extend_schedule(){
     if(parseInt($('#schedule_value').val()) <= parseInt(schedule_max) && $('#schedule_value').val() != "") {
          var content = "";

          content = '<tr id="schedule_'+cpt_schedule+'">'+

          '<td class="text-left">'+
          $('#schedule_name').val()+
          '<input type="hidden" name="project_schedule_names[]" value="'+$('#schedule_name').val()+'">'+
          '</td>'+

          '<td class="text-center">'+
          $('#schedule_value').val()+
          '<input type="hidden" name="project_schedule_values[]" value="'+$('#schedule_value').val()+'">'+
          '</td>'+

          '<td class="text-center">'+
          '<button class="btn btn-sm btn-outline-danger" onclick="javascript:schedule_destroy('+cpt_schedule+')"><i class="fa fa-trash"></i></button>'+
          '</td>'+

          '</tr>'+

          '<tr id="schedules_extension"></tr>';

          $('#schedules_extension').replaceWith(content);

          cpt_schedule++;

          content = undefined;

          schedule_max = parseInt(schedule_max) - parseInt($('#schedule_value').val());
          $("#schedule_value").attr("max",schedule_max);

          document.getElementById("schedule_form").reset();
     }else{
          alert("yo");
     }
}

function timeline_destroy(id){
     $("#timeline_"+id).remove();
}

function schedule_destroy(id){
     schedule_max = parseInt(schedule_max) + parseInt($('#project_schedule_value_'+id).val());
     if(schedule_max != 0){
          $("#schedule_value").attr("max", schedule_max);
          $("#schedule_value").attr("disabled", false);
     }else{
          $("#schedule_value").attr("disabled", true);
     }

     $("#schedule_"+id).remove();
}
