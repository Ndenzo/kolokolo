<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Evenement_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/evenements/';
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('evenements');
          $data["evenement_added_by"] = $this->__user_id;
          $data["evenement_added"] = time();
          $data["evenement_modified"] = time();
          $status = $this->db->insert('evenements', $data);

          $evenement_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($evenement_id);
          }
          return $status;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $id = $this->input->post('evenement_id');

          if($this->input->post('photo') != null){
               $this->update_photo($id);
          }

          $data = IBEMS_Model::sanitize_for('evenements');
          $data["evenement_added_by"] = $this->__user_id;
          $data["evenement_modified"] = time();
          $this->db->where('evenement_id', $id);
          return($this->db->update('evenements', $data));
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $id = $this->input->post('evenement_id');
          $this->db->where('evenement_id', $id);
          return($this->db->delete('evenements'));
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('evenements');
          $this->db->where('evenement_id',$id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('evenements');
          return ($this->db->get()->result());
     }

     public function update_photo($evenement_id){
          $path = $this->img_base_path.'evenement-'.$evenement_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'evenement-'.$evenement_id)){
               mkdir($this->img_base_path.'evenement-'.$evenement_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['evenement_picture'] = $path;
               $args['evenement_modified'] = time();

               $this->db->where('evenement_id', $evenement_id);
               $this->db->update('evenements', $args);
          }
     }

}
