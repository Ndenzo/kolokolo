<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_card extends REST
{
     protected $token;
     function __construct()
     {
          parent::__construct();
          $this->check_header('Authorization-Token');
          $this->token = @$this->input->get_request_header('Authorization-Token', TRUE);
          $this->add_header('debug',false);
          $this->load->model([
               //'cards_model'
          ]);
     }

     public function index(){
          echo "Welcome";
     }

     public function get_user_id(){
          $this->db->select('user_id');
          $this->db->from('tokens');
          $this->db->where('token', $this->token);
          $rs = @$this->db->get();
          $user_id = @$rs->row()->user_id;
          return $user_id;
     }

     public function add_cash(){
          $fields = ['cash_card_code', 'card_id'];
          $this->request_allowed(array('POST'));
          $data = @$this->input->post(null, true);
          foreach ($fields as $field)
          {
               if(!isset($data[$field])){
                    $this->error(400);
               }
          }
          $this->db->select('*');
          $this->db->from("cash_cards");
          $this->db->join('cash_card_packs', 'cash_card_packs.cash_card_pack_id = cash_cards.cash_card_pack_id');
          $this->db->where('cash_card_code', $data['cash_card_code']);
          $this->db->where('cash_card_flag', 1);
          $query = $this->db->get();
          if($query->num_rows() > 0){
               $result = array();
               $cash_card = $query->row();
               $user_id = self::get_user_id();
               $this->db->select('*');
               $this->db->from("customers");
               $this->db->join('persons', 'persons.person_id = customers.person_id');
               $this->db->join('users_2_persons', 'users_2_persons.person_id = persons.person_id');
               $this->db->join('users', 'users.user_id = users_2_persons.user_id');
               $this->db->where('users.user_id', $user_id);
               $customer = $this->db->get()->row();

               $datax['card_wallet'] = $result['card_wallet'] = $customer->customer_wallet + $cash_card->cash_card_pack_value;
               $this->db->where('card_id', $data['card_id']);
               $this->db->update('cards', $datax);

               $datay['cash_card_flag'] = 2;
               $datay['card_id'] = $data['card_id'];
               $datay['cash_card_checked'] = time();
               $this->db->where('cash_card_id', $cash_card->cash_card_id);
               $this->db->update('cash_cards', $datay);
               return $this->response(200, $result);
          }else{
               return $this->error(204);
          }
     }

     public function get_packs($pack_id = false){
          $this->request_allowed(array('GET'));
          $pack_id = filter_var($pack_id, FILTER_SANITIZE_NUMBER_INT);
          $user_id = self::get_user_id();

          $this->db->select('packs.pack_id ,pack_libelle, pack_desc,
          CONCAT("'.base_url().'", pack_image) AS pack_image,
          , packs.assureur_id, assureur_libelle,packs.type_pack_id, relance_1, relance_2');
          $this->db->from('packs');
          $this->db->join('assureurs','assureurs.assureur_id = packs.assureur_id','left');
          $this->db->join('settings_type_packs','settings_type_packs.type_pack_id = packs.type_pack_id','left');
          $this->db->join('distributeurs_produits','distributeurs_produits.pack_id = packs.pack_id','left');
          $this->db->join('vendeurs_produit','vendeurs_produit.produit_id = distributeurs_produits.produit_id','left');
          $this->db->join('vendeurs','vendeurs.vendeur_id = vendeurs_produit.vendeur_id','left');
          $this->db->where('LOWER(type_pack_code)','auto');
          $this->db->where('vendeurs.user_id', $user_id);
          $this->db->where('actif', 1);

          if($pack_id!==false && $pack_id > 0)
          {
               $this->db->where('packs.pack_id', $pack_id);
          }

          $rs = @$this->db->get();
          $this->track_sql_errors();
          if($rs->num_rows()>0){
               $result = @$rs->result();
               foreach ($result as $line) {
                    $this->db->select('option_libelle');
                    $this->db->from('settings_pack_options');
                    $this->db->join('packs_options', 'packs_options.option_id = settings_pack_options.option_id');
                    $this->db->where('packs_options.pack_id', $line->pack_id);
                    $options = @$this->db->get()->result();
                    $opts = array();
                    foreach ($options as $option) {
                         array_push($opts, $option->option_libelle);
                    }
                    $line->garanties = implode(" / ", $opts);
                    $this->track_sql_errors();
               }
               $this->response(200, $result);
          } else {
               $this->error(204);
          }
     }

}
?>
