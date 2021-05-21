<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_mode_paiement_model extends IBEMS_Model
{
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->img_base_path = './images/mode_paiement/';
     }
     public function insert($args = array())
     {
          $data = IBEMS_Model::sanitize_for('settings_mode_paiements');
          if($this->input->post('settings_mode_paiement_verif') == null){
               $data['settings_mode_paiement_verif'] = false;
          }
          $this->db->insert('settings_mode_paiements',$data);
          $settings_mode_paiement_id = $this->db->insert_id();
          $checker = $this->update_picture($settings_mode_paiement_id);
          return ($checker);
     }
     public function update($args = array())
     {
          $id = $this->input->post('settings_mode_paiement_id');
          $data = IBEMS_Model::sanitize_for('settings_mode_paiements');
          $this->db->where('settings_mode_paiement_id', $id);
          return($this->db->update('settings_mode_paiements',$data));
     }
     public function delete($args = array())
     {
          $id = $this->input->post('settings_mode_paiement_id');
          $this->db->where('settings_mode_paiement_id', $id);
          return($this->db->delete('settings_mode_paiements'));
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('settings_mode_paiements');
          $this->db->where('settings_mode_paiement_id',$id);
          return ($this->db->get()->row());
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_mode_paiements');
          return ($this->db->get()->result());
     }
     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('settings_mode_paiement_id', $id);
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('settings_mode_paiements');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function update_picture($settings_mode_paiement_id)
     {
          $path = $this->img_base_path.'mode_paiement-'.$settings_mode_paiement_id;

          $upload = do_upload('settings_mode_paiement_photo',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['settings_mode_paiement_photo'] = $path.'/'.$upload['data']['file_name'];

               $this->db->where('settings_mode_paiement_id', $settings_mode_paiement_id);
               return $this->db->update('settings_mode_paiements', $args);
          }
     }
}
