<?php

class Register extends CI_Controller
{

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

        $info = array();

        if ($this->input->post('submit'))
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('surname', 'Surname', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email',  'trim|required|min_length[3]|max_length[30]|valid_email');
            $this->form_validation->set_rules('birthdate', 'Birth date', 'trim|required|callback_date_valid');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]|matches[passconf]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('favouritesport', 'Favourite Sports', 'trim|required|xss_clean');
            $this->form_validation->set_rules('terms', 'Terms of Sevices', 'trim|required|xss_clean');

            // Set Custom messages
            //$this->form_validation->set_message('required', 'Your custom message here');

            if ($this->form_validation->run() == FALSE)
            {
                // show errors
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
                $query          = $this->db->query('SELECT * FROM `users` WHERE `email`=?', array($email));

                if ($query->num_rows() > 0)
                {
                    $info['message'] = '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> <strong>Sorry</strong>, the email address provided is already in use.</div>';
                }
                else
                {
                    $rand_salt    = $this->encrypt_model->genRndSalt();
                    $encrypt_pass = $this->encrypt_model->encryptUserPwd($this->input->post('password'), $rand_salt);
                    $input_data   = array(
                                        'name'           => $name,
                                        'surname'        => $surname,
                                        'email'          => $email,
                                        'birthdate'      => date('Y-m-d', strtotime($birthdate)),
                                        'password'       => $encrypt_pass,
                                        'country'        => $country,
                                        'city'           => $city,
                                        'gender'         => $gender,
                                        'favouritesport' => $favouritesport,
                                        'salt'           => $rand_salt
                    );

                    if ($this->db->insert('users', $input_data))
                    {
                        $info['message'] = $birthdate;
                        //$info['message'] = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <strong>Congratulations</strong>, you are registered! Now you can <a href="' . base_url() . 'index.php/login" title="Login to your account">log in to your account</a></div>';
                    }
                    else
                    {
                        $info['message'] = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> There was an error processing your registration. Please try again.</div>';
                    }
                }
            }
        }

        $this->load->view('header_view', $data);
        $this->load->view('_sign_up_view', $info);
        $this->load->view('footer_view');

    }

    public function date_valid($date)
    {
        $parts = explode("/", $date);

        if (count($parts) == 3 && checkdate($parts[0], $parts[1], $parts[2])) return true;

        $this->form_validation->set_message('date_valid', 'The Date field must be MM/DD/YYYY');
        return false;
    }

}

?>
