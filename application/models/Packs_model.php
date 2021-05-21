<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packs_model extends IBEMS_Model
{
    protected $user_id;
    protected $annee;
    protected $type_pack_id;
    protected $type_pack_code;
    protected $type_pack_libelle;
    protected $img_base_path;

    public function __construct()
    {
        parent::__construct();
        $this->img_base_path = './images/packs/';
        $this->user_id = get_user_info('user_id');
        $this->type_pack_id = null;
    }
    public function get_produit_list()
    {
        $this->db->select('type_pack_id,type_pack_code,type_pack_libelle,type_pack_image');
        $this->db->from('settings_type_packs');
        $qry = $this->db->get();
        return ($qry->result());
    }
    public function get_pack_type($key)
    {
        $this->db->select('type_pack_id,type_pack_code,type_pack_libelle');
        $this->db->from('settings_type_packs');
        $this->db->where('type_pack_id', $key);
        $this->db->or_where('LOWER(type_pack_code)', strtolower($key));
        $qry = $this->db->get();
        $this->type_pack_id = $qry->row()->type_pack_id;
        $this->type_pack_code = $qry->row()->type_pack_code;
        $this->type_pack_libelle = $qry->row()->type_pack_libelle;
        return ($qry->row());
    }
    public function get_options_list($key)
    {
        $this->db->select('option_id, checkable, option_libelle');
        $this->db->from('settings_pack_options');
        $this->db->join('settings_type_packs','settings_type_packs.type_pack_id = settings_pack_options.type_pack_id','left');
        $this->db->where('settings_type_packs.type_pack_id', $key);
        $this->db->or_where('LOWER(settings_type_packs.type_pack_code)', strtolower($key));
        $qry = $this->db->get();
        return ($qry->result());
    }
    public static function check_option($pack_id, $option_id)
    {
        $CI = &get_instance();
        $CI->db->select('option_id');
        $CI->db->from('packs_options');
        $CI->db->where('pack_id', $pack_id);
        $CI->db->where('option_id', $option_id);
        $qry = $CI->db->get();
        return ($qry->num_rows()>0);
    }
    public function get_one($pack_id)
    {
        $this->db->select('*');
        $this->db->from('packs');
        $this->db->join('settings_type_packs','settings_type_packs.type_pack_id = packs.type_pack_id','left');
        $this->db->where('pack_id', $pack_id);
        $qry = $this->db->get();
        return ($qry->row());
    }
    public function get_all($args = array(),$type)
    {
        $this->db->select('*');
        $this->db->from('packs');
        $this->db->join('assureurs','assureurs.assureur_id = packs.assureur_id','left');
        $this->db->join('settings_type_packs','settings_type_packs.type_pack_id = packs.type_pack_id','left');
        $this->db->where('LOWER(settings_type_packs.type_pack_code)',strtolower($type));
        $qry = $this->db->get();
        return ($qry->result());
    }
    public function search($where = array(),$type)
    {
        $this->db->select('*');
        $this->db->from('packs');
        $this->db->join('assureurs','assureurs.assureur_id = packs.assureur_id','left');
        $this->db->join('settings_type_packs','settings_type_packs.type_pack_id = packs.type_pack_id','left');
        $this->db->where('LOWER(settings_type_packs.type_pack_code)',strtolower($type));
        if(is_array($where))
        $this->db->where($where);
        $qry = $this->db->get();
        return ($qry->result());
    }
    public function insert($args = array())
    {
        $options = $this->input->post('options');
        //
        $default = array();
        $data = IBEMS_Model::sanitize_for('packs',array_merge($default,$args));
        $data['type_pack_id'] = $this->type_pack_id;
        $data['added_by'] = $this->user_id;
        $data['added'] = time();
        $data['modified'] = time();
        if(@$data['actif']!=1)$data['actif'] = 0;
        if(@$data['online']!=1)$data['online'] = 0;
        $this->db->trans_start();
        $this->db->insert('packs',$data);
        $pack_id = $this->db->insert_id();
        $this->update_picture($pack_id);
        $data = array();
        foreach($options as $k=>$v)
        {
            $data[] = array(
                'pack_id'=>$pack_id,
                'option_id'=>$v,
            );
        }
        $this->db->delete('packs_options', array('pack_id' => $pack_id));
        $this->db->insert_batch('packs_options',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        return true;
    }
    public function update($args = array())
    {
        $pack_id = (int)$this->input->post('pack_id',true);
        $options = $this->input->post('options');
        $data = IBEMS_Model::sanitize_for('packs',$args);
        $data['type_pack_id'] = $this->type_pack_id;
        $data['added_by'] = $this->user_id;
        $data['modified'] = time();
        if(@$data['actif']!=1)$data['actif'] = 0;
        if(@$data['online']!=1)$data['online'] = 0;
        $this->db->trans_start();
        $this->db->update('packs', $data, array('pack_id' => $pack_id));
        $this->update_picture($pack_id);
        //suppression de toutes les options retirées
        //$this->db->where_not_in('option_id',$options);
        $this->db->where('pack_id',$pack_id);
        $this->db->delete('packs_options');
        $data = array();
        if(is_array($options))
        {
            foreach($options as $k=>$v)
            {
                $data[] = array(
                    'pack_id'=>$pack_id,
                    'option_id'=>$v,
                );
            }
            $this->db->insert_batch('packs_options',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        return true;
    }
    public function delete($args = array())
    {
        $pack_id = (int)$this->input->post('pack_id',true);
        $this->db->trans_start();
        $SQL = "DELETE packs, packs_options
                  FROM packs, packs_options
                 WHERE packs.pack_id = packs_options.pack_id
                   AND packs.pack_id = ? AND packs.locked = 0";
        $this->db->query($SQL, array($pack_id));
        $SQL = "DELETE packs
                  FROM packs
             LEFT JOIN packs_options ON packs.`pack_id` = packs_options.`pack_id`
                 WHERE packs.pack_id = ?
                   AND packs.locked = 0
                   AND packs_options.option_id IS NULL";
        $this->db->query($SQL, array($pack_id));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        return true;
    }
    public function update_picture($pack_id)
    {
        $path = $this->img_base_path.'packs-'.$pack_id;
        $upload = do_upload('pack_image',array(
            'upload_path' =>$path,
            'allowed_types' => 'jpg|png|gif',
            'file_name' =>'cover'
        ));
        $args = array();
        if($upload['statut']=='success')
        {
            $args['pack_image'] = $path.'/'.$upload['data']['file_name'];
            $args['modified'] = time();

            $this->db->where('pack_id',$pack_id);
            $this->db->update('packs',$args);
        }
    }
}
