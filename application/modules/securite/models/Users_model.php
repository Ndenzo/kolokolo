<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
          $this->load->library("sendit");
     }

     public function insert($args = array())
     {
          $password = $this->input->post('user_password',true);
          $data = IBEMS_Model::sanitize_for('users');
          if($this->input->post('role_id') == null){
               $data['role_id'] = get_from('users_roles', 'role_id', 'role_code', 'simple');
          }
          $data['user_registered'] = time();
          $data['modified'] = time();
          $data['hash'] = crypt($password, salt(32));
          return ($this->db->insert('users',$data));
     }

     public function update($args = array())
     {
          $user_id = $this->input->post('user_id');
          $password = $this->input->post('user_password',true);
          $data = IBEMS_Model::sanitize_for('users');
          $data['modified'] = time();
          if(!empty($password))
          {
               $data['hash'] = crypt($password,salt(32));
          }
          $this->db->where('user_id', $user_id);
          return($this->db->update('users',$data));
     }

     public function update_password($args = array())
     {

          $user_email = $this->input->post('user_email');
          $password = $this->input->post('password', true);
          $code = "";
          foreach ($this->input->post('code') as $key => $bin) {
               if($key!=0){
                    $code.= "-".$bin;
               }else{
                    $code.= $bin;
               }
          }
          $data = IBEMS_Model::sanitize_for('users');
          unset($data['user_email']);
          $data['modified'] = time();
          if(!empty($password))
          {
               $data['hash'] = crypt($password,salt(32));
          }
          $this->db->where('user_email', $user_email);
          $this->db->where('user_activation_key', $code);
          $this->db->update('users',$data);
          if($this->db->affected_rows() == 0){
               return false;
          }else{
               return true;
          }

     }

     public function recover($args = array())
     {
          $this->db->trans_start();

          $user_email = $this->input->post('user_email');
          $data = IBEMS_Model::sanitize_for('users');
          $data['modified'] = time();
          $data['user_activation_key'] = code_generator();
          $this->db->where('user_email', $user_email);
          $this->db->update('users', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }else{
               $user = get_user_by_email($user_email);

               $object = "Your langack account !";
               $to = $user->user_email;
               $lastname = $user->person_last_name;
               $firstname = $user->person_first_name;

               $content = '<p style="width: 100%;">Hi '.$firstname.',</p>
               <p>Your account in Langack is ready to be recovered ! </p>
               <p><strong>Your code : </strong>'.$data['user_activation_key'].'</p>
               <p>Check the link bellow to renew your password !</p>
               <a href="http://langack.com/auth/renew" target="_blank" style="padding: 10px; background-color: #655af3; color: #fff; display: inline-block; border-radius: 4px; margin-bottom: 18px"> Recover Now ! </a>
               <p style="margin-bottom: 0">See you there !</p>';

               $data['content'] = $content;
               $view = $this->load->view('back/mail/default', $data, true);
               if($this->sendit->send_mail($view, $object, $to, $lastname, $firstname)){
                    return true;
               }
          }
          return true;
     }

     public function delete($args = array())
     {
          $id = $this->input->post('user_id');
          $this->db->where('user_id', $id);
          return($this->db->delete('users'));
     }
     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('users');
          $this->db->where('user_id',$id);
          return ($this->db->get()->row());
     }
     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('users');
          // $this->db->where('users.role_id!=1');
          return ($this->db->get()->result());
     }
     public function search($where = array())
     {
          $this->db->select('*');
          $this->db->from('users');
          if(!empty($where))
          {
               $this->db->where($where);
          }
          $this->db->where('users.role_id!=1');
          $result = $this->db->get();
          return($result->result());
     }
}
