<?php 
defined('BASEPATH') OR exit('No direct scripot allowed');

class Sess {
    public function __construct() {
        $this->CI =& get_instance();
    }

    public function set_session($param) {
        $keys = array_keys($param);
        session_unset();

        $newParam = array_values($param);
        for ($i = 0; $i < count($keys); $i++) {
            //set session 
            $this->CI->session->set_userdata($keys[$i], $newParam[$i]);
        }
    } 

    public function delete_session($param = '') {
        if ($param == '') {
            session_unset();
        } else {
            for ($i = 0; $i < count($param); $i++) {
                $this->CI->session->unset_userdata($param[$i]);
            }
        }
    } 
}
?>