<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorie_model extends IBEMS_Model
{
     protected $__user_id;
     protected $__categorie_id;
     // protected $__image_basepath;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->__categorie_id = $this->input->post('categorie_id');
          // $this->__image_basepath = './images/mode_reglement/';
     }

     public function insert()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('categories');
          $data['created'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          // $data['owner'] = $this->__user_id;
          $this->db->insert('categories', $data);
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
          $data = IBEMS_Model::sanitize_for('categories');
          $data['modified'] = time();
          $this->db->where('categorie_id', $this->__categorie_id);
          $rs = $this->db->update('categories',$data);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete()
     {
          $this->db->where('categorie_id', $this->__categorie_id);
          return($this->db->delete('categories'));
     }

     public function get_one($categorie_id)
     {
          $this->db->select('*');
          $this->db->from('categories');
          $this->db->where('categorie_id', $categorie_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('categories');
          $query = $this->db->get();
          return($query->result());
     }
}
?>
