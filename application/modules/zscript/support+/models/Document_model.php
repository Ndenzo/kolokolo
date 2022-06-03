<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Document_model extends IBEMS_Model
{
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->img_base_path = './dossiers/templates/';
     }

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('documents');
          $this->db->insert('documents',$data);
          $document_id = $this->db->insert_id();
          $checker = $this->update_file($document_id);
          return ($checker);
     }

     public function update($args = array())
     {
          $id = $this->input->post('document_id');
          $data = IBEMS_Model::sanitize_for('documents');
          $this->db->where('document_id', $id);
          return($this->db->update('documents',$data));
     }

     public function delete($args = array())
     {
          $id = $this->input->post('document_id');
          $this->db->where('document_id', $id);
          return($this->db->delete('documents'));
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('documents');
          $this->db->where('document_id',$id);
          return ($this->db->get()->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('documents');
          return ($this->db->get()->result());
     }

     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('documents');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function update_file($document_id)
     {
          $path = $this->img_base_path;

          $upload = do_upload('document_link',array(
               'upload_path' =>$path,
               'allowed_types' => 'pdf',
               'file_name' =>'file_'.$document_id,
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['document_link'] = $path.$upload['data']['file_name'];

               $this->db->where('document_id', $document_id);
               return $this->db->update('documents', $args);
          }
     }
}
