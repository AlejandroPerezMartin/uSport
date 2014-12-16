<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* Classes list:
* - Login extends CI_Controller
*/
class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('auth_model', 'menu_model'));
        $this->load->helper(array('html', 'form', 'url'));
    }

    public function index()
    {

        if ($this->auth_model->is_user_logged() === true)
        {
            redirect(base_url());
        }

        $sub_data['login_failed'] = '';

        $data = array(
            'title'          => 'Sign in',
            'menu_top'       => $this->menu_model->menu_top(),
            'dont_show_menu' => true,
            'styles'         => array('signin'),
            'body'           => $this->load->view('_login_form', $sub_data, true)
        );

        if ($this->input->post('submit_login'))
        {
            $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[3]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[35]|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ', '</div>');

            if ($this->form_validation->run() === false)
            {
                $data['body'] = $this->load->view('_login_form', $sub_data, true);

                $this->load->view('header_view', $data);
                $this->load->view('_login_form');
                $this->load->view('footer_view');
            } else
            {
                $login_array = array($this->input->post('email'), $this->input->post('password'));

                if ($this->auth_model->process_login($login_array))
                {
                    // Login successfull
                    redirect(base_url());
                } else
                {
                    $sub_data['login_failed'] = 'Invalid username or password';

                    $this->load->view('header_view', $data);
                    $this->load->view('_login_form', $sub_data);
                    $this->load->view('footer_view');
                }
            }
        } else
        {
            $this->load->view('header_view', $data);
            $this->load->view('_login_form');
            $this->load->view('footer_view');
        }
    }
}
?>
