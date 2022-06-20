<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chart extends IBEMS_Controller
{
     protected $__user_id;

     function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }


     function get_language_preferences(){
          $result = array();

          $this->db->select('*');
          $this->db->from('settings_languages');

          $query = $this->db->get();
          $settings_languages = @$query->result();

          $this->db->select('*');
          $this->db->from('customers');

          $query = $this->db->get();
          $customers = @$query->result();

          foreach ($settings_languages as $settings_language) {

               @$settings_language->customers = 0;

               foreach ($customers as $customer) {
                    $this->db->select('DISTINCT(customer_credits.customer_id)');
                    $this->db->from('customer_credits');
                    $this->db->join('settings_credits', 'settings_credits.settings_credit_id = customer_credits.settings_credit_id');
                    $this->db->where('customer_credits.customer_id', $customer->customer_id);
                    $this->db->where('settings_credits.settings_credit_code', "free");
                    $this->db->order_by('settings_credits.settings_credit_id', "asc");

                    $query = $this->db->get();
                    $customer_credit = @$query->row();

                    if($settings_language->settings_language_id == $customer->settings_language_id){
                         @$settings_language->customers ++;
                    }
               }

               @$settings_language->customers_percent = round((@$settings_language->customers/count($customers) * 100), 2);
          }

          $result['data']['settings_languages'] = @$settings_languages;
          $result['data']['customers'] = @$customers;

          if($result['data'] != null){
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function get_customer_stats(){
          $result = array();

          $result['data']['female'] = array();
          $result['data']['male'] = array();
          $result['data']['prospect'] = array();
          $result['data']['customer'] = array();
          $result['data']['undeclared'] = array();

          $this->db->select('*');
          $this->db->from('customers');
          $this->db->join('users','users.user_id = customers.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = customers.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          $this->db->where('persons.person_gender_id !=', null);
          $declared_customers = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('customers');
          $this->db->join('users','users.user_id = customers.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = customers.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          $customers = $this->db->get()->result();

          $result['data']['female']['nb'] = 0;
          $result['data']['male']['nb'] = 0;

          foreach ($declared_customers as $declared_customer) {
               if ($declared_customer->person_gender_id == 1) {
                    $result['data']['female']['nb'] ++;
               }else{
                    $result['data']['male']['nb'] ++;
               }
          }

          $result['data']['female']['percent'] = round((@$result['data']['female']['nb']/count($customers) * 100), 1);
          $result['data']['male']['percent'] = round((@$result['data']['male']['nb']/count($customers) * 100), 1);

          $result['data']['undeclared']['nb'] = count($customers) - count($declared_customers);
          $result['data']['undeclared']['percent'] = round((@$result['data']['undeclared']['nb']/count($customers) * 100), 1);

          if($result['data'] != null){
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function get_monthly_sales(){
          $result = array();

          $month = gmdate("m");
          $year = gmdate("Y");
          $current_year = gmdate("Y");
          $result['data'] = array();
          $result['categories'] = array();
          $result['som_this_month_sales'] = 0;
          $result['som_last_month_sales'] = 0;
          $result['som_this_week_sales'] = 0;
          $result['som_total_sales'] = 0;

          $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
          $last ++;

          $this->db->distinct();
          $this->db->select('*');
          $this->db->from('customer_credits');
          $this->db->join('customers','customers.customer_id = customer_credits.customer_id');
          $this->db->join('settings_credits','settings_credits.settings_credit_id = customer_credits.settings_credit_id');
          $this->db->join('settings_languages','settings_languages.settings_language_id = customer_credits.settings_language_id');
          $this->db->join('pricings','pricings.pricing_id = customer_credits.pricing_id');
          $this->db->where('settings_credits.settings_credit_code', 'paid');
          $this->db->order_by('customer_credits.customer_credit_id', 'desc');
          $credits = $this->db->get()->result();

          $sum = 0;
          foreach ($credits as $credit) {
               if(gmdate("Y", $credit->customer_credit_added) == $year){
                    if(gmdate("m", $credit->customer_credit_added) == $month){
                         if(gmdate("d", $credit->customer_credit_added) >= 1 && gmdate("d", $credit->customer_credit_added) <= $last){
                              $sum += $credit->customer_credit_value * $credit->pricing_value;
                         }
                    }
               }
          }

          $result['som_this_month_sales'] = $sum;
          $result['som_total_sales'] += $sum;
          array_unshift($result['data'], $sum );
          array_unshift($result['categories'], @gmdate("M Y", strtotime("{$year}-{$month}-02")));

          for($i=1; $i<13; $i++) {
               if($month == 1){
                    $month = 12;
                    $year --;
               }
               else $month--;
               $data['y'] = gmdate("Y-m", strtotime("{$year}-{$month}-02"));
               $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
               $last ++;

               $sum = 0;
               foreach ($credits as $credit) {
                    if(gmdate("Y", $credit->customer_credit_added) == $year){
                         if(gmdate("m", $credit->customer_credit_added) == $month){
                              if(gmdate("d", $credit->customer_credit_added) >= 1 && gmdate("d", $credit->customer_credit_added) <= $last){
                                   $sum += $credit->customer_credit_value * $credit->pricing_value;
                              }
                         }
                    }
               }
               if($i == 1){
                    $result['som_last_month_sales'] = $sum;
               }
               $result['som_total_sales'] += $sum;
               array_unshift($result['data'], $sum );
               array_unshift($result['categories'], @gmdate("M Y", strtotime("{$year}-{$month}-02")));

               $end = strtotime('sunday this week '.get_timezone());
               $first = strtotime('monday this week '.get_timezone());
          }

          foreach ($credits as $credit) {
               if($credit->customer_credit_added >= $first && $credit->customer_credit_added <= $end){
                    $result['som_this_week_sales'] += ($credit->customer_credit_value * $credit->pricing_value);
               }
          }

          $result['status'] = true;

          echo json_encode($result);

     }

     function get_monthly_courses(){
          $result = array();

          $month = gmdate("m");
          $year = gmdate("Y");
          $current_year = gmdate("Y");
          $result['data'] = array();
          $result['categories'] = array();
          $result['som_this_month_courses'] = 0;
          $result['som_last_month_courses'] = 0;
          $result['som_this_week_courses'] = 0;
          $result['som_total_courses'] = 0;

          $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
          $last ++;

          $this->db->select('*');
          $this->db->from('customer_schedules');
          $this->db->join('schedules','schedules.schedule_id = customer_schedules.schedule_id');
          $this->db->join('customer_credits','customer_credits.customer_credit_id = customer_schedules.customer_credit_id');
          $this->db->join('pricings','pricings.pricing_id = customer_credits.pricing_id');
          $this->db->where('customer_schedules.customer_schedule_date <=', gmdate('Y-m-d'));
          $this->db->order_by('customer_schedules.customer_schedule_date', 'asc');
          $this->db->order_by('schedules.schedule_time_portion', 'asc');
          $this->db->order_by('schedules.schedule_time', 'asc');
          $courses = $this->db->get()->result();

          $sum = 0;
          foreach ($courses as $course) {
               if(gmdate("Y", strtotime($course->customer_schedule_date)) == $year){
                    if(gmdate("m", strtotime($course->customer_schedule_date)) == $month){
                         if(gmdate("d", strtotime($course->customer_schedule_date)) >= 1 && gmdate("d", strtotime($course->customer_schedule_date)) <= $last){
                              $sum ++;
                         }
                    }
               }
          }

          $result['som_this_month_courses'] = $sum;
          $result['som_total_courses'] += $sum;
          array_unshift($result['data'], $sum );
          array_unshift($result['categories'], @gmdate("M Y", strtotime("{$year}-{$month}-02")));

          for($i=1; $i<13; $i++) {
               if($month == 1){
                    $month = 12;
                    $year --;
               }
               else $month--;
               $data['y'] = gmdate("Y-m", strtotime("{$year}-{$month}-02"));
               $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
               $last ++;

               $sum = 0;
               foreach ($courses as $course) {
                    if(gmdate("Y", strtotime($course->customer_schedule_date)) == $year){
                         if(gmdate("m", strtotime($course->customer_schedule_date)) == $month){
                              if(gmdate("d", strtotime($course->customer_schedule_date)) >= 1 && gmdate("d", strtotime($course->customer_schedule_date)) <= $last){
                                   $sum ++;
                              }
                         }
                    }
               }
               if($i == 1){
                    $result['som_last_month_courses'] = $sum;
               }
               $result['som_total_courses'] += $sum;
               array_unshift($result['data'], $sum );
               array_unshift($result['categories'], @gmdate("M Y", strtotime("{$year}-{$month}-02")));

               $end = strtotime('sunday this week');
               $first = strtotime('monday this week');
          }

          foreach ($courses as $course) {
               if(strtotime($course->customer_schedule_date) >= $first && strtotime($course->customer_schedule_date) <= $end){
                    $result['som_this_week_courses'] ++;
               }
          }

          $result['status'] = true;

          echo json_encode($result);

     }

}
