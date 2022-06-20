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


     function get_project(){
          $result = array();

          $id = (int) $this->input->get_post('id');

          $this->db->select('*');
          $this->db->from('projects');
          $this->db->join('users','users.user_id = projects.project_added_by');
          $this->db->where('projects.project_id', $id);
          $project = $this->db->get()->row();

          $this->db->select('*');
          $this->db->from('project_pictures');
          $this->db->where('project_pictures.project_id', $id);
          $project->pictures = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_timelines');
          $this->db->where('project_timelines.project_id', $id);
          $project->timelines = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_schedules');
          $this->db->where('project_schedules.project_id', $id);
          $project->schedules = $this->db->get()->result();

          $result['data'] = @$project;

          if($result['data'] != null){
               $project->project_desc = quill_format($project->project_desc);
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function get_sim_params(){
          $result = array();

          $type_id = (int) $this->input->get_post('sim_type_id');
          $state_id = (int) $this->input->get_post('sim_state_id');
          $town_id = (int) $this->input->get_post('sim_town_id');

          $this->db->select('sim_param_value as yield');
          $this->db->from('sim_params');
          $this->db->where('sim_params.sim_type_id', $type_id);
          $this->db->where('sim_params.sim_state_id', $state_id);
          $this->db->where('sim_params.sim_town_id', $town_id);
          $param = $this->db->get()->row();

          $this->db->select('sim_state_rate');
          $this->db->from('sim_states');
          $this->db->where('sim_states.sim_state_id', $state_id);
          $tmp = $this->db->get()->row();
          $param->tx_emp = $tmp->sim_state_rate;

          $result['data'] = @$param;

          if($result['data'] != null){
               $result['status'] = true;
          }else{
               $result['status'] = false;
          }

          echo json_encode($result);
     }

     function get_month_data(){
          $result = array();

          $month = gmdate("m");
          $year = gmdate("Y");
          $result['data'][0]['y'] = gmdate("Y-m", strtotime("{$year}-{$month}-02"));
          $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
          $factures = self::get_operations(gmdate("Y-m-d", strtotime("{$year}-{$month}-02")), gmdate("Y-m-d", strtotime("{$year}-{$month}-{$last}")));
          $result['data'][0]['a'] = 0;
          foreach ($factures as $facture) {
               $result['data'][0]['a'] += @$facture["debit"];
          }
          for($i=1; $i<7; $i++) {
               if($month == 1){
                    $month = 12;
                    $year --;
               }
               else $month--;
               $data['y'] = gmdate("Y-m", strtotime("{$year}-{$month}-02"));
               $last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
               $factures = self::get_operations(gmdate("Y-m-d", strtotime("{$year}-{$month}-02")), gmdate("Y-m-d", strtotime("{$year}-{$month}-{$last}")));
               $data['a'] = 0;
               foreach ($factures as $facture) {
                    $data['a'] += @$facture["debit"];
               }
               array_unshift($result['data'], $data);
          }

          echo json_encode($result);

     }

     public function get_operations($date_deb, $date_fin){
          $operations = array();
          $operations_enc = array();
          // $operations_dec = array();

          $this->db->select('*');
          $this->db->from('project_invests');
          // $this->db->join('factures', 'factures.facture_id = encaissements.facture_id');
          $this->db->order_by('project_invest_added');
          $query = $this->db->get();
          $invests = $query->result();

          foreach ($invests as $invest) {
               $operation = array();
               $operation["added"] = $invest->project_invest_added;
               $operation["date"]= gmdate("Y-m-d H:i", $invest->project_invest_added);
               $operation["debit"]= $invest->project_invest_value;
               if(($date_deb <= gmdate("Y-m-d", $invest->project_invest_added)) && (gmdate("Y-m-d", $invest->project_invest_added)<= $date_fin)){
                    array_push($operations_enc, $operation);
               }
          }

          // $this->db->select('*');
          // $this->db->from('decaissements');
          // $this->db->join('decaissement_bons', 'decaissement_bons.decaissement_bon_id = decaissements.decaissement_bon_id');
          // $this->db->order_by('decaissement_added');
          // $query = $this->db->get();
          // $decaissements = $query->result();
          //
          // foreach ($decaissements as $decaissement) {
          //      $operation = array();
          //      $operation["added"] = $decaissement->decaissement_added;
          //      $operation["date"]= gmdate("Y-m-d H:i", $decaissement->decaissement_added);
          //      $operation["piece"]= $decaissement->decaissement_bon_num;
          //      $operation["libelle"]= $decaissement->decaissement_libelle;
          //      $operation["debit"]= 0;
          //      $operation["credit"]= $decaissement->decaissement_value;
          //      $operation["solde"] = $operation["debit"]- $operation["credit"];
          //      if(($date_deb <= gmdate("Y-m-d", $decaissement->decaissement_added)) && (gmdate("Y-m-d", $decaissement->decaissement_added)<= $date_fin)){
          //           array_push($operations_dec, $operation);
          //      }
          // }

          $n_enc = count($operations_enc);
          // $n_dec = count($operations_dec);

          $cpt_enc = 0;
          // $cpt_dec = 0;

          while($cpt_enc < $n_enc){
               array_push($operations, $operations_enc[$cpt_enc]);
               $cpt_enc++;
          }
          // if($cpt_dec == $n_enc){
          //      while($cpt_enc < $n_enc){
          //           array_push($operations, $operations_enc[$cpt_enc]);
          //           $cpt_enc++;
          //      }
          // }

          return $operations;
     }

     function update_user_lang(){
          $data = array();

          $data['user_lang'] = $this->input->get_post('lang');

          $this->db->where('user_id', me('user_id'));
          $result['status'] = $this->db->update('users', $data);

          $this->session->me->user_lang = $data['user_lang'];
          echo json_encode($result);
     }

}
