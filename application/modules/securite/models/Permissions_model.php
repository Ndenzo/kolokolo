<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Permissions_model extends IBEMS_Model 
{
    public function __construct()
    {
        parent::__construct();
    }    
    public function insert($args = array())
    {
        $data = IBEMS_Model::sanitize_for('users_permissions');
        return ($this->db->insert('users_permissions',$data));     
    } 
    public function update($args = array())
    {
        $data = IBEMS_Model::sanitize_for('users_permissions');
        $id = $this->input->post('permission_id');            
        $this->db->where('permission_id', $id);
        return($this->db->update('users_permissions',$data));
    } 
    public function delete($args = array())
    {
        $id = $this->input->post('permission_id');
        $this->db->where('permission_id', $id);
        return($this->db->delete('users_permissions'));       
    } 
    public function get_one($id)
    {
       $this->db->select('*');
       $this->db->from('users_permissions');
       $this->db->where('permission_id',$id);
       return ($this->db->get()->row());        
    }                
    public function get_all($args = array())
    {
	   $this->db->select('*');
       $this->db->from('users_permissions');       
       return ($this->db->get()->result());        
    }                
    public function search($args = array())
    {
    }                
}