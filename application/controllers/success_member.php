<?php

class Success_Member extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model(array('auth_model', 'menu_model', 'encrypt_model', 'premium_member_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function index()
    {
        $item_transaction   = $_REQUEST['tx']; // Paypal transaction ID
        $item_price         = $_REQUEST['amt']; // Paypal received amount
        $item_currency      = $_REQUEST['cc']; // Paypal received currency type

        $price = 5;
        $currency='EUR';

        if($item_price == $price && $item_currency == $currency)
        {
            $success = TRUE;
            $this->premium_member_model->registerPremiumUser($this->auth_model->get_logged_user_id());
        }
        else
        {
            $success = FALSE;
        }

        $payment_info = array(
            'success' => $success
        );

        $data = array(
            'title'            => 'Successful payment',
            'description'      => 'Page description goes here!',
            'styles'           => array('jumbotron-narrow'),
            'menu'             => $this->menu_model->menu_top()
        );

        $this->load->view('header_view', $data);
        $this->load->view('success_payment', $payment_info);
        $this->load->view('footer_view');
    }

}

 ?>
