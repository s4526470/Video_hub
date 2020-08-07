<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Paypal extends CI_Controller{

    function  __construct(){
        parent::__construct();

        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->model('product');
        $this->load->model('user');

        // User login status
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
        $this->load->helper(array('form', 'url'));
    }

    function success(){
        // Get the transaction data
        $paypalInfo = $this->input->get();

        $data['item_name']      = $paypalInfo['item_name'];
        $data['item_number']    = $paypalInfo['item_number'];
        $data['txn_id']         = $paypalInfo["tx"];
        $data['payment_amt']    = $paypalInfo["amt"];
        $data['currency_code']  = $paypalInfo["cc"];
        $data['status']         = $paypalInfo["st"];
        $data['user_id'] = $this->session->userdata('userId');

        $this->product->insert($data);
        // Pass the transaction data to view
        $this->load->view('paypal/success', $data);
    }

    function cancel(){
        // Load payment failed view
        $this->load->view('paypal/cancel');
    }

    function createPdf(){
        $user_id = $this->session->userdata('userId');
        $data['payment'] = $this->product->getUserInvoice($user_id);
        $this->load->view('users/pdf-invoice', $data);

        // Get output html
        $html = $this->output->get_output();

        // Load pdf library
        $this->load->library('pdf');

        // Load HTML content
        $this->dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("Invoice.pdf", array("Attachment"=>0));
    }
}