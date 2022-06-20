<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends IBEMS_Controller
{
     protected $__user_id;

     function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
     }

     function save_message(){
          $data = array();

          $data['message_id'] = (int) $this->input->get_post('message_id');
          $data['message_content_text'] = $this->input->get_post('message');
          $data['message_content_added_by'] = $this->__user_id;
          $data['message_content_added'] = time();
          $data['message_content_locked'] = 0;

          $result['status'] = $this->db->insert('messages_contents', $data);

          $message_content_id = $this->db->insert_id();

          $this->db->select('*');
          $this->db->from('messages_contents');
          $this->db->join('users', 'users.user_id = messages_contents.message_content_added_by');
          $this->db->where('message_content_id', $message_content_id);
          $query = $this->db->get();
          $result["data"] = @$query->row();
          $result["data"]->time = gmdate("d/m/Y H:i", $result["data"]->message_content_added);

          echo json_encode($result);
     }

     function get_messages($message_id){
          $result = array();

          $this->db->select('*');
          $this->db->from('messages_contents');
          $this->db->join('users', 'users.user_id = messages_contents.message_content_added_by');
          $this->db->where("messages_contents.message_id", $message_id);
          $this->db->order_by("message_content_added", "desc");
          $this->db->limit(200);
          $query = $this->db->get();
          $result["data"] = @$query->result();

          foreach ($result["data"] as $row) {
               $row->time = gmdate("d/m/Y H:i:s", $row->message_content_added);
          }

          echo json_encode($result);

     }

     function set_online($is_online){
          $data = array();

          $data['online'] = $is_online;
          $this->db->where("users.user_id", $this->__user_id);
          $this->db->update('users', $data);

          //echo json_encode($result);
     }

     function get_user_list($user_id){
          $result = array();

          $this->db->select('*');
          $this->db->from('messages');
          $this->db->join('messages_members', 'messages_members.message_id = messages.message_id');
          $this->db->where("messages_members.user_id", $user_id);
          $query = $this->db->get();
          $messages = @$query->result();

          $to_include = array();

          foreach ($messages as $message) {
               array_push($to_include, $message->message_id);
          }

          if(@$to_include != null){
               $this->db->select('*');
               $this->db->from('users');
               $this->db->join('users_2_persons', 'users_2_persons.user_id = users.user_id');
               $this->db->join('persons', 'persons.person_id = users_2_persons.person_id');
               $this->db->join('messages_members', 'messages_members.user_id = users.user_id');
               $this->db->where_in("messages_members.message_id", @$to_include);
               $this->db->where("messages_members.user_id !=", @$user_id);
               $this->db->order_by("person_last_name", "asc");
               $this->db->order_by("person_first_name", "asc");

               $query = $this->db->get();
               $result["data"] = @$query->result();
          }

          echo json_encode($result);
     }

}
