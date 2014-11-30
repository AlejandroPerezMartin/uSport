<?php

class Remove extends CI_Controller
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

    public function index($id){

        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url());
        }

        $this->event_model->removeUserFromEvent($id, $this->auth_model->get_logged_user_id());
    }

}

?>
