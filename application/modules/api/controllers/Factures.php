<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factures extends IBEMS_Controller
{
    function __construct()
    {
        parent::__construct();
        is_protected(array('root', 'admin'));
    }
    public function index(){

    }
    public function lignes()
    {
        $result = array();
        $filter = $this->input->post_get('filter',true);
        $this->db->select("
            matricule ,
            niveau,
            classe , 
            photo , 
            CONCAT(nom,' ',prenom_usuel,' ',prenom_sec) AS nom");
        $this->db->from('eleves');
        $this->db->like('matricule',$filter);
        $this->db->or_like('nom',$filter);
        $this->db->or_like('classe',$filter);
        $this->db->or_like('niveau',$filter);
        $this->db->where("(classe!='' AND niveau!='')");
        $rs = $this->db->get();
        $result = $rs->result_array();
        echo json_encode($result);
        exit();
    }
}
?>