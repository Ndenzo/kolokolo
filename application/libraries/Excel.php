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
          $filename = $filename.".xlsx";
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

     public function define_columns($n){
          $columns = array();
          $length = ceil($n / 26);
          for($i = 1; $i <= $length; $i++){
               if($i == $length){
                    $cpt = $n - (26 * ($length-1)) ;
               }else{
                    $cpt = 26;
               }
               for($j = 0; $j < $cpt; $j++){
                    if($i > 1){
                         array_push($columns, chr(65 + $i - 2).chr(65 + $j));
                    }else{
                         array_push($columns, chr(65 + $j));
                    }
               }
          }
          return $columns;
     }

     // Excel generator
     public function excel_generator($title, $rows, $headers,  $variables){

          $objExcel = new phpExcel();
          $objExcel->setActiveSheetIndex(0);
          $objExcel->getActiveSheet()->setTitle($title);

          $columns = self::define_columns(count($headers));

          if(is_array($headers) && !empty($headers)){
               foreach ($headers as $key => $header) {
                    self::define_header(1, $columns[$key], 20, $header, $objExcel);
               }
          }

          if(is_array($rows) && !empty($rows)){
               foreach ($rows as $key => $row) {
                    foreach ($variables as $k => $value) {
                         $objExcel->getActiveSheet()->setCellValue($columns[$k].($key + 2), @$row[@$value]);
                    }
               }
          }
          self::save($title, $objExcel);
     }
}

?>
