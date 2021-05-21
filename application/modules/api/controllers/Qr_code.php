<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/phpqrcode/qrlib.php';

class Qr_code{

     public function __construct() {
          // parent::__construct();
     }

     public function get_code($code){
          QRcode::png($code);
     }

}

?>
