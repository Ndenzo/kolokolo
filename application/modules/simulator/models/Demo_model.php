<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Demo_model extends IBEMS_Model
{
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->img_base_path = './dossiers/sim_metas/';
     }

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('sim_metas');
          $checker = $this->db->insert('sim_metas', $data);
          return ($checker);
     }

     public function update($args = array())
     {
          $this->db->trans_start();

          $sim_meta_id = $this->input->post('sim_meta_id');
          $data = IBEMS_Model::sanitize_for('sim_metas');
          $this->db->where('sim_meta_id', $sim_meta_id);
          $this->db->update('sim_metas', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('sim_meta_id');
          $this->db->where('sim_meta_id', $id);
          $this->db->delete('sim_metas');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('sim_metas');
          $this->db->where('sim_meta_id',$id);
          return ($this->db->get()->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('sim_metas');
          return ($this->db->get()->result());
     }

}
