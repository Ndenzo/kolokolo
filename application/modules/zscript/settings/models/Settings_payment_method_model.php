<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_payment_method_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('settings_payment_methods');
          return ($this->db->insert('settings_payment_methods',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('settings_payment_method_id');
          $data = IBEMS_Model::sanitize_for('settings_payment_methods');
          $this->db->where('settings_payment_method_id', $id);
          return($this->db->update('settings_payment_methods', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('settings_payment_method_id');
          $this->db->where('settings_payment_method_id', $id);
          return($this->db->delete('settings_payment_methods'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_payment_methods');
          $this->db->where('settings_payment_method_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_payment_methods');
          return ($this->db->get()->result());
     }

}
