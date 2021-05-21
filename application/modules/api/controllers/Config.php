<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @subpackage	Rest API
 * @category	Controller
 */
class Config extends REST {

    public function __construct() {
        parent::__construct();
        $this->token = $this->input->get_request_header('Authorization-Token', TRUE);
    }
    public function delete_meta(){
        $this->request_allowed(array('DELETE'));
        $this->check_header('Authorization-Token');
        $params = $this->uri->uri_to_assoc(4, array('meta_key'));
        $this->db->where('meta_key', $params['meta_key']);
        $this->db->delete('config');
        if($this->db->affected_rows() > 0)
        {
            $this->response(200,array('status'=>'success'));
        } else{
            $this->error(400);
        }
        exit(0);
    }
    public function put_meta(){
        $this->request_allowed(array('PUT'));
        $this->check_header('Authorization-Token');
        $params = $this->uri->uri_to_assoc(4, array('meta_key','meta_value'));
        $data['meta_key'] = $params['meta_key'];
        $data['meta_value'] = $params['meta_value'];
        $this->db->where('meta_key', $params['meta_key']);
        $this->db->update('config',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->response(200,array('status'=>'success'));
        } else{
            $this->error(400);
        }
        exit(0);
    }
    public function post_meta(){
        $this->request_allowed(array('POST'));
        $this->check_header('Authorization-Token');
        $params = $this->uri->uri_to_assoc(4, array('meta_group','meta_key','meta_value'));
        $data['meta_group'] = $params['meta_group'];
        $data['meta_key'] = $params['meta_key'];
        $data['meta_value'] = $params['meta_value'];
        if($rs = $this->db->insert('config',$data))
        {
            $this->response(200,array('status'=>'success'));
        } else{
            $this->error(400);
        }
        exit(0);
    }
}