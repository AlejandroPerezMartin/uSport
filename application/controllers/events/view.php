    <?php

    class View extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model(array('menu_model', 'event_model'));
            $this->load->helper(array('url'));
            $this->load->database();
            $this->load->library('parser');
        }

        public function id($id)
        {
            $eventInfo = $this->event_model->getEventFromId($id)[0];

            if ($eventInfo)
            {
                $data = array(
                    'title'       => $eventInfo->name,
                    'description' => $eventInfo->description,
                    'menu'        => $this->menu_model->menu_top()
                );

                $eventData = array(
                    'event_title'       => $eventInfo->name,
                    'event_description' => substr($eventInfo->description, 1, 10),
                    'event_photo'       => $eventInfo->photo,
                    'event_address'     => $eventInfo->address,
                    'event_city'        => $eventInfo->city,
                    'event_sport'       => $eventInfo->sport,
                    'event_price'       => $eventInfo->price,
                    'event_maxmembers'  => $eventInfo->maxmembers,
                    'event_button'      => $this->event_model->getButton($id)
                );

                $this->load->view('header_view', $data);
                $this->parser->parse('event_view', $eventData);
                $this->load->view('footer_view');
            }
            else
            {
                echo "The requested event doesn't exists.";
            }
        }

    }

?>
