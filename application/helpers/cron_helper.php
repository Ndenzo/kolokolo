<?php
/**
* CodeIgniter
*
* @package    CodeIgniter
* @author    Kakou Cyr Leonce Anicet
* @copyright Copyright (c) 2015, Ibems, Inc.
* @license    http://opensource.org/licenses/MIT	MIT License
* @link    http://www.ibems.com
* @since    Version 1.0.0
* @filesource
*/

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_age')) {
     function get_age($date) {
          $age = date('Y') - date('Y', strtotime($date));
          if (date('md') < date('md', strtotime($date))) {
               return $age - 1;
          }
          return $age;
     }
}

if (!function_exists('id_getter')) {
     function id_getter($id_label, $table, $code_label, $code) {
          $CI = &get_instance();
          $CI->db->select($id_label);
          $CI->db->from($table);
          $CI->db->where($code_label, $code);
          $result = $CI->db->get();
          return @$result->row()->{$id_label};
     }
}

if (!function_exists('to_english_date')) {
     function to_english_date($format, $date) {
          $CI = &get_instance();

          $timestamp = strtotime($date);
          $result = date($format, $timestamp);

          return @$result;
     }
}

if(!function_exists('matricule_generator')){
     function matricule_generator(){
          $CI = &get_instance();
          $CI->db->select("eleve_id");
          $CI->db->from("eleves");
          $CI->db->order_by("eleve_id", "desc");
          $result = $CI->db->get();
          $eleve_id = @$result->row()->eleve_id;
          $num = sprintf("%05d",  (int)@$result->num_rows()+1);
          $timer = date("m-y");
          $num = $num."-".$timer;
          return($num);
     }
}

if(!function_exists('get_timezone')){
     function get_timezone(){
          $CI = &get_instance();
          if(me("settings_timezone_id") != 0){
               $CI->db->select('*');
               $CI->db->from('settings_timezones');
               $CI->db->where('settings_timezone_id', me("settings_timezone_id"));
               $timezone = $CI->db->get()->row();
               return($timezone->settings_timezone_name);
          }else{
               return 'Africa/Dakar';
          }
     }
}

if(!function_exists('get_timezone_info')){
     function get_timezone_info($settings_timezone_id){
          $CI = &get_instance();
          if($settings_timezone_id != 0){
               $CI->db->select('*');
               $CI->db->from('settings_timezones');
               $CI->db->where('settings_timezone_id', $settings_timezone_id);
               $timezone = $CI->db->get()->row();
               return($timezone->settings_timezone_name);
          }else{
               return 'Africa/Dakar';
          }
     }
}


if(!function_exists('get_countries')){
     function get_countries(){
          $CI = &get_instance();
          $CI->db->select('*');
          $CI->db->from('settings_countries');

          $settings_languages = $CI->db->get()->result();
          return($settings_languages);
     }
}

if(!function_exists('get_reports')){
     function get_reports(){
          $CI = &get_instance();

          $CI->db->limit(5);
          $CI->db->select('*');
          $CI->db->from('rapports');

          $reports = $CI->db->get()->result();
          return($reports);
     }
}

if(!function_exists('get_types')){
     function get_types(){
          $CI = &get_instance();

          $CI->db->select('*');
          $CI->db->from('sim_types');

          $reports = $CI->db->get()->result();
          return($reports);
     }
}

if(!function_exists('get_states')){
     function get_states(){
          $CI = &get_instance();

          $CI->db->select('*');
          $CI->db->from('sim_states');

          $reports = $CI->db->get()->result();
          return($reports);
     }
}

if(!function_exists('get_investor_by_user_id')){
     function get_investor_by_user_id(){
          $CI = &get_instance();

          $user_id =  me('user_id');

          $CI->db->select('*');
          $CI->db->from('investors');
          $CI->db->where('investors.user_id', $user_id);

          $result = $CI->db->get()->row();

          return($result->investor_id);
     }
}

if(!function_exists('get_investor_request')){
     function get_investor_request(){
          $CI = &get_instance();

          $CI->db->select('*');
          $CI->db->from('investor_requests');
          $CI->db->where('investor_request_locked', 0);

          $result = $CI->db->get()->result();

          return($result);
     }
}

if(!function_exists('get_investor_notif')){
     function get_investor_notif(){
          $CI = &get_instance();

          $CI->db->select('*');
          $CI->db->from('investors');
          $CI->db->where('investor_locked', 2);

          $result = $CI->db->get()->result();

          return($result);
     }
}

