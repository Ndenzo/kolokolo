$(document).ready(function() {

     $("#search").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $(".element").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
     });

     $("#sim_town_id_form").chained("#sim_state_id_form");

     $('#sim_state_id_form').on('change', function () {
          $("#sim_town_id_form").select2({
               placeholder: "-- Choisir --",
          });
     });


     ////////////////////////////////


     $('#sim_activate').on('click', function () {
          if ($("#invest_value").length) {
               define_dette();
               define_inter();

               if($('#apport_view').length){
                    $('#apport_view').html(parseInt($('#invest_value').val()).toLocaleString()+" F");
               }
               if($('#gain_view').length){
                    var gain = parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val());
                    gain = gain * $('#yield').val() / 100;
                    $('#gain_view').html(parseInt(gain).toLocaleString()+" F");
                    $('#mnt_gain').val(parseInt(gain));

               }
               if($('#sim_total_view').length){
                    var total = parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val());
                    var gain = total * $('#yield').val() / 100;
                    total += gain;
                    total += -$('#mnt_inter').val();
                    $('#sim_total_view').html(parseInt(total).toLocaleString()+" F");
                    $('#mnt_sim_total').val(parseInt(total));
               }
               if($('#mnt_dette_view').length){
                    $('#mnt_dette_view').html(parseInt($('#mnt_dette').val()).toLocaleString()+" F");
               }
               if($('#mnt_total_invest_view').length){
                    $('#mnt_total_invest_view').html(parseInt($('#mnt_total_invest').val()).toLocaleString()+" F");
               }
               if($('#roe_view').length){
                    $('#roe_view').html(parseFloat($('#roe').val()).toFixed(2)+" %");
               }
               if($('#rev_net_exp_view').length){
                    $('#rev_net_exp_view').html(parseInt($('#rev_net_exp').val()).toLocaleString()+" F");
               }
               if($('#cash_on_cash_view').length){
                    $('#cash_on_cash_view').html(parseFloat($('#cash_on_cash').val()).toFixed(2)+" %");
               }
               if($('#drci_view').length){
                    $('#drci_view').html(parseFloat($('#drci').val()).toFixed(2)+" %");
               }
               if($('#ebitda_view').length){
                    $('#ebitda_view').html(parseFloat($('#ebitda').val()).toFixed(2)+" %");
               }
               if($('#mnt_inter_view').length){
                    $('#mnt_inter_view').html(parseInt($('#mnt_inter').val()).toLocaleString()+" F");
               }
               if ($("#simulator_bar").length) {

                    $("#simulator_bar" ).empty();
                    $("#simulator_bar").height(400);

                    var apprort_low = 0;
                    var apport_high = parseInt($('#invest_value').val());

                    var dette_low = parseInt($('#invest_value').val());
                    var dette_high = (parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val()));

                    var gain_low =  (parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val()));
                    var gain_high = (parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val()) + parseInt($('#mnt_gain').val()));

                    var inter_low = (parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val()) + parseInt($('#mnt_gain').val()) - parseInt($('#mnt_inter').val()));
                    var inter_high = (parseInt($('#invest_value').val()) + parseInt($('#mnt_dette').val()) + parseInt($('#mnt_gain').val()));

                    var total_low = 0;
                    var total_high = parseInt($('#mnt_sim_total').val());

                    var data = [
                         {x: "Apport", low: apprort_low, high: apport_high},
                         {x: "Dette", low: dette_low, high: dette_high},
                         {x: "Gain Annuel", low: gain_low, high: gain_high, value:"yo"},
                         {x: "Intérêt", low: inter_low, high: inter_high,
                         normal:   {
                              fill: "#ED7D31",
                              stroke: null,
                              label: {enabled: false,}
                         },
                         hovered:  {
                              fill: "#ED7D31",
                              stroke: null,
                              label: {enabled: true},
                         },
                         selected: {
                              fill: "#ED7D31",
                              stroke: null,
                              label: {enabled: true},
                         }},
                         {x: "Montant Total", low: total_low, high: total_high}
                    ];

                    // create a chart
                    chart = anychart.column();

                    // create a range bar series and set the data
                    var series = chart.rangeColumn(data);

                    // set the container id
                    chart.container("simulator_bar");

                    // initiate drawing the chart
                    chart.draw();
               }
          }
     });

     $('#sim_type_id_form').on('change', function () {
          if($('#sim_state_id_form').val() != "" && $('#sim_town_id_form').val() != "" && $('#sim_type_id_form').val() != ""){
               update_const($('#sim_type_id_form').val(), $('#sim_state_id_form').val(), $('#sim_town_id_form').val());
          }
     });

     $('#sim_state_id_form').on('change', function () {
          if($('#sim_state_id_form').val() != "" && $('#sim_town_id_form').val() != "" && $('#sim_type_id_form').val() != ""){
               update_const($('#sim_type_id_form').val(), $('#sim_state_id_form').val(), $('#sim_town_id_form').val());
          }
     });

     $('#sim_town_id_form').on('change', function () {
          if($('#sim_state_id_form').val() != "" && $('#sim_town_id_form').val() != "" && $('#sim_type_id_form').val() != ""){
               update_const($('#sim_type_id_form').val(), $('#sim_state_id_form').val(), $('#sim_town_id_form').val());
          }
     });


} );

