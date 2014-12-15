<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - _remap()
 * - index()
 * Classes list:
 * - Remove extends CI_Controller
 */
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
        } else
        {
            $this->index($method, $args);
        }
    }

    public function index($eventId)
    {
        if ($this->auth_model->is_user_logged() === false || $this->event_model->removeCreatedEvent($eventId, $this->auth_model->get_logged_user_id()))
        {
            redirect(base_url());
        }

        echo 'There was a problem removing the event. Maybe you are not the event creator.';
    }
}
?>
