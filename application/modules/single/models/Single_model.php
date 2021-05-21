<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class single_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/discographie/singles/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('singles');
          $data["single_added_by"] = $this->__user_id;
          $data["single_added"] = time();
          $data["single_modified"] = time();
          $status = $this->db->insert('singles', $data);

          $single_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($single_id);
          }
          return $status;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('single_id');

          if($this->input->post('photo') != null){
               $this->update_photo($id);
          }

          $data = IBEMS_Model::sanitize_for('singles');
          $data["single_added_by"] = $this->__user_id;
          $data["single_modified"] = time();
          $this->db->where('single_id', $id);
          return($this->db->update('singles', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('single_id');
          $this->db->where('single_id', $id);
          return($this->db->delete('singles'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('singles');
          $this->db->where('single_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('singles');
          return ($this->db->get()->result());
     }

     public function update_photo($single_id){
          $path = $this->img_base_path.'single_'.$single_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'single-'.$single_id)){
               mkdir($this->img_base_path.'single-'.$single_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['single_picture'] = $path;
               $args['single_modified'] = time();

               $this->db->where('single_id', $single_id);
               $this->db->update('singles', $args);
          }
     }

}
