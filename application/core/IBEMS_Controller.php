<?php (defined('BASEPATH')) or exit('No direct script access allowed');

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
        $this->class = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
        $this->module_path = APPPATH . "modules/$this->module/";
        $this->module_base = "/$this->module/$this->class/";
        $mod_lang = platform_slashes("{$this->module_path}language/" . get_language() . "/{$this->module}_lang.php");
        $class_lang = platform_slashes("{$this->module_path}language/" . get_language() . "/{$this->class}_lang.php");

        if (file_exists($mod_lang)) {
            $this->load->language($this->module, get_language());
        }
        if (file_exists($class_lang)) {
            $this->load->language($this->class, get_language());
        }

        if (file_exists(platform_slashes(APPPATH . "modules/$this->module/js/{$this->class}.js"))) {
            add_js(null, "application/modules/$this->module/js/{$this->class}.js", array(), true);
        }
        if (file_exists(platform_slashes(APPPATH . "modules/$this->module/css/{$this->class}.css"))) {
            add_css("application/modules/$this->module/css/{$this->class}.css", array());
        }
        $this->set_data('module_base', $this->module_base);
        $this->set_data('config', (object)config());

        $user_lang = @me('user_lang');

        if ($user_lang != null) {
            $config['language'] = $user_lang;
            $this->lang->load('menu', $user_lang);
            $this->lang->load('page', $user_lang);
            $this->lang->load('dashboard', $user_lang);
            $this->lang->load('modules', $user_lang);
            $this->lang->load('investor_module', $user_lang);
            $this->lang->load('contact_module', $user_lang);
            $this->lang->load('convenience_module', $user_lang);
            $this->lang->load('request_module', $user_lang);
            $this->lang->load('profile_module', $user_lang);
            $this->lang->load('project_module', $user_lang);
            $this->lang->load('studie_module', $user_lang);
            $this->lang->load('specification_module', $user_lang);
            $this->lang->load('params_module', $user_lang);
            $this->lang->load('role_module', $user_lang);
            $this->lang->load('settingsGender_module', $user_lang);
            $this->lang->load('settingsPayment_module', $user_lang);
            $this->lang->load('settingsCountry_module', $user_lang);

        } else {
            $config['language'] = 'french';
            $this->lang->load('menu', 'french');
            $this->lang->load('page', 'french');
            $this->lang->load('dashboard', 'french');
            $this->lang->load('modules', 'french');
            $this->lang->load('investor_module', 'french');
            $this->lang->load('contact_module', 'french');
            $this->lang->load('convenience_module', 'french');
            $this->lang->load('request_module', 'french');
            $this->lang->load('profile_module', 'french');
            $this->lang->load('project_module', 'french');
            $this->lang->load('studie_module', 'french');
            $this->lang->load('specification_module', 'french');
            $this->lang->load('params_module', 'french');
            $this->lang->load('role_module', 'french');
            $this->lang->load('settingsGender_module', 'french');
            $this->lang->load('settingsPayment_module', 'french');
            $this->lang->load('settingsCountry_module', 'french');

        }
    }

    public function get_module_path($path = '')
    {
        return platform_slashes($this->module_path . $path);
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

    public function set_data($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function add_data($key, $value)
    {
        if (!isset($this->data[$key])) $this->data[$key] = '';
        return ($this->data[$key] .= $value);
    }

    public function get_data($key = '')
    {
        if (empty($key)) {
            return ($this->data);
        }
        return (@$this->data[$key]);
    }
}
