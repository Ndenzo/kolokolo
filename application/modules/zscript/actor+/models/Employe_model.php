<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class employe_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/employes/';
     }
     public function insert($args = array())
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('personnes');
          $data['personne_added_by'] = $this->__user_id;
          $data['personne_added'] = time();
          $data['personne_modified'] = time();
          $data['personne_locked'] = 0;
          $this->db->insert('personnes', $data);
          $personne_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($personne_id);
          }

          $data = IBEMS_Model::sanitize_for('employes');
          $data['personne_id'] = $personne_id;
          $data['employe_added_by'] = $this->__user_id;
          $data['employe_added'] = time();
          $data['employe_modified'] = time();
          $data['employe_locked'] = 0;
          $this->db->insert('employes', $data);
          $employe_id = $this->db->insert_id();

          foreach ($this->input->post('settings_fonction_ids') as $key => $settings_fonction_id) {
               $data = IBEMS_Model::sanitize_for('employe_fonctions');
               $data['employe_id'] = $employe_id;
               $data['settings_fonction_id'] = $settings_fonction_id;
               $this->db->insert('employe_fonctions', $data);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }
     public function update($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('personne_id');
          $data = IBEMS_Model::sanitize_for('personnes');
          $data['personne_modified'] = time();
          $this->db->where('personne_id', $id);
          $this->db->update('personnes',$data);

          if($this->input->post('photo') != null){
               $this->update_photo($this->input->post('personne_id'));
          }

          $data = IBEMS_Model::sanitize_for('employes');
          $data['employe_modified'] = time();
          $data['employe_date_deb'] = date_to_mysql($this->input->post('employe_date_deb'), "/");
          $data['employe_date_fin'] = date_to_mysql($this->input->post('employe_date_fin'), "/");
          $this->db->where('personne_id', $id);
          $this->db->update('employes',$data);

          $this->db->where('employe_id', $this->input->post('employe_id'));
          $this->db->delete('employe_fonctions');

          foreach ($this->input->post('settings_fonction_ids') as $key => $settings_fonction_id) {
               $data = IBEMS_Model::sanitize_for('employe_fonctions');
               $data['employe_id'] = $this->input->post('employe_id');
               $data['settings_fonction_id'] = $settings_fonction_id;
               $this->db->insert('employe_fonctions', $data);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function lock(){
          $this->db->trans_start();

          $id = $this->input->post('employe_id');
          $data = IBEMS_Model::sanitize_for('employes');
          $data['employe_modified'] = time();
          $data['employe_locked'] = 1;
          $this->db->where('employe_id', $id);
          $this->db->update('employes', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('personne_id');

          $this->db->where('personne_id', $id);
          $this->db->delete('employes');

          $this->db->where('personne_id', $id);
          $this->db->delete('personnes');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('employes');
          $this->db->join('personnes','personnes.personne_id = employes.personne_id');
          $this->db->join('settings_genres','settings_genres.settings_genre_code = personnes.personne_genre');
          $this->db->where('employes.personne_id', $id);
          $employe = $this->db->get()->row();

          $this->db->select('*');
          $this->db->from('employe_fonctions');
          $this->db->where('employe_fonctions.employe_id', $employe->employe_id);
          $fonctions = $this->db->get()->result();

          $employe->settings_fonction_ids = array();

          foreach ($fonctions as $key => $fonction) {
               array_push($employe->settings_fonction_ids, $fonction->settings_fonction_id);
          }

          return ($employe);
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_fonctions');
          $this->db->order_by("settings_fonction_name","asc");

          $settings_fonctions = $this->db->get()->result();

          foreach ($settings_fonctions as $settings_fonction) {
               $this->db->select('*');
               $this->db->from('employes');
               $this->db->join('personnes','personnes.personne_id = employes.personne_id');
               $this->db->join('settings_genres','settings_genres.settings_genre_code = personnes.personne_genre');
               $this->db->join('employe_fonctions','employe_fonctions.employe_id = employes.employe_id');
               $this->db->join('employe_flags','employe_flags.employe_flag_id = employes.employe_flag_id');
               $this->db->where('employe_fonctions.settings_fonction_id', $settings_fonction->settings_fonction_id);
               $this->db->where('employes.employe_locked !=', 1);
               $settings_fonction->employes = $this->db->get()->result();
          }

          return ($settings_fonctions);
     }
     public function get_niveaux($id)
     {
          $this->db->select('*');
          $this->db->from('settings_niveaux');
          $this->db->where('employe_id', $id);
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('employes');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          return ($this->db->get()->result());
     }

     public function update_picture($personne_id)
     {
          $path = $this->img_base_path.'personne-'.$personne_id;

          $upload = do_upload('photo',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['personne_photo'] = $path.'/'.$upload['data']['file_name'];
               $args['personne_modified'] = time();

               $this->db->where('personne_id', $personne_id);
               $this->db->update('personnes', $args);
          }
     }

     public function update_photo($personne_id){
          $path = $this->img_base_path.'personne-'.$personne_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'personne-'.$personne_id)){
               mkdir($this->img_base_path.'personne-'.$personne_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['personne_photo'] = $path;
               $args['personne_modified'] = time();
               $this->session->me->personne_picture = $args['personne_photo'];

               $this->db->where('personne_id', $personne_id);
               $this->db->update('personnes', $args);
          }
     }
}
