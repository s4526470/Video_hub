<?php


class Vip extends CI_Controller{
    function __construct() {
        parent::__construct();

        // Load paypal ibrary & user models
        $this->load->library('paypal_lib');
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->model('product');

        // User login status
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
        $this->load->helper(array('form', 'url'));
    }

    function index(){
        $data = array();
        $productInfo = array();
        if($this->isUserLoggedIn){
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);
            $productInfo['products'] = $this->product->getRows();
            $this->load->view('users/vip', $data);
            $this->load->view('users/products', $productInfo);
            $this->load->view('users/footer');
        }else{
            redirect('users/login');
        }
    }

    function buy($id){
        // Set variables for paypal form
        $returnURL = base_url().'paypal/success';
        $cancelURL = base_url().'paypal/cancel';
        $notifyURL = base_url().'paypal/ipn';

        // Get product data from the database
        $product = $this->product->getRows($id);

        // Get current user ID from the session
        $userID = $this->session->userdata('userId');

        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);

        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }
}
