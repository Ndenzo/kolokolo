<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attestations extends REST
{
    function __construct()
    {
        parent::__construct();
        $this->check_header('Authorization-Token');
        $this->token = $this->input->get_request_header('Authorization-Token', TRUE);
        $this->load->model('attestation_model');
    }
    public function index(){
        echo '';
    }
    public function get_souche(...$args)
    {
        $this->parse_uri(array('pack_id','point_vente_id'));
        $this->request_allowed(array('GET'));
        $result = array();
        if($this->point_vente_id > 0 && $this->pack_id > 0)
        {
            if($result = $this->attestation_model->select_souche($this->pack_id, $this->point_vente_id))
            {
                $this->response(200, $result);
            }else{
                $this->error(204);
            }
        } else {
            $this->error(400);
        }
    }
}
?>