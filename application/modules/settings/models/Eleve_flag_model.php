<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eleve_flag_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }
     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('eleve_flags');
          return ($this->db->insert('eleve_flags',$data));
     }
     public function update($args = array())
     {
          $id = $this->input->post('eleve_flag_id');
          $data = IBEMS_Model::sanitize_for('eleve_flags');
          $this->db->where('eleve_flag_id', $id);
          return($this->db->update('eleve_flags',$data));
     }
     public function delete($args = array())
     {
          $id = $this->input->post('eleve_flag_id');
          $this->db->where('eleve_flag_id', $id);
          return($this->db->delete('eleve_flags'));
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('eleve_flags');
          $this->db->where('eleve_flag_id',$id);
          return ($this->db->get()->row());
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('eleve_flags');
          return ($this->db->get()->result());
     }
     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('eleve_flag_id', $id);
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('eleve_flags');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }
}
