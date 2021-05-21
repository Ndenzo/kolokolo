

(function($) {
     "use strict";
     /*Line chart*/

     get_language_preferences();
     get_customer_stats();
     get_monthly_courses();
     get_monthly_sales();

})(jQuery);

function get_language_preferences(){
     $.post(BASE_URL + "api/chart/get_language_preferences").done(function (json) {

          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.status == true){
                    var settings_languages = obj.data.settings_languages
                    var customers = obj.data.customers

                    settings_languages.forEach(row => {
                         var content = "";
                         content += '<div class="value-total" style="margin-bottom: 13px;">';
                         content += '<label>'+ row.settings_language_name +' ('+row.customers_percent+'% | '+ row.customers +')</label>';
                         content += '<div class="progress-showcase">';
                         content += '<div class="progress sm-progress-bar">';
                         content += '<div class="progress-bar bg-primary" role="progressbar" style="width: '+row.customers_percent+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
                         content += '</div>';
                         content += '</div>';
                         content += '</div>';
                         $('#lang_pref').append(content);
                    });
               }
          }

     }).fail(function (jqxhr, textStatus, error) {

          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);

     });
}

function get_customer_stats(){
     $.post(BASE_URL + "api/chart/get_customer_stats").done(function (json) {

          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.status == true){
                    var male = obj.data.male
                    var female = obj.data.female
                    var undeclared = obj.data.undeclared

                    var content = "";
                    content += '<div class="value-total" style="margin-bottom: 10px;">';
                    content += '<label>Male ('+male.percent+'% | '+ male.nb +')</label>';
                    content += '<div class="progress-showcase">';
                    content += '<div class="progress sm-progress-bar">';
                    content += '<div class="progress-bar bg-info" role="progressbar" style="width: '+male.percent+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
                    content += '</div>';
                    content += '</div>';
                    content += '</div>';
                    $('#customer_stats').append(content);

                    content = "";
                    content += '<div class="value-total" style="margin-bottom: 10px;">';
                    content += '<label>Female ('+female.percent+'% | '+ female.nb +')</label>';
                    content += '<div class="progress-showcase">';
                    content += '<div class="progress sm-progress-bar">';
                    content += '<div class="progress-bar bg-pink" role="progressbar" style="width: '+female.percent+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
                    content += '</div>';
                    content += '</div>';
                    content += '</div>';
                    $('#customer_stats').append(content);

                    content = "";
                    content += '<div class="value-total" style="margin-bottom: 10px;">';
                    content += '<label>Undeclared ('+undeclared.percent+'% | '+ undeclared.nb +')</label>';
                    content += '<div class="progress-showcase">';
                    content += '<div class="progress sm-progress-bar">';
                    content += '<div class="progress-bar bg-danger" role="progressbar" style="width: '+undeclared.percent+'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
                    content += '</div>';
                    content += '</div>';
                    content += '</div>';
                    $('#customer_stats').append(content);
               }
          }

     }).fail(function (jqxhr, textStatus, error) {

          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);

     });
}

function get_monthly_sales(){
     $.post(BASE_URL + "api/chart/get_monthly_sales").done(function (json) {

          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.status == true){
                    $('#som_total_sales').replaceWith('<h4 class="txt-danger" id="som_total_sales">$'+obj.som_total_sales+'</h4>');
                    $('#som_this_week_sales').replaceWith('<h6 class="counter mb-0" id="som_this_week_sales">$'+obj.som_this_week_sales+'</h6>');
                    $('#som_this_month_sales').replaceWith('<h6 class="counter mb-0" id="som_this_month_sales">$'+obj.som_this_month_sales+'</h6>');
                    $('#som_last_month_sales').replaceWith('<h6 class="counter mb-0" id="som_last_month_sales">$'+obj.som_last_month_sales+'</h6>');

                    var spark = {
                         chart: {
                              type: 'area',
                              height: 80,
                              width: 320,
                              sparkline: {
                                   enabled: true
                              },
                         },
                         stroke: {
                              curve: 'straight'
                         },
                         colors: ['#fd2e64'],
                         fill: {
                              opacity: 0.3
                         },
                         series: [{
                              name: "Sales",
                              data: obj.data
                         }],
                         xaxis: {
                              categories: obj.categories,
                              crosshairs: {
                                   width: 1
                              },
                         },
                         yaxis: {
                              min: 0
                         }
                    }

                    var spark3 = new ApexCharts(document.querySelector("#spark3"), spark);
                    spark3.render();
               }
          }

     }).fail(function (jqxhr, textStatus, error) {

          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);

     });
}

function get_monthly_courses(){
     $.post(BASE_URL + "api/chart/get_monthly_courses").done(function (json) {

          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if (obj.hasOwnProperty('data')) {
                    if(obj.status == true){
                         $('#som_total_courses').replaceWith('<h4 class="txt-warning" id="som_total_courses">'+obj.som_total_courses+'</h4>');
                         $('#som_this_week_courses').replaceWith('<h6 class="counter mb-0" id="som_this_week_courses">'+obj.som_this_week_courses+'</h6>');
                         $('#som_this_month_courses').replaceWith('<h6 class="counter mb-0" id="som_this_month_courses">'+obj.som_this_month_courses+'</h6>');
                         $('#som_last_month_courses').replaceWith('<h6 class="counter mb-0" id="som_last_month_courses">'+obj.som_last_month_courses+'</h6>');

                         var spark = {
                              chart: {
                                   type: 'area',
                                   height: 80,
                                   width: 320,
                                   sparkline: {
                                        enabled: true
                                   },
                              },
                              stroke: {
                                   curve: 'straight'
                              },
                              colors: ['#ff6a33'],
                              fill: {
                                   opacity: 0.3
                              },
                              series: [{
                                   name: "Sales",
                                   data: obj.data
                              }],
                              xaxis: {
                                   categories: obj.categories,
                                   crosshairs: {
                                        width: 1
                                   },
                              },
                              yaxis: {
                                   min: 0
                              }
                         }

                         var spark2 = new ApexCharts(document.querySelector("#spark2"), spark);
                         spark2.render();
                    }
               }
          }

     }).fail(function (jqxhr, textStatus, error) {

          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);

     });
}
