<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Realisation_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/realisation-illustrations/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('realisations');
          $data["realisation_added_by"] = $this->__user_id;
          $data["realisation_added"] = time();
          $data["realisation_modified"] = time();
          $status = $this->db->insert('realisations', $data);

          $realisation_id = $this->db->insert_id();

          $tags = $this->input->post('tag_id');

          foreach ($tags as $key => $tag) {
               $data = array();
               $data["realisation_id"] = $realisation_id;
               $data["tag_id"] = $tag;
               $status = $this->db->insert('realisation_tags', $data);
          }

          if($this->input->post('photo') != null){
               $this->update_photo($realisation_id);
          }
          return $status;
     }

     public function insert_illustration($args = array())
     {
          $data = IBEMS_Model::sanitize_for('realisation_illustrations');
          $data["realisation_illustration_added_by"] = $this->__user_id;
          $data["realisation_illustration_added"] = time();
          $data["realisation_illustration_modified"] = time();
          $status = $this->db->insert('realisation_illustrations', $data);

          $realisation_id = $this->db->insert_id();

          $this->update_picture($realisation_id);

          return $status;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('realisation_id');

          if($this->input->post('photo') != null){
               $this->update_photo($id);
          }

          $this->db->where('realisation_id', $id);
          $this->db->delete('realisation_tags');

          $tags = $this->input->post('tag_id');

          foreach ($tags as $key => $tag) {
               $data = array();
               $data["realisation_id"] = $id;
               $data["tag_id"] = $tag;
               $status = $this->db->insert('realisation_tags', $data);
          }

          $data = IBEMS_Model::sanitize_for('realisations');
          $data["realisation_added_by"] = $this->__user_id;
          $data["realisation_modified"] = time();
          $this->db->where('realisation_id', $id);
          return($this->db->update('realisations', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('realisation_id');
          $this->db->where('realisation_id', $id);
          return($this->db->delete('realisations'));
     }

     public function delete_illustration($args = array())
     {
          $id = $this->input->post('realisation_illustration_id');
          $this->db->where('realisation_illustration_id', $id);
          return($this->db->delete('realisation_illustrations'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('realisations');
          $this->db->where('realisation_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('realisations');
          $realisations = $this->db->get()->result();
          foreach ($realisations as $key => $realisation) {
               $this->db->select('*');
               $this->db->from('realisation_illustrations');
               $this->db->where('realisation_id', $realisation->realisation_id);
               $realisation->pictures = $this->db->get()->result();

               $this->db->select('*');
               $this->db->from('realisation_tags');
               $this->db->join('tags', 'tags.tag_id = realisation_tags.tag_id');
               $this->db->where('realisation_id', $realisation->realisation_id);
               $realisation->tags = $this->db->get()->result();
          }
          return ($realisations);
     }

     public function update_picture($id)
     {
          $path = $this->img_base_path.'realisation-illustration-'.$id;

          $upload = do_upload('illustration',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();

          if($upload['statut']=='success')
          {
               $args['realisation_illustration_picture'] = $path.'/'.$upload['data']['file_name'];
               $args['realisation_illustration_modified'] = time();

               $this->db->where('realisation_illustration_id', $id);
               $this->db->update('realisation_illustrations', $args);
          }
     }

     public function update_photo($realisation_id){
          $path = $this->img_base_path.'realisation-'.$realisation_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'realisation-'.$realisation_id)){
               mkdir($this->img_base_path.'realisation-'.$realisation_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['realisation_picture'] = $path;
               $args['realisation_modified'] = time();

               $this->db->where('realisation_id', $realisation_id);
               $this->db->update('realisations', $args);
          }
     }

}
