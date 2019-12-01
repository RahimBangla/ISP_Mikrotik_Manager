<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -----------------------------------------------------
  | PRODUCT NAME: ZAL - ISP MANAGEMENT SYSTEM
  | -----------------------------------------------------
  | AUTHOR: ONEZEROART TEAM
  | -----------------------------------------------------
  | EMAIL: support@onezeroart.com
  | -----------------------------------------------------
  | COPYRIGHT: RESERVED BY ONEZEROART.COM
  | -----------------------------------------------------
  | AUTHOR PORTFOLIO: https://codecanyon.net/user/onezeroart/portfolio
  | -----------------------------------------------------
  | WEBSITE: http://onezeroart.com
  | -----------------------------------------------------
 */

use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use Stripe\Stripe;

class Invoice extends CI_Controller {

    function __construct() {
        parent::__construct();
//        isAdmin();
        isKena();
        isLogin();

        $this->load->model('main');
        $this->load->library('html2pdf');

        $this->config->load('paypal');
        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
            $this->config->item('client_id'), $this->config->item('secret')
            )
        );

        Stripe::setApiKey($this->config->item('stripe_apikey'));
    }

    public function index() {
        isAdmin();
        $data['invoices'] = $this->main->getAllInvoics();
        $this->load->view('header');
        $this->load->view('allinvoices', $data);
        $this->load->view('footer');
    }

    public function add() {
        isAdmin();
        $data['users'] = $this->main->getAllUsers();
        $this->load->view('header');
        $this->load->view('addinvoice', $data);
        $this->load->view('footer');
    }

    public function all() {
        isAdmin();
        $data['invoices'] = $this->main->getAllInvoics();
        $this->load->view('header');
        $this->load->view('allinvoices', $data);
        $this->load->view('footer');
    }

    public function view($id) {
        isAdmin();
        $data['invoice'] = $this->main->getInvoice($id);
        $this->load->view('header');
        $this->load->view('invoice', $data);
        $this->load->view('footer');
    }

    public function insert() {
        isAdmin();

        $invoice = array();
        $invoice['userid'] = $this->input->post('userid');
        $invoice['createdate'] = $this->input->post('createdate');
        $invoice['duedate'] = $this->input->post('duedate');
        $invoice['status'] = "Unpaid";

        $invoice['cost1'] = $this->input->post('cost1');
        $invoice['cost2'] = $this->input->post('cost2');
        $invoice['cost3'] = $this->input->post('cost3');
        $invoice['cost4'] = $this->input->post('cost4');
        $invoice['cost5'] = $this->input->post('cost5');

        $invoice['value1'] = $this->input->post('value1');
        $invoice['value2'] = $this->input->post('value2');
        $invoice['value3'] = $this->input->post('value3');
        $invoice['value4'] = $this->input->post('value4');
        $invoice['value5'] = $this->input->post('value5');

        $invoiceTure = $this->db->insert('invoice', $invoice);

        if ($invoiceTure) {
            $this->session->set_flashdata('success', 'Invoice Successfully Created');
            redirect('invoice', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Opps! Something Wrong');
            redirect('invoice', 'refresh');
        }

    }

    public function delete($id) {
        isAdmin();
        $this->db->where('invoiceID', $id);
        $this->db->delete('invoice');
        $this->session->set_flashdata('success', 'Successfully Deleted');
        redirect(base_url() . 'invoice/all');
    }

    public function generate($id) {

        $data['invoice'] = $this->main->getInvoice($id);
        $this->html2pdf->folder('./assets/files/');
        $this->html2pdf->filename('Invoice' . date('-d-m-Y-h-') . $id . '.pdf');
        $this->html2pdf->paper('a4', 'portrait');
        $this->html2pdf->html($this->load->view('invoicepdf', $data, true));
        $this->html2pdf->create('save');
        $this->html2pdf->create('download');
        $this->session->set_flashdata('success', "Invoice PDF Generated Successfully.");
        redirect(base_url("invoice/all"));

    }

    function paypal($id) {

        $invoiceRes = $this->main->getInvoice($id);

        if ($invoiceRes) {

            $invoiceRes = $invoiceRes[0];

            $userQRes = $this->main->getUserByID($invoiceRes->userid);
            $userRes = $userQRes[0];

            $packageQRes = $this->main->getPackageByID($userRes->package);
            $packageRes = $packageQRes[0];

            $subTotal = $packageRes->packprice + $packageRes->value1 + $packageRes->value2 + $packageRes->value3 + $packageRes->value4 + $packageRes->value5;
            $extraCostSubTotal = $invoiceRes->value1 + $invoiceRes->value2 + $invoiceRes->value3 + $invoiceRes->value4 + $invoiceRes->value5;
            $discountTotal = $invoiceRes->discount;
            $afterDiscount = ($subTotal + $extraCostSubTotal) - $discountTotal;
            $vatTotal = $afterDiscount * settings()[0]->vat / 100;
            $netTotal = $vatTotal + $afterDiscount;

            // setup PayPal api context
            $this->_api_context->setConfig($this->config->item('settings'));

            // ### Payer
            // A resource representing a Payer that funds a payment
            // For direct credit card payments, set payment method
            // to 'credit_card' and add an array of funding instruments.

            $payer['payment_method'] = 'paypal';

            // ### Itemized information
            // (Optional) Lets you specify item wise
            // information
            $item1["name"] = $packageRes->packname . " (" . $packageRes->packvolume . ") " . "Invoice #" . $invoiceRes->invoiceID;
//            $item1["sku"] = $invoiceRes->invoiceID;  // Similar to `item_number` in Classic API
//            $item1["description"] = $packageRes->packname . " (" . $packageRes->packvolume . ") " . "Invoice #" . $invoiceRes->invoiceID;
            $item1["currency"] = settings()[0]->currency;
            $item1["quantity"] = 1;
            $item1["price"] = $netTotal;

            $itemList = new ItemList();
            $itemList->setItems(array($item1));

            // ### Additional payment details
            // Use this optional field to set additional
            // payment information such as tax, shipping
            // charges etc.
            $details['tax'] = 0.00;
            $details['subtotal'] = $netTotal;
            // ### Amount
            // Lets you specify a payment amount.
            // You can also specify additional details
            // such as shipping, tax.
            $amount['currency'] = settings()[0]->currency;
            $amount['total'] = $details['subtotal'];
//            $amount['details'] = $details;
            // ### Transaction
            // A transaction defines the contract of a
            // payment - what is the payment for and who
            // is fulfilling it.
            $transaction['description'] = $packageRes->packname . " (" . $packageRes->packvolume . ") " . "Invoice #" . $invoiceRes->invoiceID;
            $transaction['amount'] = $amount;
//            $transaction['invoice_number'] = uniqid();
            $transaction['item_list'] = $itemList;

            // ### Redirect urls
            // Set the urls that the buyer must be redirected to after
            // payment approval/ cancellation.
            $baseUrl = base_url();
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($baseUrl . "invoice/getPaymentStatus")
                    ->setCancelUrl($baseUrl . "invoice/getPaymentStatus");

            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent set to sale 'sale'
            $payment = new Payment();
            $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions(array($transaction));

            try {
                $payment->create($this->_api_context);
            } catch (Exception $ex) {
                echo $ex->getData();
                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $ex);
                exit(1);
            }
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }

            $this->session->set_userdata('paypal_payment_id', $payment->getId());
            $this->session->set_userdata('invoice_id', $id);

            if (isset($redirect_url)) {
                /** redirect to paypal * */
                redirect($redirect_url);
            }
        }

        $this->session->set_flashdata('error', 'Unknown error occurred');
        redirect('invoice/all');
    }

    public function getPaymentStatus() {

        // paypal credentials

        /** Get the payment ID before session clear * */
        $payment_id = $this->input->get("paymentId");
        $PayerID = $this->input->get("PayerID");
        $token = $this->input->get("token");

        $payment_id = $this->session->userdata('paypal_payment_id');
        $invoice_id = $this->session->userdata('invoice_id');
        $this->session->unset_userdata('paypal_payment_id');
        $this->session->unset_userdata('invoice_id');

        /** clear the session payment ID * */
        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('error', 'Payment failed');
            redirect('invoice/all');
        }

        $payment = Payment::get($payment_id, $this->_api_context);


        /** PaymentExecution object includes information necessary * */
        /** to execute a PayPal account payment. * */
        /** The payer_id is added to the request query parameters * */
        /** when the user is redirected from paypal back to your site * */
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        /*         * Execute the payment * */
        $result = $payment->execute($execution, $this->_api_context);



        //  DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            $transactionid = $result->getId();

            $trans = $result->getTransactions();
            // item info
            $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
            $Tax = $trans[0]->getAmount()->getDetails()->getTax();

            $payAmount = $trans[0]->getAmount()->getTotal();
            $payCurrency = $trans[0]->getAmount()->getCurrency();

            $payer = $result->getPayer();
            // payer info //

            $PaymentMethod = $payer->getPaymentMethod();
            $PayerStatus = $payer->getStatus();
            $payerID = $payer->getPayerInfo()->getPayerId();
            $PayerMail = $payer->getPayerInfo()->getEmail();
            $PayerFName = $payer->getPayerInfo()->getFirstName();
            $PayerLName = $payer->getPayerInfo()->getLastName();

            $relatedResources = $trans[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            // sale info //
            $saleId = $sale->getId();
            $CreateTime = $sale->getCreateTime();
            $UpdateTime = $sale->getUpdateTime();
            $State = $sale->getState();
            $Total = $sale->getAmount()->getTotal();
            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
//            $this->paypal->create($Total, $Subtotal, $Tax, $PaymentMethod, $PayerStatus, $PayerMail, $saleId, $CreateTime, $UpdateTime, $State);

            $data = array();
            $data['invoiceid'] = $invoice_id;
            $data['transactionid'] = $transactionid;
            $data['amount'] = $payAmount;
            $data['currency'] = $payCurrency;
            $data['method'] = "Paypal";
            $data['payerid'] = $payerID;
            $data['payeremail'] = $PayerMail;
            $data['payerfname'] = $PayerFName;
            $data['payerlname'] = $PayerLName;
            $data['status'] = "Paid";
            $data['saleid'] = $saleId;
            $data['saletime'] = $CreateTime;
            $this->db->insert('payments', $data);

            $invoice = array();
            $invoice['status'] = "Paid";
            $invoice['paidamount'] = $payAmount;
            $invoice['paidmethod'] = "Paypal";
            $invoice['paidacc'] = $PayerMail;
            $this->db->where('invoiceID', $invoice_id);
            $this->db->update('invoice', $invoice);

            $userid = invoiceByID($invoice_id)->userid;
            $package = getUser(invoiceByID($invoice_id)->userid)->package;
            $month = date('F', strtotime(invoiceByID($invoice_id)->createdate));
            $year = date('Y', strtotime(invoiceByID($invoice_id)->createdate));

            $bill = array();
            $bill['userid'] = $userid;
            $bill['billstatus'] = "Paid";
            $bill['month'] = date('F');
            $bill['year'] = date('Y');
            $bill['package'] = $package;
            $this->db->where('userid',  $userid);
            $this->db->where('billstatus', 'Unpaid');
            $this->db->where('month', $month);
            $this->db->where('year', $year);
            $this->db->where('package', $package );
            $this->db->update('bills', $bill);

            $balance = array();
            $balance['title'] = "Paypal Payment (" . $payerID . ")";
            $balance['date'] = date('Y-m-d');
            $balance['amount'] = $payAmount;
            $balance['type'] = "Income";
            $this->db->insert('balance', $balance);

            $textMessage = "Dear " . getUser($userid)->name . ", we received your payment by Paypal at" . date('Y-m-d h:i:s') . " Your ISP - " . settings()[0]->name;

            if(settings()[0]->smsonbills == 1){
                $messageSMS = sendSms($user[0]->mobile, $textMessage);
            }
            if(settings()[0]->emailonbills == 1){
                $messageEmail = sendEmail($user[0]->email, 'Payment Successful By Paypal | Your ISP', $textMessage);
            }

            $this->session->set_flashdata('success', 'Payment Successfull, Thank you.');
            redirect('invoice/all');
        }

        $this->session->set_flashdata('error', 'Payment failed');
        redirect('invoice/all');
    }

    public function stripe() {

        $invoiceid = $this->input->post('invoiceid');
        $invoiceRes = $this->main->getInvoice($invoiceid);

        if ($invoiceRes) {

            $invoiceRes = $invoiceRes[0];

            $userQRes = $this->main->getUserByID($invoiceRes->userid);
            $userRes = $userQRes[0];

            $packageQRes = $this->main->getPackageByID($userRes->package);
            $packageRes = $packageQRes[0];

            $subTotal = $packageRes->packprice + $packageRes->value1 + $packageRes->value2 + $packageRes->value3 + $packageRes->value4 + $packageRes->value5;
            $extraCostSubTotal = $invoiceRes->value1 + $invoiceRes->value2 + $invoiceRes->value3 + $invoiceRes->value4 + $invoiceRes->value5;
            $discountTotal = $invoiceRes->discount;
            $afterDiscount = ($subTotal + $extraCostSubTotal) - $discountTotal;
            $vatTotal = $afterDiscount * settings()[0]->vat / 100;
            $netTotal = $vatTotal + $afterDiscount;
            $totalAmount = round($netTotal*100); //Amount In Cents
            $currency = settings()[0]->currency;


            $token = $this->input->post('stripeToken');
            if(empty($token)){
                $this->session->set_flashdata('error', 'Token is not found, you maybe missed something. Please try again.');
                redirect('invoice/all');
            }

            // This is a $20.00 charge in US Dollar.
            $charge = \Stripe\Charge::create(
                array(
                    'amount' => $totalAmount,
                    'currency' => $currency,
                    'source' => $token
                )
            );

            //retrieve charge details
            $chargeJson = $charge->jsonSerialize();
            $stripeID = $chargeJson['id'];
            $stripeStatus = $chargeJson['status'];
            $stripeAmount = $chargeJson['amount'];
            $stripeTnxID = $chargeJson['balance_transaction'];
            $stripeCreated = $chargeJson['created'];
            $stripeCurrency = $chargeJson['currency'];
            $stripePaid = $chargeJson['paid'];
            $stripeSourceID = $chargeJson['source']['id'];
    //        $stripeObject = $chargeJson['source']['object'];
            $stripeLastDigit = $chargeJson['source']['last4'];

            if($stripeStatus == "succeeded"){

                $data = array();
                $data['invoiceid'] = $invoiceid;
                $data['transactionid'] = $stripeTnxID;
                $data['amount'] = $stripeAmount/100;
                $data['currency'] = strtoupper($stripeCurrency);
                $data['method'] = "Stripe_" . $stripeLastDigit;
                $data['payerid'] = $stripeSourceID . "_" . $stripeLastDigit;
                $data['payeremail'] = $stripeID;
                $data['payerfname'] = $stripeID;
                $data['payerlname'] = $stripeID;
                $data['status'] = "Paid";
                $data['saleid'] = $stripeID;
                $data['saletime'] = date('Y-m-d');
                $this->db->insert('payments', $data);

                $invoice = array();
                $invoice['status'] = "Paid";
                $invoice['paidamount'] = $stripeAmount/100;
                $invoice['paidmethod'] = "Stripe_" . $stripeLastDigit;
                $invoice['paidacc'] = $stripeID . "_" . $stripeLastDigit;
                $this->db->where('invoiceID', $invoiceid);
                $this->db->update('invoice', $invoice);

                $userid = invoiceByID($invoiceid)->userid;
                $package = getUser(invoiceByID($invoiceid)->userid)->package;
                $month = date('F', strtotime(invoiceByID($invoiceid)->createdate));
                $year = date('Y', strtotime(invoiceByID($invoiceid)->createdate));

                $bill = array();
                $bill['userid'] = $userid;
                $bill['billstatus'] = "Paid";
                $bill['month'] = date('F');
                $bill['year'] = date('Y');
                $bill['package'] = $package;
                $this->db->where('userid',  $userid);
                $this->db->where('billstatus', 'Unpaid');
                $this->db->where('month', $month);
                $this->db->where('year', $year);
                $this->db->where('package', $package );
                $this->db->update('bills', $bill);

                $balance = array();
                $balance['title'] = "Stripe Payment (" . $stripeLastDigit . ")";
                $balance['date'] = date('Y-m-d');
                $balance['amount'] = $stripeAmount/100;
                $balance['type'] = "Income";
                $this->db->insert('balance', $balance);

                $textMessage = "Dear " . getUser($userid)->name . ", we received your payment by Stripe at" . date('Y-m-d h:i:s') . " Your ISP - " . settings()[0]->name;

                if(settings()[0]->smsonbills == 1){
                    $messageSMS = sendSms($user[0]->mobile, $textMessage);
                }
                if(settings()[0]->emailonbills == 1){
                    $messageEmail = sendEmail($user[0]->email, 'Payment Successful By Stripe | Your ISP', $textMessage);
                }

            }else{
                $this->session->set_flashdata('error', 'Something Went Wrong, Please Try Again.');
                redirect('invoice/all');
            }

            $this->session->set_flashdata('success', 'Payment Successfull, Thank you.');
            redirect('invoice/all');

        }

        $this->session->set_flashdata('error', 'Invoice Not Found.');
        redirect('invoice/all');

    }

    public function manual() {

        $invoice = array();
        $id = $this->input->post('id');
        $invoice['status'] = $this->input->post('status');
        $invoice['paidamount'] = $this->input->post('amount');
        $invoice['paidmethod'] = $this->input->post('method');
        $invoice['paidacc'] = $this->input->post('accinfo');
        $this->db->where('invoiceID', $id);
        $invoiceTure = $this->db->update('invoice', $invoice);

        $data = array();
        $data['invoiceid'] = $id;
        $data['transactionid'] = "N/A";
        $data['currency'] = $this->input->post('currency');
        $data['amount'] = $this->input->post('amount');
        $data['method'] = $this->input->post('method');
        $data['status'] = $this->input->post('status');
        $data['payeremail'] = $this->input->post('accinfo');
        $data['saletime'] = date('Y-m-d');
        $this->db->insert('payments', $data);

        $balance = array();
        $balance['title'] = "Manual Payment (" . $this->input->post('method')  . ") (" . $this->input->post('accinfo') . ")" ;
        $balance['date'] = date('Y-m-d');
        $balance['amount'] = $this->input->post('amount');
        $balance['type'] = "Income";
        $this->db->insert('balance', $balance);

        $userid = invoiceByID($id)->userid;
        $package = getUser(invoiceByID($id)->userid)->package;
        $month = date('F', strtotime(invoiceByID($id)->createdate));
        $year = date('Y', strtotime(invoiceByID($id)->createdate));

        $bill = array();
        $bill['userid'] = $userid;
        $bill['billstatus'] = "Paid";
        $bill['month'] = $month;
        $bill['year'] = $year;
        $bill['package'] = $package;
        $this->db->where('userid',  $userid);
        $this->db->where('billstatus', 'Unpaid');
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $this->db->where('package', $package );
        $this->db->update('bills', $bill);


        $textMessage = "Dear " . getUser($userid)->name . ", we received your payment manually at" . date('Y-m-d h:i:s') . " Your ISP - " . settings()[0]->name;

        if(settings()[0]->smsonbills == 1){
            $messageSMS = sendSms($user[0]->mobile, $textMessage);
        }
        if(settings()[0]->emailonbills == 1){
            $messageEmail = sendEmail($user[0]->email, 'Payment Successful | Your ISP', $textMessage);
        }

        $this->session->set_flashdata('success', 'Invoice & Payment Successfully Updated.');
        redirect('invoice/all');

    }

}

?>
