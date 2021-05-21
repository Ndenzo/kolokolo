<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Security Class extended
 *
 * @package	CodeIgniter
 * @subpackage	Libraries
 * @category	Model
 * @author	EllisLab Dev Team
 * @link	https://codeigniter.com/user_guide/libraries/security.html
 */
class IBEMS_Model extends CI_Model
{
    protected $_fields;
    protected $_table;
    protected $_default;
    protected $_data;
    protected $__user_id;
    protected static $__error = array();
    protected static $__error_count = 0;

  public function __construct() {
    parent::__construct();
    $this->__user_id = get_user_info('user_id');
    $this->_fetch_table();
    if(self::check_table($this->_table))
    {
        $this->_fields = $this->db->list_fields($this->_table);
        $this->_default = $this->_sanitize_post();
    }
  }
  public static function sanitize_for($table, $data = array())
  {
    $post = get_instance()->input->post(NULL, true);
    $post = array_merge($post,$data);
    $fields = get_instance()->db->list_fields($table);
    $data = array();
    foreach ($fields as $value) {
        if(isset($post[$value])) $data[$value] = trim($post[$value]);
    }
    return $data;
  }
  public static function check_table($tableName)
  {
    $result = get_instance()->db->list_tables();
    foreach( $result as $row ) {
            if( $row == $tableName )    return true;
    }
    return false;
  }
  public static function track_error()
  {
      $er = get_instance()->db->error();
      if($er['code']!=0){
          self::$__error_count++;
          self::$__error[] = $er;
      }
  }
  public static function get_errors()
  {
     return self::$__error;
  }
  public static function get_errors_count()
  {
     return self::$__error_count;
  }
    /**
   * Guess the table name
   */
  private function _fetch_table()
  {
      if ($this->_table == NULL)
      {
          $this->_table = preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this)));
      }
  }
  private function _sanitize_post()
  {
    $data = array();
    $post = $this->input->post(NULL, true);
    foreach ($this->_fields as $value) {
        if(isset($post[$value])) $data[$value] = $post[$value];
    }
    return $data;
  }

}
?>
