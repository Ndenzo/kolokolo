<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('contacts');
          $data["contact_added"] = time();
          $data["contact_modified"] = time();
          return ($this->db->insert('contacts',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('contact_id');
          $data = IBEMS_Model::sanitize_for('contacts');
          $data["contact_added_by"] = $this->__user_id;
          $data["contact_modified"] = time();
          $this->db->where('contact_id', $id);
          return($this->db->update('contacts', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('contact_id');
          $this->db->where('contact_id', $id);
          return($this->db->delete('contacts'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('contacts');
          $this->db->where('contact_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('contacts');
          return ($this->db->get()->result());
     }

}
