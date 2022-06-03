<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/actors/contacts/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array()){
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('contacts');
          $data['contact_added_by'] = $this->__user_id;
          $data['contact_added'] = time();
          $data['contact_modified'] = time();
          $data['contact_locked'] = 0;
          $this->db->insert('contacts', $data);
          $contact_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($contact_id);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }else{
               return true;
          }
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array()){
          $this->db->trans_start();

          $contact_id = $this->input->post('contact_id');
          $data = IBEMS_Model::sanitize_for('contacts');
          $data['contact_modified'] = time();
          $this->db->where('contact_id', $contact_id);
          $this->db->update('contacts', $data);

          if($this->input->post('photo') != null){
               $this->update_photo($contact_id);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array()){
          $this->db->trans_start();
          $id = $this->input->post('contact_id');

          $this->db->where('contact_id', $id);
          $this->db->delete('contacts');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id){
          $this->db->select('*');
          $this->db->from('contacts');
          $this->db->where('contacts.contact_id', $id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = null){
          $this->db->select('*');
          $this->db->from('contacts');
          $this->db->order_by('contact_id', 'desc');
          $contacts = $this->db->get()->result();
          return ($contacts);
     }

     // Picture manager -----------------------------------------------------------

     public function update_photo($contact_id){
          $path = $this->img_base_path.'contact-'.$contact_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'contact-'.$contact_id)){
               mkdir($this->img_base_path.'contact-'.$contact_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['contact_image'] = $path;
               $args['contact_modified'] = time();

               $this->db->where('contact_id', $contact_id);
               $this->db->update('contacts', $args);
          }
     }
}
