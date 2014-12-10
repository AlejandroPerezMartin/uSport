<?php

class Join extends CI_Controller
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
            'title' => 'Create event',
            'menu'  => $this->menu_model->menu_top()
        );

        $info = array();

        if ($this->event_model->joinEvent($eventId, $this->auth_model->get_logged_user_id())) {
            echo "You've successfully joined this event!";
        }
        else
        {
            echo "There was an error while joining to the event. Maybe you were already joined or the max. number of members was reached.";
        }

    }

}

?>
