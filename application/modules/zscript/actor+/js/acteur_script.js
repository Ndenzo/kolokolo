$(document).ready(function(){

     $("#settings_niveau_id_reinsc").chained("#settings_cycle_id_reinsc");
     $("#classe_id_reinsc").chained("#settings_niveau_id_reinsc");

     $("#tarification_modele_id_sco").chained("#settings_niveau_id_sco");

     $('#settings_cycle_id_reinsc').on('change', function () {
          $('#settings_niveau_id_reinsc').selectpicker('refresh');
     })

     $('#settings_niveau_id_sco').on('change', function () {
          $('#tarification_modele_id_sco').selectpicker('refresh');
     })

     $("#settings_niveau_id_sco").chained("#settings_cycle_id_sco");
     $("#classe_id_sco").chained("#settings_niveau_id_sco");

     $('#settings_cycle_id_sco').on('change', function () {
          $('#settings_niveau_id_sco').selectpicker('refresh');
     })

     $('#settings_niveau_id_sco').on('change', function () {
          $('#classe_id_sco').selectpicker('refresh');
     })

     $('.reset').on('click', function () {
          $('.selectpicker').selectpicker('deselectAll');
     })

     $('#settings_niveau_id_reinsc').on('change', function () {
          $('#classe_id_reinsc').selectpicker('refresh');
     })

     $(".to_hide").hide();
     $(".to_hidde").hide();
     $('#search_to_renew').on('click', function () {
          reinscription();
     })

     $('#toSubmit_info').on('click',function() {
          if ($('#sante_info').hasClass('active')){
               content = '<button type="submit" class="btn btn-success form-control" id="toSubmit_info">Enregistrer</button>';
               $('#toSubmit_info').replaceWith(content);
          }
     });

     $('#toReturn_info').on('click',function() {
          if ($('#tuteur_info').hasClass('active')){
               content = '<a href="javascript: void(0);" class="btn btn-success form-control" id="toSubmit_info">Suivant</a>';
               $('#toSubmit_info').replaceWith(content);
               $('#toSubmit_info').on('click',function() {
                    if ($('#sante_info').hasClass('active')){
                         content = '<button type="submit" class="btn btn-success form-control" id="toSubmit_info">Enregistrer</button>';
                         $('#toSubmit_info').replaceWith(content);
                    }
               });
          }
     });
});

function reinscription(){
     $.post(BASE_URL + "api/script/search_to_renew", $("#form-tarif").serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.status == true){
                    console.log(obj.data);
                    $("#eleve_id_renew").val(obj.data.eleve_id);
                    var content = '<div id="show_eleve">';
                    content += '<p class="mt-2 mb-4">Elève à réinscrire : <strong>'+obj.data.personne_prenoms+' '+obj.data.personne_nom+'</strong> précédemment en :  <strong>'+obj.data.settings_niveau_name+'</strong></p>';
                    $('#show_eleve').replaceWith(content);
                    $(".to_hide").show();
               }
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}
