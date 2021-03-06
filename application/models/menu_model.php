<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - _create_menu()
* - menu_top()
* Classes list:
* - Menu_Model extends CI_Model
*/
class Menu_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(array('auth_model'));
    }

    private function _create_menu($menu, $username)
    {
        $data = array(
            'menu'     => $menu,
            'username' => $username
        );

        return $this->load->view('_links', $data, true);
    }

    public function menu_top()
    {
        $userid = $this->auth_model->get_logged_user_id();

        if ($userid)
        {
            $username = $this->db->query('SELECT `name` FROM `users` WHERE `id`=? LIMIT 1', array($userid))->result()[0]->name;
        } else
        {
            $username = 'guest';
        }

        $menu_logged = array(
            array(
                'title'       => 'Dashboard',
                'description' => 'Go to your dashboard',
                'icon'        => 'th-large',
                'url'         => base_url()
            ),
            array(
                'title'       => 'Logout',
                'description' => 'Close this session',
                'icon'        => 'log-out',
                'url'         => base_url() . 'index.php/logout'
            )
        );

        $menu_unlogged = array(
            array(
                'title' => 'Sign up',
                'description' => 'Register in our website',
                'url' => base_url() . 'index.php/register'
            ),
            array(
                'title'       => 'Login',
                'description' => 'Already registered? Log into your account',
                'url'         => base_url() . 'index.php/login'
            )
        );

        return $this->_create_menu(($this->auth_model->is_user_logged() == true) ? $menu_logged : $menu_unlogged, $username);
    }
}
?>
