<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Spending extends IBEMS_Controller {

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('spending_model');

          $this->set_data('title', 'Décaissements');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
     }

     public function index(){
          $this->set_data('datagrid', $this->spending_model->get_all());
          $this->add_data('content', $this->load->view('spendings/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showDecaissement(){
          $id = (int)$this->uri->segment(4);

          $decaissement_bon = $this->spending_model->get_one($id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/decaissement.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $pdf->SetFont('Arial','B',11);
          $pdf->text(167, 40, gmdate('d/m/Y', $decaissement_bon->decaissement_bon_added));

          $pdf->SetFont('Arial','B',15);
          $pdf->text(120, 50.5, $decaissement_bon->decaissement_bon_num);

          $cols = [20,125,40];
          $pdf->SetFillColor(230, 230, 230);
          $h = 9;

          $pdf->SetFont('Arial','B',11);

          $pdf->setY(65);
          $pdf->setX(3);
          $pdf->cell(10);
          $pdf->cell($cols[0],$h, utf8_decode("N°"),1 ,0,'C',1);
          $pdf->cell($cols[1],$h, utf8_decode("NATURE OPÉRATION"),1,0,'C',1);
          $pdf->cell($cols[2],$h, utf8_decode("MONTANT"),1,1,'C',1);

          foreach ($decaissement_bon->decaissements as $key=>$decaissement) {
               $pdf->SetFillColor(255, 255, 255);
               $pdf->SetFont('Arial','B',8);
               $ch = 7;
               $pdf->cell(3);
               $pdf->cell($cols[0],$ch, $key+1 ,1,0,'C',1);
               $pdf->cell($cols[1],$ch,utf8_decode($decaissement->decaissement_libelle),1,0,'L',1);
               $pdf->cell($cols[2],$ch,thousand($decaissement->decaissement_value)." F CFA",1,1,'C',1);
          }

          $pdf->SetFillColor(230, 230, 230);
          $pdf->SetFont('Arial','B',11);
          $ch = 8;
          $pdf->cell(3);
          $pdf->cell(145,$ch,utf8_decode("TOTAL"),1,0,'C',1);
          $pdf->cell(40,$ch,thousand($decaissement_bon->montant_decaisser)." F CFA",1,1,'C',1);

          $pdf->Output('I');
     }

     public function insert()
     {
          if(isPostBack())
          {
               if($this->spending_model->insert()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le decaissement a été enregistrer !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le decaissement n'a pas été enregistrer !"
                    ));
               }
          }
          redirect('spending');
     }

     public function delete()
     {
          if(isPostBack())
          {
               if($this->spending_model->delete()){
                    set_notification(array(
                         'type'=>'success',
                         'message'=>"Le decaissement a été supprimé !"
                    ));
               }else{
                    set_notification(array(
                         'type'=>'danger',
                         'message'=>"Le decaissement n'a pas été supprimé !"
                    ));
               }
          }
          redirect('spending');
     }

}
?>
