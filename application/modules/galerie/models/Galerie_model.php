<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Galerie_model extends IBEMS_Model
{
     protected $__user_id;
     protected $__galerie_id;
     protected $__photo_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->__galerie_id = $this->input->post('galerie_id');
          $this->__photo_id = $this->input->get('photo_id');
          $this->img_base_path = './images/galeries/';
     }

     public function insert()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('galeries');
          $data['galerie_added_by'] = $this->__user_id;
          $data['galerie_added'] = time();
          $data['galerie_modified'] = time();
          $data['galerie_locked'] = 0;
          $this->db->insert('galeries', $data);
          $galerie_id = $this->db->insert_id();
          $this->update_picture($galerie_id);
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
          $data = IBEMS_Model::sanitize_for('galeries');
          $data['galerie_modified'] = time();
          $this->db->where('galerie_id', $this->__galerie_id);
          $rs = $this->db->update('galeries',$data);
          $this->update_picture($this->__galerie_id);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete()
     {
          $this->db->where('galerie_id', $this->__galerie_id);
          return($this->db->delete('galeries'));
     }

     public function delete_photo()
     {
          $this->db->select('*');
          $this->db->from('photos_galerie');
          $this->db->where('photo_id', $this->__photo_id);
          $query = $this->db->get();
          $photo = $query->row();
          unlink($photo->photo_link);
          $this->db->where('photo_id', $this->__photo_id);
          return($this->db->delete('photos_galerie'));
     }

     public function get_one($galerie_id)
     {
          $this->db->select('*');
          $this->db->from('galeries');
          $this->db->join('users', 'users.user_id = galeries.galerie_added_by');
          $this->db->where('galerie_id', $galerie_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('galeries');
          $this->db->join('users', 'users.user_id = galeries.galerie_added_by');
          $this->db->order_by('galerie_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_galeries($limit)
     {
          $this->db->select('*');
          $this->db->from('galeries');
          $this->db->join('users', 'users.user_id = galeries.galerie_added_by');
          $this->db->limit($limit);
          $this->db->order_by('galerie_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }
     public function get_galeries_by_pages($limit, $page)
     {
          $this->db->select('*');
          $this->db->from('galeries');
          $this->db->join('users', 'users.user_id = galeries.galerie_added_by');
          $this->db->limit($limit, $page);
          $this->db->order_by('galerie_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_photo_galerie($galerie_id){
          $this->db->select('*');
          $this->db->from('photos_galerie');
          $this->db->join('galeries', 'galeries.galerie_id = photos_galerie.galerie_id');
          $this->db->join('users', 'users.user_id = photos_galerie.photo_added_by');
          $this->db->where('galeries.galerie_id', $galerie_id);
          $this->db->order_by('photo_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_last_id(){
          $this->db->select('*');
          $this->db->from('photos_galerie');
          $query = $this->db->get();
          if(count($query->last_row()) > 0){
               return $query->last_row()->photo_id + 1;
          }
          return 1;
     }

     public function upload_images($galerie_id)
     {
          $path = $this->img_base_path.'galerie-'.$galerie_id;

          $upload = do_upload('file',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover'.self::get_last_id(),
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['galerie_id'] = $galerie_id;
               $args['photo_link'] = $path.'/'.$upload['data']['file_name'];
               $args['photo_added_by'] = $this->__user_id;
               $args['photo_added'] = time();

               $this->db->insert('photos_galerie', $args);
          }

     }
}
?>
