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

                         content += '<td style="width: 100px;">';
                         content += '<div class="text-end text-center" style="width: 90px!important;">';
                         content += '<div class="dropdown">';

                         content += '<button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>';
                         content += '<div class="dropdown-menu dropdown-menu-right">';
                         content += '<a href="'+ BASE_URL +'billing/billing/showFacture/'+ row.facture_id +'" class="dropdown-item" target="_blank"><i class="fa fa-file-text"></i> Facture </a>';
                         content += '<a href="'+ BASE_URL +'billing/billing/showQuittance/'+ row.facture_id +'" class="dropdown-item" target="_blank"><i class="fa fa-ticket"></i> Reçu </a>';
                         var identifier = "'facture_id'";
                         if (row.facture_flag_code != "reg") {
                              content += '<a href="#custom-encaissement-modal" class="dropdown-item" data-toggle="modal" onclick="define_custom('+ row.facture_id +', '+ identifier +', '+ (row.montant - row.encaissement - row.facture_remise) +')"><i class="dropdown-icon mdi mdi-credit-card-plus"></i> Encaisser </a>';
                         }
                         content += '<div class="dropdown-divider"></div>';
                         content += '<a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete('+ row.facture_id +', '+ identifier +')"><i class="fa fa-trash"></i> Remove</a>';

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
