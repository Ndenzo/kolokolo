<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_pack_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('settings_packs');
          $data['settings_pack_added_by'] = $this->__user_id;
          $data['settings_pack_added'] = time();
          $data['settings_pack_modified'] = time();
          $data['settings_pack_locked'] = 0;
          return ($this->db->insert('settings_packs',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('settings_pack_id');
          $data = IBEMS_Model::sanitize_for('settings_packs');
          $data['settings_pack_modified'] = time();
          $this->db->where('settings_pack_id', $id);
          return($this->db->update('settings_packs', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('settings_pack_id');
          $this->db->where('settings_pack_id', $id);
          return($this->db->delete('settings_packs'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_packs');
          $this->db->where('settings_pack_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_packs');
          return ($this->db->get()->result());
     }

}
