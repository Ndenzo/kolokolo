<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database_model extends IBEMS_Model
{
    public function __construct()
    {
        parent::__construct();
    }    
    public function create($args = [])
    {
        $data = IBEMS_Model::sanitize_for('backup', $args);
        $data['added'] = time();
        $data['modified'] = time();
        $data['added_by'] = 1;
        return ($this->db->insert('backup',$data));
    }
    public function delete($args = [])
    {
        $backup_id = $this->input->post('backup_id');
        $this->db->where('backup_id', $backup_id);
        return($this->db->delete('backup'));
    } 
    public function get_one($backup_id)
    {
       $this->db->select('*');
       $this->db->from('backup');
       $this->db->where('backup_id',$backup_id);
       return ($this->db->get()->row());        
    }                
    public function get_all($args = array())
    {
	   $this->db->select('*');
       $this->db->from('backup');
       return ($this->db->get()->result());        
    }
}