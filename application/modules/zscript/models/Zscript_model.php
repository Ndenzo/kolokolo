<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Zscript_model extends IBEMS_Model
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('actor/tuteur_model');
     }

     public function update_images()
     {
          $this->db->select("*");
          $this->db->from("personnes");
          $this->db->where('photo !=', null);
          $query = $this->db->get();

          $personnes  = $query->result();

          foreach ($personnes as $personne) {
               // $file_name = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/.".$personne->photo;
               $file_name = $personne->photo;
               $img = resize_image($file_name, 512, 512);

               header('Content-Type: image/jpeg');

               imagejpeg($img, $file_name);

               // ndebug($img);
          }
     }

     // public function update_tuteur()
     // {
     //      $tuteurs = $this->tuteur_model->get_all();
     //      // echo count($tuteurs);
     //      // die();
     //
     //      foreach ($tuteurs as $tuteur) {
     //
     //           $data = array();
     //           $tmp = explode("-", $tuteur->user_login);
     //           $code = $tmp[count($tmp)-2]."".$tmp[count($tmp)-1];
     //           $data['hash'] = crypt($code, salt(32));
     //
     //           $this->db->where('user_id', $tuteur->user_id);
     //           $this->db->update('users', $data);
     //      }
     // }

     // public function update_facture()
     // {
     //      $this->db->select("*");
     //      $this->db->from("factures");
     //      $this->db->where('facture_locked', 1);
     //      $query = $this->db->get();
     //      $factures = $query->result();
     //
     //      foreach ($factures as $facture) {
     //           $this->db->select("*");
     //           $this->db->from("factures_scolarites");
     //           $this->db->where("factures_scolarites.facture_id", $facture->facture_id);
     //           $query = $this->db->get();
     //           $factures_scolarites = $query->result();
     //
     //           foreach ($factures_scolarites as $factures_scolarite) {
     //                $this->db->where('facture_id', $facture->facture_id);
     //                $query = $this->db->delete('factures');
     //
     //                $this->db->where('factures_scolarite_id', $factures_scolarite->factures_scolarite_id);
     //                $query = $this->db->delete('factures_scolarites');
     //
     //                $this->db->where('factures_scolarite_id', $factures_scolarite->factures_scolarite_id);
     //                $query = $this->db->delete('factures_scolarites_details');
     //           }
     //      }
     // }

     // public function update_facture()
     // {
     //      $this->db->select("*");
     //      $this->db->from("factures_scolarites");
     //      $query = $this->db->get();
     //      $factures_scolarites = $query->result();
     //
     //      foreach ($factures_scolarites as $factures_scolarite) {
     //           $this->db->select("*");
     //           $this->db->from("factures");
     //           $this->db->where("factures.facture_id", $factures_scolarite->facture_id);
     //           $query = $this->db->get();
     //           $factures_scolarites = $query->result();
     //
     //           if($query->num_rows() == 0){
     //                $this->db->where('factures_scolarite_id', $factures_scolarite->factures_scolarite_id);
     //                $query = $this->db->delete('factures_scolarites');
     //
     //                $this->db->where('factures_scolarite_id', $factures_scolarite->factures_scolarite_id);
     //                $query = $this->db->delete('factures_scolarites_details');
     //           }
     //      }
     // }
}
