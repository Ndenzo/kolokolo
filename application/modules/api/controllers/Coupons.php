<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupons extends IBEMS_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function check()
    {
        $result = array();
        $pack_id = (int)$this->input->get_post('pack_id');
        $code    = $this->input->get_post('coupon_code');
        if($pack_id > 0 && !empty($code))
        {
            $this->db->select("coupons.coupon_id,coupons.coupon_valeur,coupons.coupon_type");
            $this->db->from('coupons');
            $this->db->join('coupons_code','coupons_code.coupon_id = coupons.coupon_id','left');
            $this->db->join('coupons_packs','coupons_packs.coupon_id = coupons.coupon_id','left');
            $this->db->where('coupons_packs.pack_id',$pack_id);
            $this->db->where('coupons_code.coupon_code',$code);
            $this->db->where('coupons_code.flag',0);
            $rs = $this->db->get();
            if($rs->num_rows() > 0){
                $result = $rs->row();}
        }
        echo json_encode($result);
    }
}
?>