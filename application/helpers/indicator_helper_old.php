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

if(!function_exists('get_nbCourses')){
     function get_nbCourses($periode){
          $CI = &get_instance();
          $CI->db->SELECT('customer_schedules.customer_schedule_date as date');
          $CI->db->FROM('customer_schedules');
          $qry = $CI->db->get()->result();
          //today info

          //days in the month  01 to 31
          $this_day = date("d");
          //number of 7 days in the week (0 for sunday to 6 for saturday)
          $nday = date("w");
          //number of 12 months (01 to 12)
          $this_month = date("m");
          //year like xxxx
          $this_year = date("Y");

          // date account
          $nb_date=0;
            switch ($periode) {
              case "yesterday":
              $yesterday=$this_year."-".$this_month."-".($this_day-1);
              foreach ($qry as $key => $value) {
                if ($value->date==$yesterday) {
                  $nb_date= $nb_date + 1;
                }
              }
                break;
              case "week":
              foreach ($qry as $key => $value){
                $goodFormat=strtotime($value->date);
                $goodFormat2=strtotime("Y-m-d");
                if(date('W',$goodFormat)==date('W',$goodFormat2)){
                  $nb_date = $nb_date + 1;
              }
              }
                break;
              case "month":
              foreach ($qry as $key => $value){
                if (substr($value->date,5,2)==$this_month) {
                  $nb_date = $nb_date + 1;
                }
              }
                break;
              case "year":
              foreach ($qry as $key => $value){
                if (substr($value->date,0,4)==$this_year) {
                  $nb_date = $nb_date + 1;
                }
              }
                break;
              default:
                // code...
                break;
            }
          //}
          return ($nb_date);
        }
}
