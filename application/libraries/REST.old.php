<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class REST
 */
class REST extends IBEMS_Controller{
    /**
     * @var
     */
    protected $__CI;
    /**
     * @var
     */
    protected $__DB;
    /**
     * @var string
     */
    protected $__xml_root = 'response';
    /**
     * @var bool|mixed
     */
    protected $__debug = false;
    /**
     * @var array
     */
    protected $__sql = array();
    /**
     * @var array
     */
    protected $__params = array();
    /**
     * @var bool|string
     */
    protected $__body;
    /**
     * @var
     */
    protected $__token;
    /**
     * @var
     */
    protected $__accept_format;
    /**
     * @var
     */
    protected $__accept_language;
    /**
     * @var array
     */
    protected $__allowed_http_methods = ['get', 'delete', 'post', 'put', 'options', 'patch', 'head'];
    /**
     * @var array
     */
    protected $__allowed_response_format = ['json', 'xml'];
    /**
     * @var array
     */
    protected $__allowed_fields = [];
    /**
     * @var array
     */
    protected $__method_array = array(
        'get'=>'show',
        'post'=>'post',
        'put'=>'put',
        'delete'=>'delete',
        'options'=>'options',
        'patch'=>'patch',
        'head'=>'head'
    );
    protected $__with_headers_check = false;
    /**
     * @var array
     */
    protected $__headers_check = ['X-Secret', 'Accept', 'Accept-Language'];
    /**
     * @var string
     */
    protected $__X_SECRET = 'KUKVtR2yPbtXfz0ho2xGDABPMETujuYov0tFzKIl';
    /**
     * @var string
     */
    protected $__table_name = '';
    /**
     * @var string
     */
    protected $__resource = '';

    /**
     * @var
     */
    private $_request_method;
    /**
     * @var array|bool
     */
    private $_request_headers;
    /**
     * @var
     */
    private $_controller;

    /**
     * REST constructor.
     */
    public function __construct(){
        parent::__construct();
        $response = array();
        $__resource = $this->router->fetch_class();
        $this->_request_headers = array_change_key_case($this->input->request_headers(true),CASE_LOWER);
        //checking required headers
        if($this->__with_headers_check)
        {
            foreach ($this->__headers_check as $key => $value)
            {
                $header = strtolower($value);
                if(!isset($this->_request_headers[$header]))
                {
                    $response['status'] = 'ERROR';
                    $response['error_message'] = '400 Bad Request. No ' .$header;
                    $this->response(400, $response);
                }else{

                }
            }
        }


        //check token
        //$this->_isAuthenticate();
        //check debug mode header;
        if(isset($this->_request_headers['debug']))
        {
            $this->__debug = filter_var($this->_request_headers['debug'], FILTER_VALIDATE_BOOLEAN);
        }
        $this->set_request_method();
        $this->__body = @file_get_contents('php://input');
        $this->__token = $this->input->get_request_header('Authorization-Token', TRUE);
        $this->__accept_format = $this->input->get_request_header('Accept', TRUE);
        $this->__accept_language = $this->input->get_request_header('Accept-Language', TRUE);
    }
    public function disable($option = array())
    {
        if(is_array($option))
        {

        }else{
            $property = "__with_{$option}";
            var_dump(property_exists(this,$property));
            if(property_exists(this,$property))
            {
                $this->$property =  false;
            }
        }
    }
    /**
     * @param $string
     */
    public function set_xml_root($string){
        $this->__xml_root = $string;
    }

    /**
     * @return string
     */
    public function get_xml_root(){
        return ("<$this->__xml_root></$this->__xml_root>");
    }

    /**
     * @return bool|string
     */
    public function body()
    {
        return $this->__body;
    }

    /**
     * @param array $request
     */
    public function request_allowed($request = array())
    {
        if (!in_array($this->get_request_method(), $request))
        {

            $this->error(405);
        }
        return;
    }

