<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Configurator_model extends IBEMS_Model
{
     protected $__user_id;
     protected $__configurator_id;
     // protected $__image_basepath;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->__configurator_id = $this->input->post('configurator_id');
          // $this->__image_basepath = './images/mode_reglement/';
     }

     public function insert()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('modules');
          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('modules', $data);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('modules');
          $data['modified'] = time();
          $this->db->where('configurator_id', $this->__configurator_id);
          $rs = $this->db->update('modules',$data);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete()
     {
          $this->db->where('configurator_id', $this->__configurator_id);
          return($this->db->delete('configurators'));
     }

     public function get_one($configurator_id)
     {
          $this->db->select('*');
          $this->db->from('configurators');
          $this->db->where('configurator_id', $configurator_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('modules');
          $query = $this->db->get();
          return($query->result());
     }
}
?>
