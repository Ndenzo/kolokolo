<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stream_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/streams/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('streams');
          $data["stream_added_by"] = $this->__user_id;
          $data["stream_added"] = time();
          $data["stream_modified"] = time();
          $status = $this->db->insert('streams', $data);

          $stream_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($stream_id);
          }
          return $status;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('stream_id');

          if($this->input->post('photo') != null){
               $this->update_photo($id);
          }

          $data = IBEMS_Model::sanitize_for('streams');
          $data["stream_added_by"] = $this->__user_id;
          $data["stream_modified"] = time();
          $this->db->where('stream_id', $id);
          return($this->db->update('streams', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('stream_id');
          $this->db->where('stream_id', $id);
          return($this->db->delete('streams'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('streams');
          $this->db->where('stream_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('streams');
          return ($this->db->get()->result());
     }

     public function update_photo($stream_id){
          $path = $this->img_base_path.'stream-'.$stream_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'stream-'.$stream_id)){
               mkdir($this->img_base_path.'stream-'.$stream_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['stream_picture'] = $path;
               $args['stream_modified'] = time();

               $this->db->where('stream_id', $stream_id);
               $this->db->update('streams', $args);
          }
     }

}
