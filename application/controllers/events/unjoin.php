<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - _remap()
* - index()
* Classes list:
* - Unjoin extends CI_Controller
*/
class Unjoin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model(array('menu_model', 'event_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    public function _remap($method, $args)
    {
        if (method_exists($this, $method))
        {
            $this->$method($args);
        } else
        {
            $this->index($method, $args);
        }
    }

    public function index($eventId)
    {

        if ($this->auth_model->is_user_logged() === false || $this->event_model->unjoinEvent($eventId, $this->auth_model->get_logged_user_id()))
        {
            redirect(base_url());
        }

        echo 'Error unjoining from event. Maybe you were not joined or the event does not exist anymore.';
    }
}
?>
