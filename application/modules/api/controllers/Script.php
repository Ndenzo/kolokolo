<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Script extends IBEMS_Controller
{
     protected $__user_id;

     function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }


     function check_price(){
          $result = array();

          $settings_language_id = (int) $this->input->get_post('settings_language_id');
          $settings_pack_id = (int) $this->input->get_post('settings_pack_id');

          $this->db->select('*');
          $this->db->from('pricings');
          $this->db->join('settings_packs', 'settings_packs.settings_pack_id = pricings.settings_pack_id');
          $this->db->where('pricings.settings_language_id', $settings_language_id);
          $this->db->where('pricings.settings_pack_id', $settings_pack_id);

          $query = $this->db->get();
          $result['data'] = @$query->row();

          if($result['data'] != null){
               $result['data']->course_value = (float) $result['data']->pricing_value * (float) $result['data']->settings_pack_value;
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     //agenda
     function get_teacher_schedule(){
          $result = array();
          $teacher_id = get_teacher_info($this->__user_id)->teacher_id;

          $this->db->select('*');
          $this->db->from('schedules');
          $this->db->join('settings_opendays','settings_opendays.settings_openday_id = schedules.settings_openday_id');
          $this->db->join('customer_schedules','customer_schedules.schedule_id = schedules.schedule_id');
          $this->db->join('customers','customers.customer_id = customer_schedules.customer_id');
          $this->db->join('users','users.user_id = customers.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = users.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          $this->db->where('schedules.teacher_id', $teacher_id);
          $this->db->where('customer_schedules.customer_schedule_date >=', gmdate('Y-m-d'));
          $this->db->where('schedules.schedule_locked !=', 1);

          $query = $this->db->get();
          $schedules = @$query->result();

          if($schedules != false){
               $result['data'] = $schedules;
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     //Schedule
     function get_customer_all(){
          $result = array();
          $customer_id = get_customer_info($this->__user_id)->customer_id;

          $this->db->select('*');
          $this->db->from('customer_schedules');
          $this->db->where('customer_id', $customer_id);

          $query = $this->db->get();
          $schedules = @$query->result();

          if($schedules != false){
               $result['data'] = $schedules;
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function get_teacher_all(){
          $result = array();
          if(me('role_code') == 'customer'){
               $teacher_id = get_customer_info($this->__user_id)->teacher_id;
          }else{
               $teacher_id = get_teacher_info($this->__user_id)->teacher_id;
          }

          $this->db->select('*');
          $this->db->from('schedules');
          $this->db->join('settings_opendays','settings_opendays.settings_openday_id = schedules.settings_openday_id');
          $this->db->join('teachers','teachers.teacher_id = schedules.teacher_id');
          $this->db->join('users','users.user_id = teachers.user_id');
          $this->db->join('settings_timezones','settings_timezones.settings_timezone_id = users.settings_timezone_id');
          $this->db->where('schedules.teacher_id', $teacher_id);
          $this->db->where('schedules.schedule_locked !=', 1);

          $query = $this->db->get();
          $schedules = @$query->result();

          if(me('role_code') == 'customer'){
               foreach ($schedules as $key => $schedule) {
                    $current =  $schedule->schedule_time." ".$schedule->schedule_time_portion;
                    $new_time = get_teacher_time($schedules[0]->settings_timezone_name, $current);
                    if(timezone_convert($schedules[0]->settings_timezone_name, get_timezone()) != 0){

                         $day_before = date( 'Y-m-d', strtotime('yesterday') );
                         $day_after = date( 'Y-m-d', strtotime('tomorrow') );

                         $tz = new DateTimeZone(get_timezone());
                         $date = new DateTime(date( 'Y-m-d' )." ".$schedule->schedule_time." ".$schedule->schedule_time_portion, $tz);
                         $date->modify(timezone_convert($schedules[0]->settings_timezone_name, get_timezone()).' hours');

                         if($date->format('Y-m-d') == $day_before){
                              $schedule->settings_openday_id --;
                              if($schedule->settings_openday_id == 0){
                                   $schedule->settings_openday_id == 7;
                              }
                         }
                         if($date->format('Y-m-d') == $day_after){
                              $schedule->settings_openday_id ++;
                              if($schedule->settings_openday_id == 8){
                                   $schedule->settings_openday_id == 1;
                              }
                         }

                         $schedule->schedule_time = $new_time->format('h:i:s');
                         $schedule->schedule_time_portion = $new_time->format('a');

                    }
                    $schedule->customer_credit_id = get_next_customer_credit(get_customer_info(me('user_id'))->customer_id, get_customer_info(me('user_id'))->settings_language_id);
               }
          }

          if($schedules != false){
               $result['data'] = $schedules;
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function get_teacher_schedule_all(){
          $result = array();

          $teacher_id = get_teacher_info($this->__user_id)->teacher_id;

          $this->db->select('*');
          $this->db->from('schedules');
          $this->db->join('settings_opendays','settings_opendays.settings_openday_id = schedules.settings_openday_id');
          $this->db->join('customer_schedules','customer_schedules.schedule_id = schedules.schedule_id');
          $this->db->join('customers','customers.customer_id = customer_schedules.customer_id');
          $this->db->join('users','users.user_id = customers.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = users.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          $this->db->where('schedules.teacher_id', $teacher_id);
          $this->db->where('schedules.schedule_locked !=', 1);

          // $this->db->where('customer_schedules.customer_schedule_date >=', gmdate('Y-m-d'));

          $query = $this->db->get();
          $schedules = @$query->result();

          if($schedules != false){
               $result['data'] = $schedules;
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function is_scheduled(){
          $result = array();

          $schedule_id = (int) $this->input->get_post('schedule_id');
          $schedule_date = $this->input->get_post('date');
          $schedule_time = $this->input->get_post('time');
          $schedule_time_portion = $this->input->get_post('time_portion');
          $teacher_timezone_name = $this->input->get_post('teacher_timezone_name');

          if(timezone_convert(get_timezone(), $teacher_timezone_name) != 0){
               $tz = new DateTimeZone($teacher_timezone_name);
               $date = new DateTime(date_to_mysql($schedule_date, '/')." ".$schedule_time." ".$schedule_time_portion, $tz);
               $date->modify(timezone_convert(get_timezone(), $teacher_timezone_name).' hours');

               $customer_schedule_date = $date->format("Y-m-d");

          }else{
               $customer_schedule_date =  date_to_mysql($this->input->post('customer_schedule_date'), '/');
          }

          $this->db->select('*');
          $this->db->from('customer_schedules');
          $this->db->where('schedule_id', $schedule_id);
          $this->db->where('customer_schedule_date', $customer_schedule_date);

          $query = $this->db->get();
          $scheduled = @$query->result();

          if($scheduled != false){
               $result['data'] = $scheduled;
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);

     }

     function insert_credits(){
          $result = array();

          $settings_language_ids = $this->input->get_post('settings_language_id[]');
          $customer_credit_values = $this->input->get_post('customer_credit_value[]');
          $settings_pack_ids = $this->input->get_post('settings_pack_id[]');


          $this->db->trans_start();

          foreach ($settings_language_ids as $key => $settings_language_id) {
               $this->db->select('pricing_id');
               $this->db->from('pricings');
               $this->db->where('pricings.settings_pack_id', $settings_pack_ids[$key]);
               $this->db->where('pricings.settings_language_id', $settings_language_id);

               $query = $this->db->get();
               $pricing_id = @$query->row()->pricing_id;

               $data = array();
               $data['settings_language_id'] = $settings_language_id;
               $data['pricing_id'] = $pricing_id;
               $data['customer_credit_value'] = $customer_credit_values[$key];
               $data['settings_credit_id'] = id_getter('settings_credit_id', 'settings_credits', 'settings_credit_code', 'paid');
               $data['customer_id'] = get_customer_info($this->__user_id)->customer_id;
               $data['customer_credit_added_by'] = $this->__user_id;
               $data['customer_credit_added'] = time();
               $data['customer_credit_modified'] = time();
               $data['customer_credit_locked'] = 0;
               $this->db->insert('customer_credits', $data);
          }
          $this->db->trans_complete();

          if ($this->db->trans_status() === FALSE)
          {
               $result['status'] = false;
          }else{
               $result['status'] = true;
          }

          echo json_encode($result);
     }

     public function get_event($first_day_week){
          $result = array();
          $date = new DateTime(date("Y-m-d", strtotime($first_day_week)), new DateTimeZone(get_timezone()));
          $to_day = $date->format('Y-m-d');
          $result['data'] = array();
          $cpt = 0;

          for ($i=1; $i < 8; $i++) {

               $tmp['date'] = date("l", strtotime('+'.($i-1).' day', strtotime($to_day)));
               $current_date = strtotime('+'.$i.' day', strtotime($to_day));

               if (me('role_code') == "customer") {
                    $customer_id = get_customer_info(me('user_id'))->customer_id;
                    $this->db->select('*');
                    $this->db->from('schedules');
                    $this->db->join('customer_schedules','customer_schedules.schedule_id = schedules.schedule_id');
                    $this->db->join('teachers','teachers.teacher_id = schedules.teacher_id');
                    $this->db->join('users','users.user_id = teachers.user_id');
                    $this->db->join('users_2_persons','users_2_persons.user_id = users.user_id');
                    $this->db->join('persons','persons.person_id = users_2_persons.person_id');
                    $this->db->join('settings_timezones','settings_timezones.settings_timezone_id = users.settings_timezone_id');
                    $this->db->join('settings_languages','settings_languages.settings_language_id = customer_schedules.settings_language_id');
                    $this->db->where('customer_schedules.customer_schedule_customer_date', gmdate('Y-m-d', $current_date));
                    $this->db->where('customer_schedules.customer_id', $customer_id);
                    $this->db->where('schedules.schedule_locked !=', 1);
                    $this->db->order_by('customer_schedules.customer_schedule_time', 'asc');

                    $query = $this->db->get();
                    $tmp['data'] = $query->result();
                    $result['type'] = "customer";
               }

               if (me('role_code') == "teacher") {
                    $teacher_id = get_teacher_info(get_user_info('user_id'))->teacher_id;
                    $this->db->select('*');
                    $this->db->from('schedules');
                    $this->db->join('customer_schedules','customer_schedules.schedule_id = schedules.schedule_id');
                    $this->db->join('customers','customers.customer_id = customer_schedules.customer_id');
                    $this->db->join('users','users.user_id = customers.user_id');
                    $this->db->join('users_2_persons','users_2_persons.user_id = users.user_id');
                    $this->db->join('persons','persons.person_id = users_2_persons.person_id');
                    $this->db->join('settings_timezones','settings_timezones.settings_timezone_id = users.settings_timezone_id');
                    $this->db->join('settings_languages','settings_languages.settings_language_id = customer_schedules.settings_language_id');
                    $this->db->where('customer_schedules.customer_schedule_date', gmdate('Y-m-d', $current_date));
                    $this->db->where('schedules.teacher_id', $teacher_id);
                    $this->db->where('schedules.schedule_locked !=', 1);
                    $this->db->order_by('schedules.schedule_time', 'asc');

                    $query = $this->db->get();
                    $tmp['data'] = $query->result();
                    $result['type'] = "teacher";
               }

               $cpt += count($tmp['data']);
               array_push($result['data'], $tmp);
          }

          $result['nb_schedules'] = $cpt;

          if ($this->db->trans_status() === FALSE)
          {
               $result['status'] = false;
          }else{
               $result['status'] = true;
          }

          echo json_encode($result);
     }

}
