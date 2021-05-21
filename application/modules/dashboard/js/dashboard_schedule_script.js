var today = new Date();
var date = moment(today);
var day_number = date.isoWeekday();
var day_label = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

var content = '';
var first_day_week = moment(today).day(1);
var last_day_week = moment(today).day(7);

var weeknumber = moment(today).week();

var saut = 0;

var schedules = [];
var custom_teacher_agendas = [];

$(document).ready(function (e) {

     schedule_builder();

     $( "#previous" ).on( "click", function() {
          previous();
     });

     $( "#next" ).on( "click", function() {
          next();
     });

});

function next(){
     first_day_week = first_day_week.day(7);
     last_day_week = last_day_week.day(7);
     content = '';
     schedule_builder();
}

function previous(){
     first_day_week = first_day_week.day(-7);
     last_day_week = last_day_week.day(-7);
     content = '';
     schedule_builder();
}

function header_builder(){
     content += '<tr>';
     // content += '<th scope="col" style="width: 9%; border: 0px;"></th>';
     for(var j = 0; j < 7; j++){
          content += '<th scope="col" style="width: 14%; margin-left: 1px; border: 0px; font-weight: bold;">'+ day_label[j] +'</th>';
     }
     content += '</tr>';

     content += '<tr>';
     // content += '<th scope="col" style="width: 9%; border: 0px;"></th>';
     for(var j = 0; j < 7; j++){
          var current = first_day_week.day(+j+1);
          if((j+1) == day_number && current.format('DD/MM/YYYY') == date.format('DD/MM/YYYY')){
               content += '<th class="bg-light" scope="col" style="width: 14%; margin-left: 1px;">'+ current.format("MMM Do"); +'</th>';
          }else{
               content += '<th scope="col" style="width: 14%; margin-left: 1px;">'+ current.format("MMM Do YYYY"); +'</th>';
          }
          content += '<input type="hidden" id="date'+j+'" value="'+ current.format('DD/MM/YYYY') +'">';
     }
     content += '</tr>';

     var calendar_header = first_day_week.day(-6).format("MMM Do") + " - " + last_day_week.day(0).format("MMM Do") + ", " +  moment(today).format("YYYY");
     $('#calendar_header').replaceWith('<h4 class="col-6 ml-auto mr-auto text-center txt-primary" id="calendar_header" style="font-weight: bold;">'+ calendar_header +'</h4>');
}

