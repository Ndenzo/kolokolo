<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('get_project_investments')){
     function get_project_investments($project_id){
          $CI = &get_instance();
          $CI->db->select('sum(project_invest_value) as total_invest');
          $CI->db->from('project_invests');
          $CI->db->where('project_invests.project_id', $project_id);
          $project_invest = $CI->db->get()->row();
          return $project_invest->total_invest;
     }
}

if(!function_exists('get_project_tx')){
     function get_project_tx($project_id){
          $total_invest = get_project_investments($project_id);

          $CI = &get_instance();
          $CI->db->select('project_value');
          $CI->db->from('projects');
          $CI->db->where('projects.project_id', $project_id);
          $project = $CI->db->get()->row();
          $tx = $total_invest/$project->project_value*100;
          return round($tx, 0);
     }
}

if(!function_exists('get_project_investors')){
     function get_project_investors($project_id){

          $CI = &get_instance();

          $CI->db->select('*');
          $CI->db->from('project_invests');
          $CI->db->join('investors','investors.investor_id = project_invests.investor_id');
          $CI->db->join('users_2_persons','users_2_persons.user_id = investors.user_id');
          $CI->db->join('persons','persons.person_id = users_2_persons.person_id');
          $CI->db->where('project_invests.project_id', $project_id);

          $projects = $CI->db->get()->result();

          return $projects;
     }
}

if(!function_exists('decaissement_code_generator')){
     function decaissement_code_generator(){
          $CI = &get_instance();
          $CI->db->select("decaissement_bon_id");
          $CI->db->from("decaissement_bons");
          $CI->db->order_by("decaissement_bon_id", "desc");
          $result = $CI->db->get();
          $decaissement_bon_id = @$result->row()->decaissement_bon_id;
          $num = sprintf("%05d",  (int)@$result->num_rows()+1);
          $timer = date("m-y");
          $num = "D-".$num."-".$timer;
          return($num);
     }
}

if(!function_exists('get_investor_nb')){
     function get_investor_nb($role_code = "all"){
          $to_consider = array('potentiel', 'investisseur', 'partenaire');
          $CI = &get_instance();

          $CI->db->select('count(user_id) as nb_investor');
          $CI->db->from('users');
          $CI->db->join('users_roles','users_roles.role_id = users.role_id');
          if($role_code != "all"){
               $CI->db->where('users_roles.role_code', $role_code);
          }else{
               $CI->db->where_in('users_roles.role_code', $to_consider);
          }
          $users = $CI->db->get()->row();

          return thousand($users->nb_investor);
     }
}

if(!function_exists('get_last_investments')){
     function get_last_investments(){

          $CI = &get_instance();

          $CI->db->limit('5');
          $CI->db->select('*');
          $CI->db->from('project_invests');
          $CI->db->join('investors','investors.investor_id = project_invests.investor_id');
          $CI->db->join('users','users.user_id = investors.user_id');
          $CI->db->join('users_roles','users_roles.role_id = users.role_id');

          $CI->db->join('users_2_persons','users_2_persons.user_id = investors.user_id');
          $CI->db->join('persons','persons.person_id = users_2_persons.person_id');
          $CI->db->join('projects','projects.project_id = project_invests.project_id');

          $CI->db->order_by('project_invests.project_invest_id', 'desc');

          $Investments = $CI->db->get()->result();

          return $Investments;
     }
}

if(!function_exists('get_active_projects')){
     function get_active_projects(){

          $CI = &get_instance();

          $CI->db->limit('10');
          $CI->db->distinct('project_invests.project_id');

          $CI->db->select('project_invests.project_id');
          $CI->db->from('project_invests');
          $CI->db->order_by('project_invests.project_invest_id', 'desc');

          $projects = $CI->db->get()->result();

          $data = array();

          foreach ($projects as $key => $project) {

               $CI->db->select('*');
               $CI->db->from('projects','projects.project_id = project_invests.project_id');
               $CI->db->where('projects.project_id', $project->project_id);

               $result = $CI->db->get()->row();

               $result->total_invest = get_project_investments($project->project_id);
               $result->tx = get_project_tx($project->project_id);

               array_push($data, $result);

          }

          return $data;
     }

     if(!function_exists('get_studies_nb')){
          function get_studies_nb(){
               $CI = &get_instance();
               $CI->db->select('count(studie_id) as nb_studies');
               $CI->db->from('studies');
               $studies = $CI->db->get()->row();
               return $studies->nb_studies;
          }
     }

     if(!function_exists('get_states_nb')){
          function get_states_nb(){
               $CI = &get_instance();
               $CI->db->select('count(sim_state_id) as nb_states');
               $CI->db->from('sim_states');
               $states = $CI->db->get()->row();
               return $states->nb_states;
          }
     }

     if(!function_exists('get_towns_nb')){
          function get_towns_nb(){
               $CI = &get_instance();
               $CI->db->select('count(sim_town_id) as nb_towns');
               $CI->db->from('sim_towns');
               $towns = $CI->db->get()->row();
               return $towns->nb_towns;
          }
     }
}
