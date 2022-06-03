<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Convenience_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/conveniences/';
     }

     // Insert convenience -----------------------------------------------------------

     public function insert($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('conveniences');
          $data['convenience_added_by'] = $this->__user_id;
          $data['convenience_added'] = time();
          $data['convenience_modified'] = time();
          $data['convenience_locked'] = 0;
          $this->db->insert('conveniences', $data);
          $convenience_id = $this->db->insert_id();

          if(!empty($_FILES['convenience_image']['name'])){
               $this->update_photo($convenience_id);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               qry_debug();
               return false;
          }
          return true;
     }

     // Update convenience -----------------------------------------------------------

     public function update($args = array())
     {
          $this->db->trans_start();

          $convenience_id = $this->input->post('convenience_id');
          $data = IBEMS_Model::sanitize_for('conveniences');
          $data['convenience_modified'] = time();
          $this->db->where('convenience_id', $convenience_id);
          $this->db->update('conveniences', $data);

          if(!empty($_FILES['convenience_image']['name'])){
               $this->update_photo($convenience_id);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Delete convenience -----------------------------------------------------------

     public function delete($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('convenience_id');

          $this->db->where('convenience_id', $id);
          $this->db->delete('conveniences');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Get One convenience -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('conveniences');
          $this->db->where('conveniences.convenience_id', $id);
          $convenience = $this->db->get()->row();

          return ($convenience);
     }


     // Get All convenience -----------------------------------------------------------

     public function get_all($args = null)
     {
          $this->db->select('*');
          $this->db->from('conveniences');
          $this->db->order_by('conveniences.convenience_id', "desc");
          $conveniences = $this->db->get()->result();

          return ($conveniences);
     }

     // Picture convenience -----------------------------------------------------------

     public function update_photo($id){
          $path = $this->img_base_path.'convenience_'.$id.'/';

          $upload = do_upload("convenience_image", array(
               'upload_path' => $path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' => 'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['convenience_image'] = $path.$upload['data']['file_name'];

               $this->db->where('convenience_id', $id);
               return $this->db->update('conveniences', $args);
          }
          else
          {
               ndebug($upload);
          }
     }
}
