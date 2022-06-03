<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Support_model extends IBEMS_Model
{
     protected $_path;
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->_path = './dossiers/supports/';
          $this->__user_id = get_user_info('user_id');
     }

     public function insert_support($args = array())
     {
          $data = IBEMS_Model::sanitize_for('supports');
          $data["settings_scolarite_id"] = $_SESSION['dashboard']['settings_scolarite_id'];
          $data["support_added_by"] = $this->__user_id;
          $data["support_added"] = time();
          $data["support_modified"] = time();
          $data["support_locked"] = 0;
          $this->db->insert('supports', $data);
          $document_id = $this->db->insert_id();
          $checker = $this->update_file($document_id);
          return ($checker);
     }

     public function insert_module_niveau($args = array())
     {
          $data = IBEMS_Model::sanitize_for('support_module_niveaux');
          return $this->db->insert('support_module_niveaux', $data);
     }

     public function delete_module_niveau($args = array())
     {
          $id = $this->input->post('support_module_niveau_id');
          $this->db->where('support_module_niveau_id', $id);
          return($this->db->delete('support_module_niveaux'));
     }

     public function delete_support($args = array())
     {
          $id = $this->input->post('support_id');

          $this->db->select('*');
          $this->db->from('supports');
          $this->db->where('support_id', $id);
          $query = $this->db->get();
          $link = $query->row()->support_link;

          unlink($link);

          $this->db->where('support_id', $id);
          return($this->db->delete('supports'));
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('settings_cycles');
          $query = $this->db->get();
          $cycles = $query->result();
          foreach ($cycles as $cycle) {
               $this->db->select('*');
               $this->db->from('settings_niveaux');
               $this->db->where('settings_cycle_id', $cycle->settings_cycle_id);
               $this->db->order_by('settings_niveau_code');
               $query = $this->db->get();
               $cycle->niveaux = @$query->result();
               foreach($cycle->niveaux as $niveau) {
                    $this->db->select('*');
                    $this->db->from('support_module_niveaux');
                    $this->db->join('evaluation_modules', 'evaluation_modules.evaluation_module_id = support_module_niveaux.evaluation_module_id');
                    $this->db->where('settings_niveau_id', $niveau->settings_niveau_id);
                    $query = $this->db->get();
                    $niveau->modules = @$query->result();
                    foreach($niveau->modules as $module) {
                         $this->db->select('*');
                         $this->db->from('supports');
                         $this->db->where('support_module_niveau_id', $module->support_module_niveau_id);
                         $query = $this->db->get();
                         $module->supports = @$query->result();
                    }
               }
          }
          return $cycles;
     }

     public function update_file($document_id)
     {
          $path = $this->_path;

          $upload = do_upload('file',array(
               'upload_path' =>$path,
               'allowed_types' => 'pdf',
               'file_name' =>'file_'.$document_id,
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['support_link'] = $path.$upload['data']['file_name'];

               $this->db->where('support_id', $document_id);
               return $this->db->update('supports', $args);
          }
          var_dump($upload);
          die();
     }

}
