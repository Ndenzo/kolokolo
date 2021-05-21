<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'third_party/phpexcel/PHPExcel.php';
class Excel extends PHPExcel{

    private $excel;

    public function __construct() {
        // initialise the reference to the codeigniter instance
        
        parent::__construct();    
    }

    public function load($path) {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($filename, $object) {
        // Write out as the new file
        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        ob_end_clean();
        $objWriter->save($filename);
        if (file_exists($filename)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            readfile($filename);
            exit;
        }
    }

    public function define_header($line, $column, $width, $libelle, $objExcel){
        $objExcel->getActiveSheet()->getStyle($column.$line)->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
        );
        $objExcel->getActiveSheet()->getColumnDimension($column)->setWidth($width);
        $objExcel->getActiveSheet()->setCellValue( $column.$line, $libelle);
        return $objExcel;
    }


    public function  __call($name, $arguments) {  
        // make sure our child object has this method  
        if(method_exists($this->excel, $name)) {  
            // forward the call to our child object  
            return call_user_func_array(array($this->excel, $name), $arguments);  
        }  
        return null;  
    }  
}

?>