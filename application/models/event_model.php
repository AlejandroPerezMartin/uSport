<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - getEventFromId()
* - joinEvent()
* - unjoinEvent()
* - isUserAlreadyJoined()
* - getButton()
* - removeCreatedEvent()
* - getUserJoinedEvents()
* - getUserCreatedEvents()
* - hasUserReachedEventJoiningLimit()
* - getUserInterestingEvents()
* - isEventFull()
* - getEventOccupancy()
* - hasUserReachedEventCreationLimit()
* - getEventCities()
* Classes list:
* - Event_Model extends CI_Model
*/
class Event_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(array('auth_model', 'premium_member_model'));
    }

    public function getEventFromId($id)
    {
        return $this->db->query('SELECT * FROM `events` WHERE `id`=? LIMIT 1', array($id))->result();
    }

    public function joinEvent($eventId, $userId)
    {
        if ($this->getEventFromId($eventId) && !$this->isUserAlreadyJoined($eventId, $userId) && !$this->isEventFull($eventId) && !$this->hasUserReachedEventJoiningLimit())
        {
            return $this->db->query('INSERT INTO `userevents` (eventid, userid) VALUES (?, ?)', array($eventId, $userId));
        }
    }

    public function unjoinEvent($eventId, $userId)
    {
        if ($this->getEventFromId($eventId) && $this->isUserAlreadyJoined($eventId, $userId))
        {
            $this->db->delete('userevents', array('eventid' => $eventId, 'userid' => $userId));
            return ($this->db->affected_rows() == 1);
        }
    }

    public function isUserAlreadyJoined($eventId, $userId)
    {
        return !empty($this->db->query('SELECT * FROM `userevents` WHERE `eventid`=? AND `userid`=?', array($eventId, $userId))->result());
    }

    public function getButton($eventId)
    {
        if ($this->auth_model->is_user_logged() === false)
        {
            return '<p>Please register to join the event</p><a href="' . base_url() . 'index.php/register' . '" class="btn btn-lg btn-success">Register</a>';
        }

        if ($this->isUserAlreadyJoined($eventId, $this->auth_model->get_logged_user_id()))
        {
            return '<a href="' . base_url() . 'index.php/events/unjoin/' . $eventId . '" class="btn btn-lg btn-danger">Remove me from event</a>';
        }

        if ($this->isEventFull($eventId))
        {
            return '<button type="text" class="btn btn-lg btn-primary" disabled="disabled">Event is full</button>';
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
        $user_id   = $this->auth_model->get_logged_user_id();
        $query     = $this->db->query("SELECT * FROM `userevents` WHERE `userid` = ?", array($user_id));
        $event_ids = array();

        foreach ($query->result() as $row)
        {
            array_push($event_ids, $row->eventid);
        }

        if ($event_ids)
        {
            return $this->db->query("SELECT * FROM `events` WHERE `id` IN (" . implode(',', $event_ids) . ")")->result();
        }

        return null;
    }

    public function getUserCreatedEvents()
    {

        $user_id   = $this->auth_model->get_logged_user_id();
        $query     = $this->db->query("SELECT * FROM `events` WHERE `creatorid` = ?", array($user_id));
        $event_ids = array();

        foreach ($query->result() as $row)
        {
            array_push($event_ids, $row->id);
        }

        if ($event_ids)
        {
            return $this->db->query("SELECT * FROM `events` WHERE `id` IN (" . implode(',', $event_ids) . ")")->result();
        }

        return null;
    }

    public function hasUserReachedEventJoiningLimit()
    {
        $user_id       = $this->auth_model->get_logged_user_id();
        $joining_limit = 2;

        return (count($this->db->get_where('userevents', array('userid' => $user_id), $joining_limit)->result()) == $joining_limit);
    }

    public function getUserInterestingEvents()
    {
        $user_id        = $this->auth_model->get_logged_user_id();
        $query          = $this->db->query("SELECT `favouritesport` FROM `users` WHERE `id`                 = ? LIMIT 1", array($user_id))->result();
        $list_of_events = ($query) ? str_replace(',', "','", "'" . $query[0]->favouritesport . "'") : null;

        if ($list_of_events)
        {
            return $this->db->query("SELECT DISTINCT e.* FROM `events` e INNER JOIN `users` u WHERE u.`city` = e.`city` AND u.`id` = $user_id AND e.`sport` IN (" . $list_of_events . ")")->result();
        }

        return null;
    }

    public function isEventFull($eventId)
    {
        $this->db->select('maxmembers');
        $result = $this->db->get_where('events', array('id' => $eventId), 1)->result();

        if ($result) return ($result[0]->maxmembers == $this->getEventOccupancy($eventId));

        return false;
    }

    public function getEventOccupancy($eventId)
    {
        return count($this->db->get_where('userevents', array('eventid' => $eventId))->result());
    }

    public function hasUserReachedEventCreationLimit()
    {
        $user_id              = $this->auth_model->get_logged_user_id();
        $event_creation_limit = 2;

        return (count($this->db->get_where('events', array('creatorid' => $user_id), $event_creation_limit)->result()) == $event_creation_limit);
    }

    public function getEventCities()
    {
        $this->db->select('city');
        return $this->db->get('events')->result();
    }
}
?>