function body_builder(){
     $.get(BASE_URL + "api/script/get_event/"+first_day_week.format('YYYY-MM-DD'))
     .done(function (json) {
          var obj = JSON.parse(json) || {}
          if (obj.hasOwnProperty('data')) {
               if(obj.status == true){
                    content = "";
                    content += '<tbody>';

                    schedules = obj.data;
                    var k = 0;
                    var i = 0;
                    while(k < obj.nb_schedules){
                         content += '<tr>';
                         for(var j = 0; j < 7; j++){
                              if(schedules[j].data[i] != null) {
                                   if (day_label[j] == schedules[j].date) {
                                        content += '<td style="padding: 0.05rem!important;">';
                                        content += '<a href="#custom-modal-classroom-'+schedules[j].data[i].customer_schedule_id+'" class="btn btn-primary" data-toggle="modal" style="width: 100%; height: 100%; color: white; font-weight: bold; font-size: 10px;">';
                                        if (obj.type == "customer") {
                                             content += schedules[j].data[i].customer_schedule_time.substr(0, 5)+' '+schedules[j].data[i].customer_schedule_time_portion+'<br>'+schedules[j].data[i].user_nicename;
                                        }else{
                                             content += schedules[j].data[i].schedule_time.substr(0, 5)+' '+schedules[j].data[i].schedule_time_portion+'<br>'+schedules[j].data[i].user_nicename;
                                        }
                                        content += '</a>';
                                        content += '</td>';
                                        k++;
                                   }
                              }else{
                                   content += '<td style="padding: 0.05rem!important; border: 0px;">';
                                   content += '</td>';
                              }
                         }
                         content += '</tr>';
                         i++;
                    }

                    content += '</tbody>';
                    content += '</table>';

                    $('#custom_teacher_agenda').append(content);

                    content = "";
                    var k = 0;
                    var i = 0;
                    while(k < obj.nb_schedules){
                         for(var j = 0; j < 7; j++){
                              if(schedules[j].data[i] != null) {
                                   if (day_label[j] == schedules[j].date) {
                                        content += '<div id="custom-modal-classroom-'+schedules[j].data[i].customer_schedule_id+'" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">';
                                        content += '<div class="modal-dialog modal-dialog-centered modal-lg">';
                                        content += '<div class="modal-content">';
                                        content += '<div class="modal-header">';
                                        content += '<h4 class="modal-title" id="customLabel">START CLASSROOM</h4>';
                                        content += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                                        content += '</div>';
                                        content += '<div class="modal-body">';
                                        content += '<div class="row justify-content-center">';
                                        content += '<div class="col-xl-12">';
                                        content += '<div class="blog-box blog-list row">';
                                        content += '<div class="col-4">';

                                        var identifier ="'"+BASE_URL+"assets/custom/img/default/boy.png'";

                                        content += '<img class="img-fluid sm-100-w col-8 offset-2" src="'+BASE_URL+schedules[j].data[i].person_picture+'" alt="No image" onerror="this.onerror=null;this.src='+identifier+';">';
                                        // content += '<img class="img-fluid sm-100-w col-8 offset-2" src="<?= _url(); ?>assets/custom/img/default/boy.png" alt="">';

                                        content += '</div>';
                                        content += '<div class="col-8">';
                                        content += '<div class="blog-details">';
                                        if (obj.type == "customer") {
                                             content += '<div class="blog-date digits col-12"> <span>'+moment(schedules[j].data[i].customer_schedule_customer_date).format("MMM Do YYYY")+'</span> </div>';
                                        }else{
                                             content += '<div class="blog-date digits col-12"> <span>'+moment(schedules[j].data[i].customer_schedule_date).format("MMM Do YYYY")+'</span> </div>';
                                        }
                                        content += '<br>';
                                        content += '<h6 class="txt-primary col-12">Lesson : '+schedules[j].data[i].settings_language_name+'</h6>';
                                        content += '<div class="col-12">';
                                        content += '<ul class="blog-social mt-3">';
                                        content += '<li>With: '+schedules[j].data[i].user_nicename+'</li>';
                                        if (obj.type == "customer") {
                                             content += '<li class="digits">Time : '+schedules[j].data[i].customer_schedule_time.substr(0, 5)+' '+schedules[j].data[i].customer_schedule_time_portion+'</li>';
                                        }else{
                                             content += '<li class="digits">Time : '+schedules[j].data[i].schedule_time.substr(0, 5)+' '+schedules[j].data[i].schedule_time_portion+'</li>';
                                        }
                                        content += '</ul>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '<div class="modal-footer mt-3">';
                                        content += '<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>';
                                        content += '<a href="#custom-delete-modal-'+schedules[j].data[i].customer_schedule_id+'" class="btn btn-danger col-md-4" data-toggle="modal">Cancel Lesson ?</a>';
                                        content += '<a href="'+BASE_URL+'classroom/meeting/'+schedules[j].data[i].customer_schedule_id+'" class="btn btn-primary col-md-4" target="_blank">Enter Classroom</a>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';


                                        content += '<div id="custom-delete-modal-'+schedules[j].data[i].customer_schedule_id+'" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">';
                                        content += '<div class="modal-dialog modal-dialog-centered">';
                                        content += '<div class="modal-content">';
                                        content += '<div class="modal-header">';
                                        content += '<h4 class="modal-title" id="myCenterModalLabel">Delete</h4>';
                                        content += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                                        content += '</div>';
                                        content += '<div class="modal-body">';
                                        content += '<form class="row justify-content-center" action="'+ BASE_URL +'schedule/'+obj.type+'/delete_dashboard_customer_schedule" method="post" enctype="multipart/form-data">';
                                        content += '<div class="col-10 mt-50">';
                                        content += '<p style="text-align: center; font-size: 14px;"> This action is irreversible </p>';
                                        content += '<div class="modal-footer mt-3">';
                                        content += '<input type="hidden" type="text" name="customer_schedule_id" value="'+schedules[j].data[i].customer_schedule_id+'">';
                                        content += '<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>';
                                        content += '<button type="submit" class="btn btn-danger col-md-4">YES</button>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</form>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';
                                        content += '</div>';

                                        k++;
                                   }
                              }
                         }
                         i++;
                    }

                    $('#custom_teacher_agenda').append(content);
               }
          }
     })

     .fail(function (jqxhr, textStatus, error) {
          var err = textStatus + ", " + error;
          console.log("Request Failed: " + err);
     });
}

function schedule_builder(){

     content += '<table class="table table-bordered schedule-table" id="custom_teacher_agenda"">';
     content += '<thead>';
     header_builder();
     content += '</thead>';
     $('#custom_teacher_agenda').replaceWith(content);

     body_builder();

}
