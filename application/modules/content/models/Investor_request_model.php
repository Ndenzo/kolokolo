<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Investor_request_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     // Insert request -----------------------------------------------------------

     public function insert($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('investor_requests');
          $data['investor_request_added_by'] = $this->__user_id;
          $data['investor_request_added'] = time();
          $data['investor_request_modified'] = time();
          $data['investor_request_locked'] = 0;
          $this->db->insert('investor_requests', $data);
          $investor_request_id = $this->db->insert_id();

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               qry_debug();
               return false;
          }
          return true;
     }

     // Update request -----------------------------------------------------------

     public function update($args = array())
     {
          $this->db->trans_start();

          $investor_request_id = $this->input->post('investor_request_id');
          $data = IBEMS_Model::sanitize_for('investor_requests');
          $data['investor_request_modified'] = time();
          $this->db->where('investor_request_id', $investor_request_id);
          $this->db->update('investor_requests', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Delete request -----------------------------------------------------------

     public function delete($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('investor_request_id');

          $this->db->where('investor_request_id', $id);
          $this->db->delete('investor_requests');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Get One request -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('investor_requests');
          $this->db->where('investor_requests.investor_request_id', $id);
          $request = $this->db->get()->row();

          return ($request);
     }


     // Get All request -----------------------------------------------------------

     public function get_all($args = null)
     {
          $this->db->select('*');
          $this->db->from('investor_requests');
          $this->db->join('investors','investors.investor_id = investor_requests.investor_id');
          $this->db->join('users','users.user_id = investors.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = investors.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          $this->db->join('projects','projects.project_id = investor_requests.project_id');

          if($args == "available"){
               $this->db->where('investor_requests.investor_request_locked', '0');
          }
          if($args == "unavailable"){
               $this->db->where('investor_requests.investor_request_locked !=', '0');
          }
          $this->db->order_by('investor_requests.investor_request_id', "desc");
          $requests = $this->db->get()->result();

          return ($requests);
     }

}
