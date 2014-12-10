<?php

class Create extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model(array('menu_model', 'premium_member_model', 'event_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function index()
    {

        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url() . 'index.php/register');
        }

        $data = array(
            'title' => 'Create event',
            'menu'  => $this->menu_model->menu_top()
        );

        $info = array();

        // if user is not premium and has reached event creation limit, buy premium membership page is loaded
        if ($this->event_model->hasUserReachedEventCreationLimit() && !$this->premium_member_model->isPremiumUser($this->auth_model->get_logged_user_id()))
        {
            $data['title'] = 'Become Premium';
            $info['message'] = '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Sorry, <strong>you have to be premium</strong> to create more events.</div>';
            $data['styles']  = array('jumbotron-narrow');
            $this->load->view('header_view', $data);
            $this->load->view('_buy_premium_form', $info);
            $this->load->view('footer_view');
            return;
        }

        if ($this->input->post('submit'))
        {

            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[140]|xss_clean');
            $this->form_validation->set_rules('photo', 'Photo', 'trim|prep_url|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sport', 'Sport', 'trim|required|xss_clean');
            $this->form_validation->set_rules('maxmembers', 'Max. number of members', 'trim|required|integer|xss_clean');

            // Set Custom messages
            //$this->form_validation->set_message('required', 'Your custom message here');

            if ($this->form_validation->run() == FALSE)
            {
                // show errors
            }
            else
            {
                $name        = $this->input->post('name');
                $description = $this->input->post('description');
                $photo       = $this->input->post('photo');
                $address     = $this->input->post('address');
                $city        = $this->input->post('city');
                $sport       = $this->input->post('sport');
                $maxmembers  = $this->input->post('maxmembers');
                $creatorid   = $this->auth_model->get_logged_user_id();

                $input_data = array(
                    'name'        => $name,
                    'description' => $description,
                    'photo'       => $photo,
                    'address'     => $address,
                    'city'        => $city,
                    'sport'       => $sport,
                    'maxmembers'  => $maxmembers,
                    'creatorid'   => $creatorid
                );

                if ($this->db->insert('events', $input_data))
                {
                    $info['message'] = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <strong>Congratulations</strong>, your event was successfully created! You can see it in your <a href="' . base_url() . '" title="Go to your Dashboard">Dashboard</a></div>';
                }
                else
                {
                    $info['message'] = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> There was an error creating your event. Please try again.</div>';
                }
            }
        }

        $this->load->view('header_view', $data);
        $this->load->view('create_event_view', $info);
        $this->load->view('footer_view');

    }

}

?>