    /**
     *
     */
    public function _isAuthenticate()
    {
        $this->check_header('Authorization-Token');
        $this->token = $this->input->get_request_header('Authorization-Token', TRUE);
        //verification de la validité du token
        if(strcmp(me('token'),$this->token)!=0)
        {
            $this->error(460);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function add_header($key, $value)
    {
        $this->_request_headers[$key] = $value;
    }

    /**
     * @param $header
     */
    public function check_header($header)
    {
        $header = strtolower($header);
        if(!array_key_exists($header, $this->_request_headers)){
            $code = 450;
            $response['error'] = array(
                'code'=>$code,
                'message'=>sprintf($this->requestStatus($code),$header)
            );
            $this->response($code,$response);
        }
        if (empty($this->_request_headers[$header])){
            $code = 450;
            $response['error'] = array(
                'code'=>$code,
                'message'=>sprintf($this->requestStatus($code),$header)
            );
            $this->response($code,$response);
        }
        return;
    }

    /**
     * @return $this
     */
    public function set_request_method()
    {
        $this->_request_method = $this->input->server('REQUEST_METHOD');
        return $this;
    }

    /**
     * @return mixed
     */
    public function get_request_method()
    {
        return $this->_request_method;
    }

    /**
     * @param $tablename
     * @return $this
     */
    public function set_table_name($tablename)
    {
        $this->__table_name = $tablename;
        return $this;
    }

    /**
     * @return string
     */
    public function get_table_name()
    {
        return (!empty($this->__table_name))?$this->__table_name:$this->__resource;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function set_allow_fields($fields = array())
    {
        $this->__allowed_fields = $fields;
        return $this;
    }

    /**
     * @return array
     */
    public function get_allow_fields()
    {
        return (is_array($this->__allowed_fields)?$this->__allowed_fields:array());
    }
    public function get_params($key = null)
    {
        return (is_null($key)?$this->__params:$this->__params[$key]);
    }

    /**
     * @param array $stack
     */
    function parse_uri($stack = array())
    {
        $params = $this->uri->uri_to_assoc(4, $stack);
        foreach ($params as $key=>$v) {
            @$this->{$key} = $v;
        }
    }

    /**
     * @param $method
     * @param array $params
     */
    public function _remap($method, $params = array())
    {

        $resource = $this->router->fetch_class();
        $request_method = $this->get_request_method();
        $method_2 = strtolower("{$request_method}_{$method}");
        $method_3 = @$this->__method_array[strtolower($this->get_request_method())];

        //handling params
        switch(strtolower($request_method))
        {
            case 'get':
                $params = $_GET;
            break;
            case 'post':
                $params = $_POST;
            break;
        }
        $this->__params = $params;
        if(method_exists($this,$method_2))
        {
            call_user_func_array(array($this,$method_2), $this->__params);
            exit(0);
        }elseif(method_exists($this,$method)){
            call_user_func_array(array($this, $method), $this->__params);
            exit(0);
        }elseif(in_array(strtolower($this->get_request_method()),$this->__allowed_http_methods)) {
            $verb = strtolower(trim(strip_tags($this->uri->segment(3))));
            switch ($verb) {
                case 'id':
                    # code...
                    break;
                case 'search':
                    $method_3 = $verb;
                    break;
                default:
                    if($this->is_authorize_field($verb,$this->get_table_name())){
                        call_user_func_array(array($this,'show_field'), array($verb,$this->__params));
                    }
                    break;
            }
            if(method_exists($this,$method_3))
            {
                call_user_func_array(array($this, $method_3), $this->__params);
                exit(0);
            }
        }
        $status_code = 404 ;
        $response['status'] = 'ERROR';
        $response['error_message'] = $this->requestStatus($status_code);
        $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit(0);
    }

    /**
     * @param $code
     * @param $data
     */
    public function response($code, $data)
    {
        if ($this->__debug){
            $response[] = $data;
            $response['debug'] = true;
            $response['message'] = $this->requestStatus($code);
            $response['data'] = $this->__params;
            $response['sql'] = $this->get_sql_errors();
        }else{
            $response = $data;
        }
        //creating object of SimpleXMLElement
        $xml_user_info = new SimpleXMLElement($this->get_xml_root());
        //function call to convert array to xml
        array_to_xml($response, $xml_user_info);
        switch($this->get_format())
        {
            case 'json':
                $this->output
                    ->set_status_header($code, $this->requestStatus($code))
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
            break;
            case 'xml':
                $this->output
                    ->set_status_header($code,$this->requestStatus($code))
                    ->set_content_type('application/xml', 'utf-8')
                    ->set_output($xml_user_info->asXML())
                    ->_display();
                break;
            default:
                $this->output
                    ->set_status_header($code,$this->requestStatus($code))
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                break;
        }
        exit(0);
    }

    /**
     * @param $code
     * @param array $args
     */
    public function error($code, $args = array())
    {
        $response['error'] = array(
            'code'=>$code,
            'error-message'=>strtoupper($this->requestStatus($code))
        );
        $this->response($code, $response);
    }

    /**
     *
     */
    public function track_sql_errors()
    {
        $this->__sql[] = array(
            'sql'=>$this->db->last_query(),
            'error'=>$this->db->error()
        );
    }

    /**
     * @return array
     */
    public function get_sql_errors()
    {
        return $this->__sql;
    }

    /**
     * @param $code
     * @return mixed
     */
    public function requestStatus($code) {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            450 => 'Missing header %s',
            460 => 'Unauthorized user',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        return ($status[$code])?$status[$code]:$status[500];
    }
    /**
     * @return mixed|string
     */
    public function get_format(){
        $format = $this->input->get('format');
        if(isset($this->_request_headers['format'])) {
            $format = $this->_request_headers['format'];
        } elseif(!empty($format)) {

        } else {
            $format ='json';
        }
        if(in_array($format,$this->__allowed_response_format)){
            return $format;
        }
        return 'json';
    }
    /**
     * @param $field_name
     * @param $tablename
     * @return bool
     */
    public function is_authorize_field($field_name, $tablename)
    {
        //if(!in_array($field_name,$this->get_allow_fields())) die("field {$field_name} not allowed");
        //if(!$this->db->field_exists($field_name, $tablename)) die("field {$field_name} doesnot exist in scope");
        if(!in_array($field_name,$this->get_allow_fields())) return false;
        if(!$this->db->field_exists($field_name, $tablename)) return false;
        $fields =  $this->db->list_fields($tablename);
        return true;
    }

    /**
     * @param array $array
     * @param $xml
     */
    public static function xml_encode(array $array, &$xml){
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml_user_info->addChild("$key");
                    array_to_xml($value, $subnode);
                }else{
                    $subnode = $xml_user_info->addChild("item$key");
                    array_to_xml($value, $subnode);
                }
            }else {
                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}


/**
 * @param $array
 * @param $xml_user_info
 */
function array_to_xml($array, &$xml_user_info) {
    foreach($array as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml_user_info->addChild("$key");
                array_to_xml($value, $subnode);
            }else{
                $subnode = $xml_user_info->addChild("item$key");
                array_to_xml($value, $subnode);
            }
        }else {
            $xml_user_info->addChild("$key",htmlspecialchars("$value"));
        }
    }
}

