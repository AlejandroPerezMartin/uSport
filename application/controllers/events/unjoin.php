<?php

class Unjoin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model(array('menu_model', 'event_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    function _remap($method, $args)
    {
        if (method_exists($this, $method))
        {
            $this->$method($args);
        }
        else
        {
            $this->index($method, $args);
        }
    }

    public function index($eventId){

        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url());
        }

        $data = array(
            'title' => 'Dashboard',
            'menu' => $this->menu_model->menu_top()
        );

        $info = array();

        $unjoinEvent = $this->event_model->unjoinEvent($eventId, $this->auth_model->get_logged_user_id());

        if ($unjoinEvent)
        {
            $info['message'] = 'You were successfully unjoined from event';
        }
        else
        {
            $info['message'] = 'Error unjoining from event';
        }

        $this->load->view('header_view', $data);
        $this->load->view('dashboard_view', $info);
        $this->load->view('footer_view');
    }

}

?>
