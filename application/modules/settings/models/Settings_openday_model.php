<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_openday_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('settings_opendays');
          return ($this->db->insert('settings_opendays',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('settings_openday_id');
          $data = IBEMS_Model::sanitize_for('settings_opendays');
          $this->db->where('settings_openday_id', $id);
          return($this->db->update('settings_opendays', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('settings_openday_id');
          $this->db->where('settings_openday_id', $id);
          return($this->db->delete('settings_opendays'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_opendays');
          $this->db->where('settings_openday_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_opendays');
          return ($this->db->get()->result());
     }

}
