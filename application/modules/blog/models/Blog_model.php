<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/blogs/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('blogs');
          $data["blog_added_by"] = $this->__user_id;
          $data["blog_added"] = time();
          $data["blog_modified"] = time();
          $status = $this->db->insert('blogs', $data);

          $blog_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($blog_id);
          }
          return $status;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('blog_id');

          if($this->input->post('photo') != null){
               $this->update_photo($id);
          }

          $data = IBEMS_Model::sanitize_for('blogs');
          $data["blog_added_by"] = $this->__user_id;
          $data["blog_modified"] = time();
          $this->db->where('blog_id', $id);
          return($this->db->update('blogs', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('blog_id');
          $this->db->where('blog_id', $id);
          return($this->db->delete('blogs'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('blogs');
          $this->db->where('blog_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('blogs');
          return ($this->db->get()->result());
     }

     public function update_photo($blog_id){
          $path = $this->img_base_path.'blog-'.$blog_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'blog-'.$blog_id)){
               mkdir($this->img_base_path.'blog-'.$blog_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['blog_picture'] = $path;
               $args['blog_modified'] = time();

               $this->db->where('blog_id', $blog_id);
               $this->db->update('blogs', $args);
          }
     }

}
