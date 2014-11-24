<?php

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('auth_model', 'menu_model'));
        $this->load->database();
    }

    function index()
    {

        $data = array(
            'title' => 'Main page',
            'description' => 'Page description goes here!',
            'is_main_page' => true,
            'dont_show_footer' => true,
            'styles' => array('carousel'),
            'menu' => $this->menu_model->menu_top()
        );

        if ($this->auth_model->is_user_logged() === false)
        {
            $this->load->view('header_view', $data);
            $this->load->view('index_view');
            $this->load->view('footer_view');
        } else {
            $this->load->view('header_view', $data);
            $events = array('events' => $this->getEvents());
            $this->load->view('dashboard_view', $events);
            $this->load->view('footer_view');
        }
    }

    function getEvents(){

        $user_id = $this->auth_model->get_logged_user_id();

        $query = $this->db->query("SELECT * FROM `userevents` WHERE `userid`=$user_id");

        $event_ids = array();

        foreach ($query->result() as $row)
        {
           array_push($event_ids, $row->eventid);
        }

        $query = $this->db->query("SELECT * FROM `events` WHERE `id` IN (" . implode(',', $event_ids) . ")");

        return $query->result();

    }

}

?>
