<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_evaluation_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }
     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('settings_evaluations');
          return ($this->db->insert('settings_evaluations',$data));
     }
     public function update($args = array())
     {
          $id = $this->input->post('settings_evaluation_id');
          $data = IBEMS_Model::sanitize_for('settings_evaluations');
          $this->db->where('settings_evaluation_id', $id);
          return($this->db->update('settings_evaluations',$data));
     }
     public function delete($args = array())
     {
          $id = $this->input->post('settings_evaluation_id');
          $this->db->where('settings_evaluation_id', $id);
          return($this->db->delete('settings_evaluations'));
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_evaluations');
          $this->db->where('settings_evaluation_id',$id);
          return ($this->db->get()->row());
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_evaluations');
          return ($this->db->get()->result());
     }
     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('settings_evaluation_id', $id);
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('settings_evaluations');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }
}
