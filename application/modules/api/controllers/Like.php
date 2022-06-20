<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Like extends IBEMS_Controller
{
     protected $__user_id;

     function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->load->model(array(
               'like_model'=>'like_model',
          ));
     }

     function check_like($produit_id)
     {
          $result = array();

          $user_id = $this->__user_id;

          $liked = $this->like_model->liked($user_id, $produit_id);



          if(!empty($liked)){

               $this->like_model->dislike($user_id, $produit_id);

          }else{
               $this->like_model->like($user_id, $produit_id);
          }

          $result['likes'] = get_likes($produit_id);

          echo json_encode($result);
     }



}
