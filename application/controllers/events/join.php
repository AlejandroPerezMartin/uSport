<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - _remap()
 * - index()
 * Classes list:
 * - Join extends CI_Controller
 */
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
        } else
        {
            $this->index($method, $args);
        }
    }

    public function index($eventId)
    {
        if ($this->auth_model->is_user_logged() === false || $this->event_model->joinEvent($eventId, $this->auth_model->get_logged_user_id()))
        {
            redirect(base_url());
        }

        if ($this->event_model->hasUserReachedEventJoiningLimit())
        {
            $data = array(
                'title' => 'Become Premium',
                'menu'  => $this->menu_model->menu_top()
            );

            $info['message'] = '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Sorry, <strong>you have to be premium</strong> to join more events.</div>';
            $data['styles']  = array('jumbotron-narrow');

            $this->load->view('header_view', $data);
            $this->load->view('_buy_premium_form', $info);
            $this->load->view('footer_view');
        } else
        {
            echo "There was an error while joining to the event. Maybe you were already joined or the max. number of members was reached.";
        }
    }
}
?>
