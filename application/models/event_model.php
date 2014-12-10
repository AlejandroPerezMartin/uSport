<?php

class Event_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('url');
        $this->load->model(array('auth_model', 'premium_member_model'));
    }

    public function getEventFromId($id)
    {
        return $this->db->query('SELECT * FROM `events` WHERE `id`=? LIMIT 1', array($id))->result();
    }

    public function joinEvent($eventId, $userId)
    {
        if ($this->getEventFromId($eventId) && !$this->isUserAlreadyJoined($eventId, $userId))
        {
            return $this->db->query('INSERT INTO `userevents` (eventid, userid) VALUES (?, ?)', array($eventId, $userId));
        }
    }

    public function unjoinEvent($eventId, $userId)
    {
        if ($this->getEventFromId($eventId) && $this->isUserAlreadyJoined($eventId, $userId))
        {
            $this->db->delete('userevents', array('eventid' => $eventId, 'userid' => $userId));
            return ($this->db->affected_rows() === 1);
        }
    }

    public function isUserAlreadyJoined($eventId, $userId)
    {
        return !empty($this->db->query('SELECT * FROM `userevents` WHERE `eventid`=? AND `userid`=?', array($eventId, $userId))->result());
    }

    public function getButton($eventId)
    {
        if ($this->auth_model->is_user_logged() == false)
        {
            return '<p>Please register to join the event</p><a href="' . base_url() . 'index.php/register' . '" class="btn btn-lg btn-success">Register</a>';
        }

        if ($this->isUserAlreadyJoined($eventId, $this->auth_model->get_logged_user_id()))
        {
            return '<a href="' . base_url() . 'index.php/events/unjoin/' . $eventId . '" class="btn btn-lg btn-danger">Remove me from event</a>';
        }

        return '<a href="' . base_url() . 'index.php/events/join/' . $eventId . '" class="btn btn-lg btn-primary">Join</a>';
    }

    public function removeCreatedEvent($eventId, $userId)
    {
        $this->db->delete('events', array('id' => $eventId, 'creatorid' => $userId));
        return ($this->db->affected_rows() === 1);
    }

    public function getUserJoinedEvents()
    {
        $user_id = $this->auth_model->get_logged_user_id();

        $query = $this->db->query("SELECT * FROM `userevents` WHERE `userid` = ?", array($user_id));

        $event_ids = array();

        foreach ($query->result() as $row)
        {
           array_push($event_ids, $row->eventid);
        }

        if ($event_ids)
        {
            $query = $this->db->query("SELECT * FROM `events` WHERE `id` IN (" . implode(',', $event_ids) . ")");
            return $query->result();
        }

        return NULL;
    }

    public function getUserCreatedEvents()
    {

        $user_id = $this->auth_model->get_logged_user_id();

        $query = $this->db->query("SELECT * FROM `events` WHERE `creatorid` = ?", array($user_id));

        $event_ids = array();

        foreach ($query->result() as $row)
        {
           array_push($event_ids, $row->id);
        }

        if ($event_ids)
        {
            $query = $this->db->query("SELECT * FROM `events` WHERE `id` IN (" . implode(',', $event_ids) . ")");
            return $query->result();
        }

        return NULL;
    }

    public function getUserInterestingEvents()
    {
        $user_id = $this->auth_model->get_logged_user_id();

        $query = $this->db->query("SELECT * FROM `events` WHERE `creatorid` = ?", array($user_id));

        $event_ids = array();

        foreach ($query->result() as $row)
        {
           array_push($event_ids, $row->id);
        }

        if ($event_ids)
        {
            $query = $this->db->query("SELECT * FROM `events` WHERE `id` IN (" . implode(',', $event_ids) . ")");
            return $query->result();
        }

        return NULL;
    }

    public function hasUserReachedEventCreationLimit()
    {
        $user_id = $this->auth_model->get_logged_user_id();

        return (count($this->db->get_where('events', array('creatorid' => $user_id), 2)->result()) == 2);
    }

}

?>
