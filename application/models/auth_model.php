<?php

class Auth_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('encrypt_model'));
    }

    function process_login($login_array_input = NULL)
    {
        if (!isset($login_array_input) || count($login_array_input) != 2) return false;

        //set its variable
        $email = $login_array_input[0];
        $password = $login_array_input[1];

        // select data from database to check user exist or not?
        $query = $this->db->query("SELECT * FROM `users` WHERE `email`=? LIMIT 1", array($email));

        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $user_id = $row->id;
            $user_pass = $row->password;
            $user_salt = $row->salt;

            if ($this->encrypt_model->encryptUserPwd($password, $user_salt) === $user_pass)
            {
                $this->session->set_userdata('logged_user', $user_id);
                return true;
            }
        }

        return false;
    }

    function is_user_logged()
    {
        return ($this->session->userdata('logged_user')) ? TRUE : FALSE;
    }

    function get_logged_user_id()
    {
        return ($this->is_user_logged()) ? $this->session->userdata('logged_user') : '';
    }

}

?>
