<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Param_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('sim_params');
          $data['sim_param_added_by'] = $this->__user_id;
          $data['sim_param_added'] = time();
          $data['sim_param_modified'] = time();
          $data['sim_param_locked'] = 0;
          $checker = $this->db->insert('sim_params', $data);
          return ($checker);
     }

     public function update($args = array())
     {
          $this->db->trans_start();

          $sim_param_id = $this->input->post('sim_param_id');
          $data = IBEMS_Model::sanitize_for('sim_params');
          $data['sim_param_modified'] = time();
          $this->db->where('sim_param_id', $sim_param_id);
          $this->db->update('sim_params', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('sim_param_id');
          $this->db->where('sim_param_id', $id);
          $this->db->delete('sim_params');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('sim_params');
          $this->db->where('sim_param_id',$id);
          return ($this->db->get()->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('sim_states');
          $states = $this->db->get()->result();
          foreach ($states as $key => $state) {
               $this->db->select('*');
               $this->db->from('sim_towns');
               $this->db->where('sim_state_id', $state->sim_state_id);
               $state->towns = $this->db->get()->result();

               foreach ($state->towns as $key => $town) {
                    $this->db->select('*');
                    $this->db->from('sim_params');
                    $this->db->join('sim_types', 'sim_types.sim_type_id = sim_params.sim_type_id');
                    $this->db->where('sim_params.sim_town_id', $town->sim_town_id);
                    $town->params = $this->db->get()->result();
               }
          }
          return ($states);
     }

}
