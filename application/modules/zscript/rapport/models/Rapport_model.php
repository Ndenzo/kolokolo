<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class rapport_model extends IBEMS_Model
{
     protected $doc_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->doc_base_path = './dossiers/etudes/';
     }

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('rapports');
          $data['rapport_added_by'] = $this->__user_id;
          $data['rapport_added'] = time();
          $data['rapport_modified'] = time();
          $data['rapport_locked'] = 0;
          $this->db->insert('rapports', $data);
          $rapport_id = $this->db->insert_id();
          $checker = $this->update_file($rapport_id, $data['rapport_name']);
          return ($checker);
     }

     public function locker($args = array())
     {
          $this->db->trans_start();

          $rapport_id = $this->input->post('rapport_id');
          $data = IBEMS_Model::sanitize_for('rapports');
          $data['rapport_locked'] = 1;
          $data['rapport_modified'] = time();
          $this->db->where('rapport_id', $rapport_id);
          $this->db->update('rapports', $data);

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

          $id = $this->input->post('rapport_id');

          $this->db->select('*');
          $this->db->from('rapports');
          $this->db->where('rapport_id', $id);
          $rapport = $this->db->get()->row();

          unlink($rapport->rapport_link);

          $this->db->where('rapport_id', $id);
          $this->db->delete('rapports');

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
          $this->db->from('rapports');
          $this->db->where('rapport_id',$id);
          return ($this->db->get()->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('rapports');
          return ($this->db->get()->result());
     }

     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('rapports');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function update_file($rapport_id, $rapport_name)
     {
          $path = $this->doc_base_path;

          $upload = do_upload('rapport_link',array(
               'upload_path' =>$path,
               'allowed_types' => 'pdf',
               'file_name' => $rapport_name.'_'.$rapport_id,
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['rapport_link'] = $path.$upload['data']['file_name'];

               $this->db->where('rapport_id', $rapport_id);
               return $this->db->update('rapports', $args);
          }
     }
}
