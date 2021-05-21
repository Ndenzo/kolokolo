<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_payment_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('settings_payments');
          return ($this->db->insert('settings_payments',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('settings_payment_id');
          $data = IBEMS_Model::sanitize_for('settings_payments');
          $this->db->where('settings_payment_id', $id);
          return($this->db->update('settings_payments', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('settings_payment_id');
          $this->db->where('settings_payment_id', $id);
          return($this->db->delete('settings_payments'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_payments');
          $this->db->where('settings_payment_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_payments');
          return ($this->db->get()->result());
     }

}
