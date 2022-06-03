<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Investor_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
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

          $this->db->select('*');
          $this->db->from('project_reports');
          $this->db->where('project_reports.project_id', $id);
          $this->db->order_by('project_report_id', 'desc');
          $project->reports = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_infos');
          $this->db->join('users','users.user_id = project_infos.project_info_added_by');
          $this->db->where('project_infos.project_id', $id);
          $this->db->order_by('project_info_id', 'desc');
          $project->infos = $this->db->get()->result();
          
          foreach ($project->infos as $key => $info) {
               $this->db->select('*');
               $this->db->from('project_info_pictures');
               $this->db->where('project_info_pictures.project_info_id', $info->project_info_id);
               $info->pictures = $this->db->get()->result();
          }

          $this->db->select('sim_param_value as yield');
          $this->db->from('sim_params');
          $this->db->where('sim_params.sim_type_id', $project->sim_type_id);
          $this->db->where('sim_params.sim_state_id', $project->sim_state_id);
          $this->db->where('sim_params.sim_town_id', $project->sim_town_id);
          $project->param = @$this->db->get()->row();

          $this->db->select('sim_state_rate');
          $this->db->from('sim_states');
          $this->db->where('sim_states.sim_state_id', $project->sim_state_id);
          $tmp = @$this->db->get()->row();
          $project->param->tx_emp = @$tmp->sim_state_rate;

          return ($project);
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = null)
     {
          $this->db->select('*');
          $this->db->from('projects');
          $this->db->join('users','users.user_id = projects.project_added_by');
          $this->db->order_by('project_id', 'desc');
          $projects = $this->db->get()->result();

          foreach ($projects as $key => $project) {

               $id = $project->project_id;

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
          }

          return ($projects);
     }

}
