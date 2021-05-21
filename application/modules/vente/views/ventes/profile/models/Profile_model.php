<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/persons/teachers/';
     }

     // Update manager -----------------------------------------------------------

     public function update($args = array())
     {
          $this->db->trans_start();
          $person_id = $this->input->post('person_id');
          $data = IBEMS_Model::sanitize_for('persons');
          $data['person_modified'] = time();

          if($this->input->post('is_profile') == 1){
               $this->db->where('person_id', $person_id);
               $this->db->update('persons', $data);
          }else{
               $this->db->insert('persons', $data);
               $person_id = $this->db->insert_id();

               $data = IBEMS_Model::sanitize_for('users_2_persons');
               $data['user_id'] = $this->input->post('user_id');
               $data['person_id'] = $person_id;
               $this->db->insert('users_2_persons', $data);
          }

          $user_id = $this->input->post('user_id');
          $data = IBEMS_Model::sanitize_for('users');
          $data['user_login'] = $this->input->post('user_email');
          $data['modified'] = time();
          if(@$this->input->post('password') != null){
               $data['hash'] = crypt($this->input->post('password'),salt(32));
          }

          $this->session->me->settings_timezone_id = $this->input->post('settings_timezone_id');
          $this->db->where('user_id', $user_id);
          $this->db->update('users', $data);

          if($this->input->post('photo') != null){
               $this->update_photo($person_id);
          }

          if(get_user_info('role_code') == 'teacher'){
               $teacher_id = $this->input->post('teacher_id');
               $data = IBEMS_Model::sanitize_for('teachers');
               $data['teacher_modified'] = time();
               $this->db->where('teacher_id', $teacher_id);
               $this->db->update('teachers', $data);
          }

          if(get_user_info('role_code') == 'customer'){
               $customer_id = $this->input->post('customer_id');
               $data = IBEMS_Model::sanitize_for('customers');
               $data['customer_modified'] = time();
               $this->db->where('customer_id', $customer_id);
               $this->db->update('customers', $data);
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Get One manager -----------------------------------------------------------

     public function get_one()
     {
          $this->db->select('*');
          $this->db->from('users');
          $this->db->join('users_2_persons', 'users_2_persons.user_id = users.user_id');
          $this->db->join('persons', 'persons.person_id = users_2_persons.person_id');
          if (get_user_info('role_code') == 'teacher') {
               $this->db->join('teachers', 'teachers.user_id = users_2_persons.user_id');
          }
          if (get_user_info('role_code') == 'customer') {
               $this->db->join('customers', 'customers.user_id = users_2_persons.user_id');
          }
          $this->db->where('users.user_id', $this->__user_id);
          return ($this->db->get()->row());
     }

     public function get_teacher_profile($teacher_id)
     {
          $this->db->select('*');
          $this->db->from('users');
          $this->db->join('users_2_persons', 'users_2_persons.user_id = users.user_id');
          $this->db->join('persons', 'persons.person_id = users_2_persons.person_id');
          $this->db->join('teachers', 'teachers.user_id = users_2_persons.user_id');
          $this->db->where('users.user_id', $teacher_id);
          return ($this->db->get()->row());
     }

     public function get_customer_profile($customer_id)
     {
          $this->db->select('*');
          $this->db->from('users');
          $this->db->join('users_2_persons', 'users_2_persons.user_id = users.user_id');
          $this->db->join('persons', 'persons.person_id = users_2_persons.person_id');
          $this->db->join('teachers', 'teachers.user_id = users_2_persons.user_id');
          $this->db->where('users.user_id', $customer_id);
          return ($this->db->get()->row());
     }

     // Get All manager -----------------------------------------------------------

     public function get_user($args = array())
     {
          $this->db->select('*');
          $this->db->from('users');
          $this->db->where('users.user_id', $this->__user_id);
          return ($this->db->get()->row());
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
               $this->session->me->person_picture = $args['person_picture'];

               $this->db->where('person_id', $person_id);
               $this->db->update('persons', $args);
          }
     }

     public function update_photo($person_id){
          $path = $this->img_base_path.'person-'.$person_id."/cover.jpg";

          if(!file_exists($this->img_base_path.'person-'.$person_id)){
               mkdir($this->img_base_path.'person-'.$person_id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['person_picture'] = $path;
               $args['person_modified'] = time();
               $this->session->me->person_picture = $args['person_picture'];

               $this->db->where('person_id', $person_id);
               $this->db->update('persons', $args);
          }
     }
}
