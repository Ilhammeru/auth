<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Auth extends CI_Controller {
    public function index() {
        $this->load->view('login');
    }

    public function identify() {
        //check authentification 
        $param = [
            'user'      => $_POST['username'],
            'password'  => $_POST['password'],
            'query'     => "SELECT name, email, password, role FROM user",
            'database'  => 'master',
            'default_db'=> 'master'
        ];
       
        $this->load->helper('auth');

        $result = master_auth($param, 'master', 'master');

        echo $result;
    }
}
?>