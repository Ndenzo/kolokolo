<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personnes_model extends IBEMS_Model
{
    protected $__img_base_path;
    public function __construct()
    {
        parent::__construct();
        $this->__img_base_path = './images/personnes/';
    }
    public function get_by_user($user_id)
    {
        $this->db->select('*');
        $this->db->from('personnes');
        $this->db->join('users_2_personnes','users_2_personnes.personne_id = personnes.personne_id','left');
        $this->db->where('users_2_personnes.user_id',$user_id);
        $rs = $this->db->get();
        if($rs->row()){
            return $rs->row_array();
        }
        return array();
    }
    public function insert($args = array())
    {
        $data = array();$data = IBEMS_Model::sanitize_for('personnes',$args);
        $data['added'] = time();
        $data['modified'] = time();
        $data['added_by'] = $this->__user_id;
        $rs = $this->db->insert('personnes',$data);
        $personne_id = $this->db->insert_id();
        $this->update_picture($personne_id);
        return $personne_id;
    }
    public function create($args = array())
    {
        $data = array();
        $data = IBEMS_Model::sanitize_for('personnes',$args);
        $data['added'] = time();
        $data['modified'] = time();
        $data['added_by'] = $this->__user_id;
        if($rs = $this->db->insert('personnes',$data))
        {
            $personne_id = $this->db->insert_id();
            $this->update_picture($personne_id);
            return $personne_id;
        }
        //qry_debug();
        return false;
    }
    public function update($args = array())
    {
        $personne_id = $this->input->post('personne_id');
        $data = array();
        $data = IBEMS_Model::sanitize_for('personnes',$args);
        $data['modified'] = time();
        $data['added_by'] = $this->__user_id;
        $this->db->where('personne_id',$personne_id);
        $rs = $this->db->update('personnes',$data);
        $this->update_picture($personne_id);
        return $rs;
    }
    public function update_picture($personne_id)
    {
        $path = $this->__img_base_path.$personne_id.'/img/';
        $upload = do_upload('photo',array(
            'upload_path' =>$path,
            'allowed_types' => 'jpg|png',
            'file_name' =>'photo',
            'resize'=> true,
            'width'=> 300
        ));
        $args = array();
        if($upload['statut']=='success')
        {
            $args['photo'] = $path.$upload['data']['file_name'];
            $args['modified'] = time();
            $this->db->where('personne_id',$personne_id);
            $this->db->update('personnes',$args);
        }
    }
}
?>
