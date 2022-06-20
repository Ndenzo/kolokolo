<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends IBEMS_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model('securite/strategies_model');
          $this->load->model('securite/users_connection_model');
          $this->load->model('securite/users_model');
          $this->load->model('actor/investor_model');
          $this->load->model(array('api/person_model'=>'person_model'));
          $this->load->library("googleapi");
     }

     public function index()
     {
          $this->set_data('title', 'Login');
          $this->set_data('google_auth', $this->googleapi->init('Se connecter avec '));
          $this->load->view('back/login', $this->get_data());
     }

     public function recovery()
     {
          $this->set_data('title', 'Recovery');
          $this->load->view('back/login_recovery', $this->get_data());
     }

     public function renew()
     {
          add_js(null,'assets/custom/js/jquery.validate.js');
          add_js(null,'application/modules/profile/js/profile_script.js');

          $this->set_data('title', 'Renew Password');
          $this->load->view('back/login_renew', $this->get_data());
     }

     public function register(){
          add_js(null,'assets/custom/js/jquery.validate.js');
          add_js(null,'application/views/back/js/view_script.js');
          $this->set_data('title', 'Register');
          $this->set_data('google_auth', $this->googleapi->init("S'inscrire avec "));
          $this->load->view('back/register', $this->get_data());
     }

     public function checker(){
          $hash = $this->input->post_get('code');
          $this->set_data('hash', $hash);
          $this->load->view('back/login_checker', $this->get_data());
     }

     public function login()
     {
          $onErrorUrl = $this->input->post('onErrorUrl',true);
          $username = $this->input->post('username',true);
          $password = $this->input->post('password',true);
          $user = $this->is_user($username,$password);
          if(is_array($user))
          {
               $this->db->select('*');
               $this->db->from('investors');
               $this->db->join('users','users.user_id = investors.user_id');
               $this->db->where('users.user_id', $user['user_id']);
               $query = $this->db->get();
               if(@$query->row()->investor_locked == 1){
                    $this->session->set_flashdata('message', 'Veuillez consulter votre mail pour valider votre inscription !');
                    $this->session->set_flashdata('type', 'info');
                    $onErrorUrl = !empty($onErrorUrl)?$onErrorUrl:'/auth';
                    redirect($onErrorUrl);
               }
               if(@$query->row()->investor_locked == 2){
                    $this->session->set_flashdata('message', 'Votre compte est en attente de validation. Vous serez notifier par mail !');
                    $this->session->set_flashdata('type', 'info');
                    $onErrorUrl = !empty($onErrorUrl)?$onErrorUrl:'/auth';
                    redirect($onErrorUrl);
               }
               $person = $this->person_model->get_by_user($user['user_id']);
               $me = (object)array_merge($user, $person);
               $this->session->set_userdata('hash', md5(uniqid(rand(), true)));
               $this->session->set_userdata('user',$user);
               $this->session->set_userdata('me',$me);
               $this->users_connection_model->insert();
               redirect('/dashboard');
          }
          $this->session->set_flashdata('message','Vos accès ne sont pas reconnue!');
          $this->session->set_flashdata('type', 'danger');
          $onErrorUrl = !empty($onErrorUrl)?$onErrorUrl:'/auth';
          redirect($onErrorUrl);
     }

     public function loginJSON()
     {
          $username = $this->input->post('username',true);
          $password = $this->input->post('password',true);
          if(!$user = $this->is_user($username,$password)){
               $resp['statut'] = 'error';
               $resp['code'] = 0;
               $resp['msg'] = 'erreur';
          }else{
               $resp['statut'] = 'success';
               $resp['code'] = 1;
               $resp['msg'] = 'success';
               $user['strategies'] = $this->strategies();
               $this->session->sess_expiration = 14400;
               $this->session->set_userdata('hash', 'some_value');
               $this->session->set_userdata('user',$user);
          }
          echo (json_encode($resp));
          exit(0);
     }
     public function logout()
     {
          $_SESSION = array();
          redirect('/auth');
          exit(0);
     }
     public function is_user($username,$password)
     {
          $this->db->select('*');
          $this->db->from('users');
          $this->db->join('users_roles','users_roles.role_id = users.role_id');
          $this->db->where('user_login',$username);
          $query = $this->db->get();
          if($query->num_rows()<=0) return false;
          $rs = $query->row_array();
          if (hash_equals($rs['hash'], crypt($password,$rs['hash'])))
          {
               return $rs;
               exit(0);
          }
          return false;
     }
     public function strategies()
     {
          $this->db->select('*');
          $this->db->from('ibems_user_strategies');
          $this->db->join('ibems_user_permissions','ibems_user_permissions.permission_id = ibems_user_strategies.permission_id');
          $qry = $this->db->get();
          $data = array();
          foreach($qry->result_array() as $k=>$v)
          {
               $data[$v['role_id']][$v['permission_code']] = 1;
          }
          return ($data);
     }

     public static function encrypt($str)
     {
          return md5($str);
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->investor_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Votre souscription a été pris en compte. Consultez vos mails pour valider votre inscription ! "
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Une erreur s'est produite, veuillez réessayer plus tard !"
                    ));
               }
          }
          redirect('auth/register');
     }

     public function recover()
     {
          if(isPostBack())
          {
               if($this->users_model->recover()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Check your email !"
                    ));
                    redirect('auth/renew');
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
                    redirect('auth/recovery');
               }
          }
     }

     public function update()
     {
          if(isPostBack())
          {
               if($this->users_model->update_password()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Well done !"
                    ));
                    redirect('auth');
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
                    redirect('auth/renew');
               }
          }
     }

     public function confirmation()
     {
          $hash = $this->input->post('hash');

          if(isPostBack())
          {
               if($this->users_model->confirmation()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Well done !"
                    ));
                    redirect('auth/checker?code='.@$hash);
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Error !"
                    ));
                    redirect('auth/checker?code='.@$hash);
               }
          }
     }
}
