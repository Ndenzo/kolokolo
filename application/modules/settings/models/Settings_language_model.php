<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_language_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('settings_languages');
          $data['settings_language_added_by'] = $this->__user_id;
          $data['settings_language_added'] = time();
          $data['settings_language_modified'] = time();
          $data['settings_language_locked'] = 0;
          return ($this->db->insert('settings_languages',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('settings_language_id');
          $data = IBEMS_Model::sanitize_for('settings_languages');
          $data['settings_language_modified'] = time();
          $this->db->where('settings_language_id', $id);
          return($this->db->update('settings_languages', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('settings_language_id');
          $this->db->where('settings_language_id', $id);
          return($this->db->delete('settings_languages'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_languages');
          $this->db->where('settings_language_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_languages');
          return ($this->db->get()->result());
     }

}
