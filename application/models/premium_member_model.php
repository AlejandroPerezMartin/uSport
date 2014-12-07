
<?php

class Premium_Member_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('auth_model'));
    }



}

?>
