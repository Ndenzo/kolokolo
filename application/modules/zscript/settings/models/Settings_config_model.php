<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_config_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('config');
          return ($this->db->insert('config',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('meta_id');
          $data = IBEMS_Model::sanitize_for('config');
          $this->db->where('meta_id', $id);
          return($this->db->update('config', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('meta_id');
          $this->db->where('meta_id', $id);
          return($this->db->delete('config'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('config');
          $this->db->where('meta_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('config');
          return ($this->db->get()->result());
     }

}
