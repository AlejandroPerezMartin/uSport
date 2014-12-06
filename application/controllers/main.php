<?php

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('auth_model', 'menu_model', 'event_model'));
        $this->load->database();
    }

    function index()
    {
        $data = array(
            'title'            => 'Main page',
            'description'      => 'Page description goes here!',
            'is_main_page'     => true,
            'dont_show_footer' => true,
            'styles'           => array('carousel'),
            'menu'             => $this->menu_model->menu_top()
        );

        if ($this->auth_model->is_user_logged() === false)
        {
            $this->load->view('header_view', $data);
            $this->load->view('index_view');
            $this->load->view('footer_view');
        } else
        {
            $this->load->view('header_view', $data);
            $events = array(
                    'joined_events' => $this->event_model->getUserJoinedEvents(),
                    'created_events' => $this->event_model->getUserCreatedEvents()
            );

            $this->load->view('dashboard_view', $events);
            $this->load->view('footer_view');
        }
    }

}

?>