function define_dette(){
     var tmp = ($('#invest_value').val() * $('#eff_lev').val());
     var mnt_dette = tmp-$('#invest_value').val();
     $('#mnt_dette').val(mnt_dette);
     var mnt_total_invest = parseFloat($('#invest_value').val())+parseFloat(mnt_dette);
     $('#mnt_total_invest').val(mnt_total_invest);


     tmp = ($('#yield').val() * mnt_total_invest);
     $('#roe').val(tmp/$('#invest_value').val());

     var tmp2 = parseFloat(100-parseFloat($('#tax_loc').val()));
     var rev_net_exp = parseFloat(tmp)/tmp2;

     $('#rev_net_exp').val(rev_net_exp);
     $('#cash_on_cash').val((rev_net_exp/mnt_total_invest)*100);
     $('#drci').val(parseFloat(mnt_total_invest/rev_net_exp).toFixed(2));

     tmp = parseFloat(mnt_dette) + parseFloat(mnt_inter)
     $('#ebitda').val(rev_net_exp/tmp);
}

function define_inter(){
     var timeline = parseInt($('#per_place').val());

     var mat = [];
     var tab = [];
     var sum_inter = 0;
     for(var i = 1; i <= timeline; i++) {
          if (i <= timeline) {
               if(i == 1){
                    tab['opening'] = $('#mnt_dette').val();
               }else{
                    tab['opening'] = mat[i-2]['closing_bal'];
               }
          }

          if (i <= timeline) {
               tab['total_pay'] = PMT(parseFloat($('#tx_emp').val()/100), timeline, parseFloat($('#mnt_dette').val()));
               tab['interest_pay'] = IPMT(parseFloat($('#tx_emp').val()/100), parseFloat($('#mnt_dette').val()), parseFloat(i-1), tab['total_pay']);
               sum_inter += parseFloat(tab['interest_pay']);
          }

          tab['principle_pay'] = parseFloat(tab['total_pay']) - parseFloat(tab['interest_pay']);
          tab['closing_bal'] = parseFloat(tab['opening']) + parseFloat(tab['principle_pay']);
          mat.push(tab);
     }

     $('#mnt_inter').val(-sum_inter);
     tmp = parseFloat($('#mnt_dette').val()) + parseFloat(-sum_inter);
     $('#ebitda').val((parseFloat($('#rev_net_exp').val())/tmp*100).toFixed(2));
}

function PMT(rate, nperiod, pv, fv = 0) {

     if (rate == 0) return -(pv + fv)/nperiod;

     var pvif = Math.pow(1 + rate, nperiod);
     var pmt = rate / (pvif - 1) * -(pv * pvif + fv);


     return  Math.round(pmt,-2);
}

function IPMT(rate, pv, per, pmt) {
     var tmp = Math.pow(1 + rate, per);
     var ipmt = 0 - (pv * tmp * rate + pmt * (tmp - 1));

     return Math.round(ipmt,-2);
}

function update_const(type_id, state_id, town_id){

     $.post(BASE_URL + "api/script/get_sim_params?sim_type_id="+ type_id +"&sim_state_id="+ state_id +"&sim_town_id="+ town_id)
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               var params = obj.data;

               console.log(params);

               $('#tx_emp').val(params.tx_emp);
               $('#yield').val(params.yield);
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}
