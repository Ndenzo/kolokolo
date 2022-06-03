$(document).ready(function() {

     $("input.mask-date").inputmask("d/m/y", {});
     $("input.mask-phone").inputmask({"mask":"99-999-99-99"});
     $("input.mask-phone-sn").inputmask({"mask":"99-999-99-99"});
     $("input.mask-phone-ci").inputmask({"mask":"99-99-99-99"});
} );

check_online();

function define_delete(id, input){
     $("input[name="+input+"]").val(id);
}

function define_custom(id, input, max){
     $("input[name="+input+"]").val(id);
     $("#encaissement_value").attr({"max" : max});
}

function define_edit(id, link){
     $.post(BASE_URL + link+"/"+id)
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('header')) {
               $.each( obj.header, function (index){
                    var column = obj.header[index];
                    console.log(obj.record);
                    if ($("#"+column).is("input")) {
                         if($("#"+column).is("input[type=file]")){
                              var nameImage =  BASE_URL+obj.record[column];
                              $("#"+column).dropify({
                                   defaultFile:  nameImage
                              });
                         }else if($("#"+column).is("input[type=checkbox]")){
                              if(obj.record[column] == 1){
                                   $('#'+column).prop('checked', true);
                              }
                         }else if($("#"+column).hasClass("datepicker-here")){
                              $('#'+column).val(moment(obj.record[column]).format('DD/MM/YYYY'));
                         }else{
                              $("#"+column).val(obj.record[column]);
                         }
                    } else if ($("#"+column).is("select")) {
                         $('#'+column+' option[value="'+obj.record[column]+'"]').attr("selected",true);
                         $('.select_custom').select2();
                    } else if ($("#"+column).is("textarea")) {
                         $("#"+column).text(obj.record[column]);
                    } else if ($("#"+column).is("img")){
                         if(obj.record[column] != null){
                              $("#"+column).attr("src", BASE_URL+obj.record[column]);
                         }else{
                              $("#"+column).attr("src", BASE_URL+'assets/custom/img/default/default.png');
                         }
                    }
               });
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function check_online(){
     window.setInterval(function(){
          var is_online = $("#is_online").val() || 0;

          $.post(BASE_URL + "api/message/set_online/"+is_online)
          .done(function (json) {})

          .fail(function (jqxhr, textStatus, error) {
               var err = textStatus + ", " + error;
               console.log("Request Failed: " + err);
          });
     }, 5000)
}

function update_user_lang(lang){
     $.post(BASE_URL + "api/script/update_user_lang/?lang="+lang)
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('status')) {
               console.log(obj.status);
               location.reload(true);
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}
