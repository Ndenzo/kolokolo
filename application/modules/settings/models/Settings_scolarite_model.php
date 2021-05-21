<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_scolarite_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }
     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('settings_scolarites');
          return ($this->db->insert('settings_scolarites',$data));
     }
     public function update($args = array())
     {
          $id = $this->input->post('settings_scolarite_id');
          $data = IBEMS_Model::sanitize_for('settings_scolarites');
          $this->db->where('settings_scolarite_id', $id);
          return($this->db->update('settings_scolarites',$data));
     }
     public function delete($args = array())
     {
          $id = $this->input->post('settings_scolarite_id');
          $this->db->where('settings_scolarite_id', $id);
          return($this->db->delete('settings_scolarites'));
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_scolarites');
          $this->db->where('settings_scolarite_id',$id);
          return ($this->db->get()->row());
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_scolarites');
          return ($this->db->get()->result());
     }
     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('settings_scolarite_id', $id);
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('settings_scolarites');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }
}
