<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Objets_connectes extends REST
{
    function __construct()
    {
        parent::__construct();
        //$this->check_header('Authorization-Token');
        //$this->token = $this->input->get_request_header('Authorization-Token', TRUE);
        $this->load->model('objets_connectes_model');
    }
    public function index(){
        echo 12;
    }
    public function get_tarif(...$args)
    {
        $this->request_allowed(array('GET'));
        $params = $this->uri->uri_to_assoc(4, array('pack_id','prix_achat'));
        $this->parse_uri($params);
        $result = array();
        if( $this->prix_achat > 0 && $this->pack_id > 0)
        {
            $this->db->select('minimum, maximum, police');
            $this->db->from('objets_co_tarifs');
            $this->db->where('pack_id',(int)$this->pack_id);
            $rs = $this->db->get();
            if($rs->num_rows()>0)
            {
                $minimum = $rs->row()->minimum;
                $maximum = $rs->row()->maximum;
                $police = $rs->row()->police;
                $prime_ttc = round(($minimum*$this->prix_achat)/100);
                $prime_net = round($prime_ttc/1.1-$police);
                //$taxes = round($prime_ttc*(0.1/1.1));
                $taxes = round($minimum*$this->prix_achat/1100);
                $result = array(
                    'minimum'=>round(($minimum*$this->prix_achat)/100),
                    'maximum'=>round($maximum*($prime_ttc/1.1-$police)/100),
                    'police'=>$police,
                    'prime_ttc'=>$prime_ttc,
                    'prime_net'=>$prime_net,
                    'taxes'=>$taxes
                );
                $this->response(200, $result);
            }else{
                $this->error(204);
            }
        }
        $this->error(204);
    }

    /*function get_garanties()
    {
      $result = array();
      $pack_id = (int) $this->input->get_post('pack_id');
      if(isset($pack_id) && $pack_id!=0){
        $result['garanties'] = get_pack_auto_options($pack_id);
      }
      echo json_encode($result);
    }*/
}
?>
