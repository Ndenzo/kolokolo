<?php
/**
* CodeIgniter
*
* @package	CodeIgniter
* @author	Kakou Cyr Leonce Anicet
* @copyright Copyright (c) 2015, Ibems, Inc.
* @license	http://opensource.org/licenses/MIT	MIT License
* @link	http://www.ibems.com
* @since	Version 1.0.0
* @filesource
*/

/*
| -------------------------------------------------------------------
|  UTILS
| -------------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');

function date_convert ($date)
{
     // convert date and time to seconds
     $sec = strtotime($date);

     // convert seconds into a specific format
     $date = date("Y-m-d H:i", $sec);

     // append seconds to the date and time
     $date = $date . ":00";

     // print final date and time
     echo $date;
}

function check_parcours_step($step)
{
     $str = '';
     if(is_array(@$_SESSION['parcours_step']))
     {
          if (in_array($step,$_SESSION['parcours_step'])) $str .= 'done';
     }
     if (@$_SESSION['parcours_current_step']==$step) $str .= ' active';
     echo $str;
}
if (!function_exists('platform_slashes')) {
     function platform_slashes($path) {
          if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
               $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
          }
          return $path;
     }
}

if (!function_exists('format_filesize')) {

     function format_filesize($bytes, $decimals = 2) {

          $sz = 'BKMGTP';

          $factor = floor((strlen($bytes) - 1) / 3);

          return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];

     }

}

if (!function_exists('thousand')) {
     function thousand($number, $args = array()) {
          return number_format($number,0,'.',' ');
     }
}
if (!function_exists('body_class')) {
     function body_class($args = array()) {
          $CI = &get_instance();
          $module = $CI->router->fetch_module();
          $class  = $CI->router->fetch_class();
          $args = (is_array($args)?implode(' ',$args):$args);
          return "module-{$module} class-{$class} $args";
     }
}

/* Générer un identifiant unique */
if (!function_exists('has_content')) {
     function has_content($zone) {
          return false;
     }
}
if (!function_exists('get_content')) {
     function get_content($zone) {
     }
}
/* Générer un identifiant unique */
if (!function_exists('identifier')) {
     function identifier($length = 10) {
          $key = bin2hex(openssl_random_pseudo_bytes($length));
          return ($key);
     }
}

