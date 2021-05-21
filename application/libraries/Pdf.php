<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'third_party/fpdf/fpdf.php');
//require_once(APPPATH.'third_party/fpdf/fpdi.php');
require_once(APPPATH . 'third_party/fpdf/autoload.php');
require_once(APPPATH . 'third_party/fpdf/Methods.php');


class PDF extends Methods{

	public function __construct() {
        parent::__construct();
    }
    public function grid()
    {

    }

}
?>
