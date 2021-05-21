var mntTotal = 0;

$(document).ready(function() {
     $("input.mask-date").inputmask("d/m/y", {});
     $("input.mask-phone").inputmask({"mask":"99-999-99-99"});
     $("input.mask-phone-sn").inputmask({"mask":"99-999-99-99"});
     $("input.mask-phone-ci").inputmask({"mask":"99-99-99-99"});

     $('.selectpicker').selectpicker('refresh');

     $("#settings_niveau_id").chained("#settings_cycle_id");
     $("#tarification_modele_id").chained("#settings_niveau_id");

     $('#settings_cycle_id').on('change', function () {
          $('#settings_niveau_id').selectpicker('refresh');
     })

     $('#settings_niveau_id').on('change', function () {
          get_tarification_modele();
     })

     $('#settings_mode_paiement_id').on('change', function () {
          get_if_justif();
     })

     $('#toSubmit').on('click',function() {
          if ($('#scolarite').hasClass('active')){
               console.log("submit");
               content = '<button type="submit" class="btn btn-success form-control" id="toSubmit" onclick="setTimeout(function(){ window.location.reload(); }, 5000)">Enregistrer</button>';
               $('#toSubmit').replaceWith(content);
          }
     });

     $('#toReturn').on('click',function() {
          if ($('#facturation').hasClass('active')){
               console.log("return");
               content = '<a href="javascript: void(0);" class="btn btn-success form-control" id="toSubmit">Suivant</a>';
               $('#toSubmit').replaceWith(content);
               $('#toSubmit').on('click',function() {
                    if ($('#scolarite').hasClass('active')){
                         console.log("submit");
                         content = '<button type="submit" class="btn btn-success form-control" id="toSubmit" onclick="setTimeout(function(){ window.location.reload(); }, 5000)">Enregistrer</button>';
                         $('#toSubmit').replaceWith(content);
                    }
               });
          }
     });

     $('.timepicker').timepicker({
          timeFormat: 'HH:mm'
     });
     $("#temp_enseignant_id").change(function(){
          console.log($('#edit_enseignant_id').val($("#temp_enseignant_id").val()));
     });
     $("#temp_settings_jour_id").change(function(){
          console.log($('#edit_settings_jour_id').val($("#temp_settings_jour_id").val()));
     });
     (function($) {
          'use strict';
          var iconTochange;
          dragula([document.getElementById("dragula-left"), document.getElementById("dragula-right")]);
          dragula([document.getElementById("profile-list-left"), document.getElementById("profile-list-right")]);
          dragula([document.getElementById("dragula-event-left"), document.getElementById("dragula-event-right")])
          .on('drop', function(el) {
               console.log($(el));
               iconTochange = $(el).find('.fa');
               if (iconTochange.hasClass('fa-circle-o')) {
                    iconTochange.removeClass('fa-circle-o text-primary').addClass('fa-check-circle text-success');
               } else if (iconTochange.hasClass('fa-check-circle')) {
                    iconTochange.removeClass('fa-check-circle text-success').addClass('fa-circle-o text-primary');
               }
          })
     })(jQuery);
} );



function define_delete(id, input){
     $("input[name="+input+"]").val(id);
}

function define_custom(id, input){
     $("input[name="+input+"]").val(id);
}