if (!function_exists('qry_debug')) {
     function qry_debug() {
          $CI = &get_instance();
          echo $CI->db->last_query();
          echo '<br />--<br />';
          print_r($CI->db->error());
          die();
     }
}
if (!function_exists('e_utf8')) {
     function e_utf8($str)
     {
          echo utf8_decode($str);
     }
}
/*
| -------------------------------------------------------------------
|  URL
| -------------------------------------------------------------------
*/
if ( ! function_exists('_url'))
{
     /**
     * Base URL
     *
     * Create a local URL based on your basepath.
     * Segments can be passed in as a string or an array, same as site_url
     * or a URL to a file can be passed in, e.g. to an image file.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
     function _url($uri = '', $protocol = NULL)
     {
          echo get_instance()->config->base_url($uri, $protocol);
     }
}
/*
| -------------------------------------------------------------------
|  LANGUES
| -------------------------------------------------------------------
*/
if (!function_exists('set_language')) {
     function set_language($language) {
          $CI = &get_instance();
          $CI->session->item('language',$language);
     }
}
//lire la langue courante
if (!function_exists('get_language')) {
     function get_language() {
          return 'french';
          $CI = &get_instance();
          if (!$CI->session->has_userdata('language')) {
               return $CI->session->has_userdata('language');
          } else {

          }
     }
}
/*
| -------------------------------------------------------------------
|  ANNEE
| -------------------------------------------------------------------
*/
if (!function_exists('get_current_annee')) {
     function get_current_annee() {
          $CI = &get_instance();
          return ('2017-2018');
     }
}
if (!function_exists('get_devise')) {
     function get_devise($montant = '') {
          $CI = &get_instance();
          return ('F CFA');
     }
}
if (!function_exists('to_devise')) {
     function to_devise($montant = '') {
          $CI = &get_instance();
          if(!empty($montant))
          {
               return thousand($montant).' <small>F CFA</small>';
          }
          return ('');
     }
}
if (!function_exists('get_months')) {
     function get_months($start = 9, $monthcount = 12) {
          $array['fr'] = array('janvier','février','mars','avril','mai','juin',
          'juillet','août','septembre','octobre','novembre','décembre');
          $month_name = $array['fr'];
          $arr = array();
          for ($i = $start; $i <= $start + $monthcount; $i++)
          {
               $count = (($i-1) < 12) ? $i - 1 : $i-13;
               $arr[$count] = $month_name[$count];
          }
          return ($arr);
     }
}

/*
| -------------------------------------------------------------------
|  FORM
| -------------------------------------------------------------------
*/
if(!function_exists('isPostBack')){
     function isPostBack($trigger = '')
     {
          if(!empty($trigger)&&!array_key_exists($trigger,$_POST)) return false;
          $method = (strtoupper($_SERVER['REQUEST_METHOD'])!='POST'?false:true);
          //unset($_SERVER['REQUEST_METHOD']);
          return $method;
     }
}
if(!function_exists('canProcessForm')){
     function canProcessForm()
     {
          $ci = &get_instance();
          $form_id = $ci->input->post_get('form_id',true);
          if(is_null($form_id)||empty($form_id)) return false;


          var_dump(@$_SESSION['form_id']);
          if(@$form_id!=@$_SESSION['form_id'])
          {
               $_SESSION['form_id'] = $form_id;
               return true;
          }
          return false;
     }
}
if(!function_exists('flash_message')){
     function show_notification()
     {
          $CI = &get_instance();
          $alert = $CI->session->flashdata('.php');
          if(isset($alert))
          {
               echo '<div class="alert alert-'.$alert['class'].' dark alert-dismissible fade show" role="alert">';
               // switch ($alert['class']) {
               //      case 'success':
               //      echo '<i data-feather="thumbs-up"></i>';
               //      break;
               //      case 'warning':
               //      echo '<i data-feather="bell"></i>';
               //      break;
               //      case 'danger':
               //      echo '<i data-feather="thumbs-down"></i>';
               //      break;
               //
               //      default:
               //      echo '<i data-feather="help-circle"></i>';
               //      break;
               // }
               echo '<p> '.$alert['message'].'</p>';
               echo '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
               echo '</div>';
          }
     }
}
if(!function_exists('set_flash_message')){
     function set_notification($data = array())
     {
          $CI = &get_instance();
          $CI->session->set_flashdata('.php', array(
               'message' => @$data['message'],
               'class' => @$data['type']));
          }
     }
     /*
     | -------------------------------------------------------------------
     |  SECURITE
     | -------------------------------------------------------------------
     */
     //protection par mot de passe
     if (!function_exists('is_protected')) {
          function is_protected($roles = null) {
               $CI = &get_instance();
               if (!$CI->session->has_userdata('hash')) {
                    redirect(base_url());
               } else {

               }
               if(!is_null($roles)){
                    if(!has_role($roles))redirect(base_url());
               }
          }
     }
     //protection par mot de passe
     if (!function_exists('is_connected')) {
          function is_connected() {
               $CI = &get_instance();
               return $CI->session->has_userdata('hash');
          }
     }
     //protection par droit d'acces
     if (!function_exists('has_role')) {
          function has_role($the_role = array()) {
               $CI = &get_instance();
               $role = strtolower($CI->session->user['role_code']);
               if (is_array($the_role)){
                    if(!in_array($role,$the_role)) return false;
               } else {
                    if($the_role!=$role) return false;
               }
               return true;
          }
     }
     //protection par permission
     if (!function_exists('user_can')) {
          function user_can($permissions,$rights) {
               $CI = &get_instance();
               $strategies = @$CI->session->user['strategies'][$permissions][$rights];
               if(empty($strategies)) return false;
               return ($strategies!=1)?false:true;
          }
     }

     if (!function_exists('reload_user')) {
          function reload_user()
          {
               $CI = &get_instance();
               $CI->db->select('*');
               $CI->db->from('users');
               $CI->db->join('users_roles','users_roles.role_id = users.role_id');
               $CI->db->where('user_id',$CI->session->user['user_id']);
               $user = $CI->db->get()->row_array();

               $data = array();
               $CI->db->select('*');
               $CI->db->from('users_strategies');
               $CI->db->join('users_permissions','users_permissions.permission_id = users_strategies.permission_id');
               $CI->db->where('role_id',$CI->session->user['role_id']);
               $result = $CI->db->get()->result_array();
               foreach($result as $k=>$v){
                    $data[$v['permission_id']]['can_view']   = $v['can_view'];
                    $data[$v['permission_id']]['can_read']   = $v['can_read'];
                    $data[$v['permission_id']]['can_create'] = $v['can_create'];
                    $data[$v['permission_id']]['can_update'] = $v['can_update'];
                    $data[$v['permission_id']]['can_delete'] = $v['can_delete'];
                    $data[$v['permission_id']]['can_print']  = $v['can_print'];
                    //
                    $data[$v['permission_code']]['can_view']   = $v['can_view'];
                    $data[$v['permission_code']]['can_read']   = $v['can_read'];
                    $data[$v['permission_code']]['can_create'] = $v['can_create'];
                    $data[$v['permission_code']]['can_update'] = $v['can_update'];
                    $data[$v['permission_code']]['can_delete'] = $v['can_delete'];
                    $data[$v['permission_code']]['can_print']  = $v['can_print'];
               }
               $user['strategies'] = $data;
               $CI->session->set_userdata('user',$user);


          }
     }


     //protection par permission
     if (!function_exists('strategie_checked')) {
          function strategie_checked($a,$b,$c,$d)
          {
               echo((@$a[$b][$c][$d]!=1)?'':' checked="checked"');
          }
     }
     /*
     | -------------------------------------------------------------------
     |  VARIABLE TYPE
     | -------------------------------------------------------------------
     */
     if (!function_exists('is_json')) {
          function is_json($string) {
               $array = @json_decode($string, true);
               return !empty($string) && is_string($string) && is_array($array) && !empty($array) && json_last_error() == 0;
          }
     }
     /*
     | -------------------------------------------------------------------
     |  DROPDOWN
     | -------------------------------------------------------------------
     */
     if(!function_exists('dropDown')){
          function dropDown($sql, $options = array(), $utf8 = true)
          {
               $CI = &get_instance();
               $query = $CI->db->query($sql);
               if ($query->num_rows() > 0)
               {
                    $timestamp = time();
                    $opt = array(
                         'name'=>"name_{$timestamp}",
                         'id'=>"id_{$timestamp}",
                         'class'=>'select',
                         'attr'=>'',
                         'selected'=>''
                    );
                    $opt = array_merge($opt, $options);
                    $name  = $opt['name'];
                    $id    = $opt['id'];
                    $class = $opt['class'];
                    $attr  = $opt['attr'];
                    $choice= $opt['selected'];
                    $blank = @$opt['blank'];
                    $other = @$opt['other'];

                    if(is_array(explode('|',$blank))){
                         $blank = explode('|',$blank);
                         $blank_value = reset($blank);
                         $blank_text = end($blank);
                    }else{
                         $blank_value = '';
                         $blank_text = $blank;
                    }

                    $js_choice = @json_decode($choice);
                    $rows  = $query->result_array();
                    $fields = array_keys($rows[0]);
                    if(count($fields)<=1)$fields[1] = $fields[0];
                    echo "<select name=\"$name\" id=\"$id\" class=\"$class\" $attr>";
                    echo '<option value=""></option>';
                    foreach ($rows as $keys => $values)
                    {
                         $selected = 'selected';
                         if(is_json($choice)){
                              if(!in_array($values[$fields[0]], $js_choice))$selected = '';
                         }elseif(is_array($choice)){
                              if(!in_array($values[$fields[0]], $choice))$selected = '';
                         }elseif($values[$fields[0]]!=$choice){
                              $selected = '';
                         }
                         $value_enc = strtolower(mb_detect_encoding($values[$fields[0]]));
                         $text_enc = strtolower(mb_detect_encoding($values[$fields[1]]));
                         $value = (in_array($value_enc,array('utf-8')))?$values[$fields[0]]:utf8_decode($values[$fields[0]]);
                         $text = (in_array($text_enc,array('utf-8')))?$values[$fields[1]]:utf8_decode($values[$fields[1]]);
                         echo "<option value=\"".trim($value)."\" {$selected}>".trim($text)."</option>";
                    }
                    echo '</select>';
               }
          }
     }
     if(!function_exists('dropChained')){
          function dropChained($sql, $options = array(),$utf8 = true)
          {
               $CI = &get_instance();
               $query = $CI->db->query($sql);
               if ($query->num_rows() > 0)
               {
                    $timestamp = time();
                    $opt = array(
                         'name'=>"name_{$timestamp}",
                         'id'=>"id_{$timestamp}",
                         'class'=>'select',
                         'attr'=>'',
                         'selected'=>''
                    );
                    $opt = array_merge($opt, $options);
                    $name  = $opt['name'];
                    $id    = $opt['id'];
                    $class = $opt['class'];
                    $attr  = $opt['attr'];
                    $choice= $opt['selected'];
                    $blank = @$opt['blank'];
                    $other = @$opt['other'];
                    $js_choice = @json_decode($choice);

                    if(is_array(explode('|',$blank))){
                         $blank = explode('|',$blank);
                         $blank_value = reset($blank);
                         $blank_text = end($blank);
                    }else{
                         $blank_value = '';
                         $blank_text = $blank;
                    }

                    $rows  = $query->result_array();
                    $fields = array_keys($rows[0]);
                    if(count($fields)<=1)$fields[1] = $fields[0];
                    echo "<select name=\"$name\" id=\"$id\" class=\"$class\" $attr>";
                    if($other == 'true'){
                         echo '<option value=""></option>';
                    }
                    foreach ($rows as $keys => $values)
                    {
                         $selected = 'selected="selected"';
                         if(is_json($choice)){
                              if(!in_array($values[$fields[0]], $js_choice))$selected = '';
                         }elseif(is_array($choice)){
                              if(!in_array($values[$fields[0]], $choice))$selected = '';
                         }elseif($values[$fields[0]]!=$choice){
                              $selected = '';
                         }
                         $value_enc = strtolower(mb_detect_encoding($values[$fields[0]]));
                         $text_enc  = strtolower(mb_detect_encoding($values[$fields[1]]));
                         $value = (in_array($value_enc,array('utf-8')))?$values[$fields[0]]:utf8_decode($values[$fields[0]]);
                         $text = (in_array($text_enc,array('utf-8')))?$values[$fields[1]]:utf8_decode($values[$fields[1]]);
                         $class = $values[$fields[2]];
                         echo "<option class=\"{$class}\" value=\"{$value}\" {$selected}>{$text}</option>";
                    }
                    echo '</select>';
               }
          }
     }
     if(!function_exists('dropSimpleArray')){
          function dropSimpleArray($data = array(), $options = array(), $utf8 = true)
          {
               $CI = &get_instance();
               if (count($data) > 0)
               {
                    $timestamp = time();
                    $opt = array(
                         'name'=>"name_{$timestamp}",
                         'id'=>"id_{$timestamp}",
                         'class'=>'select',
                         'attr'=>'',
                         'selected'=>''
                    );
                    $opt = array_merge($opt, $options);
                    $name  = $opt['name'];
                    $id    = $opt['id'];
                    $class = $opt['class'];
                    $attr  = $opt['attr'];
                    $choice= $opt['selected'];
                    $blank = @$opt['blank'];

                    if(is_array(explode('|',$blank))){
                         $blank = explode('|',$blank);
                         $blank_value = reset($blank);
                         $blank_text = end($blank);
                    }else{
                         $blank_value = '';
                         $blank_trxt = $blank;
                    }


                    $js_choice = @json_decode($choice);
                    $rows  = $data;
                    echo "<select name=\"$name\" id=\"$id\" class=\"$class\" $attr>";
                    echo '<option value="'.$blank_value.'">'.$blank_text.'</option>';
                    foreach ($rows as $keys => $values)
                    {
                         $selected = 'selected="selected"';

                         echo "<option value=\"".trim($values)."\" {$selected}>".trim($values)."</option>";
                    }
                    echo '</select>';
               }
          }
     }


     /*
     | -------------------------------------------------------------------
     |  JS AND CSS ON RUNTIME
     | -------------------------------------------------------------------
     */
     if ( ! function_exists('add_css'))
     {
          /**
          * add_css
          *
          * Add a file in the css_to_load array.
          *
          * @param	string	$src path to file

          */
          function add_css($handle, $src, $options = array())
          {
               if(is_null($handle)||empty($handle)) $handle = 'id_'.uniqid(md5(rand()));
               if (empty($src)){return false;}
               $ci = &get_instance();

               $options['id'] = $handle;
               $options['src'] = $src;
               $css_to_load  = $ci->config->item('css_to_load');
               $css_to_load[] = $options;
               $ci->config->set_item('css_to_load',$css_to_load);
          }
     }
     if(!function_exists('load_css')){
          function load_css()
          {
               $str = '';
               $ci = &get_instance();
               $files = $ci->config->item('css_to_load');
               if (!is_array($files)){return false;}
               foreach($files AS $properties)
               {
                    $id = (isset($properties['id']))?'id="'.$properties['id'].'"':'';
                    $url = $properties['src'];
                    $url = filter_var($url, FILTER_SANITIZE_URL);
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                         $src = $properties['src'];
                    } else {
                         $src = base_url($properties['src']);
                    }
                    $str .= "<link {$id} href=\"$src\" rel=\"stylesheet\" type=\"text/css\" />\n";
               }
               return $str;
          }
     }
     if (!function_exists('add_js'))
     {
          /**
          * add_js
          *
          * Add a file in the js_to_load array.
          *
          * @param	string	$src path to file

          */
          function add_js($handle, $src, $options = array(),$media = false)
          {
               if(is_null($handle)||empty($handle)) $handle = 'id_'.uniqid(md5(rand()));
               $ci = &get_instance();
               $options['id'] = $handle;
               $options['src'] = $src;
               $js_to_load_all  = $ci->config->item('js_to_load_all');
               $js_to_load_all[] = $options;
               $ci->config->set_item('js_to_load_all',$js_to_load_all);
               if(!$media)
               {
                    $js_to_load_last  = $ci->config->item('js_to_load_last');
                    $js_to_load_last[] = $options;
                    $ci->config->set_item('js_to_load_last',$js_to_load_last);
               } else {
                    $js_to_load_first  = $ci->config->item('js_to_load_first');
                    $js_to_load_first[] = $options;
                    $ci->config->set_item('js_to_load_first',$js_to_load_first);
               }
          }
     }
     if(!function_exists('load_js')){
          function load_js($media = false)
          {
               $str = '';
               $ci = &get_instance();
               $files = (!$media)?$ci->config->item('js_to_load_last'):$ci->config->item('js_to_load_first');
               if (!is_array($files)){return false;}
               foreach($files AS $properties)
               {
                    $id = (isset($properties['id']))?'id="'.$properties['id'].'"':'';
                    $url = parse_url($properties['src']);
                    $url = $properties['src'];
                    $url = filter_var($url, FILTER_SANITIZE_URL);
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                         $src = $properties['src'];
                    } else {
                         $src = base_url($properties['src']);
                    }
                    $str .= '<script '.$id.' src="'.$src.'" type="text/javascript"></script>'."\n";
               }
               return $str;
          }
     }
     if(!function_exists('do_upload')){
          function do_upload($fieldname, $cfg = array())
          {
               $CI = &get_instance();
               $data = array();
               $config['upload_path']          = './images/blocks';
               $config['allowed_types']        = 'gif|jpg|png';
               $config['file_ext_tolower']     = true;
               $config['overwrite']            = true;
               $config['encrypt_name']         = false;
               $config['max_size']             = 2000;
               $config['max_width']            = 2000;
               $config['max_height']           = 2000;
               $config = array_merge($config,$cfg);
               $CI->load->library('upload', $config);
               if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, true);
               }

               if (!$CI->upload->do_upload($fieldname))
               {
                    $data['statut'] = 'error';
                    $data['error']  = $CI->upload->display_errors();
               } else {
                    $data['statut'] = 'success';
                    $data['data'] = $CI->upload->data();
                    if(@$config['resize']){
                         $config['image_library'] = 'gd2';
                         $config['source_image'] = $data['data']['full_path']; //get original image
                         $config['maintain_ratio'] = TRUE;
                         $CI->load->library('image_lib', $config);
                         if (!$CI->image_lib->resize()) {
                              $data['statut'] = 'error';
                              $data['error'] = $CI->image_lib->display_errors();
                         } else {

                         }
                    }
               }
               return $data;
          }
     }
     ?>
