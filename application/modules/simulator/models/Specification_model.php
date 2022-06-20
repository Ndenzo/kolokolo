<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Specification_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('sim_states');
          $data['sim_state_added_by'] = $this->__user_id;
          $data['sim_state_added'] = time();
          $data['sim_state_modified'] = time();
          $data['sim_state_locked'] = 0;
          $checker = $this->db->insert('sim_states', $data);
          return ($checker);
     }

     public function insert_town($args = array())
     {
          $data = IBEMS_Model::sanitize_for('sim_towns');
          $data['sim_town_added_by'] = $this->__user_id;
          $data['sim_town_added'] = time();
          $data['sim_town_modified'] = time();
          $data['sim_town_locked'] = 0;
          $checker = $this->db->insert('sim_towns', $data);
          return ($checker);
     }

     public function insert_type($args = array())
     {
          $data = IBEMS_Model::sanitize_for('sim_types');
          $data['sim_type_added_by'] = $this->__user_id;
          $data['sim_type_added'] = time();
          $data['sim_type_modified'] = time();
          $data['sim_type_locked'] = 0;
          $checker = $this->db->insert('sim_types', $data);
          return ($checker);
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $this->db->trans_start();

          $sim_state_id = $this->input->post('sim_state_id');
          $data = IBEMS_Model::sanitize_for('sim_states');
          $data['sim_state_modified'] = time();
          $this->db->where('sim_state_id', $sim_state_id);
          $this->db->update('sim_states', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update_town($args = array())
     {
          $this->db->trans_start();

          $sim_town_id = $this->input->post('sim_town_id');
          $data = IBEMS_Model::sanitize_for('sim_towns');
          $data['sim_town_modified'] = time();
          $this->db->where('sim_town_id', $sim_town_id);
          $this->db->update('sim_towns', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update_type($args = array())
     {
          $this->db->trans_start();

          $sim_type_id = $this->input->post('sim_type_id');
          $data = IBEMS_Model::sanitize_for('sim_types');
          $data['sim_type_modified'] = time();
          $this->db->where('sim_type_id', $sim_type_id);
          $this->db->update('sim_types', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Locker manager -----------------------------------------------------------

     public function locker($args = array())
     {
          $this->db->trans_start();

          $sim_state_id = $this->input->post('sim_state_id');
          $data = IBEMS_Model::sanitize_for('sim_states');
          $data['sim_state_modified'] = time();
          $this->db->where('sim_state_id', $sim_state_id);
          $this->db->update('sim_states', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('sim_state_id');
          $this->db->where('sim_state_id', $id);
          $this->db->delete('sim_states');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_town($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('sim_town_id');
          $this->db->where('sim_town_id', $id);
          $this->db->delete('sim_towns');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_type($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('sim_type_id');
          $this->db->where('sim_type_id', $id);
          $this->db->delete('sim_types');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Getter One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('sim_states');
          $this->db->where('sim_state_id',$id);
          return ($this->db->get()->row());
     }

     public function get_one_town($id)
     {
          $this->db->select('*');
          $this->db->from('sim_towns');
          $this->db->where('sim_town_id',$id);
          $town = $this->db->get()->row();
          $town->sim_state_update_id = $town->sim_state_id;
          return ($town);
     }

     public function get_one_type($id)
     {
          $this->db->select('*');
          $this->db->from('sim_types');
          $this->db->where('sim_type_id',$id);
          return ($this->db->get()->row());
     }

     // Getter All manager -----------------------------------------------------------

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
          }
          return ($states);
     }

     public function get_all_type($args = array())
     {
          $this->db->select('*');
          $this->db->from('sim_types');
          $specifications = $this->db->get()->result();
          return ($specifications);
     }
}
