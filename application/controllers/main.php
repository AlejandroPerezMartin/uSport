<?php

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('auth_model', 'menu_model'));
    }

    function index()
    {
        $data = array(
            'title' => 'Main page',
            'description' => 'Page description goes here!',
            'styles' => array('carousel'),
            'menu' => $this->menu_model->menu_top()
        );

        $this->load->view('header_view', $data);
        $this->load->view('index_view');
        $this->load->view('footer_view');
    }

}

?>
