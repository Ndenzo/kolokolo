<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Strategies_model extends IBEMS_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all()
    {
         $data = array();
	   $this->db->select('*');
       $this->db->from('users_strategies');
       $result = $this->db->get()->result_array();
       foreach($result as $k=>$v){
            $data[$v['role_id']][$v['permission_id']]['can_read']   = $v['can_read'];
            $data[$v['role_id']][$v['permission_id']]['can_create'] = $v['can_create'];
            $data[$v['role_id']][$v['permission_id']]['can_update'] = $v['can_update'];
            $data[$v['role_id']][$v['permission_id']]['can_delete'] = $v['can_delete'];
            $data[$v['role_id']][$v['permission_id']]['can_view']   = $v['can_view'];
            $data[$v['role_id']][$v['permission_id']]['can_print']  = $v['can_print'];
       }
       return($data);         
    }               
    public function get_role_strategies($role_id)
    {
       $data = array();
	   $this->db->select('*');
       $this->db->from('users_strategies');
       $this->db->join('users_permissions','users_permissions.permission_id = users_strategies.permission_id');
       $this->db->where('role_id',$role_id);
       $result = $this->db->get()->result_array();
       foreach($result as $k=>$v){
            $data[$v['permission_id']]['can_read']   = $v['can_read'];
            $data[$v['permission_id']]['can_create'] = $v['can_create'];
            $data[$v['permission_id']]['can_update'] = $v['can_update'];
            $data[$v['permission_id']]['can_delete'] = $v['can_delete'];
            $data[$v['permission_id']]['can_view']   = $v['can_view'];
            $data[$v['permission_id']]['can_print']  = $v['can_print'];
            //
            $data[$v['permission_code']]['can_read']   = $v['can_read'];
            $data[$v['permission_code']]['can_create'] = $v['can_create'];
            $data[$v['permission_code']]['can_update'] = $v['can_update'];
            $data[$v['permission_code']]['can_delete'] = $v['can_delete'];
            $data[$v['permission_code']]['can_view']   = $v['can_view'];
            $data[$v['permission_code']]['can_print']  = $v['can_print'];
       }
       return($data);         
    }               
}