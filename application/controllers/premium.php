<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* Classes list:
* - Premium extends CI_Controller
*/
class Premium extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('auth_model', 'menu_model', 'premium_member_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    public function index()
    {
        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url());
        }

        $data = array(
            'title'       => 'Become Premium Member',
            'description' => 'Page description goes here!',
            'styles'      => array('jumbotron-narrow'),
            'menu'        => $this->menu_model->menu_top()
        );

        $this->load->view('header_view', $data);
        $this->load->view('_buy_premium_form');
        $this->load->view('footer_view');
    }
}
?>
