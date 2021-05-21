<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TagPay extends REST
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tagpay_model');
        $this->disable('x-secret');
    }
    public function index(...$args)
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->get_params('data'));
        if ($xml === false) {
            /*
            foreach(libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }*/
            $this->error(400);
        }
        $default = array(
            'type',//PREAUTH or TRANSACTION
            'user_mobile',//Client’s Phone MSISDN
            'user_first_name',//Client’s first name
            'user_last_name',//Client’s last name
            'user_lang',//Client’s language
            'billissuer_id',//TAGPAY Merchant ID
            'billissuer_name',//TAGPAY Bill Issuer name
            'amount',//Amount of the transaction
            'currency',//Currency, in ISO 247 format.
            'bill_ref',//Bill reference entered by the client
            'pay_mode',//Payment mode. Can be “CASH” or “ACCOUNT”.
            'option',//Bill selected by the client if preauthorization selection
            'user_external_reference'//
        );
        foreach ($default as $key)
        {
            $$key = @$xml->{$key};
        }
        $this->request_allowed(array('POST'));
        $this->add_header('format','xml');
        $this->set_xml_root('BillIssuerAPI');
        if(!in_array($type,array('PREAUTH','TRANSACTION')))
        {
            $this->error(400);
        }
        switch(strtolower($type))
        {
            case 'preauth':
                //gestion référence externe
                if(empty($bill_ref)&&!empty($user_external_reference))$bill_ref = $user_external_reference;
                if(!empty($bill_ref))
                {
                    if($bill = $this->tagpay_model->get_bill($bill_ref, $amount))
                    {
                        $result = array(
                            'status'=>'OK',//status OK or KO
                            'info'=>'Contrat Numero '.$bill_ref,
                            'additional'=>'',
                            'select'=>''
                        );
                        if(empty($amount)||$amount ==0)
                        {
                            $result['amount'] = $bill->CT_MNT_TTC;
                        }
                    } else {
                        $result = array(
                            'status'=>'KO',
                            'errorcode'=>10,
                            'errormessage'=>'aucune factures disponible',
                        );
                    }
                    $this->response(200,$result);

                }else{
                    $this->error(400);
                }
                break;
            case 'transaction':
                if(empty($bill_ref)&&!empty($user_external_reference))$bill_ref = $user_external_reference;
                if(!empty($bill_ref)&&!empty($amount)){

                    if($bill = $this->tagpay_model->get_bill($bill_ref, $amount))
                    {

                        $transaction = $this->tagpay_model->transaction_create(array(
                            'transaction_id'=>identifier(),
                            'user_mobile'=>@$user_mobile,
                            'user_first_name'=>@$user_first_name,
                            'user_last_name'=>@$user_last_name,
                            'billissuer_id'=>@$billissuer_id,
                            'billissuer_name'=>@$billissuer_name,
                            'bill_ref'=>@$bill_ref,
                            'amount'=>$bill->CT_MNT_TTC,
                            'currency'=>@$currency,
                            'pay_mode'=>@$pay_mode,
                            'option'=>@option
                        ));
                        if($transaction->status=='success')
                        {
                            //var_dump($bill);
                            $transaction_id = $transaction->data['transaction_id'];
                            $result = array(
                                'status'=>'OK',
                                'transactionid'=>$transaction_id,
                                'vouchercode'=>'',
                                'additional'=>'',
                                'ticketcontent'=>'',
                                'info'=>'Facture '.$bill_ref,
                                'callback'=>base_url('/api/tagpay/update/'.$transaction_id),
                                'amount'=>$bill->CT_MNT_TTC,
                                'ticketcontent'=>"\nTicket No.: \n Facture No.: $bill_ref\nPaiement assurance \nClient: $user_first_name $user_last_name",

                            );


                            $this->response(200, $result,true);
                        }

                    }
                }
                $result = array(
                        'status'=>'KO',
                        'errorcode'=>'',
                        'errormessage'=>'',
                );
                $this->response(200, $result);
            break;
        }
    }
    public function update()
    {
        $this->request_allowed(array('GET'));
        $transaction_id = $this->uri->segment(4);
        die('12');
    }
}
?>




