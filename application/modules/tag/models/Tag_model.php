<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tag_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('tags');
          return ($this->db->insert('tags',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('tag_id');
          $data = IBEMS_Model::sanitize_for('tags');
          $this->db->where('tag_id', $id);
          return($this->db->update('tags', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('tag_id');
          $this->db->where('tag_id', $id);
          return($this->db->delete('tags'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('tags');
          $this->db->where('tag_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('tags');
          return ($this->db->get()->result());
     }

}
