<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_model extends IBEMS_Model
{
    protected $__img_base_path;
    public function __construct()
    {
        parent::__construct();
        $this->__img_base_path = './images/persons/';
    }
    public function get_by_user($user_id)
    {
        $this->db->select('*');
        $this->db->from('persons');
        $this->db->join('users_2_persons','users_2_persons.person_id = persons.person_id','left');
        $this->db->where('users_2_persons.user_id',$user_id);
        $rs = $this->db->get();
        if($rs->row()){
            return $rs->row_array();
        }
        return array();
    }
    public function insert($args = array())
    {
        $data = array();$data = IBEMS_Model::sanitize_for('persons',$args);
        $data['person_added'] = time();
        $data['person_modified'] = time();
        $data['person_added_by'] = $this->__user_id;
        $rs = $this->db->insert('persons',$data);
        $person_id = $this->db->insert_id();
        $this->update_picture($person_id);
        return $person_id;
    }
    public function create($args = array())
    {
        $data = array();
        $data = IBEMS_Model::sanitize_for('persons',$args);
        $data['person_added'] = time();
        $data['person_modified'] = time();
        $data['person_added_by'] = $this->__user_id;
        if($rs = $this->db->insert('persons',$data))
        {
            $person_id = $this->db->insert_id();
            $this->update_picture($person_id);
            return $person_id;
        }
        //qry_debug();
        return false;
    }
    public function update($args = array())
    {
        $person_id = $this->input->post('person_id');
        $data = array();
        $data = IBEMS_Model::sanitize_for('persons',$args);
        $data['person_modified'] = time();
        $data['person_added_by'] = $this->__user_id;
        $this->db->where('person_id',$person_id);
        $rs = $this->db->update('persons',$data);
        $this->update_picture($person_id);
        return $rs;
    }
    public function update_picture($person_id)
    {
        $path = $this->__img_base_path.$person_id.'/img/';
        $upload = do_upload('person_picture',array(
            'upload_path' =>$path,
            'allowed_types' => 'jpg|png',
            'file_name' =>'person_picture',
            'resize'=> true,
            'width'=> 300
        ));
        $args = array();
        if($upload['statut']=='success')
        {
            $args['person_picture'] = $path.$upload['data']['file_name'];
            $args['person_modified'] = time();
            $this->db->where('person_id',$person_id);
            $this->db->update('persons',$args);
        }
    }
}
?>
