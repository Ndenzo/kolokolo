<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }
     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('users_roles');
          return ($this->db->insert('users_roles',$data));
     }
     public function update($args = array())
     {
          $id = $this->input->post('role_id');
          $data = IBEMS_Model::sanitize_for('users_roles');
          $this->db->where('role_id', $id);
          return($this->db->update('users_roles',$data));
     }
     public function delete($args = array())
     {
          $id = $this->input->post('role_id');
          $this->db->where('role_id', $id);
          return($this->db->delete('users_roles'));
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('users_roles');
          $this->db->where('role_id',$id);
          return ($this->db->get()->row());
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('users_roles');
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('users_roles');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }
}
