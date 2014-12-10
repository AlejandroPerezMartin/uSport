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

    public function registerPremiumUser( $userId )
    {
        return $this->db->query('UPDATE `users` SET `premium`=1 WHERE `id`=?', array( $userId ));
    }

    public function isPremiumUser( $userId )
    {
        return $this->db->query('SELECT * FROM `users` WHERE `premium`=1 LIMIT 1', array( $userId ))->result();
    }

}

?>
