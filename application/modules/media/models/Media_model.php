<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/medias/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('medias');
          $data["media_added_by"] = $this->__user_id;
          $data["media_added"] = time();
          $data["media_modified"] = time();
          $status = $this->db->insert('medias', $data);

          $media_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($media_id);
          }
          return $status;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('media_id');

          if($this->input->post('photo') != null){
               $this->update_photo($id);
          }

          $data = IBEMS_Model::sanitize_for('medias');
          $data["media_added_by"] = $this->__user_id;
          $data["media_modified"] = time();
          $this->db->where('media_id', $id);
          return($this->db->update('medias', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('media_id');
          $this->db->where('media_id', $id);
          return($this->db->delete('medias'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('medias');
          $this->db->where('media_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('medias');
          return ($this->db->get()->result());
     }

     public function update_photo($media_id){
          $path = $this->img_base_path.'media-'.$media_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'media-'.$media_id)){
               mkdir($this->img_base_path.'media-'.$media_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['media_picture'] = $path;
               $args['media_modified'] = time();

               $this->db->where('media_id', $media_id);
               $this->db->update('medias', $args);
          }
     }

}
