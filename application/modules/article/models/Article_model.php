<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class article_model extends IBEMS_Model
{
     protected $__user_id;
     protected $__article_id;
     protected $img_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->__article_id = $this->input->post('article_id');
          $this->img_base_path = './images/Articles/';
     }

     public function insert()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('articles');
          $data['added_by'] = $this->__user_id;
          $data['added'] = time();
          $data['modified'] = time();
          $data['locked'] = 0;
          $this->db->insert('articles', $data);
          $article_id = $this->db->insert_id();
          $this->update_picture($article_id);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update()
     {
          $this->db->trans_start();
          $data = IBEMS_Model::sanitize_for('articles');
          $data['modified'] = time();
          $this->db->where('article_id', $this->__article_id);
          $rs = $this->db->update('articles',$data);
          $this->update_picture($this->__article_id);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete()
     {
          $this->db->where('article_id', $this->__article_id);
          return($this->db->delete('articles'));
     }

     public function get_one($article_id)
     {
          $this->db->select('*');
          $this->db->from('articles');
          $this->db->join('users', 'users.user_id = articles.added_by');
          $this->db->where('article_id', $article_id);
          $query = $this->db->get();
          return($query->row());
     }

     public function get_all($args = array())
     {
          $this->db->select('*');
          $this->db->from('articles');
          $this->db->join('users', 'users.user_id = articles.added_by');
          $this->db->order_by('article_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }

     public function get_articles($limit)
     {
          $this->db->select('*');
          $this->db->from('articles');
          $this->db->join('users', 'users.user_id = articles.added_by');
          $this->db->limit($limit);
          $this->db->order_by('article_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }
     public function get_articles_by_pages($limit, $page)
     {
          $this->db->select('*');
          $this->db->from('articles');
          $this->db->join('users', 'users.user_id = articles.added_by');
          $this->db->limit($limit, $page);
          $this->db->order_by('article_id', 'desc');
          $query = $this->db->get();
          return($query->result());
     }


     public function update_picture($article_id)
    {
        $path = $this->img_base_path.'article-'.$article_id;
        $path_thumbs = $this->img_base_path.'article-'.$article_id;

        $upload = do_upload('article_photo',array(
            'upload_path' =>$path_thumbs,
            'allowed_types' => 'jpg|png|gif|jpeg',
            'file_name' =>'cover',
            'resize'=> true,
            'width'=> 240
        ));

        $upload = do_upload('article_photo',array(
            'upload_path' =>$path,
            'allowed_types' => 'jpg|png|gif|jpeg',
            'file_name' =>'cover',
        ));

        $args = array();
        if($upload['statut']=='success')
        {
            $args['article_photo'] = $path.'/'.$upload['data']['file_name'];
            $args['modified'] = time();

            $this->db->where('article_id', $article_id);
            $this->db->update('articles', $args);
        }
    }
}
?>
