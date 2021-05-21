<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vente_model extends IBEMS_Model
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
          $data = IBEMS_Model::sanitize_for('ventes');
          $data["vente_added"] = time();
          $data["vente_modified"] = time();
          return ($this->db->insert('ventes',$data));
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('vente_id');
          $data = IBEMS_Model::sanitize_for('ventes');
          $data["vente_added_by"] = $this->__user_id;
          $data["vente_modified"] = time();
          $this->db->where('vente_id', $id);
          return($this->db->update('ventes', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('vente_id');
          $this->db->where('vente_id', $id);
          return($this->db->delete('ventes'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('ventes');
          $this->db->where('vente_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('ventes');
          return ($this->db->get()->result());
     }

}
