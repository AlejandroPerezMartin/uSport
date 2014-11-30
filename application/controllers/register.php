<?php

class Register extends CI_Controller
{

    function validate_birthdate($str){
        return (preg_match("/^[0-9]{4}-[1-12]{2}-[1-31]{2}/", $str));
    }

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model(array('menu_model', 'encrypt_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function index()
    {
        if ($this->auth_model->is_user_logged() === true)
        {
            redirect(base_url());
        }

        $data = array(
            'title' => 'Sign up',
            'menu' => $this->menu_model->menu_top()
        );

        if ($this->input->post('submit'))
        {

            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('surname', 'Surname', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email',  'trim|required|min_length[3]|max_length[30]|valid_email');
            $this->form_validation->set_rules('birthdate', 'Birth date',  'trim|required|callback_validate_birthdate');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]|matches[passconf]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('favouritesport', 'Favourite Sports', 'trim|required|xss_clean');
            $this->form_validation->set_rules('terms', 'Terms of Sevices', 'trim|required|xss_clean');

            $this->form_validation->set_message('validate_birthdate','Member is not valid!');

            // Set Custom messages
            //$this->form_validation->set_message('required', 'Your custom message here');

            if ($this->form_validation->run() == FALSE)
            {
                //$data['body']  = $this->load->view('_sign_up_view');
            }
            else
            {
                $name           = $this->input->post('name');
                $surname        = $this->input->post('surname');
                $email          = $this->input->post('email');
                $birthdate      = $this->input->post('birthdate');
                $password       = $this->input->post('password');
                $country        = $this->input->post('country');
                $city           = $this->input->post('city');
                $gender         = $this->input->post('gender');
                $favouritesport = $this->input->post('favouritesport');
                $terms          = $this->input->post('terms');

                $check_query = "SELECT * FROM `users` WHERE `email`='$email'";
                $query = $this->db->query($check_query);

                if ($query->num_rows() > 0)
                {
                    echo "User already registered";
                }
                else
                {
                    $rand_salt = $this->encrypt_model->genRndSalt();
                    $encrypt_pass = $this->encrypt_model->encryptUserPwd($this->input->post('password'), $rand_salt);
                    $input_data = array(
                                        'name' => $name,
                                        'surname' => $surname,
                                        'email' => $email,
                                        'birthdate' => $birthdate,
                                        'password' => $encrypt_pass,
                                        'country' => $country,
                                        'city' => $city,
                                        'gender' => $gender,
                                        'favouritesport' => $favouritesport,
                                        'salt' => $rand_salt
                    );

                    if ($this->db->insert('users', $input_data))
                    {
                        //$data['body']  = "Registration success, please login<br/>";
                    }
                    else
                    {
                        //$data['body']  = "error on query";
                    }
                }
            }
        }
        else
        {
            //$data['body']  = $this->load->view('_sign_up_view');
        }

        $this->load->view('header_view', $data);
        $this->load->view('_sign_up_view');
        $this->load->view('footer_view');

    }
}

?>
