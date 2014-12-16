<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* Classes list:
* - Logout extends CI_Controller
*/
class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
    }

    public function index()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>
