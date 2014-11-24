<?php

class Create extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model(array('menu_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function index(){

        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url() . 'index.php/register');
        }

        $data = array(
            'title' => 'Create event',
            'menu' => $this->menu_model->menu_top()
        );

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('photo', 'Photo', 'trim|prep_url|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sport', 'Sport', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('maxmembers', 'Max number of members', 'trim|required|integer|xss_clean');

            // Set Custom messages
            //$this->form_validation->set_message('required', 'Your custom message here');

            if ($this->form_validation->run() == FALSE)
            {
                //$data['body']  = $this->load->view('_sign_up_view');
            }
            else
            {
                $name = $this->input->post('name');
                $description = $this->input->post('description');
                $photo = $this->input->post('photo');
                $address = $this->input->post('address');
                $city = $this->input->post('city');
                $sport = $this->input->post('sport');
                $price = $this->input->post('price');
                $maxmembers = $this->input->post('maxmembers');

                    $input_data = array(
                                        'name' => $name,
                                        'description' => $description,
                                        'photo' => $photo,
                                        'address' => $address,
                                        'city' => $city,
                                        'sport' => $sport,
                                        'price' => $price,
                                        'maxmembers' => $maxmembers,
                    );

                    if ($this->db->insert('events', $input_data))
                    {
                        //$data['body']  = "Registration success, please login<br/>";
                    }
                    else
                    {
                        //$data['body']  = "error on query";
                    }
}

        }
        else
        {
            //$data['body']  = $this->load->view('_sign_up_view');
        }

        $this->load->view('header_view', $data);
        $this->load->view('create_event_view');
        $this->load->view('footer_view');

    }

}

?>
