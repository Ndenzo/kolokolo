<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('get_indicator_credit')){
     function get_indicator_credit(){
          $CI = &get_instance();
          $CI->db->select('sum(customer_credit_value) as nb_credit, sum(customer_credits.customer_credit_value * pricings.pricing_value) as val_credit');
          $CI->db->from('customer_credits');
          $CI->db->join('pricings', "pricings.pricing_id = customer_credits.pricing_id");
          $customer_credits = $CI->db->get()->row();
          return $customer_credits;
     }
}

if(!function_exists('get_indicator_credit_spec')){
     function get_indicator_credit_spec($type){
          $CI = &get_instance();
          $CI->db->select('sum(customer_credit_value) as nb_credit, sum(customer_credits.customer_credit_value * pricings.pricing_value) as val_credit');
          $CI->db->from('customer_credits');
          $CI->db->join('pricings', "pricings.pricing_id = customer_credits.pricing_id");
          $CI->db->join('settings_credits', "settings_credits.settings_credit_id = customer_credits.settings_credit_id");
          $CI->db->where('settings_credits.settings_credit_code', $type);
          $customer_credits = $CI->db->get()->row();
          return $customer_credits;
     }
}


if(!function_exists('get_nbCustomer')){
     function get_nbCustomer(){

          $CI = &get_instance();
          $CI->db->SELECT('count(customers.customer_id) as customers_nb');
          $CI->db->FROM('customers');
          $qry = $CI->db->get();
          $result = $qry->row()->customers_nb;
          return ($result);
     }
}

if(!function_exists('get_nbTeacher')){
     function get_nbTeacher(){
          $CI = &get_instance();
          $CI->db->SELECT('count(teachers.teacher_id) as teachers_nb');
          $CI->db->FROM('teachers');
          $qry = $CI->db->get();
          $result = $qry->row()->teachers_nb;
          return ($result);
     }
}

if(!function_exists('get_teachers_unpaid')){
     function get_teachers_unpaid(){
          $CI = &get_instance();
          $sum = 0;

          $CI->db->select('sum(teacher_payment_amount) as amount');
          $CI->db->from('teacher_payments');
          $CI->db->join('settings_payments','settings_payments.settings_payment_id = teacher_payments.settings_payment_id');
          $CI->db->where('settings_payments.settings_payment_code','!paid');
          $payment = $CI->db->get()->row();

          return((float)$payment->amount);
     }
}

if(!function_exists('get_balance_amount')){
     function get_balance_amount(){
          $CI = &get_instance();
          $sum = 0;

          $CI->db->select('sum(teacher_payment_amount) as amount');
          $CI->db->from('teacher_payments');
          $CI->db->join('settings_payments','settings_payments.settings_payment_id = teacher_payments.settings_payment_id');
          $payment = $CI->db->get()->row();

          $sales_value = get_indicator_credit_spec("paid")->val_credit;

          $balance = (float)$sales_value - (float)$payment->amount;

          return($balance);
     }
}

if(!function_exists('get_teacher_salary')){
     function get_teacher_salary($teacher_id, $type, $settings_language_id=0){

          $CI = &get_instance();

          $data = array();
          $sum = 0;
          $cpt = 0;

          if($type == "month"){
               $month = gmdate('m');
               $year = gmdate('Y');

               $end = $year."-".$month."-31";
               $first = $year."-".$month."-1";
          }else{
               $end = gmdate("Y-m-d", strtotime('sunday this week'));
               $first = gmdate("Y-m-d", strtotime('monday this week'));
          }

          $CI->db->select('*');
          $CI->db->from('customer_schedules');
          $CI->db->join('schedules','schedules.schedule_id = customer_schedules.schedule_id');
          $CI->db->join('customer_credits','customer_credits.customer_credit_id = customer_schedules.customer_credit_id');
          $CI->db->join('pricings','pricings.pricing_id = customer_credits.pricing_id');
          $CI->db->where('customer_schedules.customer_schedule_date <=', $end);
          $CI->db->where('customer_schedules.customer_schedule_date >=', $first);
          $CI->db->where('customer_schedules.customer_schedule_date <=', gmdate('Y-m-d'));
          $CI->db->where('schedules.teacher_id', $teacher_id);

          $courses = $CI->db->get()->result();

          foreach ($courses as $key => $course) {
               $sum += @get_com_value($course->teacher_id, $course->settings_language_id, $course->customer_schedule_id);
               $cpt ++;
          }

          $data['sum'] = $sum;
          $data['cpt'] = $cpt;

          return($data);
     }
}


if(!function_exists('get_nbCourses')){
     function get_nbCourses($categorie, $type = null){
          $CI = &get_instance();

          if ($type != null) {
               if($type == "month"){
                    $month = gmdate('m');
                    $year = gmdate('Y');

                    $end = $year."-".$month."-31";
                    $first = $year."-".$month."-1";
               }else{
                    if($type == "week"){
                         $end = gmdate("Y-m-d", strtotime('sunday this week'));
                         $first = gmdate("Y-m-d", strtotime('monday this week'));
                    }else{
                         $year = gmdate('Y');

                         $end = $year."-12-31";
                         $first = $year."-1-1";
                    }
               }
          }

          $CI->db->select('*');
          $CI->db->from('customer_schedules');
          $CI->db->join('schedules','schedules.schedule_id = customer_schedules.schedule_id');
          if($categorie == 'done') {
               $CI->db->where('customer_schedules.customer_schedule_date <=', gmdate('Y-m-d'));
               $CI->db->where('customer_schedules.customer_schedule_date <=', $end);
               $CI->db->where('customer_schedules.customer_schedule_date >=', $first);
          }else{
               $CI->db->where('customer_schedules.customer_schedule_date >', gmdate('Y-m-d'));
          }
          $courses = $CI->db->get()->result();

          return(count($courses));
     }
}