if(!function_exists('password_generator')){
     function password_generator(){
          $n = 8;
          $alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          $saut = rand(1, 2);
          $random = "";
          $gen = true; // true pour alphabetique, false pour numerique

          for ($i=0; $i < $n; $i++) {
               for ($j=0; $j < $saut ; $j++) {
                    if($gen == true){
                         $random = $random . $alpha[rand(0,25)];
                    }
                    if($gen == false){
                         $random = $random . rand(0, 9);
                    }
               }
               if ($gen == true) {
                    $gen = false;
               }else{
                    $gen = true;
               }
               $i = $i + $j - 1;
          }
          return($random);
     }
}

if(!function_exists('code_generator')){
     function code_generator(){
          $n = 6;
          $alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          $saut = rand(1, 2);
          $random = "";
          $gen = true; // true pour alphabetique, false pour numerique

          for ($i=0; $i < $n; $i++) {
               if($i%2 == 0 && $i!=0){
                    $random = $random . "-";
               }
               for ($j=0; $j < $saut ; $j++) {
                    if($gen == true){
                         $random = $random . $alpha[rand(0,25)];
                    }
                    if($gen == false){
                         $random = $random . rand(0, 9);
                    }
               }
               if ($gen == true) {
                    $gen = false;
               }else{
                    $gen = true;
               }
               $i = $i + $j - 1;
          }
          return($random);
     }
}

if(!function_exists('get_nb_teacher_language')){
     function get_nb_teacher_language($settings_language_id){
          $CI = &get_instance();
          $CI->db->select("count(teachers.teacher_id) as teacher_nb");
          $CI->db->from("teachers");
          $CI->db->join("teacher_languages", "teacher_languages.teacher_id = teachers.teacher_id");
          $CI->db->where("teacher_languages.settings_language_id", $settings_language_id);
          $CI->db->where("teachers.teacher_locked !=", 1);
          $result = $CI->db->get();
          $num = @$result->row()->teacher_nb;
          return($num);
     }
}

if(!function_exists('get_month_fr')){
     function get_month_fr($month){
          switch($month){
               case 1: return "Janvier";
               case 2: return "Février";
               case 3: return "Mars";
               case 4: return "Avril";
               case 5: return "Mai";
               case 6: return "Juin";
               case 7: return "Juillet";
               case 8: return "Août";
               case 9: return "Septembre";
               case 10: return "Octobre";
               case 11: return "Novembre";
               case 12: return "Décembre";
          }
          return false;
     }
}

if(!function_exists('get_month_gb')){
     function get_month_gb($month){
          switch($month){
               case 1: return "January";
               case 2: return "February";
               case 3: return "March";
               case 4: return "April";
               case 5: return "May";
               case 6: return "June";
               case 7: return "Jully";
               case 8: return "August";
               case 9: return "September";
               case 10: return "October";
               case 11: return "November";
               case 12: return "December";
          }
          return false;
     }
}

if(!function_exists('timezone_convert')){
     function timezone_convert($from, $to){
          //Let's say it is 11pm 23:00 in LA
          $local_tz = new DateTimeZone($from);
          $local = new DateTime('now', $local_tz);

          //NY is 3 hours ahead, so it is 2am, 02:00
          $user_tz = new DateTimeZone($to);
          $user = new DateTime('now', $user_tz);

          $usersTime = new DateTime($user->format('Y-m-d H:i:s'));
          $localsTime = new DateTime($local->format('Y-m-d H:i:s'));

          // $interval = $usersTime->diff($localsTime);
          $interval = date_diff($usersTime, $localsTime, false);
          if ($usersTime > $localsTime) {
               return(+$interval->h);
          }elseif ($localsTime > $usersTime) {
               return(-$interval->h);
          }else{
               return 0;
          }
     }
}

if(!function_exists('get_timezoned_time')){
     function get_timezoned_time($time, $portion, $ecart){
          if ($ecart < 0 || $ecart > 0) {
               $seconds = 60*60*$ecart;
               $nowtime = DateTime::createFromFormat("H:i:s", $time);
               $date = date('h:i:s A', strtotime($nowtime->format('H:i:s'))+$seconds);
               return($date);
          } else {
               return($time);
          }

     }
}



