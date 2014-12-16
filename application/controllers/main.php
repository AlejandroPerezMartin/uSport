<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* Classes list:
* - Main extends CI_Controller
*/
class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('auth_model', 'menu_model', 'event_model'));
        $this->load->database();
    }

    public function index()
    {
        $data = array(
            'title'        => 'Dashboard',
            'description'  => 'Page description goes here!',
            'is_main_page' => true,
            'showFooter'   => true,
            'styles'       => array('carousel'),
            'scripts'      => array('custom'),
            'menu'         => $this->menu_model->menu_top()
        );

        if ($this->auth_model->is_user_logged() === false)
        {
            $data['title'] = 'Main page';

            $this->load->view('header_view', $data);
            $this->load->view('index_view');
            $this->load->view('footer_view');
        } else
        {
            $this->load->view('header_view', $data);

            $events = array(
                'joined_events'      => $this->event_model->getUserJoinedEvents(),
                'created_events'     => $this->event_model->getUserCreatedEvents(),
                'interesting_events' => $this->event_model->getUserInterestingEvents()
            );

            $this->load->view('dashboard_view', $events);
            $this->load->view('footer_view');
        }
    }
}
?>
