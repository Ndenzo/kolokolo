<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Studie_model extends IBEMS_Model
{
     protected $doc_base_path;
     protected $img_base_path;

     // studie_content type
     // - 1 = text
     // - 2 = images

     public function __construct()
     {
          parent::__construct();
          $this->doc_base_path = './dossiers/etudes/';
          $this->img_base_path = './images/etudes/';
     }

     public function insert($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('studies');
          $data['studie_added_by'] = $this->__user_id;
          $data['studie_added'] = time();
          $data['studie_modified'] = time();
          $data['studie_locked'] = 0;
          $this->db->insert('studies', $data);
          $studie_id = $this->db->insert_id();

          $content_types = $this->input->post('studie_content_types[]');
          $content_ids = $this->input->post('content_ids[]');
          $this->update_file($studie_id, $this->input->post('studie_name'));

          foreach ($content_ids as $key => $id) {
               if($content_types[$key] == "2"){
                    $content = $this->save_content_img($studie_id, 'studie_content_'.$id);
                    $content_gb = $content;
               }else{
                    $content = $this->input->post('studie_content_'.$id);
                    $content_gb = $this->input->post('studie_content_'.$id.'_gb');
               }
               $data = IBEMS_Model::sanitize_for('studie_contents');
               $data['studie_id'] = $studie_id;
               $data['studie_content_rank'] = $key;
               $data['studie_content_type'] = $content_types[$key];
               $data['studie_content_desc'] = $content;
               $data['studie_content_desc_gb'] = $content_gb;
               $this->db->insert('studie_contents', $data);
               unset($content);
               unset($content_gb);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }

          return true;
     }

     public function locker($args = array())
     {
          $this->db->trans_start();

          $studie_id = $this->input->post('studie_id');
          $data = IBEMS_Model::sanitize_for('studies');
          $data['studie_modified'] = time();
          $this->db->where('studie_id', $studie_id);
          $this->db->update('studies', $data);

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

          $id = $this->input->post('studie_id');

          $this->db->select('*');
          $this->db->from('studies');
          $this->db->where('studie_id', $id);
          $studie = $this->db->get()->row();

          unlink($studie->studie_link);

          $this->db->where('studie_id', $id);
          $this->db->delete('studie_contents');

          $this->db->where('studie_id', $id);
          $this->db->delete('studies');

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
          $this->db->from('studies');
          $this->db->where('studie_id',$id);
          $studie = $this->db->get()->row();

          $this->db->select('*');
          $this->db->from('studie_contents');
          $this->db->where('studie_id',$id);
          $this->db->order_by('studie_content_rank',$id);
          $studie->contents = $this->db->get()->result();

          return ($studie);
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('studies');
          $this->db->join('users','users.user_id = studies.studie_added_by');
          if($args == "available"){
               $this->db->where('studies.studie_locked', '0');
          }
          if($args == "unavailable"){
               $this->db->where('studies.studie_locked !=', '0');
          }
          $this->db->order_by('studie_id', 'desc');
          $studies = $this->db->get()->result();

          foreach ($studies as $key => $studie) {
               $this->db->select('*');
               $this->db->from('studie_contents');
               $this->db->where('studie_contents.studie_id', $studie->studie_id);
               $studie->contents = $this->db->get()->result();
               // foreach ($studie->contents as $key => $content) {
               //      if($content->studie_content_type == 1){
               //           $content->studie_content_format = quill_format($content->studie_content_desc);
               //      }
               // }
          }

          return ($studies);
     }

     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('studies');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function update_file($studie_id, $studie_name){
          if(!empty($_FILES['studie_link']['name'])){
               $upload_path = $this->doc_base_path.'etude_'.$studie_id.'/';
               $upload_file = $upload_path.basename($_FILES['studie_link']['name']);

               if(!file_exists($upload_path)){
                    mkdir($upload_path, 0777, true);
               }

               $upload = move_uploaded_file($_FILES['studie_link']['tmp_name'], $upload_file);

               $args = array();
               if($upload){
                    $args['studie_link'] = $upload_file;

                    $this->db->where('studie_id', $studie_id);
                    return $this->db->update('studies', $args);
               }
          }
     }

     public function save_content_img($studie_id, $link){
          if(!empty($_FILES[$link]['name'])){
               $upload_path = $this->img_base_path.'etude_'.$studie_id.'/';
               $upload_file = $upload_path.basename($_FILES[$link]['name']);

               if(!file_exists($upload_path)){
                    mkdir($upload_path, 0777, true);
               }

               $upload = move_uploaded_file($_FILES[$link]['tmp_name'], $upload_file);

               $args = array();
               if($upload){
                    return $upload_file;
               }
               else
               {
                    ndebug($upload);
               }
          }
     }

}
