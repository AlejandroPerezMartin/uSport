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
        if($this->auth_model->is_user_logged()=== true)
        {
            redirect(base_url());
        }

        $data['title'] = 'Sign up!';
        $data['menu_top'] = $this->menu_model->menu_top();

        if($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'User name', 'trim|required|alpha_dash|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]|matches[passconf]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('email', 'Email',  'trim|required|min_length[3]|max_length[30]|valid_email');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('terms', 'Terms of Sevices', 'trim|required|xss_clean');

            // Set Custom messages
            //$this->form_validation->set_message('required', 'Your custom message here');

            if ($this->form_validation->run() == FALSE)
            {
                $data['body']  = $this->load->view('_sign_up_view');
            }
            else
            {
                $name = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $country = $this->input->post('country');
                $gender = $this->input->post('gender');
                $terms = $this->input->post('terms');
                $check_query = "SELECT * FROM `users` WHERE `username`='$username' OR `email`='$email'";
                $query = $this->db->query($check_query);

                if ($query->num_rows() > 0)
                {
                    $data['body']  = $this->load->view('_sign_up_view');
                }
                else
                {
                    $rand_salt = $this->encrypt_model->genRndSalt();
                    $encrypt_pass = $this->encrypt_model->encryptUserPwd( $this->input->post('password'),$rand_salt);
                    $input_data = array(
                                        'name' => $name,
                                        'username' => $username,
                                        'email' => $email,
                                        'password' => $encrypt_pass,
                                        'country' => $country,
                                        'gender' => $gender,
                                        'salt' => $rand_salt
                    );

                    if($this->db->insert('users', $input_data))
                    {
                        $data['body']  = "Registration success, please login<br/>";
                    }
                    else
                    {
                        $data['body']  = "error on query";
                    }
                }
            }
        }
        else{
            $data['body']  = $this->load->view('_sign_up_view');
        }
        $this->load->view('_output_html', $data);

    }
}
?>
