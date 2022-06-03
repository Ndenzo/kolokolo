<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_connection_model extends IBEMS_Model 
{
    public function __construct()
    {
        parent::__construct();
    }    
    public function insert($args = array())
    {
        $data = array(
            'user_id'=>$this->session->user['user_id'],
            'ip_adress'=>$this->input->ip_address(),
            'user_agent'=>$this->input->user_agent(),
            'timestamp'=>time()
        );
        return ($this->db->insert('users_connections_history',$data));  
    }
    public function get_all($args = array())
    {
	   $this->db->select('*');
       $this->db->from('users_connections_history'); 
       $this->db->join('users','users.user_id = users_connections_history.user_id');  
       $this->db->where('users.role_id!=1');       
       return ($this->db->get()->result());        
    }      
}