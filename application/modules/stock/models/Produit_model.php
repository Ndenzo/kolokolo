<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produit_model extends IBEMS_Model
{
     protected $__user_id;
     protected $__produit_id;
     protected $__image_basepath;
     protected $__categorie_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->__produit_id = $this->input->post('produit_id');
          $this->__categorie_id = $this->input->get('categorie');
          $this->__image_basepath = './images/Stock/'.$this->__categorie_id;
     }

     public function insert()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('produits');
          $data['created'] = time();
          $data['modified'] = time();
          $data['owner'] = $this->__user_id;;
          $data['locked'] = 0;
          $this->db->insert('produits', $data);

          $produit_id = $this->db->insert_id();

          $this->update_picture($produit_id);
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
          $data = IBEMS_Model::sanitize_for('produits');
          $data['modified'] = time();
          $this->db->where('produit_id', $this->__produit_id);
          $rs = $this->db->update('produits',$data);
          $this->update_picture($this->__produit_id);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete()
     {
          $this->db->where('produit_id', $this->__produit_id);
          return($this->db->delete('produits'));
     }

     public function get_one($produit_id)
     {
          $this->db->select('*');
          $this->db->from('produits');
          $this->db->where('produit_id', $produit_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('produits');
          $this->db->join('users', 'users.user_id = produits.owner');
          $query = $this->db->get();
          return($query->result());
     }

     public function search($args = array())
     {
          $this->db->select('*');
          $this->db->from('produits');
          $query = $this->db->get();
          return($query->result());
     }

     public function update_picture($produit_id)
     {
          $path = $this->__image_basepath;
          $upload = do_upload('produit_image',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png',
               'file_name' =>'produit_'.$produit_id,
               'resize'=> true,
          ));
          $args = array();
          if($upload['statut']=='success')
          {
               $args['produit_image'] = $path.$upload['data']['file_name'];
               $args['modified'] = time();

               $this->db->where('produit_id',$produit_id);
               $this->db->update('produits',$args);
          }
     }
}
?>