if(!function_exists('get_project_months')){
     function get_project_months($debut, $month){
          $ts2 = strtotime($debut . "+".$month." months");

          $year1 = gmdate('Y');
          $year2 = date('Y', $ts2);

          $month1 = gmdate('m');
          $month2 = date('m', $ts2);

          $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

          return $diff;
     }
}


if(!function_exists('quill_format')){
     function quill_format($text, $width="12"){
          $to_ignore = array(
               '&lt;input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"&gt;',
                    '<div class="ql-editor" data-gramm="false" contenteditable="true" data-placeholder="Description du contenue ...">',
                    '<input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL">',
                         '<input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL" data-np-checked="1">',
                              '&lt;input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL" data-np-checked="1"&gt;',
                                   '<div class="ql-editor" data-gramm="false" contenteditable="true" data-placeholder="Description du projet ...">',
                                   '<div class="ql-editor ql-blank" data-gramm="false" contenteditable="true" data-placeholder="Description du projet ...">',
                                   '<div class="ql-clipboard" contenteditable="true" tabindex="-1">',
                                   '<div class="ql-tooltip ql-hidden">',
                                   '</div>'
                              );
                              $text = str_replace($to_ignore, "", $text);
                              $text = str_replace("<h1", "<h1 class='col-12 text-info'", $text);
                              $text = str_replace("<h2", "<h2 class='col-12 text-info'", $text);
                              $text = str_replace("<h3", "<h3 class='col-12 text-info'", $text);
                              $text = str_replace("<h4", "<h4 class='col-12 text-info'", $text);
                              $text = str_replace("<h5", "<h5 class='col-12 text-info'", $text);
                              $text = str_replace("<h6", "<h6 class='col-12 text-info'", $text);
                              $text = str_replace("<p", "<p class='col-12'", $text);
                              $text = str_replace("<ul", "<ul class='col-12'", $text);
                              $text = str_replace("<li", "<li class='col-12 ml-5'", $text);

                              return $text;
                         }
                    }


                    if(!function_exists('get_teacher_time')){
                         function get_teacher_time($teacher_timezone, $time){
                              // ndebug($time);
                              $datetime = new DateTime($time, new DateTimeZone($teacher_timezone));
                              $datetime->setTimezone(new DateTimeZone(get_timezone()));
                              return $datetime;
                         }
                    }

                    if(!function_exists('get_remaining_credits')){
                         function get_remaining_credits($customer_id, $settings_language_id, $type){
                              $settings_credit_id = id_getter('settings_credit_id', 'settings_credits', 'settings_credit_code', $type);

                              $CI = &get_instance();
                              $CI->db->select("sum(customer_credits.customer_credit_value) as credit_nb");
                              $CI->db->from("customer_credits");
                              $CI->db->where("customer_credits.settings_language_id", $settings_language_id);
                              $CI->db->where("customer_credits.customer_id", $customer_id);
                              $CI->db->where("customer_credits.settings_credit_id", $settings_credit_id);
                              $result = $CI->db->get();
                              $credit_nb = @$result->row()->credit_nb;

                              $CI->db->select("count(customer_schedules.customer_schedule_id) as scheduleded_nb");
                              $CI->db->from("customer_schedules");
                              $CI->db->join("customer_credits", "customer_credits.customer_credit_id = customer_schedules.customer_credit_id");
                              $CI->db->where("customer_schedules.settings_language_id", $settings_language_id);
                              $CI->db->where("customer_schedules.customer_id", $customer_id);
                              $CI->db->where("customer_credits.settings_credit_id", $settings_credit_id);
                              $result = $CI->db->get();

                              $scheduleded_nb = @$result->row()->scheduleded_nb;

                              $result = $credit_nb - $scheduleded_nb;
                              return($result);
                         }
                    }

                    // if(!function_exists('get_com_value')){
                    //      function get_com_value($type, $pricing_id){
                    //           $taux = config($type);
                    //
                    //           $CI = &get_instance();
                    //           $CI->db->select("pricing_value");
                    //           $CI->db->from("pricings");
                    //           $CI->db->where("pricings.pricing_id", $pricing_id);
                    //           $result = $CI->db->get();
                    //           $pricing_value = (float) @$result->row()->pricing_value;
                    //           $result = round((($pricing_value * $taux)/100), 2);
                    //           return($result);
                    //      }
                    // }

                    if(!function_exists('get_com_value')){
                         function get_com_value($teacher_id, $settings_language_id, $customer_schedule_id){

                              $CI = &get_instance();

                              $CI->db->select("*");
                              $CI->db->from("teacher_commissions");
                              $CI->db->where("teacher_commissions.teacher_id", $teacher_id);
                              $CI->db->where("teacher_commissions.settings_language_id", $settings_language_id);
                              $CI->db->where("teacher_commissions.teacher_commission_locked", 0);
                              $result = $CI->db->get();
                              $teacher_commission = @$result->row();

                              $data = array();
                              $data['teacher_commission_id'] = $teacher_commission->teacher_commission_id;
                              $CI->db->where("customer_schedules.customer_schedule_id", $customer_schedule_id);
                              $CI->db->where("customer_schedules.teacher_commission_id", null);
                              $CI->db->update("customer_schedules", $data);

                              $CI->db->select("*");
                              $CI->db->from("teacher_commissions");
                              $CI->db->join("customer_schedules", "customer_schedules.teacher_commission_id = teacher_commissions.teacher_commission_id");
                              $CI->db->where("customer_schedules.customer_schedule_id", $customer_schedule_id);
                              $result = $CI->db->get();
                              $teacher_commission = @$result->row();
                              $teacher_commission_value = (float) $teacher_commission->teacher_commission_value;
                              $result = round(($teacher_commission_value/2), 2);

                              return($result);
                         }
                    }

                    if(!function_exists('get_teacher_month_salary')){
                         function get_teacher_month_salary($teacher_id, $month, $year, $settings_language_id=0){

                              $CI = &get_instance();

                              $sum = 0;

                              $CI->db->select('*');
                              $CI->db->from('customer_schedules');
                              $CI->db->join('schedules','schedules.schedule_id = customer_schedules.schedule_id');
                              $CI->db->join('customer_credits','customer_credits.customer_credit_id = customer_schedules.customer_credit_id');
                              $CI->db->join('pricings','pricings.pricing_id = customer_credits.pricing_id');
                              $CI->db->where('customer_schedules.customer_schedule_date <=', $year."-".$month."-31");
                              $CI->db->where('customer_schedules.customer_schedule_date >=', $year."-".$month."-1");
                              $CI->db->where('customer_schedules.customer_schedule_date <=', gmdate('Y-m-d'));
                              $CI->db->where('schedules.teacher_id', $teacher_id);
                              if($settings_language_id != 0){
                                   $CI->db->where('customer_schedules.settings_language_id', $settings_language_id);
                              }

                              $courses = $CI->db->get()->result();

                              foreach ($courses as $key => $course) {
                                   $sum += @get_com_value($course->teacher_id, $course->settings_language_id, $course->customer_schedule_id);
                              }

                              // if($teacher_id == 19 && $year == 2020){

                              if($month == gmdate('m') && $year == gmdate("Y")){
                                   $CI->db->select('*');
                                   $CI->db->from('teacher_payments');
                                   $CI->db->where('teacher_payments.teacher_payment_month', $month);
                                   $CI->db->where('teacher_payments.teacher_payment_year', $year);
                                   $CI->db->where('teacher_payments.teacher_id', $teacher_id);
                                   $query = $CI->db->get();
                                   $payment_num = $query->num_rows();
                                   $data = array();
                                   $tmp = explode(",", (string)$sum);
                                   $data['teacher_payment_salary'] = @$tmp[0].".".@$tmp[1];
                                   $tmp = explode(",", (string)@get_teacher_tip($course->teacher_id, "month")['sum']);
                                   $data['teacher_payment_tips'] = @$tmp[0].".".@$tmp[1];
                                   $tmp = explode(",", (string)($sum+@get_teacher_tip($course->teacher_id, "month")['sum']));
                                   $data['teacher_payment_amount'] = @$tmp[0].".".@$tmp[1];
                                   if($payment_num >= 1){
                                        $payment = $query->row();
                                        $CI->db->where('teacher_payment_id', $payment->teacher_payment_id);
                                        $CI->db->update("teacher_payments", $data);
                                   }else{
                                        $data['teacher_payment_month'] = $month;
                                        $data['teacher_payment_year'] = $year;
                                        $data['teacher_id'] = $teacher_id;
                                        $data['settings_payment_id'] = id_getter('settings_payment_id', 'settings_payments', 'settings_payment_code', '!paid');
                                        $CI->db->insert('teacher_payments', $data);
                                   }
                              }
                              return($sum);
                         }
                    }

                    if(!function_exists('is_remaining_credit_full')){
                         function is_remaining_credit_full($customer_credit_id, $customer_credit_values){

                              $CI = &get_instance();
                              $CI->db->select("count(customer_credit_id) as credit_nb");
                              $CI->db->from("customer_schedules");
                              $CI->db->where("customer_schedules.customer_credit_id", $customer_credit_id);
                              $result = $CI->db->get();
                              $credit_nb = @$result->row()->credit_nb;

                              if($credit_nb >= $customer_credit_values){
                                   return true;
                              }else{
                                   return false;
                              }
                         }
                    }

                    if(!function_exists('is_first_course')){
                         function is_first_course($customer_id, $customer_schedule_id){

                              $CI = &get_instance();
                              $CI->db->select("customer_schedule_id");
                              $CI->db->from("customer_schedules");
                              $CI->db->where("customer_schedules.customer_id", $customer_id);
                              $CI->db->order_by("customer_schedules.customer_schedule_id", "asc");
                              $result = $CI->db->get();
                              $customer_schedule_id_first = @$result->row()->customer_schedule_id;

                              if($customer_schedule_id_first == $customer_schedule_id){
                                   return true;
                              }else{
                                   return false;
                              }
                         }
                    }

                    if(!function_exists('get_next_customer_credit')){
                         function get_next_customer_credit($customer_id, $settings_language_id){
                              if(get_remaining_credits(get_customer_info(me('user_id'))->customer_id, get_customer_info(me('user_id'))->settings_language_id, 'free') > 0){
                                   $settings_credit_id = id_getter('settings_credit_id', 'settings_credits', 'settings_credit_code', 'free');

                                   $CI = &get_instance();
                                   $CI->db->select("customer_credit_id, customer_credit_value");
                                   $CI->db->from("customer_credits");
                                   $CI->db->where("customer_credits.settings_language_id", $settings_language_id);
                                   $CI->db->where("customer_credits.customer_id", $customer_id);
                                   $CI->db->where("customer_credits.settings_credit_id", $settings_credit_id);
                                   $CI->db->order_by("customer_credits.customer_credit_id");
                                   $result = $CI->db->get();
                                   $customer_credits = @$result->result();

                                   foreach ($customer_credits as $customer_credit) {
                                        if(is_remaining_credit_full($customer_credit->customer_credit_id, $customer_credit->customer_credit_value) == false){
                                             return $customer_credit->customer_credit_id;
                                        }
                                   }
                              }else{
                                   $settings_credit_id = id_getter('settings_credit_id', 'settings_credits', 'settings_credit_code', 'paid');

                                   $CI = &get_instance();
                                   $CI->db->select("customer_credit_id, customer_credit_value");
                                   $CI->db->from("customer_credits");
                                   $CI->db->where("customer_credits.settings_language_id", $settings_language_id);
                                   $CI->db->where("customer_credits.customer_id", $customer_id);
                                   $CI->db->where("customer_credits.settings_credit_id", $settings_credit_id);
                                   $CI->db->order_by("customer_credits.customer_credit_id");
                                   $result = $CI->db->get();
                                   $customer_credits = @$result->result();

                                   foreach ($customer_credits as $customer_credit) {
                                        if(is_remaining_credit_full($customer_credit->customer_credit_id, $customer_credit->customer_credit_value) == false){
                                             return $customer_credit->customer_credit_id;
                                        }
                                   }
                              }

                              return 0;
                         }
                    }

                    if(!function_exists('get_min_pricing')){
                         function get_min_pricing($settings_language_id){

                              $CI = &get_instance();
                              $CI->db->select("pricing_id");
                              $CI->db->from("pricings");
                              $CI->db->where("pricings.settings_language_id", $settings_language_id);
                              $CI->db->order_by("pricings.pricing_value", "desc");

                              $result = $CI->db->get();
                              return @$result->row()->pricing_id;
                         }
                    }

                    if(!function_exists('get_customer_by_email')){
                         function get_customer_by_email($user_email){

                              $CI = &get_instance();
                              $CI->db->select("*");
                              $CI->db->from("customers");
                              $CI->db->join("users", "users.user_id = customers.user_id");
                              $CI->db->join("users_2_persons", "users_2_persons.user_id = users.user_id");
                              $CI->db->join("persons", "persons.person_id = users_2_persons.person_id");

                              $CI->db->where("users.user_email", $user_email);

                              $result = $CI->db->get();
                              return @$result->row();
                         }
                    }

                    if(!function_exists('get_user_by_email')){
                         function get_user_by_email($user_email){

                              $CI = &get_instance();
                              $CI->db->select("*");
                              $CI->db->from("users");
                              $CI->db->join("users_2_persons", "users_2_persons.user_id = users.user_id");
                              $CI->db->join("persons", "persons.person_id = users_2_persons.person_id");

                              $CI->db->where("users.user_email", $user_email);

                              $result = $CI->db->get();
                              return @$result->row();
                         }
                    }

                    if(!function_exists('get_schedule')){
                         function get_schedule($customer_id, $profile){

                              $CI = &get_instance();
                              $CI->db->limit(10);
                              $CI->db->select('*');
                              $CI->db->from('customer_schedules');
                              $CI->db->join('schedules','schedules.schedule_id = customer_schedules.schedule_id');
                              $CI->db->where('customer_schedules.customer_schedule_date >', gmdate('Y-m-d'));
                              $CI->db->where('customer_schedules.customer_id', $customer_id);
                              $CI->db->order_by('customer_schedules.customer_schedule_date');
                              $CI->db->order_by('schedules.schedule_time_portion');
                              $CI->db->order_by('schedules.schedule_time');
                              $courses = $CI->db->get()->result();

                              foreach ($courses as $key => $course) {
                                   $CI->db->select('*');
                                   $CI->db->from('users');
                                   $CI->db->join('users_2_persons','users_2_persons.user_id = users.user_id');
                                   $CI->db->join('persons','persons.person_id = users_2_persons.person_id');
                                   $CI->db->join('teachers','teachers.user_id = users.user_id');
                                   $CI->db->join('settings_timezones','settings_timezones.settings_timezone_id = users.settings_timezone_id');
                                   $CI->db->where('teachers.teacher_id', $course->teacher_id);
                                   $course->teacher = $CI->db->get()->row();

                                   $CI->db->select('*');
                                   $CI->db->from('users');
                                   $CI->db->join('users_2_persons','users_2_persons.user_id = users.user_id');
                                   $CI->db->join('persons','persons.person_id = users_2_persons.person_id');
                                   $CI->db->join('customers','customers.user_id = users.user_id');
                                   $CI->db->where('customers.customer_id', $course->customer_id);
                                   $course->customer = $CI->db->get()->row();
                              }

                              if($profile == 'customer'){
                                   foreach ($courses as $key => $schedule) {
                                        // $current = $schedule->schedule_time." ".$schedule->schedule_time_portion;
                                        // $new_time = get_teacher_time($tmp['data'][0]->settings_timezone_name, $current);
                                        // if(timezone_convert($tmp['data'][0]->settings_timezone_name, get_timezone()) != 0){
                                        //      $schedule->customer_schedule_date = $new_time->format('Y-m-d');
                                        //      $schedule->schedule_time = $new_time->format('h:i:s');
                                        //      $schedule->schedule_time_portion = $new_time->format('a');
                                        // }
                                        $new_time = get_timezoned_time($schedule->schedule_time, $schedule->schedule_time_portion, timezone_convert($courses[0]->teacher->settings_timezone_name, get_timezone()));
                                        if(timezone_convert($courses[0]->teacher->settings_timezone_name, get_timezone()) != 0){
                                             $tmp = explode(" ", $new_time);
                                             $schedule->schedule_time = $tmp[0];
                                             $schedule->schedule_time_portion = strtolower($tmp[1]);
                                        }
                                   }
                              }

                              return ($courses);
                         }
                    }

                    if(!function_exists('get_current_credits')){
                         function get_current_credits($customer_id = 0){

                              $result = array();

                              if ($customer_id == 0) {
                                   $customer_id = get_customer_info(me('user_id'))->customer_id;
                              }

                              $CI = &get_instance();
                              $CI->db->select("*");
                              $CI->db->from("settings_languages");
                              $languages = $CI->db->get()->result();

                              foreach ($languages as $language) {
                                   $remaining = @get_remaining_credits($customer_id, @$language->settings_language_id, 'paid') + @get_remaining_credits($customer_id, @$language->settings_language_id, 'free');
                                   if($remaining >= 1){
                                        $language->credit = $remaining;
                                        array_push($result, $language);
                                   }
                              }

                              return @$result;
                         }
                    }

                    if(!function_exists('ndebug')){
                         function ndebug($data){
                              echo '<pre>';
                              var_dump($data);
                              echo '</pre>';
                              die();
                         }
                    }
