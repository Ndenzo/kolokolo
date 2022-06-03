$(document).ready(function() {
     $(".to_hide").hide();
     $(".to_hidde").hide();
});

function show_details(id){
     $('#details').append($(".to_change"));
     $('#detail_view').append($("#detail_"+id));
     $("#detail_"+id).removeClass('to_hidde').addClass('to_change');;
     $(".to_change").show();
}

function showGrid(evaluation_note_config_id, evaluation_modele_niveau_id){
     $(".evaluation_note_config_id").val(evaluation_note_config_id);
     $("#show_current_module").text($('#current_module_'+evaluation_note_config_id).val());
     $("#show_current_activity").text($('#current_activity_'+evaluation_note_config_id).val());

     $.get(BASE_URL + "api/script/get_notes/"+evaluation_note_config_id+"/"+evaluation_modele_niveau_id)
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.data.length > 0){
                    $.each( obj.data, function (index){
                         if(obj.data[index].evaluation != null){
                              $("#note-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).text(obj.data[index].evaluation.evaluation_note_value);
                              $("#commentaire-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).text(obj.data[index].evaluation.evaluation_note_commentaire);
                              $("#note_value-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).val(obj.data[index].evaluation.evaluation_note_value);
                              $("#note_commentaire-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).val(obj.data[index].evaluation.evaluation_note_commentaire);
                              $("#total-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).text(obj.data[index].stats.total);
                              $("#moyenne-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).text(parseFloat(obj.data[index].stats.total/obj.data[index].stats.sum_coef).toFixed(2));
                         }else{
                              $("#note-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).text("-");
                              $("#commentaire-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).text("-");
                         }
                         if (obj.hasOwnProperty('config')) {
                              $("#note_value-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).change(function(){
                                   var value = $("#note_value-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).val();
                                   if(parseInt(value) > parseInt(obj.config.evaluation_note_config_max) || parseInt(value) < 0){
                                        alert("La note doit être comprise entre 0 et "+ obj.config.evaluation_note_config_max +" !");
                                        $("#note_value-"+obj.data[index].eleves_scolarite_id+"-"+obj.data[index].classe_id).val(0);
                                   }
                              });
                         }
                    });
               }
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
     $(".to_hide").show();
}

function insert_note(eleves_scolarite_id, classe_id){
     $.post(BASE_URL + "api/script/insert_note", $("#note-submit-"+eleves_scolarite_id+"-"+classe_id).serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('status')) {
               if(obj.status == true){
                    $("#note-"+eleves_scolarite_id+"-"+classe_id).text(obj.evaluation_note_value);
                    $("#commentaire-"+eleves_scolarite_id+"-"+classe_id).text(obj.evaluation_note_commentaire);
               }
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function check_matricule(evaluation_modele_id){
     $.get(BASE_URL + "api/script/get_eleve_from_matricule/", $("#matricule_checker_form_"+evaluation_modele_id).serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          var content = '<div id="dispense_'+obj.evaluation_modele_id+'">';
          // var content = '';
          if (obj.hasOwnProperty('data')) {
               if(obj.data != null){
                    content += '<p class="mt-2 mb-4">Voulez-vous dispenser <strong class="text-warning">'+obj.data.prenoms+' '+obj.data.nom+'</strong> en classe de <strong class="text-warning">'+obj.data.classe_name+'</strong></p>';
                    $("#eleves_scolarite_id_"+obj.evaluation_modele_id).val(obj.data.eleves_scolarite_id);
                    $(".to_hide").show();
               }else{
                    content += '<p class="mt-2 mb-4"><strong class="text-warning">L&apos;élève sélectionné n&apos;est pas dans ce cycle !</strong></p>';
                    $(".to_hide").hide();
               }
          }else{
               content += '<p class="mt-2 mb-4"><strong class="text-warning">L&apos;élève sélectionné n&apos;est pas dans ce cycle !</strong></p>';
          }
          content += '</div>';
          $('#dispense_'+obj.evaluation_modele_id).replaceWith(content);
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function define_comment(ref){
     var cycle = $("#settings_cyles").val();
     switch(cycle) {
          case "eleme":
          if($("#note_value-"+ref).val() == 10)$("#note_commentaire-"+ref).val("Excellent");
          else if($("#note_value-"+ref).val() >= 9)$("#note_commentaire-"+ref).val("Très Bien");
          else if($("#note_value-"+ref).val() >= 8)$("#note_commentaire-"+ref).val("Bien");
          else if($("#note_value-"+ref).val() >= 6)$("#note_commentaire-"+ref).val("Assez Bien");
          else if($("#note_value-"+ref).val() >= 5)$("#note_commentaire-"+ref).val("Passable");
          else if($("#note_value-"+ref).val() >= 3)$("#note_commentaire-"+ref).val("Peu Réussi");
          else $("#note_commentaire-"+ref).val("Pas Réussi");
          break;
          case "moyen":
          if($("#note_value-"+ref).val() == 20)$("#note_commentaire-"+ref).val("Excellent");
          else if($("#note_value-"+ref).val() >= 17)$("#note_commentaire-"+ref).val("Très Bien");
          else if($("#note_value-"+ref).val() >= 14)$("#note_commentaire-"+ref).val("Bien");
          else if($("#note_value-"+ref).val() >= 12)$("#note_commentaire-"+ref).val("Assez Bien");
          else if($("#note_value-"+ref).val() >= 9)$("#note_commentaire-"+ref).val("Passable");
          else if($("#note_value-"+ref).val() >= 7)$("#note_commentaire-"+ref).val("Insuffisant");
          else if($("#note_value-"+ref).val() >= 5)$("#note_commentaire-"+ref).val("Faible");
          else $("#note_commentaire-"+ref).val("Très Faible");
          break;
          default: break;
     }
}
