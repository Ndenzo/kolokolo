<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_timezone_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('settings_timezones');
          return ($this->db->insert('settings_timezones',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('settings_timezone_id');
          $data = IBEMS_Model::sanitize_for('settings_timezones');
          $this->db->where('settings_timezone_id', $id);
          return($this->db->update('settings_timezones', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('settings_timezone_id');
          $this->db->where('settings_timezone_id', $id);
          return($this->db->delete('settings_timezones'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_timezones');
          $this->db->where('settings_timezone_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_timezones');
          return ($this->db->get()->result());
     }

}
