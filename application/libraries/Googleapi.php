<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Googleapi extends IBEMS_Model{

     protected $client_id;
     protected $client_secret;
     protected $redirect_url;
     // protected $object;

     public function __construct(array $config = array()) {

          require_once(APPPATH . 'third_party/googleApi/vendor/autoload.php');

          $this->client_id = "198283993866-hhlcsf8nefh9grrvbid984kgq68aqc0o.apps.googleusercontent.com";
          $this->client_secret = "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";
          $this->redirect_url = 'https://invest.capital-acs.com/';

          return $this;

     }

     public function init($text = null) {
          $client = new Google_Client();
          $client->setClientId($this->client_id);
          $client->setClientSecret($this->client_secret);
          $client->setRedirectUri($this->redirect_url);
          $client->addScope("email");
          $client->addScope("profile");

          if (isset($_GET['code'])) {
               $token = @$client->fetchAccessTokenWithAuthCode($_GET['code']);
               if (@$token['access_token'] == null) {
                    return "<a href='".$client->createAuthUrl()."' class='btn btn-google auth-form-btn flex-grow'><i class='mdi mdi-google'></i> ".$text." <strong>Google</strong> </a>";
               }
               $client->setAccessToken($token['access_token']);

               // get profile info
               $google_oauth = new Google_Service_Oauth2($client);
               $google_account_info = $google_oauth->userinfo->get();

               // ndebug($google_account_info);

               self::login($google_account_info);
               // now you can use this profile info to create account in your website and make user logged in.
          } else {
               return "<a href='".$client->createAuthUrl()."' class='btn btn-google auth-form-btn flex-grow'><i class='mdi mdi-google'></i> ".$text." <strong>Google</strong> </a>";
          }
     }

     public function login($google_account_info)
     {
          // $onErrorUrl = $this->input->post('onErrorUrl',true);
          $username = $google_account_info->email;
          $password = $google_account_info->id;
          $user = self::is_user($username, $password);
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
          }else{
               self::insert_google($google_account_info);
          }
          // $this->session->set_flashdata('message','Vos accès ne sont pas reconnue!');
          // $onErrorUrl = !empty($onErrorUrl)?$onErrorUrl:'/auth';
          // redirect($onErrorUrl);
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
          $this->session->set_flashdata('message','Vos accès ne sont pas reconnue!');
          $this->session->set_flashdata('type', 'danger');
          $onErrorUrl = !empty($onErrorUrl)?$onErrorUrl:'/auth';
          redirect($onErrorUrl);
          return false;
     }

     public function insert_google($google_account_info)
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('persons');
          $data['person_first_name'] = $google_account_info->givenName;
          $data['person_last_name'] = $google_account_info->familyName;
          // $data['person_picture'] = $google_account_info->picture;
          $data['person_added'] = time();
          $data['person_modified'] = time();
          $data['person_locked'] = 0;
          $this->db->insert('persons', $data);
          $person_id = $this->db->insert_id();

          $data = IBEMS_Model::sanitize_for('users');
          $data['role_id'] = id_getter('role_id', 'users_roles', 'role_code', 'potentiel');
          $data['user_login'] = $google_account_info->email;
          $data['user_email'] = $google_account_info->email;
          $data['user_nicename'] = $google_account_info->givenName." ".$google_account_info->familyName;
          $data['hash'] = crypt($google_account_info->id,salt(32));

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
          $data['investor_added'] = time();
          $data['investor_modified'] = time();
          $data['investor_locked'] = 2;
          $this->db->insert('investors', $data);
          $investor_id = $this->db->insert_id();

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               die();
               return false;
          }else{
               $this->session->set_flashdata('type','info');
               $this->session->set_flashdata('message','Votre compte est en attente de validation. Vous serez notifier par mail !');
               $onErrorUrl = !empty($onErrorUrl)?$onErrorUrl:'/auth';
               redirect($onErrorUrl);
          }
          return true;
     }

}
