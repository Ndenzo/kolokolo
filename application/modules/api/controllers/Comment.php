<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comment extends IBEMS_Controller
{
     protected $__user_id;

     function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          // $this->load->model(array(
          //      'comment_model'=>'comment_model',
          // ));
     }

     function check_comment($produit_id, $comment_desc)
     {
          $result = array();
          $data = array();

          $data["produit_id"] = $produit_id;
          $data["comment_desc"] = urldecode($comment_desc);
          $data["comment_date"] = gmdate("Y-m-d H:i");
          $data["created"] = time();
          $data["modified"] = time();
          $data["owner"] = $this->__user_id;

          $this->db->insert('comments', $data);

          //echo json_encode(qry_debug());

          $result['date'] = gmdate("d-m-Y H:i");
          $result['comment'] = urldecode($comment_desc);
          $result['comments'] = get_comments($produit_id);

          echo json_encode($result);
     }



}
