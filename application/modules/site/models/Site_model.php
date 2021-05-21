<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_model extends IBEMS_Model
{
     protected $__user_id;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->load->library("pay_dunya");
          $this->load->library("sendit");
     }

     public function get_blogs($limit=0)
     {
          if ($limit != 0) {
               $this->db->limit($limit);
          }
          $this->db->select('*');
          $this->db->from('blogs');
          $this->db->join('users', 'users.user_id = blogs.blog_added_by');
          $this->db->order_by('blog_id ', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_blog($id)
     {
          $this->db->select('*');
          $this->db->from('blogs');
          $this->db->join('users', 'users.user_id = blogs.blog_added_by');
          $this->db->where('blog_id ', $id);
          $query = $this->db->get();
          return($query->row());
     }


     public function get_rx_links($args = array())
     {
          $this->db->select('*');
          $this->db->from('settings_rx_links');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_singles($args = array())
     {
          $this->db->select('*');
          $this->db->from('singles');
          $this->db->order_by('single_id ', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_download($code)
     {
          $this->db->select('*');
          $this->db->from('ventes');
          $this->db->where('vente_code', $code);
          $query = $this->db->get();
          $vente = $query->row();

          $this->db->select('*');
          $this->db->from($vente->vente_product.'s');
          $this->db->where($vente->vente_product.'_id ', $vente->vente_product_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_realisations($limit = 0)
     {
          if ($limit != 0) {
               $this->db->limit($limit);
          }
          $this->db->select('*');
          $this->db->from('realisations');
          $this->db->order_by('realisation_id ', 'desc');
          $query = $this->db->get();
          $realisations = $query->result();
          foreach ($realisations as $key => $realisation) {
               $this->db->select('*');
               $this->db->from('realisation_illustrations');
               $this->db->where('realisation_id', $realisation->realisation_id);
               $realisation->pictures = $this->db->get()->result();

               $this->db->select('*');
               $this->db->from('realisation_tags');
               $this->db->join('tags', 'tags.tag_id = realisation_tags.tag_id');
               $this->db->where('realisation_tags.realisation_id', $realisation->realisation_id);
               $realisation->tags = $this->db->get()->result();
          }
          return($realisations);
     }

     public function get_streams($args = array())
     {
          $this->db->select('*');
          $this->db->from('streams');
          $this->db->order_by('stream_id ', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     function insert_payment(){
          $items = array();
          $taxes = array();

          $data = IBEMS_Model::sanitize_for('ventes');
          $data["vente_mnt_total"] = $this->input->post('vente_pu')*$this->input->post('vente_qte');
          $data["vente_added"] = time();
          $data["vente_modified"] = time();
          $this->db->insert('ventes',$data);

          $products = $this->input->get_post('product[]');
          $qtes = $this->input->get_post('qte[]');
          $pus = $this->input->get_post('pu[]');
          $desc = $this->input->get_post('desc[]');

          foreach ($products as $key => $value) {
               $item = array();
               $item[0] = $products[$key];
               $item[1] = $qtes[$key];
               $item[2] = $pus[$key];
               $item[3] = (float) $qtes[$key]*$pus[$key];
               $item[4] = $desc[$key];

               array_push($items, $item);
          }

          $this->pay_dunya->set_trans($items, $taxes, 'check_paydunya_token/'.$this->input->post('vente_code'));
          die();
     }

     function check_paydunya_token(){
          $vente_code = $this->uri->segment(3);
          $data = IBEMS_Model::sanitize_for('ventes');
          $data["vente_token"] = $this->input->get_post('token');
          $this->db->where('vente_code', $vente_code);
          $this->db->update('ventes', $data);


          $this->db->select('*');
          $this->db->from('ventes');
          $this->db->where('vente_code', $vente_code);
          $query = $this->db->get();
          $vente = $query->row();

          $object = "Votre Achat !";
          $to = $vente->vente_email;
          $lastname = $vente->vente_last_name;
          $firstname = $vente->vente_last_name;

          $content = '<p style="width: 100%;">Salut '.$firstname.',</p>
          <p>Nous vous remercions pour votre achat !</p><br/>
          <p><strong>Code</strong> : '.$vente->vente_code.'</p><br/>
          <br/>

          <a href="https://armandkoffi.com/download/'.$vente->vente_code.'" target="_blank" style="padding: 10px; background-color: #655af3; color: #fff; display: inline-block; border-radius: 4px; margin-bottom: 18px"> Téléchargez maintenant ! </a>';

          $data['content'] = $content;
          $view = $this->load->view('mail/default', $data, true);
          if($this->sendit->send_mail($view, $object, $to, $lastname, $firstname)){
               return true;
          }
     }

     function send_contact_mail(){
          if($this->sendit->send_contact()){
               return true;
          }else{
               return false;
          }
     }

}
?>
