<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends IBEMS_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_subjet(){
         $data = array();
         $data = IBEMS_Model::sanitize_for('subjects');
         $data['added'] = time();
         $data['modified'] = time();
         $data['owner'] = $this->__user_id;
         $rs = $this->db->insert('subjects',$data);
         return $rs;
    }

    public function get_all_subjects(){
         $this->db->select('*');
         $this->db->from('subjects');
         $query = $this->db->get();
         return $query->result();
    }

}
?>