function define_edit(id, link){
     $.post(BASE_URL + link+"/"+id)
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('header')) {
               $.each( obj.header, function (index){
                    var column = obj.header[index];

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
                         }else{
                              $("#"+column).val(obj.record[column]);
                         }
                    } else if ($("#"+column).is("select")) {
                         $('#'+column+' option[value="'+obj.record[column]+'"]').attr("selected",true);
                         $('.selectpicker').selectpicker('refresh');
                    } else if ($("#"+column).is("textarea")) {
                         $("#"+column).text(obj.record[column]);
                    } else if ($("#"+column).is("img")){
                         $("#"+column).attr("src", BASE_URL+obj.record[column]);
                    }
               });
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function get_tarification_modele(){
     $.post(BASE_URL + "api/script/tarification_modele", $("#form-tarif").serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               var content ='<div class="inbox-widget" id="tarification_modeles">'+'<h4 class="mb-3">Modèle de tarification</h4>';
               $.each( obj.data, function (index){
                    content += '<div class="custom-control custom-switch">'+
                    '<input type="checkbox" class="custom-control-input switcher_1" id="customSwitch'+obj.data[index].tarification_modele_id+'" name="tarification_modele_id" id="tarification_modele_id" value="'+obj.data[index].tarification_modele_id+'">'+
                    '<label class="custom-control-label mb-1" for="customSwitch'+obj.data[index].tarification_modele_id+'">'+obj.data[index].tarification_modele_name+'</label></br>'+
                    '<p class="inbox-item-text">'+obj.data[index].tarification_modele_desc+'</p>'+
                    '</div></hr>';
               });
               content += '</div>';
               $('#tarification_modeles').replaceWith(content);
               $(".switcher_1").on('change', function() {
                    window.mntTotal = 0;
                    show_total();
                    var box = $(this);
                    get_tarification();
                    if (box.is(":checked")) {
                         var group = "input:checkbox[name='tarification_modele_id']";
                         $(group).prop("checked", false);
                         box.prop("checked", true);
                    } else {
                         box.prop("checked", false);
                    }
               });
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function show_total(){

     content = '<div class="col-12" id="montant_total">'+
     '<div class="card-box widget-user">'+
     '<div class="text-center">'+
     '<h2 class="font-weight-normal text-primary" data-plugin="counterup">'+window.mntTotal.toLocaleString()+' F CFA</h2>'+
     '<h5>Net à payer</h5>'+
     '</div>'+
     '</div>'+
     '</div>';

     $('#montant_total').replaceWith(content);
}

function get_tarification(){
     $.post(BASE_URL + "api/script/tarification", $("#form-tarif").serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               $.each( obj.data, function (index){
                    $('#tarification_'+obj.data[index].tarification_id).empty();
                    var content = '<div id="tarification_'+obj.data[index].tarification_id+'">';
                    $.each( obj.data[index].details, function (i){
                         content += '<div class="custom-control custom-switch">'+
                         '<input type="checkbox" class="custom-control-input switcher_2" unchecked id="customSwitch_'+obj.data[index].details[i].tarification_detail_id+'" name="tarification_detail_'+obj.data[index].details[i].tarification_detail_id+'" value="'+obj.data[index].details[i].tarification_detail_id+'">'+
                         '<label class="custom-control-label mb-1" for="customSwitch_'+obj.data[index].details[i].tarification_detail_id+'">'+obj.data[index].details[i].tarification_detail_name+'</label></br>'+
                         '<input type="hidden" id="detail_'+obj.data[index].details[i].tarification_detail_id+'" name="detail_'+obj.data[index].details[i].tarification_detail_id+'" value="'+obj.data[index].details[i].tarification_detail_value+'"/>'+
                         '<input type="hidden" id="detail_checker_'+obj.data[index].details[i].tarification_detail_id+'" name="detail_checker_'+obj.data[index].details[i].tarification_detail_id+'" value="unchecked"/>'+
                         '</hr></div>';
                    });
                    content += '</div>';

                    $('#tarification_'+obj.data[index].tarification_id).replaceWith(content);

                    $.each( obj.data[index].details, function (i){
                         $('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).on('change', function() {
                              var tarification_detail = $(this);
                              if (tarification_detail.is(":checked")) {
                                   $('#detail_checker_'+obj.data[index].details[i].tarification_detail_id).val("checked");
                                   window.mntTotal += parseInt($('#detail_'+tarification_detail.val()).val());
                                   show_total();
                              } else {
                                   $('#detail_checker_'+obj.data[index].details[i].tarification_detail_id).val("unchecked");
                                   window.mntTotal -= parseInt($('#detail_'+tarification_detail.val()).val());
                                   show_total();
                              }
                         });
                    });

                    $('#tarif_'+obj.data[index].tarification_id).on('change', function() {
                         $.each( obj.data[index].details, function (i){
                              if ($('#tarif_'+obj.data[index].tarification_id).is(":checked")) {
                                   if(!$('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).is(":checked")){
                                        $('#detail_checker_'+obj.data[index].details[i].tarification_detail_id).val("checked");
                                        $('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).prop("checked", true);
                                        window.mntTotal += parseInt($('#detail_'+$('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).val()).val());
                                        show_total();
                                   }
                              } else {
                                   if($('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).is(":checked")){
                                        $('#detail_checker_'+obj.data[index].details[i].tarification_detail_id).val("unchecked");
                                        $('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).prop("checked", false);
                                        window.mntTotal -= parseInt($('#detail_'+$('#customSwitch_'+obj.data[index].details[i].tarification_detail_id).val()).val());
                                        show_total();
                                   }
                              }
                         });
                    });
               });
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function get_if_justif(){
     $.post(BASE_URL + "api/script/if_justif", $("#form_encaissement").serialize())
     .done(function (json) {
          console.log(json);
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.data.settings_mode_paiement_verif == 1){
                    content = '<div class="form-group mb-3" id="to_justif">'+
                    '<label>Pièce justificatif</label>'+
                    '<input type="text" class="form-control" placeholder="Pièce justificatif" name="encaissement_detail" id="encaissement_detail" required>'+
                    '</div>';
               }else{
                    content = '<div id="to_justif">'+
                    '</div>';
               }
               $('#to_justif').replaceWith(content);

          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}
