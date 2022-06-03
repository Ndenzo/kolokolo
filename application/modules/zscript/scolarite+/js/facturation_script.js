$(document).ready(function() {
     $( "#searcher" ).on( "click", function() {
          event.preventDefault();
          get_factures();
     });
});

function get_factures(){
     $.post(BASE_URL + "api/script/get_factures", $("#search_form_facture").serialize())
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.data.length > 0){
                    var content = '';

                    $.each( obj.data, function (index){
                         var row = obj.data[index];
                         content += '<tr>';
                         content += '<td>'+ row.facture_id +'</td>';
                         content += '<td>'+ row.facture_num +'</td>';
                         content += '<td>'+ row.facture_date +'</td>';
                         content += '<td>'+ row.eleve_matricule +'</td>';
                         content += '<td>'+ (row.montant - row.facture_remise).toLocaleString() +'</td>';
                         content += '<td>'+ (row.encaissement).toLocaleString() +'</td>';
                         content += '<td>'+ (row.montant - row.encaissement - row.facture_remise).toLocaleString() +'</td>';
                         content += '<td><span class="badge badge-'+ row.facture_flag_class +'">'+ row.facture_flag_label +'</span></td>';
                         content += '<td style="text-align:center;">';
                         content += '<div class="item-action dropdown">';
                         content += '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>';
                         content += '<div class="dropdown-menu dropdown-menu-right">';
                         content += '<a href="'+ BASE_URL +'scolarite/facturation/showFacture/'+ row.facture_id +'" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Facture </a>';
                         content += '<a href="'+ BASE_URL +'scolarite/facturation/showQuittance/'+ row.facture_id +'" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Reçu de paiement </a>';
                         var identifier = "'facture_id'";
                         if (row.facture_flag_code != "reg") {
                              content += '<a href="#custom-encaissement-modal" class="dropdown-item" data-toggle="modal" onclick="define_custom('+ row.facture_id +', '+ identifier +', '+ (row.montant - row.encaissement - row.facture_remise) +')"><i class="dropdown-icon mdi mdi-credit-card-plus"></i> Encaisser </a>';
                         }
                         content += '<div class="dropdown-divider"></div>';
                         content += '<a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete('+ row.facture_id +', '+ identifier +')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>';
                         content += '</div>';
                         content += '</div>';
                         content += '</td>';
                         content += '</tr>';
                    });

                    $('#facture_list').html(content);
               }
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}
