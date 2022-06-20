function reinscription(){
     $.post(BASE_URL + "api/script/search_to_renew", $("#form-tarif").serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.status == true){
                    $("#eleve_id_renew").val(obj.data.eleve_id);
                    var content = '<div id="show_eleve">';
                    content += '<p class="mt-2 mb-4">Elève à réinscrire : <strong>'+obj.data.prenoms+' '+obj.data.nom+'</strong> précédemment en :  <strong>'+obj.data.settings_niveau_name+'</strong></p>';
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
