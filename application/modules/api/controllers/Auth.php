<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @subpackage	Rest API
 * @category	Controller
 */
class Auth extends REST {
    public $token;
    public function __construct() {
        parent::__construct();
        $this->token = $this->input->get_request_header('Authorization-Token', TRUE);
    }
    public function access_token()
    {
        $this->request_allowed(array('POST'));
        $body = json_decode($this->body());
        if(!$body)$this->error(400);
        if(empty($body->username))$this->error(400);
        if(empty($body->password))$this->error(400);

        if($result = self::is_user($body->username, $body->password))
        {
            $this->response(200, $result);
        } else{
            $response['message'] = $this->requestStatus(460);
            $this->response(460,$response);
        };
        exit(0);
    }
    public function delete_token(){
        $this->request_allowed(array('DELETE'));
        $this->check_header('Authorization-Token');
        $this->db->where("token", $this->token);
        $query = $this->db->update($this->user_table,array('token'=>''));
        if ($this->db->affected_rows()>0){
            $this->response(200, array('status'=>'success'));
        }else{
            $this->response(405, array());
        }
    }
    protected static function is_user($login, $password)
    {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('users');
        $CI->db->join('users_roles','users_roles.role_id = users.role_id');
        $CI->db->where("user_login", $login);
        $CI->db->or_where("user_email", $login);
        $CI->db->or_where("user_phone", $login);
        $query =  $CI->db->get();
        if ($query->num_rows() > 0)
        {
            $rs = $query->row_array();
            if (hash_equals($rs['hash'], crypt($password,$rs['hash'])))
            {
                $token = token();
                $CI->db->where("user_login", $login);
                $CI->db->update('users',array('token'=>$token));
                return array('auth_token' =>$token);
            }
        }
    }
}