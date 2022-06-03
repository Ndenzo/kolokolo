<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enseignant_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
     }

     public function get_all(){
          $this->db->select('*');
          $this->db->from('enseignants');
          $this->db->join('personnes', 'personnes.personne_id = enseignants.personne_id');
          $this->db->join('enseignant_flags', 'enseignant_flags.enseignant_flag_id = enseignants.enseignant_flag_id');
          $query = $this->db->get();
          $result = $query->result();
          return $result;
     }
}
