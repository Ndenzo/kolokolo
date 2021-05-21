<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Meet_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('meets');
          $data["settings_meet_id"] = id_getter('settings_meet_id', 'settings_meets', 'settings_meet_code', '!done');
          $data["meet_added"] = time();
          $data["meet_modified"] = time();
          return ($this->db->insert('meets',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('meet_id');
          $data = IBEMS_Model::sanitize_for('meets');
          $data["meet_added_by"] = $this->__user_id;
          $data["meet_modified"] = time();
          $this->db->where('meet_id', $id);
          return($this->db->update('meets', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('meet_id');
          $this->db->where('meet_id', $id);
          return($this->db->delete('meets'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('meets');
          $this->db->join('settings_meets','settings_meets.settings_meet_id = meets.settings_meet_id');
          $this->db->where('meet_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('meets');
          $this->db->join('settings_meets','settings_meets.settings_meet_id = meets.settings_meet_id');
          return ($this->db->get()->result());
     }

}
