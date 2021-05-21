<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class partenaire_model extends IBEMS_Model
{
     protected $__user_id;
     protected $__partenaire_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->__partenaire_id = $this->input->post('partenaire_id');
          $this->img_base_path = './images/partenaires/';
     }

     public function insert()
     {
          $this->db->trans_start();
          $password = $this->input->post('password',true);
          $data = IBEMS_Model::sanitize_for('users');
          $data['user_nicename'] =  $this->input->post('prenoms')." ".$this->input->post('nom');
          $data['hash'] = crypt($password,salt(32));
          $data['role_id'] = 3;
          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('users', $data);
          $user_id = $this->db->insert_id();
          // $this->update_user_picture($user_id);

          $data = IBEMS_Model::sanitize_for('personnes');
          $data['user_id'] = $user_id;
          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('personnes', $data);

          $data = IBEMS_Model::sanitize_for('partenaires');
          $data['partenaire_ville'] = $this->input->post('ville');
          $data['user_id'] = $user_id;
          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('partenaires', $data);
          $partenaire_id = $this->db->insert_id();
          $this->update_partenaire_picture($partenaire_id);

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
          $data = IBEMS_Model::sanitize_for('partenaires');
          $data['modified'] = time();
          $this->db->where('partenaire_id', $this->__partenaire_id);
          $rs = $this->db->update('partenaires',$data);
          $this->update_picture($this->__partenaire_id);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete()
     {
          $this->db->where('partenaire_id', $this->__partenaire_id);
          return($this->db->delete('partenaires'));
     }

     public function get_one($partenaire_id)
     {
          $this->db->select('*');
          $this->db->from('partenaires');
          $this->db->join('users', 'users.user_id = partenaires.user_id');
          $this->db->join('personnes', 'personnes.user_id = partenaires.user_id');
          $this->db->where('partenaire_id', $partenaire_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('partenaires');
          $this->db->join('users', 'users.user_id = partenaires.added_by');
          $this->db->join('personnes', 'personnes.user_id = partenaires.user_id');
          $this->db->order_by('partenaire_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_partenaires($limit)
     {
          $this->db->select('*');
          $this->db->from('partenaires');
          $this->db->join('users', 'users.user_id = partenaires.user_id');
          $this->db->join('personnes', 'personnes.user_id = partenaires.user_id');
          $this->db->limit($limit);
          $this->db->order_by('partenaire_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_other_partenaires($limit, $partenaire_id)
     {
          $this->db->select('*');
          $this->db->from('partenaires');
          $this->db->join('users', 'users.user_id = partenaires.user_id');
          $this->db->join('personnes', 'personnes.user_id = partenaires.user_id');
          $this->db->where('partenaire_id !=', $partenaire_id);
          $this->db->limit($limit);
          $this->db->order_by('partenaire_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function update_partenaire_picture($partenaire_id)
     {
          $path = $this->img_base_path.'partenaire-'.$partenaire_id;

          $upload = do_upload('partenaire_photo',array(
               'upload_path' => $path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['partenaire_photo'] = $path.'/'.$upload['data']['file_name'];
               $args['modified'] = time();

               $this->db->where('partenaire_id', $partenaire_id);
               $this->db->update('partenaires', $args);
          }
     }

     public function update_user_picture($user_id)
     {
          $path = $this->img_base_path.'user-'.$user_id;

          $upload = do_upload('user_photo',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['user_photo'] = $path.'/'.$upload['data']['file_name'];
               $args['modified'] = time();

               $this->db->where('user_id', $user_id);
               $this->db->update('users', $args);
          }
     }
}
?>
