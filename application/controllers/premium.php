<?php

class Premium extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('auth_model', 'menu_model', 'premium_member_model'));
        $this->load->library(array('form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function index()
    {
        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url());
        }

        $data = array(
            'title'            => 'Become Premium Member',
            'description'      => 'Page description goes here!',
            'styles'           => array('jumbotron-narrow'),
            'menu'             => $this->menu_model->menu_top()
        );

        $this->load->view('header_view', $data);
        $this->load->view('_buy_premium_form');
        $this->load->view('footer_view');
    }

}

?>
