<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - id()
* Classes list:
* - View extends CI_Controller
*/
class View extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('menu_model', 'event_model'));
        $this->load->helper(array('url'));
        $this->load->library('parser');
    }

    public function id($eventId)
    {
        $eventInfo = ($this->event_model->getEventFromId($eventId)) ? $this->event_model->getEventFromId($eventId)[0] : null;

        if ($eventInfo)
        {
            $data = array(
                'title'       => $eventInfo->name,
                'description' => $eventInfo->description,
                'menu'        => $this->menu_model->menu_top()
            );

            $eventData = array(
                'event_title'       => $eventInfo->name,
                'event_description' => $eventInfo->description,
                'event_photo'       => $eventInfo->photo,
                'event_address'     => $eventInfo->address,
                'event_city'        => $eventInfo->city,
                'event_sport'       => $eventInfo->sport,
                'event_price'       => $eventInfo->price,
                'event_maxmembers'  => $eventInfo->maxmembers,
                'event_button'      => $this->event_model->getButton($eventId)
            );

            $this->load->view('header_view', $data);
            $this->parser->parse('event_view', $eventData);
            $this->load->view('footer_view');
        } else
        {
            echo "<h2>The requested event does'nt exists</h2>";
        }
    }
}
?>
