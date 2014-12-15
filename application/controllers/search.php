<?php

class Search extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->library(array('form_validation'));
        $this->load->model(array('menu_model', 'event_model', 'auth_model'));
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        if ($this->auth_model->is_user_logged() === false)
        {
            redirect(base_url());
        }

        $data = array(
                      'title' => 'Search',
                      'menu' => $this->menu_model->menu_top()
                      );

        $info = array(
                      'cities' => $this->event_model->getEventCities()
                      );

        if ($this->input->post('submit'))
        {
            $this->form_validation->set_rules('searchcity', 'Search by city', 'trim|xss_clean');
            $this->form_validation->set_rules('searchsport', 'Search by sport', 'xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                    // show errors
            }
            else
            {
                $city    = $this->input->post('searchcity');
                $sport   = $this->input->post('searchsport');
                $creator = trim($this->auth_model->get_logged_user_id());

                $query = 'SELECT * FROM `events` WHERE NOT `creatorid`=? ';
                $list_of_events = ($query) ?  : NULL;
                if ($city && $sport)
                {
                    $query .= ' AND `city`=? AND `sport` IN (?)';
                }
                else if($city || $sport)
                {
                    $query .= ($city) ? ' AND `city`=?' : '';
                    $query .= ($sport) ? " AND `sport` IN (" . str_replace(',', "','", "'" . implode(',', $sport) . "'") . ")" : '';
                }

                if (!empty($sport))
                {
                    $search_results = $this->db->query($query, array($creator, $city, implode(',', $sport)))->result();
                }
                else
                {
                    $search_results = $this->db->query($query, array($creator, $city))->result();
                }

                if (count($search_results) > 0)
                {
                    $info['results'] = $search_results;
                    $this->load->view('header_view', $data);
                    $this->load->view('search_results_view', $info);
                    $this->load->view('footer_view');
                    return;
                }
                else
                {
                    $info['message'] = '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> There are no events matching your criteria</div>';
                    $this->load->view('header_view', $data);
                    $this->load->view('search_form_view', $info);
                    $this->load->view('footer_view');
                    return;
                }
            }
        }

        $this->load->view('header_view', $data);
        $this->load->view('search_form_view', $info);
        $this->load->view('footer_view');
    }

}

?>
