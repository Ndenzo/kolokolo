<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documentation extends IBEMS_Controller {

     public $data;

     function __construct()
     {
          parent::__construct();
          is_protected(array('root','admin','secretaire','surveillant'));
          $this->load->model('documentation_model');

          $this->set_data('title', 'Liste des documentations');
          $this->add_data('menu', $this->load->view('back/menu/'.get_user_info('role_code'), $this->get_data(), true));
          $this->set_data('base_url', '../');
     }

     public function index()
     {
          $this->add_data('content', $this->load->view('documentations/manager', $this->get_data(), true));
          $this->load->view('back/layout',$this->get_data());
     }

     public function showCaisse(){
          $date_deb = $this->input->post("date_deb");
          $date_fin = $this->input->post("date_fin");

          $factures = $this->documentation_model->get_operations($date_deb, $date_fin);

          if($date_deb <= $date_fin){

               setlocale(LC_TIME, "fr_FR");

               $this->load->library('pdf');
               $pdf = new PDF('P','mm','A4');
               $pdf->AddPage();
               $pageCount = $pdf->setSourceFile('temp/models/standard.pdf');
               $pageId = $pdf->importPage(1);
               $pdf->useTemplate($pageId, 0, 0);

               $pdf->SetFont('Arial','B',11);
               $pdf->text(155, 45, 'Date : '.gmdate("d-m-Y"));

               $pdf->SetFillColor(255, 255, 255);
               $pdf->setY(55);
               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->SetFont('Arial','B',15);
               $pdf->cell(195, 11, strtoupper(utf8_decode("Fiche de caisse")),1,1,'C',1);

               $cols = [25, 25, 85, 20, 20, 20];
               $pdf->SetFillColor(15, 37, 63);
               $h = 9;

               $pdf->SetFont('Arial','B',8);
               $pdf->SetTextColor(255, 255, 255);

               $pdf->setY(70);
               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->cell($cols[0],$h, utf8_decode("Date"),1 ,0,'C',1);
               $pdf->cell($cols[1],$h, utf8_decode("Pièce"),1,0,'C',1);
               $pdf->cell($cols[2],$h, utf8_decode("Libelle"),1,0,'C',1);
               $pdf->cell($cols[3],$h, utf8_decode("Debit"),1,0,'C',1);
               $pdf->cell($cols[4],$h, utf8_decode("Crédit"),1,0,'C',1);
               $pdf->cell($cols[5],$h, utf8_decode("Solde"),1,1,'C',1);

               $key = 0;
               $total_debit = 0;
               $total_credit = 0;
               $total_solde = 0;

               foreach ($factures as $facture) {
                    if($key==28){
                         $key = 0;
                         $pdf->AddPage();
                         $pageCount = $pdf->setSourceFile('temp/models/standard.pdf');
                         $pageId = $pdf->importPage(1);
                         $pdf->useTemplate($pageId, 0, 0);

                         $pdf->SetFont('Arial','B',11);
                         $pdf->text(155, 45, 'Date : '.gmdate("d-m-Y"));

                         $pdf->SetFillColor(255, 255, 255);
                         $pdf->setY(55);
                         $pdf->setX(3);
                         $pdf->cell(5);
                         $pdf->SetFont('Arial','B',15);
                         $pdf->cell(195, 11, strtoupper(utf8_decode("Fiche de caisse")),1,1,'C',1);

                         $cols = [25, 25, 85, 20, 20, 20];
                         $pdf->SetFillColor(15, 37, 63);
                         $h = 9;

                         $pdf->SetFont('Arial','B',8);
                         $pdf->SetTextColor(255, 255, 255);

                         $pdf->setY(70);
                         $pdf->setX(3);
                         $pdf->cell(5);
                         $pdf->cell($cols[0],$h, utf8_decode("Date"),1 ,0,'C',1);
                         $pdf->cell($cols[1],$h, utf8_decode("Pièce"),1,0,'C',1);
                         $pdf->cell($cols[2],$h, utf8_decode("Libelle"),1,0,'C',1);
                         $pdf->cell($cols[3],$h, utf8_decode("Debit"),1,0,'C',1);
                         $pdf->cell($cols[4],$h, utf8_decode("Crédit"),1,0,'C',1);
                         $pdf->cell($cols[5],$h, utf8_decode("Solde"),1,1,'C',1);
                    }

                    $total_debit += @$facture["debit"];
                    $total_credit += @$facture["credit"];
                    $total_solde += @$facture["solde"];

                    $cols = [25, 25, 85, 20, 20, 20];
                    $pdf->SetFillColor(255, 255, 255);
                    $h = 7;

                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetTextColor(0, 0, 0);

                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->cell($cols[0],$h, gmdate("d-m-Y H:i", @$facture["added"]) ,1,0,'C',1);
                    $pdf->cell($cols[1],$h, @$facture["piece"],1,0,'C',1);
                    $pdf->cell($cols[2],$h, utf8_decode(@$facture["libelle"]),1,0,'L',1);
                    $pdf->cell($cols[3],$h, thousand(@$facture["debit"]),1,0,'C',1);
                    $pdf->cell($cols[4],$h, thousand(@$facture["credit"]),1,0,'C',1);
                    $pdf->cell($cols[5],$h, thousand(@$total_solde),1,1,'C',1);



                    $key++;
               }

               $cols = [135, 20, 20, 20];
               $pdf->SetFillColor(240, 240, 240);
               $h = 10;

               $pdf->SetFont('Arial','B',10);
               $pdf->SetTextColor(0, 0, 0);

               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->cell($cols[0],$h, "Total" ,1,0,'C',1);
               $pdf->cell($cols[1],$h, thousand($total_debit),1,0,'C',1);
               $pdf->cell($cols[2],$h, thousand($total_credit),1,0,'C',1);
               $pdf->cell($cols[3],$h, thousand($total_solde),1,1,'C',1);

               $pdf->Output('I');

               // if(!is_dir('dossiers/caisses')){
               //      mkdir('dossiers/caisses', 0777, true);
               // }
               //
               // $file_name = 'dossiers/caisses/caisse_'.gmdate("d-m-Y").'.pdf';
               //
               // $pdf->Output('F',$file_name,true);
               //
               // header("location:".base_url($file_name));

          }else{
               echo "Erreur de date !";
          }

     }

     public function showUnpaid(){
          $classe_id = $this->input->post("classe_id");

          $factures = $this->documentation_model->get_unpaid($classe_id);

          setlocale(LC_TIME, "fr_FR");

          $this->load->library('pdf');
          $pdf = new PDF('P','mm','A4');
          $pdf->AddPage();
          $pageCount = $pdf->setSourceFile('temp/models/standard.pdf');
          $pageId = $pdf->importPage(1);
          $pdf->useTemplate($pageId, 0, 0);

          $pdf->SetFont('Arial','B',11);
          $pdf->text(155, 45, 'Date : '.gmdate("d-m-Y"));

          $pdf->SetFillColor(255, 255, 255);
          $pdf->setY(55);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->SetFont('Arial','B',15);
          $pdf->cell(195, 11, strtoupper(utf8_decode("Etat des impayés ".$factures[0]->classe_name)),1,1,'C',1);

          $cols = [25, 25, 85, 20, 20, 20];
          $pdf->SetFillColor(15, 37, 63);
          $h = 9;

          $pdf->SetFont('Arial','B',8);
          $pdf->SetTextColor(255, 255, 255);

          $pdf->setY(70);
          $pdf->setX(3);
          $pdf->cell(5);
          $pdf->cell($cols[0],$h, utf8_decode("Date"),1 ,0,'C',1);
          $pdf->cell($cols[1],$h, utf8_decode("Facture"),1,0,'C',1);
          $pdf->cell($cols[2],$h, utf8_decode("Prénoms et nom"),1,0,'C',1);
          $pdf->cell($cols[3],$h, utf8_decode("Valeur"),1,0,'C',1);
          $pdf->cell($cols[4],$h, utf8_decode("Encaisser"),1,0,'C',1);
          $pdf->cell($cols[5],$h, utf8_decode("Restant"),1,1,'C',1);

          $key = 0;
          // $total_debit = 0;
          // $total_credit = 0;
          // $total_solde = 0;

          foreach ($factures as $facture) {
               if($key==28){
                    $key = 0;
                    $pdf->AddPage();
                    $pageCount = $pdf->setSourceFile('temp/models/standard.pdf');
                    $pageId = $pdf->importPage(1);
                    $pdf->useTemplate($pageId, 0, 0);

                    $pdf->SetFont('Arial','B',11);
                    $pdf->text(155, 45, 'Date : '.gmdate("d-m-Y"));

                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->setY(55);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->SetFont('Arial','B',15);
                    $pdf->cell(195, 11, strtoupper(utf8_decode("Etat des impayés ".$factures[0]->classe_name)),1,1,'C',1);

                    $cols = [25, 25, 85, 20, 20, 20];
                    $pdf->SetFillColor(15, 37, 63);
                    $h = 9;

                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetTextColor(255, 255, 255);

                    $pdf->setY(70);
                    $pdf->setX(3);
                    $pdf->cell(5);
                    $pdf->cell($cols[0],$h, utf8_decode("Date"),1 ,0,'C',1);
                    $pdf->cell($cols[1],$h, utf8_decode("Facture"),1,0,'C',1);
                    $pdf->cell($cols[2],$h, utf8_decode("Prénoms et nom"),1,0,'C',1);
                    $pdf->cell($cols[3],$h, utf8_decode("Valeur"),1,0,'C',1);
                    $pdf->cell($cols[4],$h, utf8_decode("Encaisser"),1,0,'C',1);
                    $pdf->cell($cols[5],$h, utf8_decode("Restant"),1,1,'C',1);
               }

               // $total_debit += @$facture["debit"];
               // $total_credit += @$facture["credit"];
               // $total_solde += @$facture["solde"];

               $cols = [25, 25, 85, 20, 20, 20];
               $pdf->SetFillColor(255, 255, 255);
               $h = 7;

               $pdf->SetFont('Arial','B',8);
               $pdf->SetTextColor(0, 0, 0);

               $pdf->setX(3);
               $pdf->cell(5);
               $pdf->cell($cols[0],$h, gmdate("d-m-Y H:i", @$facture->facture_added) ,1,0,'C',1);
               $pdf->cell($cols[1],$h, @$facture->facture_num,1,0,'C',1);
               $pdf->cell($cols[2],$h, utf8_decode(@$facture->prenoms." ".@$facture->nom),1,0,'L',1);
               $pdf->cell($cols[3],$h, thousand(@$facture->montant),1,0,'C',1);
               $pdf->cell($cols[4],$h, thousand(@$facture->encaissement),1,0,'C',1);
               $pdf->cell($cols[5],$h, thousand(@$facture->montant - @$facture->encaissement),1,1,'C',1);

               $key++;
          }

          // $cols = [135, 20, 20, 20];
          // $pdf->SetFillColor(240, 240, 240);
          // $h = 10;
          //
          // $pdf->SetFont('Arial','B',10);
          // $pdf->SetTextColor(0, 0, 0);
          //
          // $pdf->setX(3);
          // $pdf->cell(5);
          // $pdf->cell($cols[0],$h, "Total" ,1,0,'C',1);
          // $pdf->cell($cols[1],$h, thousand($total_debit),1,0,'C',1);
          // $pdf->cell($cols[2],$h, thousand($total_credit),1,0,'C',1);
          // $pdf->cell($cols[3],$h, thousand($total_solde),1,1,'C',1);

          $pdf->Output('I');

          // if(!is_dir('dossiers/caisses')){
          //      mkdir('dossiers/caisses', 0777, true);
          // }
          //
          // $file_name = 'dossiers/impayes/etat_'.$classe_id.'_'.gmdate("d-m-Y").'.pdf';
          //
          // $pdf->Output('F',$file_name,true);
          //
          // header("location:".base_url($file_name));

     }
}
?>
