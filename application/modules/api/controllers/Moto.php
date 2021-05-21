<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class moto extends IBEMS_Controller
{
  protected $type_pack_id;

  function __construct()
  {
    parent::__construct();
    $this->load->model(array(
      //'api/vendeur_model'=>'vendeur_model',
      //'api/produit_moto_model'=>'produit_moto_model',
      //'api/attestation_model'=>'attestation_model',
      //'api/client_model'=>'client_model',
      //'api/devis_moto_model'=>'devis_moto_model',
      'api/contrats_moto_model'=>'contrats_model',
      //'api/livraisons_model'=>'livraisons_model',
      //'api/tickets_model'=>'tickets_model'
    ));

  }
  function get_tarif()
  {
    $result = array();
    $pack_id = (int)$this->input->get_post('pack_id');
    $puissance_fiscale_id = (int)$this->input->get_post('puissance_fiscale_id');
    $duree = (int)$this->input->get_post('duree');
    $carte_brune = (int)$this->input->get_post('carte_brune');
    if($duree > 0 && $puissance_fiscale_id && $pack_id)
    {
      $this->db->select('*');
      $this->db->from('moto_tarifs');
      $this->db->where('pack_id',$pack_id);
      $this->db->where('puissance_fiscale_id',$puissance_fiscale_id);
      $this->db->where('duree',$duree);
      $rs = $this->db->get();
      if($rs->num_rows() > 0){
        $base = $rs->row();
        $police = $base->police;
        $fga = $base->fga;
        $taxes = $base->taxes;
        $sms = $base->sms;
        $carte_brune = ($carte_brune!=1)?0:$base->carte_brune;
        $this->db->select('SUM(prime_net) AS option_somme');
        $this->db->from('tarifs_garanties');
        $this->db->where('pack_id',$pack_id);
        $this->db->where('puissance_fiscale_id',$puissance_fiscale_id);
        $this->db->where('duree',$duree);
        $option_somme = $this->db->get()->row()->option_somme;
        $prime_ttc = $option_somme + $police + $fga + $taxes + $carte_brune + $sms;
        $result['prime_ttc'] = $prime_ttc;
      }
      $this->db->select('*');
      $this->db->from('vendeurs_produit');
      $this->db->join('distributeurs_produits', 'distributeurs_produits.produit_id = vendeurs_produit.produit_id');
      $this->db->join('settings_commissionnement','settings_commissionnement.commissionnement_id = vendeurs_produit.commissionnement_id');
      $this->db->where('vendeurs_produit.vendeur_id', $_SESSION['parcours']['vendeur']->vendeur_id);
      $this->db->where('distributeurs_produits.pack_id', $_SESSION['parcours']['pack_id']);
      $rs = $this->db->get();

      $res = $rs->row();
      switch ($res->commissionnement_base) {
        case 'prime_ttc':
        if($res->commissionnement_type == "prc"){
          $dossier =  $prime_ttc * $res->commissionnement_valeur / 100;
        }
        if($res->commissionnement_type == "fix"){
          $dossier = $res->commissionnement_valeur;
        }
        break;

        case 'prime_nette':
        if($res->commissionnement_type == "prc"){
          $dossier = $option_somme * $res->commissionnement_valeur / 100;
        }
        if($res->commissionnement_type == "fix"){
          $dossier = $res->commissionnement_valeur;
        }
        break;

        case 'police':
        if($res->commissionnement_type == "prc"){
          $dossier = $police * $res->commissionnement_valeur / 100;
        }
        if($res->commissionnement_type == "fix"){
          $dossier = $res->commissionnement_valeur;
        }
        break;
        default:
        break;
      }
      $result['dossier'] = round($dossier);
      $result['total'] = $prime_ttc + $result['dossier'];
    }

    echo json_encode($result);
  }

  function get_garanties()
  {
    $result = array();
    $pack_id = (int) $this->input->get_post('pack_id');
    if(isset($pack_id) && $pack_id!=0){
      $result['garanties'] = get_pack_moto_options($pack_id);
    }
    echo json_encode($result);
  }

  function set_renew(){
    $result = array();
    $immatriculation = $this->input->get_post('immatriculation');
    if(isset($immatriculation)){
      $_SESSION['parcours']['immatriculation'] = strtoupper($immatriculation);
      if(isPostBack()&&!empty($immatriculation))
      {
        $where = '';
        $where .= "contrat_moto.CT_IMMATRICULATION  LIKE '%{$immatriculation}%' ESCAPE '!'";
        $contrat_found = $this->contrats_model->search_last(null, $where);

        if($contrat_found != null)
        {
          $this->contrats_model->to_session((array)$contrat_found);
          $contrat = (array)$contrat_found;
          $result['element'] = array(
            'pack_id' => $contrat['CT_PACK_ID'],
            'puissance_fiscale_id' => $contrat['CT_PUISSANCE_FISCALE'],
            'duree_id' => $contrat['CT_DUREE'],
            'n_place' => $contrat['CT_N_PLACE'],
            'carburant_id' => $contrat['CT_CARBURANT_ID'],
            'fabriquant_id' => $contrat['CT_FABRIQUANT_ID'],
            'modele_id' => $contrat['CT_MODEL_ID']
          );
        }
      }
    }

    echo json_encode($result);

  }
}
