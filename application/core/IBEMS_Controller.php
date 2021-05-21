<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class IBEMS_Controller extends CI_Controller
{
    private $module;
    private $module_path;
    private $class;
    private $method;
    private $data = array();
    private $breadcrumb = array();
    public function __construct()
    {
        parent::__construct();
        $this->module = $this->router->fetch_module();
        $this->class  = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
        $this->module_path = APPPATH."modules/$this->module/";
        $this->module_base = "/$this->module/$this->class/";
        $mod_lang = platform_slashes("{$this->module_path}language/".get_language()."/{$this->module}_lang.php");
        $class_lang = platform_slashes("{$this->module_path}language/".get_language()."/{$this->class}_lang.php");

        if (file_exists($mod_lang)) {
            $this->load->language($this->module, get_language());
        }
        if (file_exists($class_lang)) {
            $this->load->language($this->class, get_language());
        }

        if (file_exists(platform_slashes(APPPATH."modules/$this->module/js/{$this->class}.js"))) {
            add_js(null,"application/modules/$this->module/js/{$this->class}.js",array(),true);
        }
        if (file_exists(platform_slashes(APPPATH."modules/$this->module/css/{$this->class}.css"))) {
            add_css("application/modules/$this->module/css/{$this->class}.css",array());
        }
        $this->set_data('module_base',$this->module_base);
        $this->set_data('config', (object)config());
    }
	public function get_module_path($path = '')
	{
        return platform_slashes($this->module_path.$path);
	}
	public function set_crumb($value = array())
	{
        $this->breadcrumb = $value;
	}
	public function add_crumb($value = array())
	{
        $this->breadcrumb[] = $value;
	}
	public function breadcrumb()
	{
        return ($this->breadcrumb);
	}
	public function set_data($key,$value)
	{
        $this->data[$key] = $value;
	}
	public function add_data($key,$value)
	{
	   if(!isset($this->data[$key])) $this->data[$key] = '';
        return ($this->data[$key].=$value);
	}
	public function get_data($key = '')
	{   if (empty($key)){
	       return ($this->data);
        }
        return (@$this->data[$key]);
	}
}
