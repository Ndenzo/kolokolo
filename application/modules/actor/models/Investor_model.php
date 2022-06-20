<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Investor_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/actors/investors/';
          $this->load->library("sendit");
     }

     // Insert manager -----------------------------------------------------------

     public function insert($args = array())
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('persons');
          //$data['person_birth_date'] = date_to_mysql($this->input->post('person_birth_date'), '/');
          $data['person_added_by'] = $this->__user_id;
          $data['person_added'] = time();
          $data['person_modified'] = time();
          $data['person_locked'] = 0;
          $this->db->insert('persons', $data);
          $person_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('users');
          $data['role_id'] = id_getter('role_id', 'users_roles', 'role_code', 'potentiel');
          $data['user_login'] = $this->input->post('user_email');
          $data['user_nicename'] = $this->input->post('person_first_name')." ".$this->input->post('person_last_name');
          $data['hash'] = crypt($this->input->post('password'),salt(32));

          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('users', $data);
          $user_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('users_2_persons');
          $data['user_id'] = $user_id;
          $data['person_id'] = $person_id;
          $this->db->insert('users_2_persons', $data);

          $code = rand(100000, 999999);

          $data = IBEMS_Model::sanitize_for('investors');
          $data['user_id'] = $user_id;
          $data['investor_code'] = (string)$code;
          $data['investor_added_by'] = $this->__user_id;
          $data['investor_added'] = time();
          $data['investor_modified'] = time();
          $data['investor_locked'] = 1;
          $this->db->insert('investors', $data);
          $investor_id = $this->db->insert_id();

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }else{
               $link = "https://invest.capital-acs.com/auth/checker?code=".crypt($this->input->post('user_email'),salt(32));
               $object = "Votre compte investisseur !";
               $to = $this->input->post('user_email');
               $lastname = $this->input->post('person_last_name');
               $firstname = $this->input->post('person_first_name');

               $content = '<p style="width: 100%;">Bonjour '.$firstname.',</p>
               <p>Veuillez activer votre compte investisseur ! </p>
               <p><strong>Code : </strong>'.$code.'</p>
               <p style="margin-top: 30px; margin-bottom: 30px;"><strong>Etapes Suivantes : </strong></p>
               <p>1. Copiez le code ci-dessus !</p>
               <p>2. Cliquer sur le liens suivant pour valider votre compte.</p>
               <p>3. Renseignez le code pour valider votre adhésion.</p>
               <br>
               <a href="'.$link.'" target="_blank" style="padding: 10px; background-color: #655af3; color: #fff; display: inline-block; border-radius: 4px; margin-bottom: 18px"> Valider mon code ! </a>';

               $data['content'] = $content;
               $view = $this->load->view('back/mail/default', $data, true);
               if($this->sendit->send_mail_2($view, $object, $to, $lastname, $firstname)){
                    return true;
               }
          }
          return true;
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $this->db->trans_start();
          $person_id = $this->input->post('person_id');
          $data = IBEMS_Model::sanitize_for('persons');
          $data['person_modified'] = time();
          $data['person_birth_date'] = date_to_mysql($this->input->post('person_birth_date'), '/');
          $this->db->where('person_id', $person_id);
          $this->db->update('persons', $data);

          $user_id = $this->input->post('user_id');
          $data = IBEMS_Model::sanitize_for('users');
          $data['user_login'] = $this->input->post('user_email');
          $data['modified'] = time();
          if(@$this->input->post('password') != null){
               $data['hash'] = crypt($this->input->post('password'),salt(32));
          }
          $this->db->where('user_id', $user_id);
          $this->db->update('users', $data);

          // if($this->input->post('picture') !== null){
          // $this->update_picture($person_id);
          // }

          $investor_id = $this->input->post('investor_id');
          $data = IBEMS_Model::sanitize_for('investors');
          $data['investor_modified'] = time();
          $this->db->where('investor_id', $investor_id);
          $this->db->update('investors', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update_profile($args = array())
     {
          $this->db->trans_start();

          $user_id = $this->input->post('user_id');

          $data = IBEMS_Model::sanitize_for('users');
          $data['modified'] = time();
          $this->db->where('user_id', $user_id);
          $this->db->update('users', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Update manager -----------------------------------------------------------

     public function investor_locker($args = array())
     {
          $this->db->trans_start();

          $investor_id = $this->input->post('investor_id');
          $investor_locked = $this->input->post('investor_locked');
          $data = IBEMS_Model::sanitize_for('investors');
          $data['investor_modified'] = time();
          $this->db->where('investor_id', $investor_id);
          $this->db->update('investors', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }else{
               if($investor_locked == 0){
                    $investor = self::get_one($investor_id);
                    $link = "https://invest.capital-acs.com/auth";
                    $object = "Votre compte investisseur !";
                    $to = $investor->user_email;
                    $lastname = $investor->person_last_name;
                    $firstname = $investor->person_first_name;

                    $content = '<p style="width: 100%;">Bonjour '.$firstname.',</p>
                    <p style="margin-top: 30px;"><strong>Votre compte investisseur a été valider ! </strong></p>
                    <p style="margin-bottom: 30px;">Vous pouvez vous connecter à notre plateforme via le lien ci-dessous</p>
                    <a href="'.$link.'" target="_blank" style="padding: 10px; background-color: #655af3; color: #fff; display: inline-block; border-radius: 4px; margin-bottom: 18px"> Connexion ! </a>';

                    $data['content'] = $content;
                    $view = $this->load->view('back/mail/default', $data, true);
                    if($this->sendit->send_mail_2($view, $object, $to, $lastname, $firstname)){
                         return true;
                    }
               }

          }
          return true;
     }

     // Delete manager -----------------------------------------------------------

     public function delete($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('investor_id');

          $investor = self::get_one($id);

          $this->db->where('investor_id', $investor->investor_id);
          $this->db->delete('investors');

          $this->db->where('person_id', $investor->person_id);
          $this->db->delete('persons');

          $this->db->where('user_id', $investor->user_id);
          $this->db->delete('users');

          $this->db->where('user_id', $investor->user_id);
          $this->db->delete('users_2_persons');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Get One manager -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('investors');
          $this->db->join('users','users.user_id = investors.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = investors.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          $this->db->join('users_roles','users_roles.role_id = users.role_id');
          $this->db->where('investors.investor_id', $id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_all($args = null)
     {
          $this->db->select('*');
          $this->db->from('investors');
          $this->db->join('users','users.user_id = investors.user_id');
          $this->db->join('users_2_persons','users_2_persons.user_id = investors.user_id');
          $this->db->join('persons','persons.person_id = users_2_persons.person_id');
          if($args == "available"){
               $this->db->join('users_roles','users_roles.role_id = users.role_id');
               $this->db->where('investors.investor_locked', '0');
               $this->db->where('users.locked !=', '1');
          }
          if($args == "unavailable"){
               $this->db->where('investors.investor_locked !=', '0');
               $this->db->or_where('users.locked', '1');
          }
          $this->db->order_by('investor_id', 'desc');
          $investors = $this->db->get()->result();
          return ($investors);
     }

     public function get_locked($args = null)
     {
          $this->db->select('*');
          $this->db->from('investors');
          $this->db->join('users','users.user_id = investors.user_id');
          $this->db->where('users.locked', '1');
          $investors = $this->db->get()->result();
          return ($investors);
     }

     // Picture manager -----------------------------------------------------------

     public function update_picture($person_id)
     {
          $path = $this->img_base_path.'person-'.$person_id;

          $upload = do_upload('picture',array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover',
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $args['person_picture'] = $path.'/'.$upload['data']['file_name'];
               $args['person_modified'] = time();

               $this->db->where('person_id', $person_id);
               $this->db->update('persons', $args);
          }
     }

     // Export manager ----------------------------------------------------------------

     // public function export(){
     //
     //      $this->load->library('excel');
     //
     //      $definition["data"] = array();
     //
     //      $definition["headers"] = array("investorID", "First Name", "Last Name", "Address", "Email", "Timezone");
     //      $definition["variables"] = array("investor_id", "person_first_name", "person_last_name", "person_address", "user_email", "settings_timezone_name");
     //
     //      $this->db->select('*');
     //      $this->db->from('investors');
     //      $this->db->join('users','users.user_id = investors.user_id');
     //      $this->db->join('users_2_persons','users_2_persons.user_id = investors.user_id');
     //      $this->db->join('persons','persons.person_id = users_2_persons.person_id');
     //      $this->db->join('settings_timezones','settings_timezones.settings_timezone_id = users.settings_timezone_id');
     //      $this->db->where('persons.person_address !=', null);
     //      $data = $this->db->get()->result_array();
     //
     //      foreach ($data as $row) {
     //           array_push($definition["data"], $row);
     //      }
     //
     //      $headers = $definition["headers"];
     //      $variables = $definition["variables"];
     //      $data = $definition["data"];
     //
     //      return($this->excel->excel_generator("Clients", $data, $headers, $variables));
     //
     // }

}
